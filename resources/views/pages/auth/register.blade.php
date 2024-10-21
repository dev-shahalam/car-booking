@include('layout.auth')

<div class="container">
    <div class="row vh-100 justify-content-center align-items-center">
        <div class="col-sm-5 mt-5">
            <div class="card p-3 text-center">
                <div class="card-body col-sm-12">
                    <h4>Register Here</h4>
                    <p class="text-secondary pb-2">Already have an account? <a href="{{'/login'}}" class=" text-decoration-none ">Login</a></p>

                    {{-- Error message--}}
                    @if($errors->any())
                        <div id="notification">
                            @foreach($errors->all() as $error)
                                <p class="alert py-1 alert-danger" role="alert">{{$error}}</p>
                            @endforeach
                        </div>
                    @endif

                    {{-- Registration Form--}}
                    <form action="{{'/register-user'}}" method="post">
                        @csrf
                        <div class="col-sm-12 mb-3">
                            <input name="name" type="text" class="form-control" id="name" placeholder="Enter your name">
                        </div>
                        <div class="col-sm-12 mb-3">
                            <input name="email" type="email" class="form-control" id="email"
                                   placeholder="Enter your email">
                        </div>
                        <div class="col-sm-12 mb-3">
                            <input name="phone_number" type="text" class="form-control" id="phone_number"
                                   placeholder="Enter your phone number">
                        </div>
                        <div class="col-sm-12 mb-3">
                            <input name="password" type="password" class="form-control" id="password" placeholder="Enter password">
                        </div>
                        <div class="col-sm-12 mb-3">
                            <input name="address" type="text" class="form-control" id="address"
                                   placeholder="Enter your address">
                        </div>
                        <div class="col-sm-12 mb-3">
                            <button type="submit" class="btn mt-3 w-100 text-white  bg-primary">Complete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script>

    // Redirect after 4 seconds
    setTimeout(function () {
        let notification = document.getElementById('notification');
        if (notification) {
            notification.style.display = 'none';
        }
    }, 4000);
</script>

