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
            <div class="app-main__inner ">

                <div class="d-flex justify-content-between align-items-center mt-4">
                    <div class="">
                        <p class="h5 fw-bold text-center">My leave</p>
                    </div>
                    <div class=" d-flex justify-content-end">
                        <a href="{{env('APP_URL')}}request_for_leave">
                            <button type="button" class="btn baseBtnBg"><span class="p-1 m-1 vsmatxt rounded-circle bibr bg-white cttext "><i class="fa-solid fa-user-slash"></i></span> Go to Request leave</button>
                        </a>
                    </div>
                </div>
                <div class="borderRadius overflow-hidden lReq baseShadow bg-white my-2 mx-auto p-3 py-3 ">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="mb-0 fw-bold">Here is your leave reports</h6>
                                <div class="d-flex align-items-center">
                                    <div class="d-flex flex-column  justify-content-end align-items-end smaTxt" style="font-size: 12px;">
                                        <span>Leave balance: <b class="ms-1">{{$user->leave_count}}</b></span>
                                        <span>Used Leave: <b class="ms-1">{{$user->used_leave_count}}</b></span>
                                    </div>
                                </div>
                            </div>

                            <p style="font-size: 12px;">After applying your leave, make sure to check this section every time whether your leave is approved or not</p>
                        </div>
                    </div>
                    <table class="table table-striped text-center">
                        <tr style="background-color:#EEFAFB;" class="smaTxt">
                            <th>
                                <p class="smaTxt fw-bold">Leave From</p>
                            </th>
                            <th>
                                <p class="smaTxt fw-bold">Leave To</p>
                            </th>
                            <th>
                                <p class="smaTxt fw-bold">Leave Type</p>
                            </th>
                            <th>
                                <p class="smaTxt fw-bold">Reason</p>
                            </th>
                            <th>
                                <p class="smaTxt fw-bold">Response</p>
                            </th>
                            <th>
                                <p class="smaTxt fw-bold">status</p>
                            </th>
                        </tr>
                        @if($leaves->count() > 0)
                        @foreach($leaves as $leave)
                        <tr>
                            <td class="vsmatxt text-muted">{{$leave->leave_from}}</td>
                            <td class="vsmatxt text-muted">{{$leave->leave_to}}</td>
                            <td class="vsmatxt text-muted">{{$leave->leave_type}}</td>
                            <td class="vsmatxt  text-muted">{{$leave->reason}}</td>
                            <td class="vsmatxt  text-muted">{{$leave->response ? $leave->response : 'No response' }}</td>
                            <td class="vsmatxt text-muted">@if($leave->approved == 0) <p class="text-warning m-0"> <span class="text-warning">Pending...</span></p>
                                @elseif($leave->approved == 2) <p class="text-danger m-0">Rejected by {{$leave->approved_by}}</p>
                                @else <p class="text-success m-0">Approved by {{$leave->approved_by}}</p> @endif </td>
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
<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
    Accordion Item #1
</button>
@include('user.includes.footer')