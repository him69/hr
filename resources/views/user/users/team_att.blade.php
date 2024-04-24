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
        <style>
            .table-bordered th,
            .table-bordered td {
                border: 1px solid #d1d1d1;
            }

            tbody tr:first-child {
                background-color: #EEFAFB !important;
            }

            .table-bordered>:not(caption)>* {
                border-width: 0px 0;
            }

            .blinking-dot {
                height: 10px;
                width: 10px;
                border-radius: 50%;
                background-color: #009aff;
                display: inline-block;
                margin-left: 5px;
                animation: blink-animation 1s infinite;
            }

            @keyframes blink-animation {
                0% {
                    opacity: 1;
                }

                50% {
                    opacity: 0;
                }

                100% {
                    opacity: 1;
                }
            }
        </style>
        <div class="app-main__outer table-responsive">
            <div class="app-main__inner ">

                <!-- <ul class="body-tabs body-tabs-layout tabs-animated body-tabs-animated nav">
                    <li class="nav-item">
                        <form method="post">
                            @csrf
                            <div class="row m-0  align-items-center bg-white  rounded-2">
                                <div class="col-6 p-0">
                                    <input type="month" id="month" value="{{$date}}" class="form-control border-0">
                                </div>
                                <div class="col-6 p-0">
                                    <button class="btn baseBtnBg w-100">
                                        <span style="color: #fff;">Search by month</span>
                                    </button>
                                </div>
                            </div>
                            
                        </form>
                    </li>
                </ul>  -->

                <div class="row ">
                    <div class="col-md-12">
                        <div class="d-flex">
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

                        <div class="table-responsive fixed-cols bg-white p-2">
                            <table class="table table-bordered">
                                <tr>
                                    <th>
                                        Name
                                    </th>
                                    <th style=min-width:40px;>
                                        <p style=min-width:40px;>Sale Done</p>
                                    </th>
                                    <!-- <th style=min-width:30px;>
                                        <p style=min-width:30px;>Leads</p>
                                    </th> -->
                                    <?php
                                    $numDays = cal_days_in_month(CAL_GREGORIAN, $month, $year); // Number of days in the specified month
                                    for ($i = 1; $i <= $numDays; $i++) {
                                        $timestamp = mktime(0, 0, 0, $month, $i, $year);
                                        $date = date('Y-m-d', $timestamp);
                                        $day = date('D', $timestamp);
                                        echo "<th class='px-0' style='min-width:30px;'><p class='vsmatxt text-center' style=min-width:30px;'> $day </p> <p class='vsmatxt text-center'> $i  </p></th>";
                                    } ?>
                                </tr>
                                @php($serial = 1)
                                @foreach($attendance as $userId => $user_attendance)
                                <tr>
                                    <td>
                                        <div class="d-flex fw-bold d-flex align-items-center">
                                            <span class='vsmatxt'>{{$serial}}.</span> <a class="smaTxt text-black mx-1" href="{{env('APP_URL').'admin/attendance/full_report/'.$user_attendance['id']}}">{{$userId}}</a>
                                        </div>
                                    </td>
                                    <td class="text-center px-2 py-1 vsmatxt">{{$user_attendance['sale_done']}}</td>
                                    <!-- <td class="text-center px-2 py-1 vsmatxt">{{$user_attendance['target']['leadtarg']}}</td> -->

                                    @for($mte = 1; $mte <= $numDays; $mte++) <?php
                                                                                $dayKey = sprintf('%02d', $mte);
                                                                                $currentDateStr = sprintf('%s-%02d-%02d', $year, $month, $mte);
                                                                                $dayOfWeek = date('D', strtotime($currentDateStr));
                                                                                $todayStr = date('Y-m-d');
                                                                                $isFutureDate = strtotime($currentDateStr) > strtotime($todayStr);
                                                                                $mark = $user_attendance[$dayKey] ?? 'A';
                                                                                $allowedFutureMarks = ['NH', 'UPL', 'HPL', 'PL', 'H'];
                                                                                if ($isFutureDate && !in_array($mark, $allowedFutureMarks)) {
                                                                                    $mark = '-';
                                                                                }
                                                                                ?> @if($dayOfWeek=='Sun' ) <td class="text-center  vsmatxt text-white bg-light" style="height:28px;width:30px;">
                                        <p class="rounded text-muted"> - </p>
                                        </td>
                                        @elseif($isFutureDate && $mark === '-')
                                        <td class="text-center  vsmatxt text-white " style="height:28px;width:30px;">
                                            <p class="rounded text-muted"> - </p>
                                        </td>
                                        @else
                                        <td class="text-center px-1 py-2  vsmatxt text-white" style="height:28px;min-width:30px; {{ $mark == 'P' ? 'background:green;' : ($mark == 'NH' ? 'background:#0067ff;' :  ($mark == 'HPL' ? 'background:#7c7e7f;' :  ($mark == 'H' ? 'background:#7c7e7f;' : ($mark == 'LI' ? 'background:#009aff88;' : ($mark == 'PL' ? 'background:#08463f;' : ($mark == 'UPL' ? 'background:#EF4336;' : ($mark == 'A' ? 'background:#B33F40;' : 'background:none;'))))))) }};">
                                            <p class="rounded" style="min-width:30px;">
                                                {{ $mark }}
                                                <!-- blinking dot  -->
                                                @if($mark == 'LI')
                                                <span class="blinking-dot"></span>
                                                @endif
                                            </p>
                                        </td>
                                        @endif
                                        @endfor



                                </tr>
                                @php($serial++)
                                @endforeach
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