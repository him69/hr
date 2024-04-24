<style>
    .fixed-cols table td:nth-child(1) {
        position: sticky;
        left: -1px;
        background-color: #f8f9fa;
        z-index: 1;
    }

    .fixed-cols table tr:nth-child(1) {
        position: sticky;
        top: 0;
        background-color: #f8f9fa;
        z-index: 1;
    }
</style>
<div class="table-responsive fixed-cols" style="height:100%;">
    <div class="d-flex justify-content-between">
        <div>
            <h5 class="m-0"><b>Attendance of Teammates</b></h5>
            <p class="text-secondary m-0" style="font-size: 12px;">Click on each teammates to check the details view</p>
        </div>
        <p class="d-flex align-items-end"> <span id="att_name"></span><span class="mx-1"> <?php print_r(date_format(date_create($year . '-' . $month), "M Y")); ?></span></p>
    </div>

    <table class="table table-bordered">
        <tr> 
            <th>
                Name
            </th>
            @if($type == 1)
            <th style=min-width:40px;>
                <p style=min-width:40px;>Sale Done/Targ.</p>
            </th>
            <th style=min-width:30px;>
                <p style=min-width:30px;>Leads</p>
            </th>
            @endif
            <?php
$numDays = cal_days_in_month(CAL_GREGORIAN, $month, $year); // Number of days in the specified month
for ($i = 1; $i <= $numDays; $i++) {
    $timestamp = mktime(0, 0, 0, $month, $i, $year);
    $cdate = date('Y-m-d', $timestamp);
    $day = date('D', $timestamp);
    echo "<th class='px-0' style='min-width:30px;' " . ($type == 1 ? "data-bs-toggle='offcanvas' data-bs-target='#offcanvasRight' aria-controls='offcanvasRight' onclick=\"perDayReport('$cdate')\"" : "") . "><p class='vsmatxt text-center' style='min-width:30px;'>$day</p><p class='vsmatxt text-center'>$i</p></th>";

}
?>

        </tr>
        @php($serial = 1)
        @foreach($attendance as $userId => $user_attendance)
        <tr>
            <td>
                <div class="d-flex fw-bold d-flex align-items-center">
                    <span class='vsmatxt'>{{$serial}}.</span> <a class="smaTxt text-black mx-1" href="{{env('APP_URL').'admin/attendance/full_report/'.$user_attendance['id']}}">{{$userId}}</a>
                </div>
            </td>
            @if($type == 1)
            <td class="text-center px-2 py-1 vsmatxt">{{$user_attendance['sale_done']}}/ {{$user_attendance['target']['targ']}}</td>
            <td class="text-center px-2 py-1 vsmatxt">{{$user_attendance['total_leads']}}</td>
            @endif
            @for($mte = 1; $mte <= $numDays; $mte++) <?php
                                                        $dayKey = sprintf('%02d', $mte);
                                                       
                                                        $currentDateStr = sprintf('%s-%02d-%02d', $year, $month, $mte);
                                                        $dayOfWeek = date('D', strtotime($currentDateStr));
                                                        $todayStr = date('Y-m-d');
                                                        $isFutureDate = strtotime($currentDateStr) > strtotime($todayStr);
                                                        $mark = $user_attendance[$dayKey] ?? (in_array($date."-".$dayKey,$hdates) ? 'NH' : 'A');
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
                <td class="text-center px-1 py-2 arrPoin  vsmatxt text-white position-relative" @if($type == 1)  @if($mark !== 'NH') onclick="userReport('{{$currentDateStr}}', {{$user_attendance['id']}},'{{$currentDateStr}}-{{$user_attendance['id']}}')" @endif @endif style="height:28px;min-width:30px;overflow: visible; {{ $mark == 'P' ? 'background:green;' : ($mark == 'NH' ? 'background:#0067ff;' :  ($mark == 'HPL' ? 'background:#7c7e7f;' :  ($mark == 'H' ? 'background:#7c7e7f;' : ($mark == 'LI' ? 'background:#009aff88;' : ($mark == 'PL' ? 'background:#08463f;' : ($mark == 'UPL' ? 'background:#EF4336;' : ($mark == 'A' ? 'background:#B33F40;' : 'background:none;'))))))) }};">
                    <p class="rounded" style="min-width:30px;">
                        {{ $mark }} 
                        <!-- blinking dot  -->
                        @if($mark == 'LI')
                            <span class="blinking-dot"></span>
                            <!-- move below div out of 'if' condition  -->
                            
                        @endif
                        @if($type == 1)
                        @if($mark !== 'NH')
                        <div class="position-absolute shadow-lg report-container" id="{{$currentDateStr}}-{{$user_attendance['id']}}" style="
                            width: 400px;
                            background: white;
                            display:none;
                            z-index: 3;
                            border: 1px solid #d1d1d1;
                        "> 
                        </div>
                        @endif
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