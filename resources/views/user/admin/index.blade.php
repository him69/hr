@include("admin.includes.header")
<!-- <link rel="stylesheet" href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css"> -->
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/3.6.95/css/materialdesignicons.css"> -->
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" /> -->
<div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
    <style>
        .app-header.justify-content-center.close {
            z-index: 9 !important;
        }
    </style>
    @include("user.includes.top_nav")
    <div class="ui-theme-settings">
        <div class="theme-settings__inner">
            <div class="scrollbar-container">

            </div>
        </div>
    </div>
    <div class="app-main">
        @include("user.includes.sidebar")
        <style>
            .dglo::-webkit-scrollbar {
                display: none;
            }

            .dglo {
                -ms-overflow-style: none;
                /* IE and Edge */
                scrollbar-width: none;
                /* Firefox */
                overflow-y: scroll;
                cursor: pointer;
                touch-action: pan-left;
            }

            p.my-2.dotb::before {
                content: "";
                height: 5px;
                width: 5px;
                background: #4c4b46;
                border-radius: 50%;
                position: absolute;
                top: 50%;
                left: 0;
                transform: translateY(-50%);
            }

            .collapse.show#target {
                height: 400px;
                transition: all .3s ease-in-out;
            }
        </style>
        <div class="app-main__outer collapse">
            <div class="app-main__inner">
                <div class="row">
                    <!-- top elements -->
                    <div class="col-3 mb-3">
                        <div class="bg-white p-3 d-flex align-items-center  ">
                            <div class="rounded-circle border bg-white d-flex justify-content-center align-items-center overflow-hidden" style="width: 53px;height: 53px;">
                                <i class="fa-solid fa-user-tie fs-4"></i>
                                <!-- <img src="https://img.etimg.com/thumb/msid-91490308,width-650,height-488,imgsize-101880,resizemode-75/sonali-bendre.jpg" alt="" style="height: 100%; width:100%;object-fit:cover;"> pade rhene do jab user role add honge tab dekhenge -->
                            </div>
                            <div class="mx-2">
                                <p class="fw-bold">{{$user->username}}</p>
                                <p class="vsmatxt">Human resources Maneger</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 mb-3">
                        <div class="bg-white p-3">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-0">Today's Login</h6>
                                <p>{{$todayactive}}</p>
                            </div>
                            <div class="d-flex justify-content-between my-2">
                                <p class="vsmatxt fw-bold">Sales : <span class="mx-2 px-2 bg-light">{{$saleatt}}</span></p>
                                <p class="vsmatxt fw-bold">IT :<span class="mx-2 px-2 bg-light">{{$itatt}}</span></p>
                                <p class="vsmatxt fw-bold">QA :<span class="mx-2 px-2 bg-light">{{$qaatt}}</span></p>
                                <p class="vsmatxt fw-bold">HR :<span class="mx-2 px-2 bg-light">{{$hratt}} </span></p>
                            </div>
                        </div>
                    </div>
                    @if($todayleave->count() > 0)
                    <div class="col-5 mb-3  overflow-hidden">
                        <div class="bg-white p-3">
                            <div class="d-flex justify-content-between">
                                <h6>People On Leave</h6>
                                <p><a href="#">view</a></p>
                            </div>
                            <div class="overflow-hidden mt-1">
                                <div class="d-flex overflow-auto dglo justify-content-between">
                                    @foreach($todayleave as $tl)
                                    <p class="badge rounded-pill text-bg-light  " style="min-width: auto;">{{$tl->name}}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="px-3 mb-3">
                        <hr class="m-0">
                    </div>
                    <!-- filletres -->
                    <!-- <i class="fa-solid fa-filter"></i> -->
                    <div class="d-flex justify-content-between align-items-center ">
                        <div class=" ">
                            <!-- department come here-  -->
                            <!-- not yet neccessary -->
                            <!-- <div class="p-2 bg-white d-flex align-items-center  border border-black overflow-hidden rounded-1">
                                <p class="Vsmall"><i class="fa-solid fa-filter mx-2" style="color: #4c4b46 !important;"></i> Fillter By:-</p>
                                <form method="GET" action="">
                                    <select class="border-0 w-100 bg-white p-1 Vsmall text-capitalize" onchange="this.form.submit()" name="teams">
                                        <option class="Vsmall text-capitalize" value="0" selected="">Department</option>
                                        <option value="0" class="Vsmall text-capitalize">all
                                        </option>
                                        <option value="1" class="Vsmall text-capitalize">sales
                                        </option>
                                        <option value="2" class="Vsmall text-capitalize">qa
                                        </option>
                                        <option value="3" class="Vsmall text-capitalize">hr
                                        </option>
                                        <option value="4" class="Vsmall text-capitalize">it
                                        </option>
                                        <option value="7" class="Vsmall text-capitalize">marketing
                                        </option>
                                        <option value="8" class="Vsmall text-capitalize">social media
                                        </option>
                                        <option value="9" class="Vsmall text-capitalize">sale
                                        </option>
                                    </select>
                                </form>
                                </div> -->
                        </div>

                    </div>
                    <!-- collapse widget part -->
                    <div class="col-12 col-md-4" >
                        <!-- sale circle chart -->
                        <div class="position-relative bg-white p-3">
                            <div class="d-flex justify-content-between">
                                <p class="h6 fw-bold">Sale Complete</p>
                                <a data-bs-toggle="collapse" href="#target" role="button" aria-expanded="false" aria-controls="target">
                                <i class="fa-solid fa-plus"></i>
                                </a>
                            </div>
                            <div class="collapse show" id="target">
                                <canvas id="previousChart" style="height: 300px; width:300px"></canvas>
                                <div class="position-absolute top-50 start-50" style="transform: translate(-50%,-50%);">
                                    <div class="js-count text-center">
                                        <p class="h6 fw-bold">Sales Agreegated</p>
                                        {{$monthtarget}} / {{$target}}<br>{{($monthtarget*100)/$target}}%
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- top asd last employee -->

                        <div class="p-3 bg-white my-3">
                            <div class="d-flex justify-content-between">
                                <p class="smText fontmed">Top 5 Employees</p>
                                <a data-bs-toggle="collapse" href="#emp5" role="button" aria-expanded="false" aria-controls="emp5">
                                <i class="fa-solid fa-plus"></i>
                                </a>
                            </div>
                            <div class="collapse " id="emp5">


                                <div class="overflow-hidden">
                                    <div class="px-2 py-2 text-primary">
                                        @php($i = 1)
                                        @foreach($usersale as $k => $as)
                                        <?php
                                        $ka = App\Models\User::where('id', $k)->get();
                                        if ($ka->count() > 0) {
                                            $ka = $ka[0];
                                        ?>
                                            <div class="row py-2 border-bottom border-2 border-start-0 border-end-0 border-top-0">
                                                <div class="col-8 d-flex justify-content-between border-0 smaTxt ">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <i class="fa-solid fa-medal mx-1"></i>
                                                        <a href="{{env('APP_URL')}}adper/attendance/full_report/{{$ka->id}}">
                                                            <p class="m-0 vsmatxt fontmed">{{$ka->user_id}}</p>
                                                        </a>
                                                    </div>
                                                    <span>:</span>
                                                </div>
                                                <span class="m-0 col-4 fontmed vsmatxt">{{$as}}</span>
                                            </div>
                                            @if($i == 5)<?php break; ?>@endif
                                            @php($i++)
                                        <?php } ?>
                                        @endforeach
                                    </div>
                                    <div class="borderRadius p-2 mt-3">
                                        <p class="smText text-center fw-bold " style="border-bottom: 2px solid white;">
                                            Employee with no sales</p>
                                        <div class="row">
                                            @php($i = 1)<?php $zusersale = $usersale;
                                                        asort($zusersale); ?>
                                            @foreach($zusersale as $k => $as)
                                            <?php
                                            $ka = App\Models\User::where('id', $k)->get();
                                            if ($ka->count() > 0) {
                                                $ka = $ka[0];
                                            ?>
                                                <div class="col-4 text-start smText">
                                                    <a href="{{env('APP_URL')}}adper/attendance/full_report/{{$ka->id}}"><span class="m-0 vsmatxt fontmed">{{$ka->user_id}}</span></a>
                                                </div>
                                                @if($i == 6)<?php break; ?>@endif
                                                @php($i++)
                                                <?php } ?>@endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-around ">
                                    <a href="{{env('APP_URL')}}/adper/attendance" class="col-6 d-flex justify-content-between align-items-center baseBtnBg rounded p-2 my-2">
                                        <span>View Attendance</span> <span class="bg-white smbr cttext rounded-circle text-center lh-sm"><i class="fa-solid fa-angle-right"></i></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-8">
                        <div class=" bg-white">
                            <div class="row">

                            </div>
                            <div class=" p-3">
                                <div class="d-flex justify-content-between">
                                    <p class="h6 fw-bold">{{$ym}} sale analysis</p>
                                    <div class="">
                                        <form>
                                            <div class="d-flex justify-content-between  baseBtnbr rounded-2 my-2">
                                                <div class="">
                                                    <input type="month" name="month" id="month" value="{{$ym}}" class="form-control border-0 bg-transparent vsmatxt">
                                                </div>
                                                <button class="btn baseBtnBg w-100 m-1 py-0">
                                                    <span class=""><i class="bi bi-search"></i></span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div class="m-auto" style="width: 100%;">
                                    <div class="line-chart">
                                        <div class="aspect-ratio">
                                            <canvas id="chart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <!-- team stats -->
                            <?php $num = 0 ?>
                            @foreach($teamStat as $team)
                            <div class="col-6 mt-3">
                                <div class="bg-white p-3" style="max-height: 223px;overflow: hidden;">
                                    <p class="fw-bold h-6">Team: {{ $team->name }}</p>
                                    <div class="d-flex">
                                        <div class="chart position-relative">
                                            <canvas id="{{ $team->name }}-{{$num}}" style="height: 110px;"></canvas>
                                            <div class="position-absolute top-50 start-50" style="transform: translate(-50%,-50%);">
                                                <div class="js-count text-center vsmatxt">
                                                    <!-- <p class="h6 fw-bold">Sales Agreegated</p>  -->
                                                    {{$team->totalSales}} / {{$team->totalTarget}}<br>{{ number_format(($team->totalSales * 100) / $team->totalTarget, 2) }}%

                                                </div>
                                            </div>
                                        </div>
                                        <div class="names mb-0 dglo vsmatxt" style="max-height: 166px;overflow-y: auto; overflow-x:clip;">
                                            @foreach($team->teamMembers as $member)
                                            <?php $userId = str_replace(' ', '', $member['user_id']) . '-' . $member['id']; ?>
                                            <div class=" px-2 fw-bold py-2">
                                                <p class="text-truncate position-relative ps-3 "> <span class="position-absolute  top-50 {{ $userId }}" id="" style="height: 5px;width: 5px;left: 7px;border-radius: 50%;transform: translateX(-50%);"></span> <a class="text-black text-decoration-none" href="{{env('APP_URL')}}adper/attendance/full_report/{{$member['id']}}"> {{ $member['name'] }} </a></p>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <?php $num++ ?>
                            @endforeach

                            <div class="col-8 my-3">
                                <div class=" bg-white p-3">
                                    <div class="d-flex align-items-center"> <i class="fa-solid fa-bell smText bibr baseBtnBg text-center rounded-circle text-white p-1 mx-1"></i>
                                        <p class="fontmed smText m-0">Request Leave</p>
                                        <a href="https://hr.pantheondigitals.com/adper/leave" class="col-4 d-flex justify-content-between align-items-center">
                                            <span>Manage Leaves</span> <span class="bg-white smbr cttext rounded-circle text-center lh-sm"><i class="fa-solid fa-angle-right"></i></span>
                                        </a>
                                    </div>
                                    <div class="p-2">
                                        @if($leaves->count() > 0)
                                        @foreach($leaves as $leave)
                                        <div class="row py-2 border-bottom border-2 border-start-0 border-end-0 border-top-0">
                                            <div class="col-3 d-flex justify-content-between border-0 smaTxt ">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <p class="m-0 vsmatxt fontmed">{{$leave->user_id}}</p>
                                                </div>
                                            </div>
                                            <div class="col-3 d-flex justify-content-between border-0 smaTxt ">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <p class="m-0 vsmatxt fontmed">{{$leave->leave_from}}</p>
                                                </div>
                                            </div>
                                            <div class="col-3 d-flex justify-content-between border-0 smaTxt ">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <p class="m-0 vsmatxt fontmed">{{$leave->leave_to}}</p>
                                                </div>
                                            </div>
                                            <div class="col-3 d-flex justify-content-between border-0 smaTxt ">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <center>
                                                        <a href="https://hr.pantheondigitals.com/adper/leave_approve/{{$leave->id}}">
                                                            <i class="bi bi-check text-success SubHeding"></i>
                                                        </a>
                                                        <a href="https://hr.pantheondigitals.com/adper/leave_reject/{{$leave->id}}"><i class="bi bi-x SubHeding text-danger"></i></a>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- chat group  -->
                        <div class="p-1 rounded text-center d-none" data-toggle="modal" data-target="#ChatSlide" style="border:0.5px solid #006396; color:#006396; position:fixed;bottom:15px;right:15px;width:90px;background:#fdfdfd;">
                            <div>
                                <div class="rounded-circle baseBtnBg p-1 m-auto" style="height: 30px; width: 30px">
                                    <i class="fa-solid fa-comments"></i>
                                </div>
                            </div>
                            <p class="m-0 smaTxt fw-bold">Chat here</p>
                            <div class="d-flex justify-content-center align-items-center" style="width: 25px;height: 25px;background: green;position: absolute;right: -10px;top: -10px;border-radius: 100px;font-size: 12px;color:#fff;" id="tmess">0
                            </div>
                        </div>
                    </div>
                    <!-- eventa box -->
                    <div class="position-fixed shadow-sm bg-white px-0" id="eventBox" style="transition:all .5s ease-in; right: 0;bottom: -300px;width: 372px;overflow: hidden;">
                        <div class="enventHead shadow-sm bg-white p-3 w-100 border-bottom">
                            <div class="d-flex justify-content-between">
                                <p class="h6 fw-bold">Events <!--<span class="blinking" style="font-size: 12px;font-weight: 900;color: #f60459;">New</span>--></p>
                                <div style="width: 20px;height: 20px;" class="border rounded-circle d-flex align-items-center justify-content-center" onclick="eventS()"> <i class="fa-solid fa-angle-up"></i>
                                    <div></div>
                                </div>
                            </div>
                        </div>
                        <div class="px-3 py-2 dglo" style="
                                background: aliceblue;
                                height: 300px;
                                overflow-y: auto;
                            ">

                            @foreach($todayBirth as $todayb)
                            <p class="my-2 dotb position-relative px-3 vsmatxt" style="
                            ">Teammate <span class="fw-bold text-decoration-underline" style="
                                color: cornflowerblue;
                            ">{{$todayb->name ?? $todayb->user_id}}</span> has birthday today 🕺</p>
                            @endforeach
                            @foreach($birthdays as $birth)

                            <p class="my-2 dotb position-relative px-3 vsmatxt">Teammate <span class="fw-bold text-decoration-underline" style="
                                color: cornflowerblue;
                            ">{{$birth->name ?? $birth->user_id}}</span> has birthday on <span class="fw-bold">{{date('d M',strtotime($birth->dob))}}</< /span> 🕺</p>
                            @endforeach
                            @foreach($usersAnniversary as $ua)
                            <p class="my-2 dotb position-relative px-3 vsmatxt">Teammate <span class="fw-bold text-decoration-underline" style="
                                color: cornflowerblue;
                            ">{{$ua->name ?? $ua->user_id}}</span> has completed his <span class="fw-bold" style="
                                
                            ">{{$ua->years}}</span>@if($ua->years >1) years @else year @endif 😍</p>
                            @endforeach


                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
