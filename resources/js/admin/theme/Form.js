import AppForm from '../app-components/Form/AppForm';

Vue.component('theme-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                name:  '' ,
                slug:  '' ,
                icon:  '' ,
                
            }
        }
    }

});