@include("user.includes.header")
<div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
    @include("user.includes.top_nav")
    <div class="ui-theme-settings">
        <div class="theme-settings__inner">
            <div class="scrollbar-container">
            </div>
        </div>
    </div>
    <div class="app-main">
        @include("user.includes.sidebar")
        <div class="app-main__outer">
            <div class="app-main__inner">
                <div class="d-flex justify-content-between align-items-center mt-4">
                    <div class="">
                        <p class="h5 fw-bold text-center">Request for leave</p>
                    </div>
                    <div class="">
                        <a href="{{env('APP_URL')}}leave">
                            <button type="button" class="btn baseBtnBg "><span class="p-1 m-1 vsmatxt rounded-circle bibr bg-white cttext "><i class="fa-solid fa-car"></i></span></i> Go my leave</button>
                        </a>
                    </div>
                </div>
                <div class="my-2">
                    <div class="row py-4 bg-white mx-0">
                        <div class="col-8 d-flex flex-column justify-content-between ">
                            <p class="fw-bold m-0">You can apply for leave from here!</p>
                            <p class="smText vsmatxt fontmed m-0">Make sure to check <span class="baseColor fw-bold">“my leaves”</span> section to know weather your leave is approved or not</p>
                        </div>
                        <div class="col-4 d-flex justify-content-end ">
                            <div class="d-flex flex-column  justify-content-end align-items-end smaTxt" style="font-size: 12px;">
                                <span>Leave balance: <b class="ms-1">{{$user->leave_count}}</b></span>
                                <span>Used Leave: <b class="ms-1">{{$user->used_leave_count}}</b></span>
                            </div>
                        </div>

                        <div class="leaveForm bg-white col-12 p-3" id="exTab1">
                            <div>
                                @if(session('error'))
                                <div class="alert alert-danger" id="error-alert">
                                    {{ session('error') }}
                                </div>
                                @endif
                                @if(session('success'))
                                <div class="alert alert-success" id="success-alert">
                                    {{ session('success') }}
                                </div>
                                @endif
                                <div class=" mt-3 px-2 border border-secondary rounded">
                                    <div class="" style="display: block;">
                                        <!--<p class="my-1"> <span class="fw-bold ">Leave</span></p>-->
                                        <form action="{{env('APP_URL')}}leave/mark" method="post" class="px-3 py-3">
                                            @csrf
                                            <input type="hidden" value="Full day" name="leave_type">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="d-flex">
                                                        <div class="col-6 my-3">
                                                            <div class="col-12 row p-0">
                                                                <label for="" class="smaTxt fontmed">From Date* </label>
                                                                <div class="col-12"><input type="date" name="leave_from" min="{{ date('Y-m-d') }}" class="form-control" required></div>
                                                            </div>

                                                        </div>
                                                        <div class="col-6 my-3">
                                                            <div class="col-12 row p-0">
                                                                <label for="" class="smaTxt fontmed">To Date*</label>
                                                                <div class="col-12"><input type="date" name="leave_to" class="form-control" min="{{ date('Y-m-d') }}"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 my-3 d-flex">
                                                        <div class="col-12 row p-0">
                                                            <label for="" class="smaTxt fontmed">Leave type</label>
                                                            <div class="col-12 row">
                                                                <div class="d-flex justify-content-start col-4 align-items-center">
                                                                    <input type="radio" id="" name="leave_type" value="Full day">
                                                                    <label for="1st" class="m-0 mx-1 cttext fw-bold" style="min-width: fit-content;">Full</label>
                                                                </div>
                                                                <div class="d-flex justify-content-start col-4 align-items-center">
                                                                    <input type="radio" id="" name="leave_type" value="1st Half">
                                                                    <label for="1st" class="m-0 mx-1 cttext fw-bold" style="min-width: fit-content;">1st Half</label>
                                                                </div>
                                                                <div class="d-flex justify-content-start col-4 align-items-center">
                                                                    <input type="radio" id="" name="leave_type" value="2nd Half">
                                                                    <label for="2nd" class="m-0 mx-1 cttext fw-bold" style="min-width: fit-content;">2nd Half</label><br>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="d-flex col-12 w-100">
                                                        <div class="w-100 position-relative"> <label for="" class="smaTxt "><span class="fontmed">Any Reason</span>
                                                            </label>
                                                            <div class="rounded border border-secondary w-100">
                                                                <textarea type="text" name="reason" placeholder=" Justify your reason (if any)" style="height: 135px;" class="border-0 rounded w-100" required></textarea>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>


                                            </div>
                                            <div class="row justify-content-center mt-3">
                                                <button type="submit" class="baseBtnBg col-1 d-flex justify-content-around align-items-center border-0 para p-2 rounded text-white">
                                                    Submit
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div>

                <!-- work from home -->
                <!--<div class="leaveForm baseShadow mt-4 borderRadius p-3" id="exTab1">-->
                <!--    <div>-->
                <!--        <p class="SubHeding text-center">Request work from home</p>-->
                <!--            <div class="row">-->
                <!--                <div class="d-flex flex-column col-6">-->
                <!--                    <label for="" class="para">Select Date</label>-->
                <!--                    <input type="date" name="">-->
                <!--                </div>-->
                <!--                <div class="d-flex flex-column col-6">-->
                <!--                    <label for="" class="para">To Date</label>-->
                <!--                    <input type="date" name="">-->
                <!--                </div>-->
                <!--                <div class="d-flex flex-column col-12">-->
                <!--                    <label for="" class="para">Reason</label>-->
                <!--                    <input type="text" name="">-->
                <!--                </div>-->
                <!--            </div>-->
                <!--            <div class="d-flex justify-content-end mt-3">-->
                <!--                <button type="submit" class="baseBtnBg border-0 para p-2 rounded text-white">-->
                <!--                    Submit</button>-->
                <!--            </div>-->
                <!--    </div>-->
                <!--</div>-->
            </div>
        </div>
    </div>
</div>
@include("user.includes.footer")
<script>
    // hide alert message
    function hideAlert(id, delay) {
        setTimeout(function() {
            let alertElement = document.getElementById(id);
            if (alertElement) {
                alertElement.style.display = 'none';
            }
        }, delay);
    }

    document.addEventListener('DOMContentLoaded', function() {
        hideAlert('success-alert', 3000); // Hide after 3 seconds
        hideAlert('error-alert', 3100); // Hide after 3.1 seconds
    });

    function a() {
        let x = $("#leave_from").val();
        $("#leave_to").attr("min", x);
    }
</script>
<script>
    document.getElementById("defaultOpen").click();

    function openPage(pageName, elmnt) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tab-pane");
        tablinks = document.querySelectorAll('.tablink');
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].style.backgroundColor = '#8f8e8eb7';
        }
        elmnt.style.backgroundColor = '#EEFAFB';
        document.getElementById(pageName).style.display = "block";
    }
</script>