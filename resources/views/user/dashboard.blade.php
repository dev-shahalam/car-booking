<div>
    <!-- If you do not have a consistent goal in life, you can not live it in a consistent way. - Marcus Aurelius -->
{{--    <h1 class="text-center">Welcome, </h1>--}}
    <h1 class="text-center">Welcome, {{$user->name}}</h1>

    @if(session()->has('success'))
        <div  id="notification" class=" row justify-content-center">
            <div class=" col-sm-4 alert alert-success" role="alert">
                {{session()->get('success')}}
            </div>
        </div>
    @endif
</div>

