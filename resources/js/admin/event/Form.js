import AppForm from '../app-components/Form/AppForm';

Vue.component('event-form', {
    props: [
        'categories',
        'themes',
    ],
    mixins: [AppForm],
    data: function() {
        return {
            category: '',
            theme: '',
            form: {
                theme_id:  '',
                category_id:  '',
                title:  '',
                subtitle:  '',
                description:  '',
                links:  '',
                event_date:  '',
                event_time:  '',
                price:  '',
                is_published:  false ,
            },
            datePickerConfig: {
                dateFormat: 'Y-m-d',
                altInput: true,
                altFormat: 'd.m.Y',
                locale: 'de'
            },
            timePickerConfig: {
                enableTime: true,
                noCalendar: true,
                time_24hr: true,
                enableSeconds: true,
                dateFormat: 'H:i:S',
                altInput: true,
                altFormat: 'H:i',
                locale: null
            },
        }
    }
});
