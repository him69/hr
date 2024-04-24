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
    			<hr>
    			<nav class="w-full h-14 rounded-tr rounded-tl flex justify-between items-center chat_nav" onclick="open_chat(this,{{$group->id}},'{{$group->group_name}}')">
    					<div class="flex justify-center items-center">
    						<img src="https://i.imgur.com/IAgGUYF.jpg" class="rounded-full ml-1" width="35" height="35">
    						<span class="text-md font-medium text-black-300 ml-1">{{$group->group_name}}</span>
    					</div>
                <span style="margin-right: 50px;" id="group_{{$group->id}}" class="cncg"></span>
    			</nav>
    			<hr>
    			@endforeach
    			@endif
    			@if($chat_group_list->count() > 0)
    			@foreach($chat_group_list as $single_chat)
    			@if($single_chat->uid == $user->id)@else
    			<hr>
    			<nav class="w-full h-14 rounded-tr rounded-tl flex justify-between items-center chat_nav" onclick="open_chat(this,{{$single_chat->uid}},'{{$single_chat->name ? $single_chat->name : $single_chat->user_id}}',2)">
    					<div class="flex justify-center items-center">
    						<img src="{{$single_chat->photo ? env('APP_URL').'public/uploads/'.$single_chat->photo : 'https://i.imgur.com/IAgGUYF.jpg'}}" class="rounded-full ml-1" width="35" height="35" style="width:35px;height:35px;">
    						<span class="text-md font-medium text-black-300 ml-1">{{$single_chat->name ? $single_chat->name : $single_chat->user_id}}</span>
    					</div>
                <span style="margin-right: 50px;" id="user_{{$single_chat->uid}}" class="cncu"></span>
    			</nav>
    			<hr>
    			@endif
    			@endforeach
    			@endif
    			</div>
            </div>
            <div class="col-12 col-sm-12 col-md-8 p-0 borderblue" id="prechat_box"></div>
            <div class="col-12 col-sm-12 d-none col-md-8 p-0 borderblue" id="chat_box">
                <nav class="w-full h-14   flex justify-between items-center">
                            <div class="flex justify-center items-center">
                                <img src="https://i.imgur.com/IAgGUYF.jpg" class="rounded-full ml-1" width="35"
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     
<script type="text/javascript" src="{{env('APP_URL')}}public/assets/scripts/main.js"></script>
</body>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="{{env('APP_URL')}}public/boot/js/bootstrap.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script>
        var openchat = 0;
        var printtext = document.getElementById('chatmsg');
        var copytext = document.getElementById('typemsg');
        var group_id;
        var last_id = 1;
        var chat_type = 1;
        var es = null;
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
                  "url": "/get_message?group_id="+group_id+"&type="+type,
                  "method": "GET",
                  "timeout": 0,
                };
                $.ajax(settings).done(function (response) {
                    var printnow = '';
                    response.data.map((data)=>{
                        if(data.sender_id == {{$user->id}}){
            //                 printnow += `<div class="flex justify-end pt-2 pl-10">
        				// 	<div style="margin: 0 12px;">
        				// 	    <div style="background: aliceblue;padding: 5px;border-radius: 5px;">
            //                         ${data.message}
            //                         <div style="font-size: 10px;text-align: end;">
            //                       ${data.created_at}
            //                     </div>
            //                     </div>
            //                 </div>
        				// </div>`;
        				
        				printnow += `<div class="flex justify-end pt-2 pl-10">
                                <div style="margin: 0 12px;">
                                    <div
                                        style="background: #EEFAFB;box-shadow: 0px 2px 3px #00000029;padding: 5px;border-radius: 5px;">
                                        <p class="chattxt"> ${data.message}</p>
                                        <p class="text-end" style="font-size: 10px;">${data.created_at}</p>
                                    </div>
                                </div>
                                <div class="flex items-end justify-end">
                                    <img src="https://i.imgur.com/IAgGUYF.jpg" class="rounded-full shadow-xl" width="20"
                                        height="20">
                                </div>
                            </div>`;
        				
                        }else{
            //                 printnow += `<div class="flex items-center pr-10 my-3 pt-2">
        				// 	<img src="https://i.imgur.com/IAgGUYF.jpg" class="rounded-full shadow-xl" width="20" height="20" style="margin-top: 10px;align-self: baseline;">
        				// 	<div style="margin: 0 12px;">
            //                     <div style="font-size: 10px;width: fit-content;background: aliceblue;padding: 3px;border-radius: 5px;margin: 10px 0px;">
            //                       ${data.name ? data.name : data.user_id}, ${data.created_at}
            //                     </div>
            //                     <div style="background: aliceblue;padding: 5px;border-radius: 5px;">
            //                         ${data.message}
            //                     </div>
            //                 </div>
        			 //   </div>`;
        			    
        			    
        			    printnow +=`<div class="flex items-center pr-10 my-3 pt-2">
                                <img src="https://i.imgur.com/IAgGUYF.jpg" class="rounded-full shadow-xl" width="20"
                                    height="20" style="margin-top: 10px;align-self: baseline;">
                                <div style="margin: 0 12px;">
                                    <div style="background: white;box-shadow: 0px 2px 3px #00000029;padding: 5px;border-radius: 5px;">

                                        <p class="chattxt">${data.name ? data.name : data.user_id}</p>
                                        <hr>
                                        <p class="chattxt">${data.message}</p>
                                        <p class="text-end" style="font-size: 10px;">${data.created_at}</p>
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
                console.log(chat_type)
            	var copiedtext = copytext.value;
            	if(copiedtext == null || copiedtext == ''){
            	    return null;
            	}else{
            	var printnow = '';
            	var form = new FormData();
                form.append("group_id", group_id);
                form.append("message", copiedtext);
                form.append("chat_type", chat_type);
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
                                        <p class="text-end" style="font-size: 10px;">${data.created_at}</p>
                                    </div>
                                </div>
                                <div class="flex items-end justify-end">
                                    <img src="https://i.imgur.com/IAgGUYF.jpg" class="rounded-full shadow-xl" width="20"
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
        </script>
        <script>
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
                                        <p class="text-end" style="font-size: 10px;">${data.created_at}</p>
                                    </div>
                                </div>
                                <div class="flex items-end justify-end">
                                    <img src="https://i.imgur.com/IAgGUYF.jpg" class="rounded-full shadow-xl" width="20"
                                        height="20">
                                </div>
                            </div>`;
                        } else {
                            printnow +=`<div class="flex items-center pr-10 my-3 pt-2">
                                <img src="https://i.imgur.com/IAgGUYF.jpg" class="rounded-full shadow-xl" width="20"
                                    height="20" style="margin-top: 10px;align-self: baseline;">
                                <div style="margin: 0 12px;">
                                    <div style="background: white;box-shadow: 0px 2px 3px #00000029;padding: 5px;border-radius: 5px;">

                                        <p class="chattxt">${data.name ? data.name : data.user_id}</p>
                                        <hr>
                                        <p class="chattxt">${data.message}</p>
                                        <p class="text-end" style="font-size: 10px;">${data.created_at}</p>
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
                    data.group.map((gdata) => {
                        // console.log(gdata.new_message);
                        $("#group_"+gdata.group_id).html(gdata.new_message);
                    });
                }else{
                    $(".cncg").html();
                }
                if(data.user.length > 0){
                    data.user.map((gdata) => {
                        // console.log("#user_"+gdata.sender_id,gdata.new_message);
                        $("#user_"+gdata.sender_id).html(gdata.new_message);
                    });
                }else{
                    $(".cncu").html();
                }
        };
        es.onerror = function(event) {
            // get_message();
            // console.error('Error occurred:', event);
            es.close();
        };
        }
        copytext.addEventListener("keypress", function(event) {
          if (event.key === "Enter") {
            event.preventDefault();
            document.getElementById("send").click();
          }
        });
        $('#chatsearch').addEventListener('input', function() {
            console.log(44);
    let searchValue = this.value.toLowerCase();
    let navElements = document.querySelectorAll('.chat_nav');
    
    navElements.forEach(function(nav) {
        let name = nav.querySelector('.text-md').innerText.toLowerCase();
        
        if(name.includes(searchValue)) {
            console.log(44);
            nav.style.display = 'block';
        } else {
            nav.style.display = 'none';
        }
    });
});

    </script>
</html>
