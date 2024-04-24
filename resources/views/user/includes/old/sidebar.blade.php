<style>
    li a {
        font-weight: 700;
    }
    .inputicon {
    font-size: 20px;
    color: white;
    min-width: 30px;
    text-align: center;
    border-right: 1px solid white;
}
.navBox{
    border:1px solid white;
    border-right:none;
}
</style>
<div class="app-sidebar sidebar-shadow">


    <div class="scrollbar-sidebar">
        <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu mt-4">
                    <!-- <div class="d-flex navBox  p-2 my-2">
                        <div>
                        <i class="bi bi-people-fill inputicon p-2"></i>
                        </div>
                        <div class="w-100">
                            <p class="para m-0 px-2 py-2 text-white">ATTENDENCE</p>
                            <div class="d-flex w-100 text-white justify-content-between align-items-center px-2 my-1" style="background: #009CCB;">
                            <div>
                            <i class="fa-solid fa-user-clock"></i>
                                <span><i class="fa-solid fa-user-clock vsmatxt p-1" style="border-right: 1px solid white;"></i></span>
                                <span>My Attendance</span>
                            </div>
                            <span class="bg-white rounded-circle p-1"></span>
                            </div>
                            <div class="d-flex w-100 text-white justify-content-between my-1 align-items-center px-2" style="background: #009CCB;">
                            <div>
                                <span><i class="fa-solid fa-user vsmatxt p-1" style="border-right: 1px solid white;"></i></span>
                                <span>My Leave</span>
                            </div>
                            <span class="bg-white rounded-circle p-1"></span>
                            </div>
                            
                        </div>
                    </div>
                    <div class="d-flex navBox  p-2 my-2">
                        <div>
                        <i class="fa-solid fa-user inputicon p-2"></i>
                        </div>
                        <div class="w-100">
                            <p class="para m-0 px-2 py-2 text-white">HOLIDAYS</p>
                            <div class="d-flex w-100 text-white justify-content-between align-items-center px-2 my-1" style="background: #009CCB;">
                            <div>
                                <span><i class="fa-solid fa-user vsmatxt p-1" style="border-right: 1px solid white;"></i></span>
                                <span>My Holidays</span>
                            </div>
                            <span class="bg-white rounded-circle p-1"></span>
                            </div>
                            <div class="d-flex w-100 text-white justify-content-between my-1 align-items-center px-2" style="background: #009CCB;">
                            <div>
                                <span><i class="fa-solid fa-user vsmatxt p-1" style="border-right: 1px solid white;"></i></span>
                                <span>Request Leave</span>
                            </div>
                            <span class="bg-white rounded-circle p-1"></span>
                            </div>
                            
                        </div>
                    </div>
                    <div class="d-flex navBox  p-2 my-2">
                        <div>
                        <i class="fa-solid fa-user inputicon p-2"></i>
                        </div>
                        <div class="w-100">
                            <p class="para m-0 px-2 py-2 text-white">Support</p>
                            <div class="d-flex w-100 text-white justify-content-between align-items-center px-2 my-1" style="background: #009CCB;">
                            <div>
                                <span><i class="fa-solid fa-user vsmatxt p-1" style="border-right: 1px solid white;"></i></span>
                                <span>Company Policy</span>
                            </div>
                            <span class="bg-white rounded-circle p-1"></span>
                            </div>
                            <div class="d-flex w-100 text-white justify-content-between my-1 align-items-center px-2" style="background: #009CCB;">
                            <div>
                                <span><i class="fa-solid fa-user vsmatxt p-1" style="border-right: 1px solid white;"></i></span>
                                <span>Raise A Ticket</span>
                            </div>
                            <span class="bg-white rounded-circle p-1"></span>
                            </div>
                            
                        </div>
                    </div> -->
                <li>
                    <a href="{{env('APP_URL')}}" @if(Request::url()=='https://hr.pantheondigitals.com/user' )
                        class="mm-active" @elseif(Request::url()==env('APP_URL')."user") class="mm-active" @endif>
                        <i class="bi bi-house-door font-weight-bold para"></i>
                        Home </a>
                </li> 

                <!-- <li class="app-sidebar__heading w-100 px-2 py-4"><span style="font-weight: 700;">Attendance &
                        Holidays</span></li> -->
                <li>
                    <a href="{{env('APP_URL')}}attendance"
                        @if(Request::url()=='https://hr.pantheondigitals.com/attendance' ) class="mm-active"
                        @elseif(Request::url()==env('APP_URL')."attendance" )class="mm-active" @endif>
                        <i class="bi bi-person-check font-weight-bold para"></i>
                        My Attendance <span style="float:right;">@php($y=date('Y'))@php($m=date('m'))
                            @if($user->user_type == 1)
                            @if(App\Models\Attendance::whereBetween('mark_date',["$y-$m-01","$y-$m-31"])->where('user_id',$user->id)->where('verify',0)->count()
                            > 0) <svg height="8" width="8" class="blinking">
                                <circle cx="4" cy="4" r="4" fill="red"></circle>
                            </svg> @endif @endif</span>
                    </a>
                </li>
                <li>
                    <a href="{{env('APP_URL')}}holiday" @if(Request::url()=='https://hr.pantheondigitals.com/holiday'
                        )class="mm-active" @elseif(Request::url()==env('APP_URL')."holiday" )class="mm-active" @endif>
                        <i class="bi bi-tencent-qq font-weight-bold para"></i>
                        Holiday
                    </a>
                </li>
                <li>
                    <a href="{{env('APP_URL')}}request_for_leave"
                        @if(Request::url()=='https://hr.pantheondigitals.com/request_for_leave' )class="mm-active"
                        @elseif(Request::url()==env('APP_URL')."request_for_leave" )class="mm-active" @endif>
                        <i class="bi bi-door-open font-weight-bold para"></i>
                        Request For Leave
                    </a>
                </li>
                <li>
                    <a href="{{env('APP_URL')}}leave" @if(Request::url()=='https://hr.pantheondigitals.com/leave'
                        )class="mm-active" @elseif(Request::url()==env('APP_URL')."leave" )class="mm-active" @endif>
                        <i class="bi bi-person-workspace font-weight-bold para"></i>
                        Leave
                    </a>
                </li>
                <li>
                    <a href="{{env('APP_URL')}}ticket" @if(Request::url()=='https://hr.pantheondigitals.com/ticket'
                        )class="mm-active" @elseif(Request::url()==env('APP_URL')."ticket" )class="mm-active" @endif
                        class="" style="display: flex;align-items: center; color:#FFD700;">
                        <i class="bi bi-emoji-frown font-weight-bold  para"></i>
                        <b> &nbsp;Raise a issue</b>
                    </a>
                </li>
                <li>
                    <a href="{{env('APP_URL')}}general_info"
                        @if(Request::url()=='https://hr.pantheondigitals.com/team/general_info' )class="mm-active"
                        @elseif(Request::url()==env('APP_URL')."general_info" )class="mm-active" @endif>
                        <i class="bi bi-file-text font-weight-bold  para"></i>
                        Company Policy</a>
                </li>
                @if($user->lead_by == 0)
                <li class="app-sidebar__heading">My Team</li>
                <li>
                    <a href="{{env('APP_URL')}}team/attendance"
                        @if(Request::url()=='https://hr.pantheondigitals.com/team/attendance' )class="mm-active" @endif>
                        <i class="metismenu-icon pe-7s-users font-weight-bold"></i>
                        Attendance
                    </a>
                </li>
                <li>
                    <a href="{{env('APP_URL')}}team/leave"
                        @if(Request::url()=='https://hr.pantheondigitals.com/team/leave' )class="mm-active" @endif>
                        <i class="metismenu-icon pe-7s-users font-weight-bold"></i>
                        Leave
                    </a>
                </li>
                <li>
                    <a href="{{env('APP_URL')}}team/sales"
                        @if(Request::url()=='https://hr.pantheondigitals.com/team/sales' )class="mm-active" @endif>
                        <i class="metismenu-icon pe-7s-users font-weight-bold"></i>
                        Sales
                    </a>
                </li>

                @endif
            </ul>
        </div>
    </div>
</div>
<script>
 
</script>