@include('layout.auth')

<div class="container">
    <div class="row vh-100 justify-content-center align-items-center">
        @if(session()->has('success'))
            <div id="notification" class=" row justify-content-center">
                <div class=" col-sm-4 alert alert-success" role="alert">
                    {{session()->get('success')}}
                </div>
            </div>
        @endif
        <div class="col-sm-5 mt-5">
            <div class="card p-3 text-center">
                <div class="card-body col-sm-12">
                    <h4>Enter Your Email for OTP</h4>
                    @if($errors->any())
                        <div id="notification">
                            @foreach($errors->all() as $error)
                                <p class="alert py-1 alert-danger" role="alert">{{$error}}</p>
                            @endforeach
                        </div>
                    @endif

                    <form action="{{'/send-otp'}}" method="POST">
                        @csrf
                        <div>
                            <div class="col-sm-12 my-3">
                                <input name="email" type="email" class="form-control " id="email"
                                       placeholder="Enter your email">
                            </div>
                            <div class="col-sm-12 mb-3">
                                <button type="submit" class="btn mt-3 w-100 text-white  bg-primary">Send Otp</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


