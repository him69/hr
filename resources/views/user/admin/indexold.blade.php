@include("admin.includes.header")
<link rel="stylesheet" href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/3.6.95/css/materialdesignicons.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
<div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
@include("admin.includes.top_nav")
    <div class="ui-theme-settings">
        <div class="theme-settings__inner">
            <div class="scrollbar-container">

            </div>
        </div>
    </div>
    <div class="app-main">
        @include("admin.includes.sidebar")
        <div class="app-main__outer collapse">
            <div class="app-main__inner">
                <div class="d-flex" style="justify-content: space-around;">
                    <div class="col-md-12">
                        <div class="d-flex my-3" style=" justify-content: space-between">
                        </div>
                        <div class="">
                            <div class="row">
                                <div class="col-12 col-md-4">
                                    <div class="position-relative baseShadow borderRadius bg-white p-2">
                                        <canvas id="previousChart" style="height: 200px;"></canvas>
                                        <div class="position-absolute top-50 start-50"
                                            style="transform: translate(-50%,-50%);">
                                            <div class="js-count text-center">
                                                {{$monthtarget}} / {{$target}}<br>{{($monthtarget*100)/$target}}%
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="p-2 baseShadow borderRadius my-3">
                                    <p class="smText fontmed">Top 5 Employees</p>
                                    <div class="overflow-hidden">
                                        <div class="px-2 py-2 text-primary">
                                            @php($i = 1)
                                            @foreach($usersale as $k => $as)
                                            <?php 
                                            $ka = App\Models\User::where('id',$k)->get();
                                            if($ka->count() > 0){
                                                $ka = $ka[0];
                                            ?>
                                            <div class="row py-2 border-bottom border-2 border-start-0 border-end-0 border-top-0">
                                                <div class="col-8 d-flex justify-content-between border-0 smaTxt ">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <i class="fa-solid fa-medal mx-1"></i>
                                                        <a href="{{env('APP_URL')}}adper/attendance/full_report/{{$ka->id}}"><p class="m-0 vsmatxt fontmed">{{$ka->user_id}}</p></a>
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
                                                @php($i = 1)<?php $zusersale = $usersale; asort($zusersale);?>
                                            @foreach($zusersale as $k => $as)
                                            <?php 
                                            $ka = App\Models\User::where('id',$k)->get();
                                            if($ka->count() > 0){
                                                $ka = $ka[0];
                                            ?>
                                                <div class="col-4 text-start smText">
                                                    <a href="{{env('APP_URL')}}adper/attendance/full_report/{{$ka->id}}"><span class="m-0 vsmatxt fontmed">{{$ka->user_id}}</span></a>
                                                </div>
                                            @if($i == 6)<?php break; ?>@endif
                                            @php($i++)
                                            <?php }?>@endforeach
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
                                <div class="col-12 col-md-8">
                                    <div class="baseShadow borderRadius bg-white">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="row m-1 align-items-center">
                                                <div class="col-6 p-0">
                                                    Today's login: {{$todayactive}}        
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <form>
                                                <div class="row m-0 align-items-center bg-white baseShadow rounded-2">
                                                    <div class="col-6 p-0">
                                                        <input type="month" name="month" value="{{$ym}}"
                                                            class="form-control border-0">
                                                    </div>
                                                    <div class="col-6 p-0">
                                                        <button class="btn baseBtnBg w-100">
                                                            <span>Search by month</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class=" p-2 my-3">
                                        <p class="para text-center">{{$ym}} sale analysis</p>
                                        <div class="m-auto" style="width: 90%;">
                                        <div class="line-chart">
                                          <div class="aspect-ratio">
                                            <canvas id="chart"></canvas>
                                          </div>
                                        </div>
                                            <div>
                                                <p class="samllText fw-bold text-center">Total sales in {{$ym}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="row  my-3">
                                        <div class="col-4">
                                        <div class="bg-white borderRadius sba p-1 overflow-hidden position-relative" style="background-color: #EEFAFB;z-index: -2;height: 100%;border: solid #006396;">
                                            <div class="d-flex justify-content-between position-relative">
                                                <div class="d-flex align-items-center">
                                                    <i class="fa-regular bibr fa-calendar text-center baseBtnBg rounded-circle text-white p-1 mx-1"></i>
                                                    <p class="m-0 cttext fontmed vsmatxt">Upcoming Birthday's</p>
                                                </div>
                                            </div>
                                            <div class="px-2 py-2 baseColor">
                                                <div class="row">
                                                    @if($birthdays->count() > 0)
                                                    @foreach($birthdays as $birth)
                                                    <div class=" d-flex col-12 align-items-center justify-content-between">
                                                        <div class="m-1">
                                                            <span class="m-0 vsmatxt">{{$birth->name ?? $birth->user_id}} - <b>{{date('d M',strtotime($birth->dob))}}</b></span>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="col-8">
                                        <div class="row">
                                            <div class="col-12 m-1">
                                                <div class="baseShadow borderRadius bg-white p-2">
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
                                        </div>
                                            <div class="p-1 rounded text-center" data-toggle="modal" data-target="#ChatSlide" style="border:0.5px solid #006396; color:#006396; position:fixed;bottom:15px;right:15px;width:90px;background:#fdfdfd;">
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div class="chatboxx">
<div class="modal fade" id="ChatSlide" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-slideout" role="document">
    <div class="modal-content" style="background-color: #f7f7f7;padding-left: 12px;overflow: hidden;">
        <div class="row bg-white">
            <div class="col-12 col-sm-12 col-md-4 borderblue p-0">
                <nav class="w-full h-14  rounded-tl flex justify-center items-center ">
                            <div>
                                <h5 class="usergrpname">Groups /Teammates
                                </h5>
                            </div>
                        </nav>
                        <hr>
                        <nav class="w-full h-14  rounded-tl flex justify-center items-center">
                            <form class="d-flex p-2">
                                <input class="form-control" type="search" placeholder="Search" aria-label="Search"
                                    style="box-shadow: 0px 1px 1px #00000029;" id="chatsearch">
                                <button class="btn"
                                    style="background: #0099C7 0% 0% no-repeat padding-box;color: white;"
                                    type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                            </form>
                        </nav>
    			<div class="contactname">
    			<hr>
    			@if($chat_group->count() > 0)
    			@foreach($chat_group as $group)
    			<nav class="w-full h-14 rounded-tr rounded-tl flex justify-between items-center chat_nav pinned" onclick="open_chat(this,{{$group->id}},'{{$group->group_name}}')">
    					<div class="flex justify-start items-center" style="width: 50%;">
    						<img src="https://pantheondigitals.com/img/logo-svg-svg.png" class="rounded-full ml-1" width="35" height="35">
    						<span class="text-md font-medium text-black-300 ml-1 truncate">{{$group->group_name}}</span>
    					</div>
                <div style="width: 50%;text-align: end;"><span style="margin-right: 50px;" id="group_{{$group->id}}" class="cncg"></span></div>
                <hr>
    			</nav>
    			@endforeach
    			@endif
    			@if($chat_group_list->count() > 0)
    			@foreach($chat_group_list as $single_chat)
    			@if($single_chat->uid == $user->id)@else
    			<nav class="w-full h-14 rounded-tr rounded-tl flex justify-between items-center chat_nav" onclick="open_chat(this,{{$single_chat->uid}},'{{$single_chat->name ? $single_chat->name : $single_chat->user_id}}',2)">
    					<div class="flex justify-start items-center" style="width: 50%;">
    						<img src="{{$single_chat->photo ? env('APP_URL').'public/uploads/'.$single_chat->photo : 'https://pantheondigitals.com/img/logo-svg-svg.png'}}" class="rounded-full ml-1" width="35" height="35" style="width:35px;height:35px;">
    						<span class="text-md font-small text-black-300 ml-1 truncate">{{$single_chat->name ? $single_chat->name : $single_chat->user_id}}
    						<br><b style="font-size:9px;">( @if($single_chat->user_type == 1){{'Sales'}}@elseif($single_chat->user_type == 2){{'QA'}}@elseif($single_chat->user_type == 3){{'HR'}}@elseif($single_chat->user_type == 4){{'IT'}}@endif )</b>
    						</span>
    					</div>
                <div style="width: 50%;text-align: end;"><span style="margin-right: 50px;" id="user_{{$single_chat->uid}}" class="cncu"></span></div>
    			<hr>
    			</nav>
    			@endif
    			@endforeach
    			@endif
    			</div>
            </div>
            <div class="col-12 col-sm-12 col-md-8 p-0 borderblue" id="prechat_box"></div>
            <div class="col-12 col-sm-12 d-none col-md-8 p-0 borderblue" id="chat_box">
                <nav class="w-full h-14   flex justify-between items-center">
                            <div class="flex justify-center items-center">
                                <img src="https://pantheondigitals.com/img/logo-svg-svg.png" class="rounded-full ml-1" width="35"
                                    height="35">
                                <span class="usergrpname" id="chat_name"></span>
                            </div>
                            <div class="flex items-center"></div>
                        </nav>
                        <hr>
    			<div id="journal-scroll">
    				<div class="" id="chatmsg"></div>
    			</div>
                <div class="flex justify-between items-center p-1 col-8 " style="position: fixed;
                        bottom: 0;">
                            <div class="relative ms-2" style="width:100%;">
                                <input type="text" class="rounded-full pl-6 pr-12 py-2  sendmsgbox"
                                    placeholder="Type a message..." id="typemsg">
                                <i class="fa-solid fa-plus absolute right-5 top-2"></i>
                            </div>
                            <div class="w-9 h-9  text-center items-center flex justify-center sendarrow">
                                <button
                                    class="w-9 h-9 rounded-full text-center items-center flex justify-center focus:outline-none hover:baseBtnBg text-white"
                                    onclick="sendbtn();" id="send"><i class="mdi mdi-send "></i></button>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
  </div>
</div>
@include("admin.includes.footer")
<script>
    var ctx = document.getElementById('previousChart').getContext('2d');
    var totalPercentage = @if(($monthtarget/$target * 100) > 100){{100}}@else {{(($monthtarget/$target * 100))}} @endif;
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
            cutout:'50%',
            cutoutPercentage: 60,
        }
    });
    
    var chart = document.getElementById('chart').getContext('2d');
    var fxsaleValues = [];var fysaleValues = []; var sysaleValues = [];
    @foreach($sales as $k => $as)
    // if(date('D',strtotime($as['mark_date'])) == 'Sun') else
    fxsaleValues.push("{{date('d',strtotime($as['mark_date']))}}");
    fysaleValues.push("{{$as['sum']}}");
    sysaleValues.push("{{$as['total_pr']}}");
    // endif
    @endforeach

