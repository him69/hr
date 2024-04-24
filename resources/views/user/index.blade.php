@include('user.includes.header')
<link rel="stylesheet" href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css">
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/3.6.95/css/materialdesignicons.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
<link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
<div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
    <style>
        .truncate {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 150px;
        }

        .notice {
            padding: 20px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
        }

        .notice h2 {
            font-size: 20px;
            color: #0088cc;
            margin-bottom: 10px;
        }

        .notice p {
            line-height: 1.6;
        }

        .notice ul {
            padding-left: 20px;
        }

        .disabled-link {
            pointer-events: none;
            /* Disables click events */
            color: #999;
            /* Change the color to indicate it's disabled */
            text-decoration: none;
            /* Remove underline */
            cursor: default;
            /* Set cursor to default */
        }
        .modal-dialog.modal-dialog-centered{
            box-shadow: unset
        }
        .fixed-header .app-header {
    position: fixed;
    width: calc(100% - 200px);
    top: 0;
    margin-left: 200px;
    background: #f1f4f6;
}
        @media only screen and (max-width: 768px) {
        .fixed-header .app-header {
    position: fixed;
    width: 100%;
    top: 0;
    margin-left: 0;
    background: #f1f4f6;
}}

    </style>
    @include('user.includes.top_nav')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs5.min.css" />
    <div class="app-main position-ralative overflow-hidden">
        @include('user.includes.sidebar')
        <div class="app-main__outer">
            <div class="app-main__inner mb-3 position-relative">
                <script>
                    function salslip(a) {
                        $('#sal').attr('href', "{{ env('APP_URL') }}payslip?month=" + a.value);
                    }
                </script>
                @if (empty(\Session::get('hb')))
                    <?php $request->session()->put('hb', 1); ?>
                    <div class="d-flex align-items-center justify-content-center shadow-sm p-2"
                        style="border-radius: 0px 0px 15px 15px;top: 41px;width: 96%;background: #EEFAFB;left: 50%;">
                        <div class="mx-4" style="color:#006396;">
                            <i class="fa-regular fa-face-laugh-beam fa-3x mx"></i>
                        </div>
                        <div>
                            <p class="fw-bold text-center fs-3 m-0">Greeting of the day,
                                <span>{{ $user->name ? $user->name : $user->user_id }}</span>
                            </p>
                            <p class="fw-bold text-center fs-4 m-0" style="color:#006396;">Have a great day ahead</p>
                        </div>
                        <div class="mx-4" style="color:#006396;">
                            <i class="fa-regular fa-face-laugh-beam fa-3x"></i>
                        </div>
                    </div>
                @endif
                @if ($user->joining_date <= date('Y-m-d', strtotime('-1 week')))
                @else
                    @if ($isEmpty || $policy_exist || $ass_exist || !$traning_exist)

                        <div class="rounded-2 bg-white p-2 my-3">
                            <p class="h4 fw-bold text-center">Set up your <span class="cttext">HR Portal</span> in just
                                4 simple
                                steps</p>
                            <div class="row justify-content-between mt-3">
                                <div class="col-6">

                                    <p
                                        class="my-2 @if ($isEmpty) @else text-decoration-line-through text-muted @endif">
                                        <span class="mx-2  cttext ">
                                            @if ($isEmpty)
                                                <i class="fa-regular fa-square"></i>
                                            @else
                                                <i class="fa-regular fa-square-check"></i>
                                            @endif
                                        </span> Upload Documnets and details <a href="{{ env('APP_URL') }}profile/edit"
                                            class="@if ($isEmpty) text-primary @else disabled-link @endif">Click
                                            Here</a>
                                    </p>

                                    <p
                                        class="my-2 @if ($policy_exist) @else text-decoration-line-through text-muted @endif">
                                        <span class="mx-2  cttext ">
                                            @if ($policy_exist)
                                                <i class="fa-regular fa-square"></i>
                                            @else
                                                <i class="fa-regular fa-square-check"></i>
                                            @endif
                                        </span> Accept all policies <a href="#"
                                            class="@if ($policy_exist) text-primary @else disabled-link @endif">Click
                                            Here</a>
                                    </p>

                                    {{-- <p class="my-2  "> <span class="mx-2 cttext "><i class="fa-regular fa-square"></i></span> Accept all policies<a
                                    href="#" class="text-primary"> Click Here</a></p> --}}
                                </div>
                                <div class="col-6">
                                    <p
                                        class="my-2 @if ($ass_exist) @else text-decoration-line-through text-muted @endif">
                                        <span class="mx-2  cttext ">
                                            @if ($ass_exist)
                                                <i class="fa-regular fa-square"></i>
                                            @else
                                                <i class="fa-regular fa-square-check"></i>
                                            @endif
                                        </span> Verify Assigned assets <span data-bs-toggle="modal"
                                            data-bs-target="#assetsinfo"
                                            class="@if ($ass_exist) text-primary @else disabled-link @endif">Click
                                            Here</span>
                                    </p>
                                    <p
                                        class="my-2 @if (!$traning_exist) @else text-decoration-line-through text-muted @endif">
                                        <span class="mx-2  cttext ">
                                            @if (!$traning_exist)
                                                <i class="fa-regular fa-square"></i>
                                            @else
                                                <i class="fa-regular fa-square-check"></i>
                                            @endif
                                        </span> Traning of Crm and Hr Portal <span data-bs-toggle="modal"
                                            data-bs-target="#traninghr"
                                            class="@if (!$traning_exist) text-primary @else disabled-link @endif">Click
                                            Here</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @else
                    @endif

                @endif
                <div class="row my-4 px-2">
                    <div class="alert alert-danger text-center">Your @foreach($document as $user_doc) {{$user_doc->document_name}} @if(!$loop->last), @endif @endforeach Rejected Uploded it again ! <a href="{{env('APP_URL')}}profile/documentUpload">Click here</a>
                    </div>
                    @if ($user->user_type == 1)
                        <div class=" col-lg-7 col-12 p-2 order-2">
                            <div class="bg-white rounded-2 p-2">
                            <div class="">
                                <p
                                    class="border-bottom border-2 border-start-0 border-end-0 border-top-0 h4 fw-bold text-center">
                                    Here is your detailed dashboard</p>
                            </div>
                            <div class="row mx-0 my-2 mt-3">
                                @if ($user->server_ip == '144.76.0.239')
                                    @php($targ = round(($user->salary / 1000 / 100) * $us_umst))
                                    @php($leadtarg = $ulta)
                                    @php($us_umtv = $us_umt ? $us_umt : 100)
                                    @php($bttf = ($user->salary / 1000 / 100) * $us_umtv)
                                    @php($ftarg = round($bttf))
                                @else
                                    @php($targ = $us_umst)
                                    @php($us_umtv = $us_umt ? $us_umt : $us_umst)
                                    @php($ftarg = $us_umtv)
                                    @php($leadtarg = $ulta)
                                @endif
                                <div class="px-4 py-2 col-md-6 col-12">
                                    <div
                                        class="d-flex py-2 border-bottom border-2 border-start-0 border-end-0 border-top-0 ">
                                        <div class="w-100">
                                            <p class="smaTxt m-0 me-4 ">Total <span class="fw-bold"
                                                    style="color:#212E50;">Daily </span> Incentives
                                            </p>
                                            <div
                                                class="d-flex justify-content-between align-items-center baseShadow rounded p-2 my-2">
                                                <div class="d-flex">
                                                    <p class="para m-0 fontmed smText px-3 border-end">Rs</p>
                                                    <p class="para m-0 fontmed smText px-3">{{ $total_incentive }}</p>
                                                </div>
                                                @if ($targ > $total_sales or $leadtarg > $total_leads)
                                                    <div
                                                        class="samllText text-white rounded-circle smbr text-center lh-base bg-warning">
                                                        <i class="bi bi-exclamation"></i>
                                                    </div>
                                                @else
                                                    <div
                                                        class="samllText text-white rounded-circle smbr text-center lh-base bg-success">
                                                        <i class="bi bi-check"></i>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                    <div
                                        class="d-flex py-2 border-bottom border-2 border-start-0 border-end-0 border-top-0">
                                        <div class="w-100">
                                            <p class="smaTxt  m-0 ">Total <span class="fw-bold"
                                                    style="color:#212E50;">monthly</span> incentives</p>
                                            <div
                                                class="d-flex justify-content-between align-items-center baseShadow rounded p-2 my-2">
                                                @if ($total_sales >= $ftarg and $leadtarg <= $total_leads)
                                                    @php($mts = $total_sales - $ftarg)
                                                    @if ($user->server_ip == '144.76.0.239')
                                                        <div class="d-flex justify-content-between">
                                                            <p class="para m-0 fontmed smText px-3 border-end">Rs</p>
                                                            <p class="para m-0 fontmed smText px-3">
                                                                {{ $basePay + $mts * 500 }}</p>
                                                        </div>
                                                        <div
                                                            class="samllText text-white rounded-circle smbr text-center lh-base bg-success">
                                                            <i class="bi bi-check"></i>
                                                        </div>
                                                    @else
                                                        <div class="d-flex justify-content-between">
                                                            <p class="para m-0 fontmed smText px-3 border-end">Rs</p>
                                                            <p class="para m-0 fontmed smText px-3">
                                                                {{ $basePay + $mts * 500 }}</p>
                                                        </div>
                                                        <div
                                                            class="samllText text-white rounded-circle smbr text-center lh-base bg-success">
                                                            <i class="bi bi-check"></i>
                                                        </div>
                                                    @endif
                                                @else
                                                    @if ($user->server_ip == '144.76.0.239')
                                                        <div class="d-flex justify-content-between">
                                                            <p class="para m-0 fontmed smText px-3 border-end">Rs</p>
                                                            <p class="para m-0 fontmed smText px-3">{{ $basePay }}
                                                            </p>
                                                    </div> @else<div class="d-flex justify-content-between">
                                                            <p class="para m-0 fontmed smText px-3 border-end">Rs</p>
                                                            <p class="para m-0 fontmed smText px-3">{{ $basePay }}
                                                            </p>
                                                        </div>
                                                    @endif
                                                    <div
                                                        class="samllText text-white rounded-circle smbr text-center lh-base bg-warning">
                                                        <i class="bi bi-exclamation"></i>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex py-2">
                                        <div class="w-100">
                                            <p class="smaTxt m-0 fontmed me-4">Total Salary Till Today</p>
                                            <div class=" baseBtnBg rounded p-2 my-2">
                                                <div class=" d-flex justify-content-between align-items-center"
                                                    onclick="getsalary(this)">
                                                    <p class="m-0 smaTxt">click here to view</p>
                                                    <div
                                                        class="samllText text-white rounded-circle smbr text-center lh-base">
                                                        <i class="bi bi-caret-right"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="border rounded p-1 d-flex justify-content-between">
                                        <div class=" d-flex align-items-center ">
                                            <div
                                                class="samllText mx-2 text-white rounded-circle smbr text-center lh-base bg-success">
                                                <i class="bi bi-check"></i>
                                            </div>
                                            <p class="m-0 vsmatxt smText ">payable amount</p>
                                        </div>
                                        <div class="mx-1" style="background: black;width: 1px;"></div>
                                        <div class="d-flex align-items-center ">
                                            <div
                                                class="samllText mx-2 text-white rounded-circle smbr text-center lh-base bg-warning">
                                                <i class="bi bi-exclamation"></i>
                                            </div>
                                            <p class="m-0 vsmatxt smText ">Not Payable!</p>
                                        </div>
                                    </div>

                                </div>
                                <div class="border rounded px-4 col-md-6 my-2 col-12">
                                    <p
                                        class="border-bottom border-2 border-start-0 border-end-0 border-top-0 h4 fw-bold text-center">
                                        Sales & Bonuses</p>
                                    <div
                                        class="d-flex py-2 border-bottom border-2 border-start-0 border-end-0 border-top-0 w-100">
                                        <div
                                            class="mx-2 mt-1 samllText text-white rounded-circle bibr text-center lh-sm bgMute text-white p-1">
                                            <i class="bi bi-trophy"></i>
                                        </div>
                                        <div class="w-100">
                                            <p class="smaTxt m-0 fontmed">Minimum Sales Target</p>
                                            <div class=" rounded-pill overflow-hidden my-2">
                                                <div class=" rounded-pill baseBtnbr baseBtnBgli w-100">
                                                    <div class="baseBtnBg rounded-pill-start p-1"
                                                        style="width:@if ($targ < $total_sales) {{ ceil(($targ / $targ) * 100) }}@else{{ ceil(($total_sales / $targ) * 100) }} @endif%; height:26px;">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <div class="fw-bold vsmatxt">
                                                    @if ($targ < $total_sales)
                                                        {{ $targ }}@else{{ $total_sales }}
                                                    @endif/{{ $targ }}
                                                </div>
                                                <div class="vsmatxt">
                                                    @if ($targ < $total_sales)
                                                        {{ ceil(($targ / $targ) * 100) }}@else{{ ceil(($total_sales / $targ) * 100) }}
                                                    @endif% complete
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if ($leadtarg > 0)
                                        <div
                                            class="d-flex py-2 border-bottom border-2 border-start-0 border-end-0 border-top-0 w-100">
                                            <div
                                                class="mx-2 mt-1 samllText text-white rounded-circle bibr text-center lh-sm bgMute text-white p-1">
                                                <i class="bi bi-trophy"></i>
                                            </div>
                                            <div class="w-100">
                                                <p class="smaTxt m-0 fontmed">Minimum Leads Target</p>
                                                <div class=" rounded-pill overflow-hidden my-2">
                                                    <div class=" rounded-pill baseBtnbr baseBtnBgli w-100">
                                                        <div class="baseBtnBg rounded-pill-start p-1"
                                                            style="width:@if ($leadtarg < $total_leads) {{ 100 }}@else{{ ceil(($total_leads / $leadtarg) * 100) }} @endif%; height:26px;">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-between">
                                                    <div class="fw-bold vsmatxt">
                                                        @if ($leadtarg < $total_leads)
                                                            {{ $leadtarg }}@else{{ $total_leads }}
                                                        @endif/{{ $leadtarg }}
                                                    </div>
                                                    <div class="vsmatxt">
                                                        @if ($leadtarg < $total_leads)
                                                            {{ ceil(($leadtarg / $leadtarg) * 100) }}@else{{ ceil(($total_leads / $leadtarg) * 100) }}
                                                        @endif% complete
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="d-flex py-2">
                                        <div>
                                            <div
                                                class="mx-2 mt-1 samllText text-white rounded-circle bibr text-center lh-sm bgMute text-white p-1">
                                                <i class="bi bi-trophy"></i>
                                            </div>
                                        </div>
                                        <div class="w-100">
                                            <p class="smaTxt m-0 fontmed">Target for Monthly bonus
                                            </p>
                                            <div class="d-flex rounded-pill overflow-hidden my-2">
                                                <div class="rounded-pill  baseBtnbr baseBtnBgli w-100">
                                                    <div class="bbb rounded-pill-start p-1"
                                                        style="width:{{ ($total_sales / $ftarg) * 100 }}%; height:26px;">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <div class="fw-bold vsmatxt"> {{ $total_sales }}/{{ $ftarg }}
                                                </div>
                                                <div class="vsmatxt">{{ ($total_sales / $ftarg) * 100 }}% complete
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="m-auto my-1 " style="width: 157px;height: 37px;">
                                        <div class="rounded-pill baseShadow d-flex justify-content-around align-items-center"
                                            style="height: 100%;">
                                            <div
                                                class="mx-2 samllText text-white rounded-circle bibr text-center lh-sm baseBtnBg  text-white p-1">
                                                <i class="bi bi-house-heart"></i>
                                            </div>
                                            <a href="https://crm.pantheondigitals.com/" target="_blank"
                                                class="m-0 me-2 fw-bold" style="color:#006396;">Go to CRM</a>
                                        </div>
                                    </div>
                                    <div class="m-auto my-1 " style="width: 157px;height: 37px;">
                                        <div class="rounded-pill baseShadow d-flex justify-content-around align-items-center"
                                            style="height: 100%;">
                                            <div
                                                class="mx-2 samllText text-white rounded-circle bibr text-center lh-sm baseBtnBg  text-white p-1">
                                                <i class="bi bi-house-heart"></i>
                                            </div>
                                            <a href="@if ($user->server_ip == '144.76.0.239') {{ 'http://176.9.17.110:9090' }}@else{{ 'http://122.186.6.91' }} @endif"
                                                target="_blank" class="m-0 me-2 fw-bold" style="color:#006396;">Go to
                                                Dialer</a>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="vsmaTxt m-0 fontmed smText text-center my-2">You're doing great keep
                                            it up!!!</p>
                                    </div>

                                </div>
                            </div>
                        </div>
                        </div>
                    @elseif($user->user_type == 4)
                        <div class="col-lg-4">
                            <div class="baseShadow borderRadius p-3 my-2">
                                <p class="fw-bold smaTxt">working From Home</p>
                                <div class="d-flex my-4">
                                    <div class="d-flex w-100">
                                        <div class="w-100 mx-2">
                                            <form action="{{ env('APP_URL') }}wfh" method="post">
                                                @csrf
                                                <div class="d-flex align-items-center flex-column">
                                                    <div class="row">
                                                        <div class="col-6 text-start">
                                                            <label class="text-start smaTxt fontmed"
                                                                style="color:#212E50;">From</label>
                                                            <input type="date" class="form-control my-2"
                                                                name="from" required="">
                                                        </div>
                                                        <div class="col-6 text-start">
                                                            <label class="text-start smaTxt fontmed"
                                                                style="color:#212E50;">To</label>
                                                            <input type="date" class="form-control my-2"
                                                                name="to" required="">
                                                        </div>
                                                    </div>
                                                    <button class="btn baseBtnBg w-100 my-3" type="submit">
                                                        <div
                                                            class=" d-flex justify-content-between align-items-center">
                                                            <p class="m-0 smaTxt">Submit</p>
                                                            <div
                                                                class="samllText text-white rounded-circle smbr text-center lh-base">
                                                                <i class="bi bi-caret-right"></i>
                                                            </div>
                                                        </div>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="baseShadow borderRadius p-3 my-2">
                                <p class="fw-bold smaTxt">Download salary slip</p>
                                <div class="d-flex my-4">
                                    <div class="d-flex w-100">
                                        <div class="w-100 mx-2">
                                            <label class="smaTxt fontmed" style="color:#212E50;">Salary slip</label>
                                            <div class="d-flex align-items-center flex-column">
                                                <input type="month" class="form-control my-2" name="month"
                                                    value="{{ $date }}" required=""
                                                    onchange="salslip(this)">
                                                <a id="sal"
                                                    href="{{ env('APP_URL') }}payslip?month={{ $date }}"
                                                    class="w-100">
                                                    <button class="btn baseBtnBg w-100 my-3">
                                                        <div
                                                            class=" d-flex justify-content-between align-items-center">
                                                            <p class="m-0 smaTxt">Submit</p>
                                                            <div
                                                                class="samllText text-white rounded-circle smbr text-center lh-base">
                                                                <i class="bi bi-caret-right"></i>
                                                            </div>
                                                        </div>
                                                    </button>
                                                </a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div
                        class=" @if ($user->user_type == 4) col-lg-4 col-12 d-flex @else col-lg-5 col-12 order-1 @endif">
                        @if ($user->user_type !== 4)
                            <div class="row mb-4 ">
                                <div class="col-6 ">
                                    <form method="get">
                                        <div
                                            class="row p-1 gx-0 justify-content-between bg-transparent baseShadow baseBtnbr rounded-2">
                                            <div class="col-9">
                                                <input type="month" name="date" value="{{ $date }}"
                                                    class="form-control border-0 bg-transparent"
                                                    onchange="salslip(this)">
                                            </div>

                                            <div class="col-3">
                                                <button class="btn baseBtnBg w-100 h-140">
                                                    <span class=""><i class="bi bi-search"></i></span>
                                                </button>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                                <div class="col-6">
                                    <div class=" bg-white baseShadow rounded-2">

                                        <a id="sal"
                                            href="{{ env('APP_URL') }}payslip?month={{ $date }}"><button
                                                class="btn text-decoration-none baseBtnBg align-items-center justify-content-between d-flex w-100 h-140">
                                                <p class="m-0">Salary Slip</p>
                                                <div class="p-1 px-2 baseBtnBgli rounded">
                                                    <i class="fa-solid fa-download cttext "></i>
                                                </div>
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="borderRadius baseShadow p-3 my-2 atten w-100">
                            <p
                                class="border-bottom border-2 border-start-0 border-end-0 border-top-0 h4 fw-bold text-center">
                                Mark @if ($user->user_type == 4)
                                    @else{{ 'Your' }}
                                @endif Attendance</p>
                            <form action="{{ env('APP_URL') }}attendance/mark" method="post">
                                @csrf
                                @if ($user->user_type == 1)
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class=" ">
                                                    <lable class=" smaTxt fontmed" style="color:#212E50;">Logout Time
                                                        (Australia time)</lable>
                                                </div>
                                                <input type="time" class="form-control my-2"
                                                    value="{{ date('H:i') }}" name="logout_time" required>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <!--<div class="form-group">-->
                                            <!--    <div class=" ">-->
                                            <!--        <lable class=" smaTxt fontmed" style="color:#212E50;">No of sale</lable>-->
                                            <!--    </div>-->
                                            <!--    <input type="number" class="form-control my-2"-->
                                            <!--        placeholder="Sale Made" name="sale_made" min="0" required>-->
                                            <!--</div>-->
                                        </div>
                                        <div class="col-6">
                                            <!--<div class="form-group">-->
                                            <!--    <div class=" ">-->
                                            <!--        <lable class=" smaTxt fontmed" style="color:#212E50;">No of customer</lable>-->
                                            <!--    </div>-->
                                            <!--    <input type="number"-->
                                            <!--        class="form-control my-2"-->
                                            <!--        placeholder="Sale Made" name="customer" min="0" required>-->
                                            <!--</div>-->
                                        </div>
                                        <div class="col-12"><b class="fontmed"
                                                style="color:#212E50;font-size:12px;">Note: Your sales/customer details
                                                will fetch from your CRM. If you find any error in your sales/customer
                                                raise a issue</b></div>
                                    </div>
                                @elseif($user->user_type == 2)
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class=" ">
                                                    <!--<i class="fa-regular fa-circle vsmatxt"></i>-->
                                                    <lable class="mx-2 smaTxt fontmed" style="color:#212E50;">Logout
                                                        Time</lable>
                                                </div>

                                                <input type="time" class="form-control my-2" name="logout_time"
                                                    value="{{ date('H:i') }}" value="{{ date('H:i') }}"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class=" ">
                                                    <!--<i class="fa-regular fa-circle vsmatxt"></i>-->
                                                    <lable class="mx-2 smaTxt fontmed" style="color:#212E50;">No of
                                                        Recording</lable>
                                                </div>

                                                <input type="text" class="form-control my-2"
                                                    placeholder="No of Recording" name="recording" required>
                                            </div>
                                        </div>
                                    </div>
                                @elseif($user->user_type == 3)
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class=" ">
                                                    <!--<i class="fa-regular fa-circle vsmatxt"></i>-->
                                                    <lable class="mx-2 smaTxt fontmed" style="color:#212E50;">Logout
                                                        Time</lable>
                                                </div>
                                                <input type="time" class="form-control my-2" name="logout_time"
                                                    {{ date('H:i') }} required>
                                            </div>
                                        </div>
                                    </div>
                                @elseif($user->user_type == 4)
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class=" ">
                                                    <!--<i class="fa-regular fa-circle vsmatxt"></i>-->
                                                    <lable class="mx-2 smaTxt fontmed" style="color:#212E50;">Logout
                                                        Time</lable>
                                                </div>
                                                <input type="time" class="form-control my-2" name="logout_time"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                @endif
                                @if ($user->user_type == 4)
                                    <div class=" row d-flex justify-content-between">
                                        <div>
                                            <button type="submit" class="btn baseBtnBg w-100">Submit
                                                attendance</button>
                                            <a href="{{ env('APP_URL') }}leave"
                                                class="btn btn-success w-100 mt-2">Apply for leave</a>
                                            <!--<p class="smText vsmatxt mt-1">-->
                                            <!--<span class="fw-bold">YAY!</span> Successfully submitted</span>-->
                                            <!--</p>-->
                                        </div>
                                    @else
                                        <div class=" d-flex justify-content-between my-4">
                                            <div>
                                                <button type="submit" class="btn baseBtnBg ">Submit
                                                    attendance</button>
                                                <!--<p class="smText vsmatxt mt-1">-->
                                                <!--<span class="fw-bold">YAY!</span> Successfully submitted</span>-->
                                                <!--</p>-->
                                            </div>
                                @endif
                                <div>
                                    <div class="p-1 rounded text-center" data-toggle="modal" data-target="#ChatSlide"
                                        style="border:0.5px solid #006396; color:#006396; position:fixed;bottom:15px;right:15px;width:90px;background:#fdfdfd;z-index: 2;">
                                        <div>
                                            <div class="rounded-circle baseBtnBg p-1 m-auto"
                                                style="height: 30px; width: 30px">
                                                <i class="fa-solid fa-comments"></i>
                                            </div>
                                        </div>
                                        <p class="m-0 smaTxt fw-bold">Chat here</p>
                                        <div class="d-flex justify-content-center align-items-center"
                                            style="width: 25px;height: 25px;background: green;position: absolute;right: -10px;top: -10px;border-radius: 100px;font-size: 12px;color:#fff;"
                                            id="tmess">0
                                        </div>
                                    </div>
                                </div>
                        </div>
                        </form>
                    </div>
                    <!-- <div class="pto p-3">
                            <p class="fs-4 text-center htcolor">"Your Are Present today &#128512;"</p>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ChatSlide">Chat</button>
                        </div> -->
                </div>
            </div>
            @if ($user->user_type == 1)
                <div class="baseShadow borderRadius p-1">
                    <div class="row p-1 align-items-center justify-content-center">
                        <div class="col-12">
                            <p class="text-center SubHeding m-0">Take a look on your monthly sales <span
                                    style="color:#006396;"> ({{ date('F Y', strtotime($date)) }})</span></p>
                        </div>
                    </div>
                    <div class="salesCalender p-1 mt-3">
                        <div class="">
                            @foreach ($attendance as $user_id => $att)
                                <div class="d-flex flex-wrap">
                                    @php($mte = 01)
                                    @foreach ($att as $day => $at)
                                        @if (
                                            $day == 'Total_P' or
                                                $day == 'Total_H' or
                                                $day == 'Total_A' or
                                                $day == 'sale_done' or
                                                $day == 'customer' or
                                                $day == 'id')
                                        @else
                                            @php($r = ($mte - 1) % 7)
                                            @if ($r == 0)
                                <tr>
                            @endif
                            @while ($mte < $day)
                                <?php $sd = $date . '-' . str_pad($mte, 2, '0', STR_PAD_LEFT);
                                $hddate = date_create($sd);
                                $hda = date_format($hddate, 'Y-m-d');
                                $timestamp = strtotime('' . $sd . '');
                                $sday = date('D', $timestamp); ?>
                                @if ($sday == 'Sun')
                                    <div class="smaTxt p-2 border " style="width:142px;">
                                        <div class="justify-content-around align-items-center d-flex">
                                            <div class="d-flex">
                                                <span
                                                    style="font-weight:700; color:#212E50;">{{ $mte }}</span>
                                                <span class="fw-light mx-2">({{ $sday }})</span>
                                            </div>
                                            <span class="sun px-2  text-center">SUN</span>
                                        </div>
                                    </div>
                                @elseif(App\Models\Holiday::where('hdate', $hda)->count() > 0)
                                    <div class="smaTxt p-2 border " style="width:142px;">
                                        <div class="justify-content-around align-items-center d-flex">
                                            <div class="d-flex">
                                                <span
                                                    style="font-weight:700; color:#212E50;">{{ $mte }}</span><span
                                                    class="fw-light mx-2">({{ $sday }})</span>
                                            </div>
                                            <span class="noSaleDay px-2  text-center"> NH</span>
                                        </div>
                                    </div>
                                @else
                                    <div class="smaTxt p-2 border" style="width:142px;">
                                        <div class="justify-content-around align-items-center d-flex">
                                            <div class="d-flex">
                                                <span
                                                    style="font-weight:700; color:#212E50;">{{ $mte }}</span><span
                                                    class="fw-light mx-2">({{ $sday }})</span>
                                            </div>
                                            <span class="noSaleDay absent px-2  text-center">A</span>
                                        </div>
                                    </div>
                                @endif
                                @php($r = $mte % 7)
                                @if ($r == 0)
                                </div>
                                @endif
                                @if ($r == 0)
                                    <div class="aa d-flex flex-wrap">
                                @endif
                                @php($mte++)
                            @endwhile
                            <?php $timestamp = strtotime('' . $date . '-' . str_pad($mte, 2, '0', STR_PAD_LEFT) . '');
                            $sday = date('D', $timestamp); ?>
                            @if ($sday == 'Sun')
                                <div class="smaTxt p-2 border" style="width:142px;">
                                    <div class="justify-content-around align-items-center d-flex">
                                        <div class="d-flex">
                                            <span style="font-weight:700; color:#212E50;">{{ $mte }}</span>
                                            <span class="fw-light mx-2">({{ $sday }})</span>
                                        </div>
                                        <!--<span class=" px-2  text-center">Sale: {{ $at }}</span>-->
                                    </div>
                                </div>
                            @elseif(App\Models\Holiday::where('hdate', $date . '-' . str_pad($mte, 2, '0', STR_PAD_LEFT))->count() > 0)
                                <div class="smaTxt p-2 border" style="width:142px;">
                                    <div class="justify-content-around align-items-center d-flex">
                                        <span style="font-weight:700; color:#212E50;">{{ $mte }}</span><span
                                            class="fw-light mx-2">({{ $sday }})</span>
                                    </div>
                                    <span style="font-weight:700;">{{ $mte }}</span> <span
                                        class="sun px-2  text-center">NH</span>
                    </div>
                </div>
                @else
                    <div class="smaTxt p-2 border" style="width:142px;">
                        <div class="justify-content-around align-items-center d-flex">
                            <div class="d-flex">
                                <span style="font-weight:700; color:#212E50;">{{ $mte }}</span><span
                                    class="fw-light mx-2">({{ $sday }})</span>
                            </div>
                            <span
                                class="@if ($at > 0) saleDone @else noSale @endif px-2  text-center">Sale:
                                {{ $at }}
                            </span>
                        </div>
                    </div>
            @endif
            @php($r = $mte % 7) @if ($r == 0)
                </tr>
            @endif
            @php($mte++)
            @endif
            @endforeach
            </div>
            @endforeach
        </div>
    </div>
        </div>
    @elseif($user->user_type == 4)
        <!--<div class="col-lg-12">-->
        <!--<div class="baseShadow borderRadius p-3 my-2"></div>-->
        <!--</div>-->
        @endif
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        setTimeout(function() {
            var elements = document.querySelectorAll(".dw");
            for (var i = 0; i < elements.length; i++) {
                elements[i].classList.add('welcom');
            }
            setTimeout(function() {
                for (var i = 0; i < elements.length; i++) {
                    elements[i].classList.remove('welcom');
                }
            }, 5000);

        }, 500);
    });
