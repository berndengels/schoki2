import AppListing from '../app-components/Listing/AppListing';

Vue.component('address-listing', {
    mixins: [AppListing],
    props: ['address_categories'],
});
