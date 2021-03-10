/* eslint-disable */
import Model from "../../models";

const apiRoute = "/carts";

function array_values(assoc) {
    let a = [];
    for(let item in assoc) {
        a.push(assoc[item])
    }
    return a;
}

const state = {
    porto: 0,
    priceTotal: 0,
    cart: [],
    cartList: [],
    hasCart: false,
    size: null,
    cartItem: Model.CartItem,
}

const getters = {
    cart: state => state.cart,
    cartList: state => state.cartList,
    hasCart: state => !!state.hasCart,
    cartItem: state => state.cartItem,
    priceTotal: state => state.priceTotal,
    porto: state => state.porto,
}

const actions = {
    setSize({commit}, evt) {
        commit('setSize', {
            size: evt.target.value,
            product: JSON.parse(evt.target.dataset.item),
        });
    },
    add({commit}, product) {
        commit('add', product)
    },
    increment({commit}, item) {
        commit('increment', item)
    },
    decrement({commit}, item) {
        commit('decrement', item)
    },
    delete({commit}, item) {
        commit('delete', item)
    },
    destroy({commit}, item) {
        commit('destroy')
    }
}

const mutations = {
    add: (state, product) => {
        if(product.hasSize && !state.size) {
            alert('Bitte erst die Größe wählen');
            return
        }
        let id = state.size ? product.id +"-" + state.size : product.id,
            name = state.size ? product.name +" Size: " + state.size : product.name
        ;

        state.cart[id] =  {
            ...state.cart[id],
            id: id,
            name: name,
            price: product.price,
        }

        state.cart[id].qty++
        state.cart[id].priceTotal = state.cart[id].price * state.cart[id].qty
        state.priceTotal = 0
        let qty = 0;
        _.forIn(state.cart, function(val, key) {
            state.priceTotal += val.priceTotal
            qty += val.qty
        })
        state.porto = qty >= 3 ? 5 : 3;
        state.cartItem = state.cart[id]
        state.hasCart = _.values(state.cart).length
        state.cartList = _.values(state.cart)
    },
    setSize: (state, params) => {
        state.size = params.size
        let id = params.product.id + "-" + params.size;

        if ( state.cart[id] ) {
            state.cart[id] =  {
                ...state.cart[id],
                size: params.size,
            }
        } else {
            let name = params.product.name + " Size: " + params.size;
            state.cart[id] = {
                id: id,
                name: name,
                size: params.size,
                qty: 0,
                price: params.product.price,
                priceTotal: 0,
            }
        }
        state.cartItem = state.cart[id]
    },
    increment: (state, item) => {
        state.cart[item.id].qty++
        state.cart[item.id].priceTotal += parseInt(item.price)
        state.priceTotal += parseInt(item.price)
        let qty = 0;
        _.forIn(state.cart, function(val, key) {
            qty += val.qty
        })
        state.porto = qty >= 3 ? 5 : 3;
        state.hasCart = _.values(state.cart).length
        state.cartList = _.values(state.cart)
    },
    decrement: (state, item) => {
        state.cart[item.id].qty--
        state.cart[item.id].priceTotal -= parseInt(item.price)
        state.priceTotal -= parseInt(item.price)

        if( state.cart[item.id].qty <= 0 ) {
            state.cart[item.id] = null
            _.pullAt(state.cart, [item.id]);
        }
        let qty = 0;
        _.forIn(state.cart, function(val, key) {
            qty += val.qty
        })
        state.porto = qty >= 3 ? 5 : 3;
        state.hasCart = _.values(state.cart).length
        state.cartList = _.values(state.cart)
    },
    delete: (state, item) => {
        _.pullAt(state.cart, [item.id]);
        let qty = 0;
        _.forIn(state.cart, function(val, key) {
            qty += val.qty
        })
        state.porto = qty >= 3 ? 5 : 3;
        state.priceTotal -= val.priceTotal
        state.hasCart = _.values(state.cart).length
        state.cartList = _.values(state.cart)
    },
    destroy: (state) => {
        state.cart = []
        state.cartList = []
        state.priceTotal = 0
        state.porto = 0
        state.hasCart = false
    },
}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
