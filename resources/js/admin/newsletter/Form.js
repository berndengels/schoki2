import AppForm from '../app-components/Form/AppForm';

Vue.component('newsletter-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                tag_id:  '' ,
                created_by:  '' ,
                updated_by:  '' ,
                
            }
        }
    }

});