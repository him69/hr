<style>
    li a {
        font-weight: 700;
    }

    .inputicon {
        font-size: 20px;
        color: #000;
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
</style>
<div class="app-sidebar" style="background:#4c4b46;">
    <div class="app-header__logo">
        <div class="logo-src"></div>
        <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>

            </div>
        </div>
    </div>
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
        <span>
            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                <span class="btn-icon-wrapper">
                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                </span>
            </button>
        </span>
    </div>
    <div class="w-100 ">
        <div class="app-sidebar__inner px-3">
            <div class="mt-4 align-items-center d-flex hamnav_desktop">
                <div class="d-flex align-items-center justify-content-center">
                    <p class="d-block text-decoration-none baseBtnBg bibr smaTxt p-1 m-1 lh-sm text-center rounded-circle bibr" id="ham_nav_icon" data-toggle="tooltip" data-placement="top" title="open/close">
                        <i class="fa-solid fa-bars"></i>
                    </p>
                </div>
                <div class=" d-flex align-items-center justify-content-center">
                    <a href="{{env('APP_URL')}}admin/index" class=" d-block text-decoration-none baseBtnBg bibr smaTxt p-1 m-1 lh-sm text-center rounded-circle bibr" data-toggle="tooltip" data-placement="top" title="Home">
                        <i class="bi bi-house-door-fill"></i>
                    </a>
                </div>
            </div>
            <ul class="vertical-nav-menu">
                <!-- <li class="my-2">
                  <a href="{{env('APP_URL')}}admin/index" class="@if(Request::url() == env('APP_URL').'admin/index') mm-active @endif align-items-center d-flex smaTxt">
                        <div
                        class="baseBtnBg bibr lh-sm text-center p-1 m-1 mr-2 smatxt rounded-circle d-flex text-white"><i class="bi bi-house-door "></i></div>
                        Home
                    </a>
                </li> -->
                <!--<l  i class="app-sidebar__heading" style="height: 25px; padding:auto;margin:5px;">Attendance & holidays</li>-->
                <li class="my-2">
                    <a href="{{env('APP_URL')}}admin/attendance" class="@if(Request::url() == env('APP_URL').'admin/attendance') mm-active @endif align-items-center d-flex smaTxt">
                        <div class="baseBtnBg bibr lh-sm text-center p-1 m-1 mr-2 smatxt rounded-circle d-flex text-white" data-toggle="tooltip" data-placement="top" title="Attendance"><i class="bi bi-person-check "></i></div>
                        <span class="l_text">Attendance</span>
                    </a>
                </li>
                <li class="my-2">
                    <a href="{{env('APP_URL')}}admin/salary" class="@if(Request::url() == env('APP_URL').'admin/salary') mm-active @endif align-items-center d-flex smaTxt">
                        <div class="baseBtnBg bibr lh-sm text-center p-1 m-1 mr-2 smatxt rounded-circle d-flex text-white" data-toggle="tooltip" data-placement="top" title="salary"><i class="bi bi-cash-coin "></i></div>
                        <span class="l_text">Salary</span>
                    </a>
                </li>
                <li class="my-2">
                    <a href="{{env('APP_URL')}}admin/leave" class="@if(Request::url() == env('APP_URL').'admin/leave') mm-active @endif align-items-center d-flex smaTxt">
                        <div class="baseBtnBg bibr lh-sm text-center p-1 m-1 mr-2 smatxt rounded-circle d-flex text-white" data-toggle="tooltip" data-placement="top" title="Leave"><i class="bi bi-door-open "></i></div>
                        <span class="l_text">Leave Requests</span>
                        @if(App\Models\Leave::where('approved',0)->count() > 0)
                        <svg height="8" width="8" class="blinking">
                            <circle cx="4" cy="4" r="4" fill="red"></circle>
                        </svg>
                        @endif
                    </a>
                </li>
                <li class="my-2">
                    <a href="{{env('APP_URL')}}admin/holiday" class="@if(Request::url() == env('APP_URL').'admin/holiday') mm-active @endif align-items-center d-flex smaTxt">
                        <div class="baseBtnBg bibr lh-sm text-center p-1 m-1 mr-2 smatxt rounded-circle d-flex text-white" data-toggle="tooltip" data-placement="top" title="Holiday"><i class="bi bi-tencent-qq "></i></div>
                        <span class="l_text">Holiday</span>
                    </a>
                </li>
                <!--<li class="app-sidebar__heading w-100 px-2 py-4">Users & Assets</li>-->
                <li class="my-2">
                    <a href="{{env('APP_URL')}}admin/users/create" class="@if(Request::url() == env('APP_URL').'admin/users/create') mm-active @endif align-items-center d-flex smaTxt">
                        <div class="baseBtnBg bibr lh-sm text-center p-1 m-1 mr-2 smatxt rounded-circle d-flex text-white" data-toggle="tooltip" data-placement="top" title="AddUser"><i class="bi bi-person-add "></i></div>
                        <span class="l_text">Add User</span>
                    </a>
                </li>
                <li class="my-2">
                    <a href="{{env('APP_URL')}}admin/users" class="@if(Request::url() == env('APP_URL').'admin/users') mm-active @endif align-items-center d-flex smaTxt">
                        <div class="baseBtnBg bibr lh-sm text-center p-1 m-1 mr-2 smatxt rounded-circle d-flex text-white" data-toggle="tooltip" data-placement="top" title="Users"><i class="bi bi-people "></i></div>
                        <span class="l_text">Users</span>
                    </a>
                </li>
                <li class="my-2">
                    <a href="{{env('APP_URL')}}admin/user-role" class="@if(Request::url() == env('APP_URL').'admin/user-role') mm-active @endif align-items-center d-flex smaTxt">
                        <div class="baseBtnBg bibr lh-sm text-center p-1 m-1 mr-2 smatxt rounded-circle d-flex text-white" data-toggle="tooltip" data-placement="top" title="Users"><i class="bi bi-people "></i></div>
                        <span class="l_text">User roles</span>
                    </a>
                </li>
                <li class="my-2">
                    <a href="{{env('APP_URL')}}admin/teams" class="@if(Request::url() == env('APP_URL').'admin/teams') mm-active @endif align-items-center d-flex smaTxt">
                        <div class="baseBtnBg bibr lh-sm text-center p-1 m-1 mr-2 smatxt rounded-circle d-flex text-white" data-toggle="tooltip" data-placement="top" title="Teams"><i class="fa-solid fa-users-line"></i></div>
                        <span class="l_text">Teams</span>
                    </a>
                </li>
                <li class="my-2">
                    <a href="{{env('APP_URL')}}admin/ass_ass" class="@if(Request::url() == env('APP_URL').'admin/ass_ass') mm-active @endif align-items-center d-flex smaTxt">
                        <div class="baseBtnBg bibr lh-sm text-center p-1 m-1 mr-2 smatxt rounded-circle d-flex text-white" data-toggle="tooltip" data-placement="bottom" title="Assets"><i class="bi bi-bag-plus "></i></div>
                        <span class="l_text">Assets Inventry</span>
                    </a>
                </li>
                <li class="my-2">
                    <a href="{{env('APP_URL')}}admin/onboard/add_candidate" class="@if(Request::url() == env('APP_URL').'admin/onboard/add_candidate') mm-active @endif align-items-center d-flex smaTxt">
                        <div class="baseBtnBg bibr lh-sm text-center p-1 m-1 mr-2 smatxt rounded-circle d-flex text-white" data-toggle="tooltip" data-placement="top" title="AddCandidate"><i class="bi bi-person-plus "></i></div>
                        <span class="l_text">Add Candidate</span>
                    </a>
                </li>
                <li class="my-2">
                    <a href="{{env('APP_URL')}}admin/onboard/candidate" class="@if(Request::url() == env('APP_URL').'admin/onboard/candidate') mm-active @endif align-items-center d-flex smaTxt">
                        <div class="baseBtnBg bibr lh-sm text-center p-1 m-1 mr-2 smatxt rounded-circle d-flex text-white" data-toggle="tooltip" data-placement="top" title="Candidate’sInfo"><i class="bi bi-journal-text "></i></div>
                        <span class="l_text">Candidate’s Info</span>
                    </a>
                </li>
                <li class="my-2">
                    <a href="{{env('APP_URL')}}admin/create_offer" class="@if(Request::url() == env('APP_URL').'admin/create_offer') mm-active @endif align-items-center d-flex smaTxt">
                        <div class="baseBtnBg bibr lh-sm text-center p-1 m-1 mr-2 smatxt rounded-circle d-flex text-white" data-toggle="tooltip" data-placement="top" title="Create letters"><i class="bi bi-person-vcard "></i></div>
                        <span class="l_text">Create letters</span>
                    </a>
                </li>
                <li class="my-2">
                    <a href="{{env('APP_URL')}}admin/policies" class="@if(Request::url() == env('APP_URL').'admin/policies') mm-active @endif align-items-center d-flex smaTxt">
                        <div class="baseBtnBg bibr lh-sm text-center p-1 m-1 mr-2 smatxt rounded-circle d-flex text-white" data-toggle="tooltip" data-placement="top" title="Policies"><i class="fa-regular fa-file-lines"></i></div>
                        <span class="l_text">Policies</span>
                    </a>
                </li>
                <li class="my-2">
                    <a href="{{env('APP_URL')}}admin/ticket" class="@if(Request::url() == env('APP_URL').'admin/ticket') mm-active  bg-warning @endif align-items-center d-flex smaTxt">
                        <div class="baseBtnBg bibr text-warning lh-sm text-center p-1 m-1 mr-2 smatxt rounded-circle d-flex text-white" data-toggle="tooltip" data-placement="top" title="Issue Ticket"><i class="bi bi-exclamation-diamond "></i></div>
                        <span class="text-warning">Issue Ticket</span>

                    </a>
                </li>
                <li class="my-2">
                    <a href="{{env('APP_URL')}}admin/announcement" class="@if(Request::url() == env('APP_URL').'admin/announcement') mm-active bg-warning @endif align-items-center d-flex smaTxt">
                        <div class="baseBtnBg bibr text-warning lh-sm text-center p-1 m-1 mr-2 smatxt rounded-circle d-flex text-white" data-toggle="tooltip" data-placement="top" title="Announcement"><i class="fa-solid fa-bullhorn"></i></div>
                        <span class="text-warning">Announcement</span>

                    </a>
                </li>
                <li class="my-2">
                    <a href="{{env('APP_URL')}}admin/grants" class="@if(Request::url() == env('APP_URL').'admin/grants') mm-active bg-warning @endif align-items-center d-flex smaTxt">
                        <div class="baseBtnBg bibr text-warning lh-sm text-center p-1 m-1 mr-2 smatxt rounded-circle d-flex text-white" data-toggle="tooltip" data-placement="top" title="Announcement"><i class="fa-solid fa-bullhorn"></i></div>
                        <span class="text-warning">grants</span>

                    </a>
                </li>
        </div>
    </div>
</div>
<script>
    document.getElementById('ham_nav_icon').addEventListener('click', function() {
        // Toggle 'close' class for the sidebar
        var sidebar = document.querySelector('.app-sidebar');
        sidebar.classList.toggle('close');

        // Toggle 'close' class for the header
        var header = document.querySelector('.app-header');
        header.classList.toggle('close');

        // Toggle 'collapse' class for the main content
        var mainContent = document.querySelector('.app-main__outer');
        mainContent.classList.toggle('collapse');
    });
</script>