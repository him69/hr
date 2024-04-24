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
            <div class="app-main__inner">
                <div class="row ">
                    <div class="col-md-12">
                        <div class="main-card mb-3 card ">
                            <div class="card-body table-responsive">
                                <form method="post">@csrf
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <lebel>Name</lebel><input type="text" name="name" class="form-control"
                                                    @if(isset($us)) value="{{$us->name}} @endif">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <lebel>Email</lebel><input type="text" name="email" class="form-control"
                                                    @if(isset($us)) value="{{$us->email}} @endif">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <lebel>Mobile No.</lebel><input type="text" name="mobile"
                                                    class="form-control" @if(isset($us)) value="{{$us->mobile}} @endif">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <lebel>Alt Mobile</lebel><input type="text" name="alt_mobile"
                                                    class="form-control" @if(isset($us))
                                                    value="{{$us->alt_mobile}} @endif">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <lebel>Adhar Card No.</lebel><input type="text" name="aadhar_card"
                                                    class="form-control" @if(isset($us))
                                                    value="{{$us->aadhar_card}} @endif">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <lebel>Pan Card No.</lebel><input type="text" name="pan_card"
                                                    class="form-control" @if(isset($us))
                                                    value="{{$us->pan_card}} @endif">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <lebel>Salary</lebel><input type="text" name="salary"
                                                    class="form-control" @if(isset($us)) value="{{$us->salary}} @endif">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <lebel>Apply for</lebel><select name="server_ip" class="form-control">
                                                    <option value="1">Sale</option>
                                                    <option value="2">QA</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <lebel>Password</lebel><input type="text" name="password"
                                                    class="form-control" @if(isset($us))
                                                    value="{{$us->password}} @endif">
                                            </div>
                                        </div>
                                        <div class="col-12" align="center"><button class="btn btn-primary"
                                                type="submit">Create</div>
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