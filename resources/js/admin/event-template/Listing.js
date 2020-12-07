import AppListing from '../app-components/Listing/AppListing';

Vue.component('event-template-listing', {
    mixins: [AppListing],
    props: ['categories', 'themes'],
});
