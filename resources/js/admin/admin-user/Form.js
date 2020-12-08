import AppForm from '../app-components/Form/AppForm';

Vue.component('admin-user-form', {
    mixins: [AppForm],
    props: ['userMusicStyles'],
    data: function() {
        return {
            music_styles: this.userMusicStyles ?? [],
            form: {
                first_name:  '',
                last_name:  '',
                email:  '',
                password:  '',
                activated:  false,
                forbidden:  false,
                language:  '',
                roles: [],
                music_styles: [],
            }
        }
    },
    created() {
        console.info(this.userMusicStyles)
    }
});