</script>

@if (date('m-d') === date('m-d', strtotime($user->dob)))
    @if (empty(\Session::get('happy')))
        <?php $request->session()->put('happy', 1); ?>
        <style>
            .bg-birth{
                position: absolute;
        font-size: 46px;
        background: url(/public/HappyBirthday.png);
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        height: 400px;
        aspect-ratio: 3/2;
        background-clip: border-box;
        background-repeat: no-repeat;
        padding-top: 271px;
        background-size: contain;
        font-family: "Pacifico", cursive;
        z-index:-1;
            }
        </style>
        <div class="position-absolute top-0 right-0 left-0 bottom-0 " style="z-index: 999;width: 100vw;height: 100vw;">
            <div class="position-relative">
                <div class="text-center  bg-birth shadow-sm rounded"> <h3 style="
">HIMANSHU GAUTAM</h3> </div>
                <canvas class="confetti" id="happy" width="1272" height="311"></canvas>
            </div> </div>
        <script>
            canvas = document.getElementById("happy");
            ctx = canvas.getContext("2d");
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
            cx = ctx.canvas.width / 2;
            cy = ctx.canvas.height / 2;

            let confetti = [];
            const confettiCount = 300;
            const gravity = 0.5;
            const terminalVelocity = 5;
            const drag = 0.075;
            const colors = [{
                    front: 'red',
                    back: 'darkred'
                },
                {
                    front: 'green',
                    back: 'darkgreen'
                },
                {
                    front: 'blue',
                    back: 'darkblue'
                },
                {
                    front: 'yellow',
                    back: 'darkyellow'
                },
                {
                    front: 'orange',
                    back: 'darkorange'
                },
                {
                    front: 'pink',
                    back: 'darkpink'
                },
                {
                    front: 'purple',
                    back: 'darkpurple'
                },
                {
                    front: 'turquoise',
                    back: 'darkturquoise'
                }
            ];


            //-----------Functions--------------
            resizeCanvas = () => {
                canvas.width = window.innerWidth;
                canvas.height = window.innerHeight;
                cx = ctx.canvas.width / 2;
                cy = ctx.canvas.height / 2;
            };

            randomRange = (min, max) => Math.random() * (max - min) + min;

            initConfetti = () => {
                for (let i = 0; i < confettiCount; i++) {
                    confetti.push({
                        color: colors[Math.floor(randomRange(0, colors.length))],
                        dimensions: {
                            x: randomRange(10, 20),
                            y: randomRange(10, 30)
                        },

                        position: {
                            x: randomRange(0, canvas.width),
                            y: canvas.height - 1
                        },

                        rotation: randomRange(0, 2 * Math.PI),
                        scale: {
                            x: 1,
                            y: 1
                        },

                        velocity: {
                            x: randomRange(-25, 25),
                            y: randomRange(0, -50)
                        }
                    });


                }
            };

            //---------Render-----------
            render = () => {
                ctx.clearRect(0, 0, canvas.width, canvas.height);

                confetti.forEach((confetto, index) => {
                    let width = confetto.dimensions.x * confetto.scale.x;
                    let height = confetto.dimensions.y * confetto.scale.y;

                    // Move canvas to position and rotate
                    ctx.translate(confetto.position.x, confetto.position.y);
                    ctx.rotate(confetto.rotation);

                    // Apply forces to velocity
                    confetto.velocity.x -= confetto.velocity.x * drag;
                    confetto.velocity.y = Math.min(confetto.velocity.y + gravity, terminalVelocity);
                    confetto.velocity.x += Math.random() > 0.5 ? Math.random() : -Math.random();

                    // Set position
                    confetto.position.x += confetto.velocity.x;
                    confetto.position.y += confetto.velocity.y;

                    // Delete confetti when out of frame
                    if (confetto.position.y >= canvas.height) confetti.splice(index, 1);

                    // Loop confetto x position
                    if (confetto.position.x > canvas.width) confetto.position.x = 0;
                    if (confetto.position.x < 0) confetto.position.x = canvas.width;

                    // Spin confetto by scaling y
                    confetto.scale.y = Math.cos(confetto.position.y * 0.1);
                    ctx.fillStyle = confetto.scale.y > 0 ? confetto.color.front : confetto.color.back;

                    // Draw confetti
                    ctx.fillRect(-width / 2, -height / 2, width, height);

                    // Reset transform matrix
                    ctx.setTransform(1, 0, 0, 1, 0, 0);
                });

                // Fire off another round of confetti
                if (confetti.length <= 10) initConfetti();

                window.requestAnimationFrame(render);
            };
            initConfetti();
            render();
            window.addEventListener('resize', function() {
                resizeCanvas();
            });
            window.addEventListener('click', function() {
                initConfetti();
            });
        </script>
    @endif
