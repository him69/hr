@include('admin.includes.header')
<style>
    th {
        width: 95px;
        font-weight: 700;
        font-size: 18px;
    }

    td {

        font-size: 15px;
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
                <div class="row ">
                    <div class="col-md-12">
                        <div class="borderRadius overflow-hidden baseShadow bg-white my-2 mx-auto px-3 py-3">
                            <div class="row justify-content-around">
                                <div class="col-2 p-2 rounded text-center text-white  tab" data-table-id="table1" style=" background-color: #FFB02E;">Applications</div>
                                <div class="col-2 p-2 rounded text-center text-white tab" data-table-id="table2" style="background-color: #8f8e8eb7;">Interviews</div>
                                <div class="col-2 p-2 rounded text-center text-white tab" data-table-id="table3" style="background-color: #8f8e8eb7;">Hired</div>
                                <div class="col-2 p-2 rounded text-center text-white tab" data-table-id="table4" style="background-color: #8f8e8eb7;">Rejects</div>

                                <div class="tabinfo" id="table1" style="display: block;">
                                    <div class=" align-items-center my-2">
                                        <p class="SubHeding m-0 text-center">Applicants</p>
                                    </div>
                                    <table class="table table-hover table-bordered table-sm">
                                        <tr>
                                            <th>
                                                <p class="text-center samllText">Name</p>
                                            </th>
                                            <th style="width:150px;">
                                                <p class="text-center samllText">Email</p>
                                            </th>
                                            <th>
                                                <p class="text-center samllText">Mobile</p>
                                            </th>
                                            <th>
                                                <p class="text-center samllText">Highest deg.</p>
                                            </th>
                                            <th>
                                                <p class="text-center samllText">Applied for</p>
                                            </th>
                                            <th>
                                                <p class="text-center samllText">Resume</p>
                                            </th>
                                            <th>
                                                <p class="text-center samllText">Status</p>
                                            </th>
                                            <th style="width:100px;">
                                                <p class="text-center samllText">Schedule Inter.</p>
                                            </th>
                                            <th style="width:100px;">
                                                <p class="text-center samllText">Action</p>
                                            </th>
                                        </tr>
                                        @foreach($users as $us)
                                        <tr>
                                            <td>
                                                <p class="text-center">{{$us->name}}</p>
                                            </td>
                                            <td>
                                                <p class="text-center">{{$us->email}}</p>
                                            </td>
                                            <td>
                                                <p class="text-center">{{$us->mobile}}</p>
                                            </td>
                                            <td>
                                                <p class="text-center">{{$us->highest_degree}}</p>
                                            </td>
                                            <td>
                                                <p class="text-center">{{$us->apply_for}}</p>
                                            </td>
                                            <td>
                                                <p class="text-center"><a href="{{$us->resume}}" target="_blank" style="color: blue; cursor:pointer;text-decoration:underline;">View</a>
                                                </p>
                                            </td>
                                            <td>
                                                <p class="text-center">{{$us->status}}</p>
                                            </td>

                                            <td>
                                                <p class="text-center"><a type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal" style="color:white;
                                            background-color: rgb(105, 202, 81); cursor:pointer;" onclick="aa({{$us->id}})">Schedule</a></p>
                                            </td>
                                            @if($us->status == "pending")
                                            <td>
                                                <p class="text-center"><a class="btn" href="{{env('APP_URL')}}admin/reject/{{$us->id}}" value="rejected" name="reject" style="color:white;background-color: rgb(250, 68, 44); cursor:pointer;">Reject</a>
                                                </p>
                                            </td>
                                            @endif
                                        </tr>
                                        @endforeach
                                    </table>
                                </div>
                                <div class="tabinfo" id="table2" style="display: none;">
                                    <div class=" align-items-center my-2">
                                        <p class="SubHeding m-0 text-center">Interview</p>
                                    </div>
                                    <table class="table table-hover table-bordered table-sm">
                                        <tr>
                                            <th>
                                                <p class="text-center samllText ">Name</p>
                                            </th>
                                            <th style="width:150px;">
                                                <p class="text-center  samllText ">Email</p>
                                            </th>
                                            <th>
                                                <p class="text-center samllText ">Mobile</p>
                                            </th>
                                            <th>
                                                <p class="text-center samllText ">Highest deg.</p>
                                            </th>
                                            <th>
                                                <p class="text-center samllText ">Applied for</p>
                                            </th>
                                            <th>
                                                <p class="text-center samllText ">Resume</p>
                                            </th>
                                            <th>
                                                <p class="text-center samllText ">Status</p>
                                            </th>
                                            <th style="width:100px;">
                                                <p class="text-center samllText ">Schedule Inter.</p>
                                            </th>
                                            <th style="width:100px;">
                                                <p class="text-center samllText ">Action</p>
                                            </th>
                                        </tr>
                                        @foreach($users as $us)
                                        <tr>
                                            <td>
                                                <p class="text-center">{{$us->name}}</p>
                                            </td>
                                            <td>
                                                <p class="text-center">{{$us->email}}</p>
                                            </td>
                                            <td>
                                                <p class="text-center">{{$us->mobile}}</p>
                                            </td>
                                            <td>
                                                <p class="text-center">{{$us->highest_degree}}</p>
                                            </td>
                                            <td>
                                                <p class="text-center">{{$us->apply_for}}</p>
                                            </td>
                                            <td>
                                                <p class="text-center"><a href="{{$us->resume}}" target="_blank" style="color: blue; cursor:pointer;text-decoration:underline;">View</a>
                                                </p>
                                            </td>
                                            <td>
                                                <p class="text-center">{{$us->status}}</p>
                                            </td>

                                            <td>
                                                <p class="text-center"><a type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal" style="color:white;
                                            background-color: rgb(105, 202, 81); cursor:pointer;" onclick="aa({{$us->id}})">Schedule</a></p>
                                            </td>
                                            @if($us->status == "pending")
                                            <td>
                                                <p class="text-center"><a class="btn" href="{{env('APP_URL')}}admin/reject/{{$us->id}}" value="rejected" name="reject" style="color:white;background-color: rgb(250, 68, 44); cursor:pointer;">Reject</a>
                                                </p>
                                            </td>
                                            @endif
                                        </tr>
                                        @endforeach
                                    </table>
                                </div>
                                <div class="tabinfo" id="table3" style="display: none;">
                                    <div class=" align-items-center my-2">
                                        <p class="SubHeding m-0 text-center">Hired</p>
                                    </div>
                                    <table class="table table-hover table-bordered table-sm">
                                        <tr>
                                            <th>
                                                <p class="text-center samllText">Name</p>
                                            </th>
                                            <th style="width:150px;">
                                                <p class="text-center samllText">Email</p>
                                            </th>
                                            <th>
                                                <p class="text-center samllText">Mobile</p>
                                            </th>
                                            <th>
                                                <p class="text-center samllText">Highest deg.</p>
                                            </th>
                                            <th>
                                                <p class="text-center samllText">Applied for</p>
                                            </th>
                                            <th>
                                                <p class="text-center samllText">Resume</p>
                                            </th>
                                            <th>
                                                <p class="text-center samllText">Status</p>
                                            </th>
                                            <th style="width:100px;">
                                                <p class="text-center samllText">Schedule Inter.</p>
                                            </th>
                                            <th style="width:100px;">
                                                <p class="text-center samllText">Action</p>
                                            </th>
                                        </tr>
                                        @foreach($users as $us)
                                        <tr>
                                            <td>
                                                <p class="text-center">{{$us->name}}</p>
                                            </td>
                                            <td>
                                                <p class="text-center">{{$us->email}}</p>
                                            </td>
                                            <td>
                                                <p class="text-center">{{$us->mobile}}</p>
                                            </td>
                                            <td>
                                                <p class="text-center">{{$us->highest_degree}}</p>
                                            </td>
                                            <td>
                                                <p class="text-center">{{$us->apply_for}}</p>
                                            </td>
                                            <td>
                                                <p class="text-center"><a href="{{$us->resume}}" target="_blank" style="color: blue; cursor:pointer;text-decoration:underline;">View</a>
                                                </p>
                                            </td>
                                            <td>
                                                <p class="text-center">{{$us->status}}</p>
                                            </td>

                                            <td>
                                                <p class="text-center"><a type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal" style="color:white;
                                            background-color: rgb(105, 202, 81); cursor:pointer;" onclick="aa({{$us->id}})">Schedule</a></p>
                                            </td>
                                            @if($us->status == "pending")
                                            <td>
                                                <p class="text-center"><a class="btn" href="{{env('APP_URL')}}admin/reject/{{$us->id}}" value="rejected" name="reject" style="color:white;background-color: rgb(250, 68, 44); cursor:pointer;">Reject</a>
                                                </p>
                                            </td>
                                            @endif
                                        </tr>
                                        @endforeach
                                    </table>
                                </div>
                                <div class="tabinfo" id="table4" style="display: none;">
                                    <div class=" align-items-center my-2">
                                        <p class="SubHeding m-0 text-center">Rejects</p>
                                    </div>
                                    <table class="table table-hover table-bordered table-sm">
                                        <tr>
                                            <th>
                                                <p class="text-center samllText">Name</p>
                                            </th>
                                            <th style="width:150px;">
                                                <p class="text-center samllText">Email</p>
                                            </th>
                                            <th>
                                                <p class="text-center samllText">Mobile</p>
                                            </th>
                                            <th>
                                                <p class="text-center samllText">Highest deg.</p>
                                            </th>
                                            <th>
                                                <p class="text-center samllText">Applied for</p>
                                            </th>
                                            <th>
                                                <p class="text-center samllText">Resume</p>
                                            </th>
                                            <th>
                                                <p class="text-center samllText">Status</p>
                                            </th>
                                            <th style="width:100px;">
                                                <p class="text-center samllText">Schedule Inter.</p>
                                            </th>
                                            <th style="width:100px;">
                                                <p class="text-center samllText">Action</p>
                                            </th>
                                        </tr>
                                        @foreach($users as $us)
                                        <tr>
                                            <td>
                                                <p class="text-center">{{$us->name}}</p>
                                            </td>
                                            <td>
                                                <p class="text-center">{{$us->email}}</p>
                                            </td>
                                            <td>
                                                <p class="text-center">{{$us->mobile}}</p>
                                            </td>
                                            <td>
                                                <p class="text-center">{{$us->highest_degree}}</p>
                                            </td>
                                            <td>
                                                <p class="text-center">{{$us->apply_for}}</p>
                                            </td>
                                            <td>
                                                <p class="text-center"><a href="{{$us->resume}}" target="_blank" style="color: blue; cursor:pointer;text-decoration:underline;">View</a>
                                                </p>
                                            </td>
                                            <td>
                                                <p class="text-center">{{$us->status}}</p>
                                            </td>

                                            <td>
                                                <p class="text-center"><a type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal" style="color:white;
                                            background-color: rgb(105, 202, 81); cursor:pointer;" onclick="aa({{$us->id}})">Schedule</a></p>
                                            </td>
                                            @if($us->status == "pending")
                                            <td>
                                                <p class="text-center"><a class="btn" href="{{env('APP_URL')}}admin/reject/{{$us->id}}" value="rejected" name="reject" style="color:white;background-color: rgb(250, 68, 44); cursor:pointer;">Reject</a>
                                                </p>
                                            </td>
                                            @endif
                                        </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                            <script>
                                var tabs = document.querySelectorAll(".tab");
                                var tables = document.querySelectorAll(".tabinfo");

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
                        </div>
                        <!--<div class="main-card mb-3 card ">-->
                        <!--    <div class="card-body table-responsive">-->

                        <!--    </div>-->
                        <!--</div>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-center flex-column align-items-center">
                    <h5>Schedule Inter.</h5>
                    <form action="{{env('APP_URL')}}admin/schedule" method="post">@csrf
                        <input type="hidden" id="interviewid" name="interviewid">
                        <input type="datetime-local" name="interview_date" min="{{date('Y-m-d')}}">

                </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Schedule</button>
                </form>
            </div>
        </div>
    </div>
</div>
@include('admin.includes.footer')
<!-- Modal -->
<script>
    function aa(id) {
        document.getElementById('interviewid').value = id;
    }
</script>