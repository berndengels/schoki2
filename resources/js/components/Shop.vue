<template>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Order Products</div>
                <div class="card-body">
                    <table v-if="products.length > 0" class="table product-list border-0">
                        <Product v-for="item in products" :key="item.id" :product="item" />
                    </table>
                    <h3 v-else>Bitte warten</h3>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Product from "./Product";
export default {
    name: 'Shop',
    components: {Product},
    props: ['products'],
};
</script>

<style lang="scss">
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
