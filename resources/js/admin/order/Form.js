import AppForm from '../app-components/Form/AppForm';

Vue.component('order-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                shoppingcart_id:  '' ,
                instance:  '' ,
                content:  '' ,
                price_total:  '' ,
                created_by:  '' ,
                updated_by:  '' ,
                delivered:  false ,
            }
        }
    }

});
