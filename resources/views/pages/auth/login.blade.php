@include('layout.auth')

<div class="container">
    <div class="row vh-100 justify-content-center align-items-center">
        {{-- @if (session()->has('success'))
            <div id="notification" class=" row justify-content-center">
                <div class=" col-sm-4 alert alert-success" role="alert">
                    {{ session()->get('success') }}
                </div>
            </div>
        @endif --}}
        <div class="col-sm-5 mt-5">
            <div class="card p-3 text-center">
                <div class="card-body col-sm-12">
                    <h4>Login DWA</h4>
                    <p class="text-secondary  pb-2">Don't have an account? <a href="{{ '/register' }}"
                            class=" text-decoration-none ">Join now</a>
                    </p>

                    @if ($errors->any())
                        <div id="notification">
                            @foreach ($errors->all() as $error)
                                <p class="alert py-1 alert-danger" role="alert">{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    <form action="{{ '/login-user' }}" method="POST">
                        @csrf
                        <div>
                            <div class="col-sm-12 mb-3">
                                <input name="email" type="email" class="form-control" id="email"
                                    placeholder="Enter your email">
                            </div>

                            <div class="col-sm-12 mb-3">
                                <input name="password" type="password" class="form-control" id="password"
                                    placeholder="Enter password">
                            </div>
                            <a href="{{ '/send-otp' }}"
                                class=" text-decoration-none text-primary float-start ">Forgotten Password?</a>
                            <div class="col-sm-12 mb-3">
                                <button type="submit" class="btn mt-3 w-100 text-white  bg-primary">Login</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@if (session()->has('success'))
    <div id="notification" class=" row justify-content-center">
        <div class="position-absolute top-50 start-50 translate-middle col-sm-3 alert alert-success text-center text-white"
            role="alert">
            {{ session()->get('success') }}
        </div>
    </div>
@endif

@if (session()->has('error'))
    <div id="notification" class=" row justify-content-center">
        <div class="position-absolute top-50 start-50 translate-middle col-sm-3 alert alert-danger text-white text-center"
            role="alert">
            {{ session()->get('error') }}
        </div>
    </div>
@endif
