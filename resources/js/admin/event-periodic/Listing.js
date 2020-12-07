import AppListing from '../app-components/Listing/AppListing';

Vue.component('event-periodic-listing', {
    mixins: [AppListing],
    props: ['categories', 'themes']
});
