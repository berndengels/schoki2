@extends('admin.layout.default')

@section('title', trans('admin.event-periodic.actions.create'))
@section('body')
    <div class="container-xl">
        <div class="card">
            <event-periodic-form
                :action="'{{ url('admin/event-periodics') }}'"
                :categories="{{ $categories->toJson() }}"
                :themes="{{ $themes->toJson() }}"
                :periodic_positions="{{ $periodicPositions->toJson() }}"
                :periodic_weekdays="{{ $periodicWeekdays->toJson() }}"
                v-cloak
                inline-template
            >
                <form class="form-horizontal form-create" method="post" @submit.prevent="onSubmit" :action="action"
                      novalidate>
                    <div class="card-header">
                        <i class="fa fa-plus"></i> {{ trans('admin.event-periodic.actions.create') }}
                    </div>
                    <div class="card-body">
                        @include('admin.event-periodic.components.form-elements')
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>
                </form>
            </event-periodic-form>
        </div>
    </div>
@endsection
