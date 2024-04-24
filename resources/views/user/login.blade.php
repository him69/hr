<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>PANTHEON DIGITAL</title>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        /* .app-main__outer {
            background-size: cover;
            background-image: url("./icon/loginbg.png");
            background-repeat: no-repeat;
        } */

        /* .app-main__inner {
            background:url("{{env('APP_URL')}}public/HR Background.jpg");
            filter: hue-rotate(342deg);
            background-repeat: no-repeat;
            background-size: cover;
        } */

        .loginForm {
            background: #b9ebf9;
            border-radius: 15px;
            backdrop-filter: blur(20px);
            box-shadow: 0 3px 6px #00000029;
            -webkit-backdrop-filter: blur(20px);
        }

        input {
            border-radius: 4px;
            border: 0;
            width: 100%;
        }

        input:focus {
            border: none;
            outline: none;
        }

        /* label {
            color: #006396 !important;
        } */

        .baseBtnBg {
            background: #006396;
            color: white;
            /* width: 38%; */
            height: 40px;
            margin: auto;
            border: 0px;
            font-size: 21px;
        }

        .fontmed {
            font-weight: 500;
        }

        .para {
            font-size: 18px;
        }

        .card-header {
            border-bottom: 2px solid white;
        }

        .inputicon {
            font-size: 20px;
            background: rgb(255, 255, 255);
            color: #006396;
            min-width: 30px;
            text-align: center;
            border-right: 1px solid #707070;
        }

        .points li {
            color: white;
            line-height: 33px;
        }

        .img1 {
            height: calc(100vh - 50%);
    width: 100%;
    bottom: 0;
    transform: translateX(-50%);
    left: 50%;
    z-index: -1;
    position: absolute;
            img {
                width: 100%;
                height: 100%;
                object-fit: contain;
            }
        }

        .logo {
            width: 84%;

            img {
                width: 100%;
                height: 100%;
            }
        }
        .loginDiv{
            background: url({{env('APP_URL')}}public/bg2.svg);
            background-repeat: no-repeat;
            background-size: 62%;
            background-position-x: right;
            background-position-y: bottom;
        }
    </style>
</head>

<body>
    <div class="app-container app-theme-white body-tabs-shadow">
        <div class="app-main">
            <div class="app-main__outer">
                <div class="app-main__inner p-0" style="height:100vh; overflow:hidden;">
                    <div class="row" style="height: inherit;">
                        <div class="col-md-4 col-12 order-md-1 order-2 px-4 position-relative" style="background-color: #006396 !important;height:100vh; z-index: 1;">
                            <div class="logo p-4">
                                <img src="{{env('APP_URL')}}public/bwlogo.png" alt="pantheon digital">
                            </div>
                            <ul class="points">
                                <li>Login & logout with ease</li>
                                <li>Check daily and monthly incentives</li>
                                <li>Apply for leave or check leaves</li>
                                <li>Check upcoming events with ease</li>
                                <li>Customised your profile</li>
                                <li>Get notified with holidays, notices, etc.,</li>
                                <li>Check salary, company policies & many more</li>
                            </ul>
                            <div class="img1">
                                <img src="{{env('APP_URL')}}public/bg1.png" alt="image">
                            </div>
                        </div>
                        <div class="col-md-8 col-12 order-md-1 order-1 pt-5 px-5 bg-white loginDiv" style="height: inherit;">
                            <div class=" mt-4">
                                <p class="text-muted mb-0">Welcome to Pantheon Digital’s</p>
                                <h3 class="" style="font-weight:700;">HR Portal <span style="color:#006396 !important;">Login</span></h3>
                                @if(session('message'))
                                        <div class="alert {{session('alert-class', 'alert-info') }}">{{ session('message') }}</div>
                                        @endif
                                <form method="POST" action="{{env('APP_URL')}}login" style="width: 50%;">
                                    @csrf
                                    <div class="my-2">
                                        <div><label for="" class="fontmed text-muted">User name</label></div>
                                        
                                        <div class="p-1 overflow-hidden rounded-1 rounded" style="border:1px solid #707070;">
                                    
                                            <input type="text" name="user_id" placeholder="" class="border-0 w-100 bg-transparent p-1">
                                        </div>
                                    </div>
                                    <div class=" my-2">
                                        <label for="" class="fontmed text-muted">Password</label>
                                        <div class="p-1 overflow-hidden rounded-1 rounded" style="border:1px solid #707070;" >
                                            <input type="password" name="password" placeholder="" class="border-0 p-1 w-100  bg-transparent">
                                        </div>
                                    </div>
                                        <button type="submit" class="btn w-50 my-4  p-2 px-2 d-flex justify-content-around text-white align-items-center" style="background-color: #006396;">Submit

                                        </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="container row m-auto d-flex justify-content-center align-items-center" style="height:100vh;">
                        <div class="row col-12 justify-content-center">
                            <div class="col-md-6 p-3 loginForm">
                                <div class="card bg-transparent " class="" style="box-shadow:none;">
                                    <div class="card-header bg-transparent text-white text-center para justify-content-center " style="text-shadow: 0px 3px 6px #00000029;">Welcome to HR Portal</div>

                                    <div class="card-body">
                                        @if(session('message'))
                                        <div class="alert {{session('alert-class', 'alert-info') }}">{{ session('message') }}</div>
                                        @endif
                                        <form method="POST" action="{{env('APP_URL')}}login">
                                            @csrf
                                            <div class="form-group row">
                                                <label for="" class="fontmed">Enter User name</label>
                                                <div class="p-1 border bg-white w-100 border-black overflow-hidden d-flex align-items-center rounded-1 rounded" style="box-shadow: 0px 3px 6px #00000029;">
                                                    <i class="fa-solid fa-user inputicon"></i>
                                                    <input type="text" name="user_id" placeholder="Enter username" class="border-0 w-100 bg-white p-1">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="" class="fontmed">Password</label>
                                                <div class="p-1 border bg-white w-100 border-black overflow-hidden d-flex align-items-center rounded-1 rounded" style="box-shadow: 0px 3px 6px #00000029;">
                                                    <i class="fa-solid fa-key inputicon"></i>
                                                    <input type="password" name="password" placeholder="Enter your password" class="border-0 w-100 bg-white p-1">
                                                </div>
                                            </div>
                                            <div class="form-group row justify-content-center  mb-0">
                                                <button type="submit" class="btn col-6 form-control baseBtnBg p-1 d-flex justify-content-around align-items-center">
                                                    <span class="p-1 m-1 rounded-circle bg-white" style="color:#006396;font-size:14px;"><i class="fa-solid fa-person-walking-arrow-right "></i></span>
                                                    <span>Login</span>

                                                </button>
                                            </div>
                                    </div>
                                    </form>
                                    <div>
                                        <p class="text-center" style="font-size:12px;">The user name and password will be provided by admin /HR, contact for the credentials</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
    </div>
</body>

</html>