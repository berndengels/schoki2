import AppForm from '../app-components/Form/AppForm';

Vue.component('product-stock-form', {
    mixins: [AppForm],
    props: ['products','sizes'],
    data: function() {
        return {
            form: {
                product_id: '',
                product_size_id: '',
                stock: '',
            }
        }
    }
});
