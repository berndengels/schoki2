import AppForm from '../app-components/Form/AppForm';

Vue.component('role-form', {
    mixins: [AppForm],
    props: [
        'allPermissions',
        'myPermissions',
    ],
    data: function() {
        return {
            form: {
                name: '',
                guard_name: '',
                permissions: this.myPermissions ?? [],
            }
        }
    }
});
