@include('user.includes.header')
<style>
    canvas {
        border: 1px black solid;
    }

    #textCanvas {
        display: none;
    }

    .fixed-header .app-header {
        position: fixed;
        /* width: calc(100% - 100px); */
        top: 0;
        margin-left: 0;
        background: #f1f4f6;
        width: 100%;
    }
</style>
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
    <div class=" container mt-5 pt-3">
        <style>
            .btncash {
                background-color: #4c4b46;
                color: white;
            }

            .btncash:hover {
                border: 2px solid #4c4b46 !important;
            }

            .btncash i {
                border-radius: 50%;
                padding: 5px;
                color: #4c4b46;
                background-color: white;
            }

            .detailsfont {
                font-size: 16px;
                font-weight: 700;
            }
        </style>
        <div class="row">
            @if (session('error'))
                <div class="alert alert-danger" id="error-alert">
                    {{ session('error') }}
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success" id="success-alert">
                    {{ session('success') }}
                </div>
            @endif
            <div class="col-12 col-lg-7 ms-auto d-flex justify-content-between my-5 mb-2">
                <h3 style="font-weight: 700;">My Profile</h3>
                <a href="{{ env('APP_URL') }}profile/edit">
                    <button type="button" class="btn btncash "><i class="fa-solid fa-user-pen"></i> Edit
                        Profile</button></a>
                <button type="button" class="btn cttext " data-toggle="modal" data-target="#exampleModall"><i
                        class="fa-solid fa-lock mx-1"></i>Change Password</button>
            </div>
            <div class="col-12 col-lg-6 ">
                <div class="p-3 baseShadow borderRadius  w-100 h-100 d-flex flex-column justify-content-center">
                    <p class="h4 fw-bold">General Information</p>
                    <p class="smText vsmatxt">You can edit your information multiple times, but make sure you’re
                        providing true
                        information of yours
                    </p>
                    <hr>
                    <div class="d-flex justify-content-around">
                        <div class="align-self-center">
                            <div class="rounded-circle m-auto border border-2 border-dark overflow-hidden"
                                style="height: 100px; min-width:100px;">
                                @if ($user->photo)
                                    <img src="{{ env('APP_URL') }}public/uploads/{{ $user->photo }}" alt=""
                                        style="height:100px; width:100px; object-fit:cover;">
                                @else
                                    <img src="{{ env('APP_URL') }}public/assets/images/user.svg" alt=""
                                        style="height:100%; width:100%; object-fit:cover ;">
                                @endif
                            </div>
                        </div>
                        <div style="width: 3px;background: black;">
                        </div>
                        <div class="">
                            <table class="table mb-0">
                                <tr>
                                    <th class="d-flex justify-content-between border-0 smaTxt ">
                                        <div><span class="smaTxt m-0 fontmed">Full
                                                Name</span> </div> <span>:</span>
                                    </th>
                                    <td class="border-0 smaTxt ">{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <th class="d-flex justify-content-between border-0 smaTxt ">
                                        <div><span class="smaTxt m-0 fontmed"> Ph.
                                                Number</span> </div> <span>:</span>
                                    </th>
                                    <td class="border-0 smaTxt ">{{ $user->mobile }}</td>
                                </tr>
                                <tr>
                                    <th class="d-flex justify-content-between border-0 smaTxt ">
                                        <div><span class="smaTxt m-0 fontmed"> Email
                                                ID</span> </div> <span>:</span>
                                    </th>
                                    <td class="border-0 smaTxt ">{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <th class="d-flex justify-content-between border-0 smaTxt ">
                                        <div><span class="smaTxt m-0 fontmed">Date of Birth</span> </div> <span>:</span>
                                    </th>
                                    <td class="border-0 smaTxt ">{{ $user->dob }}</td>
                                </tr>
                                <tr>
                                    <th class="d-flex justify-content-between border-0 smaTxt ">
                                        <div><span class="smaTxt m-0 fontmed">Gender</span> </i> </div><span>:</span>
                                    </th>
                                    <td class="border-0 smaTxt ">{{ $user->gender ? $user->gender : 'NA' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-12">
                <div class="p-3 baseShadow borderRadius  w-100 h-100 d-flex flex-column justify-content-center">
                    <p class="h4 fw-bold">Bank account details</p>
                    <p class="smText vsmatxt">Make sure to provide correct information, In case of wrong information
                        company will
                        not be responsible
                        for <span class="cttext fontmed">salary delays</span> or <span class="cttext fontmed">misplace
                            of your
                            salary.</span> </p>
                    <hr>
                    <div class="row">
                        <div class="col-12">
                            <table class="table mb-0">
                                <tr>
                                    <th class="d-flex  border-0 smaTxt  justify-content-between ">
                                        <div><span class="smaTxt m-0 fontmed">Bank
                                                Name</span> </div><span>:</span>
                                    </th>
                                    <td class="border-0 smaTxt ">{{ $user->bank_name }}</td>
                                </tr>
                                <tr>
                                    <th class="d-flex border-0 smaTxt   justify-content-between ">
                                        <div><span class="smaTxt m-0 fontmed">Account
                                                Number</span> </div><span>:</span>
                                    </th>
                                    <td class="border-0 smaTxt ">{{ $user->account_no }}</td>
                                </tr>
                                <tr>
                                    <th class="d-flex  border-0 smaTxt  justify-content-between ">
                                        <div><span class="smaTxt m-0 fontmed">Account holder
                                                name</span> </div><span>:</span>
                                    </th>
                                    <td class="border-0 smaTxt ">{{ $user->bank_account_holder_name }}</td>
                                </tr>
                                <tr>
                                    <th class="d-flex  border-0 smaTxt  justify-content-between ">
                                        <div><span class="smaTxt m-0 fontmed">IFSC
                                                Code</span> </div><span>:</span>
                                    </th>
                                    <td class="border-0 smaTxt ">{{ $user->ifsc_code }}</td>
                                </tr>
                            </table>
                            <div class="d-flex">
                                <button type="button" class="btn btncash m-auto" onclick="getsalary(this)"><i
                                        class="fa-solid fa-money-bill-1-wave "></i> View
                                    Salary</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-12 mt-5">
                <div class="p-3 baseShadow borderRadius  w-100 h-100 d-flex flex-column justify-content-center">
                    <p class="h4 fw-bold">KYC & Personal Documents</p>
                    <p class="smText vsmatxt">Don’t worry your every documents are safe with us
                        <!--you can ask to delete-->
                        <!--  documentation after you leave-->
                        <!--  the company-->
                    </p>
                    <hr>
                    <div class="row">
                        <div class="col-12">
                            <div class="table mb-0">
                                @if ($document->isEmpty())
                                    <div class="text-center">
                                        <a class="text-center" href="{{ env('APP_URL') }}profile/documentUpload">Click
                                            here<span class="text-black">,to add documents </span></a>
                                    </div>
                                @else
                                    <div class="row border-0 px-2">
                                        @foreach ($document as $user_doc)
                                            <div class="col-6 row mx-0 ">
                                                <div
                                                    class="d-flex justify-content-between smaTxt m-0 fontmed col-6 para fw-bold border-0">
                                                   <p style="display: list-item">
                                                    {{ $user_doc->document_name }}</p> 
                                                    <span>:</span>
                                                </div>
                                                <p class="d-flex justify-content-between smaTxt col-6 para  border-0">
                                                    {{ $user_doc->document_value }}
                                                    @if ($user_doc->doc_verify == 0)
                                                        <span class="text-warning">Pending</span>
                                                    @elseif($user_doc->doc_verify == 1)
                                                        <span class="text-success">
                                                            Verified</span>
                                                    @elseif($user_doc->doc_verify == 2)
                                                        <span href="{{ env('APP_URL') }}profile/documentUpload"
                                                            class="text-danger">
                                                            Upload again</span>
                                                    @endif
                                                </p>
                                            </div>
                                        @endforeach
                                    </div>
                              </div>
                             @endif
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6  mt-5 ">
            <div class="p-3 baseShadow borderRadius  w-100 h-100 d-flex flex-column justify-content-center">
                <p class="h4 fw-bold">Official Info</p>
                <p class="smText vsmatxt">Make sure to provide correct information</p>
                <hr>
                <div class="row">
                    <div class="col-12">
                        <table class="table mb-0">
                            <tr>
                                <th class="d-flex justify-content-between border-0 smaTxt ">
                                    <div><span class="smaTxt m-0 fontmed">Date of Joining</span> </i> </div>
                                    <span>:</span>
                                </th>
                                <td class="border-0 smaTxt ">
                                    {{ $user->joining_date ? $user->joining_date : 'NA' }}</td>
                            </tr>
                            <tr>
                                <th class="d-flex  border-0 smaTxt  justify-content-between ">
                                    <div><span class="smaTxt m-0 fontmed">Assest</span>
                                    </div><span>:</span>
                                </th>
                                <td class="border-0 smaTxt ">
                                    <span class="cttext detail" data-toggle="modal" data-target="#assetsinfo">See
                                        Detail</span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-12  mt-5 ">
            <div class="p-3 baseShadow borderRadius  w-100 h-100 d-flex flex-column justify-content-center">
                <p class="h4 fw-bold">Other Info</p>
                <p class="smText vsmatxt">Make sure to provide correct information</p>
                <hr>
                <div class="row">
                    <div class="col-12">
                        <table class="table mb-0">
                            <tr>
                                <th class="d-flex  border-0 smaTxt  justify-content-between ">
                                    <div><span class="smaTxt m-0 fontmed"></span>Current Address</div>
                                    <span>:</span>
                                </th>
                                <td class="border-0 smaTxt ">{{ $user->curnt_adrs }}</td>
                                <th class="d-flex border-0 smaTxt   justify-content-between ">
                                    <div><span class="smaTxt m-0 fontmed">Permanent
                                            Address</span> </div><span>:</span>
                                </th>
                                <td class="border-0 smaTxt ">{{ $user->prmt_adrs }}</td>
                            </tr>
                            <tr>
                                <th class="d-flex  border-0 smaTxt  justify-content-between ">
                                    <div><span class="smaTxt m-0 fontmed">Department</span> </div><span>:</span>
                                </th>
                                <td class="border-0 smaTxt ">{{ $user->d_name ? $user->d_name : 'NA' }}</td>
                                <th class="d-flex  border-0 smaTxt  justify-content-between ">
                                    <div><span class="smaTxt m-0 fontmed">Position</span> </div><span>:</span>
                                </th>
                                <td class="border-0 smaTxt ">{{ $user->designation }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--<div class="col-12 col-lg-6  mt-5 ">-->
        <!--  <div-->
        <!--    class="p-3 baseShadow borderRadius  w-100 h-100 d-flex flex-column align-items-center justify-content-center">-->
        <!--    <h1>Profile Completed: <span class="text-success">100%</span></h1>-->
        <!--    <a href="{{ env('APP_URL') }}profile/edit">-->
        <!--      <button type="button" class="btn btncash"><i class="fa-solid fa-user-pen"></i> Edit Profile</button></a>-->
        <!--  </div>-->
        <!--</div>-->
    </div>

</div>
</div>
</div>
<!-- addhra card modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog p-0 ">
        <div class="modal-content">
            <div class="modal-header justify-content-center">
                <h2 class="modal-title" id="exampleModalLabel" style="font-size: 25px;">your Aadhaar Card
                </h2>
            </div>
            <div class="modal-body mycontainer">
                <div class="row">
                    <div class="col-12 ">
                        <div class="row border rounded p-2 border-1 border-secondary my-3">
                            <p class="text-center smaTxt my-2"><b>your front Aadhaar</b></p>
                            <div class="col-12 d-flex justify-content-center align-items-center">
                                <img src="{{ env('APP_URL') }}/public/uploads/{{ $user->aadhar_card }}"
                                    style="width: 276p;height: 163px;" id="prvei">
                            </div>
                        </div>
                        <div class="row border rounded p-2 border-1 border-secondary my-3">
                            <p class="text-center smaTxt my-2"><b> your back Aadhaar</b></p>
                            <div class="col-12 d-flex justify-content-center align-items-center">
                                <img src="{{ env('APP_URL') }}/public/uploads/{{ $user->aadhar_card_back }}"
                                    style="width: 276p;height: 163px;" id="ubip">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- pan modal -->
<div class="modal fade" id="panmodal" tabindex="-1" aria-labelledby="panModalLabel" aria-hidden="true">
    <div class="modal-dialog p-0 ">
        <div class="modal-content">
            <div class="modal-header justify-content-center">
                <h2 class="modal-title" id="panModalLabel" style="font-size: 25px;">Upload Pan Card</h2>
            </div>
            <div class="modal-body mycontainer">
                <div class="row">
                    <div class="col-12 ">
                        <div class="row border rounded p-2 border-1 border-secondary my-3">
                            <p class="text-center smaTxt my-2"><b>Preview of your front Aadhaar</b></p>
                            <div class="col-12 d-flex justify-content-center align-items-center">
                                <img src="{{ $user->pan_card ? env('APP_URL') . 'public/uploads/' . $user->pan_card : env('APP_URL' . 'icon/pan.png') }}"
                                    style="width: 276p;height: 163px;" id="prveiw">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- assets assign -->
<div class="modal fade" id="assetsinfo" tabindex="-1" data-backdrop="static" aria-labelledby="assetsModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header flex-column bg-white SubHeding border-0 smaTxt ">
                <div class=" align-self-end pe-7s-close fs-2 cursor-pointer" data-dismiss="modal" aria-label="Close">
                </div>
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
                                                <div onclick="approveLeave(1)" style="cursor: pointer;">
                                                    <i class="bi bi-check text-success SubHeding"></i>
                                                </div>
                                                <div onclick="rejectLeave(1)" style="cursor: pointer;">
                                                    <i class="bi bi-x SubHeding text-danger"></i>
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
<!-- passchange -->

<div class="modal fade" id="exampleModall" tabindex="-1" aria-labelledby="exampleModalLabell" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-body p-4">
                <h5 class="pb-2 text-center">Change password </h5>
                <form action="{{ env('APP_URL') }}update_password" method="post">
                    @csrf
                    <div class="row align-items-center px-5">
                        <div class="d-flex flex-column col-12 my-2">
                            <label for="" class="samllText fw-bold px-1">Old Password</label>
                            <div
                                class="d-flex border-secondary rounded border w-100 overflow-hidden align-items-center">
                                <input class="py-2 px-2 border-0 w-100" type="password" name="password"
                                    placeholder="Enter Old Password" id="oldpass">
                                <i class="fa-regular fa-eye mx-2 text-muted" onclick="showpass('old',this)"></i>
                            </div>
                        </div>
                        <div class="d-flex flex-column col-12 my-2">
                            <label for="" class="samllText fw-bold px-1">New Password</label>
                            <div
                                class="d-flex border-secondary rounded border w-100 overflow-hidden align-items-center">
                                <input class="py-2 px-2 border-0 w-100" type="password" name="Npassword"
                                    placeholder="Enter New Password" id="newpass">
                                <i class="fa-regular fa-eye mx-2 text-muted" onclick="showpass('new',this)"></i>
                            </div>
                        </div>
                        <p class="smText vsmatxt mt-2 text-center">if you forget your old password then contact to hr
                        </p>
                        <div class="col-12 my-2">
                            <button type="submit"
                                class="btn col-12 baseBtnBg align-self-end text-white">Update</button>
                        </div>
                    </div>
                </form>

            </div>


        </div>
    </div>
</div>



<script>
    var pass = "{{ base64_encode($user->password . csrf_token()) }}";
</script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>

<script>
    function showpass(a, iconElement) {
        let inputField;
        if (a === 'old') {
            inputField = document.getElementById('oldpass');
        } else if (a === 'new') {
            inputField = document.getElementById('newpass');
        }

        if (inputField) {
            inputField.type = inputField.type === 'password' ? 'text' : 'password';
            if (inputField.type === 'text') {
                iconElement.classList.remove('fa-eye');
                iconElement.classList.remove('text-muted');
                iconElement.classList.add('fa-eye-slash');
                iconElement.classList.add('text-dark');
            } else {
                iconElement.classList.remove('fa-eye-slash');
                iconElement.classList.add('fa-eye');
                iconElement.classList.add('text-muted');
                iconElement.classList.remove('text-dark');
            }
        }
    }

    function getsalary(e) {
        let a = prompt('Please Enter Password');
        a = btoa(a + '{{ csrf_token() }}');
        if (pass == a) {
            $(e).html('{{ $user->salary }}/-');
        }
    }

    var tCtx = document.getElementById('textCanvas').getContext('2d'),
        imageElem = document.getElementById('image');

    // Increase resolution for better clarity
    var scale = 15; // adjust this based on how much quality you want
    tCtx.canvas.width = tCtx.measureText('{{ substr($user->name, 0, 2) }}').width * scale;
    tCtx.canvas.height = 8.3 * scale; // adjust this as per text height needs

    tCtx.scale(scale, scale);

    // ClearType enhancement
    tCtx.textBaseline = "top";
    tCtx.fillStyle = "black"; // specify text color
    tCtx.font = "10px Arial"; // specify font size and family

    tCtx.fillText('{{ $user->name }}', 0, 0);
    imageElem.src = tCtx.canvas.toDataURL();
</script>
