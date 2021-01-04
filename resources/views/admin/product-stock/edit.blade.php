@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.product-stock.actions.edit', ['name' => $productStock->id]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <product-stock-form
                :action="'{{ $productStock->resource_url }}'"
                :data="{{ $productStock->toJson() }}"
                :products="{{ $products->toJson() }}"
                :sizes="{{ $sizes->toJson() }}"
                v-cloak
                inline-template>

                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.product-stock.actions.edit', ['name' => $productStock->id]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.product-stock.components.form-elements')
                    </div>


                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>

                </form>

        </product-stock-form>

        </div>

</div>

@endsection
