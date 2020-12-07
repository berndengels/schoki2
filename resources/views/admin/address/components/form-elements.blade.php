
<div class="form-group row align-items-center"
     :class="{'has-danger': errors.has('address_category_id'), 'has-success': this.fields.address_category_id && this.fields.address_category_id.valid }">
    <label for="address_category_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ __('Address Category') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <select
            id="address_category_id"
            name="address_category_id"
            v-model="form.address_category_id"
            class="form-control"
            v-validate="'required|integer'"
        >
            <option  value="">{{ __('Select Address Category') }}</option>
            <option v-for="item in address_categories" :key="item.id" :value="item.id">@{{ item.name }}</option>
        </select>
        <div v-if="errors.has('address_category_id')" class="form-control-feedback form-text" v-cloak>
            @{{ errors.first('address_category_id') }}
        </div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('email'), 'has-success': fields.email && fields.email.valid }">
    <label for="email" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.address.columns.email') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.email" v-validate="'required|email'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('email'), 'form-control-success': fields.email && fields.email.valid}" id="email" name="email" placeholder="{{ trans('admin.address.columns.email') }}">
        <div v-if="errors.has('email')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('email') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('token'), 'has-success': fields.token && fields.token.valid }">
    <label for="token" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.address.columns.token') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.token" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('token'), 'form-control-success': fields.token && fields.token.valid}" id="token" name="token" placeholder="{{ trans('admin.address.columns.token') }}">
        <div v-if="errors.has('token')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('token') }}</div>
    </div>
</div>

<div class="form-check row" :class="{'has-danger': errors.has('info_on_changes'), 'has-success': fields.info_on_changes && fields.info_on_changes.valid }">
    <div class="ml-md-auto" :class="isFormLocalized ? 'col-md-8' : 'col-md-10'">
        <input class="form-check-input" id="info_on_changes" type="checkbox" v-model="form.info_on_changes" v-validate="''" data-vv-name="info_on_changes"  name="info_on_changes_fake_element">
        <label class="form-check-label" for="info_on_changes">
            {{ trans('admin.address.columns.info_on_changes') }}
        </label>
        <input type="hidden" name="info_on_changes" :value="form.info_on_changes">
        <div v-if="errors.has('info_on_changes')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('info_on_changes') }}</div>
    </div>
</div>


