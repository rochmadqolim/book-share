<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main | @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>

<style>
</style>

<body>

    <div class="main justify-content-between flex-column d-flex">
        <nav class="navbar navbar-expand-lg bg-primary navbar-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">BookShare</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </nav>
        <div class="body h-100">
            <div class="row g-0 h-100">
                <div class="sidebar col-lg-2 collapse d-lg-block" id="navbarTogglerDemo03">
                    @if(Auth::user()->role_id == 1)
                    <a href="/dashboard" @if(request()->route()->uri=='dashboard') class="active" @endif>Dashboard</a>
                    <a href="/books" @if(request()->route()->uri=='books' ||request()->route()->uri=='bookEdit/{slug}'||request()->route()->uri=='bookDelete/{slug}'
                        ||request()->route()->uri=='bookAdd'
                        ||request()->route()->uri=='bookRestore') class="active" @endif>Books</a>
                    <a href="/categories"
                        @if(request()->route()->uri=='categories'||request()->route()->uri=='categoryEdit/{slug}'||request()->route()->uri=='categoryDelete/{slug}'
                        ||request()->route()->uri=='categoryAdd'
                        ||request()->route()->uri=='categoryRestore')
                        class="active" @endif>Categories</a>
                    <a href="/users" @if(request()->route()->uri=='users'||request()->route()->uri=='unregistered'||request()->route()->uri=='user/{slug}') class="active" @endif>Users</a>
                    <a href="/logs" @if(request()->route()->uri=='logs') class="active" @endif>Logs</a>
                    <a href="/logout">Logout</a>
                    @else
                    <a href="/profile" @if(request()->route()->uri=='profile') class="active" @endif>Profile</a>
                    <a href="/logout">Logout</a>
                    @endif
                </div>
                <div class="content col-lg-10 p-5">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>