import AppForm from '../app-components/Form/AppForm';

Vue.component('message-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                music_style_id:  '' ,
                email:  '' ,
                name:  '' ,
                message:  '' ,
                
            }
        }
    }

});