</div>
<script>
    function eventS() {
        var eb = document.getElementById('eventBox');
        if (eb.style.bottom == "0px") { // Ensure this matches the initial style exactly
            eb.style.bottom = '-300px'; // Assignment, not comparison, and include 'px'
        } else if (eb.style.bottom == '-300px') {
            eb.style.bottom = '0px'; // Same here
        }
    }
</script>
@include("user.includes.footer")
<script>
    // total sales
    var ctx = document.getElementById('previousChart').getContext('2d');
    var totalPercentage = @if(($monthtarget / $target * 100) > 100) {{100 }} @else {{(($monthtarget / $target * 100))}}@endif;
    var donePercentage = totalPercentage;
    var disabledPercentage = 100 - totalPercentage;
    var doughnutChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Total Sales', 'Disabled'],
            datasets: [{
                data: [donePercentage, disabledPercentage],
                backgroundColor: ['#0557AF', '#e0e0e0'],
                hoverBackgroundColor: ['#0557AF', '#e0e0e0'],
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                display: false
            },
            tooltips: {
                enabled: false
            },
            cutout: '60%',
            cutoutPercentage: 60,
        }
    });
// team sales

    // Assuming these values are dynamically provided by your server-side code
 
    @php($index = 0)
    @foreach($teamStat as $teamchart)
   

  
        var ctx = document.getElementById('{{ $teamchart->name }}-' + {{$index}}).getContext('2d');
        console.log(ctx);
        var teamMembers = @json($teamchart->teamMembers);
            var totalTarget = {{ $teamchart->totalTarget }};
            var totalSales = teamMembers.reduce((acc, member) => acc + parseFloat(member.sales), 0);
            var salesData = teamMembers.map(member => (parseFloat(member.sales) / totalTarget * 100).toFixed(2));
            var remainingPercentage = ((totalTarget - totalSales) / totalTarget * 100).toFixed(2);
            var memberNames = teamMembers.map(member => member.name + ` (${member.sales} sales, ${((parseFloat(member.sales) / totalTarget) * 100).toFixed(2)}%)`);
            
            // Add the remaining target percentage if there's any target left unmet
            if (totalSales < totalTarget) {
                salesData.push(remainingPercentage);
                memberNames.push('Remaining Target');
            }

            var backgroundColors = teamMembers.map((_, index) => `hsl(${360 * index / teamMembers.length}, 70%, 50%)`); 
            backgroundColors.push('#e0e0e0'); 

            teamMembers.forEach(function(member, index) {
    var memberId = member.id;
    var memberName = member.user_id;
    var memberUniqueId = memberName + '-' + memberId; 
    console.log(memberUniqueId);
    member.uniqueId = memberUniqueId;
    
    var userElements = document.querySelectorAll('.' + memberUniqueId);
    userElements.forEach(function(userElement) {
        userElement.style.backgroundColor = backgroundColors[index % backgroundColors.length];
    });
});


            new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: memberNames,
            datasets: [{
                data: salesData,
                backgroundColor: backgroundColors,
                hoverBackgroundColor: backgroundColors,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                display: false // Hide labels by default
            },
            tooltips: {
                enabled: true,
                callbacks: {
                    label: function(tooltipItem, data) {
                        var label = data.labels[tooltipItem.index] || '';

                        if (label) {
                            label += ': ';
                        }
                        label += data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index] + '%';
                        return label;
                    }
                }
            }
        }
    });

        <?php $index++ ?>
