@extends('layouts.public')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header row">@lang('Order Products')</div>
                <div class="card-body row p-0 justify-content-center">
                <table class="table product-list">
                    @foreach($data as $item)
                        <tr>
                            <form class="shop d-inline"
                                  action="{{ route('public.scard.add', ['product' => $item]) }}"
                                  method="post"
                            >
                            @csrf
                        <td>
                            @if($item->thumb)
                            <img
                                 src="{{ asset($item->thumb)}}"
                                 alt="{{ $item->name }}"
                                 title="{{ $item->name }}"
                            />
                            @else
                            <br>
                            @endif
                        </td>
                        <td><a href="{{ route('public.product.show', ['product' => $item]) }}">{{ $item->name }}</a></td>
                        <td>
                            @if($item->hasSize)
                                Größe wählen: &nbsp;
                                <select
                                    name="size"
                                    class="size-select no-scroll"
                                    size="{{ $item->sizes->count() }}"
                                    multiple
                                    required
                                >
                                    @foreach($item->sizes as $size)
                                        <option value="{{ $size }}"
                                            @if($found = $item->cartItems->firstWhere('id', $item->id.'-'.$size))
                                            selected
                                            @endif
                                        >{{ $size }}</option>
                                    @endforeach
                                </select>
                            @else
                            <br>
                            @endif
                        </td>
                        <td>{{ $item->price }} €</td>
                        <td>
                            <button class="form-control btn btn-primary d-inline-block" type="submit">
                                <i class="d-inline-block float-left fas fa-shopping-cart mr-2"></i>
                                @lang('Add')
                                @if($item->cartItems)
                                    ({{ $item->cartItems->sum('qty')}})
                                @endif
                            </button>
                        </td>
                        </form>
                    </tr>
                    @endforeach
                </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('inline-scripts')
<script>
    $('.size').change(e => {
        let $this = $(e.target),
            val = $this.val();
        $this.addClass('active').siblings('option').removeClass('active');
    })
</script>
@endsection

@section('extra-headers')
<style type="text/css">
select.size-select {
    display: inline;
    overflow: hidden;
    overflow-y: auto;
    border: none;
    width: auto;
    height: 1.5rem;
    background-color: transparent;
    margin: auto;
    padding: 0;
    scrollbar-width: none; /*For Firefox*/;
    -ms-overflow-style: none;  /*For Internet Explorer 10+*/;
}
select.size-select option {
    display: inline-block !important;
    width: 2.0rem;
    height: 1.5rem;
    float: left !important;
    clear: none !important;
    color: #fff !important;
    margin: 0 0.2rem;
    line-height: 1.5rem;
    background-color: transparent;
    border: 1px solid #fff;
    border-radius: 0.1rem;
    text-align: center;
    vertical-align: middle;
    cursor: pointer;
}
select.size-select option:hover,
select.size-select option:selected {
    background-color: #fee934;
    color: #a00 !important;
}

</style>
@endsection
