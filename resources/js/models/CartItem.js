
const CartItem = {
        id: 0,
        name: null,
        price: 0,
        priceTotal: 0,
        qty: 0,
    },
    setData = (data) => {
        for(let key in data) {
            CartItem[key] = data[key]
        }
    },
    set = (key,val) => { cartItem[key] = val },
    get = (key) => { return cartItem[key] }
    ;
export default CartItem;
