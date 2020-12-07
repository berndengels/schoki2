import AppForm from '../app-components/Form/AppForm';

Vue.component('address-form', {
    mixins: [AppForm],
    props: ['address_categories'],
    data: function() {
        return {
            form: {
                address_category_id:  '' ,
                email:  '' ,
                token:  '' ,
                info_on_changes:  false ,
            }
        }
    }
});
