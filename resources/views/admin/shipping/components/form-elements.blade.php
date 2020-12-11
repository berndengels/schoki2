
<div class="form-group row align-items-center" :class="{'has-danger': errors.has('customer_id'), 'has-success': fields.customer_id && fields.customer_id.valid }">
    <label for="customer_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.shipping.columns.customer_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.customer_id" v-validate="'required|integer'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('customer_id'), 'form-control-success': fields.customer_id && fields.customer_id.valid}" id="customer_id" name="customer_id" placeholder="{{ trans('admin.shipping.columns.customer_id') }}">
        <div v-if="errors.has('customer_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('customer_id') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('postcode'), 'has-success': fields.postcode && fields.postcode.valid }">
    <label for="postcode" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.shipping.columns.postcode') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.postcode" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('postcode'), 'form-control-success': fields.postcode && fields.postcode.valid}" id="postcode" name="postcode" placeholder="{{ trans('admin.shipping.columns.postcode') }}">
        <div v-if="errors.has('postcode')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('postcode') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('city'), 'has-success': fields.city && fields.city.valid }">
    <label for="city" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.shipping.columns.city') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.city" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('city'), 'form-control-success': fields.city && fields.city.valid}" id="city" name="city" placeholder="{{ trans('admin.shipping.columns.city') }}">
        <div v-if="errors.has('city')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('city') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('street'), 'has-success': fields.street && fields.street.valid }">
    <label for="street" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.shipping.columns.street') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.street" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('street'), 'form-control-success': fields.street && fields.street.valid}" id="street" name="street" placeholder="{{ trans('admin.shipping.columns.street') }}">
        <div v-if="errors.has('street')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('street') }}</div>
    </div>
</div>

<div class="form-check row" :class="{'has-danger': errors.has('is_default'), 'has-success': fields.is_default && fields.is_default.valid }">
    <div class="ml-md-auto" :class="isFormLocalized ? 'col-md-8' : 'col-md-10'">
        <input class="form-check-input" id="is_default" type="checkbox" v-model="form.is_default" v-validate="''" data-vv-name="is_default"  name="is_default_fake_element">
        <label class="form-check-label" for="is_default">
            {{ trans('admin.shipping.columns.is_default') }}
        </label>
        <input type="hidden" name="is_default" :value="form.is_default">
        <div v-if="errors.has('is_default')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('is_default') }}</div>
    </div>
</div>