var data  = {
    labels: fxsaleValues,
    datasets: [{
			label: 'Sales',
			backgroundColor: '#ffffff00',   
			pointBackgroundColor: '#1194F3',
			borderWidth: 1,
			borderColor: '#1194F3',
			data: fysaleValues
    },{
			label: 'Login User',
			backgroundColor: '#ffffff00',   
			pointBackgroundColor: '#ff0000',
			borderWidth: 1,
			borderColor: '#ff0000',
			data: sysaleValues
    }
    ]
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
        var openchat = 0;
        var printtext = document.getElementById('chatmsg');
        var copytext = document.getElementById('typemsg');
        var group_id;
        var last_id = 1;
        var chat_type = 1;
        var es = null;
        var mdes = null;
        var cv = 0;
            function open_chat(tab,id,name,type=1) {
                chat_type = type;
                group_id = id;
                if(openchat == 0){
                    $('#prechat_box').addClass('d-none');
                    $('#chat_box').removeClass('d-none');
                    openchat = 1;
                }
                $('.chat_nav').removeClass('bg-blueviolet');
                $(tab).addClass('bg-blueviolet');
                $('#chat_name').html(name);
                var settings = {
                  "url": "/get_message?group_id="+group_id+"&type="+type+"&sender_type=2",
                  "method": "GET",
                  "timeout": 0,
                };
                $.ajax(settings).done(function (response) {
                    var printnow = '';
                    response.data.map((data)=>{
                        if(data.sender_id == {{$user->id}}){
        				printnow += `<div class="flex justify-end pt-2 pl-10">
                                <div style="margin: 0 12px;">
                                    <div
                                        style="background: #EEFAFB;box-shadow: 0px 2px 3px #00000029;padding: 5px;border-radius: 5px;">
                                        <p class="chattxt"> ${data.message}</p>
                                        <p class="text-end" style="font-size: 10px;">${fixdate(data.created_at)}</p>
                                    </div>
                                </div>
                                <div class="flex items-end justify-end">
                                    <img src="${data.photo ? '{{env('APP_URL').'public/uploads/'}}'+data.photo : 'https://pantheondigitals.com/img/logo-svg-svg.png'}" class="rounded-full shadow-xl" width="20"
                                        height="20">
                                </div>
                            </div>`;
        				
                        }else{
        			    printnow +=`<div class="flex items-center pr-10 my-3 pt-2">
                                <img src="${data.photo ? '{{env('APP_URL').'public/uploads/'}}'+data.photo : 'https://pantheondigitals.com/img/logo-svg-svg.png'}" class="rounded-full shadow-xl" width="20"
                                    height="20" style="margin-top: 10px;align-self: baseline;">
                                <div style="margin: 0 12px;">
                                    <div style="background: white;box-shadow: 0px 2px 3px #00000029;padding: 5px;border-radius: 5px;">
                                        <p class="chattxt">${(data.name ? data.name : data.user_id) ? (data.name ? data.name : data.user_id) : 'Admin'}</p>
                                        <hr>
                                        <p class="chattxt">${data.message}</p>
                                        <p class="text-end" style="font-size: 10px;">${fixdate(data.created_at)}</p>
                                    </div>
                                </div>
                            </div>`;
                        }
                        if(last_id < data.id){last_id = data.id;}
                    });
                    $(printtext).html(printnow);
                    var box = document.getElementById('journal-scroll');
            	    box.scrollTop = box.scrollHeight;
            	    get_message();
                });
            }
            function sendbtn() {
            	var copiedtext = copytext.value;
            	if(copiedtext == null || copiedtext == ''){
            	    return null;
            	}else{
            	var printnow = '';
            	var form = new FormData();
                form.append("group_id", group_id);
                form.append("message", copiedtext);
                form.append("chat_type", chat_type);
                form.append("sender_type", 2);
                form.append("_token", '{{csrf_token()}}');
            	var settings = {
                  "url": "/chat_send_message",
                  "method": "POST",
                  "timeout": 0,
                  "processData": false,
                  "mimeType": "multipart/form-data",
                  "contentType": false,
                  "data": form
                };
                $.ajax(settings).done(function (response) {
                    var data = JSON.parse(response);
                    data.data.map((data)=>{
                            printnow += `<div class="flex justify-end pt-2 pl-10">
                                <div style="margin: 0 12px;">
                                    <div
                                        style="background: #EEFAFB;box-shadow: 0px 2px 3px #00000029;padding: 5px;border-radius: 5px;">
                                        <p class="chattxt"> ${data.message}</p>
                                        <p class="text-end" style="font-size: 10px;">${fixdate(data.created_at)}</p>
                                    </div>
                                </div>
                                <div class="flex items-end justify-end">
                                    <img src="https://pantheondigitals.com/img/logo-svg-svg.png" class="rounded-full shadow-xl" width="20"
                                        height="20">
                                </div>
                            </div>`;
                            
                            if(last_id < data.id){last_id = data.id;}
                    });
                    $(printtext).append(printnow);
                    var box = document.getElementById('journal-scroll');
            	    box.scrollTop = box.scrollHeight;
            	    copytext.value = '';
            	    get_message();
                });
            	}
            }
        function get_message(){
        if (es !== null) {
            es.close();
        }
        es = new EventSource("/sse?group_id="+group_id+"&last_id="+last_id+'&type='+chat_type);
        es.onmessage = function(event) {
            const data = JSON.parse(event.data);
            var printnow = '';
                if(data.new_message > 0){
                    data.data.map((data) => {
                        if(data.sender_id == {{$user->id}}) {
                            printnow += `<div class="flex justify-end pt-2 pl-10">
                                <div style="margin: 0 12px;">
                                    <div
                                        style="background: #EEFAFB;box-shadow: 0px 2px 3px #00000029;padding: 5px;border-radius: 5px;">
                                        <p class="chattxt"> ${data.message}</p>
                                        <p class="text-end" style="font-size: 10px;">${fixdate(data.created_at)}</p>
                                    </div>
                                </div>
                                <div class="flex items-end justify-end">
                                    <img src="${data.photo ? '{{env('APP_URL').'public/uploads/'}}'+data.photo : 'https://pantheondigitals.com/img/logo-svg-svg.png'}" class="rounded-full shadow-xl" width="20"
                                        height="20">
                                </div>
                            </div>`;
                        } else {
                            printnow +=`<div class="flex items-center pr-10 my-3 pt-2">
                                <img src="${data.photo ? '{{env('APP_URL').'public/uploads/'}}'+data.photo : 'https://pantheondigitals.com/img/logo-svg-svg.png'}" class="rounded-full shadow-xl" width="20"
                                    height="20" style="margin-top: 10px;align-self: baseline;">
                                <div style="margin: 0 12px;">
                                    <div style="background: white;box-shadow: 0px 2px 3px #00000029;padding: 5px;border-radius: 5px;">

                                        <p class="chattxt">${(data.name ? data.name : data.user_id) ? (data.name ? data.name : data.user_id) : 'Admin'}</p>
                                        <hr>
                                        <p class="chattxt">${data.message}</p>
                                        <p class="text-end" style="font-size: 10px;">${fixdate(data.created_at)}</p>
                                    </div>
                                </div>
                            </div>`;
                        }
                    if(last_id < data.id){last_id = data.id;}
                    });
                    $(printtext).append(printnow);
                    var box = document.getElementById('journal-scroll');
            	    box.scrollTop = box.scrollHeight;
                    get_message();
                }
                if(data.group.length > 0){
                    $(".cncg").each(function() {$(this).html();});
                    data.group.map((gdata) => {
                        $("#group_"+gdata.group_id).html(gdata.new_message);
                    });
                }
                if (data.user.length > 0) {
                    data.user.map((gdata) => {
                        let ld = $("#user_" + gdata.sender_id);
                        
                        // Only proceed if the message count changes
                        if (ld.html() != gdata.new_message) {
                            ld.html(gdata.new_message);
                            
                            const chatElement = ld.closest('nav');
                            const pinnedChats = chatElement.parent().find('.pinned');
                
                            // If this chat is pinned, don't move it. Otherwise, determine its position.
                            if (!chatElement.hasClass('pinned')) {
                                if (pinnedChats.length > 0) {
                                    // If there are pinned chats, place the updated chat right after the last pinned chat
                                    chatElement.insertAfter(pinnedChats.last());
                                } else {
                                    // If no pinned chats, move the updated chat to the very top
                                    chatElement.prependTo(chatElement.parent());
                                }
                            }
                        }
                    });
                }
                
        };
        es.onerror = function(event) {
            es.close();
            get_message();
        };
        }
        function messdata(){
        var tmess = 0;
        var otmess = 0;
        if (mdes !== null) {
            mdes.close();
        }
        mdes = new EventSource("/messdata?last_id="+last_id);
        mdes.onmessage = function(event) {
            const data = JSON.parse(event.data);
            var printnow = '';
                if(data.group.length > 0){
                    $(".cncg").each(function() {$(this).html();});
                    data.group.map((gdata) => {
                        $("#group_"+gdata.group_id).html(gdata.new_message);
                    });
                }
                if (data.user.length > 0) {
                if (JSON.stringify(data.user) != cv) {
                    cv = JSON.stringify(data.user);
                    data.user.map((gdata) => {
                            $("#user_" + gdata.sender_id).html(gdata.new_message);
                            const chatElement = $("#user_" + gdata.sender_id).closest('nav');
                            const pinnedChats = chatElement.parent().find('.pinned');
                            // If this chat is pinned, don't move it. Otherwise, determine its position.
                            if (!chatElement.hasClass('pinned')) {
                                if (pinnedChats.length > 0) {
                                    // If there are pinned chats, place the updated chat right after the last pinned chat
                                    chatElement.insertAfter(pinnedChats.last());
                                } else {
                                    // If no pinned chats, move the updated chat to the very top
                                    chatElement.prependTo(chatElement.parent());
                                }
                            }
                            tmess += parseInt(gdata.new_message);
                    });
                    if(tmess != otmess){
                    playAudio();
                    $("#tmess").html(tmess);
                    }
                    otmess = tmess;
                }else{}
            }
        };
        mdes.onerror = function(event) {
            mdes.close();
            messdata();
        };
        }
        copytext.addEventListener("keypress", function(event) {
          if (event.key === "Enter") {
            event.preventDefault();
            document.getElementById("send").click();
          }
        });
        $('#chatsearch').on('input', function() {
    let searchValue = this.value.toLowerCase();
    let navElements = document.querySelectorAll('.chat_nav');
    
    navElements.forEach(function(nav) {
        let name = nav.querySelector('.text-md').innerText.toLowerCase();
        if(name.includes(searchValue)) {
            nav.style.display = 'flex';
        } else {
            nav.style.display = 'none';
        }
    });
});
function fixdate(dt){
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
messdata();
</script>