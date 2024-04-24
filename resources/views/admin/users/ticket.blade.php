@include('admin.includes.header')
<style>
    select{
        border: none;
        height: 100%;
        width: 100%;
    }
    select:focus{
        border: none;
        outline: none;
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
                <div class="borderRadius overflow-hidden lReq baseShadow bg-white my-2 mx-auto p-3 py-3 " style="width: 98%;">
                    <div class="row align-items-center my-2">
                        <div class="col-12">
                            <p class="SubHeding m-0 text-center">User Issue</p>
                        </div>
                    </div>
                  <table class="table table-bordered text-center">
                    <tr>
                        <th>User Id</th>
                        <th>Date</th>
                        <th>Department</th>
                        <!-- <th>Subject</th> -->
                        <th>Description</th>
                        <th>Response</th>
                        <th>Action</th>
                    </tr>
                    @foreach($ticket as $tic)
                    <tr> 
                        <td>
                           <a href="{{env('APP_URL')}}admin/attendance/full_report/{{$tic->uid}}">{{$tic->name}}</a> </td>
                        <td>{{date('d M, Y',strtotime($tic->created_at))}}</td>
                        <td>{{$tic->department}}</td>
                        <!-- <td>{{$tic->subject}}</td> -->
                        <td>{{$tic->description}}. @if(isset($tic->serial_number))<a href="{{env('APP_URL')}}admin/ass_ass?sn={{$tic->serial_number}}"> ({{$tic->serial_number}})</a>@endif</td>
                        <td style="width:15%;"><input type="text" name="response" class="form-control" value="{{$tic->response}}"></td>
                        <td style="width:8%;">
                            <select class="form-control" onchange="saveRow(this,{{$tic->id}})">
                                <option value="0">Open</option>
                                <option value="2" @if($tic->status == 2) selected @endif>In Process</option>
                                <option value="1" @if($tic->status == 1) selected @endif>Closed</option>
                            </select>
                        </td>
                    </tr>
                    @endforeach
                  </table>
                </div>
                <div class="borderRadius overflow-hidden lReq baseShadow bg-white my-2 mx-auto p-3 py-3 " style="width: 98%;">
                    <div class="row align-items-center my-2">
                        <div class="col-12">
                            <p class="SubHeding m-0 text-center">Closed Issue</p>
                        </div>
                    </div>
                  <table class="table table-bordered text-center">
                    <tr>
                        <th>User Id</th>
                        <th>Department</th>
                        <th>Subject</th>
                        <th>Description</th>
                        <th>Response</th>
                        <th>Action</th>
                    </tr>
                    @foreach($cticket as $tic)
                    <tr>
                        <td>
                           <a href="{{env('APP_URL')}}admin/attendance/full_report/{{$tic->uid}}">{{$tic->name}}</a> </td>
                        <td>{{$tic->department}}</td>
                        <td>{{$tic->subject}}</td>
                        <td>{{$tic->description}}</td>
                        <td style="width:15%;"><input type="text" name="response" class="form-control" value="{{$tic->response}}"></td>
                        <td style="width:8%;">
                            <select class="form-control" onchange="saveRow(this,{{$tic->id}})">
                                <option value="0">Open</option>
                                <option value="2" @if($tic->status == 2) selected @endif>In Process</option>
                                <option value="1" @if($tic->status == 1) selected @endif>Closed</option>
                            </select>
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
@include('admin.includes.footer')
<script>
function saveRow(selectElement, id) {
    let selectedValue = selectElement.value;
    let row = selectElement.closest('tr');
    let responseValue = row.querySelector('input[name="response"]').value;
        $.get('{{env('APP_URL')}}admin/ticketstatus?id='+id+'&status='+selectedValue+'&response='+responseValue, function(data, status){
    });
}
</script>