import AppForm from '../app-components/Form/AppForm';

Vue.component('page-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                created_by:  '' ,
                updated_by:  '' ,
                title:  '' ,
                slug:  '' ,
                body:  '' ,
                is_published:  false ,
                
            }
        }
    }

});