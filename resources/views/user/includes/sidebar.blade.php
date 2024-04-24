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

    .navBox {
        border: 1px solid white;
        border-right: none;
    }

    .bgnav {
        background: #EEFAFB;
    }

    .txtnav {
        color: #EEFAFB;
    }
    .app-sidebar.close .username{
opacity: 0;
transition: all .3s ease-in-out;
    }
    .app-sidebar:not(.close) .username{
opacity: 1;
transition: all .3s ease-in-out;
    }
    .app-sidebar.close .profileIcon{
display: block;

    }
    .app-sidebar:not(.close) .profileIcon{
display: none;

    }
    .app-sidebar.close .addtional{
text-align: center;
    }
</style>
<div class="app-sidebar sidebar-shadow" style="background: #4c4b46;">
    <div class="scrollbar-sidebar" style="overflow:auto;">
        <div class="app-sidebar__inner px-3">
            <div class="mt-4 align-items-center d-flex hamnav_desktop">
                <div class="d-flex align-items-center justify-content-center">
                    <p class="d-block text-decoration-none text-white bibr smaTxt p-1 m-1 lh-sm text-center rounded-circle bibr" id="ham_nav_icon" data-toggle="tooltip" data-placement="top" title="open/close">
                        <i class="fa-solid fa-bars"></i>
                    </p>
                </div>
                <a href="{{env('APP_URL')}}profile" class="profileIcon baseBtnBg lh-sm text-center p-1 m-1 smatxt rounded-circle text-white">
                        <i class="fa-solid fa-user"></i>
                    </a>
                <div class="mx-2 txtnav l_text username">
                    {{$user->name}}
                </div>
                
            </div>
            
            <ul class="vertical-nav-menu mt-4">

                <li class="my-2">
                    <a href="{{env('APP_URL')}}user" class="@if(Request::url() == env('APP_URL') . 'user') {{'mm-active'}} @endif align-items-center d-flex smaTxt">
                        <div class="baseBtnBg bibr lh-sm text-center p-1 m-1 smatxt rounded-circle d-flex text-white">
                            <i class="bi bi-house-door "></i>
                        </div>
                        <div class="mx-2 txtnav l_text">Home</div>
                    </a>
                </li>
                <li class="my-2">
                    <a href="{{env('APP_URL')}}attendance" class="@if(Request::url() == env('APP_URL') . 'attendance') {{'mm-active'}} @endif align-items-center d-flex smaTxt">
                        <div class="baseBtnBg bibr lh-sm text-center p-1 m-1 smatxt rounded-circle d-flex text-white"><i class="bi bi-person-check"></i>
                        </div>
                        <div class="mx-2 txtnav l_text">My Attendance</div>

                    </a>
                </li>
                <li class="my-2">
                    <a href="{{env('APP_URL')}}leave" class="@if(Request::url() == env('APP_URL') . 'leave') {{'mm-active'}} @endif align-items-center d-flex smaTxt">
                        <div class="baseBtnBg bibr lh-sm text-center p-1 m-1 smatxt rounded-circle d-flex text-white"><i class="bi bi-person-workspace"></i>
                        </div>
                        <div class="mx-2 txtnav l_text">Leave</div>
                    </a>
                </li>
                <li class="my-2">
                    <a href="{{env('APP_URL')}}holiday" class="@if(Request::url() == env('APP_URL') . 'holiday') {{'mm-active'}} @endif align-items-center d-flex smaTxt">
                        <div class="baseBtnBg bibr lh-sm text-center p-1 m-1 smatxt rounded-circle d-flex text-white"><i class="bi bi-tencent-qq "></i>
                        </div>
                        <div class="mx-2 txtnav l_text">Holiday</div>
                    </a>
                </li>
                <li class="my-2">
                    <a href="{{env('APP_URL')}}request_for_leave" class="@if(Request::url() == env('APP_URL') . 'request_for_leave') {{'mm-active'}} @endif align-items-center d-flex smaTxt">
                        <div class="baseBtnBg bibr lh-sm text-center p-1 m-1 smatxt rounded-circle d-flex text-white"><i class="bi bi-door-open"></i>
                        </div>
                        <div class="mx-2 txtnav l_text"> Request For Leave</div>

                    </a>
                </li>
                <li class="my-2">
                    <a href="{{env('APP_URL')}}general_info" class="@if(Request::url() == env('APP_URL') . 'general_info') {{'mm-active'}} @endif align-items-center d-flex smaTxt">
                        <div class="baseBtnBg bibr lh-sm text-center p-1 m-1 mr-2 smatxt rounded-circle d-flex text-white"><i class="bi bi-file-text"></i>
                        </div>
                        <div class="mx-2 txtnav l_text "> Company Policy</div>
                    </a>
                </li>
                @if($user->user_type == 4)
                <li class="my-2">
                    <a href="{{env('APP_URL')}}wfh" class="@if(Request::url() == env('APP_URL') . 'wfh') {{'mm-active'}} @endif align-items-center d-flex smaTxt">
                        <div class="bibr lh-sm text-center p-1 m-1 smatxt rounded-circle d-flex @if(Request::url()==env('APP_URL') . 'wfh' ) text-white baseBtnBg @else bgnav cttext @endif"><i class="bi bi-file-text"></i>
                        </div>
                        <div class="mx-2 txtnav l_text">Work from home</div>
                    </a>
                </li>
                @endif
                @if($user->lead == 1)
                <li class="text-white fw-bold addtional">Team</li>
                <li class="my-2">
                    <a href="{{env('APP_URL')}}team/attendance" class="@if(Request::url() == env('APP_URL') . 'team/attendance') {{'mm-active'}} @endif align-items-center d-flex smaTxt">
                        <div class="baseBtnBg bibr lh-sm text-center p-1 m-1 mr-2 smatxt rounded-circle d-flex text-white"><i class="bi bi-file-text"></i>
                        </div>
                        <div class="mx-2 txtnav l_text">Attendance</div>
                    </a>
                </li>
                <li class="my-2">
                    <a href="{{env('APP_URL')}}team/leave" class="@if(Request::url() == env('APP_URL') . 'team/leave') {{'mm-active'}} @endif align-items-center d-flex smaTxt">
                        <div class="baseBtnBg bibr lh-sm text-center p-1 m-1 mr-2 smatxt rounded-circle d-flex text-white"><i class="bi bi-file-text"></i>
                        </div>
                        <div class="mx-2 txtnav l_text">leave</div>
                    </a>
                </li>
                @endif
                @if($user->permission )
                <li class="text-white fw-bold addtional" >Gransts</li>
                <?php
                $grants = explode(',', $user->permission);
                ?>
                @if(in_array(13,$grants))
                <li class="my-2">
                    <a href="{{env('APP_URL')}}adper/index" class="@if(Request::url() == env('APP_URL').'adper/index') mm-active @endif align-items-center d-flex smaTxt">
                        <div class="baseBtnBg bibr lh-sm text-center p-1 m-1 mr-2 smatxt rounded-circle d-flex text-white" data-toggle="tooltip" data-placement="top" title="Attendance"><i class="bi bi-person-check "></i></div>
                        <span class="l_text">Dashboard</span>
                    </a>
                </li>
                @endif
                @if(in_array(1,$grants))
                <li class="my-2">
                    <a href="{{env('APP_URL')}}adper/attendance" class="@if(Request::url() == env('APP_URL').'adper/attendance') mm-active @endif align-items-center d-flex smaTxt">
                        <div class="baseBtnBg bibr lh-sm text-center p-1 m-1 mr-2 smatxt rounded-circle d-flex text-white" data-toggle="tooltip" data-placement="top" title="Attendance"><i class="bi bi-person-check "></i></div>
                        <span class="l_text">Attendance</span>
                    </a>
                </li>
                @endif
                
                @if(in_array(2,$grants))
                <li class="my-2">
                    <a href="{{env('APP_URL')}}adper/salary" class="@if(Request::url() == env('APP_URL').'adper/salary') mm-active @endif align-items-center d-flex smaTxt">
                        <div class="baseBtnBg bibr lh-sm text-center p-1 m-1 mr-2 smatxt rounded-circle d-flex text-white" data-toggle="tooltip" data-placement="top" title="salary"><i class="bi bi-cash-coin "></i></div>
                        <span class="l_text">Salary</span>
                    </a>
                </li>
                @endif
                @if(in_array(3,$grants))
                <li class="my-2">
                    <a href="{{env('APP_URL')}}adper/leave" class="@if(Request::url() == env('APP_URL').'adper/leave') mm-active @endif align-items-center d-flex smaTxt">
                        <div class="baseBtnBg bibr lh-sm text-center p-1 m-1 mr-2 smatxt rounded-circle d-flex text-white" data-toggle="tooltip" data-placement="top" title="Leave"><i class="bi bi-door-open "></i></div>
                        <span class="l_text">Leave Requests</span>
                        @if(App\Models\Leave::where('approved',0)->count() > 0)
                        <svg height="8" width="8" class="blinking">
                            <circle cx="4" cy="4" r="4" fill="red"></circle>
                        </svg>
                        @endif
                    </a>
                </li>
                @endif
                @if(in_array(4,$grants))
                <li class="my-2">
                    <a href="{{env('APP_URL')}}adper/holiday" class="@if(Request::url() == env('APP_URL').'adper/holiday') mm-active @endif align-items-center d-flex smaTxt">
                        <div class="baseBtnBg bibr lh-sm text-center p-1 m-1 mr-2 smatxt rounded-circle d-flex text-white" data-toggle="tooltip" data-placement="top" title="Holiday"><i class="bi bi-tencent-qq "></i></div>
                        <span class="l_text">Holiday</span>
                    </a>
                </li>
                @endif
                @if(in_array(5,$grants))
                <li class="my-2">
                    <a href="{{env('APP_URL')}}adper/users" class="@if(Request::url() == env('APP_URL').'adper/users') mm-active @endif align-items-center d-flex smaTxt">
                        <div class="baseBtnBg bibr lh-sm text-center p-1 m-1 mr-2 smatxt rounded-circle d-flex text-white" data-toggle="tooltip" data-placement="top" title="Users"><i class="bi bi-people "></i></div>
                        <span class="l_text">Users</span>
                    </a>
                </li>
                @endif
                @if(in_array(6,$grants))
                <li class="my-2">
                    <a href="{{env('APP_URL')}}adper/teams" class="@if(Request::url() == env('APP_URL').'adper/teams') mm-active @endif align-items-center d-flex smaTxt">
                        <div class="baseBtnBg bibr lh-sm text-center p-1 m-1 mr-2 smatxt rounded-circle d-flex text-white" data-toggle="tooltip" data-placement="top" title="Teams"><i class="fa-solid fa-users-line"></i></div>
                        <span class="l_text">Teams</span>
                    </a>
                </li>
                @endif
                @if(in_array(7,$grants))
                <li class="my-2">
                    <a href="{{env('APP_URL')}}adper/users/create" class="@if(Request::url() == env('APP_URL').'adper/users/create') mm-active @endif align-items-center d-flex smaTxt">
                        <div class="baseBtnBg bibr lh-sm text-center p-1 m-1 mr-2 smatxt rounded-circle d-flex text-white" data-toggle="tooltip" data-placement="top" title="AddUser"><i class="bi bi-person-add "></i></div>
                        <span class="l_text">Add User</span>
                    </a>
                </li>
                @endif
                @if(in_array(8,$grants))
                <li class="my-2">
                    <a href="{{env('APP_URL')}}adper/ass_ass" class="@if(Request::url() == env('APP_URL').'adper/ass_ass') mm-active @endif align-items-center d-flex smaTxt">
                        <div class="baseBtnBg bibr lh-sm text-center p-1 m-1 mr-2 smatxt rounded-circle d-flex text-white" data-toggle="tooltip" data-placement="bottom" title="Assets"><i class="bi bi-bag-plus "></i></div>
                        <span class="l_text">Assets Inventry</span>
                    </a>
                </li>
                @endif
                @if(in_array(9,$grants))
                <li class="my-2">
                    <a href="{{env('APP_URL')}}adper/create_offer" class="@if(Request::url() == env('APP_URL').'adper/create_offer') mm-active @endif align-items-center d-flex smaTxt">
                        <div class="baseBtnBg bibr lh-sm text-center p-1 m-1 mr-2 smatxt rounded-circle d-flex text-white" data-toggle="tooltip" data-placement="top" title="Create letters"><i class="bi bi-person-vcard "></i></div>
                        <span class="l_text">Create letters</span>
                    </a>
                </li>
                @endif
                @if(in_array(10,$grants))
                <li class="my-2">
                    <a href="{{env('APP_URL')}}adper/policies" class="@if(Request::url() == env('APP_URL').'adper/policies') mm-active @endif align-items-center d-flex smaTxt">
                        <div class="baseBtnBg bibr lh-sm text-center p-1 m-1 mr-2 smatxt rounded-circle d-flex text-white" data-toggle="tooltip" data-placement="top" title="Policies"><i class="fa-regular fa-file-lines"></i></div>
                        <span class="l_text">Policies</span>
                    </a>
                </li>
                @endif
                @if(in_array(11,$grants))
                <li class="my-2">
                    <a href="{{env('APP_URL')}}adper/ticket" class="@if(Request::url() == env('APP_URL').'adper/ticket') mm-active  bg-warning @endif align-items-center d-flex smaTxt">
                        <div class="baseBtnBg bibr text-warning lh-sm text-center p-1 m-1 mr-2 smatxt rounded-circle d-flex text-white" data-toggle="tooltip" data-placement="top" title="Issue Ticket"><i class="bi bi-exclamation-diamond "></i></div>
                        <span class="text-warning">Issue Ticket</span>

                    </a>
                </li>
                @endif
                @if(in_array(12,$grants))
                <li class="my-2">
                    <a href="{{env('APP_URL')}}adper/announcement" class="@if(Request::url() == env('APP_URL').'adper/announcement') mm-active bg-warning @endif align-items-center d-flex smaTxt">
                        <div class="baseBtnBg bibr text-warning lh-sm text-center p-1 m-1 mr-2 smatxt rounded-circle d-flex text-white" data-toggle="tooltip" data-placement="top" title="Announcement"><i class="fa-solid fa-bullhorn"></i></div>
                        <span class="text-warning">Announcement</span>

                    </a>
                </li>
                @endif
                @endif
            </ul>
            <!--<div class="my-2 d-flex align-items-center justify-content-center">-->
            <!--    <a href="{{env('APP_URL')}}ticket" class="rounded-pill p-1 px-2 smatxt text-center cttext fw-bold" style="background-color:#FFD700;">Raise a issue-->
            <!--    </a>-->
            <!--</div>-->
        </div>
    </div>
</div>
<script>

</script>