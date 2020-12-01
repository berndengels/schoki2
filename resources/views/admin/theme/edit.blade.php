@extends('admin.layout.default')

@section('title', trans('admin.theme.actions.edit', ['name' => $theme->name]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <theme-form
                :action="'{{ $theme->resource_url }}'"
                :data="{{ $theme->toJson() }}"
                v-cloak
                inline-template>

                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.theme.actions.edit', ['name' => $theme->name]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.theme.components.form-elements')
                    </div>


                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>

                </form>

        </theme-form>

        </div>

</div>

@endsection
