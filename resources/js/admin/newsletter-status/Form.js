import AppForm from '../app-components/Form/AppForm';

Vue.component('newsletter-status-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                name:  '' ,
                
            }
        }
    }

});