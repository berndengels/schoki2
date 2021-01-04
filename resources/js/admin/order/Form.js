import AppForm from '../app-components/Form/AppForm';

Vue.component('order-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                price_total: '',
                delivered_on: '',
                created_by: '',
                updated_by: '',
            },
            datePickerConfig: {
                dateFormat: 'Y-m-d',
                altInput: true,
                altFormat: 'd.m.Y',
                locale: 'de'
            },
            timePickerConfig: {
                enableTime: true,
                noCalendar: false,
                time_24hr: true,
                enableSeconds: false,
                dateFormat: 'Y-m-d H:i:s',
                altInput: true,
                altFormat: 'd.m.Y H:i',
                locale: null
            }
        }
    }
});
