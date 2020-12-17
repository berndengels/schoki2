import AppForm from '../app-components/Form/AppForm';

Vue.component('shipping-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                customer_id:  '',
                postcode:  '',
                city:  '',
                street:  '',
                is_default:  false,
            }
        }
    }
});
