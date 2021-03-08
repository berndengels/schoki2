/* eslint-disable */

const apiRoute = "/api/spa/carts";

const state = {
    cartItems: [],
    cartItem: {
        rowId: null,
        id: null,
        name: null,
        qty: 0,
        price: 0,
        priceTotal: 0,
    },
}

const getters = {
    cartItems: state => state.cartItems,
    cartItem: state => state.cartItems,
}

const actions = {
    all({commit}) {
        iAxios.get(apiRoute)
            .then(resp => {
                commit('set', resp.data)
            })
            .catch(err => console.error(err));
    },
    add({commit}, newItem) {
        iAxios.post(apiRoute, newItem)
            .then(resp => {
                commit('add', resp.data)
            })
            .catch(err => console.error(err));
    },
    increment({commit}, item) {
        iAxios.put(apiRoute + "/" + item.id, item)
            .then(resp => {
                commit('increment', resp.data)
            })
            .catch(err => console.error(err));
    },
    decrement({commit}, item) {
        iAxios.put(apiRoute + "/" + item.id, item)
            .then(resp => {
                commit('decrement', resp.data)
            })
            .catch(err => console.error(err));
    },
    delete({commit}, item) {
        iAxios.delete(apiRoute + "/" + item.id)
            .then(resp => {
                if(resp.data) {
                    commit('delete', item)
                }
            })
            .catch(err => console.error(err));
    },
    destroy({commit}, item) {
        iAxios.delete(apiRoute)
            .then(resp => {
                if(resp.data) {
                    commit('destroy')
                }
            })
            .catch(err => console.error(err));
    }
}

const mutations = {
    set: (state, items) => state.cartItems = items,
    add: (state, item) => (state.cartItems.push(item)),
    increment: (state, item) => state.cartItems,
    decrement: (state, item) => state.cartItems,
    delete: (state, item) => (state.cartItems = state.cartItems.filter(i => i !== item)),
    destroy: (state) => (state.cartItems = null),
}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
