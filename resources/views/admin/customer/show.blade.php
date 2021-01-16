@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('Customer', ['name' => $customer->name]))
@section('body')
    <div class="container-xl">
        <h3>{{ $customer->name }}, <a href="mailto:{{ $customer->email }}">{{ $customer->email }}</a></h3>
        <div class="card">
            <div class="p-2 pb-0">
                <h5>Default Adresse</h5>
                <div>
                    <p>
                        {{ $customer->shipping->street }}, {{ $customer->shipping->postcode }} {{ $customer->shipping->city }}
                    </p>
                </div>
            </div>
            @if($invoices && $invoices->count() > 0)
            <h3 class="mx-2">Rechnungen</h3>
            <table class="table table-striped table-borderless">
                <tr>
                    <th>ID</th>
                    <th>Erstellt</th>
                    <th>Ausstehend</th>
                    <th>Bezahlt</th>
                    <th>Artikel</th>
                    <th>Download</th>
                </tr>
                @foreach ($invoices as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ date('d.m.Y H:i', $item->created) }}</td>
                        <td>{{ $item->amount_due/100 }} €</td>
                        <td>{{ $item->amount_paid/100 }} €</td>
                        <td>
                            <table class="table-sm">
                                <tr>
                                    <th>Name</th>
                                    <th>Anzahl</th>
                                    <th>Preis</th>
                                    <th>Total</th>
                                </tr>
                                @foreach($item->lines['data'] as $data)
                                <tr>
                                    <td>{{ $data->description }}</td>
                                    <td>{{ $data->quantity }}</td>
                                    <td>{{ $data->price->unit_amount/100 }} €</td>
                                    <td>{{ $data->amount/100 }} €</td>
                                </tr>
                                @endforeach
                            </table>
                        </td>
                        <td><a href="{{ route('admin/customers/invoice', ['customer' => $customer,'invoiceId' => $item->id]) }}">Download</a></td>
                    </tr>
                @endforeach
            </table>
            @else
                <h3>Keine Rechnungen vorhanden</h3>
            @endif
        </div>
</div>
@endsection