@endif
</div>
</div>
</div>
@if($user->user_type == 1)
@if (!empty($setupMessage))
               
<div class="modal fade" id="session"  tabindex="-1"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content border-success border-2">
        <div class=" align-self-end pe-7s-close fs-2 cursor-pointer" data-bs-dismiss="modal"
                    aria-bs-label="Close"></div>
        <div class="modal-body text-center">
           <p class="text-center">{{ $setupMessage }} </p> 
            <div class="d-flex justify-content-center">
                <div id="lottie-animation" style="width:150px;"></div>
    
            </div>
        </div>
       
      </div>
    </div>
  </div>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      var myModal = new bootstrap.Modal(document.getElementById('session'));
      myModal.show();
    });
  </script>
  @endif
  @endif
  <script src="https://cdn.jsdelivr.net/npm/lottie-web@5.9.4/build/player/lottie.min.js"></script>
<script>
     var animation = lottie.loadAnimation({
    container: document.getElementById('lottie-animation'), // the dom element that will contain the animation
    renderer: 'svg', // the rendering format, 'svg'/'canvas'/'html'
    loop: true, // whether to loop the animation
    autoplay: true, // whether to start playing the animation automatically
    path: 'https://lottie.host/fe174ccc-b6ac-414e-861e-6c0f3ad90f2b/uKAoftuMX3.json' // the path to the animation JSON
  });
