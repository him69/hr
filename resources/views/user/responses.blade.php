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
            <div class="container mt-5">
                <div class="my-5">
                    <h3 class="para text-center"><b>Responses</b></h3>
                </div>
                <div class="borderRadius baseShadow m-auto p-4 my-2">
                    <div class="row align-items-center my-4">
                        <div class="col-12">
                            <h6 class="mb-0 fw-bold">Here are your responses</h6>
                            <p style="font-size: 12px;">The tickets which you have raised, here are all the tickets and
                                their responses.</p>
                        </div>
                    </div>
                    <table class="table table-striped">
                        <thead style="background-color:#EEFAFB;">
                            <tr>
                                <th>
                                    <p class="smaTxt fw-bold">Ticket Raised</p> <span class="text-secondary smaTxt fw-bold">
                                        (DD / MM / YYYY) </span>
                                </th>
                                <th>
                                    <p class="smaTxt fw-bold">Reasons</p><span class="text-secondary smaTxt fw-bold">
                                        The reason you raised</span>
                                </th>
                                <th>
                                    <p class="smaTxt fw-bold">Responses</p> <span class="text-secondary smaTxt fw-bold">
                                        Response from admin’s</span>
                                </th>
                                <th>
                                    <p class="smaTxt fw-bold ">Status</p><span class="text-secondary smaTxt fw-bold">&nbsp</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($ticket->count() > 0)
                            @foreach($ticket as $tickets)
                            <tr>
                                <th class="col-2 text-secondary smaTxt">{{date('j M Y', strtotime($tickets->created_at))}}</th>
                                <th class="col-4 text-secondary smaTxt">
                                    <span style="font-size: 10px;">{{$tickets->description}}</span>
                                </th>
                                <th class="col-4 text-secondary smaTxt">{{$tickets->response}}</th>
                                <th class="col-2 text-secondary smaTxt">@if($tickets->status == 0){{'Open'}}@elseif($tickets->status == 1){{'Close'}}@else{{'Working'}}@endif</th>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
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