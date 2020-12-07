import AppForm from '../app-components/Form/AppForm';

Vue.component('event-periodic-form', {
    mixins: [AppForm],
    props: ['categories', 'themes', 'periodic_positions', 'periodic_weekdays'],
    data: function() {
        return {
            form: {
                theme_id:  '' ,
                category_id:  '' ,
                periodic_position:  '' ,
                periodic_weekday:  '' ,
                title:  '' ,
                subtitle:  '' ,
                description:  '' ,
                links:  '' ,
                event_date:  '' ,
                event_time:  '' ,
                price:  '' ,
                is_published:  false ,
            }
        }
    }
});
