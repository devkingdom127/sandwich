@extends("layouts.app")

@section('title')
    Login System
@endsection

@section('content')


    @includeIf('layouts.header')

    <section class="register">
        <div class="breadcrumns">
            <h1>
                Reach new customers, get more sales
            </h1>
            <p>Join Talabat, The Middle East's Largest Delivery Platform</p>
        </div>
        <div class="container container-custom">
            <div class="box-form">
                <h3>Login System</h3>

                @includeIf("layouts.msg")
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                       type="text" id="email" value="{{ old('email') }}" name="email"
                                       placeholder="E-mail Address" >
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"
                                       type="password" name="password" placeholder="Password" >
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="checkbox clearfix">
                                <div class="form-check checkbox-theme">
                                    <input class="form-check-input" type="checkbox" value="" id="rememberMe">
                                    <label class="form-check-label" for="rememberMe">
                                        Remember me
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>
                    <button type="submit">Submit</button>
                </form>
            </div>
        </div>
    </section> <!-- End Conainer -->

    @includeIf('layouts.footer')


@endsection