@endforeach 



    var chart = document.getElementById('chart').getContext('2d');
    var fxsaleValues = [];
    var fysaleValues = [];
    var sysaleValues = [];
    @foreach($sales as $k => $as)
    // if(date('D',strtotime($as['mark_date'])) == 'Sun') else
    fxsaleValues.push("{{date('d',strtotime($as['mark_date']))}}");
    fysaleValues.push("{{$as['sum']}}");
    sysaleValues.push("{{$as['total_pr']}}");
    // endif
    @endforeach

    var data = {
        labels: fxsaleValues,
        datasets: [{
            label: 'Sales',
            backgroundColor: '#fff0',
            pointBackgroundColor: '#1194f3',
            borderWidth: 1,
            borderColor: '#1194F3',
            data: fysaleValues
        }, {
            label: 'Login User',
            backgroundColor: '#fff0',
            pointBackgroundColor: '#ff0000',
            borderWidth: 1,
            borderColor: '#ff0000',
            data: sysaleValues
        }]
    };


    var options = {
        responsive: true,
        stacked: false,
        elements: {
            line: {
                tension: 0
            }
        },
        scales: {
            y: {
                type: 'linear',
                display: true,
                position: 'left',
            },
            y1: {
                type: 'linear',
                display: true,
                position: 'right',
            },
        }
    };


    var chartInstance = new Chart(chart, {
        type: 'line',
        data: data,
        options: options
    });
