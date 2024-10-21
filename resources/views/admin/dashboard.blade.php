@include('layout.auth');

<div class="container">
    <!-- Let all your things have their places; let each part of your business have its time. - Benjamin Franklin -->
    <h1 class="text-center">Welcome, {{$user->name}}</h1>


    @if(session()->has('success'))
        <div  id="notification" class=" row justify-content-center">
            <div class=" col-sm-4 alert alert-success" role="alert">
                {{session()->get('success')}}
            </div>
        </div>
    @endif
</div>
