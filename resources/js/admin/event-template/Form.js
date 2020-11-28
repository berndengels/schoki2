import AppForm from '../app-components/Form/AppForm';

Vue.component('event-template-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                theme_id:  '' ,
                category_id:  '' ,
                created_by:  '' ,
                updated_by:  '' ,
                title:  '' ,
                subtitle:  '' ,
                description:  '' ,
                links:  '' ,
                
            }
        }
    }

});