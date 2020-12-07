import AppListing from '../app-components/Listing/AppListing';

Vue.component('message-listing', {
    mixins: [AppListing],
    props: ['music_styles'],
    data() {
        return {
            musicStyleSelect: {},
            filters: {
                musicStyle: null,
            }
        }
    },
    watch: {
        musicStyleSelect: function (newVal) {
            this.filters.musicStyle = newVal;
            this.filter('musicStyle', this.filters.musicStyle);
        }
    }
});
