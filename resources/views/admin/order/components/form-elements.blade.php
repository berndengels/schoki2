
<div class="form-group row align-items-center" :class="{'has-danger': errors.has('amount_received'), 'has-success': fields.amount_received && fields.amount_received.valid }">
    <label for="amount_received" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">Betrag erhalten</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input disabled type="text" v-model="form.amount_received" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('amount_received'), 'form-control-success': fields.amount_received && fields.amount_received.valid}" id="amount_received" name="amount_received" placeholder="{{ trans('admin.order.columns.amount_received') }}">
        <div v-if="errors.has('amount_received')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('amount_received') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('created_by'), 'has-success': fields.created_by && fields.created_by.valid }">
    <label for="created_by" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">Kunde</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input disabled type="text" v-model="form.created_by.name" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('created_by'), 'form-control-success': fields.created_by && fields.created_by.valid}" id="created_by" name="created_by" placeholder="{{ trans('admin.order.columns.created_by') }}">
        <div v-if="errors.has('created_by')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('created_by') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('created_by'), 'has-success': fields.created_by && fields.created_by.valid }">
    <label for="created_by" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'"></label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input disabled type="text" v-model="form.created_by.email" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('created_by'), 'form-control-success': fields.created_by && fields.created_by.valid}" id="created_by" name="created_by" placeholder="{{ trans('admin.order.columns.created_by') }}">
        <div v-if="errors.has('created_by')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('created_by') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('delivered_on'), 'has-success': fields.delivered_on && fields.delivered_on.valid }">
    <label for="delivered_on" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">ausgeliefert am</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-sm-8'">
        <div class="input-group input-group--custom">
            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
            <datetime
                id="delivered_on"
                name="delivered_on"
                v-model="form.delivered_on"
                class="flatpickr"
                :config="timePickerConfig"
                :class="{'form-control-danger': errors.has('delivered_on'), 'form-control-success': fields.delivered_on && fields.delivered_on.valid}"
                placeholder="Datum/Uhrzeit wählen"
            >
            </datetime>
        </div>
        <div v-if="errors.has('delivered_on')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('delivered_on') }}</div>
    </div>
</div>
