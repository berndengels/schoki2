import AppForm from '../app-components/Form/AppForm';

Vue.component('news-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                end_date:  '' ,
                title:  '' ,
                text:  '' ,
                created_by:  '' ,
                updated_by:  '' ,
                show_item:  false ,
                is_published:  false ,
                
            }
        }
    }

});