@include('admin.includes.header')
<style>
    th,
    td {
        text-align: center;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th {
        /* background: #fff !important; */
        position: sticky;
        top: 0;
        /* Don't forget this, it's important */
        box-shadow: 0 2px 2px -1px rgba(0, 0, 0, 0.4);
    }

    th,
    td {
        text-align: left;
        padding: 8px;
    }

    .table-bordered th,
    .table-bordered td {
        border: 1px solid #d1d1d1;
    }

    tbody tr:first-child,thead tr:first-child {
        background-color: #EEFAFB !important;
    }

    .blinking-dot {
        height: 10px;
        width: 10px;
        border-radius: 50%;
        background-color: #009aff;
        display: inline-block;
        margin-left: 5px;
        animation: blink-animation 1s infinite;
        /* Adjust timing as needed */
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

    .report-container::before {
        content: "";
        height: 10px;
        width: 10px;
        border-radius: 0 0 50%;
        background: #343a40;
        position: absolute;
        left: 0;
    }
    .app-header.justify-content-center.close{
            z-index: 5 !important;
        }

</style>
<div class="spinner-box hidden">
    <div class="circle-border">
        <div class="circle-core"></div>
    </div>
</div>
<div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
    @include('admin.includes.top_nav')
    <div class="ui-theme-settings">

        <div class="theme-settings__inner">
            <div class="scrollbar-container">

            </div>
        </div>
    </div>
    <div class="app-main">
        @include('admin.includes.sidebar')
        <div class="app-main__outer collapse table-responsive">
            <div class="app-main__inner  mt-4 overflow-hidden mx-0">
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex align-items-center">
                            <div class="d-flex justify-content-between  baseBtnbr rounded-2 my-2">
                                <div class="">
                                    <input type="month" id="month" value="{{date('Y-m')}}" class="form-control border-0 bg-transparent vsmatxt">
                                </div>
                                <button class="btn baseBtnBg w-100 m-1 py-0" onclick="bymonth()">
                                    <span class=""><i class="bi bi-search"></i></span>
                                </button>
                            </div>
                            <div class="p-2 mx-1 bg-white border border-black overflow-hidden rounded-1">
                                <select class="border-0 w-100 bg-white p-1 Vsmall text-capitalize" id="contentSwitcher" onchange="updateContent()" style="font-size: 12px;">
                                    <option value="1">Sales Team</option>
                                    <option value="2">QA Team</option>
                                    <option value="3">HR Team</option>
                                    <option value="4">IT Team</option>
                                </select>
                            </div>
                            <div class="p-2 mx-1 bg-white border border-black overflow-hidden rounded-1">
                                <select class="border-0 w-100 bg-white p-1 Vsmall text-capitalize" id="workFilters" onchange="updateContent()" style="font-size: 12px;">
                                    <option value="0">All</option>
                                    <option value="1">In Office</option>
                                    <option value="2">WFH</option>
                                </select>
                            </div>
                           
                        </div>
                        <div id="saleAtt">
                            <div id="sales" class="bg-white p-2" style="height: calc(100vh - 150px); overflow: auto;width:100%;">
                            </div>
                        </div>
                        <!--  -->

                        <!--  -->
                    </div>
                </div>
            </div>
        </div>

        <script>
            function updateContent() {
                bymonth();
            }
        </script>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
            <div class="offcanvas-body overflow-hidden">
                <div class="per_att_report_container" id="rp_container">
                   <!-- user report will update here -->
                </div>
            </div>
        </div>
        @include('admin.includes.script')