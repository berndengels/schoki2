<div class="form-group row align-items-center" :class="{'has-danger': errors.has('code'), 'has-success': fields.code && fields.code.valid }">
    <label for="code" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.country.columns.code') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.code" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('code'), 'form-control-success': fields.code && fields.code.valid}" id="code" name="code" placeholder="{{ trans('admin.country.columns.code') }}">
        <div v-if="errors.has('code')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('code') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('en'), 'has-success': fields.en && fields.en.valid }">
    <label for="en" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.country.columns.en') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.en" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('en'), 'form-control-success': fields.en && fields.en.valid}" id="en" name="en" placeholder="{{ trans('admin.country.columns.en') }}">
        <div v-if="errors.has('en')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('en') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('de'), 'has-success': fields.de && fields.de.valid }">
    <label for="de" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.country.columns.de') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.de" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('de'), 'form-control-success': fields.de && fields.de.valid}" id="de" name="de" placeholder="{{ trans('admin.country.columns.de') }}">
        <div v-if="errors.has('de')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('de') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('es'), 'has-success': fields.es && fields.es.valid }">
    <label for="es" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.country.columns.es') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.es" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('es'), 'form-control-success': fields.es && fields.es.valid}" id="es" name="es" placeholder="{{ trans('admin.country.columns.es') }}">
        <div v-if="errors.has('es')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('es') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('fr'), 'has-success': fields.fr && fields.fr.valid }">
    <label for="fr" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.country.columns.fr') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.fr" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('fr'), 'form-control-success': fields.fr && fields.fr.valid}" id="fr" name="fr" placeholder="{{ trans('admin.country.columns.fr') }}">
        <div v-if="errors.has('fr')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('fr') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('it'), 'has-success': fields.it && fields.it.valid }">
    <label for="it" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.country.columns.it') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.it" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('it'), 'form-control-success': fields.it && fields.it.valid}" id="it" name="it" placeholder="{{ trans('admin.country.columns.it') }}">
        <div v-if="errors.has('it')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('it') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('ru'), 'has-success': fields.ru && fields.ru.valid }">
    <label for="ru" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.country.columns.ru') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.ru" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('ru'), 'form-control-success': fields.ru && fields.ru.valid}" id="ru" name="ru" placeholder="{{ trans('admin.country.columns.ru') }}">
        <div v-if="errors.has('ru')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('ru') }}</div>
    </div>
</div>