</script>
<div class="chatboxx">
    <div class="modal fade" id="ChatSlide" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-slideout" role="document">
            <div class="modal-content" style="background-color: #f7f7f7;padding-left: 12px;overflow: hidden;">
                <div class="row bg-white">
                    <div class="col-12 col-sm-12 col-md-4 borderblue p-0">
                        <nav class="w-full h-14  rounded-tl flex justify-center items-center ">
                            <div>
                                <h5 class="usergrpname">Groups /Teammates
                                </h5>
                            </div>
                        </nav>
                        <hr>
                        <nav class="w-full h-14  rounded-tl flex justify-center items-center">
                            <form class="d-flex p-2">
                                <input class="form-control" type="search" placeholder="Search" aria-label="Search"
                                    style="box-shadow: 0px 1px 1px #00000029;" id="chatsearch">
                                <button class="btn"
                                    style="background: #0099C7 0% 0% no-repeat padding-box;color: white;"
                                    type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                            </form>
                        </nav>
                        <div class="contactname">
                            <hr>
                            @if ($chat_group->count() > 0)
                                @foreach ($chat_group as $group)
                                    <nav class="w-full h-14 rounded-tr rounded-tl flex justify-between items-center chat_nav pinned"
                                        onclick="open_chat(this,{{ $group->id }},'{{ $group->group_name }}')">
                                        <div class="flex justify-start items-center" style="width: 50%;">
                                            <img src="https://i.imgur.com/IAgGUYF.jpg" class="rounded-full ml-1"
                                                width="35" height="35">
                                            <span
                                                class="text-md font-medium text-black-300 ml-1 truncate">{{ $group->group_name }}</span>
                                        </div>
                                        <div style="width: 50%;text-align: end;"><span style="margin-right: 50px;"
                                                id="group_{{ $group->id }}" class="cncg"></span></div>
                                        <hr>
                                    </nav>
                                @endforeach
                            @endif
                            @if ($chat_admin->count() > 0)
                                @foreach ($chat_admin as $group)
                                    <nav class="w-full h-14 rounded-tr rounded-tl flex justify-between items-center chat_nav"
                                        onclick="open_chat(this,{{ $group->uid }},'{{ $group->name }}',2,2)">
                                        <div class="flex justify-start items-center" style="width: 50%;">
                                            <img src="https://i.imgur.com/IAgGUYF.jpg" class="rounded-full ml-1"
                                                width="35" height="35">
                                            <span
                                                class="text-md font-medium text-black-300 ml-1 truncate">{{ $group->name }}<br><b
                                                    style="font-size:9px;">Admin</b></span>
                                        </div>
                                        <div style="width: 50%;text-align: end;"><span style="margin-right: 50px;"
                                                id="user_{{ $group->uid }}" class="cncg"></span></div>
                                        <hr>
                                    </nav>
                                @endforeach
                            @endif
                            @if ($chat_group_list->count() > 0)
                                @foreach ($chat_group_list as $single_chat)
                                    @if ($single_chat->uid == $user->id)
                                    @else
                                        <nav class="w-full h-14 rounded-tr rounded-tl flex justify-between items-center chat_nav"
                                            onclick="open_chat(this,{{ $single_chat->uid }},'{{ $single_chat->name ? $single_chat->name : $single_chat->user_id }}',2)">
                                            <div class="flex justify-start items-center" style="width: 50%;">
                                                <img src="{{ $single_chat->photo ? env('APP_URL') . 'public/uploads/' . $single_chat->photo : 'https://i.imgur.com/IAgGUYF.jpg' }}"
                                                    class="rounded-full ml-1" width="35" height="35"
                                                    style="width:35px;height:35px;">
                                                <span
                                                    class="text-md font-small text-black-300 ml-1 truncate">{{ $single_chat->name ? $single_chat->name : $single_chat->user_id }}
                                                    <br><b style="font-size:9px;">( @if ($single_chat->user_type == 1)
                                                            {{ 'Sales' }}
                                                        @elseif($single_chat->user_type == 2)
                                                            {{ 'QA' }}
                                                        @elseif($single_chat->user_type == 3)
                                                            {{ 'HR' }}
                                                        @elseif($single_chat->user_type == 4)
                                                            {{ 'IT' }}
                                                        @endif )</b>
                                                </span>
                                            </div>
                                            <div style="width: 50%;text-align: end;"><span style="margin-right: 50px;"
                                                    id="user_{{ $single_chat->uid }}" class="cncu"></span></div>
                                            <hr>
                                        </nav>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-8 p-0 borderblue" id="prechat_box"></div>
                    <div class="col-12 col-sm-12 d-none col-md-8 p-0 borderblue" id="chat_box">
                        <nav class="w-full h-14   flex justify-between items-center">
                            <div class="flex justify-center items-center">
                                <img src="https://i.imgur.com/IAgGUYF.jpg" class="rounded-full ml-1" width="35"
                                    height="35">
                                <span class="usergrpname" id="chat_name"></span>
                            </div>
                            <div class="flex items-center"></div>
                        </nav>
                        <hr>
                        <div id="journal-scroll">
                            <div class="" id="chatmsg"></div>
                        </div>
                        <div class="flex justify-between items-center p-1 col-8 "
                            style="position: fixed;
                        bottom: 0;">
                            <div class="relative ms-2" style="width:100%;">
                                <input type="text" class="rounded-full pl-6 pr-12 py-2  sendmsgbox"
                                    placeholder="Type a message..." id="typemsg">
                                <i class="fa-solid fa-plus absolute right-5 top-2"></i>
                            </div>
                            <div class="w-9 h-9  text-center items-center flex justify-center sendarrow">
                                <button
                                    class="w-9 h-9 rounded-full text-center items-center flex justify-center focus:outline-none hover:baseBtnBg text-white"
                                    onclick="sendbtn();" id="send"><i class="mdi mdi-send "></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="assetsinfo" tabindex="-1" data-bs-backdrop="static"
    aria-bs-labelledby="assetsModalLabel" aria-bs-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header flex-column bg-white SubHeding border-0 smaTxt ">
                <div class=" align-self-end pe-7s-close fs-2 cursor-pointer" data-bs-dismiss="modal"
                    aria-bs-label="Close"></div>
                <h5 class="modal-title text-center fontBold m-auto" id="assetsModalLabel">Assigned Assets</h5>

            </div>

            <div class="modal-body">
                <div class="row">
                    @foreach ($ass as $as)
                        <div id="data-table">
                            <table class="table table-bordered text-center table-striped">
                                <tbody>
                                    <tr>
                                        <th>Name</th>
                                        <th>Serial no.</th>
                                        <th>Product Code</th>
                                        <th>Assigned On</th>
                                        <th>Action</th>
                                    </tr>
                                    <tr>
                                        <td>{{ $as->asset_name }}</td>
                                        <td>{{ $as->serial_number }}</td>
                                        <td>{{ $as->product_code }}</td>
                                        <td>{{ date('j M Y', strtotime($as->from)) }}</td>
                                        <td class="text-center ">
                                            <div class="d-flex justify-content-around">
                                                <div style="cursor: pointer;">
                                                    <form action="{{ env('APP_URL') }}asset_verify" method="post">
                                                        @csrf
                                                        <input type="hidden" name="id"
                                                            value="{{ $as->id }}">
                                                        <input type="hidden" name="uid"
                                                            value="{{ $as->uid }}">
                                                        <input type="hidden" name="verify" value="0">
                                                        <button type="submit" class="bg-transparent border-0">
                                                            <i class="bi bi-check text-success SubHeding"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                                <div style="cursor: pointer;">
                                                    <form action="{{ env('APP_URL') }}asset_verify" method="post">
                                                        @csrf
                                                        <input type="hidden" name="id"
                                                            value="{{ $as->id }}">
                                                        <input type="hidden" name="uid"
                                                            value="{{ $as->uid }}">
                                                        <input type="hidden" name="verify" value="1">
                                                        <button type="submit" class="bg-transparent border-0">
                                                            <i class="bi bi-x SubHeding text-danger"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</div>
