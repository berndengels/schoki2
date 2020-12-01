@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.music-style.actions.edit', ['name' => $musicStyle->name]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <music-style-form
                :action="'{{ $musicStyle->resource_url }}'"
                :data="{{ $musicStyle->toJson() }}"
                v-cloak
                inline-template>
            
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.music-style.actions.edit', ['name' => $musicStyle->name]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.music-style.components.form-elements')
                    </div>
                    
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>
                    
                </form>

        </music-style-form>

        </div>
    
</div>

@endsection