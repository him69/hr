@include('admin.includes.header')
<style>
    th {
        width: 95px;
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
                <div class="borderRadius overflow-hidden baseShadow bg-white my-2 mx-auto px-3 py-3"
                    style="width: 98%; ">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">

                                <div class="row justify-content-around">
                                    <div class="col-1 p-2 m-1 rounded text-center text-white  tab" data-table-id="table1"
                                        style=" background-color: #FFB02E;">Offer Letter</div>
                                    <div class="col-2 p-2 m-1 rounded text-center text-white tab" data-table-id="table2"
                                        style="background-color: #8f8e8eb7;">Appointment Letter</div>
                                        <div class="col-2 p-2 m-1 rounded text-center text-white tab" data-table-id="table6"
                                        style="background-color: #8f8e8eb7;">Confirmation Letter</div>
                                    <div class="col-2 p-2 m-1 rounded text-center text-white tab" data-table-id="table3"
                                        style="background-color: #8f8e8eb7;">Increment Letter</div>
                                    <div class="col-2 p-2 m-1 rounded text-center text-white tab" data-table-id="table4"
                                        style="background-color: #8f8e8eb7;">Appraisal Letter</div>
                                    <div class="col-2 p-2 m-1 rounded text-center text-white tab" data-table-id="table5"
                                        style="background-color: #8f8e8eb7;">Relieving & Experience</div>
                                </div>
                                <div>
                                    <div class="table" id="table1" style="display: block;">
                                        <div class=" align-items-center my-2">
                                            <p class="SubHeding m-0 text-center">Offer Letter</p>
                                        </div>
                                        <form action="{{env('APP_URL')}}admin/offer">
                                            <div class="row">
                                                <div class="col-6">
                                                    <label class="fontmed" for="">Title<span
                                                            class="text-danger">*</span></label>
                                                    <div
                                                        class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                                        <i class="fa-solid fa-user inputicon"></i>
                                                        <input type="text" name="title" placeholder="Mr./Ms."
                                                            class="border-0 w-100 bg-white p-1">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="fontmed" for="">Enter Full Name<span
                                                            class="text-danger">*</span></label>
                                                    <div
                                                        class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                                        <i class="fa-solid fa-user inputicon"></i>
                                                        <input type="text" name="fname" required placeholder="Enter First Name"
                                                            class="border-0 w-100 bg-white p-1">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="fontmed" for="">Last Name<span
                                                            class="text-danger">*</span></label>
                                                    <div
                                                        class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                                        <i class="fa-solid fa-user inputicon"></i>
                                                        <input type="text" name="lname" placeholder="Enter Last Name"
                                                            class="border-0 w-100 bg-white p-1">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="fontmed" for="">Position<span
                                                            class="text-danger">*</span></label>
                                                    <div
                                                        class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                                        <i class="fa-solid fa-user inputicon"></i>
                                                        <input type="text" name="position" required
                                                            placeholder="Enter Candidate Position"
                                                            class="border-0 w-100 bg-white p-1">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <label class="fontmed" for="">Address<span
                                                            class="text-danger">*</span></label>
                                                    <div
                                                        class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                                        <i class="fa-solid fa-map-pin inputicon"></i>
                                                        <textarea type="text" name="address"
                                                            placeholder="Enter Candidate Position"
                                                            class="border-0 w-100 bg-white p-1" rows="1"></textarea>
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <label class="fontmed" for="">Salary<span
                                                            class="text-danger">*</span></label>
                                                    <div
                                                        class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                                        <i class="fa-solid fa-money-bill-1-wave  inputicon"></i>
                                                        <input type="number" name="salary"
                                                            placeholder="Enter Candidate Salary"
                                                            class="border-0 w-100 bg-white p-1">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="fontmed" for="">Date<span
                                                            class="text-danger">*</span></label>
                                                    <div
                                                        class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                                        <i class="fa-solid fa-calendar-days inputicon"></i>
                                                        <input type="date" name="date" value="<?php echo date('Y-m-d'); ?>" placeholder="Enter Date"
                                                            class="border-0 w-100 bg-white p-1">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="fontmed" for="">Joining Date<span
                                                            class="text-danger">*</span></label>
                                                    <div
                                                        class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                                        <i class="fa-solid fa-user inputicon"></i>
                                                        <input type="date" name="jdate" required placeholder="Enter Joining Date"
                                                            class="border-0 w-100 bg-white p-1">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="fontmed" for="">Email<span
                                                            class="text-danger">*</span></label>
                                                    <div
                                                        class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                                        <i class="fa-solid fa-envelope  inputicon"></i>
                                                        <input type="email" name="email"
                                                            placeholder="Enter Candidate Email"
                                                            class="border-0 w-100 bg-white p-1">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="fontmed" for="">Sign<span
                                                            class="text-danger">*</span></label>
                                                    <div
                                                        class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                                        <i class="fa-solid fa-signature  inputicon"></i>
                                                        <input type="text" name="sign" placeholder="Sign"
                                                            class="border-0 w-100 bg-white p-1">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="fontmed" for="">PF<span
                                                            class="text-danger">*</span></label>
                                                    <div
                                                        class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                                        <i class="fa-solid fa-user inputicon"></i>
                                                        <select name="pf" class="border-0 w-100 bg-white p-1">
                                                            <option value="1">Yes</option>
                                                            <option value="0">No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="fontmed" for="">Sign designation<span
                                                            class="text-danger">*</span></label>
                                                    <div
                                                        class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                                        <i class="fa-solid fa-signature   inputicon"></i>
                                                        <input type="text" name="sign_deg"
                                                            placeholder="Sign designation"
                                                            class="border-0 w-100 bg-white p-1">
                                                    </div>
                                                </div>
                                                <div class="col-6 d-flex align-self-end  mt-3"><button
                                                        class="p-2 px-4 baseBtnBg border-0 rounded mx-2 text-white">
                                                        Create
                                                    </button></div>
                                            </div>
                                        </form>
                                    </div> 
                                    <div class="table" id="table2" style="display: none;">
                                        <div class=" align-items-center my-2">
                                            <p class="SubHeding m-0 text-center">Appointment Letter</p>
                                        </div>
                                        <form action="{{env('APP_URL')}}admin/appoint">
                                            <div class="row">
                                                <div class="col-6">
                                                    <label class="fontmed" for="">Title<span
                                                            class="text-danger">*</span></label>
                                                    <div
                                                        class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                                        <i class="fa-solid fa-user inputicon"></i>
                                                        <input type="text" name="title" placeholder="Mr./Ms."
                                                            class="border-0 w-100 bg-white p-1">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="fontmed" for="">First Name<span
                                                            class="text-danger">*</span></label>
                                                    <div
                                                        class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                                        <i class="fa-solid fa-user inputicon"></i>
                                                        <input type="text" name="fname" required placeholder="Enter First Name"
                                                            class="border-0 w-100 bg-white p-1">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="fontmed" for="">Last Name<span
                                                            class="text-danger">*</span></label>
                                                    <div
                                                        class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                                        <i class="fa-solid fa-user inputicon"></i>
                                                        <input type="text" name="lname" placeholder="Enter Last Name"
                                                            class="border-0 w-100 bg-white p-1">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="fontmed" for="">Position<span
                                                            class="text-danger">*</span></label>
                                                    <div
                                                        class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                                        <i class="fa-solid fa-user inputicon"></i>
                                                        <input type="text" name="position" required
                                                            placeholder="Enter Candidate Position"
                                                            class="border-0 w-100 bg-white p-1">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="fontmed" for="">Department<span
                                                            class="text-danger">*</span></label>
                                                    <div
                                                        class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                                        <i class="fa-solid fa-building  inputicon"></i>
                                                        <input type="text" name="department" required
                                                            placeholder="Enter Candidate Department"
                                                            class="border-0 w-100 bg-white p-1">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="fontmed" for="">Salary<span
                                                            class="text-danger">*</span></label>
                                                    <div
                                                        class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                                        <i class="fa-solid fa-money-bill-1-wave  inputicon"></i>
                                                        <input type="number" name="salary"
                                                            placeholder="Enter Candidate Salary"
                                                            class="border-0 w-100 bg-white p-1">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <label class="fontmed" for="">Address<span
                                                            class="text-danger">*</span></label>
                                                    <div
                                                        class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                                        <i class="fa-solid fa-map-pin inputicon"></i>
                                                        <textarea type="text" name="address"
                                                            placeholder="Enter Candidate Position"
                                                            class="border-0 w-100 bg-white p-1" rows="1"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="fontmed" for="">City<span
                                                            class="text-danger">*</span></label>
                                                    <div
                                                        class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                                        <i class="fa-solid fa-city inputicon"></i>
                                                        <input type="text" name="city"
                                                            placeholder="Enter Candidate City"
                                                            class="border-0 w-100 bg-white p-1">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="fontmed" for="">State<span
                                                            class="text-danger">*</span></label>
                                                    <div
                                                        class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                                        <i class="fa-solid fa-city inputicon"></i>
                                                        <input type="text" name="state"
                                                            placeholder="Enter Candidate State"
                                                            class="border-0 w-100 bg-white p-1">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="fontmed" for="">PIN Code<span
                                                            class="text-danger">*</span></label>
                                                    <div
                                                        class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                                        <i class="fa-solid fa-user inputicon"></i>
                                                        <input type="text" name="pin"
                                                            placeholder="Enter Candidate PIN Code"
                                                            class="border-0 w-100 bg-white p-1">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="fontmed" for="">Joining Date<span
                                                            class="text-danger">*</span></label>
                                                    <div
                                                        class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                                        <i class="fa-solid fa-calendar-days inputicon"></i>
                                                        <input type="date" name="jdate" required placeholder="Enter Joining Date"
                                                            class="border-0 w-100 bg-white p-1">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="fontmed" for="">Posting Place<span
                                                            class="text-danger">*</span></label>
                                                    <div
                                                        class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                                        <i class="fa-solid fa-city inputicon"></i>
                                                        <input type="text" name="place"
                                                            placeholder="Enter Posting State,city"
                                                            class="border-0 w-100 bg-white p-1">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="fontmed" for="">Date<span
                                                            class="text-danger">*</span></label>
                                                    <div
                                                        class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                                        <i class="fa-solid fa-calendar-days inputicon"></i>
                                                        <input type="date" name="date" value="<?php echo date('Y-m-d'); ?>" placeholder="Enter Date"
                                                            class="border-0 w-100 bg-white p-1">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="fontmed" for="">Email<span
                                                            class="text-danger">*</span></label>
                                                    <div
                                                        class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                                        <i class="fa-solid fa-envelope  inputicon"></i>
                                                        <input type="email" name="email"
                                                            placeholder="Enter Candidate Email"
                                                            class="border-0 w-100 bg-white p-1">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="fontmed" for="">Sign<span
                                                            class="text-danger">*</span></label>
                                                    <div
                                                        class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                                        <i class="fa-solid fa-signature  inputicon"></i>
                                                        <input type="text" name="sign" placeholder="Sign"
                                                            class="border-0 w-100 bg-white p-1">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="fontmed" for="">PF<span
                                                            class="text-danger">*</span></label>
                                                    <div
                                                        class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                                        <i class="fa-solid fa-user inputicon"></i>
                                                        <select name="pf" class="border-0 w-100 bg-white p-1">
                                                            <option value="1">Yes</option>
                                                            <option value="0">No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="fontmed" for="">Sign designation<span
                                                            class="text-danger">*</span></label>
                                                    <div
                                                        class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                                        <i class="fa-solid fa-signature   inputicon"></i>
                                                        <input type="text" name="sign_deg"
                                                            placeholder="Sign designation"
                                                            class="border-0 w-100 bg-white p-1">
                                                    </div>
                                                </div>
                                                <div class="col-6 d-flex align-self-end  mt-3"><button
                                                        class="p-2 px-4 baseBtnBg border-0 rounded mx-2 text-white">
                                                        Create
                                                    </button></div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="table" id="table3" style="display: none;">
                                        <div class=" align-items-center my-2">
                                            <p class="SubHeding m-0 text-center">Increment Letter</p>
                                        </div>
                                        <form action="{{env('APP_URL')}}admin/increment">
                                            <div class="row">
                                                <div class="col-6">
                                                    <label class="fontmed labelstyle" for="">Title<span
                                                            class="text-danger">*</span></label>
                                                    <div
                                                        class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                                                        <i class="fa-solid fa-user inputicon"></i>
                                                        <input type="text" name="title" placeholder="Mr./Ms."
                                                            class="border-0 w-100 bg-white p-1 text-capitalize">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="fontmed labelstyle" for="">First Name<span
                                                            class="text-danger">*</span></label>
                                                    <div
                                                        class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                                                        <i class="fa-solid fa-user inputicon"></i>
                                                        <input type="text" name="fname" required placeholder="Enter First Name"
                                                            class="border-0 w-100 bg-white p-1 text-capitalize">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="fontmed labelstyle" for="">Last Name<span
                                                            class="text-danger">*</span></label>
                                                    <div
                                                        class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                                                        <i class="fa-solid fa-user inputicon"></i>
                                                        <input type="text" name="lname" placeholder="Enter Last Name"
                                                            class="border-0 w-100 bg-white p-1 text-capitalize">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="fontmed labelstyle" for="">Position<span
                                                            class="text-danger">*</span></label>
                                                    <div
                                                        class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                                                        <i class="fa-solid fa-user inputicon"></i>
                                                        <input placeholder="Enter Candidate Position" name="position" required
                                                            class="border-0 w-100 bg-white p-1 text-capitalize">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="fontmed labelstyle" for="">Department<span
                                                            class="text-danger">*</span></label>
                                                    <div
                                                        class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                                                        <i class="fa-solid fa-building inputicon"></i>
                                                        <input placeholder="Enter Candidate Position" name="department" required
                                                            class="border-0 w-100 bg-white p-1 text-capitalize">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="fontmed labelstyle" for="">Increment Amount<span
                                                            class="text-danger">*</span></label>
                                                    <div
                                                        class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                                                        <i class="fa-solid fa-arrow-up-wide-short inputicon"></i>
                                                        <input placeholder="Enter Candidate Position" name="incamt"
                                                            class="border-0 w-100 bg-white p-1">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <label class="fontmed" for="">Address<span
                                                            class="text-danger">*</span></label>
                                                    <div
                                                        class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                                        <i class="fa-solid fa-map-pin inputicon"></i>
                                                        <textarea type="text" name="address"
                                                            placeholder="Enter Candidate Position"
                                                            class="border-0 w-100 bg-white p-1" rows="1"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="fontmed labelstyle" for="">Date<span
                                                            class="text-danger">*</span></label>
                                                    <div
                                                        class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                                                        <i class="fa-solid fa-calendar-days inputicon"></i>
                                                        <input placeholder="Enter Date" type="date" name="date" value="<?php echo date('Y-m-d'); ?>"
                                                            class="border-0 w-100 bg-white p-1">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="fontmed labelstyle" for="">Effect From<span
                                                            class="text-danger">*</span></label>
                                                    <div
                                                        class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                                                        <i class="fa-solid fa-calendar-days inputicon"></i>
                                                        <input placeholder="Enter Date" type="date" name="Efromdate" value="<?php echo date('Y-m-d'); ?>"
                                                            class="border-0 w-100 bg-white p-1">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="fontmed labelstyle" for="">Salary<span
                                                            class="text-danger">*</span></label>
                                                    <div
                                                        class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                                                        <i class="fa-solid fa-money-bill-1-wave inputicon"></i>
                                                        <input placeholder="salary" type="number" name="salary"
                                                            class="border-0 w-100 bg-white p-1">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="fontmed labelstyle" for="">Joining Date<span
                                                            class="text-danger">*</span></label>
                                                    <div
                                                        class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                                                        <i class="fa-solid fa-calendar-days inputicon"></i>
                                                        <input placeholder="Enter Joining Date" type="date" name="jdate" required
                                                            class="border-0 w-100 bg-white p-1">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="fontmed labelstyle" for="">Email<span
                                                            class="text-danger">*</span></label>
                                                    <div
                                                        class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                                                        <i class="fa-solid fa-envelope inputicon"></i>
                                                        <input placeholder="Enter Candidate Email" type="email" name="email"
                                                            class="border-0 w-100 bg-white p-1">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="fontmed labelstyle" for="">Sign<span
                                                            class="text-danger">*</span></label>
                                                    <div
                                                        class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                                                        <i class="fa-solid fa-signature inputicon"></i>
                                                        <input placeholder="Sign" name="sign"
                                                            class="border-0 w-100 bg-white p-1">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="fontmed" for="">PF<span
                                                            class="text-danger">*</span></label>
                                                    <div
                                                        class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                                        <i class="fa-solid fa-user inputicon"></i>
                                                        <select name="pf" class="border-0 w-100 bg-white p-1">
                                                            <option value="1">Yes</option>
                                                            <option value="0">No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="fontmed labelstyle" for="">Sign designation<span
                                                            class="text-danger">*</span></label>
                                                    <div
                                                        class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                                                        <i class="fa-solid fa-signature inputicon"></i>
                                                        <input placeholder="Sign designation" name="sign_deg"
                                                            class="border-0 w-100 bg-white p-1">
                                                    </div>
                                                </div>
                                                <div class="col-12 d-flex align-self-end  mt-3"><button
                                                        class="p-2 px-4 baseBtnBg border-0 rounded mx-2 text-white m-auto">
                                                        Create
                                                    </button></div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="table" id="table4" style="display: none;">
                                        <div class=" align-items-center my-2">
                                            <p class="SubHeding m-0 text-center">Appraisal Letter</p>
                                        </div>
                                        <form action="{{env('APP_URL')}}admin/appraisal">
                                            <div class="row">
                                                <div class="col-6">
                                                    <label class="fontmed" for="">Title<span
                                                            class="text-danger">*</span></label>
                                                    <div
                                                        class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                                        <i class="fa-solid fa-user inputicon"></i>
                                                        <input type="text" name="title" placeholder="Mr./Ms."
                                                            class="border-0 w-100 bg-white p-1 text-capitalize">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="fontmed" for="">First Name<span
                                                            class="text-danger">*</span></label>
                                                    <div
                                                        class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                                        <i class="fa-solid fa-user inputicon"></i>
                                                        <input type="text" name="fname" required placeholder="Enter First Name"
                                                            class="border-0 w-100 bg-white p-1 text-capitalize">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="fontmed" for="">Last Name<span
                                                            class="text-danger">*</span></label>
                                                    <div
                                                        class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                                        <i class="fa-solid fa-user inputicon"></i>
                                                        <input type="text" name="lname" placeholder="Enter Last Name"
                                                            class="border-0 w-100 bg-white p-1 text-capitalize">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="fontmed" for="">Position<span
                                                            class="text-danger">*</span></label>
                                                    <div
                                                        class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                                        <i class="fa-solid fa-user inputicon"></i>
                                                        <input type="text" name="position" required
                                                            placeholder="Enter Candidate Position"
                                                            class="border-0 w-100 bg-white p-1 text-capitalize">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="fontmed" for="">Promoted<span
                                                            class="text-danger">*</span></label>
                                                    <div
                                                        class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                                        <i class="fa-solid fa-user inputicon"></i>
                                                        <input type="text" name="promoted"
                                                            placeholder="Enter permoted designaiton"
                                                            class="border-0 w-100 bg-white p-1">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="fontmed" for="">Department<span
                                                            class="text-danger">*</span></label>
                                                    <div
                                                        class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                                        <i class="fa-solid fa-building  inputicon"></i>
                                                        <input type="text" name="department" required
                                                            placeholder="Enter Candidate Department"
                                                            class="border-0 w-100 bg-white p-1">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="fontmed" for="">Effect From Date<span
                                                            class="text-danger">*</span></label>
                                                    <div
                                                        class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                                        <i class="fa-solid fa-calendar-days inputicon"></i>
                                                        <input type="date" name="date" value="<?php echo date('Y-m-d'); ?>" placeholder="Enter Date"
                                                            class="border-0 w-100 bg-white p-1">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="fontmed labelstyle" for="">Salary<span class="text-danger">*</span></label>
                                                    <div class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                                                        <i class="fa-solid fa-money-bill-1-wave inputicon"></i>
                                                        <input placeholder="salary" type="number" name="salary" class="border-0 w-100 bg-white p-1">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="fontmed" for="">Email<span
                                                            class="text-danger">*</span></label>
                                                    <div
                                                        class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                                        <i class="fa-solid fa-envelope  inputicon"></i>
                                                        <input type="email" name="email"
                                                            placeholder="Enter Candidate Email"
                                                            class="border-0 w-100 bg-white p-1">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="fontmed" for="">Sign designation<span
                                                            class="text-danger">*</span></label>
                                                    <div
                                                        class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                                        <i class="fa-solid fa-signature   inputicon"></i>
                                                        <input type="text" name="sign_deg"
                                                            placeholder="Sign designation"
                                                            class="border-0 w-100 bg-white p-1">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="fontmed" for="">Sign<span
                                                            class="text-danger">*</span></label>
                                                    <div
                                                        class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                                        <i class="fa-solid fa-signature  inputicon"></i>
                                                        <input type="text" name="sign" placeholder="Sign "
                                                            class="border-0 w-100 bg-white p-1">
                                                    </div>
                                                </div>
                                                <div class="col-6 d-flex align-self-end  mt-3"><button
                                                        class="p-2 px-4 baseBtnBg border-0 rounded mx-2 text-white">
                                                        Create
                                                    </button></div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="table" id="table5" style="display: none;">
                                        <div class=" align-items-center my-2">
                                            <p class="SubHeding m-0 text-center">Relieving and Experience Letter</p>
                                        </div>
                                        <form action="{{env('APP_URL')}}admin/experience">
                                            <div class="row">
                                                <div class="col-6">
                                                    <label class="fontmed" for="">Title<span
                                                            class="text-danger">*</span></label>
                                                    <div
                                                        class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                                        <i class="fa-solid fa-user inputicon"></i>
                                                        <input type="text" name="title" placeholder="Mr./Ms."
                                                            class="border-0 w-100 bg-white p-1">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="fontmed" for="">First Name<span
                                                            class="text-danger">*</span></label>
                                                    <div
                                                        class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                                        <i class="fa-solid fa-user inputicon"></i>
                                                        <input type="text" name="fname" required placeholder="Enter First Name"
                                                            class="border-0 w-100 bg-white p-1">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="fontmed" for="">Last Name<span
                                                            class="text-danger">*</span></label>
                                                    <div
                                                        class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                                        <i class="fa-solid fa-user inputicon"></i>
                                                        <input type="text" name="lname" placeholder="Enter Last Name"
                                                            class="border-0 w-100 bg-white p-1">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="fontmed" for="">Position<span
                                                            class="text-danger">*</span></label>
                                                    <div
                                                        class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                                        <i class="fa-solid fa-user inputicon"></i>
                                                        <input type="text" name="position" required
                                                            placeholder="Enter Candidate Position"
                                                            class="border-0 w-100 bg-white p-1">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <label class="fontmed" for="">Address<span
                                                            class="text-danger">*</span></label>
                                                    <div
                                                        class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                                        <i class="fa-solid fa-map-pin inputicon"></i>
                                                        <textarea type="text" name="address"
                                                            placeholder="Enter Candidate Position"
                                                            class="border-0 w-100 bg-white p-1" rows="1"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="fontmed" for="">Department<span
                                                            class="text-danger">*</span></label>
                                                    <div
                                                        class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                                        <i class="fa-solid fa-building  inputicon"></i>
                                                        <input type="text" name="department" required
                                                            placeholder="Enter Candidate Department"
                                                            class="border-0 w-100 bg-white p-1">
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <label class="fontmed" for=""> Date<span
                                                            class="text-danger">*</span></label>
                                                    <div
                                                        class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                                        <i class="fa-solid fa-calendar-days inputicon"></i>
                                                        <input type="date" name="date" value="<?php echo date('Y-m-d'); ?>" placeholder="Enter Date"
                                                            class="border-0 w-100 bg-white p-1">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="fontmed" for="">From Date<span
                                                            class="text-danger">*</span></label>
                                                    <div
                                                        class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                                        <i class="fa-solid fa-calendar-days inputicon"></i>
                                                        <input type="date" name="fdate" placeholder="Enter Date"
                                                            class="border-0 w-100 bg-white p-1">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="fontmed" for="">To Date<span
                                                            class="text-danger">*</span></label>
                                                    <div
                                                        class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                                        <i class="fa-solid fa-calendar-days inputicon"></i>
                                                        <input type="date" name="tdate" placeholder="Enter Date"
                                                            class="border-0 w-100 bg-white p-1">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="fontmed" for="">Gender<span
                                                            class="text-danger">*</span></label>

                                                    <div
                                                        class="p-2 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                                        <div class="me-4 ms-2">
                                                            <input type="radio" name="gender" required value="He">
                                                        <label for="html" class="m-0"><i class="fa-solid fa-person"></i> male</label>
                                                        </div>
                                                        <div class="me-4 ms-2">
                                                            <input type="radio" name="gender" required value="She">
                                                        <label for="css" class="m-0"> <i class="fa-solid fa-person-dress"></i> female</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="fontmed" for="">Email<span
                                                            class="text-danger">*</span></label>
                                                    <div
                                                        class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                                        <i class="fa-solid fa-envelope  inputicon"></i>
                                                        <input type="email" name="email"
                                                            placeholder="Enter Candidate Email"
                                                            class="border-0 w-100 bg-white p-1">
                                                    </div>
                                                </div>
                                                 <div class="col-6">
                                                    <label class="fontmed" for="">Sign designation<span
                                                            class="text-danger">*</span></label>
                                                    <div
                                                        class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                                        <i class="fa-solid fa-signature   inputicon"></i>
                                                        <input type="text" name="sign_deg"
                                                            placeholder="Sign designation"
                                                            class="border-0 w-100 bg-white p-1">
                                                    </div>
                                                </div>
                                                 <div class="col-6">
                                                    <label class="fontmed" for="">Sign<span
                                                            class="text-danger">*</span></label>
                                                    <div
                                                        class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                                        <i class="fa-solid fa-signature  inputicon"></i>
                                                        <input type="text" name="sign" placeholder="Sign "
                                                            class="border-0 w-100 bg-white p-1">
                                                    </div>
                                                </div>
                                                <div class="col-6 d-flex align-self-end  mt-3"><button
                                                        class="p-2 px-4 baseBtnBg border-0 rounded mx-2 text-white">
                                                        Create
                                                    </button></div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="table" id="table6" style="display: none;">
                                        <div class=" align-items-center my-2">
                                            <p class="SubHeding m-0 text-center">Confirmation Letter</p>
                                        </div>
                                        <form action="{{env('APP_URL')}}admin/confirmation">
                                            <div class="row">
                                                <div class="col-6">
                                                    <label class="fontmed" for="">Title<span
                                                            class="text-danger">*</span></label>
                                                    <div
                                                        class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                                        <i class="fa-solid fa-user inputicon"></i>
                                                        <input type="text" name="title" placeholder="Mr./Ms."
                                                            class="border-0 w-100 bg-white p-1">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="fontmed" for="">First Name<span
                                                            class="text-danger">*</span></label>
                                                    <div
                                                        class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                                        <i class="fa-solid fa-user inputicon"></i>
                                                        <input type="text" name="fname" required placeholder="Enter First Name"
                                                            class="border-0 w-100 bg-white p-1">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="fontmed" for="">Last Name<span
                                                            class="text-danger">*</span></label>
                                                    <div
                                                        class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                                        <i class="fa-solid fa-user inputicon"></i>
                                                        <input type="text" name="lname" placeholder="Enter Last Name"
                                                            class="border-0 w-100 bg-white p-1">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="fontmed" for="">Position<span
                                                            class="text-danger">*</span></label>
                                                    <div
                                                        class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                                        <i class="fa-solid fa-user inputicon"></i>
                                                        <input type="text" name="position" required
                                                            placeholder="Enter Candidate Position"
                                                            class="border-0 w-100 bg-white p-1">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <label class="fontmed" for="">Address<span
                                                            class="text-danger">*</span></label>
                                                    <div
                                                        class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                                        <i class="fa-solid fa-map-pin inputicon"></i>
                                                        <textarea type="text" name="address"
                                                            placeholder="Enter Candidate Position"
                                                            class="border-0 w-100 bg-white p-1" rows="1"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="fontmed" for="">Salary<span
                                                            class="text-danger">*</span></label>
                                                    <div
                                                        class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                                        <i class="fa-solid fa-building  inputicon"></i>
                                                        <input type="number" name="salary"
                                                            placeholder="Enter Candidate Department"
                                                            class="border-0 w-100 bg-white p-1">
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <label class="fontmed" for="">Date<span
                                                            class="text-danger">*</span></label>
                                                    <div
                                                        class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                                        <i class="fa-solid fa-calendar-days inputicon"></i>
                                                        <input type="date" name="date" value="<?php echo date('Y-m-d'); ?>" placeholder="Enter Date"
                                                            class="border-0 w-100 bg-white p-1">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="fontmed" for="">Joining Date<span
                                                            class="text-danger">*</span></label>
                                                    <div
                                                        class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                                        <i class="fa-solid fa-calendar-days inputicon"></i>
                                                        <input type="date" name="fdate" placeholder="Enter Date"
                                                            class="border-0 w-100 bg-white p-1">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="fontmed" for="">Email<span
                                                            class="text-danger">*</span></label>
                                                    <div
                                                        class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                                        <i class="fa-solid fa-envelope  inputicon"></i>
                                                        <input type="email" name="email"
                                                            placeholder="Enter Candidate Email"
                                                            class="border-0 w-100 bg-white p-1">
                                                    </div>
                                                </div>
                                                 <div class="col-6">
                                                    <label class="fontmed" for="">Sign designation<span
                                                            class="text-danger">*</span></label>
                                                    <div
                                                        class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                                        <i class="fa-solid fa-signature   inputicon"></i>
                                                        <input type="text" name="sign_deg"
                                                            placeholder="Sign designation"
                                                            class="border-0 w-100 bg-white p-1">
                                                    </div>
                                                </div>
                                                 <div class="col-6">
                                                    <label class="fontmed" for="">Sign<span
                                                            class="text-danger">*</span></label>
                                                    <div
                                                        class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 br">
                                                        <i class="fa-solid fa-signature  inputicon"></i>
                                                        <input type="text" name="sign" placeholder="Sign"
                                                            class="border-0 w-100 bg-white p-1">
                                                    </div>
                                                </div>
                                                <div class="col-6 d-flex align-self-end  mt-3"><button
                                                        class="p-2 px-4 baseBtnBg border-0 rounded mx-2 text-white">
                                                        Create
                                                    </button></div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <script>
                                    var tabs = document.querySelectorAll(".tab");
                                    var tables = document.querySelectorAll(".table");

                                    for (var i = 0; i < tabs.length; i++) {
                                        tabs[i].addEventListener("click", function () {
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
             $( document ).ready(function() {
    document.querySelector('.app-main__outer').classList.toggle('collapse');
})
        </script>
@include('admin.includes.footer')