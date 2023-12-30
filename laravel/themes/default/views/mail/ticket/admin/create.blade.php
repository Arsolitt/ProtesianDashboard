@component('mail::message')
Тикет #{{$ticket->ticket_id}} был открыт пользователем **{{$user->name}}**

### Информация
___
Пользователь: {{$user->name}} <br>
Тема: {{$ticket->title}} <br>
Категория: {{ $ticket->ticketcategory->name }} <br>
Приоритет: {{ $ticket->priority }} <br>
Статус: {{ $ticket->status }} <br>

___
```
{{ $ticket->message }}
```
___

Ссылка на обращение: {{ route('moderator.ticket.show', ['ticket_id' => $ticket->ticket_id]) }}

<br>
C наилучшими пожеланиями,<br>
{{ config('app.name') }}
@endcomponent
