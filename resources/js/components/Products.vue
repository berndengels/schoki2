<template>
    <div>
        <table v-if="products.length > 0" class="table product-list border-0">
            <tr v-for="item in products" :key="item.id">
                <td>
                    <img v-if="item.thumb" :src="item.thumb"/>
                    <br v-else/>
                </td>
                <td>
                    <a>{{ item.name }}</a>
                </td>
                <td v-if="item.hasSize">
                    Größe wählen: &nbsp;
                    <select
                        class="size-select no-scroll"
                        multiple
                        :size="item.sizes.length"
                        @change="setSize"
                    >
                        <option v-for="size in item.sizes" :key="size.id" :value="size.name">
                            {{ size.name }}
                        </option>
                    </select>
                </td>
                <td v-else><br/></td>
                <td>{{ item.price }} €</td>
                <td>
                    <button
                        class="form-control btn btn-primary d-inline-block"
                        @click="add(item)"
                    >
                        <i class="d-inline-block float-left fas fa-shopping-cart mr-2"></i>
                        Add <input class="inpQty" v-model="cartItem.qty" disabled/>
                    </button>
                </td>
            </tr>
        </table>
        <h3 v-else>Keine Daten vorhanden</h3>
    </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';

export default {
    name: "Products",
    props: ['products'],
    computed: mapGetters({cartItem: 'cart/cartItem'}),
    methods: mapActions({
        add: 'cart/add',
        setSize: 'cart/setSize'
    }),
}
</script>

<style lang="scss">
.inpQty {
    border: 0 !important;
    height: 1.5rem;
    width: 1.2rem;
    line-height: 1.5rem;
    padding: 0;
    margin: 0 0 0 0.5rem;
    display: inline;
    background-color: transparent;
    border-color: transparent;
    color: #fff;
}
.fas {
    line-height: 1.3rem;
}
.product-list {
    border: none !important;
}
td {
    margin: 0 !important;
}
.size-select {
    display: inline;
    overflow: hidden;
    overflow-y: auto;
    border: none;
    width: auto;
    height: 1.6rem;
    background-color: transparent;
    margin: auto;
    padding: 0;
    scrollbar-width: none; /*For Firefox*/;
    -ms-overflow-style: none; /*For Internet Explorer 10+*/;
}
.size-select option {
    display: inline-block !important;
    width: 1.6rem;
    height: 1.6rem;
    float: left !important;
    clear: none !important;
    color: #fff !important;
    margin: 0 0.2rem;
    line-height: 1.5rem;
    background-color: transparent;
    border: 1px solid #fff;
    border-radius: 0.8rem;
    text-align: center;
    vertical-align: middle;
    cursor: pointer;
}
.size-select option:hover,
.size-select option:selected {
    font-weight: bold;
    background-color: #3490dc !important;
    color: #fff !important;
}
</style>

