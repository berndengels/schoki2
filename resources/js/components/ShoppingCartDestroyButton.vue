<template>
    <a
       role="button"
       class="btn btn-danger d-inline-block col-sm-auto col-md-3 float-right"
       @click="destroy"
    ><i class="fas fa-trash-alt"></i>Warenkorb leeren</a>
</template>

<script>
import { mapActions } from 'vuex';

export default {
    name: "ShoppingCartDestroyButton",
    methods: mapActions({destroy: 'cart/destroy'})
}
</script>

<style scoped>

</style>
