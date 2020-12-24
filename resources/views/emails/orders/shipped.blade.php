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
### Summe Total: {{ $order->price_total }} €
@component('mail::table')
| ID | Artikel | Stückzahl | Einzelpreis | Total |
| :--: | :------- | :---------: | :-----------: | :-----: |
@foreach($order->orderItems as $item)
| {{$item->product->id}} | {{$item->product->name}} | {{$item->quantity}} | {{$item->product->price}} € | {{$item->price_total}} € |
@endforeach
@endcomponent

@component('mail::button', ['url' => route('admin/orders/show',['order' => $order])])
Rechnung herunterladen
@endcomponent

@slot('footer')
@component('mail::footer')
© {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.')
@endcomponent
@endslot

@endcomponent
