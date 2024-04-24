<style>
    .fixed-cols table td:nth-child(1), .fixed-cols table tr:nth-child(1) {
        background-color: #f8f9fa;
        position: sticky;
        z-index: 1;
    }

    .fixed-cols table td:nth-child(1) {
        left: -1px;
    }

    .fixed-cols table tr:nth-child(1) {
        top: 0;
    }
</style>

<div class="table-responsive fixed-cols" style="height:100%;">
    <div class="d-flex justify-content-between">
        <div>
            <h5 class="m-0"><b>Attendance of Teammates</b></h5>
            <p class="text-secondary m-0" style="font-size: 12px;">Click on each teammate to check the details view</p>
        </div>
        <p class="d-flex align-items-end">
            <span id="att_name"></span>
            <span class="mx-1">{{ date_format(date_create($year . '-' . $month), "M Y") }}</span>
        </p>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                @if($type == 1)
                <th style="min-width:40px;">
                    <p style="min-width:40px;">Sale Done/Targ.</p>
                </th>
                <th style="min-width:30px;">
                    <p style="min-width:30px;">Leads</p>
                </th>
                @endif
                {{-- Generate date range for table headers --}}
                @php
                    $start = new DateTime($year . '-' . $month . '-21 last month');
                    $end = new DateTime($year . '-' . $month . '-20');
                    $interval = new DateInterval('P1D');
                    $daterange = new DatePeriod($start, $interval, $end->add($interval));
                @endphp
                @foreach($daterange as $date)
                <th class="px-0" style="min-width:30px;">
                    <p class='vsmatxt text-center' style='min-width:30px;'>{{ $date->format("D") }}</p>
                    <p class='vsmatxt text-center'>{{ $date->format("j") }}</p>
                </th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($attendance as $userId => $user_attendance)
            <tr>
                <td>
                    <div class="d-flex fw-bold d-flex align-items-center">
                        <span class='vsmatxt'>{{ $loop->iteration }}.</span>
                        <a class="smaTxt text-black mx-1" href="{{ env('APP_URL') . 'admin/attendance/full_report/' . $user_attendance['id'] }}">{{ $userId }}</a>
                    </div>
                </td>
                @if($type == 1)
                <td class="text-center px-2 py-1 vsmatxt">{{ $user_attendance['sale_done'] }} / {{ $user_attendance['target']['targ'] }}</td>
                <td class="text-center px-2 py-1 vsmatxt">{{ $user_attendance['total_leads'] }}</td>
                @endif
                {{-- Attendance marks per day --}}
                @foreach($daterange as $date)
                @php
                    $dayKey = $date->format('d');
                    $mark = $user_attendance[$dayKey] ?? 'A'; // Default to 'A' for absent if not specified
                @endphp
                <td class="text-center px-1 py-2 arrPoin  vsmatxt text-white position-relative" @if($type == 1)  @if($mark !== 'NH') onclick="userReport('{{$date->format('Y-m-d')}}', {{$user_attendance['id']}},'{{$date->format('Y-m-d')}}-{{$user_attendance['id']}}')" @endif @endif style="height:28px;min-width:30px;overflow: visible; {{ $mark == 'P' ? 'background:green;' : ($mark == 'NH' ? 'background:#0067ff;' :  ($mark == 'HPL' ? 'background:#7c7e7f;' :  ($mark == 'H' ? 'background:#7c7e7f;' : ($mark == 'LI' ? 'background:#009aff88;' : ($mark == 'PL' ? 'background:#08463f;' : ($mark == 'UPL' ? 'background:#EF4336;' : ($mark == 'A' ? 'background:#B33F40;' : 'background:none;'))))))) }};">
                    <p class="rounded" style="min-width:30px;">
                        {{ $mark }} 
                        <!-- blinking dot  -->
                        @if($mark == 'LI')
                            <span class="blinking-dot"></span>
                            <!-- move below div out of 'if' condition  -->
                            
                        @endif
                        @if($type == 1)
                        @if($mark !== 'NH')
                        <div class="position-absolute shadow-lg report-container" id="{{$date->format('Y-m-d')}}-{{$user_attendance['id']}}" style="width: 400px; background: white; display:none; z-index: 3; border: 1px solid #d1d1d1;"></div>
                        @endif
                        @endif
                    </p>
                </td>
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
