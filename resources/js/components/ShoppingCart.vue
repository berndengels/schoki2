<template>
    <table class="table table-striped">
        <tr>
            <th>Artikel</th>
            <th>Größe</th>
            <th>Preis</th>
            <th>Anzahl</th>
            <th>Preis Total</th>
            <th colspan="3">&nbsp</th>
        </tr>
        <tr v-for="item in cartList" :key="item.id">
            <td>{{ item.name }}</td>
            <td>{{ item.size }}</td>
            <td>{{ item.price }} €</td>
            <td>{{ item.qty }}</td>
            <td>Total {{ item.priceTotal }} €</td>
            <td>
                <button @click="increment(item)" class="btn btn-link m-0 p-0 small" role="link"><i
                    class="fas fa-plus"></i></button>
            </td>
            <td>
                <button @click="decrement(item)" class="btn btn-link m-0 p-0 small" role="link"><i
                    class="fas fa-minus"></i></button>
            </td>
            <td>
                <button @click="removeItem(item)" class="btn btn-link m-0 p-0 small" role="link"><i
                    class="fas fa-trash"></i></button>
            </td>
        </tr>
        <tr>
            <td class="text-center align-middle text-light font-weight-bold p-0" colspan="8">
                <h4 class="mt-3">Preise Total: {{ Math.round(priceTotal) }} € + {{ porto }} € Porto</h4>
            </td>
        </tr>
    </table>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';

export default {
    name: "ShoppingCart",
    computed: mapGetters({
        cartList: 'cart/cartList',
        priceTotal: 'cart/priceTotal',
        porto: 'cart/porto',
    }),
    methods: mapActions({
        increment: 'cart/increment',
        decrement: 'cart/decrement',
        removeItem: 'cart/delete',
    })
}
</script>

<style lang="scss" scoped>
i {
    &.fas {
        margin-right: 0.2rem;
    }
}
</style>
