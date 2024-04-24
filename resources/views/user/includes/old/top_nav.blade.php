<div class="app-header header-shadow">
    <div class="app-header__logo">
        <div><b>PANTHEON DIGITAL</b></div>
        <!-- <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger "
                    data-class="">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div> -->
    </div>

    <div class="app-header__content justify-content-end">
        <!-- profile icon for easy access -->
        <div class="rounded-circle" style="    overflow: hidden;
    height: 50px;
    width: 50px;">
            <a href="{{env('APP_URL')}}profile" @if(Request::url()== env('APP_URL').'profile' )
                class="mm-active" @endif>
                <img src="{{env('APP_URL')}}public/uploads/{{$user->photo}}"
                    alt="" style="height:100%; width:100%; object-fit:cover ;">
            </a>
        </div>
        <div class="app-header-right m-0 ms-2">
            <div class="header-btn-lg pr-0">
                <div class="widget-content p-0">
                    <div class="widget-content-wrapper">
                        <div class="widget-content-left">
                            <ul class="header-menu nav">
                                <li class="btn-group nav-item align-items-center" data-toggle="modal" data-target="#logout">
                                    
                                        <i class="nav-link-icon fa fa-power-off mx-1"></i>
                                        Logout
                                    
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="logout" tabindex="-1" data-backdrop="static" aria-labelledby="assetsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header flex-column bg-white SubHeding border-0">
                <!-- <div class=" align-self-end pe-7s-close" data-dismiss="modal" aria-label="Close"></div> -->
                <h5 class="modal-title text-center fontBold m-auto" id="assetsModalLabel">
                    are you really want to log out ?
                </h5>

            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-around">
                    
                    <div class="border border-warning rounded p-2 px-3">  <a href="{{env('APP_URL')}}logout"> yes</div></a>
                    <div class=" border border-danger rounded p-2 px-3" data-dismiss="modal" aria-label="Close">
                         No
                      </div>

                </div>
            </div>
        </div>
    </div>
</div>