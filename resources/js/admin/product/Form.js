import AppForm from '../app-components/Form/AppForm';

Vue.component('product-form', {
    mixins: [AppForm],
    data: function() {
        return {
            mediaCollections: ['product_images'],
            form: {
                name:  '' ,
                description:  '' ,
                price:  '' ,
                is_published:  false ,
                is_available:  false ,
                created_by:  '' ,
                updated_by:  '' ,
                sizes: [],
            }
        }
    }

});
