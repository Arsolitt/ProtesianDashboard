<?php
$themeClass = 'dark';
if (!empty($_COOKIE['theme'])) {
    $themeClass = $_COOKIE['theme'];
}
?>

<!DOCTYPE html>
<html :class="{ 'dark': dark }" x-data="data" lang={{ App::getLocale() }} id="html"
    class="<?php echo $themeClass; ?> overflow-hidden h-full">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta content="{{ __(config('SETTINGS::SYSTEM:SEO_TITLE')) }}" property="og:title">
    <meta content="{{ __(config('SETTINGS::SYSTEM:SEO_DESCRIPTION')) }}" property="og:description">
    <meta property="og:url" content="https://protesian.host"/>
    <meta property="og:site_name" content="ProtesiaN Host"/>
    <meta property="og:image" content="{{ asset('images/preview.png') }}"/>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __(config('SETTINGS::SYSTEM:SEO_TITLE')) }}</title>
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap" rel="stylesheet">

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    <script>
        const prefersDarkScheme = window.matchMedia("(prefers-color-scheme: dark)");
        if (prefersDarkScheme.matches && !window.localStorage.getItem('dark') && "<?php echo $themeClass; ?>" == "") {
            document.querySelector("html").classList.add("dark");
        }
    </script>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet"
        href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <script defer src="{{ asset('js/app.js') }}"></script>
    <script defer src="{{ asset('js/focus-trap.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    @yield('head')

    <script src="{{ asset('js/pace.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/pace.css') }}" />

    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    <script src={{ asset('plugins/tinymce/js/tinymce/tinymce.min.js') }}></script>

    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css"> --}}
</head>

<body>

<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
    (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
    m[i].l=1*new Date();
    for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
    k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
    (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

    ym(95399310, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
    });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/95399310" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

    <div class="pointer-events-auto flex h-screen bg-gray-50 dark:bg-gray-900"
        :class="{ 'overflow-hidden': isSideMenuOpen }">
        <!-- Desktop sidebar -->
        @include('includes.desktop-sidebar')

        <!-- Mobile sidebar -->
        @include('includes.mobile-sidebar')

        <div class="flex flex-col flex-1 w-full">
            @include('includes.header')
            <main class="flex flex-col justify-between h-full overflow-y-auto text-gray-700 dark:text-gray-400">
                <div>

                    @if (!Auth::user()->hasVerifiedEmail())
                        @if (Auth::user()->created_at->diffInHours(now(), false) > 1 ||
                                strtolower(config('SETTINGS::USER:FORCE_EMAIL_VERIFICATION')) == 'true')
                            <x-alert title="{{ __('You have not yet verified your email address!') }}" type="warn"
                                class="mt-6 mb-0">
                                <p>
                                    <a class="text-primary underline"
                                        href="{{ route('verification.send') }}">{{ __('Resend verification email') }}</a>
                                    <br>
                                    {{ __('Please contact support If you didnt receive your verification email.') }}
                                </p>
                            </x-alert>
                        @endif
                    @endif

                    @yield('content')
                </div>

                <footer
                    class="p-4 mt-4 bg-white shadow-md dark:bg-gray-800 flex flex-col sm:flex-row justify-between items-center">
                    <div>
                        <a href="{{ url('/') }}">{{ env('APP_NAME', 'Laravel') }}</a> &copy; 2021-{{ date('Y') }} {{ __('All rights reserved') }}.
                    </div>
                    <div>
                        <x-information />
                    </div>
                </footer>
            </main>
        </div>
    </div>
    @include('models.redeem_voucher_modal')
    {{-- <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.24/datatables.min.js"></script> --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $('[data-toggle="popover"]').popover();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
    </script>
    <script>
        @if (Session::has('error'))
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                html: '{{ Session::get('error') }}',
            })
        @endif
        @if (Session::has('success'))
            Swal.fire({
                icon: 'success',
                title: '{{ Session::get('success') }}',
                position: 'bottom-end',
                showConfirmButton: false,
                background: '#343a40',
                toast: true,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })
        @endif
        @if (Session::has('info'))
            Swal.fire({
                icon: 'info',
                title: '{{ Session::get('info') }}',
                position: 'bottom-end',
                showConfirmButton: false,
                background: '#343a40',
                toast: true,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })
        @endif
    </script>
    @yield('scripts')

</body>

</html>
