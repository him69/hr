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
            <div class="app-main__inner container mt-5">
                <div class="row ">
                    <div class="col-md-12">


                        <div class=" baseShadow borderRadius bg-white m-auto p-3 " style="width: 98%;">
                            <div class="">
                                <p class="SubHeding m-0 text-center">Add Candidate </p>
                            </div>
                            <form method="post" enctype="multipart/form-data">@csrf
                                <div class="row">
                                    <div class="col-6">

                                        <label class="fontmed labelstyle" for="">Full Name (Capital Letter)<span
                                                class="text-danger">*</span></label>
                                        <div
                                            class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                                            <i class="fa-solid fa-user inputicon"></i>
                                            <input type="text" name="name" placeholder="Enter Candidate Name"
                                                @if(isset($us)) value="{{$us->name}} @endif"
                                                class="border-0 w-100 bg-white p-1">
                                        </div>
                                    </div>
                                    <div class="col-6">

                                        <label class="fontmed labelstyle" for="">Email<span
                                                class="text-danger">*</span></label>
                                        <div
                                            class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                                            <i class="fa-solid fa-envelope inputicon"></i>
                                            <input type="text" placeholder="Enter Candidate Email" name="email"
                                                @if(isset($us)) value="{{$us->email}} @endif"
                                                class="border-0 w-100 bg-white p-1">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label class="fontmed labelstyle" for="">Mobile No.<span
                                                class="text-danger">*</span></label>
                                        <div
                                            class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                                            <i class="fa-solid fa-phone inputicon"></i>
                                            <input type="text" placeholder="Enter Candidate Mobile Number" name="mobile"
                                                @if(isset($us)) value="{{$us->mobile}} @endif"
                                                class="border-0 w-100 bg-white p-1">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label class="fontmed labelstyle" for="">Highest Degree<span
                                                class="text-danger">*</span></label>
                                        <div
                                            class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                                            <i class="fa-solid fa-graduation-cap inputicon  "></i>
                                            <input type="text" placeholder="Enter Candidate Degree"
                                                name="highest_degree" @if(isset($us)) value="{{$us->degree}} @endif"
                                                class="border-0 w-100 bg-white p-1">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label class="fontmed labelstyle" for="">Applying for Role<span
                                                class="text-danger">*</span></label>
                                        <div
                                            class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                                            <i class="fa-solid fa-briefcase inputicon"></i>
                                            <input list="Role" name="department" placeholder="Enter Candidate Role"
                                                id="depar" class="border-0 w-100 bg-white p-1">
                                            <datalist id="Role">
                                                <option value="Sales executive">
                                                <option value="Full stack Developer">

                                            </datalist>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label class="fontmed labelstyle" for="">Upload Resume<span
                                                class="text-danger">*</span></label>
                                        <div
                                            class="p-1 border border-black overflow-hidden d-flex align-items-center rounded-1 ">
                                            <i class="fa-solid fa-file inputicon"></i>
                                            <input type="file" name="resume"
                                            accept=".pdf ,.png"
                                                class="border-0 w-100 bg-white p-1">
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-center mt-3"><button
                                            class="p-2 px-4 baseBtnBg border-0 rounded mx-2 text-white">
                                            Create
                                        </button></div>
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

@include('admin.includes.footer')
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