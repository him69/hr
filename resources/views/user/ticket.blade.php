<style>
    input {
        height: 30px;
        border-left: 0;
        background-color: white;
    }


    .br {
        border-radius: 5px;
        border: 1px solid #707070;
        overflow: hidden;
        padding: 4px;
        display: flex;
        align-items: center;
    }

    .inputicon {
        font-size: 20px;
        background: rgb(255, 255, 255);
        color: rgb(0, 0, 0);
        min-width: 30px;
        text-align: center;
        border-right: 1px solid #707070;
    }

    label {
        cursor: pointer;
    }

    .checkboxstyle input[type="checkbox"] {
        width: 20px;

    }

    .checkboxstyle label {
        margin-left: 10px;
        margin-bottom: 0;
        font-weight: 600;
    }

    .btncash {
        background-color: #006396 !important;
        color: white !important;
    }

    .btncash i {
        border-radius: 50% !important;
        padding: 5px !important;
        color: #006396 !important;
        background-color: white !important;
    }
</style>
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
        <div class="app-main__outer table-responsive">
            <div class="app-main__inner mb-5 container">
                <div class="col-12 col-lg-9 ms-auto d-flex justify-content-between mt-5">
                    <div class="ms-4">
                        <h4 class="text-center fontmed">Raise a Ticket</h4>
                        <p class="text-center fontmed smaTxt">Let us know what kind of problem you’re facing with, we
                            will help
                            out
                            to
                            <br> resolve the issue as
                            soon as possible.
                        </p>
                    </div>
                    <div class="d-flex">
                        <a href="{{env('APP_URL')}}reponses" class="m-auto"><button type="button" class="btn btncash   "><i class="fa-solid fa-ticket"></i>
                                Responses</button></a>
                    </div>
                </div>


                <div class="leaveForm baseShadow p-4  borderRadius " id="exTab1">
                    <form method="post">@csrf
                        <div class="row">
                            <div class="col-12  ">
                                <label for="" class="fontmed">
                                    <!--<i class="fa-regular fa-circle fa-2xs me-2"></i>-->
                                    Choose the
                                    Department<span class="text-danger">* (One ticket at a time)</span></label>

                                <div class="d-flex align-items-center checkboxstyle">
                                    <div class="col-2  d-flex align-items-center">
                                        <input type="radio" id="Gadget" name="department" value="Gadget" onchange="gadget(this.value)">
                                        <label for="Gadget">Gadget</label>
                                    </div>
                                    <div class="col-2  d-flex align-items-center">
                                        <input type="radio" id="Attendance" name="department" value="Attendance"  onchange="gadget(this.value)">
                                        <label for="Attendance">Attendance</label>
                                    </div>
                                    <div class="col-2  d-flex align-items-center">
                                        <input type="radio" id="Management" name="department" value="Management"  onchange="gadget(this.value)">
                                        <label for="Management">Management</label>
                                    </div>
                                    <div class="col-2  d-flex align-items-center">
                                        <input type="radio" id="Behaviour" name="department" value="Behaviour"  onchange="gadget(this.value)">
                                        <label for="Behaviour">Behaviour</label>
                                    </div>
                                    <div class="col-2  d-flex align-items-center">
                                        <input type="radio" id="Other" name="department" value="Other"  onchange="gadget(this.value)">
                                        <label for="Other">Other</label>
                                    </div>
                                </div>
                            </div>
                            <div id="gadgetdiv" class="col-6">
                                
                            </div>
                            <div class="col-12 my-4">
                                <label for="" class="fontmed">
                                    <!--<i class="fa-regular fa-circle fa-2xs me-2">-->
                                    </i>Description</label>
                                <br>
                                <textarea name="description" placeholder="Type your problem, no matter which language you use (Hindi, English, Hinglish)" id="" class="col-12 border rounded" rows="10"></textarea>
                            </div>
                            <div class="d-flex">
                                <button type="submit" class="btn btncash m-auto  "><i class="fa-solid fa-ticket"></i>
                                    Submit</button>
                            </div>
                        </div>
                    </form>
                    <!-- <div>
                        <p class="SubHeding text-center">Create Ticket</p>
                        <form method="post">@csrf
                            <div class="row">
                                <div class="d-flex flex-column col-6">
                                    <label for="" class="para">Subject</label>
                                    <input type="text" name="subject" id="" placeholder="Enter Subject">
                                </div>
                                <div class="d-flex flex-column col-6">
                                    <label for="" class="para">Select Department</label>
                                    <input list="department" name="department" id="depar"
                                      placeholder="select for department" >
                                    <datalist id="department">
                                        <option value="sales">
                                        <option value="IT">
                                        <option value="graphic">
                                        <option value="hr">
                                        <option value="crm">
                                        </datalist>
                                </div>
                                <div class="d-flex flex-column col-12">
                                    <label for="" class="para">Describe Problem</label>
                                    <textarea type="text" name="description" placeholder="For what reason your are taking leave"></textarea>
                                </div>
                                <div class="d-flex justify-content-end mt-3">
                                    <button type="submit" class="baseBtnBg border-0 para p-2 rounded text-white">
                                        Submit</button>
                                </div>
                            </div>
                        </form>
                    </div> -->
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
      function gadget(selectedValue) {
    let gadgetDiv = document.getElementById('gadgetdiv');
    gadgetDiv.innerHTML = ''; // Clear the content initially

    if (selectedValue === 'Gadget') {
        // Create and append elements only if 'Gadget' is selected
        let label = document.createElement('label');
        label.className = 'fontmed labelstyle mb-0 mt-3';
        label.setAttribute('for', '');
        label.innerHTML = 'Choose Assets<span class="text-danger">*</span>';

        let select = document.createElement('select');
        select.name = 'user_asset_id';
        select.className = 'border-0 w-100 bg-white p-1';
        select.innerHTML = '<option value="">select</option>';

        @foreach($ass as $as)
        select.innerHTML += '<option value="{{$as->id}}">{{$as->asset_name}}</option>';
        @endforeach

        let div = document.createElement('div');
        div.className = 'p-1 border border-black overflow-hidden d-flex align-items-center rounded-1';
        div.appendChild(select);

        gadgetDiv.appendChild(label);
        gadgetDiv.appendChild(div);
    }
}

    </script>