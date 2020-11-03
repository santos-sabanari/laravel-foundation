<x-laravel-foundation::layouts.base class="flex-row align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card-group">
                    <div class="card p-4">
                        <div class="card-body">
                            <h1>{{config('laravel-foundation.login_text')}}</h1>
                            <p class="text-muted">{{config('laravel-foundation.login_description')}}</p>

                            <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate>
                                @csrf
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-user"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" placeholder="Username / E-Mail" required>
                                    @error('username')
                                    <p class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </p>
                                    @enderror
                                </div>

                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-lock"></i>
                                        </span>
                                    </div>
                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" required>
                                    @error('password')
                                    <p class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </p>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <button class="btn btn-primary px-4">Login</button>
                                    </div>
                                    @if(Route::has('password.request'))
                                        <div class="col-6 text-right">
                                            <a href="{{ route('password.request') }}" class="btn btn-link px-0">
                                                Forgot password?
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card text-white bg-primary py-5 d-md-down-none card-block d-flex" style="width:44%">
                        <div class="card-body align-items-center d-flex flex-column justify-content-center">
                            <div class="p-2">
                                <img src="{{asset('images/logo-auth.png')}}" class="img-fluid" style="height: 10rem;"/>
                            </div>

                            @if(Route::has('register'))
                                <div class="p-2 text-center">
                                    <h2>Sign up</h2>
                                    <a href="{{ route('register') }}" class="btn btn-lg btn-outline-light mt-3">
                                        Register
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-laravel-foundation::layouts.base>
