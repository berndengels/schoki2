@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.news.actions.edit', ['name' => $news->title]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <news-form
                :action="'{{ $news->resource_url }}'"
                :data="{{ $news->toJson() }}"
                v-cloak
                inline-template>
            
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.news.actions.edit', ['name' => $news->title]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.news.components.form-elements')
                    </div>
                    
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>
                    
                </form>

        </news-form>

        </div>
    
</div>

@endsection