@if ($user->user_type == 1)
    <div class="modal fade" id="attendance" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">NOTICE</h4>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>
                <form action="{{ env('APP_URL') }}update_crm_id" method="post">
                    <div class="modal-body">
                        @csrf
                        @if ($user->server_ip == '144.76.0.239')
                            <div class="notice">
                                <p>Dear Team,</p>
                                <p>We would like to inform you of an important adjustment to our incentive criteria,
                                    effective 1st January 2024. As part of our ongoing efforts to optimize our incentive
                                    structure and ensure that it aligns with both individual and organisational goals,
                                    we have made the following changes:</p>
                                <ul>
                                    <li><strong>Target Percentage Update:</strong> The incentive threshold has been
                                        revised and lowered down your minimum target for daily incentive by more than
                                        14%. This adjustment aims to provide more flexibility while maintaining a
                                        performance-driven incentive program.</li>
                                    <li><strong>Lead Generation Requirement:</strong> To further emphasize the
                                        importance of quality leads and align incentives with our business objectives,
                                        we are introducing a minimum lead generation requirement. To be eligible for
                                        daily incentives, each team member must now achieve a minimum of 200 leads per
                                        month.</li>
                                </ul>
                                <p>The changes will be reflected on your portal from 1st January 2024.</p>
                                <p>We understand that these changes may raise questions, and we are here to support you
                                    through this transition. If you have any concerns or require clarification on the
                                    new criteria, please feel free to reach out to the HR Department.</p>
                                <p>We believe that these adjustments will contribute to a more dynamic and rewarding
                                    incentive program, promoting a focus on achieving quality leads while offering a
                                    fair and motivating structure.</p>
                                <p>Thank you for your continued dedication and hard work. We are confident that these
                                    changes will help us collectively achieve new heights of success.</p>
                            </div>
                        @else
                            <div class="notice">
                                <p>Dear Team,</p>
                                <p>We are excited to announce updates to our incentive program, effective from 1st
                                    January 2023, aimed at providing a more attainable daily target and a more rewarding
                                    monthly bonus structure. The changes are as follows:</p>
                                <ul>
                                    <li><strong>Daily Incentive Target:</strong> The daily incentive target has been
                                        lowered by 20%. This modification is designed to make it more achievable for
                                        each team member to qualify for daily incentives, recognizing your ongoing
                                        efforts and dedication.</li>
                                    <li><strong>Monthly Bonus Target:</strong> The monthly bonus target has been
                                        increased by almost 14%. This adjustment reflects our commitment to encouraging
                                        sustained high performance. By achieving this slightly higher monthly target,
                                        you will qualify for an enhanced monthly bonus.</li>
                                    <li><strong>Monthly Bonus Amount:</strong> With the increased monthly bonus target,
                                        we are pleased to announce a corresponding increase in the monthly bonus amount
                                        by almost 66%. Starting January 2023, the monthly bonus will now be set at 5000
                                        INR, providing even greater rewards for your outstanding contributions.</li>
                                    <li><strong>Lead Generation Requirement:</strong> To further emphasize the
                                        importance of quality leads and align incentives with our business objectives,
                                        we are introducing a minimum lead generation requirement. To be eligible for
                                        daily incentives, each team member must now achieve a minimum of 100 leads per
                                        month.</li>
                                </ul>
                                <p>These changes have been implemented with the goal of creating a more motivating and
                                    fair incentive program that recognizes and rewards your hard work.</p>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <lable>Please enter CRM emp_id</lable>
                                    <input type="text" class="form-control" placeholder="CRM emp_id"
                                        name="crm_emp_id" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- traning modal --}}
    <div class="modal fade" id="traninghr" data-bs-backdrop="static" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Training</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ env('APP_URL') }}training" method="post">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="uid" value="{{ $user->id }}">
                        <p>
                            "Great news! I've successfully completed the CRM and HR Portal training, guided by the
                            expertise of <input type="text" placeholder="[Enter Trainer's Name]" name="name">.
                            With this knowledge, I'm now equipped to streamline operations, boost customer satisfaction.
                            Ready to make a positive impact!"</p>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- traning modal --}}
    <div class="modal fade" id="attendance1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">NOTICE</h4>
                    <!--<button type="button" class="close" data-dismiss="modal">×</button>-->
                </div>
                <div class="modal-body">
                    <div class="notice">
                        <p>Dear Team,</p>
                        <h3 class="text-center fw-bold">Leave Policy Change</h3>
                        <h4 class="my-3">1. Leave Application Deadline:</h4>
                        <p>For leaves of more than 2 days: Apply through the HR portal at least 1 week in advance.</p>
                        <p>For leaves of less than or equal to 2 days: Apply before the login hours of the same day.</p>
                        <p>Employees requiring sick leave can email their Reporting manager and HR Department during the
                            login hours of the same day. If sick leave will be more than 2 days then one need to submit
                            medical refrence.</p>
                        <h4 class="my-3">2. Emergency Leave Notification</h4>
                        <p>In the case of emergencies preventing timely leave application, an official email to HR and
                            your reporting manager is required, explaining the nature of the emergency. Personal
                            messages will not be entertained.
                            This adjustment aims to facilitate better management of team schedules and ensure smooth
                            workflow continuity.</p>
                        <p> Failure to comply with the above points may result in the automatic allotment of Unpaid
                            Leave (UPL). </p>
                        <p>From Now Onwards, if a teammate took any unplanned leaves without informing their reporting
                            manager/HR those leaves will be marked as double leaves (2 days LOP). For example - If
                            anyone took 1 unplanned leave, and did not inform anyone(on email) about that leave will be
                            counted as 2 Leave without pay.</p><br>
                        <p style="color:red;">
                            We recently restructured the incentive plan last month, reducing your monthly target and
                            emphasizing lead generation. However, we've observed that several of you haven't met the
                            lead targets. For this month, we are making an exception and releasing your incentive based
                            solely on your sales performance, disregarding the lead aspect. Please note that this is a
                            one-time exception for January. Starting from February onwards, meeting both sales and lead
                            targets is mandatory to qualify for daily incentives.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
