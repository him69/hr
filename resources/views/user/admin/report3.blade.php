@include('user.includes.header')
<div class="spinner-box hidden">
    <div class="circle-border">
        <div class="circle-core"></div>
    </div>
</div>
<div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
    @include('user.includes.top_nav')
    <div class="ui-theme-settings">
        <div class="theme-settings__inner">
            <div class="scrollbar-container">
            </div>
        </div>
    </div>
    <style>
        .borderColor {
            border: 1px solid #006396;
        }

        .unq {
            animation: unq 1s 1 ease;
            overflow: hidden;
            top: 98%;
            width: 12rem;
            z-index: 2;
        }

        @keyframes unq {
            0% {
                height: 0%;
            }

            100% {
                height: 9.2rem;
            }
        }

        @keyframes shrink {
            0% {
                height: 10rem;
                opacity: 1;
            }

            90% {
                opacity: 1;
            }

            100% {
                height: 0;
                opacity: 0;
            }
        }

        .shrinking {
            animation: shrink 1s ease forwards;
        }

        @keyframes rotateForward {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(180deg);
            }
        }

        @keyframes rotateBackward {
            from {
                transform: rotate(180deg);
            }

            to {
                transform: rotate(0deg);
            }
        }

        .rotateForward {
            animation: rotateForward 1s forwards;
        }

        .rotateBackward {
            animation: rotateBackward 1s forwards;
        }

        .nav-tabs .nav-link.active::before {
            content: "";
            background: #006396;
            position: absolute;
            height: 3px;
            width: 100%;
            top: 100%;
            left: 50%;
            opacity: 1;
            transform: translateX(-50%);
            border-radius: 9px 10px 0 0;
            transition: all .3s ease-in;
        }

        /* 
        .nav-tabs .nav-link:not(.active)::before {
            content: "";
            background: #006396;
            position: absolute;
            height: 3px;
            width: 100%;
            top: 100%;
            left: 50%;
            transition: all .3s ease-in;
            transform: translateX(-150%);
            opacity: 1;
            border-radius: 9px 10px 0 0;
        } */

        .nav-tabs .nav-link:hover,
        .nav-tabs .nav-link:focus,
        .nav-tabs .nav-link:not(.active),
        .nav-tabs .nav-link.active {
            border: none !important;
        }

        /* OFFICE AND WFH TOGGLE BUTTON  */
        .toggle-button-cover {
            display: table-cell;
            position: relative;
            width: 74px;
            height: 34px;
            box-sizing: border-box;
        }

        .button-cover {
            height: 100px;
            margin: 20px;
            background-color: #fff;
            box-shadow: 0 10px 20px -8px #c5d6d6;
            border-radius: 4px;
        }

        .button-cover:before {
            counter-increment: button-counter;
            content: counter(button-counter);
            position: absolute;
            right: 0;
            bottom: 0;
            color: #d7e3e3;
            font-size: 12px;
            line-height: 1;
            padding: 5px;
        }

        .button-cover,
        .knobs,
        .layer {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
        }

        .button {
            position: relative;
            /* top: 50%; */
            /* right: 25%; */
            width: 74px;
            height: 36px;
            /* margin: -20px auto 0 auto; */
            overflow: hidden;
        }

        .checkbox {
            position: relative;
            width: 100%;
            height: 100%;
            padding: 0;
            margin: 0;
            opacity: 0;
            cursor: pointer;
            z-index: 3;
        }

        .knobs {
            z-index: 2;
        }

        .layer {
            width: 100%;
            background-color: #ebf7fc;
            transition: 0.3s ease all;
            z-index: 1;
        }

        .button.r,
        .button.r .layer {
            border-radius: 100px;
        }

        #button-3 .knobs:before {
            content: "\e066";
            font-family: "Font Awesome 6 Free";
            position: absolute;
            top: 3px;
            left: 4px;
            width: 30px;
            height: 30px;
            color: #fff;
            font-size: 18px;
            font-weight: bold;
            text-align: center;
            display: grid;
            place-content: center;
            padding: 9px 4px;
            background-color: #006396;
            border-radius: 50%;
            transition: 0.3s ease all, left 0.3s cubic-bezier(0.18, 0.89, 0.35, 1.15)
        }

        #button-3 .checkbox:active+.knobs:before {
            width: 46px;
            border-radius: 100px;
        }

        #button-3 .checkbox:checked:active+.knobs:before {
            margin-left: -26px;
        }

        #button-3 .checkbox:checked+.knobs:before {
            content: "\e4d2";
            left: 42px;
            background-color: #f7b924;
        }

        #button-3 .checkbox:checked~.layer {
            background-color: #ecd8a7;
        }
    </style>
    <div class="app-main">
        @include('user.includes.sidebar')
        <div class="app-main__outer collapse d-block">
            <div class="app-main__inner">
                <div class="row baseShadow bg-white mx-2 position-relative" style="height:232px;">
                    <div class="position-absolute top-0 end-0 m-2 rounded-pill w-auto px-1 py-2" style="background: aliceblue;">
                        <p class="m-0 fw-bold">🎂 {{$profile->dob ? $profile->dob : 'NA'}}</p>
                    </div>
                    <div class="col-3 px-0 p-2 position-relative" style="height: 100%;">
                        @if(isset($profile) && isset($profile->photo))
                        <img src="{{ env('APP_URL') }}/public/uploads/{{ $profile->photo }}" class="w-100 " style="object-fit:cover; height:100%;" alt="Profile Photo">
                        @else
                        <img src="https://cdn-icons-png.flaticon.com/512/892/892781.png " class="w-100" style="height:100%;" alt="Default Profile Photo">
                        @endif

                        <div class="position-absolute" style="top:10px; right:10px;">
                            <!--<div class="bg-white rounded-circle m-2 d-flex align-items-center justify-content-center" style="height:34px; width:34px;">-->
                            <!--    <a class="text-center " href="{{env('APP_URL')}}adper/user_mode/{{$id}}" target="_blank">-->
                            <!--        <i class="fa-solid fa-arrow-up-right-from-square"></i></a>-->
                            <!--</div>-->
                            <div class="bg-white rounded-circle m-2 d-flex align-items-center justify-content-center" style="height:34px; width:34px;">
                                <p class="para text-end mx-2 
                             " id="set_btn" onclick="settingTab()"><i class="bi bi-gear" style=" cursor: pointer;"></i></p>

                                <div class="position-absolute unq bg-white shadow-sm rounded end-0 " style="display:none;">
                                    <div class="p-2">
                                        <div class="d-flex py-2 border-bottom align-items-center arrPoin"><i class="bi bi-person-circle mx-2 text-muted para"></i>
                                            <p data-toggle="modal" data-target="#userinfo">Edit User Detail</p>
                                        </div>


                                        <div class="d-flex py-2 border-bottom align-items-center arrPoin"><i class="bi bi-file-earmark-arrow-down-fill mx-2 text-muted para"></i>
                                            <p data-toggle="modal" data-target="#userDoc">Upload Document</p>
                                        </div>
                                        <div class="d-flex py-2 border-bottom align-items-center arrPoin"><i class="bi bi-bank2 mx-2 text-muted para"></i>
                                            <p data-toggle="modal" data-target="#userBankDetail">Edit Bank Detail</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if($profile->work_type == 1 || $profile->work_type == 2)
                            <div class="bg-white rounded-circle m-2 d-flex align-items-center justify-content-center" style="height:34px; width:34px;">

                                <i class="fa-solid para @if($profile->work_type == 1) fa-building @elseif($profile->work_type == 2)  fa-house-laptop @endif" style=" cursor: pointer;" data-toggle="modal" data-target="#workType"></i>
                            </div>
                            @endif
                        </div>
                        <!-- <i class="fa-solid fa-building"></i> -->
                        <div class="bg-white p-1 position-absolute start-0 end-0" style="bottom:8px;    border-radius: 0 8px 0 0;">
                            <p class="fw-bold"> {{$profile->name ? $profile->name : 'NA'}} @if($profile->lead == 1) <i class="fa-solid fa-certificate cttext" title="Team Leader"></i> @endif</p>
                            <p class="">
                                <span class="text-success">{{$profile->d_name}}</span> ({{$profile->designation ? $profile->designation : 'NA'}})
                            </p>
                        </div>
                    </div>
                    <div class="col-9 row px-0">
                        <div class="col-6">
                            <div class="smaTxt mt-2">
                                <p class="fw-bold m-0">User Id</p>
                                <p class="m-0">{{$profile->user_id ? $profile->user_id : 'NA'}}</p>
                            </div>
                            <div class="smaTxt mt-2">
                                <p class="fw-bold m-0">Email</p>
                                <p class="m-0">{{ $profile->email ? $profile->email : 'NA'}}</p>
                            </div>
                            <div class="smaTxt mt-2">
                                <p class="fw-bold m-0">Salary</p>
                                <div class="d-flex">
                                    <p class="m-0" id="userSalry"> ########</p> <span id="showSalary" onclick="showSalPass('salary',this)" class="arrPoin mx-2"><i class="fa-solid fa-eye-slash cttext"></i></span>
                                </div>

                            </div>
                        </div>
                        <div class="col-6">
                            <div class="smaTxt mt-2">
                                <p class="fw-bold m-0">Joining Date</p>
                                <p class="m-0">{{$profile->joining_date ? $profile->joining_date :'NA'}}</p>
                            </div>
                            <div class="smaTxt mt-2">
                                <p class="fw-bold m-0">Phone Number</p>
                                <p class="m-0">{{$profile->mobile ? $profile->mobile: 'NA'}}</p>
                            </div>
                            <div class="smaTxt mt-2">
                                <p class="fw-bold m-0">Password</p>
                                <div class="d-flex">
                                    <p class="m-0" id="userpass">########</p><span onclick="showSalPass('password',this)" class="arrPoin mx-2"><i class="fa-solid fa-eye-slash cttext"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <nav class="row gx-0 justify-content-between mt-4 mx-2">
                                <div class="nav row justify-content-around  nav-tabs d-flex gx-0 m-0 border-0" id="nav-tab" role="tablist" style="border-bottom: 1px solid;">
                                    <button class="nav-link bg-transparent active text-center col-3 text-dark px-0 py-3 justify-content-center" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="false">Profile</button>
                                    <button class="nav-link bg-transparent text-center col-3 text-dark border-0 px-0 py-3 justify-content-center" id="nav-attendance-tab" data-bs-toggle="tab" data-bs-target="#nav-attendance" type="button" role="tab" aria-controls="nav-attendance" aria-selected="true">Attendnce</button>
                                    <button class="nav-link bg-transparent text-center col-3 text-dark border-0 px-0 py-3 justify-content-center" id="nav-leave-tab" data-bs-toggle="tab" data-bs-target="#nav-leave" type="button" role="tab" aria-controls="nav-leave" aria-selected="true">Leaves</button>
                                    <button class="nav-link bg-transparent text-center text-dark col-3 border-0 px-0 py-3 justify-content-center" id="nav-file-tab" data-bs-toggle="tab" data-bs-target="#nav-file" type="button" role="tab" aria-controls="nav-file" aria-selected="true">Emp-File</button>
                                </div>

                            </nav>
                        </div>
                    </div>

                </div>

            </div>
            <div class="tab-content mt-4 mx-2" id=" nav-tabContent">
                @if(session('message'))
                <div class="alert {{ session('alert-class') }}">{{ session('message') }}</div>
                @endif
                <div class="tab-pane fade show m-auto mb-0 active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="row mx-0 justify-content-between">
                        <div class="col-5 ">
                            <div class="p-3 rounded  baseShadow bg-white" style="">
                                <div class="row">
                                    <p class="para col-12 fw-bold text-center">
                                        User Documents
                                    </p>
                                </div>
                                <div class="">
                                    <div class=" row pt-3 gy-2">
                                        <div class="col-6">
                                            <div class="smaTxt">
                                                <p class="fw-bold">Aadhar Card</p>
                                                @if(!empty($profile->aadhar_card))
                                                <a href="{{env('APP_URL')}}public/uploads/{{$profile->aadhar_card}}" target="_blank" style="text-align:center;" class=" border-0 rounded fw-bold cttext">
                                                    view
                                                </a>
                                                @else
                                                not uploaded
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="smaTxt">
                                                <p class="fw-bold">Aadhar Card Back</p>
                                                @if(!empty($profile->aadhar_card_back))
                                                <a href="{{env('APP_URL')}}public/uploads/{{$profile->aadhar_card_back}}" target="_blank" style="text-align:center;" class=" border-0 rounded fw-bold cttext">
                                                    view
                                                </a>
                                                @else
                                                not uploaded
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="smaTxt">
                                                <div class="fw-bold">
                                                    Aadhar number
                                                </div>
                                                <div>
                                                    {{$profile->adhar_no}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="smaTxt">
                                                <p class="fw-bold">pan Card</p>
                                                @if(!empty($profile->pan_card))
                                                <a href="{{env('APP_URL')}}public/uploads/{{$profile->pan_card}}" target="_blank" style="text-align:center;" class=" border-0 rounded fw-bold cttext">
                                                    view
                                                </a>
                                                @else
                                                not uploaded
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="smaTxt">
                                                <div class="fw-bold">
                                                    Pan number
                                                </div>
                                                <div>
                                                    {{$profile->pan_no}}
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- user bank info -->
                            <div class="p-3 rounded mt-3 baseShadow bg-white" style="">

                                <p class="para fw-bold col-12 text-center">
                                    User Bank Details
                                </p>
                                <div class="row pt-3 gy-3">
                                    <div class="col-6">
                                        <div class="smaTxt">
                                            <p class="fw-bold m-0">Bank Name</p>
                                            <p class="m-0">{{$profile->bank_name ? $profile->bank_name : 'NA'}}</p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="smaTxt">
                                            <p class="fw-bold m-0">IFSC code </p>
                                            <p class="m-0">{{$profile->ifsc_code ? $profile->ifsc_code :'NA'}}</p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="smaTxt">
                                            <p class="fw-bold m-0">Account number</p>
                                            <p class="m-0">{{$profile->account_no ? $profile->account_no : 'NA'}}</p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="smaTxt">
                                            <p class="fw-bold m-0">Bank account holder name</p>
                                            <p class="m-0">{{$profile->bank_account_holder_name ? $profile->bank_account_holder_name : 'NA'}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- other info -->
                            <div class="p-3  mt-3 rounded baseShadow bg-white">
                                <div class="row">
                                    <div class="col-12" style="display: flex;align-items: center;justify-content: center;flex-direction: column;">
                                        <div class="para">
                                            <p class="fw-bold m-0">Other Info</p>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        @if($profile->user_type == 1)
                                        <div class="smaTxt mt-2">
                                            <p class="fw-bold m-0">Server Ip</p>
                                            <p class="m-0">{{$profile->server_ip ? $profile->server_ip : 'NA'}}</p>
                                        </div>
                                        @endif
                                        @if($profile->pf !== 0)
                                        <div class="smaTxt mt-2">
                                            <p class="fw-bold m-0">Uan no.</p>
                                            <p class="m-0">{{ $profile->uan ? $profile->uan : 'NA'}}</p>
                                        </div>
                                        <div class="smsmaTxt mt-2 aTxt">
                                            <p class="fw-bold m-0">Pf no.</p>
                                            <p class="m-0">{{ $profile->pf_no ? $profile->pf_no : 'NA'}}</p>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="col-6">
                                        <div class="smaTxt mt-2">
                                            <p class="fw-bold m-0">Total Leave</p>
                                            <p class="m-0">{{$profile->leave_count ? $profile->leave_count : 'NA'}}</p>
                                        </div>
                                        <div class="smaTxt mt-2">
                                            <p class="fw-bold m-0">Used Leave</p>
                                            <p class="m-0">{{$profile->used_leave_count ? $profile->used_leave_count : 'NA'}}</p>
                                        </div>

                                        @if($profile->user_type==1)
                                        <div class="smaTxt mt-2">
                                            <p class="fw-bold m-0">CRM Id</p>
                                            <p class="m-0">{{ $profile->crm_emp_id ? $profile->crm_emp_id : 'NA'}}</p>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-6">
                            
                        </div>
                        <div class="col-4 my-3">
                            
                        </div> -->
                        <div class="col-7 ">
                            <div class="p-3 rounded baseShadow bg-white">
                                <p class="para fw-bold text-center">
                                    Assigned Asset
                                </p>

                                <table class="table table-bordered text-center bg-white">
                                    <tbody>
                                        <tr>
                                            <th>Asset Name</th>
                                            <th>Asset Type</th>
                                            <th>Serial Number</th>
                                            <th>Assign Date</th>
                                            <th>Asset Specification</th>
                                        </tr>
                                        @foreach($ass as $as)
                                        <tr>
                                            <td>{{$as->asset_name}}</td>
                                            <td>{{$as->asset_type}}</td>
                                            <td>{{$as->serial_number}}</td>
                                            <td>{{ date('j M Y', strtotime($as->from)) }}
                                            </td>
                                            <td>{{$as->ass_spec}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade m-auto" id="nav-attendance" role="tabpanel" aria-labelledby="nav-attendance-tab" style="width: 98%;">
                    <div class=" baseShadow bg-white my-2 mx-auto p-2">
                        <form method="post">
                            @csrf
                            <div class="row align-items-center gx-0 mx-0 my-1 position-relative">
                                <div class="row m-0 col-4 align-items-center bg-white rounded-2 position-absolute end-0 top-0" style="z-index: 1;">
                                    <div class="col-6 p-0">
                                        <input type="month" name="month" value="{{$date}}" class="form-control border-0">
                                    </div>
                                    <div class="col-6 p-0">
                                        <button class="btn baseBtnBg w-100 text-white" type="submit" name="showtab" value="nav-attendance">
                                            <span>Search by month</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <p class="SubHeding m-0">User Attendance</p>
                                </div>
                            </div>
                        </form>
                        <div class="table-responsive">
                            @if($profile->user_type == 1)
                            <table class="table table-bordered table-sm">
                                <tr>
                                    <th style="min-width: 100px;">Mark Date</th>
                                    <th>Nonpause</th>
                                    <th>Login Time</th>
                                    <th>Logout Time</th>
                                    <th>Sale Made</th>
                                    <th>Customer</th>
                                    <th>Leads</th>
                                    <th>Incentive</th>
                                    <th>Mark</th>
                                    <th>Action</th>
                                </tr>
                                @php($mte = 01)
                                @foreach($users as $us)
                                @php($expdate = explode('-',$us->mark_date))
                                @while($mte < $expdate[2])
                                    @php($day = $expdate[0].'-'.$expdate[1].'-'.str_pad($mte, 2, "0", STR_PAD_LEFT))
                                    @php($dayname = date('D', strtotime($day)))
                                    @if($dayname=='Sun' )
                                    <tr style="background:#c0c0c0; color:#000;">
                                        <td colspan="10" class="text-center fw-bold">{{ date('j-M-Y', strtotime($us->mark_date)) }}({{$dayname}})</td>
                                    </tr>
                                    @else
                                    <tr>
                                        <form method="post" target="_blank">
                                            @csrf
                                            <td>{{ date('j M Y', strtotime($day)) }}</td>
                                            <td></td>
                                            <td><input type="text" name="login_time" class="form-control">
                                            </td>
                                            <td><input type="text" name="logout_time" class="form-control">
                                            </td>
                                            <td><input type="number" name="sale_made" class="form-control">
                                            </td>
                                            <td><input type="number" name="customer" class="form-control">
                                            </td>
                                            <td><input type="number" name="leads" class="form-control">
                                            </td>
                                            <td><input type="number" name="incentive" class="form-control">
                                            </td>
                                            <td><select name="mark" class="form-control">
                                                    <option value="">NA</option>
                                                    <option value="P">P</option>
                                                    <option value="H">H</option>
                                                    <option value="A">A</option>
                                                    <option value="PL">PL</option>
                                                    <option value="HPL">HPL</option>
                                                    <option value="UPL">UPL</option>
                                                    <option value="Sun" @if($dayname=='Sun' ){{'selected'}}@endif>Sun</option>
                                                </select>
                                                <input type="hidden" name="user_id" value="{{$us->user_id}}">
                                                <input type="hidden" name="user_type" value="{{$profile->user_type}}">
                                                <input type="hidden" name="mark_date" value="{{sprintf('%s-%02d', substr($us->mark_date, 0, 7), $mte)}}">
                                            </td>
                                            <td><button class="btn btn-success">Save</button></td>
                                        </form>
                                    </tr>
                                    @endif
                                    @php($mte++)
                                @endwhile
                                    @php($day = $expdate[0].'-'.$expdate[1].'-'.str_pad($mte, 2, "0", STR_PAD_LEFT))
                                    @php($dayname = date('D', strtotime($day)))
                                    @if($us->mark == 'Sun')
                                    <tr style="background:#c0c0c0; color:#000;">
                                        <td colspan="10" class="text-center fw-bold">{{ date('j-M-Y', strtotime($us->mark_date)) }}({{$dayname}})</td>
                                    </tr>
                                    @else
                                    <tr @if($us->mark =='PL' || $us->mark =='UPL') style="background:#494df154;" @endif><form method="post" target="_blank">
                                            @csrf
                                            <td>{{ date('j-M-Y', strtotime($us->mark_date)) }}</td>
                                            <td>{{$us->nonpause}}</td>
                                            <td><input type="text" value="{{$us->login_time}}" name="login_time" class="form-control"></td>
                                            <td><input type="text" value="{{$us->logout_time}}" name="logout_time" class="form-control"></td>
                                            <td><input type="number" value="{{$us->sale_made}}" name="sale_made" class="form-control"></td>
                                            <td><input type="number" value="{{$us->customer}}" name="customer" class="form-control"></td>
                                            <td><input type="number" value="{{$us->leads}}" name="leads" class="form-control"></td>
                                            <td><input type="number" value="{{$us->incentive}}" name="incentive" class="form-control"></td>
                                            <td><select name="mark" class="form-control">
                                                    <option value="">NA</option>
                                                    <option value="P" @if($us->mark ==
                                                        'P'){{'selected'}}@endif >P</option>
                                                    <option value="H" @if($us->mark ==
                                                        'H'){{'selected'}}@endif >H</option>
                                                    <option value="A" @if($us->mark ==
                                                        'A'){{'selected'}}@endif >A</option>
                                                    <option value="PL" @if($us->mark ==
                                                        'PL'){{'selected'}}@endif >PL</option>
                                                    <option value="HPL" @if($us->mark ==
                                                        'HPL'){{'selected'}}@endif >HPL</option>
                                                    <option value="UPL" @if($us->mark ==
                                                        'UPL'){{'selected'}}@endif >UPL</option>
                                                    <option value="Sun" @if($us->mark ==
                                                        'Sun'){{'selected'}}@endif >Sun</option>
                                                </select>
                                                <input type="hidden" name="user_id" value="{{$us->user_id}}">
                                                <input type="hidden" name="user_type" value="{{$profile->user_type}}">
                                                <input type="hidden" name="mark_date" value="{{$us->mark_date}}">
                                            </td>
                                            <td><button class="btn btn-success">Save</button></td>
                                        </form>
                                    </tr>
                                    @endif
                                    @php($mte++)
                                    @endforeach
                                    @while($mte < $total_working) @if(isset($us)) @php($day=explode('-',$us->mark_date)[0].'-'.explode('-',$us->mark_date)[1].'-'.str_pad($mte, 2, "0", STR_PAD_LEFT))
                                        @else
                                        @php($day = $date.'-'.str_pad($mte, 2, "0", STR_PAD_LEFT))
                                        @endif
                                        @php($dayname = date('D', strtotime($day)))
                                        @if($dayname=='Sun')
                                        <tr style="background:#c0c0c0; color:#000;">
                                            <td colspan="10" class="text-center fw-bold">{{ date('j M Y', strtotime($day)) }}({{$dayname}})</td>
                                        </tr>
                                        @else
                                        <tr>
                                            <form method="post" target="_blank">
                                                @csrf
                                                <td>{{ date('j M Y', strtotime($day)) }}</td>
                                                <td></td>
                                                <td><input type="text" name="login_time" class="form-control">
                                                </td>
                                                <td><input type="text" name="logout_time" class="form-control">
                                                </td>
                                                <td><input type="number" name="sale_made" class="form-control">
                                                </td>
                                                <td><input type="number" name="customer" class="form-control">
                                                </td>
                                                <td><input type="number" name="leads" class="form-control">
                                                </td>
                                                <td><input type="number" name="incentive" class="form-control">
                                                </td>
                                                <td><select name="mark" class="form-control">
                                                        <option value="">NA</option>
                                                        <option value="P">P</option>
                                                        <option value="H">H</option>
                                                        <option value="A">A</option>
                                                        <option value="PL">PL</option>
                                                        <option value="HPL">HPL</option>
                                                        <option value="UPL">UPL</option>
                                                        <option value="Sun" @if($dayname=='Sun' ){{'selected'}}@endif>Sun</option>
                                                    </select>
                                                    <input type="hidden" name="user_id" value="{{$profile->id}}">
                                                    <input type="hidden" name="user_type" value="{{$profile->user_type}}">
                                                    <input type="hidden" name="mark_date" value="{{$day}}">
                                                </td>
                                                <td><button class="btn btn-success">Save</button></td>
                                            </form>
                                        </tr>
                                        @endif
                                        @php($mte++)
                                        @endwhile
                            </table>
                            @else
                            <table class="table table-bordered table-sm">
                                <tr>
                                    <th>Mark Date</th>
                                    <th>Login Time</th>
                                    <th>Logout Time</th>
                                    <th>@if($profile->user_type ==
                                        2){{'Recording'}}@elseif($profile->user_type ==
                                        3){{'Candidate'}}@else{{''}}@endif</th>
                                    <th>Mark</th>
                                    <th>Action</th>
                                </tr>
                                @php($mte = 01)
                                @foreach($users as $us)
                                @while($mte < explode('-',$us->mark_date)[2])
                                    @php($day = explode('-',$us->mark_date)[0].'-'.explode('-',$us->mark_date)[1].'-'.str_pad($mte,2, "0", STR_PAD_LEFT))
                                    @php($dayname = date('D', strtotime($day)))
                                    @if($dayname=='Sun' )
                                    <tr style="background:#c0c0c0; color:#000;">
                                        <td colspan="10" class="text-center fw-bold">{{ date('j M Y', strtotime($day)) }}({{$dayname}})</td>
                                    </tr>
                                    @else
                                    <tr>
                                        <form action="{{env('APP_URL')}}adper/attendance/qa_full_report/{{$us->user_id}}" method="post" target="_blank">
                                            @csrf
                                            <td>{{ date('j M Y', strtotime($day)) }}</td>
                                            <td><input type="text" name="login_time" class="form-control">
                                            </td>
                                            <td><input type="text" name="logout_time" class="form-control">
                                            </td>
                                            <td><input type="number" name="recording" class="form-control">
                                            </td>
                                            <td><select name="mark" class="form-control">
                                                    <option value="">NA</option>
                                                    <option value="P">P</option>
                                                    <option value="H">H</option>
                                                    <option value="A">A</option>
                                                    <option value="PL">PL</option>
                                                    <option value="HPL">HPL</option>
                                                    <option value="UPL">UPL</option>
                                                    <option value="Sun">Sun</option>
                                                </select>
                                                <input type="hidden" name="user_id" value="{{$us->user_id}}">
                                                <input type="hidden" name="user_type" value="{{$profile->user_type}}">
                                                <input type="hidden" name="mark_date" value="{{sprintf('%s-%02d', substr($us->mark_date, 0, 7), $mte)}}">
                                            </td>
                                            <td><button class="btn btn-success">Save</button></td>
                                        </form>
                                    </tr>
                                    @endif
                                    @php($mte++)
                                    @endwhile

                                    @php($day = explode('-',$us->mark_date)[0].'-'.explode('-',$us->mark_date)[1].'-'.str_pad($mte,2, "0", STR_PAD_LEFT))
                                    @php($dayname = date('D', strtotime($day)))
                                    @if($dayname=='Sun' )
                                    <tr style="background:#c0c0c0; color:#000;">
                                        <td colspan="10" class="text-center fw-bold">{{ date('j M Y', strtotime($day)) }}({{$dayname}})</td>
                                    </tr>
                                    @else
                                    <tr @if($us->mark =='PL' || $us->mark =='UPL') style="background:#494df154;" @endif><form action="{{env('APP_URL')}}adper/attendance/qa_full_report/{{$us->user_id}}" method="post" target="_blank">
                                            @csrf
                                            <td>{{ date('j-M-Y', strtotime($us->mark_date)) }}</td>
                                            <td><input type="text" value="{{$us->login_time}}" name="login_time" class="form-control"></td>
                                            <td><input type="text" value="{{$us->logout_time}}" name="logout_time" class="form-control"></td>
                                            <td><input type="number" value="@if($profile->user_type == 2){{$us->recording}}@elseif($profile->user_type == 3){{$us->new_candidate}}@else{{''}}@endif" name="candidate" class="form-control"></td>
                                            <td><select name="mark" class="form-control">
                                                    <option value="">NA</option>
                                                    <option value="P" @if($us->mark ==
                                                        'P'){{'selected'}}@endif >P</option>
                                                    <option value="H" @if($us->mark ==
                                                        'H'){{'selected'}}@endif >H</option>
                                                    <option value="A" @if($us->mark ==
                                                        'A'){{'selected'}}@endif >A</option>
                                                    <option value="PL" @if($us->mark ==
                                                        'PL'){{'selected'}}@endif >PL</option>
                                                    <option value="HPL" @if($us->mark ==
                                                        'HPL'){{'selected'}}@endif >HPL</option>
                                                    <option value="UPL" @if($us->mark ==
                                                        'UPL'){{'selected'}}@endif >UPL</option>
                                                    <option value="Sun" @if($us->mark ==
                                                        'Sun'){{'selected'}}@endif >Sun</option>
                                                </select>
                                                <input type="hidden" name="user_id" value="{{$us->user_id}}">
                                                <input type="hidden" name="user_type" value="{{$profile->user_type}}">
                                                <input type="hidden" name="mark_date" value="{{$us->mark_date}}">
                                            </td>
                                            <td><button class="btn btn-success">Save</button></td>
                                        </form>
                                    </tr>
                                    @endif
                                    @php($mte++)
                                    @endforeach
                                    @foreach($users as $us)
                                    @while($mte <= $total_working) @php($day=explode('-',$us->mark_date)[0].'-'.explode('-',$us->mark_date)[1].'-'.str_pad($mte,2, "0", STR_PAD_LEFT))
                                        @php($dayname = date('D', strtotime($day)))
                                        @if($dayname=='Sun' )
                                        <tr @if($us->mark == 'Sun') style="background:#c0c0c0; color:#000;"
                                            @endif >
                                        <tr style="background:#c0c0c0; color:#000;">
                                            <td colspan="10" class="text-center fw-bold">{{ date('j M Y', strtotime($day)) }}({{$dayname}})</td>
                                        </tr>
                                        @else
                                        <form action="{{env('APP_URL')}}adper/attendance/qa_full_report/{{$us->user_id}}" method="post" target="_blank">
                                            @csrf
                                            <td>{{ date('j M Y', strtotime($day)) }}</td>
                                            <td><input type="text" name="login_time" class="form-control">
                                            </td>
                                            <td><input type="text" name="logout_time" class="form-control">
                                            </td>
                                            <td><input type="number" name="recording" class="form-control">
                                            </td>
                                            <td><select name="mark" class="form-control">
                                                    <option value="">NA</option>
                                                    <option value="P">P</option>
                                                    <option value="H">H</option>
                                                    <option value="A">A</option>
                                                    <option value="PL">PL</option>
                                                    <option value="HPL">HPL</option>
                                                    <option value="UPL">UPL</option>
                                                    <option value="Sun">Sun</option>
                                                </select>
                                                <input type="hidden" name="user_id" value="{{$us->user_id}}">
                                                <input type="hidden" name="user_type" value="{{$profile->user_type}}">
                                                <input type="hidden" name="mark_date" value="{{sprintf('%s-%02d', substr($us->mark_date, 0, 7), $mte)}}">
                                            </td>
                                            <td><button class="btn btn-success">Save</button></td>
                                        </form>
                                        </tr>
                                        @endif
                                        @php($mte++)
                                        @endwhile
                                        @endforeach
                            </table>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade m-auto" id="nav-leave" role="tabpanel" aria-labelledby="nav-leave-tab" style="width: 98%;">
                    <div class="main-card baseShadow mb-3 card p-2">
                        <form method="post">
                            @csrf
                            <div class="row align-items-center gx-0 mx-0 my-1 position-relative">
                                <div class="row m-0 col-4 align-items-center bg-white rounded-2 position-absolute end-0 top-0" style="z-index: 1;">
                                    <div class="col-6 p-0">
                                        <input type="month" name="month" value="{{$date}}" class="form-control border-0">
                                    </div>
                                    <div class="col-6 p-0">
                                        <button class="btn baseBtnBg w-100 text-white" type="submit" name="showtab" value="nav-leave">
                                            <span>Search by month</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <p class="SubHeding m-0 ">Leave Request</p>
                                </div>
                            </div>
                        </form>
                        <div class="card-body table-responsive">
                            <table class="table table-hover table-bordered table-sm">
                                <tr>
                                    <th>Leave From</th>
                                    <th>Leave To</th>
                                    <th>Reason</th>
                                    <th>Action</th>
                                </tr>
                                @if($leaves->count() > 0)
                                @foreach($leaves as $leave)
                                <tr>
                                    <td>{{$leave->leave_from}}</td>
                                    <td>{{$leave->leave_to}}</td>
                                    <td>{{$leave->reason}}</td>
                                    <td>
                                        @if($leave->approved == 0)
                                        <a href="{{ env('APP_URL') }}adper/leave_approve/{{$leave->id}}" class="">
                                            <i class="bi bi-check text-success SubHeding"></i>
                                        </a>
                                        <a href="{{ env('APP_URL') }}adper/leave_reject/{{$leave->id}}" class="">
                                            <i class="bi bi-x text-danger SubHeding"></i>
                                        </a>
                                        @elseif($leave->approved == 2)
                                        <p class="text-danger">Rejected</p>
                                        @else
                                        <p class="text-success" disabled>Approved</p>
                                        @endif
                                    </td>

                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="4">No Data Found</td>
                                </tr>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade m-auto" id="nav-file" role="tabpanel" aria-labelledby="nav-leave-tab" style="width: 98%;">
                    <div class="main-card mb-3 card ">
                        <div class="">
                            <div class="row justify-content-end">
                                <!-- <div class="col-8 d-flex align-items-center">
                                    <div style="width: 100%;overflow: hidden;margin: 10px;">-->
                                <!--<div style="float: left;display: flex;align-items: center; font-weight: 500; color:#01375a;"><div style="width: 13px;height: 13px;background: #198C15 0% 0% no-repeat padding-box;border-radius: 50%;"></div>&nbsp;Offer Letter &nbsp;&nbsp;&nbsp;</div>-->
                                <!--<div style="float: left;display: flex;align-items: center; font-weight: 500; color:#01375a;"><div style="width: 13px;height: 13px;background: #ff0000 0% 0% no-repeat padding-box;border-radius: 50%;"></div>&nbsp;Appointment Letter &nbsp;&nbsp;&nbsp;</div>-->
                                <!--</div>
                                </div> -->
                                <div class="col-3 d-flex align-items-center m-2">
                                    <div class="w-100 d-flex">
                                        <button class="btn baseBtnBg mx-2" style="width:100%;" data-toggle="modal" data-target="#letters">Create Letters</button>
                                        <button class="btn baseBtnBg" style="width:100%;" data-toggle="modal" data-target="#userfile">Add File</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body table-responsive d-flex flex-wrap">
                        @if($user_file->count() > 0)
                        @foreach($user_file as $uf)
                            <div class="border rounded mx-3 my-3" style="height: 257px;width: 200px;position: relative;"> <img src="{{env('APP_URL')}}public/uploads/imgs/@if($uf->file_type=='increment letter')INCREMENT.png @elseif($uf->file_type=='appraisal letter')APPRAISAL.png @elseif($uf->file_type=='experience letter')EXPERIENCE.png @else{{'other.png'}} @endif" style="height: 100%;width: 100%;filter: blur(1px);">
                                <div style="position: absolute;bottom: 0;background: #e8e8e8bd;padding: 8px;width: 100%;">
                                    <p class="h5 fw-bold text-capitalize">{{$uf->file_type}}</p>
                                    <div class="d-flex justify-content-between">
                                        <p class="h6 fw-bold ">{{ date('M-d-y', strtotime($uf->file_date)) }}</p> <a href="{{env('APP_URL')}}public/uploads/{{$uf->file}}" target="_blank" style="text-align:center;" class=" border-0 rounded fw-bold cttext">
                                            view
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @endif
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
<!-- bank detail -->
<div class="modal fade" id="userBankDetail" tabindex="-1" aria-labelledby="userBankLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header flex-column bg-white SubHeding border-0">
                <div class=" align-self-end pe-7s-close" data-dismiss="modal" aria-label="Close"></div>
                <h5 class="modal-title text-center  fw-bold  m-auto" id="userBankLabel">Bank Information</h5>
                <form action="{{env('APP_URL')}}adper/save_profile/{{$id}}" method="post" class="w-100">
                    @csrf
                    <div class="modal-body">
                        <div class="d-flex flex-column ">
                            <label for="" class="samllText  fw-bold  px-1">Bank Name</label>
                            <input type="text" name="bank_name" class="form-control" placeholder="Enter Bank Name" value="{{$profile->bank_name}}">
                        </div>
                        <div class="d-flex flex-column ">
                            <label for="" class="samllText  fw-bold  px-1">Account holder name</label>
                            <input type="text" name="bank_account_holder_name" class="form-control" placeholder="Enter Account holder name" value="{{$profile->bank_account_holder_name}}">
                        </div>
                        <div class="d-flex flex-column ">
                            <label for="" class="samllText  fw-bold  px-1">Account Number</label>
                            <input type="number" name="account_no" class="form-control" placeholder="Enter Account Number" value="{{$profile->account_no}}">
                        </div>
                        <div class="d-flex flex-column ">
                            <label for="" class="samllText  fw-bold  px-1">IFSC Number</label>
                            <input type="text" name="ifsc_code" class="form-control" placeholder="Enter IFSC Number" value="{{$profile->ifsc_code}}">
                        </div>
                    </div>

                    <div class="modal-footer justify-content-center bg-white border-0">

                        <button type="submit" class="btn col-6 baseBtnBg align-self-end text-white">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- addhar pan uploade -->
<div class="modal fade" id="userDoc" tabindex="-1" aria-labelledby="userDocLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header flex-column bg-white SubHeding border-0">
                <div class=" align-self-end pe-7s-close" data-dismiss="modal" aria-label="Close"></div>
                <h5 class="modal-title text-center  fw-bold  m-auto" id="userDocLabel">Document Information</h5>

            </div>
            <form action="{{env('APP_URL')}}adper/save_profile/{{$id}}" method="post">
                @csrf
                <div class="modal-body">

                    <div class="d-flex flex-column ">
                        <label for="" class="samllText  fw-bold  px-1">Aaddhar Number</label>
                        <input type="Number" name="adhar_no" class="form-control" placeholder="Enter Aaddhar Card" value="{{$profile->adhar_no}}">
                    </div>
                    <div class="d-flex flex-column ">
                        <label for="" class="samllText  fw-bold  px-1">Pan Number</label>
                        <input type="text" class="form-control" name="pan_no" placeholder="Enter Pan Number" value="{{$profile->pan_no}}">
                    </div>
                </div>
                <div class="modal-footer justify-content-center bg-white border-0">
                    <button type="submit" class="btn col-6 baseBtnBg align-self-end text-white">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- user info update -->
<div class="modal fade" id="userinfo" tabindex="-1" aria-labelledby="userInfoLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header flex-column bg-white SubHeding border-0">
                <div class=" align-self-end pe-7s-close" data-dismiss="modal" aria-label="Close"></div>
                <h5 class="modal-title text-center  fw-bold  m-auto" id="userInfoLabel">General Information</h5>
            </div>
            <form action="{{env('APP_URL')}}adper/save_profile/{{$id}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="">
                        <div class="row align-items-center mt-3">
                            <div class="d-flex flex-column col-6">
                                <label for="" class="samllText  fw-bold  px-1">User ID</label>
                                <input type="text" name="user_id" value="{{$profile->user_id}}" class="form-control">
                            </div>
                            <div class="d-flex flex-column col-6">
                                <label for="" class="samllText  fw-bold  px-1">Name</label>
                                <input type="text" name="name" value="{{$profile->name}}" class="form-control">
                            </div>
                        </div>
                        <div class="row align-items-center mt-3">
                            <div class="d-flex flex-column col-6">
                                <label for="" class="samllText  fw-bold  px-1">Password</label>
                                <input type="text" name="Password" value="{{$profile->password}}" class="form-control">
                            </div>
                            <div class="d-flex flex-column col-6">
                                <label for="" class="samllText  fw-bold  px-1">Email</label>
                                <input type="emial" name="email" value="{{$profile->email}}" class="form-control">
                            </div>
                            <div class="d-flex flex-column col-12">
                                <label for="" class="samllText  fw-bold  px-1">Address</label>
                                <input type="emial" name="prmt_adrs" placeholder="Enter parmanent address" value="{{$profile->prmt_adrs}}" class="form-control">
                            </div>
                        </div>
                        <div class="row align-items-center mt-3">
                            <div class="d-flex flex-column col-6">
                                <label for="" class="samllText  fw-bold  px-1">Designation</label>
                                <input type="text" name="designation" value="{{$profile->designation}}" class="form-control">
                            </div>
                            <div class="d-flex flex-column col-6">
                                <label for="" class="samllText   fw-bold  px-1">Mobile</label>
                                <input type="number" name="mobile" value="{{$profile->mobile}}" class="form-control">
                            </div>
                        </div>
                        <div class="row align-items-center mt-3">
                            <div class="d-flex flex-column col-6">
                                <label for="" class="samllText  fw-bold  px-1">Joining Date</label>
                                <input type="Date" name="joining_date" value="{{$profile->joining_date}}" class="form-control">
                            </div>
                            <div class="d-flex flex-column col-6">
                                <label for="" class="samllText  fw-bold  px-1">Date Of Birth</label>
                                <input type="date" name="dob" value="{{$profile->dob}}" class="form-control">
                            </div>

                        </div>
                        <div class="row align-items-center mt-3">
                            <div class="d-flex flex-column col-6">
                                <label for="" class="samllText  fw-bold  px-1">Salary</label>
                                <input type="number" name="salary" value="{{$profile->salary}}" class="form-control">
                            </div>
                            <div class="d-flex flex-column col-6">
                                <label for="" class="samllText  fw-bold  px-1">Applied From</label>
                                <input type="month" name="applied_from" value="{{date('Y-m')}}" class="form-control">
                            </div>
                        </div>
                        <div class="row align-items-center mt-3">
                            <div class="d-flex flex-column col-6">
                                <label for="" class="samllText  fw-bold  px-1">Team Type</label>
                                <input type="text" name="team_type" value="{{$profile->team_type}}" class="form-control">
                            </div>
                            <div class="d-flex flex-column col-6">
                                <label for="" class="samllText  fw-bold  px-1">Leave Count</label>
                                <input type="text" name="leave_count" value="{{$profile->leave_count}}" class="form-control">
                            </div>
                            <div class="d-flex flex-column col-6">
                                <label for="" class="samllText  fw-bold  px-1">Used Leave</label>
                                <input type="text" name="used_leave_count" value="{{$profile->used_leave_count}}" class="form-control">
                            </div>
                            @if($profile->pf != 0)
                            <div class="d-flex flex-column col-6">
                                <label for="" class="samllText  fw-bold  px-1">Pf</label>
                                <div class="d-flex align-items-center p-1">
                                    <div class="d-flex align-items-center "><input type="radio" name="pf" id="pf_yes" value="1" checked>
                                        <label for="pf_yes" class="m-0">Yes</label>
                                    </div>
                                    <div class="mx-2 d-flex align-items-center"><input type="radio" name="pf" value="0" id="pf_no">
                                        <label for="pf_no" class="m-0">no</label>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-column col-6">
                                <label for="" class="samllText  fw-bold  px-1">Uan Number</label>
                                <input type="text" name="Uan_no" value="{{ $profile->Uan_no }}" class="form-control">
                            </div>
                            <div class="d-flex flex-column col-6">
                                <label for="" class="samllText  fw-bold  px-1">Pf Number</label>
                                <input type="text" name="pf_no" value="{{ $profile->pf_no }}" class="form-control">
                            </div>
                            @else
                            <div class="d-flex flex-column col-6">
                                <label for="" class="samllText  fw-bold  px-1">Pf</label>
                                <div class="d-flex align-items-center p-1">
                                    <div class="d-flex align-items-center "><input type="radio" name="pf" id="pf_yes" value="1">
                                        <label for="pf_yes" class="m-0">Yes</label>
                                    </div>
                                    <div class="mx-2 d-flex align-items-center"><input type="radio" name="pf" value="0" id="pf_no">
                                        <label for="pf_no" class="m-0">no</label>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @if($profile->user_type == 1)
                            <div class="d-flex flex-column col-6">
                                <label for="" class="samllText  fw-bold  px-1">CRM Id</label>
                                <input type="text" name="crm_emp_id" value="{{$profile->crm_emp_id}}" class="form-control">
                            </div>
                            <div class="d-flex flex-column col-6">
                                <label for="" class="samllText  fw-bold  px-1">Server Ip</label>
                                <input type="text" name="server_ip" value="{{$profile->server_ip}}" class="form-control">
                            </div>
                            @endif
                        </div>
                        <div class="row align-items-center mt-3">
                            <div class="col-12">
                                <button type="submit" class="btn baseBtnBg align-self-end text-white">Update</button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-center bg-white border-0"></div>
            </form>

        </div>
    </div>
</div>
</div>
<!-- employee file uploade -->
<div class="modal fade" id="userfile" tabindex="-1" aria-labelledby="userFileLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{env('APP_URL')}}adper/save_user_file/{{$id}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="">
                        <div class="row align-items-center">
                            <div class="d-flex flex-column col-12">
                                <input type="hidden" name="uid" value="{{$profile->id}}">
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="d-flex flex-column col-12 my-2">
                                <label for="" class="samllText fw-bold px-1">File Type</label>
                                <input class="py-3 border-dark rounded border" list="file_type_list" name="file_type" accept="application/pdf" placeholder="Select File Type">
                                <datalist id="file_type_list">
                                    @foreach($user_file as $uf)
                                    <option value="{{$uf->file_type}}">
                                        @endforeach
                                </datalist>

                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="d-flex flex-column col-6">
                                <label for="" class="samllText fw-bold px-1">File</label>
                                <input type="file" name="file">
                            </div>
                            <div class="d-flex flex-column col-6">
                                <label for="" class="samllText fw-bold px-1">Date</label>
                                <input type="date" name="file_date">
                            </div>
                            <div class="col-12 align-items-center">
                                <br>
                                <button type="submit" class="btn col-12 baseBtnBg align-self-end text-white">Update</button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-center bg-white border-0"></div>
            </form>
        </div>
    </div>
</div>
</div>
<!-- update work type -->
<div class="modal fade" id="workType" tabindex="-1" aria-labelledby="workLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header flex-column bg-white SubHeding border-0">
                <div class=" align-self-end pe-7s-close" data-dismiss="modal" aria-label="Close"></div>
                <h5 class="modal-title text-center  fw-bold  m-auto" id="workLabel">Document Information</h5>

            </div>
            <form action="{{env('APP_URL')}}adper/worktype/{{$id}}" method="post">
                @csrf
                <div class="modal-body">
                    <label for="" class="samllText  fw-bold  px-1">Work Type</label>
                    <select name="worktype" id="" class="form-control">
                        <option value="1" @if($profile->work_type == 1) selected @endif>In office</option>
                        <option value="2" @if($profile->work_type == 2) selected @endif>Work from home</option>
                    </select>
                </div>
                <div class="modal-footer justify-content-center bg-white border-0">
                    <button type="submit" class="btn col-6 baseBtnBg align-self-end text-white">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- update letters -->
<div class="modal fade" id="letters" tabindex="-1" aria-labelledby="letterLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg ">
        <div class="modal-content">
            <div class="modal-header flex-column bg-white  border-0">
                <div class=" align-self-end pe-7s-close SubHeding" data-dismiss="modal" aria-label="Close"></div>
                <div class="d-flex justify-content-around">
                    <div class="p-2 m-1 rounded text-center text-white tab samllText" data-table-id="table3" style="background-color: rgb(255, 176, 46);">Increment Letter</div>
                    <div class="p-2 m-1 rounded text-center text-white tab samllText" data-table-id="table4" style="background-color: #8f8e8eb7;">Appraisal Letter</div>
                    <div class="p-2 m-1 rounded text-center text-white tab samllText" data-table-id="table5" style="background-color: #8f8e8eb7;">Relieving & Experience</div>
                </div>
                <!-- increment letter -->
                <div class="table" id="table3" style="display: block;">
                    <div class=" align-items-center my-2">
                        <p class="para m-0 text-center fw-bold">Increment Letter</p>
                    </div>
                    <?php

                    $nameParts = explode(' ', $profile->name);
                    ?>
                    <form action="{{env('APP_URL')}}adper/user_letter">
                        <input type="hidden" name="id" value="{{$profile->id}}">
                        <div class="row">
                            <div class="col-6">
                                <label class="Vsmall fw-bold" for="">Title<span class="text-danger">*</span></label>
                                <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                                    <i class="fa-solid fa-user inputicon"></i>
                                    <input type="text" name="title" placeholder="Mr./Ms." value="{{$profile->gender == 'Male' ? 'Mr.' : 'Mrs.'}}" class="border-0 w-100 bg-white p-1 Vsmall fw-bold text-capitalize Vsmall fw-bold">
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="Vsmall fw-bold" for="">First Name<span class="text-danger">*</span></label>
                                <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                                    <i class="fa-solid fa-user inputicon"></i>
                                    <input type="text" name="fname" required placeholder="Enter First Name" value="{{explode(' ', $profile->name)[0]}}" class="border-0 w-100 bg-white p-1 Vsmall fw-bold text-capitalize Vsmall fw-bold">
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="Vsmall fw-bold" for="">Last Name</label>
                                <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                                    <i class="fa-solid fa-user inputicon"></i>


                                    <input type="text" name="lname" placeholder="Enter Last Name" value="@if(isset($nameParts[1])) {{$nameParts[1]}} @endif" class="border-0 w-100 bg-white p-1 Vsmall fw-bold text-capitalize Vsmall fw-bold">
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="Vsmall fw-bold" for="">Position<span class="text-danger">*</span></label>
                                <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                                    <i class="fa-solid fa-user inputicon"></i>
                                    <input placeholder="Enter Candidate Position" value="{{$profile->designation}}" name="position" required class="border-0 w-100 bg-white p-1 Vsmall fw-bold text-capitalize Vsmall fw-bold">
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="Vsmall fw-bold" for="">Department<span class="text-danger">*</span></label>
                                <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                                    <i class="fa-solid fa-building inputicon"></i>
                                    <input placeholder="Enter Candidate Position" name="department" value="{{$profile->d_name}}" required class="border-0 w-100 bg-white p-1 Vsmall fw-bold text-capitalize Vsmall fw-bold">
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="Vsmall fw-bold" for="">Increment Amount<span class="text-danger">*</span></label>
                                <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                                    <i class="fa-solid fa-arrow-up-wide-short inputicon"></i>
                                    <input placeholder="Enter Candidate Position" name="incamt" class="border-0 w-100 bg-white p-1 Vsmall fw-bold Vsmall fw-bold">
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="Vsmall fw-bold" for="">Address<span class="text-danger">*</span></label>
                                <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                    <i class="fa-solid fa-map-pin inputicon"></i>
                                    <textarea type="text" name="address" placeholder="Enter Candidate Position" class="border-0 w-100 bg-white p-1 Vsmall fw-bold Vsmall fw-bold" rows="1"> {{$profile->prmt_adrs}}</textarea>
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="Vsmall fw-bold" for="">Date<span class="text-danger">*</span></label>
                                <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                                    <i class="fa-solid fa-calendar-days inputicon"></i>
                                    <input placeholder="Enter Date" type="date" name="date" value="<?php echo date('Y-m-d'); ?>" class="border-0 w-100 bg-white p-1 Vsmall fw-bold Vsmall fw-bold">
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="Vsmall fw-bold" for="">Effect From<span class="text-danger">*</span></label>
                                <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                                    <i class="fa-solid fa-calendar-days inputicon"></i>
                                    <input placeholder="Enter Date" type="date" name="Efromdate" value="<?php echo date('Y-m-d'); ?>" class="border-0 w-100 bg-white p-1 Vsmall fw-bold">
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="Vsmall fw-bold" for="">Salary<span class="text-danger">*</span></label>
                                <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                                    <i class="fa-solid fa-money-bill-1-wave inputicon"></i>
                                    <input placeholder="salary" type="number" name="salary" value="{{$profile->salary}}" class="border-0 w-100 bg-white p-1 Vsmall fw-bold">
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="Vsmall fw-bold" for="">Joining Date<span class="text-danger">*</span></label>
                                <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                                    <i class="fa-solid fa-calendar-days inputicon"></i>
                                    <input placeholder="Enter Joining Date" type="date" name="jdate" value="{{$profile->joining_date}}" required class="border-0 w-100 bg-white p-1 Vsmall fw-bold">
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="Vsmall fw-bold" for="">PF<span class="text-danger">*</span></label>
                                <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                    <i class="fa-solid fa-user inputicon"></i>
                                    <select name="pf" class="border-0 w-100 bg-white p-1 Vsmall fw-bold">
                                        <option value="1" {{ $profile->pf == 1 ? 'selected' : '' }}>Yes</option>
                                        <option value="0" {{ $profile->pf == 0 ? 'selected' : '' }}>No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="Vsmall fw-bold" for="">Email<span class="text-danger">*</span></label>
                                <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                                    <i class="fa-solid fa-envelope inputicon"></i>
                                    <input placeholder="Enter Candidate Email" value="{{$profile->email}}" type="email" name="email" class="border-0 w-100 bg-white p-1 Vsmall fw-bold">
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="Vsmall fw-bold" for="">Sign<span class="text-danger">*</span></label>
                                <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                                    <i class="fa-solid fa-signature inputicon"></i>
                                    <input placeholder="Sign" name="sign" class="border-0 w-100 bg-white p-1 Vsmall fw-bold">
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="Vsmall fw-bold" for="">Sign designation<span class="text-danger">*</span></label>
                                <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                                    <i class="fa-solid fa-signature inputicon"></i>
                                    <input placeholder="Sign designation" value="{{$profile->designaiton}}" name="sign_deg" class="border-0 w-100 bg-white p-1 Vsmall fw-bold">
                                </div>
                            </div>
                            <div class="col-12 d-flex align-self-end  mt-3"><button name="increment" class="p-2 px-4 baseBtnBg border-0 rounded mx-2 text-white m-auto Vsmall">
                                    Create
                                </button></div>
                        </div>
                    </form>
                </div>
                <!-- increment letter -->
                <!-- appraisal letter -->
                <div class="table" id="table4" style="display: none;">
                    <div class=" align-items-center my-2">
                        <p class="para m-0 text-center fw-bold">Appraisal Letter</p>
                    </div>
                    <form action="{{env('APP_URL')}}adper/user_letter">
                        <input type="hidden" name="id" value="{{$profile->id}}">
                        <div class="row">
                            <div class="col-6">
                                <label class="Vsmall fw-bold" for="">Title<span class="text-danger">*</span></label>
                                <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                                    <i class="fa-solid fa-user inputicon"></i>
                                    <input type="text" name="title" placeholder="Mr./Ms." value="{{$profile->gender == 'Male' ? 'Mr.' : 'Mrs.'}}" class="border-0 w-100 bg-white p-1 Vsmall fw-bold text-capitalize Vsmall fw-bold">
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="Vsmall fw-bold" for="">First Name<span class="text-danger">*</span></label>
                                <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                                    <i class="fa-solid fa-user inputicon"></i>
                                    <input type="text" name="fname" required placeholder="Enter First Name" value="{{explode(' ', $profile->name)[0]}}" class="border-0 w-100 bg-white p-1 Vsmall fw-bold text-capitalize Vsmall fw-bold">
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="Vsmall fw-bold" for="">Last Name</label>
                                <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                                    <i class="fa-solid fa-user inputicon"></i>


                                    <input type="text" name="lname" placeholder="Enter Last Name" value="@if(isset($nameParts[1])) {{$nameParts[1]}} @endif" class="border-0 w-100 bg-white p-1 Vsmall fw-bold text-capitalize Vsmall fw-bold">
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="Vsmall fw-bold" for="">Position<span class="text-danger">*</span></label>
                                <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                                    <i class="fa-solid fa-user inputicon"></i>
                                    <input placeholder="Enter Candidate Position" value="{{$profile->designation}}" name="position" required class="border-0 w-100 bg-white p-1 Vsmall fw-bold text-capitalize Vsmall fw-bold">
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="fontmed" for="">Promoted<span class="text-danger">*</span></label>
                                <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                    <i class="fa-solid fa-user inputicon"></i>
                                    <input type="text" name="promoted" placeholder="Enter permoted designaiton" class="border-0 w-100 bg-white p-1 Vsmall fw-bold">
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="fontmed" for="">Department<span class="text-danger">*</span></label>
                                <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                    <i class="fa-solid fa-building  inputicon"></i>
                                    <input type="text" name="department" required placeholder="Enter Candidate Department" class="border-0 w-100 bg-white p-1 Vsmall fw-bold">
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="fontmed" for="">Effect From Date<span class="text-danger">*</span></label>
                                <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                    <i class="fa-solid fa-calendar-days inputicon"></i>
                                    <input type="date" name="date" value="<?php echo date('Y-m-d'); ?>" placeholder="Enter Date" class="border-0 w-100 bg-white p-1 Vsmall fw-bold">
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="Vsmall fw-bold" for="">Salary<span class="text-danger">*</span></label>
                                <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                                    <i class="fa-solid fa-money-bill-1-wave inputicon"></i>
                                    <input placeholder="salary" type="number" name="salary" value="{{$profile->salary}}" class="border-0 w-100 bg-white p-1 Vsmall fw-bold">
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="fontmed" for="">Email<span class="text-danger">*</span></label>
                                <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                    <i class="fa-solid fa-envelope  inputicon"></i>
                                    <input type="email" name="email" placeholder="Enter Candidate Email" value="{{$profile->email}}" class="border-0 w-100 bg-white p-1 Vsmall fw-bold">
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="fontmed" for="">Sign designation<span class="text-danger">*</span></label>
                                <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                    <i class="fa-solid fa-signature   inputicon"></i>
                                    <input type="text" name="sign_deg" placeholder="Sign designation" class="border-0 w-100 bg-white p-1 Vsmall fw-bold">
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="fontmed" for="">Sign<span class="text-danger">*</span></label>
                                <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                    <i class="fa-solid fa-signature  inputicon"></i>
                                    <input type="text" name="sign" placeholder="Sign " class="border-0 w-100 bg-white p-1 Vsmall fw-bold">
                                </div>
                            </div>
                            <div class="col-6 d-flex align-self-end  mt-3"><button name="appraisal" class="p-2 px-4 baseBtnBg border-0 rounded mx-2 text-white">
                                    Create
                                </button></div>
                        </div>
                    </form>
                </div>
                <!-- appraisal letter -->
                <!-- Relieving & Experience letter -->
                <div class="table" id="table5" style="display: none;">
                    <div class=" align-items-center my-2">
                        <p class="para m-0 text-center fw-bold">Relieving and Experience Letter</p>
                    </div>
                    <form action="{{env('APP_URL')}}adper/user_letter">
                        <input type="hidden" name="id" value="{{$profile->id}}">
                        <div class="row">
                            <div class="col-6">
                                <label class="Vsmall fw-bold" for="">Title<span class="text-danger">*</span></label>
                                <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                                    <i class="fa-solid fa-user inputicon"></i>
                                    <input type="text" name="title" placeholder="Mr./Ms." value="{{$profile->gender == 'Male' ? 'Mr.' : 'Mrs.'}}" class="border-0 w-100 bg-white p-1 Vsmall fw-bold text-capitalize Vsmall fw-bold">
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="Vsmall fw-bold" for="">First Name<span class="text-danger">*</span></label>
                                <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                                    <i class="fa-solid fa-user inputicon"></i>
                                    <input type="text" name="fname" required placeholder="Enter First Name" value="{{explode(' ', $profile->name)[0]}}" class="border-0 w-100 bg-white p-1 Vsmall fw-bold text-capitalize Vsmall fw-bold">
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="Vsmall fw-bold" for="">Last Name</label>
                                <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                                    <i class="fa-solid fa-user inputicon"></i>


                                    <input type="text" name="lname" placeholder="Enter Last Name" value="@if(isset($nameParts[1])) {{$nameParts[1]}} @endif" class="border-0 w-100 bg-white p-1 Vsmall fw-bold text-capitalize Vsmall fw-bold">
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="Vsmall fw-bold" for="">Position<span class="text-danger">*</span></label>
                                <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                                    <i class="fa-solid fa-user inputicon"></i>
                                    <input placeholder="Enter Candidate Position" value="{{$profile->designation}}" name="position" required class="border-0 w-100 bg-white p-1 Vsmall fw-bold text-capitalize Vsmall fw-bold">
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="Vsmall fw-bold" for="">Address<span class="text-danger">*</span></label>
                                <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                    <i class="fa-solid fa-map-pin inputicon"></i>
                                    <textarea type="text" name="address" placeholder="Enter Candidate Position" class="border-0 w-100 bg-white p-1 Vsmall fw-bold Vsmall fw-bold" rows="1"> {{$profile->prmt_adrs}}</textarea>
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="fontmed" for="">Department<span class="text-danger">*</span></label>
                                <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                    <i class="fa-solid fa-building  inputicon"></i>
                                    <input type="text" name="department" required placeholder="Enter Candidate Department" value="{{$profile->d_name}}" class="border-0 w-100 bg-white p-1 Vsmall fw-bold">
                                </div>
                            </div>

                            <div class="col-6">
                                <label class="fontmed" for=""> Date<span class="text-danger">*</span></label>
                                <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                    <i class="fa-solid fa-calendar-days inputicon"></i>
                                    <input type="date" name="date" value="<?php echo date('Y-m-d'); ?>" placeholder="Enter Date" class="border-0 w-100 bg-white p-1 Vsmall fw-bold">
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="fontmed" for="">From Date<span class="text-danger">*</span></label>
                                <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                    <i class="fa-solid fa-calendar-days inputicon"></i>
                                    <input type="date" name="fdate" placeholder="Enter Date" class="border-0 w-100 bg-white p-1 Vsmall fw-bold">
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="fontmed" for="">To Date<span class="text-danger">*</span></label>
                                <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                    <i class="fa-solid fa-calendar-days inputicon"></i>
                                    <input type="date" name="tdate" placeholder="Enter Date" class="border-0 w-100 bg-white p-1 Vsmall fw-bold">
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="fontmed" for="">Gender<span class="text-danger">*</span></label>

                                <div class="p-2 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                    <div class="me-4 ms-2">
                                        <input type="radio" name="gender" required value="He" {{ $profile->gender === 'male' ? 'checked' : '' }}>
                                        <label for="html" class="m-0"><i class="fa-solid fa-person"></i> male</label>
                                    </div>
                                    <div class="me-4 ms-2">
                                        <input type="radio" name="gender" required value="She" {{ $profile->gender === 'female' ? 'checked' : '' }}>
                                        <label for="css" class="m-0"> <i class="fa-solid fa-person-dress"></i> female</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="fontmed" for="">Email<span class="text-danger">*</span></label>
                                <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                    <i class="fa-solid fa-envelope  inputicon"></i>
                                    <input type="email" name="email" placeholder="Enter Candidate Email" value="{{$profile->email}}" class="border-0 w-100 bg-white p-1 Vsmall fw-bold">
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="fontmed" for="">Sign designation<span class="text-danger">*</span></label>
                                <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                    <i class="fa-solid fa-signature   inputicon"></i>
                                    <input type="text" name="sign_deg" placeholder="Sign designation" class="border-0 w-100 bg-white p-1 Vsmall fw-bold">
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="fontmed" for="">Sign<span class="text-danger">*</span></label>
                                <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                    <i class="fa-solid fa-signature  inputicon"></i>
                                    <input type="text" name="sign" placeholder="Sign " class="border-0 w-100 bg-white p-1 Vsmall fw-bold">
                                </div>
                            </div>
                            <div class="col-6 d-flex align-self-end  mt-3"><button name="experience" class="p-2 px-4 baseBtnBg border-0 rounded mx-2 text-white">
                                    Create
                                </button></div>
                        </div>
                    </form>
                </div>
                <!-- Relieving & Experience letter -->
            </div>

        </div>
    </div>
</div>
@include('user.includes.footer')
<script>
    // work type
    function saveRow(a, id) {
        if (a.checked) {
            $.get('{{env('APP_URL')}}adper/worktype?id=' + id + '&worktype=1',
                function(data, status) {});
        } else {
            $.get('{{env('APP_URL')}}adper/worktype?id=' + id + '&worktype=2',
                function(data, status) {});
        }
    }
    // work type end
    function navchange(id) {
        $('#nav-home').removeClass('show active');
        $('#nav-attendance').removeClass('show active');
        $('#nav-leave').removeClass('show active');
        $('#nav-file').removeClass('show active');
        $('#' + id).addClass('show active');

        $('#nav-home-tab').removeClass('active');
        $('#nav-attendance-tab').removeClass('active');
        $('#nav-leave-tab').removeClass('active');
        $('#nav-file-tab').removeClass('active');
        $('#' + id + '-tab').addClass('active');
    }
    $('#{{$showtab}}-tab').click();
    // Add a global variable to keep track of whether the setting is shown or hidden
    let isSettingVisible = false;

    function settingTab() {
        let setting = document.getElementsByClassName('unq')[0];
        let icon = document.getElementById('set_btn');

        if (isSettingVisible) {
            setting.classList.add('shrinking');
            setting.addEventListener('animationend', function() {
                setting.style.display = 'none';
            }, {
                once: true
            });
        } else {
            setting.style.display = 'block';
            setting.classList.remove('shrinking');
        }
        if (icon.classList.contains('rotateForward')) {
            icon.classList.remove('rotateForward');
            icon.classList.add('rotateBackward');
            icon.style.color = 'black';
        } else {
            icon.classList.remove('rotateBackward');
            icon.classList.add('rotateForward');
            icon.style.color = '#006396';
        }
        // Toggle the visibility state
        isSettingVisible = !isSettingVisible;
    }

    // Add a click event listener to the document to hide the setting when clicking outside
    document.addEventListener('click', function(event) {
        let setting = document.getElementsByClassName('unq')[0];
        let icon = document.getElementById('set_btn');

        if (isSettingVisible && !setting.contains(event.target) && !icon.contains(event.target)) {
            setting.classList.add('shrinking');
            setting.addEventListener('animationend', function() {
                setting.style.display = 'none';
            }, {
                once: true
            });
            if (icon.classList.contains('rotateForward')) {
                icon.classList.remove('rotateForward');
                icon.classList.add('rotateBackward');
                icon.style.color = 'black';
            } else {
                icon.classList.remove('rotateBackward');
                icon.classList.add('rotateForward');
                icon.style.color = '#006396';
            }
            // Toggle the visibility state
            isSettingVisible = false;
        }
    });


    function showSalPass(type, element) {
        if (type === 'salary') {
            let salry = document.getElementById('userSalry');
            if (salry.innerText === '########') {
                salry.innerText = '{{ $profile->salary ? $profile->salary : 'NA'}}';
                element.querySelector('i').classList.replace('fa-eye-slash', 'fa-eye');
            } else {
                salry.innerText = '########';
                element.querySelector('i').classList.replace('fa-eye', 'fa-eye-slash');
            }
        } else if (type === 'password') {
            let pass = document.getElementById('userpass');
            if (pass.innerText === '########') {
                pass.innerText = '{{ $profile->password ? $profile->password : 'x`x`x`x`NA'}}';
                element.querySelector('i').classList.replace('fa-eye-slash', 'fa-eye');
            } else {
                pass.innerText = '########';
                element.querySelector('i').classList.replace('fa-eye', 'fa-eye-slash');
            }
        }
    }
    // lettere tabs
    var tabs = document.querySelectorAll(".tab");
    var tables = document.querySelectorAll(".table");

    for (var i = 0; i < tabs.length; i++) {
        tabs[i].addEventListener("click", function() {
            for (var j = 0; j < tabs.length; j++) {
                tabs[j].style.backgroundColor = "#8f8e8eb7";
            }
            this.style.backgroundColor = "#FFB02E";

            for (var j = 0; j < tables.length; j++) {
                tables[j].style.display = "none";
            }
            document.getElementById(this.dataset.tableId).style.display = "block";
        });
    }
</script>