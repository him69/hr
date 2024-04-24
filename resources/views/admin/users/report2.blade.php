@include('admin.includes.header')
<style>
    .salegreen {
        background: #008f7f;
    }

    hr {
        border-top: 1px solid rgb(0 0 0);
    }
    .salegreen {
        background-color: #008f7f;
    }

    .userbox {
        /* border-left: 2px solid; */
        color: #707070 !important;
    }

    .userbox .table th,
    .userbox .table td {
        color: #707070 !important;
        padding: 4px !important;
    }

    .salepopup .modal-dialog {
        width: 30%;
    }

    .editpopup .modal-dialog {
        width: 100%;
    }

    .editpopup2 {
        width: 30%;

    }

    select:focus,
    textarea:focus {
        border: 1px solid;
        outline: none;
    }


    .editpopup input {
        height: 30px;
        border-left: 0;
        width: 100%;
        background-color: white;
    }

    .editpopup label {
        font-size: 17px;
        margin-top: 24px;
        margin-bottom: 0px;
    }

    .editpopup .br {
        border-radius: 5px;
        border: 1px solid #707070;
        overflow: hidden;
        padding: 4px;
        display: flex;
        align-items: center;
    }

    .editpopup .inputicon {
        font-size: 20px;
        background: rgb(255, 255, 255);
        color: rgb(0, 0, 0);
        min-width: 30px;
        text-align: center;
        border-right: 1px solid #707070;
    }

    .dobstyle {
        padding: 6px 13px;
        border: 1px solid;
    }

    .dobstyle:focus {
        padding: 6px 13px;
        border: 1px solid;
    }

    .btnupload {
        color: white;
        background-color: #006396;
        width: 100%;
    }


    .fileinput {
        display: none;
    }

    .editpopup label {
        cursor: pointer;
    }
</style>
<div class="spinner-box hidden">
    <div class="circle-border">
        <div class="circle-core"></div>
    </div>
