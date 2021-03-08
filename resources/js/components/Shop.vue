<template>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Order Products</div>
                <div class="card-body">
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
                                    :data-object-id="item.id"
                                    :size="item.sizes.length"
                                    class="size-select no-scroll"
                                    multiple
                                    name="size"
                                    required
                                >
                                    <option v-for="size in item.sizes" :key="size.id" :value="size.name"
                                    >{{ size.name }}
                                    </option>
                                </select>
                            </td>
                            <td v-else><br/></td>
                            <td>{{ item.price }} €</td>
                            <td>
                                <button class="form-control btn btn-primary d-inline-block" type="submit">
                                    <i class="d-inline-block float-left fas fa-shopping-cart mr-2"></i>
                                    Add
                                    <span class="ml-1">(0)</span>
                                </button>
                            </td>

                        </tr>
                    </table>
                    <h3 v-else>Bitte warten</h3>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

const apiURL = "https://schoki2.test/api/spa/products",
    Shop = {
        data() {
            return {
                products: [],
            }
        },
        created() {
            this.getProducts()
        },
        methods: {
            getProducts() {
                axios.get(apiURL)
                    .then(resp => {
                        console.info(resp.data)
                        this.products = resp.data
                    })
                    .catch(err => console.error(err))
                ;
            }
        }
    };
export default Shop;
</script>

<style scoped>
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
