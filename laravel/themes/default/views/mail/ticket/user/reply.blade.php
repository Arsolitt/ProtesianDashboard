@component('mail::message')
К вашему обращению был добавлен ответ

### Информация
___
Номер обращения: {{ $ticket->ticket_id }} <br>
Тема: {{ $ticket->title }} <br>
Статус: {{ $ticket->status }} <br>

___
```
{{ $newmessage }}
```
___
<br>
<br>
C наилучшими пожеланиями,<br>
{{ config('app.name') }}
@endcomponent
