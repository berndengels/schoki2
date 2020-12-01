<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-title">{{ trans('brackets/admin-ui::admin.sidebar.content') }}</li>
            @can('event.index')
                <li class="nav-item"><a class="nav-link" href="{{ url('admin/events') }}"><i class="nav-icon icon-compass"></i> {{ trans('admin.event.title') }}</a></li>
            @endcan
            @can('event-template.index')
                <li class="nav-item"><a class="nav-link" href="{{ url('admin/event-templates') }}"><i class="nav-icon icon-plane"></i> {{ trans('admin.event-template.title') }}</a></li>
            @endcan
            @can('event-periodic.index')
                <li class="nav-item"><a class="nav-link" href="{{ url('admin/event-periodics') }}"><i class="nav-icon icon-compass"></i> {{ trans('admin.event-periodic.title') }}</a></li>
            @endcan
            @can('category.index')
                <li class="nav-item"><a class="nav-link" href="{{ url('admin/categories') }}"><i class="nav-icon icon-compass"></i> {{ trans('admin.category.title') }}</a></li>
            @endcan
            @can('theme.index')
                <li class="nav-item"><a class="nav-link" href="{{ url('admin/themes') }}"><i class="nav-icon icon-ghost"></i> {{ trans('admin.theme.title') }}</a></li>
            @endcan
            @can('page.index')
                <li class="nav-item"><a class="nav-link" href="{{ url('admin/pages') }}"><i class="nav-icon icon-diamond"></i> {{ trans('admin.page.title') }}</a></li>
            @endcan

            <li class="nav-item"><a class="nav-link" href="{{ url('admin/customers') }}"><i class="nav-icon icon-ghost"></i> {{ __('Customers') }}</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/address-categories') }}"><i class="nav-icon icon-drop"></i> {{ trans('admin.address-category.title') }}</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/addresses') }}"><i class="nav-icon icon-globe"></i> {{ trans('admin.address.title') }}</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/music-styles') }}"><i class="nav-icon icon-plane"></i> {{ trans('admin.music-style.title') }}</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/messages') }}"><i class="nav-icon icon-book-open"></i> {{ trans('admin.message.title') }}</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/news') }}"><i class="nav-icon icon-compass"></i> {{ trans('admin.news.title') }}</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/menus') }}"><i class="nav-icon icon-plane"></i> {{ trans('admin.menu.title') }}</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/newsletter-statuses') }}"><i class="nav-icon icon-drop"></i> {{ trans('admin.newsletter-status.title') }}</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/newsletters') }}"><i class="nav-icon icon-flag"></i> {{ trans('admin.newsletter.title') }}</a></li>
           {{-- Do not delete me :) I'm used for auto-generation menu items --}}

            <li class="nav-title">{{ trans('brackets/admin-ui::admin.sidebar.settings') }}</li>
            <li class="nav-item"><a class="nav-link" href="{{ url('admin/admin-users') }}"><i class="nav-icon icon-user"></i> {{ __('Manage access') }}</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('admin/roles') }}"><i class="nav-icon icon-plane"></i> {{ trans('admin.role.title') }}</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('admin/permissions') }}"><i class="nav-icon icon-book-open"></i> {{ trans('admin.permission.title') }}</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('admin/translations') }}"><i class="nav-icon icon-location-pin"></i> {{ __('Translations') }}</a></li>
            {{-- Do not delete me :) I'm also used for auto-generation menu items --}}
            <li class="nav-item"><a class="nav-link" href="{{ url('admin/configuration') }}"><i class="nav-icon icon-settings"></i> {{ __('Configuration') }}</a></li>
        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>
