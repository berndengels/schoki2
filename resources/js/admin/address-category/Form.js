import AppForm from '../app-components/Form/AppForm';

Vue.component('address-category-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                tag_id:  '' ,
                name:  '' ,
                
            }
        }
    }

});