<div class="form-group row align-items-center" :class="{'has-danger': errors.has('shoppingcart_id'), 'has-success': fields.shoppingcart_id && fields.shoppingcart_id.valid }">
    <label for="shoppingcart_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.order.columns.shoppingcart_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.shoppingcart_id" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('shoppingcart_id'), 'form-control-success': fields.shoppingcart_id && fields.shoppingcart_id.valid}" id="shoppingcart_id" name="shoppingcart_id" placeholder="{{ trans('admin.order.columns.shoppingcart_id') }}">
        <div v-if="errors.has('shoppingcart_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('shoppingcart_id') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('instance'), 'has-success': fields.instance && fields.instance.valid }">
    <label for="instance" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.order.columns.instance') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.instance" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('instance'), 'form-control-success': fields.instance && fields.instance.valid}" id="instance" name="instance" placeholder="{{ trans('admin.order.columns.instance') }}">
        <div v-if="errors.has('instance')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('instance') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('content'), 'has-success': fields.content && fields.content.valid }">
    <label for="content" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.order.columns.content') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <div>
            <textarea class="form-control" v-model="form.content" v-validate="'required'" id="content" name="content"></textarea>
        </div>
        <div v-if="errors.has('content')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('content') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('price_total'), 'has-success': fields.price_total && fields.price_total.valid }">
    <label for="price_total" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.order.columns.price_total') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.price_total" v-validate="'required|decimal'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('price_total'), 'form-control-success': fields.price_total && fields.price_total.valid}" id="price_total" name="price_total" placeholder="{{ trans('admin.order.columns.price_total') }}">
        <div v-if="errors.has('price_total')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('price_total') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('created_by'), 'has-success': fields.created_by && fields.created_by.valid }">
    <label for="created_by" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.order.columns.created_by') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.created_by" v-validate="'required|integer'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('created_by'), 'form-control-success': fields.created_by && fields.created_by.valid}" id="created_by" name="created_by" placeholder="{{ trans('admin.order.columns.created_by') }}">
        <div v-if="errors.has('created_by')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('created_by') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('updated_by'), 'has-success': fields.updated_by && fields.updated_by.valid }">
    <label for="updated_by" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.order.columns.updated_by') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.updated_by" v-validate="'integer'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('updated_by'), 'form-control-success': fields.updated_by && fields.updated_by.valid}" id="updated_by" name="updated_by" placeholder="{{ trans('admin.order.columns.updated_by') }}">
        <div v-if="errors.has('updated_by')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('updated_by') }}</div>
    </div>
</div>

<div class="form-check row" :class="{'has-danger': errors.has('delivered'), 'has-success': fields.delivered && fields.delivered.valid }">
    <div class="ml-md-auto" :class="isFormLocalized ? 'col-md-8' : 'col-md-10'">
        <input class="form-check-input" id="delivered" type="checkbox" v-model="form.delivered" v-validate="''" data-vv-name="delivered"  name="delivered_fake_element">
        <label class="form-check-label" for="delivered">
            {{ trans('admin.order.columns.delivered') }}
        </label>
        <input type="hidden" name="delivered" :value="form.delivered">
        <div v-if="errors.has('delivered')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('delivered') }}</div>
    </div>
</div>


