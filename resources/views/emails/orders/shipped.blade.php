@component('mail::layout')
@slot('header')
@component('mail::header', ['url' => config('app.url')])
<img class="logo" src="data:image/png;base64,{{ $logo }}" width="80" height="80"> {{ config('app.name') }}
@endcomponent
@endslot

# Schokoladen Berlin-Mitte Bestellung
Hallo {{ $customer->name }} <a href="mailto:{{ $customer->email }}">{{ $customer->email }}</a>
Wir übersenden an folgende Adresse Deine bestellten Artikel
{{ $customer->shipping->street }}, {{ $customer->shipping->postcode }} {{ $customer->shipping->city }}

# Folgende Artikel wurden bestellt
@component('mail::table')
| ID | Artikel | Stückzahl | Einzelpreis | Total |
| :--: | :------- | :---------: | :-----------: | :-----: |
@foreach($order->orderItems as $item)
| {{$item->product->id}} | {{$item->product->name}} | {{$item->quantity}} | {{$item->product->price}} € | {{$item->price_total}} € |
@endforeach
@endcomponent
### Summe Total: {{ $order->price_total + $order->porto }} € inklusive {{ $order->porto }} € Versandkosten (Porto)

@component('mail::button', ['url' => route('payment.invoice.download', ['token' => $token])])
Rechnung herunterladen
@endcomponent

@slot('footer')
@component('mail::footer')
Danke für Deine Bestellung
© {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.')
@endcomponent
@endslot

@endcomponent
