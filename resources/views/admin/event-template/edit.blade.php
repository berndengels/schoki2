@extends('admin.layout.default')

@section('title', trans('admin.event-template.actions.edit', ['name' => $eventTemplate->title]))
@section('body')
    <div class="container-xl">
        <div class="card">
            <event-template-form
                :action="'{{ $eventTemplate->resource_url }}'"
                :data="{{ $eventTemplate->toJson() }}"
                :categories="{{ $categories->toJson() }}"
                :themes="{{ $themes->toJson() }}"
                v-cloak
                inline-template
            >
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action"
                      novalidate>
                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.event-template.actions.edit', ['name' => $eventTemplate->title]) }}
                    </div>
                    <div class="card-body">
                        @include('admin.event-template.components.form-elements')
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>
                </form>
            </event-template-form>
        </div>
    </div>
@endsection
