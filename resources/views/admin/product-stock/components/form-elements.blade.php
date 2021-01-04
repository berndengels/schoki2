
<div class="form-group row align-items-center" :class="{'has-danger': errors.has('product_id'), 'has-success': fields.product_id && fields.product_id.valid }">
    <label for="product_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('Produkt') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <select id="product_id" name="product_id"
            v-model="form.product_id"
            class="form-control"
            v-validate="'required'"
        >
            <option  value="">Produkt wählen</option>
            <option v-for="item in products" :key="item.id" :value="item.id">@{{ item.name }}</option>
        </select>
        <div v-if="errors.has('product_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('product_id') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('product_size_id'), 'has-success': fields.product_size_id && fields.product_size_id.valid }">
    <label for="product_size_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('Größe') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <select
            id="product_size_id"
            name="product_size_id"
            v-model="form.product_size_id"
            class="form-control"
        >
            <option  value="">Größe wählen</option>
            <option v-for="item in sizes" :key="item.id" :value="item.id">@{{ item.name }}</option>
        </select>
        <div v-if="errors.has('product_size_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('product_size_id') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('stock'), 'has-success': fields.stock && fields.stock.valid }">
    <label for="stock" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.product-stock.columns.stock') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.stock" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('stock'), 'form-control-success': fields.stock && fields.stock.valid}" id="stock" name="stock" placeholder="{{ trans('admin.product-stock.columns.stock') }}">
        <div v-if="errors.has('stock')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('stock') }}</div>
    </div>
</div>


