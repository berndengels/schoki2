@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.address-category.actions.edit', ['name' => $addressCategory->name]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <address-category-form
                :action="'{{ $addressCategory->resource_url }}'"
                :data="{{ $addressCategory->toJson() }}"
                v-cloak
                inline-template>
            
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.address-category.actions.edit', ['name' => $addressCategory->name]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.address-category.components.form-elements')
                    </div>
                    
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>
                    
                </form>

        </address-category-form>

        </div>
    
</div>

@endsection