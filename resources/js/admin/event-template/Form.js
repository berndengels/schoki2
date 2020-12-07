import AppForm from '../app-components/Form/AppForm';

Vue.component('event-template-form', {
    mixins: [AppForm],
    props: ['categories', 'themes'],
    data: function() {
        return {
            form: {
                theme_id:  '' ,
                category_id:  '' ,
                title:  '' ,
                subtitle:  '' ,
                description:  '' ,
                links:  '' ,
            }
        }
    }

});
