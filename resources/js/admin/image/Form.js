//import AppForm from '../app-components/Form/AppForm';

Vue.component('image-form', {
    name: 'ImageForm',
//    mixins: [AppForm],
    props: ['event','theme','event_periodic','event_template']
,   data: function() {
        return {
            form: {
                internal_filename:  '' ,
                title:  '' ,
            }
        }
    }
});
