
<div class="form-group row align-items-center" :class="{'has-danger': errors.has('internal_filename'), 'has-success': fields.internal_filename && fields.internal_filename.valid }">
    <label for="internal_filename" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.image.columns.internal_filename') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="file" v-model="form.internal_filename" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('internal_filename'), 'form-control-success': fields.internal_filename && fields.internal_filename.valid}" id="internal_filename" name="internal_filename" placeholder="{{ trans('admin.image.columns.internal_filename') }}">
        <div v-if="errors.has('internal_filename')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('internal_filename') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('title'), 'has-success': fields.title && fields.title.valid }">
    <label for="title" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.image.columns.title') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.title" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('title'), 'form-control-success': fields.title && fields.title.valid}" id="title" name="title" placeholder="{{ trans('admin.image.columns.title') }}">
        <div v-if="errors.has('title')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('title') }}</div>
    </div>
</div>


