@extends('layouts.public')

@section('content')
    <div id="app" class="col-12">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Order Products</div>
                    <div class="card-body">
                        <Shop :products='@json($data)' />
                        <div>
                            @auth('web')
                                <h5>Logged in</h5>
                            @endauth
                            @guest
                                <h5>Um die Artikel zu bestellen, mußt Du Dich einloggen oder Registrieren</h5>
                                <div class="row justify-content-center">
                                    <a role="button" class="btn btn-primary btnPay align-middle"
                                       href="{{ route('login', ['redirectTo' => 'public.product.index']) }}" ><i class="fas fa-user-alt mr-1"></i>
                                        @lang('Login')
                                    </a>
                                    &nbsp;
                                    <a role="button"class="btn btn-primary ml-2 btnPay align-middle"
                                       href="{{ route('register', ['redirectTo' => 'public.scard.index']) }}"><i class="fas fa-cash-register mr-1"></i>
                                        @lang('Register')
                                    </a>
                                </div>
                            @else
                                <a role="button" class="btn btn-block btn-primary px-5"
                                   href="{{ route('public.order.index') }}">@lang('Kaufen')</a>
                            @endguest
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
