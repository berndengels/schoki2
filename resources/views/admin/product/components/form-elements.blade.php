
<div class="form-check row" :class="{'has-danger': errors.has('is_published'), 'has-success': fields.is_published && fields.is_published.valid }">
    <div class="ml-md-auto" :class="isFormLocalized ? 'col-md-8' : 'col-md-10'">
        <input class="form-check-input" id="is_published" type="checkbox" v-model="form.is_published" v-validate="''" data-vv-name="is_published"  name="is_published_fake_element">
        <label class="form-check-label" for="is_published">
            {{ trans('admin.product.columns.is_published') }}
        </label>
        <input type="hidden" name="is_published" :value="form.is_published">
        <div v-if="errors.has('is_published')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('is_published') }}</div>
    </div>
</div>

<div class="form-check row" :class="{'has-danger': errors.has('is_available'), 'has-success': fields.is_available && fields.is_available.valid }">
    <div class="ml-md-auto" :class="isFormLocalized ? 'col-md-8' : 'col-md-10'">
        <input class="form-check-input" id="is_available" type="checkbox" v-model="form.is_available" v-validate="''" data-vv-name="is_available"  name="is_available_fake_element">
        <label class="form-check-label" for="is_available">
            {{ trans('admin.product.columns.is_available') }}
        </label>
        <input type="hidden" name="is_available" :value="form.is_available">
        <div v-if="errors.has('is_available')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('is_available') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('name'), 'has-success': fields.name && fields.name.valid }">
    <label for="name" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.product.columns.name') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.name" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('name'), 'form-control-success': fields.name && fields.name.valid}" id="name" name="name" placeholder="{{ trans('admin.product.columns.name') }}">
        <div v-if="errors.has('name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('name') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('description'), 'has-success': fields.description && fields.description.valid }">
    <label for="description" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.product.columns.description') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <div>
            <wysiwyg v-model="form.description" v-validate="'required'" id="description" name="description" :config="mediaWysiwygConfig"></wysiwyg>
        </div>
        <div v-if="errors.has('description')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('description') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('price'), 'has-success': fields.price && fields.price.valid }">
    <label for="price" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.product.columns.price') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.price" v-validate="'required|decimal'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('price'), 'form-control-success': fields.price && fields.price.valid}" id="price" name="price" placeholder="{{ trans('admin.product.columns.price') }}">
        <div v-if="errors.has('price')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('price') }}</div>
    </div>
</div>

@can('Shop')
    <div class="form-group row align-items-center" :class="{'has-danger': errors.has('sizes'), 'has-success': fields.sizes && fields.sizes.valid }">
        <label for="sizes" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">Größen</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
            <multiselect
                id="sizes"
                name="sizes"
                v-model="form.sizes"
                placeholder="{{ trans('bitte wählen') }}"
                label="name"
                track-by="id"
                :options="{{ $sizes->toJson() }}"
                :multiple="true"
                open-direction="bottom">
            </multiselect>
            <div v-if="errors.has('sizes')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('sizes') }}</div>
        </div>
    </div>
@endcan

@if( isset($product) )
    @include('brackets/admin-ui::admin.includes.media-uploader', [
        'id'    => 'product_images',
        'name'  => 'product_images',
        'label' => 'Images',
        'mediaCollection' => app(App\Models\Product::class)->getMediaCollection('product_images'),
        'media' => $product->getThumbs200ForCollection('product_images'),
    ])
@else
    @include('brackets/admin-ui::admin.includes.media-uploader', [
        'id'    => 'product_images',
        'name'  => 'product_images',
        'label' => 'Images',
        'mediaCollection' => app(App\Models\Product::class)->getMediaCollection('product_images'),
    ])
@endif
