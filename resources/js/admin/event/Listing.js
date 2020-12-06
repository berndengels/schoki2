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
                category: null,
                theme: null,
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
            this.filters.category = newVal;
            this.filter('category', this.filters.category);
        },
        themeSelect: function(newVal, oldVal) {
            this.filters.theme = newVal;
            this.filter('theme', this.filters.theme);
        }
    }
});
