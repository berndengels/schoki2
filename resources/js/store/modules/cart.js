/* eslint-disable */

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
    count: 0,
    cartItem: {
        id: null,
        name: null,
        qty: 0,
        price: 0,
        priceTotal: 0,
    },
}

const getters = {
    cart: state => state.cart,
    cartItem: state => state.cartItem,
    porto: state => {
        state.porto = state.cartItem.qty >= 3 ? 5 : 3;
    },
}

const actions = {
    setSize({commit}, evt) {
        commit('setSize', evt.target.value);
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
    add: (state, item) => {
        state.cartItem = {
            ...state.cartItem,
            id: state.cartItem.size ? item.id +"-" + state.cartItem.size : item.id,
            name: state.cartItem.size ? item.name +" Size: " + state.cartItem.size : item.name,
            price: item.price,
        }
        state.cartItem.qty++
        state.cartItem.priceTotal = state.cartItem.price * state.cartItem.qty
        state.porto = state.cartItem.qty >= 3 ? 5 : 3

        let arr = {[state.cartItem.id]: state.cartItem};
        for(let key in arr) {
            if(0 === state.cart.length) {
                state.cart.push(arr[key])
            } else {
                for(let index in state.cart) {
                    if(state.cart[index].id === arr[key].id) {
                        state.cart[index] = arr[key]
                    } else {
                        state.cart.push(arr[key])
                    }
                }
            }
        }
        console.info(state.cart);
    },
    setSize: (state, size) => {
        state.cartItem.qty = 0
        state.cartItem.size = size
    },
    increment: (state, item) => {
        state.cartItem = item
        state.cartItem.qty++
    },
    decrement: (state, item) => {
        state.cartItem = item
        state.cartItem.qty--
    },
    delete: (state, item) => (state.cart = state.cart.filter(i => i !== item)),
    destroy: (state) => (state.cart = []),
}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