</script>
<script>
//   caht script come here

//   caht script come here

    function fixdate(dt) {
        const dateTimeString = dt;
        const dateObj = new Date(dateTimeString);
        const currentDate = new Date(); // Get the current date
        const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
        let formattedTime;
        if (dateObj.getUTCDate() === currentDate.getUTCDate() &&
            dateObj.getUTCMonth() === currentDate.getUTCMonth() &&
            dateObj.getUTCFullYear() === currentDate.getUTCFullYear()) {

            const hours = dateObj.getUTCHours();
            const minutes = dateObj.getUTCMinutes();
            formattedTime = `${hours}:${minutes < 10 ? '0' + minutes : minutes}`;
        } else {
            const day = dateObj.getUTCDate().toString().padStart(2, '0');
            const month = monthNames[dateObj.getUTCMonth()];
            const year = dateObj.getUTCFullYear().toString().slice(2); // Get the last two digits of the year
            const hours = dateObj.getUTCHours();
            const minutes = dateObj.getUTCMinutes();
            formattedTime = `${day}, ${month} ${year}, ${hours}:${minutes < 10 ? '0' + minutes : minutes}`;
        }
        return formattedTime;
    }

    function playAudio() {
        var audio = new Audio('/public/sms.mp3');
        audio.play();
    }
    // messdata();
</script>