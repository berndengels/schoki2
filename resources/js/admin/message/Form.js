import AppForm from '../app-components/Form/AppForm';

Vue.component('message-form', {
    mixins: [AppForm],
    props: ['music_styles'],
    data: function() {
        return {
            music_style: '',
            form: {
                music_style_id:  '' ,
                email:  '' ,
                name:  '' ,
                message:  '' ,
            }
        }
    }

});