@if ($policies->count() > 0)
    @foreach ($policies as $policy)
        @if ($policy->user_type == 0)
            <div class="modal fade" id="notice-{{ $policy->id }}" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">NOTICE </h4>
                            <button type="button" class="close" data-dismiss="modal">×</button>
                        </div>
                        <div class="modal-body">
                            <h4 class="text-center">{{ $policy->name }}</h4>
                            {!! $policy->content !!}
                        </div>
                        <div class="modal-footer">

                            <form action="{{ env('APP_URL') }}policy_accept " method="POST">
                                @csrf
                                <input type="hidden" name="policy_id" value="{{ $policy->id }}">
                                @if (in_array($user->id, explode(',', $policy->uids)))
                                    <p class="btn btn-success" style="box-shadow: 0px 0px 30px -5px #3ac47d;">Accepted
                                    </p>
                                @else
                                    <button type="submit" class="btn btn-primary">Accept</button>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @elseif($policy->user_type == 1 && $user->user_type == 1)
            <div class="modal fade" id="notice-{{ $policy->id }}" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">NOTICE</h4>
                            <button type="button" class="close" data-dismiss="modal">×</button>
                        </div>
                        <div class="modal-body">
                            <h4 class="text-center">{{ $policy->name }}</h4>
                            {!! $policy->content !!}
                        </div>
                        <div class="modal-footer">
                            <form action="{{ env('APP_URL') }}policy_accept " method="POST">
                                @csrf
                                <input type="hidden" name="policy_id" value="{{ $policy->id }}">
                                @if (in_array($user->id, explode(',', $policy->uids)))
                                    <p class="btn btn-success" style="box-shadow: 0px 0px 30px -5px #3ac47d;">Accepted
                                    </p>
                                @else
                                    <button type="submit" class="btn btn-primary">Accept</button>
                                @endif
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        @elseif($policy->user_type == 4 && $user->user_type == 4)
            <div class="modal fade" id="notice-{{ $policy->id }}" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">NOTICE</h4>
                            <button type="button" class="close" data-dismiss="modal">×</button>
                        </div>
                        <div class="modal-body">
                            <h4 class="text-center">{{ $policy->name }}</h4>
                            {!! $policy->content !!}
                        </div>
                        <div class="modal-footer">
                            <form action="{{ env('APP_URL') }}policy_accept " method="POST">
                                @csrf
                                <input type="hidden" name="policy_id" value="{{ $policy->id }}">
                                @if (in_array($user->id, explode(',', $policy->uids)))
                                    <p class="btn btn-success" style="box-shadow: 0px 0px 30px -5px #3ac47d;">Accepted
                                    </p>
                                @else
                                    <button type="submit" class="btn btn-primary">Accept</button>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
