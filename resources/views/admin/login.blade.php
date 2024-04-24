<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Pantheon Digitals</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <meta name="msapplication-tap-highlight" content="no">


    <title>Sign in</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{env('APP_URL')}}/public/css/app.css" rel="stylesheet">
    <link href="{{env('APP_URL')}}/public/main.css" rel="stylesheet">
</head>

<body>
    <div class="app-container app-theme-white body-tabs-shadow">
        <div class="app-main">
            <div class="app-main__outer collapse">
                <div class="app-main__inner">
                    <div class="container">
                        <div class="row justify-content-center">						
                            <div class="col-md-5">
                                <h3 align="center">Login</h3>
                                <div class="card">
                                    <div class="card-header" style="height:auto;"><img src="https://pantheondigitals.com/img/logo.webp" style="width:100%;"></div>
                                    <div class="card-body">
                                            @if(session('message'))
                                            <div class="alert alert-danger">{{ session('message') }}</div>
                                            @endif
                                        <form method="POST" action="{{env('APP_URL')}}admin/login">
                                            @csrf
                                            <div class="form-group row">
                                                <div class="col-md-12">
                                                    <input type="text" name="user_id" placeholder="username" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-12">
                                                     <input type="password" name="password" placeholder="Password" class="form-control" >
                                                </div>
                                            </div>
                                            <div class="form-group row mb-0">
                                                <div class="col-md-12 offset-md-12">
                                                    <button type="submit" class="btn btn-primary">
                                                        Login
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>

</html>