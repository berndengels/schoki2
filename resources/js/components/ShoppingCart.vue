<template>
    <div class="row justify-content-center">
        <div class="card w-75">
            <div class="card-header row">
                <h3 class="col">Warenkorb</h3>
                <a v-if="cartItems.length > 0" role="button" class="btn btn-danger d-inline-block col-sm-auto col-md-3 float-right"
                   href="{{ route('public.scard.destroy') }}"
                ><i class="fas fa-trash-alt"></i>
                    Warenkorb leeren</a>
            </div>
            <div class="card-body row p-0 m-0 justify-content-center">
                <table v-if="cartItems.length > 0" class="table table-striped">
                    <tr>
                        <th>Artikel</th>
                        <th>Größe</th>
                        <th>Preis</th>
                        <th>Anzahl</th>
                        <th>Preis Total</th>
                        <th colspan="3">&nbsp</th>
                    </tr>
                    <tr v-for="item in cartItems" :key="item.rowId">
                        <td>{{ item.name }}</td>
                        <td>{{ item.options['size'] ? item.options['size'] : null }}</td>
                        <td>{{ brutto(item.price) }} €</td>
                        <td>{{ item.qty }}</td>
                        <td>Total {{ Math.round((item.total) * 10)/10 }} €</td>
                        <td>
                            <button type="button" class="btn btn-link m-0 p-0 small" role="link"><i
                                class="fas fa-plus"></i></button>
                        </td>
                        <td>
                            <button type="button" class="btn btn-link m-0 p-0 small" role="link"><i
                                class="fas fa-minus"></i></button>
                        </td>
                        <td>
                            <button type="button" class="btn btn-link m-0 p-0 small" role="link"><i
                                class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center align-middle text-light font-weight-bold p-0" colspan="8">
                            <h4 class="mt-3">Preise Total: {{ Math.round(cart.total) }} € + {{ porto }} € Porto</h4>
                        </td>
                    </tr>
                </table>
                <div>
                    @guest
                    <h5>Um die Artikel zu bestellen, mußt Du Dich einloggen oder Registrieren</h5>
                    <div class="row justify-content-center">
                        <a role="button" class="btn btn-primary btnPay align-middle"
                           href="{{ route('login', ['redirectTo' => 'public.scard.index']) }}"><i
                            class="fas fa-user-alt mr-1"></i>
                            @lang('Login')
                        </a>
                        &nbsp;
                        <a role="button" class="btn btn-primary ml-2 btnPay align-middle"
                           href="{{ route('register', ['redirectTo' => 'public.scard.index']) }}"><i
                            class="fas fa-cash-register mr-1"></i>
                            @lang('Register')
                        </a>
                    </div>
                    @else
                    <a role="button" class="btn btn-block btn-primary px-5"
                       href="{{ route('public.order.index') }}">@lang('Kaufen')</a>
                    @endguest
                </div>
                <h3 v-else>Keine Daten vorhanden!</h3>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ShoppingCart",
    props: ['cartItems'],
}
</script>

<style scoped>

</style>
