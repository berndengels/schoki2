import AppForm from '../app-components/Form/AppForm';

Vue.component('customer-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                name:  '' ,
                email:  '' ,
                email_verified_at:  '' ,
                password:  '' ,
                stripe_id:  '' ,
                card_brand:  '' ,
                card_last_four:  '' ,
                trial_ends_at:  '' ,
                
            }
        }
    }

});