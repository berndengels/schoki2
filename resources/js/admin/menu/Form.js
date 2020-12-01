import AppForm from '../app-components/Form/AppForm';

Vue.component('menu-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                parent_id:  '' ,
                menu_item_type_id:  '' ,
                name:  '' ,
                icon:  '' ,
                fa_icon:  '' ,
                url:  '' ,
                lft:  '' ,
                rgt:  '' ,
                lvl:  '' ,
                api_enabled:  false ,
                is_published:  false ,
                
            }
        }
    }

});