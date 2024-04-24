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
                        <div class="main-card mb-3 card ">
                            <div class="card-body table-responsive">
                                <table class="table table-hover table-bordered table-sm">
                                    <tr>
                                        <th colspan="9">
                                            <center>Rejected Candidates</center>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th><center>Name</center></th>
                                        <th style="width:150px;"><center>Email</center></th>
                                        <th><center>Mobile</center></th>
                                        <th><center>Resume</center></th>
                                        <th><center>Applied for</center></th>
                                        <th style="width:100px;">
                                            <center>Action</center>
                                        </th>
                                    </tr>
                                    @foreach($users as $us)
                                    <tr>
                                        <td>
                                            <center>{{$us->name}}</center>
                                        </td>
                                        <td>
                                            <center>{{$us->email}}</center>
                                        </td>
                                        <td>
                                            <center>{{$us->mobile}}</center>
                                        </td>
                                        <td>
                                            <center><a href="{{$us->resume}}" target="_blank" style="color: blue; cursor:pointer;text-decoration:underline;">View</a></center>
                                        </td>
                                        <td>
                                            <center>{{$us->apply_for}}</center>
                                        </td>
                                        <td>
                                            <center>{{$us->status}}</center>
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