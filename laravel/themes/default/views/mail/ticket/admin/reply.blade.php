@component('mail::message')
Новый ответ на тикет #{{$ticket->ticket_id}} от пользователя **{{$user->name}}**

### Информация
___
Пользователь: {{$user->name}} <br>
Тема: {{$ticket->title}} <br>
Категория: {{ $ticket->ticketcategory->name }} <br>
Приоритет: {{ $ticket->priority }} <br>
Статус: {{ $ticket->status }} <br>

___
```
{{ $newmessage }}
```
___

Ссылка на обращение: {{ route('moderator.ticket.show', ['ticket_id' => $ticket->ticket_id]) }}

<br>
{{__('Thanks')}},<br>
{{ config('app.name') }}
@endcomponent
