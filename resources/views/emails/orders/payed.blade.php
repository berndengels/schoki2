@component('mail::layout')
@slot('header')
@component('mail::header', ['url' => config('app.url')])
<img class="logo" src="data:image/png;base64,{{ $logo }}" width="80" height="80"> {{ config('app.name') }}
@endcomponent
@endslot

# Bestellung
Kunde:
{{ $customer->name }} <a href="mailto:{{ $customer->email }}">{{ $customer->email }}</a>
{{ $customer->shipping->street }}, {{ $customer->shipping->postcode }} {{ $customer->shipping->city }}

- Summe Total: {{ $params['amount_received'] }} €
- bezahlt am: {{ date_format($params['paid_on'], 'd.m.Y H:i') . ' Uhr' ?? null }}
- bezaht über: {{ $params['payment_provider'] }}
- Payment ID: {{ $params['payment_id'] }}

# Folgende Artikel wurden bestellt
@component('mail::table')
| ID | Artikel | Stückzahl | Einzelpreis | Total |
| :--: | :------- | :---------: | :-----------: | :-----: |
@foreach($order->orderItems as $item)
| {{$item->product->id}} | {{$item->product->name}} | {{$item->quantity}} | {{$item->product->price}} € | {{$item->price_total}} € |
@endforeach
@endcomponent
### Summe Total: {{ $order->price_total + $order->porto }} € inklusive {{ $order->porto }} € Versandkosten (Porto)

@component('mail::button', ['url' => route('admin/orders/show',['order' => $order])])
Zur Bestellung
@endcomponent

@slot('footer')
@component('mail::footer')
© {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.')
@endcomponent
@endslot

@endcomponent
