@include('admin.includes.header')
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
                <div class="borderRadius overflow-hidden lReq baseShadow bg-white my-2 mx-auto p-2 " style="width: 98%;">
                    <div class="row align-items-center my-2">
                        <div class="col-4">
                            <form method="post">@csrf
                            <div class="row m-0  align-items-center bg-white baseShadow rounded-2">
                                <div class="col-6 p-0">
                                    <input type="month" name="month" value="{{$date}}" class="form-control border-0">
                                </div>
                                <div class="col-6 p-0">
                                    <button class="btn baseBtnBg w-100" type="submit">
                                        <span>Search by month</span>
                                    </button>
                                </div>
                            </div>
                            </form>
                        </div>
                        <div class="col-4">
                            <p class="SubHeding m-0 text-center">Leave Request</p>
                        </div>
                    </div>
                    <table class="table table-bordered text-center capitalize">
                        <tr>
                            <th class="Uname"> Name </th>
                            <th class=""> date </th>
                            <th class="ltype"> Leave Type </th>
                            <th class="ltDate"> Leave From </th>
                            <th class="ltDate"> Leave To </th>
                            <th class="lRes"> Reason </th>
                            <th class="lRes"> Response </th>
                            <th class="lAct"> Action </th>
                        </tr>
                        @if($leaves->count() > 0)
                        @foreach($leaves as $leave)
                        <tr>
                            <td><a href="{{env('APP_URL').'admin/attendance/full_report/'.$leave->user_id}}"><p class="m-0">{{$leave->user_ida}}</p></a></td>
                            <td> {{ date('j M Y', strtotime($leave->created_at)) }}</td>
                            <td>{{$leave->leave_type}}</td>
                            <td>{{$leave->leave_from}}</td>
                            <td>{{$leave->leave_to}}</td>
                            <td>{{$leave->reason}}</td>

                            <td><input type="text" name="response" class="form-control leave-response" value="{{$leave->response}}"></td>
                            <td id="status_{{$leave->id}}">
                                    @if($leave->approved == 0)
                                    <div class="d-flex">
                                     <div onclick="approveLeave({{$leave->id}})" style="cursor: pointer;">
                                         <i class="bi bi-check text-success SubHeding"></i></div>
                                     <div onclick="rejectLeave({{$leave->id}})" style="cursor: pointer;">
                                     <i class="bi bi-x SubHeding text-danger"></i></div></div>
                                      @elseif($leave->approved == 2)
                                                <span class="msg" style="color:#ca082c;">Rejected</span>
                                            @else
                                                <span class="msg" style="color:#09873b;">Approved</span>
                                            @endif
                              
                            </td>
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
</div>
</div>
</div>

@include('admin.includes.footer')

<script>
    function approveLeave(leaveId) {
    let responseValue = document.querySelector(`div[onclick='approveLeave(${leaveId})']`).closest('tr').querySelector('.leave-response').value;
    
    let status_L = document.getElementById('status_'+leaveId);

    $.ajax({
        url: '{{env('APP_URL')}}admin/leave_approve/' + leaveId,
        method: 'POST',
        data: {
            response: responseValue,
            _token: '{{ csrf_token() }}'
        }, success:function(){
         status_L.innerHTML =`<p clas="text-center" style="color:#09873b;">Aproved</p>`;
        }
    });
}
    function rejectLeave(leaveId) {
    let responseValue = document.querySelector(`div[onclick='rejectLeave(${leaveId})']`).closest('tr').querySelector('.leave-response').value;
    
    let status_L = document.getElementById('status_'+leaveId);
      console.log(status_L);
      console.log(responseValue);
    $.ajax({
        url: '{{env('APP_URL')}}admin/leave_reject/' + leaveId,
        method: 'POST',
        data: {
            response: responseValue,
            _token: '{{ csrf_token() }}'
        },success:function(){
         status_L.innerHTML =`<p clas="text-center " style="color:#ca082c;">Reject</p>`;
        }
    });
}
</script>