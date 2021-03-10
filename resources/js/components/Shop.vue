<template>
    <div class="w-100">
        <Products :products='products' />
        <ShoppingCartDestroyButton v-if="hasCart" />
        <ShoppingCart v-if="hasCart" />
    </div>
</template>

<script>
import { mapGetters } from "vuex"
import Products from "./Products";
import ShoppingCart from "./ShoppingCart";
import ShoppingCartDestroyButton from "./ShoppingCartDestroyButton";

export default {
    name: "Shop",
    props: ['products'],
    components: { Products, ShoppingCart, ShoppingCartDestroyButton },
    computed: mapGetters({
        hasCart: 'cart/hasCart',
        cart: 'cart/cart',
    }),
}
</script>

<style scoped>

</style>
