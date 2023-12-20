@component('mail::message')
# Спасибо за покупку!
Платёж подтверждён. Баланс обновлён.<br>

# Информация
___
### Номер платежа: **{{$payment->id}}**<br>
### Статус:     **{{$payment->status}}**<br>
### Сумма:      **{{$payment->formatToCurrency($payment->total_price)}}**<br>
### Количество монет:     **{{$payment->amount}}**<br>
### Текущий баланс:    **{{$payment->user->credits}}**<br>
### Идентификатор пользователя:    **{{$payment->user_id}}**<br>

<br>
C наилучшими пожеланиями,<br>
{{ config('app.name') }}
@endcomponent
