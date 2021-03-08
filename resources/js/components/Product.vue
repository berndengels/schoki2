<template>
    <tr>
        <td>
            <img v-if="product.thumb" :src="product.thumb"/>
            <br v-else/>
        </td>
        <td>
            <a>{{ product.name }}</a>
        </td>
        <td v-if="product.hasSize">
            Größe wählen: &nbsp;
            <select
                :data-object-id="product.id"
                :size="product.sizes.length"
                class="size-select no-scroll"
                multiple
                name="size"
                required
            >
                <option v-for="size in product.sizes" :key="size.id" :value="size.name"
                >{{ size.name }}
                </option>
            </select>
        </td>
        <td v-else><br/></td>
        <td>{{ product.price }} €</td>
        <td>
            <button class="form-control btn btn-primary d-inline-block" type="submit">
                <i class="d-inline-block float-left fas fa-shopping-cart mr-2"></i>
                Add
                <span class="ml-1">(0)</span>
            </button>
        </td>
    </tr>
</template>

<script>
export default {
    name: "Product",
    props: ['product'],
}
</script>

<style scoped>

</style>
