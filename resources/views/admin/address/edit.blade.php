@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.address.actions.edit', ['name' => $address->email]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <address-form
                :action="'{{ $address->resource_url }}'"
                :data="{{ $address->toJson() }}"
                :address_categories="{{ $addressCategories->toJson() }}"
                v-cloak
                inline-template>

                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.address.actions.edit', ['name' => $address->email]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.address.components.form-elements')
                    </div>


                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>

                </form>

        </address-form>

        </div>

</div>

@endsection
