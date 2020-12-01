
<div class="form-check row" :class="{'has-danger': errors.has('is_published'), 'has-success': fields.is_published && fields.is_published.valid }">
    <div class="ml-md-auto" :class="isFormLocalized ? 'col-md-8' : 'col-md-10'">
        <input class="form-check-input" id="is_published" type="checkbox" v-model="form.is_published" v-validate="''" data-vv-name="is_published"  name="is_published_fake_element">
        <label class="form-check-label" for="is_published">
            {{ trans('admin.event.columns.is_published') }}
        </label>
        <input type="hidden" name="is_published" :value="form.is_published">
        <div v-if="errors.has('is_published')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('is_published') }}</div>
    </div>
</div>

<div class="form-group row align-items-center"
     :class="{'has-danger': errors.has('theme_id'), 'has-success': this.fields.theme_id && this.fields.theme_id.valid }">
    <label for="theme_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ __('Theme') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <select id="theme_id" name="theme_id"
                v-model="form.theme_id"
                class="form-control"
                v-validate="''"
        >
            <option  value="">{{ __('Select Theme') }}</option>
            <option v-for="item in themes" :key="item.id" :value="item.id">@{{ item.name }}</option>
        </select>
        <div v-if="errors.has('theme_id')" class="form-control-feedback form-text" v-cloak>
            @{{ errors.first('theme_id') }}
        </div>
    </div>
</div>

<div class="form-group row align-items-center"
     :class="{'has-danger': errors.has('category_id'), 'has-success': this.fields.category_id && this.fields.category_id.valid }">
    <label for="category_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ __('Category') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <select id="category_id" name="category_id"
            v-model="form.category_id"
            class="form-control"
            v-validate="'required'"
            :class="{'form-control-danger': errors.has('category_id'), 'form-control-success': fields.category_id && fields.category_id.valid}"
        >
            <option value="">{{ __('Select Category') }}</option>
            <option v-for="item in categories" :key="item.id" :value="item.id">@{{ item.name }}</option>
        </select>
        <div v-if="errors.has('category_id')" class="form-control-feedback form-text" v-cloak>
            @{{ errors.first('category_id') }}
        </div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('title'), 'has-success': fields.title && fields.title.valid }">
    <label for="title" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.event.columns.title') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.title" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('title'), 'form-control-success': fields.title && fields.title.valid}" id="title" name="title" placeholder="{{ trans('admin.event.columns.title') }}">
        <div v-if="errors.has('title')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('title') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('subtitle'), 'has-success': fields.subtitle && fields.subtitle.valid }">
    <label for="subtitle" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.event.columns.subtitle') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.subtitle" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('subtitle'), 'form-control-success': fields.subtitle && fields.subtitle.valid}" id="subtitle" name="subtitle" placeholder="{{ trans('admin.event.columns.subtitle') }}">
        <div v-if="errors.has('subtitle')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('subtitle') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('description'), 'has-success': fields.description && fields.description.valid }">
    <label for="description" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.event.columns.description') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <div>
            <wysiwyg v-model="form.description" v-validate="'required'" id="description" name="description" :config="mediaWysiwygConfig"></wysiwyg>
        </div>
        <div v-if="errors.has('description')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('description') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('links'), 'has-success': fields.links && fields.links.valid }">
    <label for="links" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.event.columns.links') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <div>
            <textarea class="form-control" v-model="form.links" v-validate="'nullable|string'" id="links" name="links"></textarea>
        </div>
        <div v-if="errors.has('links')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('links') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('event_date'), 'has-success': fields.event_date && fields.event_date.valid }">
    <label for="event_date" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.event.columns.event_date') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-sm-8'">
        <div class="input-group input-group--custom">
            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
            <datetime v-model="form.event_date" :config="datePickerConfig" v-validate="'required'" class="flatpickr" :class="{'form-control-danger': errors.has('event_date'), 'form-control-success': fields.event_date && fields.event_date.valid}" id="event_date" name="event_date" placeholder="{{ trans('brackets/admin-ui::admin.forms.select_a_date') }}"></datetime>
        </div>
        <div v-if="errors.has('event_date')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('event_date') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('event_time'), 'has-success': fields.event_time && fields.event_time.valid }">
    <label for="event_time" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.event.columns.event_time') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <div class="input-group input-group--custom">
            <div class="input-group-addon"><i class="fa fa-clock-o"></i></div>
            <datetime
                id="event_time"
                name="event_time"
                class="flatpickr"
                v-model="form.event_time"
                v-validate="'required|date_format:HH:mm:ss'"
                :config="timePickerConfig"
                :class="{'form-control-danger': errors.has('event_time'), 'form-control-success': fields.event_time && fields.event_time.valid}"
                placeholder="{{ trans('brackets/admin-ui::admin.forms.select_a_time') }}"
            ></datetime>
        </div>
        <div v-if="errors.has('event_time')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('event_time') }}</div>
    </div>
</div>


<div class="form-group row align-items-center" :class="{'has-danger': errors.has('price'), 'has-success': fields.price && fields.price.valid }">
    <label for="price" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.event.columns.price') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.price" v-validate="'decimal'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('price'), 'form-control-success': fields.price && fields.price.valid}" id="price" name="price" placeholder="{{ trans('admin.event.columns.price') }}">
        <div v-if="errors.has('price')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('price') }}</div>
    </div>
</div>

@include('brackets/admin-ui::admin.includes.media-uploader', [
    'id'    => 'images',
    'name'  => 'images',
    'mediaCollection' => app(App\Models\Event::class)->getMediaCollection('images'),
    'media' => $event->getThumbs200ForCollection('images'),
    'label' => 'Images'
])
