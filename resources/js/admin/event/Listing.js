import AppListing from '../app-components/Listing/AppListing';

Vue.component('event-listing', {
    mixins: [AppListing],
    props: ['categories','themes'],
    data() {
        return {
            categorySelect: {},
            themeSelect: {},
            showCategoryFilter: true,
            showThemeFilter: true,
            filters: {
                categories: [],
                themes: [],
            },
        }
    },
    watch: {
        showCategoryFilter: function (newVal, oldVal) {
            this.categorySelect = [];
        },
        showThemeFilter: function (newVal, oldVal) {
            this.themeSelect = [];
        },
        categorySelect: function(newVal, oldVal) {
            this.filters.categories = newVal.map(function(object) { return object['key']; });
            this.filter('categories', this.filters.categories);
        },
        themeSelect: function(newVal, oldVal) {
            this.filters.themes = newVal.map(function(object) { return object['key']; });
            this.filter('themes', this.filters.themes);
        }
    }
});
