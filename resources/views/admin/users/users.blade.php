@include('admin.includes.header')
<style>
    select {
        border: none;
        height: 100%;
        width: 100%;
    }

    select:focus {
        border: none;
        outline: none;
    }

    .userinfocopy {
        font-size: 12px;
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

    /* ENABLE DISABLE BUTTONS */
    .button span {
        cursor: pointer;
        display: inline-block;
        position: relative;
        transition: 0.4s;
    }

    .button span:after {
        content: 'Me';
        position: absolute;
        opacity: 0;
        top: 0;
        right: -100%;
        transition: 0.7s;
    }

    .button:hover span {
        padding-right: 2em;
    }

    .button:hover span:after {
        opacity: 4;
        right: 0;
    }

    .tab-content>.active {
        display: inline-table !important;
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
        @include('admin.includes.sidebar')
        <div class="app-main__outer collapse table-responsive">
            <div class="app-main__inner ">

                <div class="overflow-hidden lReq baseShadow bg-white my-2 mx-auto">
                    <div class="nav row my-2  px-3 nav-tabs d-flex gx-0 m-0 border-0" id="nav-tab" role="tablist">
                        <div class="col">
                            <h5 class="fw-bold m-0 py-2">User Information</h5>
                        </div>
                        <button class="nav-link bg-transparent active text-center col-2 text-dark px-0 py-2 justify-content-center" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Active</button>
                        <button class="nav-link bg-transparent text-center col-2 text-dark border-0 px-0 py-2 justify-content-center" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Inactive</button>

                    </div>
                    <div class="tab-content px-3" id="nav-tabContent">
                        @if($errors->any())
                                <div class="alert alert-danger">
                                    {{ $errors->first('msg') }}
                                </div>
                            @endif
                        <table class="table table-bordered text-center tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            <tr>
                                <th>User Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                {{-- <th>Salary</th> --}}
                                <th>Server IP</th>
                                <th>User Type</th>
                                <th style="width: 120px;">Action</th>
                            </tr>
                            @foreach($users as $us)
                            <tr class="userinfocopy">
                                @csrf
                                <td class="text-start"><a href="{{env('APP_URL')}}admin/attendance/full_report/{{$us->id}}" class=" text-decoration-none @if($us->lead == 1) text-warning @else cttext @endif">{{$us->user_id}}</a> </td>
                                <td>{{$us->name}}</td>
                                <td class="email">{{$us->email}}</td>
                                <td class="mobile">{{$us->mobile}}</td>
                                {{-- <td class="salary">{{$us->salary}}</td> --}}
                                <td>{{$us->server_ip ? $us->server_ip : 'NA'}}</td>
                                <td>{{$us->d_name}}</td>
                                <td>
                                    <div class="d-flex justify-content-center align-items-center">
                                        <button class="button overflow-hidden btn btn-secondary" data-bs-toggle="modal" data-bs-target="#userDE" onclick="saveRow({{$us->id}},{{$us->status}} )" style="vertical-align:middle"><span>Disable</span></button>
                                        <!-- <div class="form-switch">
                              <input class="form-check-input" type="checkbox" role="switch" style="position: inherit;" onchange="saveRow(this,{{$us->id}})" @if($us->status == 1) checked @endif>
                              </div> -->
                                        <div style="display:flex;" id="work_type">
                                            @if($us->work_type ==1 || $us->work_type==2)
                                            @else
                                            <div class=" arrPoin mx-2" id="inoffice" onclick="worktype('inoffice',{{$us->id}})"><i class="fa-solid fa-building-circle-check cttext"></i></div>
                                            <div class="arrPoin" id="workfromhome" onclick="worktype('workfromhome',{{$us->id}})"><i class="fa-solid text-warning fa-house-laptop"></i></div>

                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                        <table class="table table-bordered text-center tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <tr>
                                <th>User Id</th>
                                <th>Name</th>
                                <th>Mobile</th>
                                <th>Salary</th>
                                <th>Reason</th>
                                <th>User Type</th>
                                <th style="width: 120px;">Action</th>
                            </tr>
                            @foreach($users_d as $us)
                            <tr class="userinfocopy">
                                @csrf
                                <td><a href="{{env('APP_URL')}}admin/attendance/full_report/{{$us->id}}">{{$us->user_id}}</a> </td>
                                <td>{{$us->name}}</td>
                                <td class="mobile">{{$us->mobile}}</td>
                                <td class="salary">{{$us->salary}}</td>
                                <td class="salary">{{$us->reason ? $us->reason :'No Reason Given'}}</td>
                                <td class="salary">{{$us->d_name}}</td>
                                <td>
                                    <div class="d-flex justify-content-center align-items-center">
                                        <button class="button overflow-hidden btn baseBtnBg" data-bs-toggle="modal" data-bs-target="#userDE" onclick="saveRow({{$us->id}},{{$us->status}} )" style="vertical-align:middle"><span>Enable</span></button>
                                    </div>
                                    </div>
                                    </td>
                                    </tr>
                                    @endforeach
                            </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
<div class="modal fade" id="userDE" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">User Status Change</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{env('APP_URL')}}admin/userstatus" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="">
                        <div class="row align-items-center">
                            <div class="d-flex flex-column col-12">
                                <input type="hidden" id="userState" name="id" value="">
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="d-flex flex-column col-12 my-2">
                                <label for="" class="samllText fw-bold px-1">Reason </label>
                                <select class="py-2 border-dark border rounded" name="reason">
                                    <option>Select reason</option>
                                    <option>Terminated</option>
                                    <option>Resigned</option>
                                    <option>Absconded</option>
                                    <option>Join Back</option>
                                    <option>others</option>
                                </select>
                            </div>
                            <div class="col-6 my-2">
                                <p class="samllText fw-bold">STATUS</p>
                                <div>

                                    <input type="radio" name="status" value="1" id="checkbox_e">
                                    <label for="checkbox_e" class="">enable</label>

                                    <input type="radio" name="status" value="0" id="checkbox_d">
                                    <label for="checkbox_d" class="">disable</label>
                                </div>

                            </div>
                            <div class="col-6 my-2">
                                <p class="samllText fw-bold">Mark Blacklist</p>
                                <div>
                                    <label for="" class="">Blacklist User</label>
                                    <input type="checkbox" name="blacklist" value="1" id="">
                                </div>

                            </div>
                            <div class="col-12 mt-2 align-items-center">
                                <button type="submit" class="btn col-12 baseBtnBg align-self-end text-white">Update</button>
                            </div>
                        </div>

                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
`    @include('admin.includes.footer')`
<script>
    function saveRow(id, status) {
        document.getElementById('userState').value = id;

        document.getElementById('checkbox_e').checked = false;
        document.getElementById('checkbox_d').checked = false;
        if (status === 1) {
            document.getElementById('checkbox_d').checked = true;
        } else if (status === 0) {
            document.getElementById('checkbox_e').checked = true;
        }
    }

    function worktype(a, id) {
        let workTypeValue = a == 'inoffice' ? 1 : 2;

        $.get('{{env('APP_URL')}}admin/worktype?id=' + id + '&worktype=' + workTypeValue,
            function(data, status) {
                console.log(`Data: ${data}\nStatus: ${status}`);

                if (status === 'success') {
                    $('#work_type').css('display', 'none');
                }
            });
    }

    // function copyname() {
    // let customerInfo = '';
    //     document.querySelectorAll('.userinfocopy').forEach(row => {
    //     let valueElement = row.querySelector('.name');
    //     let cv = $(valueElement).children('span');
    //     let value = valueElement ? valueElement.textContent.trim() : '';
    //     customerInfo += '' + '' + value + '\n';
    // });
    //     let textarea = document.createElement('textarea');
    //     textarea.value = customerInfo;
    //     document.body.appendChild(textarea);
    //     textarea.select();
    //     document.execCommand('copy');
    //     document.body.removeChild(textarea);
    // }
</script>