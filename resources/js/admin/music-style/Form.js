import AppForm from '../app-components/Form/AppForm';

Vue.component('music-style-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                name:  '' ,
                slug:  '' ,
                
            }
        }
    }

});