@endif
<!-- pop policies -->
@foreach ($pop_policies as $pop_policy)
    @if ($pop_policy->user_type == 0)
        <div class="modal fade" id="notice-{{ $pop_policy->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">NOTICE</h4>
                        <button type="button" class="close" data-dismiss="modal">×</button>
                    </div>
                    <div class="modal-body">
                        <h4 class="text-center">{{ $pop_policy->name }}</h4>
                        {!! $pop_policy->content !!}
                    </div>
                    <div class="modal-footer">
                        <form action="{{ env('APP_URL') }}policy_accept " method="POST">
                            @csrf
                            <input type="hidden" name="policy_id" value="{{ $pop_policy->id }}">
                            <button type="submit" class="btn btn-primary">Accept</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @elseif($pop_policy->user_type == 1 && $user->user_type == 1)
        <div class="modal fade" id="notice-{{ $pop_policy->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">NOTICE</h4>
                        <button type="button" class="close" data-dismiss="modal">×</button>
                    </div>
                    <div class="modal-body">
                        <h4 class="text-center">{{ $pop_policy->name }}</h4>
                        {!! $pop_policy->content !!}
                    </div>
                    <div class="modal-footer">
                        <form action="{{ env('APP_URL') }}policy_accept" method="POST">
                            @csrf
                            <input type="hidden" name="policy_id" value="{{ $pop_policy->id }}">
                            <button type="submit" class="btn btn-primary">Accept</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @elseif($pop_policy->user_type == 4 && $user->user_type == 4)
        <div class="modal fade" id="notice-{{ $pop_policy->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">NOTICE </h4>
                        <button type="button" class="close" data-dismiss="modal">×</button>
                    </div>
                    <div class="modal-body">
                        <h4 class="text-center">{{ $pop_policy->name }}</h4>
                        {!! $pop_policy->content !!}
                    </div>
                    <div class="modal-footer">
                        <form action="{{ env('APP_URL') }}policy_accept" method="POST">
                            @csrf
                            <input type="hidden" name="policy_id" value="{{ $pop_policy->id }}">
                            <button type="submit" class="btn btn-primary">Accept</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    @endif
@endforeach

<script>
    $(document).ready(function() {
        var modalIds = [
            @foreach ($pop_policies as $pop_policy)
                'notice-{{ $pop_policy->id }}',
            @endforeach
        ];

        // Hide all modals initially
        modalIds.forEach(function(modalId) {
            $('#' + modalId).modal('hide');
        });

        // Click event for "Accept all policies" link
        $('p.my-2 a').on('click', function(e) {
            e.preventDefault();
            var currentIndex = 0;

            function showNextModal() {
                if (currentIndex < modalIds.length) {
                    var currentModalId = modalIds[currentIndex];
                    var myModal = new bootstrap.Modal(document.getElementById(currentModalId), {});
                    myModal.show();
                    currentIndex++;
                    $('#' + currentModalId).on('hidden.bs.modal', function() {
                        showNextModal();
                    });
                }
            }

            showNextModal();
        });

        // Additional functionality for showing pop-ups one by one if available
        var currentIndex = 0;

        function showNextModal() {
            if (currentIndex < modalIds.length) {
                var currentModalId = modalIds[currentIndex];
                var myModal = new bootstrap.Modal(document.getElementById(currentModalId), {});
                myModal.show();
                currentIndex++;
                $('#' + currentModalId).on('hidden.bs.modal', function() {
                    showNextModal();
                });
            }
        }

        showNextModal();
    });
</script>
@include('user.includes.footer')
<script>
    var openchat = 0;
    var printtext = document.getElementById('chatmsg');
    var copytext = document.getElementById('typemsg');
    var group_id;
    var last_id = 1;
    var chat_type = 1;
    var receiver_type = 1;
    var es = null;
    var mdes = null;
    var cv = 0;

    function open_chat(tab, id, name, type = 1, receiver = 1) {
        chat_type = type;
        receiver_type = receiver;
        group_id = id;
        if (openchat == 0) {
            $('#prechat_box').addClass('d-none');
            $('#chat_box').removeClass('d-none');
            openchat = 1;
        }
        $('.chat_nav').removeClass('bg-blueviolet');
        $(tab).addClass('bg-blueviolet');
        $('#chat_name').html(name);
        var settings = {
            "url": "/get_message?group_id=" + group_id + "&type=" + type + "&receiver_type=" + receiver_type,
            "method": "GET",
            "timeout": 0,
        };
        $.ajax(settings).done(function(response) {
            var printnow = '';
            response.data.map((data) => {
                if (data.sender_id == {{ $user->id }} && data.sender_type == 1) {
                    printnow += `<div class="flex justify-end pt-2 pl-10">
                                <div style="margin: 0 12px;">
                                    <div
                                        style="background: #EEFAFB;box-shadow: 0px 2px 3px #00000029;padding: 5px;border-radius: 5px;">
                                        <p class="chattxt"> ${data.message}</p>
                                        <p class="text-end" style="font-size: 10px;">${fixdate(data.created_at)}</p>
                                    </div>
                                </div>
                                <div class="flex items-end justify-end">
                                    <img src="https://i.imgur.com/IAgGUYF.jpg" class="rounded-full shadow-xl" width="20"
                                        height="20">
                                </div>
                            </div>`;

                } else {
                    printnow += `<div class="flex items-center pr-10 my-3 pt-2">
                                <img src="https://i.imgur.com/IAgGUYF.jpg" class="rounded-full shadow-xl" width="20"
                                    height="20" style="margin-top: 10px;align-self: baseline;">
                                <div style="margin: 0 12px;">
                                    <div style="background: white;box-shadow: 0px 2px 3px #00000029;padding: 5px;border-radius: 5px;">
                                        <p class="chattxt">${(data.name ? data.name : data.user_id) ? (data.name ? data.name : data.user_id) : 'Admin'}</p>
                                        <hr>
                                        <p class="chattxt">${data.message}</p>
                                        <p class="text-end" style="font-size: 10px;">${fixdate(data.created_at)}</p>
                                    </div>
                                </div>
                            </div>`;


                }
                if (last_id < data.id) {
                    last_id = data.id;
                }
            });
            $(printtext).html(printnow);
            var box = document.getElementById('journal-scroll');
            box.scrollTop = box.scrollHeight;
            get_message();
        });
    }

    function sendbtn() {
        var copiedtext = copytext.value;
        if (copiedtext == null || copiedtext == '') {
            return null;
        } else {
            var printnow = '';
            var form = new FormData();
            form.append("group_id", group_id);
            form.append("message", copiedtext);
            form.append("chat_type", chat_type);
            form.append("receiver_type", receiver_type);
            form.append("_token", '{{ csrf_token() }}');
            var settings = {
                "url": "/chat_send_message",
                "method": "POST",
                "timeout": 0,
                "processData": false,
                "mimeType": "multipart/form-data",
                "contentType": false,
                "data": form
            };
            $.ajax(settings).done(function(response) {
                var data = JSON.parse(response);
                data.data.map((data) => {
                    printnow += `<div class="flex justify-end pt-2 pl-10">
                                <div style="margin: 0 12px;">
                                    <div
                                        style="background: #EEFAFB;box-shadow: 0px 2px 3px #00000029;padding: 5px;border-radius: 5px;">
                                        <p class="chattxt"> ${data.message}</p>
                                        <p class="text-end" style="font-size: 10px;">${fixdate(data.created_at)}</p>
                                    </div>
                                </div>
                                <div class="flex items-end justify-end">
                                    <img src="https://i.imgur.com/IAgGUYF.jpg" class="rounded-full shadow-xl" width="20"
                                        height="20">
                                </div>
                            </div>`;

                    if (last_id < data.id) {
                        last_id = data.id;
                    }
                });
                $(printtext).append(printnow);
                var box = document.getElementById('journal-scroll');
                box.scrollTop = box.scrollHeight;
                copytext.value = '';
                get_message();
            });
        }
    }
