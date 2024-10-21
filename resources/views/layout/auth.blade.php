<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
{{--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">--}}
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <title>Hello, Admin</title>
</head>
<body>




<!-- Include jQuery -->
<script src="{{asset('js/jquery-3.7.0.min.js')}}"></script>
<script src="{{asset('js/axios.min.js')}}"></script>
<script src="{{asset('js/bootstrap.bundle.js')}}"></script>

<!-- Toastify JS from CDN -->
{{--<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>--}}
<!-- Link to external JavaScript file -->
{{--<script src="js/toast-notifications.js"></script>--}}

</body>
</html>

<script>
    setTimeout(function () {
        let notification = document.getElementById('notification');
        if (notification) {
            notification.style.display = 'none';
        }
    }, 4000); // Redirect after 4 seconds
</script>
