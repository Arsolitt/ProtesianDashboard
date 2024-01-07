<?php

namespace App\Http\Controllers\Admin;

use App\Events\PaymentEvent;
use App\Events\UserUpdateCreditsEvent;
use App\Http\Controllers\Controller;
use App\Models\PartnerDiscount;
use App\Models\Payment;
use App\Models\User;
use App\Models\ShopProduct;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\ExtensionHelper;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;


class PaymentController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admin.payments.index')->with([
            'payments' => Payment::paginate(15),
        ]);
    }

    public function checkOut(Request $request)
    {
        $min = !config('SETTINGS::PAYMENTS:MINIMUM_AMOUNT') ? 1 : config('SETTINGS::PAYMENTS:MINIMUM_AMOUNT');
        $max = !config('SETTINGS::PAYMENTS:MAXIMUM_AMOUNT') ? 999999 : config('SETTINGS::PAYMENTS:MAXIMUM_AMOUNT');
        $request->validate([
            'payment_amount' => "required|numeric|integer|min:$min|max:$max",
        ]);

        $user = Auth::user();
        $discount = PartnerDiscount::getDiscount();
        $price = $request->payment_amount;
        $price_after_discount = (float)$price - ($price * $discount / 100);
        $tax_percent = config('SETTINGS::PAYMENTS:SALES_TAX') < 0 ? 0 : config('SETTINGS::PAYMENTS:SALES_TAX');
        $tax_value = (float)$price_after_discount * $tax_percent / 100;
        $total_price = (float)$price_after_discount + $tax_value;

        $payment = Payment::create([
            'user_id' => $user->id,
            'payment_id' => null,
            'payment_method' => $request->payment_method,
            'type' => 'Credits',
            'status' => 'open',
            'amount' => $price,
            'price' => $request->payment_amount - ($request->payment_amount * $discount / 100),
            'tax_value' => $tax_value,
            'tax_percent' => $tax_percent,
            'total_price' => $total_price,
            'currency_code' => 'RUB',
            'shop_item_product_id' => '',
        ]);
        Redirect::route('payment.pay', $payment->id, 303)->send();
    }

    public function pay(string $payment_internal_id)
    {
        $payment = Payment::findOrFail($payment_internal_id);
        $paymentGateway = $payment->payment_method;

        // on free products, we don't need to use a payment gateway
        if ($payment->total_price <= 0) {
            return $this->handleFreeProduct($payment);
        }

        Redirect::route('payment.' . $paymentGateway . 'Pay', ['payment_internal_id' => $payment->id], 303)->send();
    }

    public function handleFreeProduct(Payment $payment)
    {
        /** @var User $user */
        $user = Auth::user();

        $payment->update([
            'payment_id' => uniqid(),
            'payment_method' => 'free',
            'status' => 'paid',
        ]);

        $logInfo = array(
            "NotificationSource" => "Payment Gateway",
            "UserID" => $payment->user_id,
            "PaymentMethod" => $payment->payment_method,
            "PaymentID" => $payment->id,
            "PaymentAmount" => $payment->total_price,
            "PaymentStatus" => $payment->status,
        );
        Log::info(json_encode($logInfo));

        event(new UserUpdateCreditsEvent($user));
        event(new PaymentEvent($user, $payment));

        //not sending an invoice

        //redirect back to home
        return redirect()->route('home')->with('success', __('Your credit balance has been increased!'));
    }

    /**
     * @param  Request  $request
     */
    public function Cancel(Request $request)
    {
        return redirect()->route('store.index')->with('info', 'Payment was Canceled');
    }

    /**
     * @return JsonResponse|mixed
     *
     * @throws Exception
     */
    public function dataTable()
    {
        $query = Payment::with('user');

        return datatables($query)

            ->addColumn('user', function (Payment $payment) {
                return
                ($payment->user)?'<a class="font-medium text-purple-600 dark:text-purple-500 hover:underline"  href="'.route('admin.users.show', $payment->user->id).'">'.$payment->user->name.'</a>':__('Unknown user');

            })
            ->editColumn('price', function (Payment $payment) {
                return $payment->formatToCurrency($payment->price);
            })
            ->editColumn('tax_value', function (Payment $payment) {
                return $payment->formatToCurrency($payment->tax_value);
            })
            ->editColumn('tax_percent', function (Payment $payment) {
                return $payment->tax_percent.' %';
            })
            ->editColumn('total_price', function (Payment $payment) {
                return $payment->formatToCurrency($payment->total_price);
            })

            ->editColumn('created_at', function (Payment $payment) {
                return [
                    'display' => $payment->created_at ? $payment->created_at->diffForHumans() : '',
                    'raw' => $payment->created_at ? strtotime($payment->created_at) : ''
                ];
            })
            ->addColumn('actions', function (Payment $payment) {
                return '<div class="flex items-center text-sm">
                       <a data-content="' . __("Download Invoices") . '" data-toggle="popover" data-trigger="hover" data-placement="top" href="' . route('admin.invoices.downloadSingleInvoice', "id=" . $payment->payment_id) . '" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Download">
                       <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                          </a>
                          </div>';
            })
            ->editColumn('status', function (Payment $payment) {
                switch ($payment->status) {
                    case 'paid':
                        $badgeColor = 'text-green-700 bg-green-100 dark:bg-green-500/20 dark:text-green-500';
                        break;
                    case 'cancelled':
                        $badgeColor = 'text-red-700 bg-red-100 dark:bg-red-500/20 dark:text-red-500';
                        break;
                    case 'open':
                        $badgeColor = 'text-purple-700 bg-purple-100 dark:bg-purple-700 dark:text-purple-100';
                        break;
                    case 'pending':
                        $badgeColor = 'text-amber-700 bg-amber-100 dark:bg-amber-700 dark:text-amber-100';
                        break;
                    default:
                        $badgeColor = 'text-indigo-700 bg-indigo-100 dark:bg-indigo-500/20 dark:text-indigo-500';
                        break;
                }

                return '<span class="px-2 py-1 text-xs font-semibold leading-tight rounded-full ' . $badgeColor . '">' . $payment->status . '</span>';
            })
            ->rawColumns(['actions', 'user', 'status'])
            ->make(true);
    }
}
