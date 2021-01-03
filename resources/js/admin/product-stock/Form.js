import AppForm from '../app-components/Form/AppForm';

Vue.component('product-stock-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                product: '' ,
                product_size: '' ,
                stock: '' ,
            }
        }
    }
});
