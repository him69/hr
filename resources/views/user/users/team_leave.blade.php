@include('user.includes.header')
<style>
    th{width: 95px;}
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
    <div class="app-main">
@include('user.includes.sidebar')
        <div class="app-main__outer table-responsive">
            <div class="app-main__inner ">
                <div class="borderRadius overflow-hidden lReq baseShadow bg-white my-2 mx-auto p-2 " style="width: 98%;">
                    <div class="row align-items-center my-2">
                        <div class="d-flex justify-content-between align-items-center">
                        <p class="SubHeding m-0 text-center">Leave Request</p>
                        <form method="post">
                            <div class="d-flex justify-content-between  baseBtnbr rounded-2 my-2">
                                <div class="">
                                    @csrf
                                    <input type="month" id="month" value="{{$date}}" class="form-control border-0 bg-transparent vsmatxt">
                                </div>
                                <button class="btn baseBtnBg w-100 m-1 py-0" >
                                    <span class=""><i class="bi bi-search"></i></span>
                                </button>
                            </div>
                    </form>
                   
                        </div>
                        <div class="col-4">
                            
                        </div>
                    </div>
                    <table class="table table-bordered text-center capitalize">
                        <tr>
                            <th class="Uname vsmatxt"> Name </th>
                            <th class="ltype vsmatxt"> Leave Type </th>
                            <th class="ltDate vsmatxt"> Leave From </th>
                            <th class="ltDate vsmatxt"> Leave To </th>
                            <th class="lRes vsmatxt"> Reason </th>
                            <th class="lRes vsmatxt" style=" min-width: 225px;"> Response </th>
                            <th class="lAct vsmatxt"> Action </th>
                        </tr>
                        @if($leaves->count() > 0)
                        @foreach($leaves as $leave)
                        <tr>
                            <td>
                                <p class="m-0 vsmatxt">{{$leave->user_id}}</p>
                            </td>
                            <td class="vsmatxt">{{$leave->leave_type}}</td>
                            <td class="vsmatxt">{{$leave->leave_from}}</td>
                            <td class="vsmatxt">{{$leave->leave_to}}</td>
                            <td class="vsmatxt">{{$leave->reason}}</td>
                            <td><input type="text" name="response" class="form-control leave-response vsmatxt" value="{{$leave->response}}"></td>
                            <td class="vsmatxt"
                             id="status_{{$leave->id}}">
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

@include('user.includes.footer')
<script>
     function approveLeave(leaveId) {
    let responseValue = document.querySelector(`div[onclick='approveLeave(${leaveId})']`).closest('tr').querySelector('.leave-response').value;
    
    let status_L = document.getElementById('status_'+leaveId);

    $.ajax({
        url: '{{env('APP_URL')}}team/leave_approve/' + leaveId,
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