</div>
<div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
    @include('admin.includes.top_nav')
    <div class="ui-theme-settings">

        <div class="theme-settings__inner">
            <div class="scrollbar-container">

            </div>
        </div>
    </div>
    <div class="app-main">
        <div class="container-fluid px-5 d-block">
            <div class="app-main__inner">
            </div>
            <div class="tab-content " id=" nav-tabContent">
                @if(session('message'))
                <div class="alert {{ session('alert-class') }}">{{ session('message') }}</div>
                @endif
                <div class="row">
                    <div class="col-7 d-flex justify-content-between">
                        <a href="{{env('APP_URL')}}admin"
                            class="text-decoration-none btn-group nav-item align-items-center px-2 py-1 baseShadow rounded-pill bg-white my-2">
                            <i class="fa-solid fa-house-chimney baseBtnBg p-1 m-1 vsmatxt rounded-circle"
                                style="color: #ffffff;"></i>
                            <span class="cttext fw-bold">Home</span>
                        </a>
                        <div>
                            <button data-bs-toggle="modal" data-bs-target="#editpopup"
                                class="btn btn-group align-items-center px-2 py-1 baseShadow rounded-pill bg-white m-2">
                                <i class="fa-solid fa-pencil baseBtnBg p-1 m-1 vsmatxt rounded-circle"
                                    style="color: #ffffff;"></i>
                                <span class="cttext fw-bold">Edit</span>
                            </button>
                            <a href="{{env('APP_URL')}}admin/user_mode/{{$id}}" class="btn btn-group align-items-center px-2 py-1 baseShadow rounded-pill bg-white m-2" target="_blank">
                                <i class="fa-solid fa-eye baseBtnBg p-1 m-1 vsmatxt rounded-circle"
                                    style="color: #ffffff;"></i>
                                <span class="cttext fw-bold">View User Dashboard</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-5">
                        <form method="post">@csrf<li class="btn-group nav-item align-items-center px-2 py-1 baseShadow rounded-pill bg-white my-2 d-flex">
                            <input type="month" name="month" value="{{$date}}" class="form-control border-0">
                            <button class="btn baseBtnBg w-100 text-white rounded-pill" type="submit" name="showtab"
                                value="nav-attendance">
                                <span>Search by month</span>
                            </button>
                        </li></form>
                    </div>
                    <div class="col-7">
                        <div class="card">
                            <div class="p-3 baseShadow borderRadius ">
                                <div class="d-flex justify-content-around">
                                    <div class="align-self-center">
                                        <div class="rounded-circle m-auto border border-2 border-dark overflow-hidden"
                                            style="height: 120px; min-width:120px;">
                                            @if($profile->photo)
                                            <img src="{{ env('APP_URL') . 'public/uploads/' . $profile->photo }}"
                                                alt="Profile Photo" style="height:100%; width:100%; object-fit:cover ;">
                                            @else
                                            <img src="{{ env('APP_URL') . 'public/assets/images/user.svg' }}"
                                                alt="Default Photo" style="height:100%; width:100%; object-fit:cover ;">
                                            @endif
                                        </div>
                                    </div>
                                    <div style="width: 3px;background: black;">
                                    </div>
                                    <div class="">
                                        <table class="table mb-0">
                                            <tbody>
                                                <tr>
                                                    <th class="d-flex justify-content-between border-0 smaTxt ">
                                                        <div> <span class="smaTxt m-0 fontmed">Full
                                                                Name</span> </div> <span>:</span>
                                                    </th>
                                                    <td class="border-0 smaTxt ">{{$profile->name}}</td>
                                                </tr>
                                                <tr>
                                                    <th class="d-flex justify-content-between border-0 smaTxt ">
                                                        <div><span class="smaTxt m-0 fontmed"> Ph.
                                                                Number</span> </div> <span>:</span>
                                                    </th>
                                                    <td class="border-0 smaTxt ">{{$profile->mobile}}</td>
                                                </tr>
                                                <tr>
                                                    <th class="d-flex justify-content-between border-0 smaTxt ">
                                                        <div><span class="smaTxt m-0 fontmed"> Email
                                                                ID</span> </div> <span>:</span>
                                                    </th>
                                                    <td class="border-0 smaTxt ">{{$profile->email}}</td>
                                                </tr>
                                                <tr>
                                                    <th class="d-flex justify-content-between border-0 smaTxt ">
                                                        <div><span class="smaTxt m-0 fontmed">Date of
                                                                Birth</span> </div> <span>:</span>
                                                    </th>
                                                    <td class="border-0 smaTxt ">{{$profile->dob}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-12 mt-2">
                                        <div class="p-3 baseShadow borderRadius ">
                                            <p class="fontmed smText">Employee Details</p>
                                            <hr>
                                            <div class="row">
                                                <div class="col-12">
                                                    <table class="table mb-0">
                                                        <tbody>
                                                            <tr>
                                                                <th class="d-flex border-0 smaTxt   justify-content-between"
                                                                    style="width: 130px;">
                                                                    <div><span
                                                                            class="smaTxt m-0 fontmed">Department</span>
                                                                    </div><span>:</span>
                                                                </th>
                                                                <td class="border-0 smaTxt fontmed">{{$profile->type ?
                                                                    $profile->type : "NA"}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th class="d-flex border-0 smaTxt   justify-content-between"
                                                                    style="width: 130px;">
                                                                    <div><span
                                                                            class="smaTxt m-0 fontmed">Designation</span>
                                                                    </div><span>:</span>
                                                                </th>
                                                                <td class="border-0 smaTxt fontmed">
                                                                    {{$profile->designation ? $profile->designation :
                                                                    'NA'}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th class="d-flex  border-0 smaTxt  justify-content-between"
                                                                    style="width: 130px;">
                                                                    <div><span class="smaTxt m-0 fontmed">Joining
                                                                            Date</span> </div><span>:</span>
                                                                </th>
                                                                <td class="border-0 smaTxt fontmed">
                                                                    {{$profile->joining_date ? $profile->joining_date:
                                                                    'NA'}}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <div class="p-3 baseShadow borderRadius ">
                                            <p class="fontmed smText">Bank Account Details</p>
                                            <hr>
                                            <div class="row">
                                                <div class="col-12">
                                                    <table class="table mb-0">
                                                        <tbody>
                                                            <tr>
                                                                <th class="d-flex  border-0 smaTxt justify-content-between"
                                                                    style="width: 130px;">
                                                                    <div><span class="smaTxt m-0 fontmed">Bank
                                                                            Name</span> </div><span>:</span>
                                                                </th>
                                                                <td class="border-0 fontmed smaTxt ">
                                                                    {{$profile->bank_name ? $profile->bank_name : 'NA'}}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th class="d-flex border-0 smaTxt justify-content-between"
                                                                    style="width: 130px;">
                                                                    <div><span class="smaTxt m-0 fontmed">Account holder
                                                                            name</span> </div><span>:</span>
                                                                </th>
                                                                <td class="border-0 smaTxt fontmed">
                                                                    {{$profile->bank_account_holder_name ?
                                                                    $profile->bank_account_holder_name :'NA'}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th class="d-flex border-0 smaTxt justify-content-between"
                                                                    style="width: 130px;">
                                                                    <div><span class="smaTxt m-0 fontmed">Account
                                                                            number</span> </div><span>:</span>
                                                                </th>
                                                                <td class="border-0 smaTxt fontmed">
                                                                    {{$profile->account_no ? $profile->account_no
                                                                    :'NA'}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th class="d-flex border-0 smaTxt justify-content-between"
                                                                    style="width: 130px;">
                                                                    <div><span class="smaTxt m-0 fontmed">IFSC
                                                                            code</span> </div><span>:</span>
                                                                </th>
                                                                <td class="border-0 smaTxt fontmed">
                                                                    {{$profile->ifsc_code ? $profile->ifsc_code :'NA'}}
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <div class="p-3 baseShadow borderRadius ">


                                            <div class="row justify-content-center">
                                                <div class="col-6">
                                                    <button class="btn w-100 btn-danger">Remove Profile</button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-12 mt-2">
                                        <div class="p-3 baseShadow borderRadius ">
                                            <div class="d-flex justify-content-between">
                                                <p class="fontmed smText">Salary of August</p>
                                                <p class="fontmed smText fontmed vsmatxt">Total Working Days: {{$total_working}}</p>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-12">
                                                    <table class="table mb-0">
                                                        <tbody>
                                                            <tr>
                                                                <th class="d-flex  border-0 smaTxt  justify-content-between ">
                                                                    <div>
                                                                        <span class="smaTxt m-0 fontmed">Total Paid Days</span>
                                                                    </div><span>:</span>
                                                                </th>
                                                                <td class="border-0 smaTxt ">{{$use->total_P+($use->total_H/2)+($use->total_HPL/2)+$use->total_PL+$hsun}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th
                                                                    class="d-flex  border-0 smaTxt  justify-content-between ">
                                                                    <div>

                                                                        <span class="smaTxt m-0 fontmed">Leaves
                                                                            Taken</span>
                                                                    </div>
                                                                    <span>:</span>
                                                                </th>
                                                                <td class="border-0 smaTxt fontmed">
                                                                    PL:{{$use->total_PL?$use->total_PL:'0'}} |
                                                                    A:-{{$use->total_A+$use->total_UPL+($use->total_HPL/2)}}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th
                                                                    class="d-flex  border-0 smaTxt  justify-content-between ">
                                                                    <div>

                                                                        <span class="smaTxt m-0 fontmed">Total
                                                                            Sales</span>
                                                                    </div>
                                                                    <span>:</span>
                                                                </th>
                                                                <td class="border-0 smaTxt fontmed">
                                                                    {{$use->total_sales}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th
                                                                    class="d-flex  border-0 smaTxt  justify-content-between ">
                                                                    <div>

                                                                        <span class="smaTxt m-0 fontmed">Total
                                                                            Customer</span>
                                                                    </div>
                                                                    <span>:</span>
                                                                </th>
                                                                <td class="border-0 smaTxt fontmed">
                                                                    {{$use->total_customer}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th
                                                                    class="d-flex  border-0 smaTxt  justify-content-between ">
                                                                    <div>
                                                                        <span class="smaTxt m-0 fontmed">pay</span>
                                                                    </div>
                                                                    <span>:</span>
                                                                </th>
                                                                <td class="border-0 smaTxt fontmed">
                                                                    {{$use->total_salary}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th
                                                                    class="d-flex  border-0 smaTxt  justify-content-between ">
                                                                    <div>

                                                                        <span
                                                                            class="smaTxt m-0 fontmed">Incentive</span>
                                                                    </div>
                                                                    <span>:</span>
                                                                </th>
                                                                <td class="border-0 smaTxt fontmed">{{$use->total_incentive}}
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <div class="p-3 baseShadow borderRadius">
                                            <p class="fontmed smText">Employee Details</p>
                                            <hr>
                                            <div class="row px-3 justify-content-center">
                                                <div
                                                    class="col-7 smaTxt m-0 fontmed px-2 py-2 d-flex justify-content-between">
                                                    <div>Aadhaar Card</div>
                                                    <div>:</div>
                                                </div>
                                                <div class="col-5 smaTxt m-0 fontmed px-2 py-2">{{$profile->adhar_no}}
                                                </div>
                                                <div class="col-6">
                                                    <button class="btn w-100 btn-primary" data-toggle="modal"
                                                        data-target="#aadharfile">View Aaddhar</button>
                                                </div>
                                                <div
                                                    class="col-7 smaTxt m-0 fontmed px-2 py-2 d-flex justify-content-between">
                                                    <div>Pan Card</div>
                                                    <div>:</div>
                                                </div>
                                                <div class="col-5 smaTxt m-0 fontmed px-2 py-2">{{$profile->pan_no}}
                                                </div>
                                                <div class="col-6">
                                                    <button class="btn w-100 btn-primary" data-toggle="modal"
                                                        data-target="#panfile">View Pan</button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!---->
                    </div>
                    <div class="col-5">
                        <div class="col-12 baseShadow borderRadius">
                            <div class="row  p-2 ">
                                @php($mte = 01)
                                @foreach($users as $us)
                                @php($md = explode('-',$us->mark_date))
                                @while($mte < $md[2])
                                    <div class="col-xl-3 col-2 p-1 d-flex" data-bs-toggle="modal"
                                        data-bs-target="#salepopup" style="cursor: pointer;" onclick='sale(`<?=$us?>`)'>
                                        <div class="w-100 border border-dark" style="text-align: center;">
                                            <b style="text-align: center;">{{$mte}} ({{(date('D',strtotime($md[0].'-'.$md[1].'-'.$mte)))}})</b>
                                            <div class="d-flex justify-content-between mt-2 flex-column">
                                                <div class="smallestText "
                                                    style="background: #ffffff;color: #000;">
                                                    <p class="m-0 vsmatxt" id="lgt">{{'00:00'}}</p>
                                                    <p class="m-0 vsmatxt" id="lit">{{'00:00'}}</p>
                                                </div>
                                                <div class="@if(date('D',strtotime($md[0].'-'.$md[1].'-'.$mte)) == 'Sun'){{'halfday'}}@else{{'absent'}}@endif smallestText text-white d-flex justify-content-around"
                                                    style="padding-top: 10px!important;padding-bottom: 10px!important;">
                                                    <p class="m-0 vsmatxt" id="sm">sale : {{0}}</p>
                                                    <p class="m-0 vsmatxt" id="cu">cust : {{0}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @php($mte++)
                                    @endwhile
                                    <div class="col-xl-3 col-2 p-1 d-flex" data-bs-toggle="modal"
                                        data-bs-target="#salepopup" style="cursor: pointer;" onclick='sale(`<?=$us?>`)'>
                                        <div class="w-100 border border-dark" style="text-align: center;">
                                            <b style="text-align: center;">{{$mte}} ({{(date('D',strtotime($md[0].'-'.$md[1].'-'.$mte)))}})</b>
                                            <div class="d-flex justify-content-between mt-2 flex-column">
                                                <div class="smallestText "
                                                    style="background: #ffffff;color: #000;">
                                                    <p class="m-0 vsmatxt">{{$us->login_time ?? '00:00'}}</p>
                                                    <p class="m-0 vsmatxt">{{$us->logout_time ?? '00:00'}}</p>
                                                </div>
                                                <div class="@if(date('D',strtotime($md[0].'-'.$md[1].'-'.$mte)) == 'Sun'){{'halfday'}}@elseif($us->mark == 'P'){{'salegreen'}}@else{{'absent'}}@endif smallestText text-white d-flex justify-content-around"
                                                    style="padding-top: 10px!important;padding-bottom: 10px!important;">
                                                    <p class="m-0 vsmatxt">sale : {{$us->sale_made ?? 0}}</p>
                                                    <p class="m-0 vsmatxt">cust : {{$us->customer ?? 0}}</p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    @php($mte++)
                                    @endforeach
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="col-12  my-4 baseShadow borderRadius">
                        <div class="row  p-2 justify-content-between my-4">
                            <div class="col-3">
                                <label class="fontmed labelstyle mt-0" for="">Employee Documents</label>
                                <select name="" id="empDoc" class="border-2 w-100 bg-white p-1  border border-black rounded-1">
                                    <option value="choose">Choose</option>
                                @if($user_file->contains('fs_type', 0))
                                    @foreach($user_file as $uf)
                                    @if($uf->fs_type == 0)
                                    <option value='<?=$uf?>'>{{$uf->file_type}}</option>
                                    @endif
                                    @endforeach
                                @endif
                                </select>
                            </div>
                            <div class="col-2 d-flex align-items-end" id="empbtn">
                                <button class="btn btn-lg btn-primary" data-toggle="modal"
                                    data-target="{{'#userfile' }}">{{ 'add file' }}<i class="ms-3 fa-solid fa-circle-arrow-down"></i></button>
                            </div>
                            <div class="col-3">
                                <label class="fontmed labelstyle mt-0" for="">FNF Documents</label>
                                <select name="" id="fnfDoc" class="border-2 w-100 bg-white p-1  border border-black rounded-1">
                                    <option value="choose">Choose</option>
                                @if($user_file->contains('fs_type', 1))
                                    @foreach($user_file as $uf)
                                    @if($uf->fs_type == 1)
                                    <option value='<?=$uf?>'>{{$uf->file_type}}</option>
                                    @endif
                                    @endforeach
                                @endif
                                </select>
                            </div>
                            <div class="col-2 d-flex align-items-end" id="fnfbtn">
                                <button class="btn btn-lg btn-primary" data-toggle="modal"
                                    data-target="{{ '#userfile' }}">{{ 'add file' }}<i
                                        class="ms-3 fa-solid fa-circle-arrow-down"></i></button>
                            </div>
                        </div>
                    </div>
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>




<!-- Modal for sale-->
<div class="modal fade salepopup" id="salepopup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <form method="post" target="_blank">
            @csrf
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-center">
                    Edit Attendance
                </div>

                <div class="modal-body">

                    <div class="col-12 m-auto">
                        <div class="row text-center">
                            <input type="hidden" name="user_id" value="" id="user_id">
                            <input type="hidden" name="mark_date" value="" id="mark_date">
                            <div class="col-4">
                                <label for="">Login Time</label>
                                <input type="time" name="login_time" value="" class="form-control" id="login_time">
                            </div>
                            <div class="col-4 d-flex justify-content-center align-self-end">
                                <p><b>09 : 60</b></p>
                            </div>
                            <div class="col-4">
                                <label for="">Logout Time</label>
                                <input type="time" name="logout_time" value="" id="logout_time" class="form-control">
                            </div>
                        </div>
                        <hr class="border border-dark">
                        <div class="row text-center">
                            <div class="col-4">
                                <label for="">Sale Made</label>
                                <input type="number" name="sale_made" value="" id="sale_made" class="w-100 form-control">
                            </div>
                            <div
                                class="col-4 text-center d-flex justify-content-center align-items-end overflow-hidden">
                                <div style="  border-left: 2px solid rgb(183, 183, 183); height: 70%;"></div>
                            </div>
                            <div class="col-4">
                                <label for="">Customer</label>
                                <input type="number" name="customer" value="" id="customer" class="w-100 form-control">
                            </div>
                        </div>
                        <hr class="border border-dark">
                        <div class="row text-center">
                            <div class="col-4">
                                <label for="">Incentive</label>
                                <input type="number" name="incentive" value="" id="incentive" class="w-100 form-control">
                            </div>
                            <div
                                class="col-4 text-center d-flex justify-content-center align-items-end overflow-hidden">
                                <div style="  border-left: 2px solid rgb(183, 183, 183); height: 70%;"></div>
                            </div>
                            <div class="col-4">
                                <label for="">mark</label>
                                <input list="marksugg" name="mark" id="mark" class="w-100 form-control">
                                <datalist id="marksugg">
                                  <option value="P">
                                  <option value="A">
                                  <option value="H">
                                  <option value="PL">
                                  <option value="HPL">
                                  <option value="UPL">
                                  <option value="Sun">
                                </datalist>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Modal for edit profile-->
<div class="modal fade editpopup " id="editpopup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable ">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ">
                <div class="container ">
                    <form action="{{env('APP_URL')}}profile/edit" class="row" method="post"
                        enctype='multipart/form-data'>
                        @csrf

                        <div class="bg-white p-4 rounded-4">
                            <div class="col-12 d-flex">
                                <label for="inputTag"
                                    style="position: relative; overflow: hidden; border-radius: 50%; margin: auto; border: 2px solid;height: 120px;width: 120px; background-color: white ;">

                                    <img src="{{ $user->photo ? env('APP_URL') .'public/uploads/'.$user->photo : env('APP_URL') . 'public/assets/images/46547084.jpg' }}"
                                        style="border-radius: 50%;object-fit: cover;height: 100%; width: 100%;"
                                        id="prve">
                                    <input type="file" class="fileinput"
                                        accept="image/png, image/jpg, image/gif, image/jpeg" id="inputTag" name="photo">
                                    <div class="btn position-absolute bottom-0 start-0 end-0 text-white"><i
                                            style="background-color: #006396;padding: 10px; border-radius: 50%;"
                                            class="fa-solid fa-user-pen"></i> </div>
                                </label>
                                <script>
                                    document.addEventListener("DOMContentLoaded", function () {
                                        let input = document.getElementById("inputTag");
                                        let privewIg = document.getElementById("prve")
                                        input.addEventListener("change", () => {
                                            let fileSelect = input.files[0];
                                            if (fileSelect) {
                                                const reader = new FileReader();

                                                reader.onload = function (e) {
                                                    privewIg.setAttribute('src', e.target.result);
                                                }

                                                reader.readAsDataURL(fileSelect);
                                            }
                                        });
                                    });
                                </script>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <p class="h4 fw-bold">Personal Details</p>
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="fontmed" for="">Full Name (Capital Letter)<span
                                                    class="text-danger">*</span></label>
                                            <div
                                                class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                                <i class="fa-solid fa-user inputicon"></i>
                                                <input type="text" name="name" value="{{$profile->name}}"
                                                    class="border-0 w-100 bg-white p-1">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label class="fontmed" for="">Email ID<span
                                                    class="text-danger">*</span></label>
                                            <div
                                                class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                                <i class="fa-solid fa-envelope inputicon"></i>
                                                <input type="email" name="email" value="{{$profile->email}}"
                                                    class="border-0 w-100 bg-white p-1">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-5">
                                                    <label class="fontmed" for="">Contact Number<span
                                                            class="text-danger">*</span></label>
                                                    <div
                                                        class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                                        <span class="inputicon" style="font-size: 16px;">+91</span>
                                                        <input type="number" name="mobile" value="{{$profile->mobile}}"
                                                            class="border-0 w-100 bg-white p-1">
                                                    </div>
                                                </div>
                                                <div class="col-7">
                                                    <label class="fontmed" for="">Date Of Birth<span
                                                            class="text-danger">*</span></label>
                                                    <div class="row">
                                                        @php($dob = explode('-',$user->dob ? $user->dob :
                                                        date('Y-m-d')))
                                                        <div class="col-4 p-1">
                                                            <select id="day" name="dob[day]"
                                                                class="rounded dobstyle w-100 w-100">
                                                                <option value="" disabled selected>Day</option>
                                                                @for ($i = 1; $i <= 31; $i++) <option value='{{$i}}'
                                                                    @if($dob[2]==$i){{'selected'}}@endif>{{$i}}</option>
                                                                    @endfor
                                                                    ?>
                                                            </select>
                                                        </div>

                                                        <div class="col-4 p-1">
                                                            <select id="month" name="dob[month]"
                                                                class="rounded dobstyle w-100">
                                                                <option value="" disabled selected>Month</option>
                                                                @php($months = array(
                                                                "January", "February", "March", "April", "May", "June",
                                                                "July", "August", "September", "October", "November",
                                                                "December"
                                                                ))

                                                                @foreach ($months as $index => $month)
                                                                @php($monthNumber = $index + 1)
                                                                <option value='{{$monthNumber}}'
                                                                    @if($dob[1]==$monthNumber){{'selected'}}@endif>
                                                                    {{$month}}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-4 p-1">
                                                            <select id="year" name="dob[year]"
                                                                class="rounded dobstyle w-100">
                                                                <option value="" disabled selected>Year</option>
                                                                @php($currentYear = date("Y"))
                                                                @php($startYear = $currentYear - 100)
                                                                @for ($i = $currentYear; $i >= $startYear; $i--)
                                                                <option value='{{$i}}'
                                                                    @if($dob[0]==$i){{'selected'}}@endif>{{$i}}
                                                                </option>
                                                                @endfor

                                                            </select>
                                                        </div>
                                                        <!-- <input type="date" name="dob" value="{{$user->dob}}"> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-5">
                                                    <label class="fontmed" for="">Alternative Number</label>
                                                    <div
                                                        class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                                        <span class="inputicon" style="font-size: 16px;">+91</span>
                                                        <input type="number" name="alt_mobile"
                                                            value="{{$user->alt_mobile}}"
                                                            class="border-0 w-100 bg-white p-1">
                                                    </div>
                                                </div>
                                                <div class="col-7">
                                                    <label class="fontmed" for="">Date of Joining the company<span
                                                            class="text-danger">*</span></label>
                                                    <div class="row">
                                                        @php($joining_date = explode('-',$user->joining_date ?
                                                        $user->joining_date : date('Y-m-d')))
                                                        <div class="col-4 p-1">
                                                            <select id="day" name="joining_date[day]"
                                                                class="rounded dobstyle w-100">
                                                                <option value="" disabled selected>Day</option>

                                                                @for ($i = 1; $i <= 31; $i++) <option value='{{$i}}'
                                                                    @if($joining_date[2]==$i){{'selected'}}@endif>{{$i}}
                                                                    </option>
                                                                    @endfor
                                                            </select>
                                                        </div>

                                                        <div class="col-4 p-1">
                                                            <select id="month" name="joining_date[month]"
                                                                class="rounded dobstyle w-100">
                                                                <option value="" disabled selected>Month</option>
                                                                @php
                                                                $months = array(
                                                                "January", "February", "March", "April", "May", "June",
                                                                "July", "August", "September", "October", "November",
                                                                "December"
                                                                )

                                                                @foreach ($months as $index => $month)
                                                                @php($monthNumber = $index + 1)
                                                                <option value='{{$monthNumber}}'
                                                                    @if($joining_date[1]==$monthNumber){{'selected'}}@endif>
                                                                    {{$month}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-4 p-1">
                                                            <select id="year" name="joining_date[year]"
                                                                class="rounded dobstyle w-100">
                                                                <option value="" disabled selected>Year</option>
                                                                @php
                                                                $currentYear = date("Y")
                                                                @php($startYear = $currentYear - 100)
                                                                @for ($i = $currentYear; $i >= $startYear; $i--)
                                                                <option value='{{$i}}'
                                                                    @if($joining_date[0]==$i){{'selected'}}@endif>{{$i}}
                                                                </option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                        <!-- <input type="date" name="dob" value="{{$user->dob}}"> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-6 position-relative">
                                    <p class="h4 fw-bold">Professional Details</p>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-7">
                                                    <label class="fontmed" for="">Aadhaar Card Number<span
                                                            class="text-danger">*</span></label>
                                                    <div
                                                        class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                                        <div class="inputicon"> <img
                                                                src="{{env('APP_URL')}}/icon/Aadhar-Black.svg"
                                                                style="width: 25px; border: 1px solid;">
                                                        </div>
                                                        <input type="text" value="{{$profile->adhar_no}}"
                                                            name="adhar_no" class="border-0 w-100 bg-white p-1">
                                                    </div>
                                                </div>
                                                <div class="col-5 p-0 align-self-end mt-5">
                                                    <button type="button" class="btn btnupload" data-toggle="modal"
                                                        data-target="#Aadhaarmodal">Upload Aadhar <i
                                                            class="fa-solid fa-arrow-up-from-bracket"></i></button>
                                                    <span style="font-size: 10px;" class="text-muted p-1">Upload both
                                                        front & Back
                                                        of your Aadhaar</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="row">

                                                <div class="col-7">
                                                    <label class="fontmed" for="" class="m-0">PAN Card Number<span
                                                            class="text-danger">*</span></label>
                                                    <div
                                                        class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                                        <div class="inputicon">
                                                            <i class="fa-solid fa-id-card fa-xl inputicon"></i>
                                                        </div>
                                                        <input type="text" value="{{$profile->pan_no}}" name="pan_no"
                                                            class="border-0 w-100 bg-white p-1">
                                                    </div>
                                                </div>
                                                <div class="col-5 p-0 align-self-end mt-">
                                                    <button type="button" class="btn btnupload m-auto"
                                                        data-toggle="modal" data-target="#panmodal">Upload PAN <i
                                                            class="fa-solid fa-arrow-up-from-bracket"></i></button>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="d-flex position-absolute bottom-0">
                                        <div class="mt-auto">
                                            <img src="{{env('APP_URL')}}icon/adam.png" alt="" class="w-100 ">
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class=" bg-white p-4 rounded-4 my-4">
                            <p class="text-center h4 fw-bold">Banking Details</p>
                            <p class="text-center">Make sure to provide correct information, In case of wrong
                                information company
                                will not be
                                responsible for salary delays or misplace of your salary.</p>

                            <div class="row">
                                <div class="col-6 p-0">
                                    <div class="col-12">
                                        <label class="fontmed" for="">Account Holder Name<span
                                                class="text-danger">*</span></label>
                                        <div
                                            class="   p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                                            <i class="fa-solid fa-user inputicon"></i>
                                            <input type="text" name="bank_account_holder_name"
                                                value="{{$user->bank_account_holder_name}}"
                                                class="border-0 w-100 bg-white p-1"
                                                placeholder="Enter your Account Holder Name">

                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label class="fontmed" for="">Account Number<span
                                                class="text-danger">*</span></label>
                                        <div
                                            class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                                            <i class="fa-solid fa-user inputicon"></i>
                                            <input type="text" name="account_no" value="{{$user->account_no}}"
                                                class="border-0 w-100 bg-white p-1"
                                                placeholder="Enter your Account Number">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 p-0">
                                    <div class="col-12">
                                        <label class="fontmed" for="">Bank Name<span
                                                class="text-danger">*</span></label>
                                        <div
                                            class="   p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                                            <i class="fa-solid fa-user inputicon"></i>
                                            <input type="text" name="bank_name" value="{{$user->bank_name}}"
                                                class="border-0 w-100 bg-white p-1" placeholder="Enter Bank Name">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label class="fontmed" for="">IFSC Code<span
                                                class="text-danger">*</span></label>
                                        <div
                                            class=" p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                                            <i class="fa-solid fa-user inputicon"></i>
                                            <input type="text" name="ifsc_code" value="{{$user->ifsc_code}}"
                                                class="border-0 w-100 bg-white p-1" placeholder="Enter Bank IFSC Code">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-center bg-white border-0 mt-5">
                                <button type="submit" class="btn baseBtnBg text-white"><i
                                        class="fa-solid fa-user-pen"></i> Save
                                    Information</button>
                            </div>

                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal uplode adhar card and priview -->
<div class="modal fade" id="Aadhaarmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg  mycontainer p-0 ">
        <div class="modal-content">
            <div class="modal-header justify-content-center">
                <button type="button" class="btn-close" data-toggle="modal" data-target="#Aadhaarmodal"></button>
            </div>
            <div class="modal-body mycontainer">
                <div class="row">
                    <div class="col-12 text-center">
                        <h3>Upload your Aadhar Card</h3>
                        <p>upload clear image for successful verification</p>
                    </div>
                    <div class="col-12 ">
                        <div class="row border rounded p-2 border-1 border-secondary my-3">
                            <div class="col-6 row justify-content-center align-items-center">
                                <div class="col-7">

                                    <input type="file" name="aadhar_card"
                                        accept="image/png, image/jpg, image/gif, image/jpeg" class="d-none" id="ua">
                                    <label for="ua"
                                        class="btn btnupload mb-3 fontmed d-flex justify-content-between align-items-center">
                                        Upload <i class="fa-solid fa-arrow-up-from-bracket"></i>
                                    </label>
                                    <p class="text-center vsmatxt"><b style="color: #0099C7;">Re
                                            Upload
                                            Again?</b></p>
                                </div>
                            </div>
                            <script>
                                document.addEventListener("DOMContentLoaded", function () {
                                    let input = document.getElementById("ua");
                                    let privewIg = document.getElementById("prvei")
                                    input.addEventListener("change", () => {
                                        let fileSelect = input.files[0];
                                        if (fileSelect) {
                                            const reader = new FileReader();

                                            reader.onload = function (e) {
                                                privewIg.setAttribute('src', e.target.result);
                                            }

                                            reader.readAsDataURL(fileSelect);
                                        }
                                    });
                                });
                            </script>
                            <div class="col-6">
                                <div class="row d-flex justify-content-center align-items-center">
                                    <p class="text-center smaTxt my-2"><b>Preview of your front
                                            Aadhaar</b></p>
                                    <div class="col-12 d-flex justify-content-center align-items-center">

                                        <img src="{{$user->aadhar_card ? env('APP_URL').'public/uploads/'.$user->aadhar_card : env('APP_URL'.'icon/frontaadhaar.png')}}"
                                            style="width: 276p;height: 163px;" id="prvei">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row border rounded p-2 border-1 border-secondary my-3">
                            <div class="col-6 row justify-content-center align-items-center">
                                <div class="col-7">
                                    <input type="file" name="aadhar_card_back"
                                        accept="image/png, image/jpg, image/gif, image/jpeg" class="d-none" id="uba">
                                    <label for="uba"
                                        class="btn btnupload mb-3 fontmed d-flex justify-content-between align-items-center">
                                        Upload <i class="fa-solid fa-arrow-up-from-bracket"></i>
                                    </label>
                                    <p class="text-center vsmatxt"><b style="color: #0099C7; ">Re Upload
                                            Again?</b>
                                    </p>
                                </div>
                            </div>
                            <script>
                                document.addEventListener("DOMContentLoaded", function () {
                                    let input = document.getElementById("uba");
                                    let privewIg = document.getElementById("ubip")
                                    input.addEventListener("change", () => {
                                        let fileSelect = input.files[0];
                                        if (fileSelect) {
                                            const reader = new FileReader();

                                            reader.onload = function (e) {
                                                privewIg.setAttribute('src', e.target.result);
                                            }

                                            reader.readAsDataURL(fileSelect);
                                        }
                                    });
                                });
                            </script>
                            <div class="col-6">
                                <div class="row d-flex justify-content-center align-items-center">
                                    <p class="text-center smaTxt my-2"><b>Preview of your back
                                            Aadhaar</b></p>
                                    <div class="col-12 d-flex justify-content-center align-items-center">
                                        <img src="{{$user->aadhar_card_back ? env('APP_URL').'public/uploads/'.$user->aadhar_card_back : env('APP_URL'.'icon/backaadhaar.png')}}"
                                            style="width: 276p;height: 163px;" id="ubip">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <button type="button" data-dismiss="modal"
                                class="btn m-auto baseBtnBg fontmed text-center col-3 btn-lg smaTxt">SAVE</button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- uplode pan card -->
<div class="modal fade" id="panmodal" tabindex="-1" aria-labelledby="panModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg  mycontainer p-0 ">
        <div class="modal-content">
            <div class="modal-header justify-content-center">
                <button type="button" class="btn-close" data-toggle="modal" data-target="#panmodal"></button>
            </div>
            <div class="modal-body mycontainer">
                <div class="row">
                    <div class="col-12 text-center">
                        <h3>Upload your pan Card</h3>
                        <p>upload clear image for successful verification</p>
                    </div>
                    <div class="col-12 ">
                        <div class="row border rounded p-2 border-1 border-secondary my-3">
                            <div class="col-6 row justify-content-center align-items-center">
                                <div class="col-7">

                                    <input type="file" name="pan_card"
                                        accept="image/png, image/jpg, image/gif, image/jpeg" class="d-none" id="pa">
                                    <label for="pa"
                                        class="btn btnupload mb-3 fontmed d-flex justify-content-between align-items-center">
                                        Upload <i class="fa-solid fa-arrow-up-from-bracket"></i>
                                    </label>
                                    <p class="text-center vsmatxt"><b style="color: #0099C7;">Re
                                            Upload
                                            Again?</b></p>
                                </div>
                            </div>
                            <script>
                                document.addEventListener("DOMContentLoaded", function () {
                                    let input = document.getElementById("pa");
                                    let privewIg = document.getElementById("prveiw")
                                    input.addEventListener("change", () => {
                                        let fileSelect = input.files[0];
                                        if (fileSelect) {
                                            const reader = new FileReader();

                                            reader.onload = function (e) {
                                                privewIg.setAttribute('src', e.target.result);
                                            }
                                            reader.readAsDataURL(fileSelect);
                                        }
                                    });
                                });
                            </script>
                            <div class="col-6">
                                <div class="row d-flex justify-content-center align-items-center">
                                    <p class="text-center smaTxt my-2"><b>Preview of your front
                                            Aadhaar</b></p>
                                    <div class="col-12 d-flex justify-content-center align-items-center">
                                        <img src="{{$user->pan_card ? env('APP_URL').'public/uploads/'.$user->pan_card : env('APP_URL'.'icon/pan.png')}}"
                                            style="width: 276p;height: 163px;" id="prveiw">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <button type="button" data-dismiss="modal"
                                class="btn m-auto baseBtnBg fontmed text-center col-3 btn-lg  smaTxt">SAVE</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="userfile" tabindex="-1" aria-labelledby="userFileLabel" style="display: none;"
    aria-hidden="true">
    <div class="modal-dialog " style="width: 30%;">
        <div class="modal-content">
            <div class="modal-header flex-column bg-white SubHeding border-0">
                <div class=" align-self-end pe-7s-close" data-dismiss="modal" aria-label="Close"></div>
                <h5 class="modal-title text-center fontBold m-auto" id="userInfoLabel">Add new document</h5>
            </div>
            <form action="{{env('APP_URL')}}admin/save_user_file/{{$id}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="">
                        <div class="row align-items-center">
                            <div class="d-flex flex-column col-12 text-center">
                                <label for="" class="fontmed labelstyle ">User ID - {{$profile->name}}</label>
                                <input type="hidden" name="uid" value="{{$profile->id}}">
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="d-flex flex-column col-12">
                                <label for="" class="fontmed labelstyle ">File Type</label>
                                <select class="border-2 w-100 bg-white p-1  border border-black rounded-1"
                                    name="fs_type">
                                    <option value="0">Employee Document</option>
                                    <option value="1">FNF Document</option>
                                </select>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="d-flex flex-column col-12">
                                <label for="" class="fontmed labelstyle ">File Type</label>
                                <select class="border-2 w-100 bg-white p-1  border border-black rounded-1"
                                    name="file_type">
                                    <option>Resume</option>
                                    <option>Offer Letter</option>
                                    <option>Appoinment Letter</option>
                                    <option>Appraisal Letter</option>
                                    <option>Increment Letter</option>
                                </select>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="d-flex flex-column col-12">
                                <label for="" class="fontmed labelstyle ">File</label>
                                <input type="file" name="file">
                            </div>
                            <div class="d-flex flex-column col-12">
                                <label for="" class="fontmed labelstyle ">Date</label>
                                <input type="date" name="file_date">
                            </div>
                            <div class="col-12 align-items-center">
                                <br>
                                <button type="submit"
                                    class="btn col-12 baseBtnBg align-self-end text-white">Update</button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-center bg-white border-0"></div>
            </form>
        </div>
    </div>
</div>
</div>
<div class="modal fade" id="aadharfile" tabindex="-1" aria-labelledby="exampleModalLabel" style="display: none;"
    aria-hidden="true">
    <div class="modal-dialog " style="width: 30%;">
        <div class="modal-content">
            <div class="modal-header justify-content-center">
                <h2 class="modal-title" id="aadharModalLabel" style="font-size: 25px;">your Aadhaar Card
                </h2>
            </div>
            <div class="modal-body mycontainer">
                <div class="row">
                    <div class="col-12 ">
                        <div class="row border rounded p-2 border-1 border-secondary my-3">
                            <p class="text-center smaTxt my-2"><b>your front Aadhaar</b></p>
                            <div class="col-12 d-flex justify-content-center align-items-center">
                                <img src="{{env('APP_URL')}}/public/uploads/{{$profile->aadhar_card}}"
                                    style="width: 276p;height: 163px;" id="prvei">
                            </div>
                        </div>
                        <div class="row border rounded p-2 border-1 border-secondary my-3">
                            <p class="text-center smaTxt my-2"><b> your back Aadhaar</b></p>
                            <div class="col-12 d-flex justify-content-center align-items-center">
                                <img src="{{env('APP_URL')}}/public/uploads/{{$profile->aadhar_card_back}}"
                                    style="width: 276p;height: 163px;" id="ubip">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-center bg-white border-0"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="panfile" tabindex="-1" aria-labelledby="exampleModalLabel" style="display: none;"
    aria-hidden="true">
    <div class="modal-dialog " style="width: 30%;">
        <div class="modal-content">
            <div class="modal-body ">
                <div class="row">
                    <div class="col-12 ">
                        <div class="row border rounded p-2 border-1 border-secondary my-3">
                            <p class="text-center smaTxt my-2"><b>Preview of your front Aadhaar</b></p>
                            <div class="col-12 d-flex justify-content-center align-items-center">
                                <img src="{{$profile->pan_card ? env('APP_URL').'public/uploads/'.$profile->pan_card : env('APP_URL').'icon/pan.png'}}"
                                    style="width: 276p;height: 163px;" id="prveiw">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade " id="letterr" tabindex="-1" aria-labelledby="letterLabel" style="display: none;"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header flex-column bg-white SubHeding border-0">
                <div class=" align-self-end pe-7s-close" data-dismiss="modal" aria-label="Close"></div>
                <h5 class="modal-title text-center fontBold m-auto" id="dt"></h5>
                <p class="text-center fontmed vsmatxt w-100" id="date"></p>
            </div>
            <div class="modal-body">
                <object id="hichu" data="" type="application/pdf" width="100%" height="500px"></object>  
            </div>
            <div class="modal-footer justify-content-center bg-white border-0"></div>
        </div>
    </div>
</div>
<div class="modal fade " id="fnfletter" tabindex="-1" aria-labelledby="fnfletterLabel" style="display: none;"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header flex-column bg-white SubHeding border-0">
                <div class=" align-self-end pe-7s-close" data-dismiss="modal" aria-label="Close"></div>
                <h5 class="modal-title text-center fontBold m-auto" id="dtt"></h5>
                <p class="text-center fontmed vsmatxt w-100" id="datet"></p>
            </div>
            <div class="modal-body">
                <object id="fnffi" data="" type="application/pdf" width="100%" height="500px"></object>      
            </div>
            <div class="modal-footer justify-content-center bg-white border-0"></div>
        </div>
    </div>
</div>
@include('admin.includes.footer')
<script>
    function setButtonHTML(elemId, btnId) {
    let selectedValue = document.getElementById(elemId).value;
    let buttonHTML = '';
    if(selectedValue === "choose"){
        buttonHTML = '<button class="btn btn-lg btn-primary" data-toggle="modal" data-target="#userfile">Add File <i class="ms-3 fa-solid fa-circle-arrow-down"></i></button>';
    } else {
        buttonHTML = `<button class="btn btn-lg btn-primary" data-toggle="modal" data-target="{{ $user_file->count() > 0 ? '#fnfletter' : '#userfile' }}">{{ $user_file->count() > 0 ? 'view file' : 'add file' }}<i class="ms-3 fa-solid fa-circle-arrow-down"></i></button>`;
    }
    document.getElementById(btnId).innerHTML = buttonHTML;
}

function handleDropdownChange(elem, btnId, dataElem, fileTypeElem, dateElem, baseUrl) {
    if(elem.value !== "choose"){
        let va = JSON.parse(elem.value);
        let btn = `<button class="btn btn-lg btn-primary" data-toggle="modal" data-target="{{ $user_file->count() > 0 ? '#fnfletter' : '#userfile' }}">{{ $user_file->count() > 0 ? 'view file' : 'add file' }}<i class="ms-3 fa-solid fa-circle-arrow-down"></i></button>`;
        document.getElementById(btnId).innerHTML = btn;
        document.getElementById(fileTypeElem).innerHTML = va.file_type;
        document.getElementById(dateElem).innerHTML = va.file_date;
        document.getElementById(dataElem).setAttribute("data", baseUrl + va.file);
    } else {
        setButtonHTML(elem.id, btnId);
    }
}
document.addEventListener('DOMContentLoaded', (event) => {
    let baseUrl = "{{ env('APP_URL') }}public/uploads/";

    setButtonHTML("fnfDoc", "fnfbtn");
    setButtonHTML("empDoc", "empbtn");

    document.getElementById("fnfDoc").onchange = function() {
        handleDropdownChange(this, "fnfbtn", "fnffi", "dtt", "date", baseUrl);
    };

    document.getElementById("empDoc").onchange = function() {
        handleDropdownChange(this, "empbtn", "hichu", "dt", "date", baseUrl);
    };
});
</script>
<script>
function sale(a){
    let ad = JSON.parse(a);
    $('#user_id').val(ad.user_id);
    $('#mark_date').val(ad.mark_date);
    $('#login_time').val(ad.login_time);
    $('#logout_time').val(ad.logout_time);
    $('#sale_made').val(ad.sale_made);
    $('#customer').val(ad.customer);
    $('#incentive').val(ad.incentive);
    $('#mark').val(ad.mark);
    console.log(ad);
}
</script>