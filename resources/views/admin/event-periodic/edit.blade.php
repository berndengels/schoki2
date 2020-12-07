@extends('admin.layout.default')

@section('title', trans('admin.event-periodic.actions.edit', ['name' => $eventPeriodic->title]))
@section('body')
    <div class="container-xl">
        <div class="card">
            <event-periodic-form
                :action="'{{ $eventPeriodic->resource_url }}'"
                :data="{{ $eventPeriodic->toJson() }}"
                :categories="{{ $categories->toJson() }}"
                :themes="{{ $themes->toJson() }}"
                :periodic_positions="{{ $periodicPositions->toJson() }}"
                :periodic_weekdays="{{ $periodicWeekdays->toJson() }}"
                v-cloak
                inline-template>
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action"
                      novalidate>
                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.event-periodic.actions.edit', ['name' => $eventPeriodic->title]) }}
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
