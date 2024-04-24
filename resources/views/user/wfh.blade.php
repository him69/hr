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
        <div class="app-main__outer ">
            <div class="app-main__inner">
                <div class="leaveForm baseShadow mt-4 borderRadius p-3" id="exTab1">
                                <h2 class="text-center h2 fw-bold">Work from home request</h2>
                        <div class="tab-content mt-3 px-2">
                            <div class="tab-pane" id="1a" style="display: block;">
                                <table class="table table-striped text-center">
                                    <tr style="background-color:#EEFAFB;" class="smaTxt">
                                        <th><p class="para fw-bold">From</p></th>
                                        <th><p class="para fw-bold">To</p></th>
                                        <th><p class="para fw-bold">Reason</p></th>
                                        <th><p class="para fw-bold">status</p></th>
                                    </tr>
                                    @if($leaves->count() > 0)
                                    @foreach($leaves as $leave)
                                    <tr>
                                        <td class=" smaTxt text-muted">{{$leave->from}}</td>
                                        <td class=" smaTxt text-muted">{{$leave->to}}</td>
                                        <td class=" smaTxt text-start text-muted">{{$leave->reason}}</td>
                                        <td class=" smaTxt text-muted">@if($leave->approved == 0) <p class="text-warning m-0" > <span class="text-warning">Pending...</span></p>
                                            @elseif($leave->approved == 2) <p class="text-danger m-0" >Rejected</p>
                                            @else <p class="text-success m-0" disabled>Approved</p> @endif</td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="4">No Data Found</td>
                                    </tr>
                                    @endif
                                </table>
                            </div>
                        </div>
                </div>
            </div>
            <div>
        </div>
    </div>
</div>
</div>
@include("user.includes.footer")
<script>
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