</script>
</div>
<script>
    function get_message() {
        if (es !== null) {
            es.close();
        }
        es = new EventSource("/sse?group_id=" + group_id + "&last_id=" + last_id + '&type=' + chat_type);
        es.onmessage = function(event) {
            const data = JSON.parse(event.data);
            var printnow = '';
            if (data.new_message > 0) {
                data.data.map((data) => {
                    if (data.sender_id == {{ $user->id }} && data.sender_type == 1) {
                        printnow += `<div class="flex justify-end pt-2 pl-10">
                                <div style="margin: 0 12px;">
                                    <div
                                        style="background: #EEFAFB;box-shadow: 0px 2px 3px #00000029;padding: 5px;border-radius: 5px;">
                                        <p class="chattxt"> ${data.message}</p>
                                        <p class="text-end" style="font-size: 10px;">${fixdate(data.created_at)}</p>
                                    </div>
                                </div>
                                <div class="flex items-end justify-end">
                                    <img src="https://i.imgur.com/IAgGUYF.jpg" class="rounded-full shadow-xl" width="20"
                                        height="20">
                                </div>
                            </div>`;
                    } else {
                        printnow += `<div class="flex items-center pr-10 my-3 pt-2">
                                <img src="https://i.imgur.com/IAgGUYF.jpg" class="rounded-full shadow-xl" width="20"
                                    height="20" style="margin-top: 10px;align-self: baseline;">
                                <div style="margin: 0 12px;">
                                    <div style="background: white;box-shadow: 0px 2px 3px #00000029;padding: 5px;border-radius: 5px;">

                                        <p class="chattxt">${(data.name ? data.name : data.user_id) ? (data.name ? data.name : data.user_id) : 'Admin'}</p>
                                        <hr>
                                        <p class="chattxt">${data.message}</p>
                                        <p class="text-end" style="font-size: 10px;">${fixdate(data.created_at)}</p>
                                    </div>
                                </div>
                            </div>`;
                    }
                    if (last_id < data.id) {
                        last_id = data.id;
                    }
                });
                $(printtext).append(printnow);
                var box = document.getElementById('journal-scroll');
                box.scrollTop = box.scrollHeight;
                get_message();
            }
            if (data.group.length > 0) {
                $(".cncg").each(function() {
                    $(this).html();
                });
                data.group.map((gdata) => {
                    $("#group_" + gdata.group_id).html(gdata.new_message);
                });
            }
            if (data.user.length > 0) {
                data.user.map((gdata) => {
                    let ld = $("#user_" + gdata.sender_id);

                    if (ld.html() != gdata.new_message) {
                        ld.html(gdata.new_message);

                        const chatElement = ld.closest('nav');
                        const pinnedChats = chatElement.parent().find('.pinned');

                        // If this chat is pinned, don't move it. Otherwise, determine its position.
                        if (!chatElement.hasClass('pinned')) {
                            if (pinnedChats.length > 0) {
                                // If there are pinned chats, place the updated chat right after the last pinned chat
                                chatElement.insertAfter(pinnedChats.last());
                            } else {
                                // If no pinned chats, move the updated chat to the very top
                                chatElement.prependTo(chatElement.parent());
                            }
                        }
                    }
                });
            }
        };
        es.onerror = function(event) {
            console.error('Error occurred:', event);
            es.close();
            get_message();
        };
    }

    function messdata() {
        var tmess = 0;
        var otmess = 0;
        if (mdes !== null) {
            mdes.close();
        }
        mdes = new EventSource("/messdata?last_id=" + last_id);
        mdes.onmessage = function(event) {
            const data = JSON.parse(event.data);
            var printnow = '';
            if (data.group.length > 0) {
                $(".cncg").each(function() {
                    $(this).html();
                });
                data.group.map((gdata) => {
                    $("#group_" + gdata.group_id).html(gdata.new_message);
                });
            }
            if (data.user.length > 0) {
                if (JSON.stringify(data.user) != cv) {
                    cv = JSON.stringify(data.user);
                    data.user.map((gdata) => {
                        $("#user_" + gdata.sender_id).html(gdata.new_message);
                        const chatElement = $("#user_" + gdata.sender_id).closest('nav');
                        const pinnedChats = chatElement.parent().find('.pinned');
                        // If this chat is pinned, don't move it. Otherwise, determine its position.
                        if (!chatElement.hasClass('pinned')) {
                            if (pinnedChats.length > 0) {
                                // If there are pinned chats, place the updated chat right after the last pinned chat
                                chatElement.insertAfter(pinnedChats.last());
                            } else {
                                // If no pinned chats, move the updated chat to the very top
                                chatElement.prependTo(chatElement.parent());
                            }
                        }
                        tmess += parseInt(gdata.new_message);
                    });
                    if (tmess != otmess) {
                        playAudio();
                        $("#tmess").html(tmess);
                    }
                    otmess = tmess;
                } else {}
            }
        };
        mdes.onerror = function(event) {
            mdes.close();
            messdata();
        };
    }

    function playAudio() {
        var audio = new Audio('/public/sms.mp3');
        audio.play();
    }
    messdata();
    copytext.addEventListener("keypress", function(event) {
        if (event.key === "Enter") {
            event.preventDefault();
            document.getElementById("send").click();
        }
    });
    $('#chatsearch').on('input', function() {
        let searchValue = this.value.toLowerCase();
        let navElements = document.querySelectorAll('.chat_nav');

        navElements.forEach(function(nav) {
            let name = nav.querySelector('.text-md').innerText.toLowerCase();
            if (name.includes(searchValue)) {
                nav.style.display = 'flex';
            } else {
                nav.style.display = 'none';
            }
        });
    });
</script>
<script>
    var loadFile1 = function(event) {
        var image = document.getElementById('output1');
        image.href = URL.createObjectURL(event.target.files[0]);
        document.getElementById("output1").style.display = "block";
    };

    var loadFile2 = function(event) {
        var image = document.getElementById('output2');
        image.href = URL.createObjectURL(event.target.files[0]);
        document.getElementById("output2").style.display = "block";

    };

    var loadFile44 = function(event) {
        var image = document.getElementById('output44');
        image.href = URL.createObjectURL(event.target.files[0]);
        document.getElementById("output44").style.display = "block";

    };

    var loadFile3 = function(event) {
        var image = document.getElementById('output3');
        image.href = URL.createObjectURL(event.target.files[0]);
        document.getElementById("output3").style.display = "block";
    };

    function photosee() {
        document.getElementById("output3").style.width = "500px";
        document.getElementById("output3").style.backgroundColor = "white";
    }
</script>
<script>
    var pass = '{{ base64_encode($user->password . csrf_token()) }}';
</script>
<script>
    function getsalary(e) {
        let a = prompt('Please Enter Password');
        a = btoa(a + '{{ csrf_token() }}');
        if (pass == a) {
            $(e).html('{{ $total_salary }}/-');
        }
    }

    function fixdate(dt) {
        const dateTimeString = dt;
        const dateObj = new Date(dateTimeString);
        const currentDate = new Date();
        const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
        let formattedTime;
        if (dateObj.getUTCDate() === currentDate.getUTCDate() &&
            dateObj.getUTCMonth() === currentDate.getUTCMonth() &&
            dateObj.getUTCFullYear() === currentDate.getUTCFullYear()) {

            const hours = dateObj.getUTCHours();
            const minutes = dateObj.getUTCMinutes().toString().padStart(2, '0');
            formattedTime = `${hours}:${minutes}`;
        } else {
            const day = dateObj.getUTCDate().toString().padStart(2, '0');
            const month = monthNames[dateObj.getUTCMonth()];
            const year = dateObj.getUTCFullYear().toString().slice(2); // Get the last two digits of the year
            const hours = dateObj.getUTCHours();
            const minutes = dateObj.getUTCMinutes().toString().padStart(2, '0');

            formattedTime = `${day}, ${month} ${year}, ${hours}:${minutes}`;
        }
        return formattedTime;
    }
</script>
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"></script>
<script>
    @if (empty($user->crm_emp_id))
        $(document).ready(function() {
            var myModal = new bootstrap.Modal(document.getElementById('attendance'));
        });
    @endif
</script>
