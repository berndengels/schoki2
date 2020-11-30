@extends('admin.layout.default')

@section('title', trans('admin.event.actions.index'))

@section('body')

    <event-listing
        :data="{{ $data->toJson() }}"
        :url="'{{ url('admin/events') }}'"
        :categories="{{ $categories->toJson() }}"
        :themes="{{ $themes->toJson() }}"
        inline-template
    >

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> {{ trans('admin.event.actions.index') }}
                        <a class="btn btn-primary btn-sm pull-right m-b-0 ml-2" href="{{ url('admin/events/export') }}" role="button"><i class="fa fa-file-excel-o"></i>&nbsp; {{ trans('admin.event.actions.export') }}</a>
                        <a class="btn btn-primary btn-spinner btn-sm pull-right m-b-0" href="{{ url('admin/events/create') }}" role="button"><i class="fa fa-plus"></i>&nbsp; {{ trans('admin.event.actions.create') }}</a>
                    </div>
                    <div class="card-body" v-cloak>
                        <div class="card-block">
                            <form @submit.prevent="">
                                <div class="row justify-content-md-between">

                                    <div class="row" v-if="showCategoryFilter">
                                        <div class="col-sm-auto form-group">
                                            <p>{{ __('Select category') }}</p>
                                        </div>
                                        <div class="col form-group">
                                            <select
                                                id="categories"
                                                name="categories"
                                                class="form-control"
                                                v-model="categorySelect"
                                            >
                                                <option value="">{{ __('Type to search a category') }}</option>
                                                <option v-for="item in categories" :key="item.id" :value="item.id">
                                                    @{{ item.name }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row" v-if="showThemeFilter">
                                        <div class="col-sm-auto form-group">
                                            <p>{{ __('Select theme') }}</p>
                                        </div>
                                        <div class="col col-lg-12 col-xl-12 form-group">
                                            <select
                                                    id="themes"
                                                    name="themes"
                                                    class="form-control"
                                                    v-model="themeSelect"
                                            >
                                                <option value="">{{ __('Type to search a theme') }}</option>
                                                <option v-for="item in themes" :key="item.id" :value="item.id">
                                                    @{{ item.name }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col col-lg-7 col-xl-5 form-group">
                                        <div class="input-group">
                                            <input class="form-control" placeholder="{{ trans('brackets/admin-ui::admin.placeholder.search') }}" v-model="search" @keyup.enter="filter('search', $event.target.value)" />
                                            <span class="input-group-append">
                                                <button type="button" class="btn btn-primary" @click="filter('search', search)"><i class="fa fa-search"></i>&nbsp; {{ trans('brackets/admin-ui::admin.btn.search') }}</button>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-auto form-group ">
                                        <select class="form-control" v-model="pagination.state.per_page">
                                            <option value="10">10</option>
                                            <option value="25">25</option>
                                            <option value="100">100</option>
                                        </select>
                                    </div>
                                </div>
                            </form>

                            <table class="table table-hover table-listing">
                                <thead>
                                    <tr>
                                        <th class="bulk-checkbox">
                                            <input class="form-check-input" id="enabled" type="checkbox" v-model="isClickedAll" v-validate="''" data-vv-name="enabled"  name="enabled_fake_element" @click="onBulkItemsClickedAllWithPagination()">
                                            <label class="form-check-label" for="enabled">
                                                #
                                            </label>
                                        </th>

                                        <th is='sortable' :column="'id'">{{ trans('admin.event.columns.id') }}</th>
                                        <th is='sortable' :column="'theme_id'">{{ trans('admin.event.columns.theme_id') }}</th>
                                        <th is='sortable' :column="'category_id'">{{ trans('admin.event.columns.category_id') }}</th>
                                        <th is='sortable' :column="'created_by'">{{ trans('admin.event.columns.created_by') }}</th>
                                        <th is='sortable' :column="'updated_by'">{{ trans('admin.event.columns.updated_by') }}</th>
                                        <th is='sortable' :column="'title'">{{ trans('admin.event.columns.title') }}</th>
                                        <th is='sortable' :column="'subtitle'">{{ trans('admin.event.columns.subtitle') }}</th>
                                        <th is='sortable' :column="'event_date'">{{ trans('admin.event.columns.event_date') }}</th>
                                        <th is='sortable' :column="'event_time'">{{ trans('admin.event.columns.event_time') }}</th>
                                        <th is='sortable' :column="'price'">{{ trans('admin.event.columns.price') }}</th>
                                        <th is='sortable' :column="'is_published'">{{ trans('admin.event.columns.is_published') }}</th>
                                        <th is='sortable' :column="'is_periodic'">{{ trans('admin.event.columns.is_periodic') }}</th>

                                        <th></th>
                                    </tr>
                                    <tr v-show="(clickedBulkItemsCount > 0) || isClickedAll">
                                        <td class="bg-bulk-info d-table-cell text-center" colspan="14">
                                            <span class="align-middle font-weight-light text-dark">{{ trans('brackets/admin-ui::admin.listing.selected_items') }} @{{ clickedBulkItemsCount }}.  <a href="#" class="text-primary" @click="onBulkItemsClickedAll('/admin/events')" v-if="(clickedBulkItemsCount < pagination.state.total)"> <i class="fa" :class="bulkCheckingAllLoader ? 'fa-spinner' : ''"></i> {{ trans('brackets/admin-ui::admin.listing.check_all_items') }} @{{ pagination.state.total }}</a> <span class="text-primary">|</span> <a
                                                        href="#" class="text-primary" @click="onBulkItemsClickedAllUncheck()">{{ trans('brackets/admin-ui::admin.listing.uncheck_all_items') }}</a>  </span>

                                            <span class="pull-right pr-2">
                                                <button class="btn btn-sm btn-danger pr-3 pl-3" @click="bulkDelete('/admin/events/bulk-destroy')">{{ trans('brackets/admin-ui::admin.btn.delete') }}</button>
                                            </span>

                                        </td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(item, index) in collection" :key="item.id" :class="bulkItems[item.id] ? 'bg-bulk' : ''">
                                        <td class="bulk-checkbox">
                                            <input class="form-check-input" :id="'enabled' + item.id" type="checkbox" v-model="bulkItems[item.id]" v-validate="''" :data-vv-name="'enabled' + item.id"  :name="'enabled' + item.id + '_fake_element'" @click="onBulkItemClicked(item.id)" :disabled="bulkCheckingAllLoader">
                                            <label class="form-check-label" :for="'enabled' + item.id">
                                            </label>
                                        </td>

                                    <td>@{{ item.id }}</td>
                                        <td>@{{ item.theme ? item.theme.name : null }}</td>
                                        <td>@{{ item.category.name }}</td>
                                        <td>@{{ item.created_by.full_name }}</td>
                                        <td>@{{ item.updated_by ? item.updated_by.full_name : null }}</td>
                                        <td v-html="item.title"></td>
                                        <td>@{{ item.subtitle }}</td>
                                        <td>@{{ item.event_date | date('DD.MM.Y') }}</td>
                                        <td>@{{ item.event_time | time('HH.mm') }}</td>
                                        <td>@{{ item.price }}</td>
                                        <td>
                                            <label class="switch switch-3d switch-success">
                                                <input type="checkbox" class="switch-input" v-model="collection[index].is_published" @change="toggleSwitch(item.resource_url, 'is_published', collection[index])">
                                                <span class="switch-slider"></span>
                                            </label>
                                        </td>
                                        <td>
                                            <div class="row no-gutters">
                                                <div class="col-auto">
                                                    <a class="btn btn-sm btn-spinner btn-info" :href="item.resource_url + '/edit'" title="{{ trans('brackets/admin-ui::admin.btn.edit') }}" role="button"><i class="fa fa-edit"></i></a>
                                                </div>
                                                <form class="col" @submit.prevent="deleteItem(item.resource_url)">
                                                    <button type="submit" class="btn btn-sm btn-danger" title="{{ trans('brackets/admin-ui::admin.btn.delete') }}"><i class="fa fa-trash-o"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="row" v-if="pagination.state.total > 0">
                                <div class="col-sm">
                                    <span class="pagination-caption">{{ trans('brackets/admin-ui::admin.pagination.overview') }}</span>
                                </div>
                                <div class="col-sm-auto">
                                    <pagination></pagination>
                                </div>
                            </div>

                            <div class="no-items-found" v-if="!collection.length > 0">
                                <i class="icon-magnifier"></i>
                                <h3>{{ trans('brackets/admin-ui::admin.index.no_items') }}</h3>
                                <p>{{ trans('brackets/admin-ui::admin.index.try_changing_items') }}</p>
                                <a class="btn btn-primary btn-spinner" href="{{ url('admin/events/create') }}" role="button"><i class="fa fa-plus"></i>&nbsp; {{ trans('admin.event.actions.create') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </event-listing>

@endsection
