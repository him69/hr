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
    <div class="app-main">
        @include('user.includes.sidebar')
        <div class="app-main__outer collapse d-block">
            <div class="app-main__inner">
                <nav class="row gx-0 m-0 my-2 px-2 justify-content-between">
                    <div class="nav justify-content-around nav-tabs d-flex gx-0 m-0 border-0" id="nav-tab" role="tablist" style="border-bottom: 1px solid;">
                        <button class="nav-link active text-center" onclick="navchange('nav-home')" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-home" aria-selected="false">Profile</button>
                        <button class="nav-link text-center" onclick="navchange('nav-attendance')" id="nav-attendance-tab" data-bs-toggle="tab" data-bs-target="#nav-attendance" type="button" role="tab" aria-controls="nav-attendance" aria-selected="true">Attendnce</button>
                        <button class="nav-link text-center" onclick="navchange('nav-leave')" id="nav-leave-tab" data-bs-toggle="tab" data-bs-target="#nav-leave" type="button" role="tab" aria-controls="nav-leave" aria-selected="true">Leaves</button>
                        <button class="nav-link text-center" onclick="navchange('nav-file')" id="nav-file-tab" data-bs-toggle="tab" data-bs-target="#nav-file" type="button" role="tab" aria-controls="nav-file" aria-selected="true">Emp-File</button>
                        <a class="nav-link text-center" href="{{env('APP_URL')}}adper/user_mode/{{$id}}" target="_blank">
                            view Dashboard
                        </a>
                        <i class="bi bi-reply-all SubHeding text-end
                            " onclick="history.back()" style=" cursor: pointer;"></i>

                    </div>
                    <div class="col-4 row  justify-content-end ">

                        <!-- <a class="p-2 col-3 baseBtnBg col-6 border-0 rounded text-center text-white" href="{{env('APP_URL')}}adper/user_mode/{{$id}}" target="_blank">
                            view Dashboard
                        </a> -->

                    </div>
                </nav>
            </div>
            <div class="tab-content " id=" nav-tabContent">
                @if(session('message'))
                <div class="alert {{ session('alert-class') }}">{{ session('message') }}</div>
                @endif
                <div class="tab-pane fade show m-auto mb-0 active" style="width: 98%;" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="borderRadius baseShadow bg-white my-2 mx-auto p-2">
                        <div class="row">
                            <div class="col-3" style="display: flex;align-items: center;justify-content: center;flex-direction: column;">
                                <div class="rounded-circle overflow-hidden proPic ">
                                    @if(isset($profile) && isset($profile->photo))
                                    <img src="{{ env('APP_URL') }}/public/uploads/{{ $profile->photo }}" alt="Profile Photo">
                                    @else
                                    <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" alt="Default Profile Photo">
                                    @endif
                                </div>
                                <div class="para">
                                    <p class="fw-bold m-0">{{$profile->name ? $profile->name : 'NA'}} @if($profile->lead == 1) <i class="fa-solid fa-certificate cttext" title="Team Leader"></i> @endif</p>
                                    <p class="text-center">
                                        {{$profile->d_name}}
                                    </p>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="para">
                                    <p class="fw-bold m-0">User Id</p>
                                    <p class="m-0">{{$profile->user_id ? $profile->user_id : 'NA'}}</p>
                                </div>
                                <div class="para">
                                    <p class="fw-bold m-0">Password</p>
                                    <p class="m-0">{{ $profile->password ? $profile->password : 'NA'}}</p>
                                </div>
                                <div class="para">
                                    <p class="fw-bold m-0">Email</p>
                                    <p class="m-0">{{ $profile->email ? $profile->email : 'NA'}}</p>
                                </div>
                                <div class="para">
                                    <p class="fw-bold m-0">Salary</p>
                                    <p class="m-0">{{ $profile->salary ? $profile->salary : 'NA'}}</p>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="para">
                                    <p class="fw-bold m-0">Designation</p>
                                    <p class="m-0">{{$profile->designation ? $profile->designation : 'NA'}}</p>
                                </div>
                                <div class="para">
                                    <p class="fw-bold m-0">Joining Date</p>
                                    <p class="m-0">{{$profile->joining_date ? $profile->joining_date :'NA'}}</p>
                                </div>
                                <div class="para">
                                    <p class="fw-bold m-0">Phone Number</p>
                                    <p class="m-0">{{$profile->mobile ? $profile->mobile: 'NA'}}</p>
                                </div>
                                <div class="para">
                                    <p class="fw-bold m-0">D.O.B</p>
                                    <p class="m-0">{{$profile->dob ? $profile->dob : 'NA'}}</p>
                                </div>
                            </div>
                            <p class="col-1 SubHeding text-end m-0" data-toggle="modal" data-target="#userinfo"><i class="bi bi-pen"></i></p>
                        </div>
                    </div>
                    <div class="borderRadius baseShadow bg-white my-2 mx-auto p-2">
                        <div class="row">
                            <p class="SubHeding  col-12 fw-bold text-center">
                                User Documents <i data-toggle="modal" data-target="#userDoc" class="bi bi-pen" style="float: right;"></i>
                            </p>
                        </div>
                        <div class="">
                            <div class=" row py-3">
                                <div class="col-6">
                                    <div class="para row align-items-center">
                                        <p class="m-0 fontBold col-4">Aadhar Card:-</p>
                                        @if(!empty($profile->aadhar_card))
                                        <a href="{{env('APP_URL')}}public/uploads/{{$profile->aadhar_card}}" target="_blank" style="text-align:center;" class="p-2 col-3 baseBtnBg border-0 rounded mx-2 text-white">
                                            view
                                        </a>
                                        @else
                                        Aadhar card not uploaded
                                        @endif
                                    </div>
                                    <br>
                                    <br>
                                    <div class="para row align-items-center">
                                        <p class="m-0 fontBold col-4">Aadhar Card Back:-</p>
                                        @if(!empty($profile->aadhar_card_back))
                                        <a href="{{env('APP_URL')}}public/uploads/{{$profile->aadhar_card_back}}" target="_blank" style="text-align:center;" class="p-2 col-3 baseBtnBg border-0 rounded mx-2 text-white">
                                            view
                                        </a>
                                        @else
                                        Aadhar card not uploaded
                                        @endif
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="para">
                                        <div class="fontBold">
                                            Aadhar number
                                        </div>
                                        <div>
                                            {{$profile->adhar_no}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row py-3">
                                <div class="p-3 col-6">
                                    <div class="para row align-items-center">
                                        <p class="m-0 fontBold col-4">pan Card:-</p>
                                        @if(!empty($profile->pan_card))
                                        <a href="{{env('APP_URL')}}public/uploads/{{$profile->pan_card}}" target="_blank" style="text-align:center;" class="p-2 baseBtnBg border-0 rounded mx-2 text-white col-3">
                                            view
                                        </a>
                                        @else
                                        Pan card not uploaded
                                        @endif
                                    </div>

                                </div>
                                <div class="col-6">
                                    <div class="para">
                                        <div class="fontBold">
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
                    <div class="borderRadius baseShadow bg-white my-2 mx-auto p-2">
                        <div class="row">
                            <p class="SubHeding fw-bold col-10 text-center">
                                User Bank Details
                            </p>
                            <p class="col-2 SubHeding text-end m-0" data-toggle="modal" data-target="#userBankDetail"><i class="bi bi-pen"></i></p>
                        </div>
                        <div class="row justify-content-between">
                            <div class="col-3">
                                <div class="para">
                                    <p class="fw-bold m-0">Bank Name</p>
                                    <p class="m-0">{{$profile->bank_name ? $profile->bank_name : 'NA'}}</p>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="para">
                                    <p class="fw-bold m-0">IFSC code </p>
                                    <p class="m-0">{{$profile->ifsc_code ? $profile->ifsc_code :'NA'}}</p>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="para">
                                    <p class="fw-bold m-0">Account number</p>
                                    <p class="m-0">{{$profile->account_no ? $profile->account_no : 'NA'}}</p>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="para">
                                    <p class="fw-bold m-0">Bank account holder name</p>
                                    <p class="m-0">{{$profile->bank_account_holder_name ? $profile->bank_account_holder_name : 'NA'}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="borderRadius baseShadow bg-white my-2 mx-auto p-2">
                        <div class="row">
                            <p class="SubHeding col-10 fw-bold text-center">
                                Assigned Asset
                            </p>
                            <p class="col-2 SubHeding text-end m-0" data-toggle="modal" data-target="#AssignAssets"><i class="bi bi-pen"></i></p>
                        </div>
                        <div class="row">
                            @foreach($ass as $as)
                            <div class="col-4">
                                <div class="d-flex flex-column">
                                    <p class="samllText fontBold px-1">{{$as->asset_type}}</p>
                                    <p class="bg-warning rounded px-1">{{$as->asset_name}}, {{$as->serial_number}}, {{$as->ass_spec}}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade m-auto" id="nav-attendance" role="tabpanel" aria-labelledby="nav-attendance-tab" style="width: 98%;">
                    <div class="borderRadius baseShadow bg-white my-2 mx-auto p-2">
                        <form method="post">
                            @csrf
                            <div class="row align-items-center gx-0 mx-0 my-1">
                                <div class="row m-0 col-4 align-items-center bg-white baseShadow rounded-2">
                                    <div class="col-6 p-0">
                                        <input type="month" name="month" value="{{$date}}" class="form-control border-0">
                                    </div>
                                    <div class="col-6 p-0">
                                        <button class="btn baseBtnBg w-100 text-white" type="submit" name="showtab" value="nav-attendance">
                                            <span>Search by month</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <p class="SubHeding m-0 text-center">User Attendance</p>
                                </div>
                            </div>
                        </form>
                        <div class="table-responsive">
                            @if($profile->user_type == 1)
                            <table class="table table-hover table-bordered table-sm">
                                <tr>
                                    <th colspan="10">
                                        <p class="text-center">ATTENDENCE SHEET <span style="text-transform: uppercase;"></span></p>
                                    </th>
                                </tr>
                                <tr>
                                    <th style="min-width: 100px;">Mark Date</th>
                                    <th>Nonpause</th>
                                    <th>Login Time</th>
                                    <th>Logout Time</th>
                                    <th>Sale Made</th>
                                    <th>Customer</th>
                                    <th>Incentive</th>
                                    <th>Mark</th>
                                    <th>Action</th>
                                </tr>
                                @php($mte = 01)
                                @foreach($users as $us)
                                @while($mte < explode('-',$us->mark_date)[2])
                                    @php($day = explode('-',$us->mark_date)[0].'-'.explode('-',$us->mark_date)[1].'-'.str_pad($mte, 2, "0", STR_PAD_LEFT))
                                    @php($dayname = date('D', strtotime($day)))
                                    <tr @if($dayname=='Sun' ) style="background:#c0c0c0; color:#000;" @endif>
                                        <form method="post" target="_blank">
                                            @csrf
                                            <td>{{$day}}</td>
                                            <td></td>
                                            <td><input type="text" name="login_time" class="form-control">
                                            </td>
                                            <td><input type="text" name="logout_time" class="form-control">
                                            </td>
                                            <td><input type="number" name="sale_made" class="form-control">
                                            </td>
                                            <td><input type="number" name="customer" class="form-control">
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
                                    @php($mte++)
                                    @endwhile
                                    <tr @if($us->mark == 'Sun') style="background:#c0c0c0; color:#000;"
                                        @endif><form method="post" target="_blank">
                                            @csrf
                                            <td>{{$us->mark_date}}</td>
                                            <td>{{$us->nonpause}}</td>
                                            <td><input type="text" value="{{$us->login_time}}" name="login_time" class="form-control"></td>
                                            <td><input type="text" value="{{$us->logout_time}}" name="logout_time" class="form-control"></td>
                                            <td><input type="number" value="{{$us->sale_made}}" name="sale_made" class="form-control"></td>
                                            <td><input type="number" value="{{$us->customer}}" name="customer" class="form-control"></td>
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
                                    @php($mte++)
                                    @endforeach
                                    @while($mte < $total_working) @if(isset($us)) @php($day=explode('-',$us->mark_date)[0].'-'.explode('-',$us->mark_date)[1].'-'.str_pad($mte, 2, "0", STR_PAD_LEFT))
                                        @else
                                        @php($day = $date.'-'.str_pad($mte, 2, "0", STR_PAD_LEFT))
                                        @endif
                                        @php($dayname = date('D', strtotime($day)))
                                        <tr @if($dayname=='Sun' ) style="background:#c0c0c0; color:#000;" @endif>
                                            <form method="post" target="_blank">
                                                @csrf
                                                <td>{{$day}}</td>
                                                <td></td>
                                                <td><input type="text" name="login_time" class="form-control">
                                                </td>
                                                <td><input type="text" name="logout_time" class="form-control">
                                                </td>
                                                <td><input type="number" name="sale_made" class="form-control">
                                                </td>
                                                <td><input type="number" name="customer" class="form-control">
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
                                        @php($mte++)
                                        @endwhile
                            </table>
                            @else
                            <table class="table table-hover table-bordered table-sm">
                                <tr>
                                    <th colspan="10">
                                        <p class="text-center">ATTENDENCE SHEET <span style="text-transform: uppercase;"></span></p>
                                    </th>
                                </tr>
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
                                    <tr @if($us->mark == 'Sun') style="background:#c0c0c0; color:#000;"
                                        @endif><form action="{{env('APP_URL')}}adper/attendance/qa_full_report/{{$us->user_id}}" method="post" target="_blank">
                                            @csrf
                                            <td>{{explode('-',$us->mark_date)[0].'-'.explode('-',$us->mark_date)[1].'-'.str_pad($mte,
                                                        2, "0", STR_PAD_LEFT);}}</td>
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
                                    @php($mte++)
                                    @endwhile
                                    <tr @if($us->mark == 'Sun') style="background:#c0c0c0; color:#000;"
                                        @endif><form action="{{env('APP_URL')}}adper/attendance/qa_full_report/{{$us->user_id}}" method="post" target="_blank">
                                            @csrf
                                            <td>{{$us->mark_date}}</td>
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
                                    @php($mte++)
                                    @endforeach
                                    @while($mte <= $total_working) @if(isset($us)) @php($day=explode('-',$us->mark_date)[0].'-'.explode('-',$us->mark_date)[1].'-'.str_pad($mte, 2, "0", STR_PAD_LEFT))
                                        @else
                                        @php($day = $date.'-'.str_pad($mte, 2, "0", STR_PAD_LEFT))
                                        @endif
                                        @php($dayname = date('D', strtotime($day)))
                                        <tr @if($dayname=='Sun' ) style="background:#c0c0c0; color:#000;" @endif>
                                            <form method="post" target="_blank">
                                                @csrf
                                                <td>{{$day}}</td>
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
                                                        <option value="Sun" @if($dayname=='Sun' ){{'selected'}}@endif>Sun</option>
                                                    </select>
                                                    <input type="hidden" name="user_id" value="{{$profile->id}}">
                                                    <input type="hidden" name="user_type" value="{{$profile->user_type}}">
                                                    <input type="hidden" name="mark_date" value="{{$day}}">
                                                </td>
                                                <td><button class="btn btn-success">Save</button></td>
                                            </form>
                                        </tr>
                                        @php($mte++)
                                        @endwhile
                            </table>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade m-auto" id="nav-leave" role="tabpanel" aria-labelledby="nav-leave-tab" style="width: 98%;">
                    <div class="main-card mb-3 card ">
                        <form method="post">
                            @csrf
                            <div class="row align-items-center gx-0 mx-0 my-1">
                                <div class="row m-0 col-4 align-items-center bg-white baseShadow rounded-2">
                                    <div class="col-6 p-0">
                                        <input type="month" name="month" value="{{$date}}" class="form-control border-0">
                                    </div>
                                    <div class="col-6 p-0">
                                        <button class="btn baseBtnBg w-100 text-white" type="submit" name="showtab" value="nav-leave">
                                            <span>Search by month</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <p class="SubHeding m-0 text-center">User Attendance</p>
                                </div>
                            </div>
                        </form>
                        <div class="card-body table-responsive">
                            <table class="table table-hover table-bordered table-sm">
                                <tr>
                                    <th>Name</th>
                                    <th>Leave From</th>
                                    <th>Leave To</th>
                                    <th>Reason</th>
                                    <th>Action</th>
                                </tr>
                                @if($leaves->count() > 0)
                                @foreach($leaves as $leave)
                                <tr>
                                    <td>{{$leave->username}}</td>
                                    <td>{{$leave->leave_from}}</td>
                                    <td>{{$leave->leave_to}}</td>
                                    <td>{{$leave->reason}}</td>
                                    <td>@if($leave->approved == 0) <a href="{{env('APP_URL')}}adper/leave_approve/{{$leave->id}}" class="btn btn-success">Approve</a> @else <button class="btn btn-default" disabled>Approved</button> @endif</td>
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
                                    <div style="width:100%;">
                                        <button class="btn btn-primary" style="width:100%;" data-toggle="modal" data-target="#userfile">Add File</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-hover table-bordered table-sm">
                                <tr>
                                    <th>S.no</th>
                                    <th>Document Type</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                                @if($user_file->count() > 0)
                                @foreach($user_file as $uf)
                                <tr>
                                    <td>{{$uf->id}}</td>
                                    <td>{{$uf->file_type}}</td>
                                    <td>{{$uf->file_date}}</td>
                                    <td><a class="btn btn-primary" href="{{env('APP_URL')}}public/uploads/{{$uf->file}}" target="_blank">View</a></td>
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
            </div>
            <div>

            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
<div class="modal fade" id="AssignAssets" tabindex="-1" aria-labelledby="assignLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header flex-column bg-white SubHeding border-0">
                <div class=" align-self-end pe-7s-close" data-dismiss="modal" aria-label="Close"></div>
                <h5 class="modal-title text-center fontBold m-auto" id="assignLabel">Assign Assets</h5>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <div class="d-flex flex-column ">
                        <label for="" class="samllText fontBold px-1">Type</label>
                        <input type="text" name="name" placeholder="Enter Type (laptop,mouce,phone etc,)">
                    </div>
                    <div class="d-flex flex-column ">
                        <label for="" class="samllText fontBold px-1">Name</label>
                        <input type="text" name="name" placeholder="Enter Name of Item">
                    </div>
                    <div class="d-flex flex-column ">
                        <label for="" class="samllText fontBold px-1">Specification</label>
                        <input type="text" name="name" placeholder="Enter The specification of Item">
                    </div>
                </div>
                <div class="modal-footer justify-content-center bg-white border-0">
                    <button type="submit" class="btn col-6 baseBtnBg align-self-end text-white">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="userBankDetail" tabindex="-1" aria-labelledby="userBankLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header flex-column bg-white SubHeding border-0">
                <div class=" align-self-end pe-7s-close" data-dismiss="modal" aria-label="Close"></div>
                <h5 class="modal-title text-center fontBold m-auto" id="userBankLabel">Bank Information</h5>
                <form action="{{env('APP_URL')}}adper/save_profile/{{$id}}" method="post" class="w-100">
                    @csrf
                    <div class="modal-body">
                        <div class="d-flex flex-column ">
                            <label for="" class="samllText fontBold px-1">Bank Name</label>
                            <input type="text" name="bank_name" value="{{$profile->bank_name}}">
                        </div>
                        <div class="d-flex flex-column ">
                            <label for="" class="samllText fontBold px-1">Account holder name</label>
                            <input type="text" name="bank_account_holder_name" value="{{$profile->bank_account_holder_name}}">
                        </div>
                        <div class="d-flex flex-column ">
                            <label for="" class="samllText fontBold px-1">Account Number</label>
                            <input type="number" name="account_no" value="{{$profile->account_no}}">
                        </div>
                        <div class="d-flex flex-column ">
                            <label for="" class="samllText fontBold px-1">IFSC Number</label>
                            <input type="text" name="ifsc_code" value="{{$profile->ifsc_code}}">
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
<div class="modal fade" id="userDoc" tabindex="-1" aria-labelledby="userDocLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header flex-column bg-white SubHeding border-0">
                <div class=" align-self-end pe-7s-close" data-dismiss="modal" aria-label="Close"></div>
                <h5 class="modal-title text-center fontBold m-auto" id="userDocLabel">Document Information</h5>

            </div>
            <form action="{{env('APP_URL')}}adper/save_profile/{{$id}}" method="post">
                @csrf
                <div class="modal-body">

                    <div class="d-flex flex-column ">
                        <label for="" class="samllText fontBold px-1">Addhar Number</label>
                        <input type="Number" name="adhar_no" value="{{$profile->adhar_no}}">
                    </div>
                    <div class="d-flex flex-column ">
                        <label for="" class="samllText fontBold px-1">Pan Number</label>
                        <input type="text" name="pan_no" value="{{$profile->pan_no}}">
                    </div>
                </div>
                <div class="modal-footer justify-content-center bg-white border-0">
                    <button type="submit" class="btn col-6 baseBtnBg align-self-end text-white">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="userinfo" tabindex="-1" aria-labelledby="userInfoLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header flex-column bg-white SubHeding border-0">
                <div class=" align-self-end pe-7s-close" data-dismiss="modal" aria-label="Close"></div>
                <h5 class="modal-title text-center fontBold m-auto" id="userInfoLabel">General Information</h5>
            </div>
            <form action="{{env('APP_URL')}}adper/save_profile/{{$id}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="">
                        <div class="row align-items-center mt-3">
                            <div class="d-flex flex-column col-6">
                                <label for="" class="samllText fontBold px-1">User ID</label>
                                <input type="text" name="user_id" value="{{$profile->user_id}}" class="form-control">
                            </div>
                            <div class="d-flex flex-column col-6">
                                <label for="" class="samllText fontBold px-1">Name</label>
                                <input type="text" name="name" value="{{$profile->name}}" class="form-control">
                            </div>
                        </div>
                        <div class="row align-items-center mt-3">
                            <div class="d-flex flex-column col-6">
                                <label for="" class="samllText fontBold px-1">Password</label>
                                <input type="text" name="Password" value="{{$profile->password}}" class="form-control">
                            </div>
                            <div class="d-flex flex-column col-6">
                                <label for="" class="samllText fontBold px-1">Email</label>
                                <input type="emial" name="email" value="{{$profile->email}}" class="form-control">
                            </div>
                        </div>
                        <div class="row align-items-center mt-3">
                            <div class="d-flex flex-column col-6">
                                <label for="" class="samllText fontBold px-1">Designation</label>
                                <input type="text" name="designation" value="{{$profile->designation}}" class="form-control">
                            </div>
                            <div class="d-flex flex-column col-6">
                                <label for="" class="samllText  fontBold px-1">Mobile</label>
                                <input type="number" name="mobile" value="{{$profile->mobile}}" class="form-control">
                            </div>
                        </div>
                        <div class="row align-items-center mt-3">
                            <div class="d-flex flex-column col-6">
                                <label for="" class="samllText fontBold px-1">Joining Date</label>
                                <input type="Date" name="joining_date" value="{{$profile->joining_date}}" class="form-control">
                            </div>
                            <div class="d-flex flex-column col-6">
                                <label for="" class="samllText fontBold px-1">Date Of Birth</label>
                                <input type="date" name="dob" value="{{$profile->dob}}" class="form-control">
                            </div>

                        </div>
                        <div class="row align-items-center mt-3">
                            <div class="d-flex flex-column col-6">
                                <label for="" class="samllText fontBold px-1">Salary</label>
                                <input type="number" name="salary" value="{{$profile->salary}}" class="form-control">
                            </div>
                            <div class="d-flex flex-column col-6">
                                <label for="" class="samllText fontBold px-1">Applied From</label>
                                <input type="month" name="applied_from" value="{{date('Y-m')}}" class="form-control">
                            </div>
                        </div>
                        <div class="row align-items-center mt-3">
                            <div class="d-flex flex-column col-6">
                                <label for="" class="samllText fontBold px-1">Team Type</label>
                                <input type="text" name="team_type" value="{{$profile->team_type}}" class="form-control">
                            </div>
                            <!--<div class="d-flex flex-column col-6">-->
                            <!--    <label for="" class="samllText fontBold px-1">Applied From</label>-->
                            <!--    <input type="month" name="applied_from" value="{{date('Y-m')}}" class="form-control">-->
                            <!--</div>-->
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
<div class="modal fade" id="userfile" tabindex="-1" aria-labelledby="userFileLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header flex-column bg-white SubHeding border-0">
                <div class=" align-self-end pe-7s-close" data-dismiss="modal" aria-label="Close"></div>
                <h5 class="modal-title text-center fontBold m-auto" id="userInfoLabel">Add new document</h5>
            </div>
            <form action="{{env('APP_URL')}}adper/save_user_file/{{$id}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="">
                        <div class="row align-items-center">
                            <div class="d-flex flex-column col-12">
                                <label for="" class="samllText fontBold px-1">User ID - {{$profile->name}}</label>
                                <input type="hidden" name="uid" value="{{$profile->id}}">
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="d-flex flex-column col-12">
                                <label for="" class="samllText fontBold px-1">File Type</label>
                                <select class="py-3" name="file_type">
                                    <option>Resume</option>
                                    <option>Offer Letter</option>
                                    <option>Appoinment Letter</option>
                                    <option>Appraisal Letter</option>
                                    <option>Increment Letter</option>
                                </select>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="d-flex flex-column col-6">
                                <label for="" class="samllText fontBold px-1">File</label>
                                <input type="file" name="file">
                            </div>
                            <div class="d-flex flex-column col-6">
                                <label for="" class="samllText fontBold px-1">Date</label>
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
@include('user.includes.footer')
<script>
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
</script>
<style>
    .pagination li a {
        position: relative;
        display: block;
        padding: .5rem .75rem;
        margin-left: -1px;
        line-height: 1.25;
        color: #007bff;
        background-color: #fff;
        border: 1px solid #dee2e6;
    }

    .pagination li.active a {
        z-index: 1;
        color: #fff;
        background-color: #007bff;
        border-color: #007bff;
    }
</style>