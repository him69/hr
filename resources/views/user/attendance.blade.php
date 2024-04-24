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
            <div class="app-main__inner mt-5">
                <div class="container ">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-end">
                            <p class="h5 fw-bold text-end">My Attendance</p>
                        </div>
                        <div class=" ms-auto d-flex justify-content-end">
                            <form method="post">@csrf
                                <div class="d-flex justify-content-between  baseBtnbr rounded-2 my-2">

                                    <div class="">
                                        <input type="month" id="month" name="month" value="{{$date}}" class="form-control border-0 bg-transparent vsmatxt">
                                    </div>
                                    <button class="btn baseBtnBg w-100 m-1 py-0">
                                        <span class=""><i class="bi bi-search"></i></span>
                                    </button>
                                    <!-- <div class="col-8 baseBtnbr rounded-2 bg-white">
                                        <input type="month" name="month" value="{{$date}}" class="form-control border-0">
                                    </div>
                                    <div class="col-1">
                                        <button class="btn baseBtnBg ">
                                            <i class="bi bi-search" style="font-size: 20px; font-weight: 900 !important;"></i>
                                        </button>
                                    </div> -->
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row ">

                        <div class="col-12">
                            <div class="borderRadius baseShadow m-auto ">
                                <div class="row align-items-center p-3">
                                    <div class="col-xl-4 col-xxl-6 col-md-12">
                                    </div>
                                    <div class="col-xl-8 col-xxl-6 col-md-12">
                                        <div class="d-flex align-items-center justify-content-end ms-auto ">
                                            <div class="circle present m-2"></div>
                                            <p>Present</p>
                                            <div class="circle absent m-2"></div>
                                            <p>Absent</p>
                                            <div class="circle halfday m-2"></div>
                                            <p>Half Day</p>
                                            <div class="circle paid m-2"></div>
                                            <p>Leave</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    <table class="table table-striped">
                                        <thead style="background-color:#EEFAFB;">
                                            <th class="text-center">Mark</th>
                                            <th class="text-center">
                                                <p class="para fw-bold">Date</p> <span class="text-secondary fw-bold" style="font-size:13px;"> (DD / MM / YYYY) </span>
                                            </th>
                                            <th class="text-center">
                                                <p class="para fw-bold">Login Time</p><span class="text-secondary fw-bold" style="font-size:13px;"> (HH : MM) </span>
                                            </th>
                                            <th class="text-center">
                                                <p class="para fw-bold">Leaving Time</p> <span class="text-secondary fw-bold" style="font-size:13px;"> (HH : MM) </span>
                                            </th>
                                            @if($user->user_type == 1)
                                            <th class="text-center">
                                                <p class="para fw-bold">Total Time</p> <span class="text-secondary fw-bold" style="font-size:13px;">
                                                    (HH :
                                                    MM) </span>
                                            </th>
                                            <th class="text-center">
                                                <p class="para fw-bold">Sales / Customer</p>
                                                <span class="text-secondary fw-bold" style="font-size:13px;">&nbsp;</span>
                                            </th>
                                            @endif
                                            @if($user->user_type == 2)
                                            <th class="text-center">
                                                <p class="para fw-bold">Recording</p> <span class="text-secondary fw-bold" style="font-size:13px;">Number</span>
                                            </th>
                                            @endif
                                        </thead>
                                        @if(!empty($attendance))
                                        @foreach($attendance as $user_id => $att)
                                        @php($mte = 01)
                                        @foreach($att as $day => $at)
                                        @if(($day == 'Total_P') or ($day == 'Total_H') or ($day == 'Total_A'))
                                        @else
                                        @while($mte < $day) <?php $sd = $date . "-" . str_pad($mte, 2, "0", STR_PAD_LEFT);
                                                            $hddate = date_create($sd);
                                                            $hda = date_format($hddate, "Y-m-d");
                                                            $timestamp = strtotime('' . $sd . '');
                                                            $sday = date('D', $timestamp); ?> @if($sday=='Sun' ) <tr>
                                            <th class="text-center text-secondary smaTxt">
                                                <div class="halfday" style="color:#fff;">SUN</div>
                                            </th>
                                            <th class="text-center text-secondary smaTxt">
                                                <div class="w-100 text-center  smaTxt">
                                                    {{date('d-m-Y',strtotime($sd))}}
                                                </div>
                                            </th>
                                            <th class="text-center text-secondary smaTxt">SUN</th>
                                            <th class="text-center text-secondary smaTxt">SUN</th>
                                            @if($user->user_type == 1)
                                            <th class="text-center text-secondary smaTxt">SUN</th>
                                            <th class="text-center text-secondary smaTxt">SUN</th>
                                            @endif
                                            @if($user->user_type == 2)
                                            <th class="text-center text-secondary smaTxt">{{$at['recording']}}</th>
                                            @endif
                                            </tr>
                                            @elseif(App\Models\Holiday::where('hdate',$hda)->count() > 0)
                                            <tr>
                                                <th class="text-center text-secondary smaTxt">
                                                    <div class="present" style="color:#fff;">NH</div>
                                                </th>
                                                <th class="text-center text-secondary smaTxt">
                                                    <div class="w-100 text-center smaTxt">
                                                        {{date('d-m-Y',strtotime($sd))}}
                                                    </div>
                                                </th>
                                                <th class="text-center text-secondary smaTxt">NH</th>
                                                <th class="text-center text-secondary smaTxt">NH</th>
                                                @if($user->user_type == 1)
                                                <th class="text-center paidcolor smaTxt">NH</th>
                                                <th class="text-center text-secondary smaTxt">NH</th>
                                                @endif
                                            </tr>
                                            @elseif($hda > date('Y-m-d'))
                                            <tr>
                                                <th class="text-center text-secondary smaTxt">
                                                    <div class="absent" style="color:#fff;">A</div>
                                                </th>
                                                <th class="text-center text-secondary smaTxt">
                                                    <div class="w-100 text-center smaTxt">
                                                        {{date('d-m-Y',strtotime($sd))}}
                                                    </div>
                                                </th>
                                                <th class="text-center text-secondary smaTxt">A</th>
                                                <th class="text-center text-secondary smaTxt">A</th>
                                                @if($user->user_type == 1)
                                                <th class="text-center text-secondary smaTxt">A</th>
                                                <th class="text-center text-secondary smaTxt">A</th>
                                                @endif
                                            </tr>
                                            @else
                                            <tr>
                                                <th class="text-center text-secondary smaTxt">
                                                    <div class="absent" style="color:#fff;">A</div>
                                                </th>
                                                <th class="text-center text-secondary smaTxt">
                                                    <div class="w-100 text-center smaTxt">
                                                        {{date('d-m-Y',strtotime($sd))}}
                                                    </div>
                                                </th>
                                                <th class="text-center text-secondary smaTxt">A</th>
                                                <th class="text-center text-secondary smaTxt">A</th>
                                                @if($user->user_type == 1)
                                                <th class="text-center text-secondary smaTxt">A</th>
                                                <th class="text-center text-secondary smaTxt">A</th>
                                                @endif
                                            </tr>
                                            @endif
                                            @php($mte++)
                                            @endwhile
                                            @if($at['mark'] == 'Sun')
                                            <tr>
                                                <th class="text-center text-secondary smaTxt">
                                                    <div class="present" style="color:#fff;">SUN</div>
                                                </th>
                                                <th class="text-center text-secondary smaTxt">
                                                    <div class="w-100 text-center  smaTxt">
                                                        {{date("$day-$month-$year")}}
                                                    </div>
                                                </th>
                                                <th class="text-center text-secondary smaTxt">SUN</th>
                                                <th class="text-center text-secondary smaTxt">SUN</th>
                                                @if($user->user_type == 1)
                                                <th class="text-center  halfdaycolor smaTxt">SUN</th>
                                                <th class="text-center text-secondary smaTxt">SUN</th>
                                                @endif
                                                @if($user->user_type == 2)
                                                <th class="text-center text-secondary smaTxt">SUN</th>
                                                @endif
                                            </tr>
                                            @else
                                            <tr>
                                                <th class="text-center text-secondary">
                                                    <div class="@if($at['mark'] == 'P')present @elseif($at['mark'] == 'H') halfday @elseif($at['mark'] == 'A') absent @elseif($at['mark'] == 'PL') paid @elseif($at['mark'] == 'UPL') unpaid @else absent @endif" style="color:#fff;">{{$at['mark']}}</div>
                                                </th>
                                                <th class="text-center text-secondary">
                                                    <div class="w-100 text-center smaTxt"> {{date("$day-$month-$year")}}
                                                    </div>
                                                </th>
                                                <th class="text-center text-secondary smaTxt" style="@if(strtotime(" 11:15") < strtotime($at['login_time'])){{'color:red;'}}@endif">
                                                    {{$at['login_time']}}
                                                </th>
                                                <th class="text-center text-secondary smaTxt">{{$at['logout_time']}}
                                                </th>
                                                @if($user->user_type == 1)
                                                <th class="text-center text-secondary smaTxt">{{$at['nonpause']}}</th>
                                                <th class="text-center text-secondary smaTxt">{{$at['sale_made']}}/{{$at['customer']}}</th>
                                                @endif
                                                @if($user->user_type == 2)
                                                <th class="text-center text-secondary smaTxt">{{$at['recording']}}</th>
                                                @endif
                                            </tr>
                                            @endif
                                            @php($mte++)
                                            @endif
                                            @endforeach
                                            @endforeach
                                            @endif
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

@include('user.includes.footer')
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