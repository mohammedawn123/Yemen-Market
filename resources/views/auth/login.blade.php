@extends('layouts.shop.index')

@section('content')
    @include('shop.includes.breadcrumb')


    <div class="row">
        <div id="content" class="col-sm-9">
            <div class="row">
                <div class="col-sm-6">
                    <div class="well" style="background-color: #fff;">
                        <h2>New Customer</h2>
                        <p><strong>Register Account</strong></p>
                        <p>By creating an account you will be able to shop faster, be up to date on an order's status, and keep track of the orders you have previously made.</p>
                        <a href="{{ route('register') }}" class="btn btn-primary">Continue</a></div>
                </div>
                <div class="col-sm-6">
                    <div class="well"  style="background-color: #fff;">
                        <?php  if (isset($error_login) ){ ?>
                        <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> {{$error_login}}
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                        </div>
                        <?php  } ?>
                        <form method="POST" action="{{ route('shop.login') }}">
                            @csrf
                            <div class="form-group">
                                <label class="control-label" for="input-email">{{ __('E-Mail Address') }}</label>
                                <input type="email" name="email"   placeholder="E-Mail Address" id="input-email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="input-password">{{ __('Password') }}</label>
                                <input type="password" value="" placeholder="Password" id="input-password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <aside id="column-right" class="col-sm-3 hidden-xs">
            <div class="list-group">
                <a href="#" class="list-group-item">Login</a>
                <a href="#" class="list-group-item">Register</a>
                <a href="#" class="list-group-item">Forgotten Password</a>
                <a href="#" class="list-group-item">My Account</a>
                <a href="#" class="list-group-item">Address Book</a>
                <a href="#" class="list-group-item">Wish List</a>
                <a href="#" class="list-group-item">Order History</a>
                <a href="#" class="list-group-item">Downloads</a>
                <a href="#" class="list-group-item">Recurring payments</a>
                <a href="#" class="list-group-item">Reward Points</a>
                <a href="#" class="list-group-item">Returns</a>
                <a href="#" class="list-group-item">Transactions</a>
                <a href="#" class="list-group-item">Newsletter</a>
            </div>
        </aside>
    </div>
@endsection
<!--Shift+Ctrl+Alt+J
Alt+J-->
