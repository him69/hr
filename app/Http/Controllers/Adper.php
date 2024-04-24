<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Session;
use App\Models\User;
use App\Models\Attendance;
use App\Models\QA_attendance;// not use remove it
use App\Http\helper\Targetcalculation;
use App\Models\Adminmodel;
use App\Models\Policies;
use App\Models\User_permission;//grant permision route
use App\Models\Permissions;//grant permision route
use App\Models\Leave;
use App\Models\Holiday;
use App\Models\New_hiring;
use App\Models\Assets;
use App\Models\User_assets;
use App\Models\User_file;
use App\Models\User_status;
use App\Models\Ticket;
use App\Models\Announcement;
use App\Models\Department;
use App\Models\User_lead_by;
use App\Models\User_target;
use App\Models\Group_member;
use App\Models\Chat_group;
use Exception;
use DateTime;
use Mail;
use Carbon\Carbon;

class Adper extends controller
{
    public function index(Request $request)
    {
        if (!empty(Session::get('user'))) {
            if (!empty($request->month)) {
                $ym = $request->month;
            } else {
                $ym = date('Y-m');
            }
            $user_id = Session::get('user');
            $user = $this->user($user_id);
            $ids = $this->getfromcrm();
            $data['user'] = $user;
            $data['total_sales'] = User::where('user_type', 1)->where('status', 1)->count();
            $data['total_qa'] = User::where('user_type', 2)->where('status', 1)->count();
            $data['disabled'] = User::where('status', 0)->count();
            $notcuser = User::select('id')->whereIn('crm_emp_id', $ids)->get();
            $notcuser = json_decode(json_encode($notcuser), true);
            $notcuser = array_column($notcuser, 'id');
            // \DB::enableQueryLog();
            $data['sales'] = Attendance::select('attendance.*')->join('user', 'user.id', 'attendance.user_id')->where('user_type', 1)->whereNotIn('attendance.user_id', $notcuser)->whereNotIn('attendance.mark', ['sun'])->whereBetween('mark_date', [date($ym . '-') . '01', date($ym . '-') . '31'])->groupBy('mark_date')->selectRaw('sum(sale_made) as sum,count(attendance.id) as total_pr, mark_date')->get();
            // dd(\DB::getQueryLog());
            $datausersale = Attendance::select('attendance.*')->join('user', 'user.id', 'attendance.user_id')->where('user_type', 1)->whereNotIn('attendance.user_id', $notcuser)->whereBetween('mark_date', [date($ym . '-') . '01', date($ym . '-') . '31'])->groupBy('attendance.user_id')->orderBy('sum', 'DESC')->selectRaw('sum(sale_made) as sum, attendance.user_id')->pluck('sum', 'attendance.user_id');
            $data['usersale'] = json_decode($datausersale, true);
            $data['todaysales'] = Attendance::where('mark_date', date($ym . '-d'))->sum('sale_made');
            $data['todayactive'] = Attendance::where('mark_date', date($ym . '-d'))->count();
            $data['saleatt'] = Attendance::where('mark_date', date($ym . '-d'))->join('user', 'user.id', 'attendance.user_id')->where('user.user_type', 1)->count();
            $data['qaatt'] = Attendance::where('mark_date', date($ym . '-d'))->join('user', 'user.id', 'attendance.user_id')->where('user.user_type', 2)->count();
            $data['hratt'] = Attendance::where('mark_date', date($ym . '-d'))->join('user', 'user.id', 'attendance.user_id')->where('user.user_type', 3)->count();
            $data['itatt'] = Attendance::where('mark_date', date($ym . '-d'))->join('user', 'user.id', 'attendance.user_id')->where('user.user_type', 4)->count();

            $data['todayleave'] = Leave::select('user.name')->where('leave_from', '<=', date($ym . '-d'))->where('leave_to', '>=', date($ym . '-d'))->where('approved', 1)->join('user', 'user.id', 'leave_application.user_id')->get();

            $today = date('Y-m-d', strtotime($ym . '-1'));
            $t = User_target::where('server_type', 1)->whereDate('from', '<=', $today)->whereDate('to', '>=', $today)->get();
            if ($t->count() > 0) {
                $data['target'] = $t[0]->target;
            } else {
                $data['target'] = 800;
            }
            $data['monthtarget'] = Attendance::whereNotIn('attendance.user_id', $notcuser)->whereBetween('mark_date', [date($ym . '-') . '01', date($ym . '-') . '31'])->sum('sale_made');
            // TEAM TARGET AND SALES
            $data['teamStat'] = User::select('user.id', 'user.user_id', 'user.name', 'department.d_name', 'department.id AS dep_id', 'user.server_ip', 'user.salary')->where('status', 1)->where('lead', 1)->where('user_type', 1)
                ->leftjoin('department', 'department.id', '=', 'user.user_type')->get();

            $currentDate = date($ym . '-d');
            $currentMonthStart = date($ym . '-01'); // First day of the current month
            $currentMonthEnd = date($ym . '-t');
            $totalSumOfTargets = 0; // Initialize total sum of targets for all teams

            foreach ($data['teamStat'] as $key => $teamStat) {
                $sumOfTargetsForTeam = 0;

                // Prepare an array to hold team members (including the leader) and their targets
                $teamMembersWithTargets = [];

                // First, calculate the leader's target as they are also part of the team
                $leaderTargets = User_target::where('server_type', $teamStat->server_ip)
                    ->whereDate('from', '<=', $currentDate)
                    ->whereDate('to', '>=', $currentDate)
                    ->where('target_type', 2) // Assuming 0 signifies a specific target type
                    ->get();
                // dd($leaderTargets);
                $leaderTargetSum = 0; // Initialize leader's target sum

                foreach ($leaderTargets as $target) {
                    if ($teamStat->server_ip == '144.76.0.239') {
                        $bttf = (($teamStat->salary / 1000) / 100);
                        $targ = round($bttf * $target->target);
                    } else {
                        $targ = $target->target;
                    }

                    // Add to the leader's target sum
                    $leaderTargetSum += $targ;
                }

                // Add the leader's target to the team's total target sum
                $sumOfTargetsForTeam += $leaderTargetSum;
                $leaderSalesThisMonth = Attendance::where('user_id', $teamStat->id)
                ->whereBetween('mark_date', [$currentMonthStart, $currentMonthEnd])
                ->sum('sale_made');
                // Add leader details and their target to the team members array
                $teamMembersWithTargets[] = [
                    'id' => $teamStat->id,
                    'user_id' => $teamStat->user_id,
                    'name' => $teamStat->name,
                    'department_name' => $teamStat->d_name,
                    'target' => $leaderTargetSum, // Assuming you've calculated this earlier
                    'sales' => $leaderSalesThisMonth, // Add the sales data
                ];
                // Fetch team members for each leader
                $teamMembers = User_lead_by::select('user.id', 'user.name', 'user.user_id', 'department.d_name', 'user.server_ip', 'user.salary')
                    ->where('leader_id', $teamStat->id)
                    ->where('user_lead_by.status', 1)
                    ->leftJoin('user', 'user.id', '=', 'user_lead_by.uid')
                    ->leftJoin('department', 'department.id', '=', 'user.user_type')
                    ->get();


                foreach ($teamMembers as $member) {
                    // Fetch target for each member based on server_ip and current date
                    $userTargets = User_target::where('server_type', $member->server_ip)
                        ->whereDate('from', '<=', $currentDate)
                        ->whereDate('to', '>=', $currentDate)
                        ->where('target_type', 2) // Assuming 0 signifies a specific target type
                        ->get(); // Use get() to fetch and iterate for individual calculations

                    $memberTargetSum = 0; // Initialize member's target sum
                    $memberSalesThisMonth = Attendance::where('user_id', $member->id)
                    ->whereBetween('mark_date', [$currentMonthStart, $currentMonthEnd])
                    ->sum('sale_made'); 
                    foreach ($userTargets as $target) {
                        if ($member->server_ip == '144.76.0.239') {
                            $bttf = (($member->salary / 1000) / 100);
                            $targ = round($bttf * $target->target);
                        } else {
                            $targ = $target->target;
                        }

                        // Add to the member's target sum
                        $memberTargetSum += $targ;
                    }

                    // Add member details and their target to the team members array
                    $teamMembersWithTargets[] = [
                        'id' => $member->id,
                        'user_id' => $member->user_id,
                        'name' => $member->name,
                        'department_name' => $member->d_name,
                        'target' => $memberTargetSum,
                        'sales' => $memberSalesThisMonth,
                    ];

                    // Add to the sum of targets for the current team
                    $sumOfTargetsForTeam += $memberTargetSum;
                }

                // Store the team members and sum of targets in the teamStat object
                $data['teamStat'][$key]->teamMembers = $teamMembersWithTargets;
                $data['teamStat'][$key]->totalTarget = $sumOfTargetsForTeam;

                // Add to the overall total sum of targets
                $totalSumOfTargets += $sumOfTargetsForTeam;
            }


            // Assuming you already have $data['teamStat'] populated as before
             // Last day of the current month

            $totalSalesForAllTeams = 0;

            foreach ($data['teamStat'] as $key => $teamStat) {
                // Initialize sum of sales for the current team, including the leader
                $sumOfSalesForTeam = 0;

                // Prepare an array to hold team members (including the leader)
                $teamMembers = $teamStat->teamMembers;

                foreach ($teamMembers as $member) {
                    $memberSalesThisMonth = Attendance::where('user_id', $member['id'])
                        ->whereBetween('mark_date', [$currentMonthStart, $currentMonthEnd])
                        ->sum('sale_made');

                    $sumOfSalesForTeam += $memberSalesThisMonth;
                }


                $data['teamStat'][$key]->totalSales = $sumOfSalesForTeam;


                $totalSalesForAllTeams += $sumOfSalesForTeam;
            }

            // $totalSalesForAllTeams now holds the total sales for all teams, including each leader and their team members.
            // TEAM TARGET AND SALES END    


            $data['ym'] = $ym;
            // dd($member['id']);
            // dd(  $data['teamStat']->toArray());
            $data['chat_group'] = Chat_group::get();
            $data['chat_group_list'] = User::select('user.user_id', 'user.id AS uid', 'user.name', 'user.photo', 'user.user_type')->where('status', 1)->get();
            $today = now();
            $data['birthdays'] = User::select('name', 'user_id', 'dob')->where('status', 1)->where(function ($query) use ($today) {
                $query->whereMonth('dob', '>', $today->month)->orWhere(function ($subQuery) use ($today) {
                    $subQuery->whereMonth('dob', $today->month)->whereDay('dob', '>=', $today->day);
                });
            })->orderByRaw('MONTH(dob) ASC, DAY(dob) ASC')->limit(5)->get();
            
            $currentDate = Carbon::now(); 
            $day = $currentDate->day; 
            $month = $currentDate->month; 
            
            $data['todayBirth'] = User::select('name', 'user_id', 'dob')
                ->where('status', 1)
                ->whereDay('dob', $day)
                ->whereMonth('dob', $month)
                ->get();

    $data['usersAnniversary'] = User::select('name', 'user_id', 'joining_date')
                    ->where('status', 1)
                    ->whereMonth('joining_date', '=', $today->month)
                    ->whereDay('joining_date', '<=', $today->day)
                    ->where('joining_date', '<=', $today->toDateString())
                    ->get()
                    ->filter(function ($user) use ($today) {
                        $years = $today->diffInYears(Carbon::parse($user->joining_date));
                        $user->years = $years;
                        return $years >= 1;
                    })
                    ->sortBy('joining_date')
                    ->take(5);

            // dd( $data['todayBirth']->toArray(),$data['usersAnniversary']->toArray() );
            $data['leaves'] = Leave::select('leave_application.id', 'leave_application.created_at', 'leave_application.created_at', 'leave_application.user_id', 'leave_application.leave_type', 'leave_application.leave_from', 'leave_application.leave_to', 'leave_application.reason', 'leave_application.approved', 'user.user_id', 'user.user_id AS user_ida')->whereBetween('leave_from', [date($ym . '-') . '01', date($ym . '-') . '31'])->where('leave_application.approved', 0)->join('user', 'leave_application.user_id', 'user.id')->where('user.status', 1)->limit(3)->get();
            return view('user.admin.index', $data);
        } else {
            return redirect(env('APP_URL') . 'adper');
        }
    }

    public function attendance(Request $request)
    {
        if (!empty(Session::get('user'))) {
            $user_id = Session::get('user');
            $user = $this->user($user_id);
            $data['user'] = $user;
            // dd($user->toArray());

            return view('user.admin.attendance', $data);
        } else {
            return redirect(env('APP_URL') . 'adper');
        }
    }
    
    
    public function sales(Request $request)
    {
        if (!empty(Session::get('user'))) {
            $user_id = Session::get('user');
            $user = $this->user($user_id);
            $data['user'] = $user;
            if (!empty($request->month)) {
                $e = explode('-', $request->month);
                $data['year'] = $year = $e[0];
                $data['month'] = $month = $e[1];
                $data['date'] = $request->month;
            } else {
                $data['year'] = $year = date('Y');
                $data['month'] = $month = date('m');
                $data['date'] = date('Y-m');
            }
            $utype = $data['type'] = $request->type;
            $firstDay = $data['date'] . '-01';
            $lastDay = date('Y-m-t', strtotime($firstDay));
            $workType = $request->input('workType');

            $usersQuery = Attendance::select('attendance.*', 'user.user_id', 'user.id', 'user_salary.salary', 'user.server_ip')
                ->join('user', 'attendance.user_id', '=', 'user.id')
                ->leftJoin('user_salary', 'attendance.user_id', '=', 'user_salary.uid')
                ->where('user.status', '=', '1')
                ->where('user.user_type', '=', $request->input('type'))
                ->whereDate('user_salary.from', '<=', $firstDay)
                ->whereDate('user_salary.to', '>=', $firstDay);

            if (!empty($workType)) {
                $usersQuery->where('user.work_type', '=', $workType);
            }

            $users = $usersQuery->whereBetween('mark_date', [$firstDay, $lastDay])
                ->orderBy('mark_date', 'asc')
                ->get();
            if ($users->count() == 0) {
                $data['attendance'] = [];
                return view('user.admin.attendance.sales', $data);
            }
            $today = date('Y-m-d', strtotime($data['date'] . '-1'));
            $todate = date('Y-m-d');
            if($utype == 1){
            $targets = User_target::whereIn('server_type', ['144.76.0.239', '122.186.6.91'])
            ->whereDate('from', '<=', $today)
            ->whereDate('to', '>=', $today)
            ->groupBy('server_type', 'target_type')
            ->selectRaw('server_type, target_type, SUM(CASE WHEN target_type = 0 THEN target ELSE 0 END) as target_sum_targ, SUM(CASE WHEN target_type = 1 THEN target ELSE 0 END) as target_sum_lead')
            ->get();
            
            $data['us_umst'] = $us_umst44 = $targets->where('server_type', '144.76.0.239')->where('target_type', 0)->first()->target_sum_targ ?? 0;
            $data['us_umst'] = $us_umst22 = $targets->where('server_type', '122.186.6.91')->where('target_type', 0)->first()->target_sum_targ ?? 0;
            $data['us_umsl'] = $us_umsl44 = $targets->where('server_type', '144.76.0.239')->where('target_type', 1)->first()->target_sum_lead ?? 0;
            $data['us_umsl'] = $us_umsl22 = $targets->where('server_type', '122.186.6.91')->where('target_type', 1)->first()->target_sum_lead ?? 0;
            }
            $holi = Holiday::whereBetween('hdate', [$year . '-' . $month . '-01', $year . '-' . $month . '-31'])->count();
            $data['total_working'] = cal_days_in_month(CAL_GREGORIAN, $month, $year) - $this->dayCount('Sunday', $month, $year) - $holi;
            $holidayCheck = Holiday::select('hdate')->whereBetween('hdate', [$firstDay, $lastDay])->where(function($q) use ($request){$q->where('user_type', $request->input('type'))->orWhere('user_type',0);})->get();
            $data['hdates'] = $hdates = array_column($holidayCheck->toArray(), "hdate");
            // dd($holidayCheck->toArray());
            // exit;
            foreach ($users as $user) {
                $userId = $user->user_id;
                $markdateday = explode('-', $user->mark_date);
                $markornot = end($markdateday);
                $isCurrentDay = $user->mark_date == $todate;
                if(in_array($user->mark_date,$hdates)){
                    $data['attendance'][$userId][$markornot] = "NH";
                }else{
                    if ($isCurrentDay && is_null($user->mark)) {
                        $data['attendance'][$userId][$markornot] = "LI";
                    }else{
                        $data['attendance'][$userId][$markornot] = $user->mark;
                    }
                }
                if (!empty($data['attendance'][$user->user_id]['sale_done'])) {
                    $data['attendance'][$user->user_id]['sale_done'] += $user->sale_made;
                } else {
                    $data['attendance'][$user->user_id]['sale_done'] = $user->sale_made;
                }
                $data['attendance'][$userId]['id'] = $user->id;
                if($utype == 1){
                if ($user->server_ip == '122.186.6.91') {
                        $user_target = $us_umst22;
                        $user_lead = $us_umsl22;
                    } elseif ($user->server_ip == '144.76.0.239') {
                        $user_target = $us_umst44;
                        $user_lead = $us_umsl44;
                    }
                    $userTargets = Targetcalculation::targetSolution($user, $user_target, $user_lead);
                    $data['attendance'][$userId]['target'] = $userTargets;
                    if(isset($data['attendance'][$userId]['total_leads'])){
                        $data['attendance'][$userId]['total_leads'] += $user->leads;
                    }else{
                        $data['attendance'][$userId]['total_leads'] = $user->leads;
                    }
                }
            }
// exit;
            return view('user.admin.attendance.sales', $data);
        } else {
            return redirect(env('APP_URL') . 'adper');
        }
    }
    
    public function  userReport($date, $id)
    {
        $data['user'] = Attendance::select('attendance.mark', 'attendance.mark_date', 'attendance.login_time', 'attendance.logout_time', 'attendance.nonpause', 'attendance.sale_made', 'attendance.customer', 'attendance.leads', 'user.name')->where('mark_date', $date)
            ->where('attendance.user_id', $id)
            ->leftJoin('user', 'user.id', '=', 'attendance.user_id')
            ->where('user.id', $id)->get();
        return response()->json($data);
    }
    public function per_day_report($date)
    {
        $data['user'] = Attendance::select('attendance.mark', 'attendance.mark_date', 'attendance.login_time', 'attendance.logout_time', 'attendance.nonpause', 'attendance.sale_made', 'attendance.customer', 'attendance.leads', 'user.crm_emp_id', 'user.id')->where('mark_date', $date)
            ->leftJoin('user', 'user.id', '=', 'attendance.user_id')->where('user.user_type',1)->get();
            echo "<table>";
            echo "<tr>";
                echo "<td>id</td>";
                echo "<td>crm_emp_id</td>";
                echo "<td>sale_made</td>";
                echo "<td>customer</td>";
                echo "<td>leads</td>";
                echo "</tr>";
            foreach($data['user'] as $d){
                echo "<tr>";
                echo "<td>".$d['id']."</td>";
                echo "<td>".$d['crm_emp_id']."</td>";
                echo "<td>".$d['sale_made']."</td>";
                echo "<td>".$d['customer']."</td>";
                echo "<td>".$d['leads']."</td>";
                echo "</tr>";
            }
            echo "</table>";
        // return response()->json($data);
    }
    // public function sales(Request $request)
    // {
    //     if (!empty(Session::get('user'))) {
    //         $user_id = Session::get('user');
    //         $user = $this->user($user_id);
    //         $data['user'] = $user;
    //         if (!empty($request->month)) {
    //             $e = explode('-', $request->month);
    //             $data['year'] = $year = $e[0];
    //             $data['month'] = $month = $e[1];
    //             $data['date'] = $request->month;
    //         } else {
    //             $data['year'] = $year = date('Y');
    //             $data['month'] = $month = date('m');
    //             $data['date'] = date('Y-m');
    //         }
    //         $utype = $data['type'] = $request->type;
    //         $total_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
    //         $currentDate = "$year-$month-01";
    //             $firstDay = $data['date'] . '-01';
    //             $lastDay = date('Y-m-t', strtotime($firstDay));
    //         // dd(($currentDate));
    //         $workType = $request->input('workType');

    //         // Start building the query
    //         $usersQuery = Attendance::select('attendance.*', 'user.user_id', 'user.id', 'user_salary.salary', 'user.server_ip')
    //             ->join('user', 'attendance.user_id', '=', 'user.id')
    //             ->leftJoin('user_salary', 'attendance.user_id', '=', 'user_salary.uid')
    //             ->where('user.status', '=', '1')
    //             ->where('user.user_type', '=', $request->input('type'))
    //             ->whereDate('user_salary.from', '<=', $currentDate)
    //             ->whereDate('user_salary.to', '>=', $currentDate);

    //         // Conditionally add the work type filter
    //         if (!empty($workType)) {
    //             $usersQuery->where('user.work_type', '=', $workType);
    //         }

    //         // Continue building the query as needed...
    //         $users = $usersQuery->whereBetween('mark_date', ["$year-$month-01", "$year-$month-$total_days"])
    //             ->orderBy('mark_date', 'asc')
    //             ->get();
    //         if ($users->count() == 0) {
    //             $data['attendance'] = [];
    //             return view('user.admin.attendance.sales', $data);
    //         }
    //         $today = date('Y-m-d', strtotime($data['date'] . '-1'));
    //         $todate = date('Y-m-d');
    //         if($utype == 1){
    //             $min_targ44 = User_target::where('target_type', 0)->where('server_type','144.76.0.239')
    //                 ->whereDate('from', '<=', $today)
    //                 ->whereDate('to', '>=', $today)
    //                 ->get();
    //             $min_targ22 = User_target::where('target_type', 0)->where('server_type','122.186.6.91')
    //                 ->whereDate('from', '<=', $today)
    //                 ->whereDate('to', '>=', $today)
    //                 ->get();
                    
    //             $min_lead44 = User_target::where('target_type', 1)->where('server_type','144.76.0.239')
    //                 ->whereDate('from', '<=', $today)
    //                 ->whereDate('to', '>=', $today)
    //                 ->get();
    //             $min_lead22 = User_target::where('target_type', 1)->where('server_type','122.186.6.91')
    //                 ->whereDate('from', '<=', $today)
    //                 ->whereDate('to', '>=', $today)
    //                 ->get();
    //                 $data['us_umst'] = $us_umst44 = $min_targ44->count() ? $min_targ44->first()->target : 0;
    //                 $data['us_umst'] = $us_umst22 = $min_targ22->count() ? $min_targ22->first()->target : 0;
    //                 $data['us_umsl'] = $us_umsl44 = $min_lead44->count() ? $min_lead44->first()->target : 0;
    //                 $data['us_umsl'] = $us_umsl22 = $min_lead22->count() ? $min_lead22->first()->target : 0;
    //         }
    //         $holi = Holiday::whereBetween('hdate', [$year . '-' . $month . '-01', $year . '-' . $month . '-31'])->count();
    //         $data['total_working'] = cal_days_in_month(CAL_GREGORIAN, $month, $year) - $this->dayCount('Sunday', $month, $year) - $holi;
    //         foreach ($users as $user) {
    //             $userId = $user->user_id;
    //             $markdateday = explode('-', $user->mark_date);
    //             $markornot = end($markdateday);
    //             $isCurrentDay = $user->mark_date == $todate; 
    //             if($utype == 1){
    //                 if($user->server_ip == '122.186.6.91'){
    //                     $user_target = $us_umst22;
    //                     $user_lead = $us_umsl22;
    //                 }elseif($user->server_ip=='144.76.0.239'){

    //                     $user_target = $us_umst44;
    //                     $user_lead = $us_umsl44;
    //                 }
    //             $userTargets = Targetcalculation::targetSolution($user, $user_target,$user_lead);
    //             }
    //             // Check for holidays first
    //             $holidayCheck = Holiday::whereBetween('hdate', [$firstDay, $lastDay])
    //                 ->where('user_type', '=', $request->input('type'))
    //                 ->get();
    //             if ($isCurrentDay && is_null($user->mark)) {
    //                 $data['attendance'][$userId][$markornot] = "LI";
    //             } else {

    //                 $isHoliday = false; // Flag to indicate if the current day is a holiday
    //                 if ($holidayCheck->isNotEmpty()) {
    //                     foreach ($holidayCheck as $mark_holi) {
    //                         $day = date('j', strtotime($mark_holi->hdate));
    //                         if ($day == $markornot) {
    //                             $isHoliday = true;
    //                         }
    //                         $data['attendance'][$userId][$day] = "NH";
    //                     }
    //                 }
    //                 if (!$isHoliday) {
    //                     $data['attendance'][$userId][$markornot] = $user->mark;
    //                 }
    //             }
    //             // Handle sales made
    //             if (!empty($data['attendance'][$user->user_id]['sale_done'])) {
    //                 $data['attendance'][$user->user_id]['sale_done'] += $user->sale_made;
    //             } else {
    //                 $data['attendance'][$user->user_id]['sale_done'] = $user->sale_made;
    //             }
    //             $data['attendance'][$userId]['id'] = $user->id;

    //             if($utype == 1){ $data['attendance'][$userId]['target'] = $userTargets; }
    //         }

    //         return view('user.admin.attendance.sales', $data);
    //     } else {
    //         return redirect(env('APP_URL') . 'adper');
    //     }
    // }
    public function attendance_mark(Request $request)
    {
        if (!empty(Session::get('user'))) {
            $user_id = Session::get('user');
            $user = $this->user($user_id);
            $data['user'] = $user;
            $data['date'] = date('Y-m-d');
            if (isset($request->_token)) {
                if (isset($request->date)) {
                    $data['date'] = $request->date;
                } else {
                    $ch = Attendance::where('mark_date', $request->mark_date)->where('user_id', $request->user_id);
                    if ($ch->count() > 0) {
                        $ch->update(['sale_made' => $request->sale_made, 'login_time' => $request->login_time, 'logout_time' => $request->logout_time, 'customer' => $request->customer, 'incentive' => $request->incentive, 'mark' => $request->mark, 'verify' => 1, 'old_mark' => $ch->get()[0]->mark, 'total_update' => 'total_update + 1']);
                    } else {
                        Attendance::create(['sale_made' => $request->sale_made, 'login_time' => $request->login_time, 'logout_time' => $request->logout_time, 'customer' => $request->customer, 'incentive' => $request->incentive, 'mark' => $request->mark, 'mark_date' => $request->mark_date, 'user_id' => $request->user_id, 'verify' => 1]);
                    }
                    print_r('<script>window.close();</script>');
                }
            }
            $data['users'] = Attendance::where('mark_date', $data['date'])->join('user', 'attendance.user_id', 'user.id')->where('user.status', 1)->get();
            return view('user.admin.mark', $data);
        } else {
            return redirect(env('APP_URL') . 'adper');
        }
    }
    public function markincentive(Request $request)
    {
        print_r(Attendance::where('paid', 0)->where('user_id', $request->post()['uid'])->whereBetween('mark_date', [$request->post()['mark'][0], end($request->post()['mark'])])->update(['paid' => 1]));
        print_r($request->post());
        print_r('<script>window.close();</script>');
    }
    public function full_report($id, Request $request)
    {
        if (!empty(Session::get('user'))) {
            $user_id = Session::get('user');
            $user = $this->user($user_id);
            $data['user'] = $user;
            $year = date('Y');
            $month = date('m');
            $total_days = date('d');
            $data['date'] = date('Y-m');
            $data['id'] = $id;
            // print_r($request->showtab);exit;
            $data['showtab'] = 'nav-home';
            if ($request->showtab) {
                $data['showtab'] = $request->showtab;
            }
            if (isset($request->_token)) {
                if (isset($request->month)) {
                    $aa = explode('-', $request->month);
                    $year = $aa[0];
                    $month = $aa[1];
                    $total_days = 31;
                    $data['date'] = $request->month;
                } else {
                    $ch = Attendance::where('mark_date', $request->mark_date)->where('user_id', $request->user_id);
                    if ($ch->count() > 0) {
                        $up = ['sale_made' => $request->sale_made, 'login_time' => $request->login_time, 'logout_time' => $request->logout_time, 'customer' => $request->customer, 'incentive' => $request->incentive, 'mark' => $request->mark];
                        echo $ch->update($up);
                    } else {
                        Attendance::create(['sale_made' => $request->sale_made, 'login_time' => $request->login_time, 'logout_time' => $request->logout_time, 'customer' => $request->customer, 'incentive' => $request->incentive, 'mark' => $request->mark, 'mark_date' => $request->mark_date, 'user_id' => $request->user_id]);
                    }
                    print_r('<script>window.close();</script>');
                    exit;
                }
            }
            $profile = User::select('user.*','department.d_name')->where('user.id', $id)->join('department','department.id','=','user.user_type')->get();
            $data['total_working'] = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            if ($profile->count() > 0) {
                $data['profile'] = $profile[0];
                if (($data['profile']->user_type == 1) or ($data['profile']->user_type == 2) or ($data['profile']->user_type == 3)) {
                    $data['users'] = Attendance::where('attendance.user_id', $id)->whereBetween('mark_date', ["$year-$month-01", "$year-$month-$total_days"])->orderBy('mark_date')->get();
                } else {
                    $data['users'] = Attendance::where('attendance.user_id', $id)->whereBetween('mark_date', ["$year-$month-01", "$year-$month-$total_days"])->orderBy('mark_date')->get();
                }
                $data['leaves'] = Leave::select('leave_application.id', 'leave_application.user_id', 'leave_application.created_at', 'leave_application.leave_from', 'leave_application.leave_to', 'leave_application.reason', 'leave_application.approved', 'user.user_id')->where('leave_application.user_id', $id)->join('user', 'leave_application.user_id', 'user.id')->where('user.status', 1)->get();
                $data['ass'] = Assets::select('assets.*', 'user_assets.from')->join('user_assets', 'user_assets.assets_id', 'assets.id')->where('user_assets.uid', $id)->where('user_assets.status', 'assign')->get();
                // $data['alluser'] = User::where('status',1)->get();
                $data['user_file'] = User_file::where('uid', $id)->get();
                return view('user.admin.report3', $data);
            } else {
                return redirect(env('APP_URL') . 'adper/users');
            }
        } else {
            return redirect(env('APP_URL') . 'adper');
        }
    }
    public function full_report2($id, Request $request)
    {
        if (!empty(Session::get('user'))) {
            $user_id = Session::get('user');
            $user = $this->user($user_id);
            $data['user'] = $user;
            $year = date('Y');
            $month = date('m');
            $total_days = date('d');
            $data['date'] = date('Y-m');
            $data['id'] = $id;
            $data['showtab'] = 'nav-home';
            if (isset($request->_token)) {
                if (isset($request->month)) {
                    $aa = explode('-', $request->month);
                    $year = $aa[0];
                    $month = $aa[1];
                    $data['date'] = $request->month;
                    $total_days = 31;
                } else {
                    $ch = Attendance::where('mark_date', $request->mark_date)->where('user_id', $request->user_id);
                    if ($ch->count() > 0) {
                        $ch->update(['sale_made' => $request->sale_made, 'login_time' => $request->login_time, 'logout_time' => $request->logout_time, 'customer' => $request->customer, 'incentive' => $request->incentive, 'mark' => $request->mark]);
                    } else {
                        Attendance::create(['sale_made' => $request->sale_made, 'login_time' => $request->login_time, 'logout_time' => $request->logout_time, 'customer' => $request->customer, 'incentive' => $request->incentive, 'mark' => $request->mark, 'mark_date' => $request->mark_date, 'user_id' => $request->user_id]);
                    }
                    print_r('<script>window.close();</script>');
                    exit;
                }
            }
            $fdate = date($year . '-' . $month . '-01');
            $tdate = date($year . '-' . $month . '-31');
            $check_date = "$year-$month-01";
            if ($request->showtab) {
                $data['showtab'] = $request->showtab;
            }
            $profile = User::select('user.*', 'user_type.user_type AS type')->where('user.id', $id)->join('user_type', 'user.user_type', 'user_type.id')->get();
            if ($profile->count() > 0) {
                $data['profile'] = $profile[0];
                if ($data['profile']->user_type == 1) {
                    $data['users'] = Attendance::where('attendance.user_id', $id)->whereBetween('mark_date', ["$year-$month-01", "$year-$month-$total_days"])->orderBy('mark_date')->get();
                    $users = User::select(
                        'user.*',
                        'user_salary.salary AS csalary',
                        DB::raw('SUM(attendance.incentive) AS total_incentive'),
                        DB::raw("SUM(CASE WHEN attendance.mark = 'P' THEN 1 ELSE 0 END) AS total_P"),
                        DB::raw("SUM(CASE WHEN attendance.mark = 'H' THEN 1 ELSE 0 END) AS total_H"),
                        DB::raw("SUM(CASE WHEN attendance.mark = 'A' THEN 1 ELSE 0 END) AS total_A"),
                        DB::raw("SUM(CASE WHEN attendance.mark = 'UPL' THEN 1 ELSE 0 END) AS total_UPL"),
                        DB::raw("SUM(CASE WHEN attendance.mark = 'HPL' THEN 1 ELSE 0 END) AS total_HPL"),
                        DB::raw("SUM(CASE WHEN attendance.mark = 'HPHL' THEN 1 ELSE 0 END) AS total_HPHL"),
                        DB::raw("SUM(CASE WHEN attendance.mark = 'PL' THEN 1 ELSE 0 END) AS total_PL"),
                        DB::raw("SUM(attendance.sale_made) AS total_sales"),
                        DB::raw("SUM(attendance.customer) AS total_customer"),
                    )
                        ->leftJoin('user_salary', 'user.id', 'user_salary.uid')->whereDate('from', '<=', $check_date)
                        ->whereDate('to', '>=', $check_date)
                        ->leftJoin('attendance', 'user.id', '=', 'attendance.user_id')
                        ->where('user.id', $id)
                        ->whereBetween('attendance.mark_date', [$fdate, $tdate])
                        ->groupBy('user.id')
                        ->get();
                } else {
                    $data['users'] = Attendance::where('attendance.user_id', $id)->whereBetween('mark_date', ["$year-$month-01", "$year-$month-$total_days"])->orderBy('mark_date')->get();
                    $users = User::select(
                        'user.*',
                        'user_salary.salary AS csalary',
                        DB::raw("SUM(CASE WHEN attendance.mark = 'P' THEN 1 ELSE 0 END) AS total_P"),
                        DB::raw("SUM(CASE WHEN attendance.mark = 'H' THEN 1 ELSE 0 END) AS total_H"),
                        DB::raw("SUM(CASE WHEN attendance.mark = 'A' THEN 1 ELSE 0 END) AS total_A"),
                        DB::raw("SUM(CASE WHEN attendance.mark = 'UPL' THEN 1 ELSE 0 END) AS total_UPL"),
                        DB::raw("SUM(CASE WHEN attendance.mark = 'HPL' THEN 1 ELSE 0 END) AS total_HPL"),
                        DB::raw("SUM(CASE WHEN attendance.mark = 'HPHL' THEN 1 ELSE 0 END) AS total_HPHL"),
                        DB::raw("SUM(CASE WHEN attendance.mark = 'PL' THEN 1 ELSE 0 END) AS total_PL"),
                    )
                        ->leftJoin('user_salary', 'user.id', 'user_salary.uid')->whereDate('from', '<=', $check_date)
                        ->whereDate('to', '>=', $check_date)
                        ->leftJoin('attendance', 'user.id', '=', 'attendance.user_id')
                        ->where('user.id', $id)
                        ->whereBetween('attendance.mark_date', [$fdate, $tdate])
                        ->groupBy('user.id')
                        ->get();
                }
                $use = [];
                $holi = Holiday::whereBetween('hdate', [$year . '-' . $month . '-01', $year . '-' . $month . '-31'])->count();
                $data['total_working'] = cal_days_in_month(CAL_GREGORIAN, $month, $year);
                $data['hsun'] = $this->dayCount('Sunday', $month, $year) + $holi;
                foreach ($users as $us) {
                    $use = $us;
                    $use->total_salary = round(($us->csalary / $data['total_working']) * (($us->total_P  + $us->total_PL  + ($us->total_H / 2)  + ($us->total_HPL / 2)  + ($us->total_HPHL)) + $data['hsun']));
                }
                $data['leaves'] = Leave::select('leave_application.id', 'leave_application.user_id', 'leave_application.created_at', 'leave_application.leave_from', 'leave_application.leave_to', 'leave_application.reason', 'leave_application.approved', 'user.user_id')->where('leave_application.user_id', $id)->join('user', 'leave_application.user_id', 'user.id')->where('user.status', 1)->get();
                $data['ass'] = Assets::select('assets.*')->join('user_assets', 'user_assets.assets_id', 'assets.id')->where('user_assets.uid', $id)->get();
                $data['alluser'] = User::where('status', 1)->get();
                $data['user_file'] = User_file::where('uid', $id)->get();
                $data['use'] = $use;
                return view('user.admin.report2', $data);
            } else {
                return redirect(env('APP_URL') . 'adper/users');
            }
        } else {
            return redirect(env('APP_URL') . 'adper');
        }
    }
    public function save_profile($id, Request $request)
    {
        if (!empty(Session::get('user'))) {
            $user_id = Session::get('user');
            $user = $this->user($user_id);
            if ($request->_token) {
                $ext = $request->post();
                unset($ext['_token']);
                unset($ext['created_at']);
                unset($ext['updated_at']);
                $ch = User::where('id', $id);
                if ($ch->count() > 0) {
                    if ($ch->first()->salary != $ext['salary']) {
                        if (!empty($ext['salary'])) {
                            User::updateSalary($id, $ext['salary'], $ext['applied_from']);
                        }
                    }
                    unset($ext['applied_from']);
                    User::where('id', $id)->update($ext);
                        Session::flash('message', 'User Updated');
                        Session::flash('alert-class', 'alert-success');
                        return  redirect(env('APP_URL') . 'adper/attendance/full_report/' . $id);
                } else {
                    Session::flash('message', 'User Not updated');
                    Session::flash('alert-class', 'alert-danger');
                    return  redirect(env('APP_URL') . 'adper/attendance/full_report/' . $id);
                }
            } else {
                Session::flash('message', 'User Not updated');
                Session::flash('alert-class', 'alert-danger');
                return  redirect(env('APP_URL') . 'adper/attendance/full_report/' . $id);
            }
        } else {
            return redirect(env('APP_URL') . 'adper');
        }
    }
    public function save_user_file($id, Request $request)
    {
        if (!empty(Session::get('user'))) {
            $user_id = Session::get('user');
            $user = $this->user($user_id);
            if ($request->_token) {
                $ext = $request->post();
                unset($ext['_token']);
                if ($request->hasFile('file')) {
                    $file = $request->file('file');
                    $te = $file->store('imgs');
                    $ext['file'] = $te;
                }
                User_file::create($ext);
                Session::flash('message', 'User File Added');
                Session::flash('alert-class', 'alert-success');
                return  redirect(env('APP_URL') . 'adper/attendance/full_report/' . $id);
            } else {
                Session::flash('message', 'User File Not Added');
                Session::flash('alert-class', 'alert-danger');
                return  redirect(env('APP_URL') . 'adper/attendance/full_report/' . $id);
            }
        } else {
            return redirect(env('APP_URL') . 'adper');
        }
    }
    public function qa_full_report($id, Request $request)
    {
        if (!empty(Session::get('user'))) {
            $user_id = Session::get('user');
            $user = $this->user($user_id);
            $data['user'] = $user;
            $year = date('Y');
            $month = date('m');
            $total_days = date('d');
            $data['date'] = date('Y-m');
            if (isset($request->_token)) {
                // \DB::enableQueryLog();
                if ($request->user_type == 2) {
                    if (isset($request->month)) {
                        $aa = explode('-', $request->month);
                        $year = $aa[0];
                        $month = $aa[1];
                        $total_days = 31;
                        $data['date'] = $request->month;
                    } else {
                        $ch = Attendance::where('mark_date', $request->mark_date)->where('user_id', $request->user_id);
                        if ($ch->count() > 0) {
                            $ch->update(['login_time' => $request->login_time, 'logout_time' => $request->logout_time, 'recording' => $request->recording, 'mark' => $request->mark]);
                        } else {
                            Attendance::create(['login_time' => $request->login_time, 'logout_time' => $request->logout_time, 'recording' => $request->recording, 'mark' => $request->mark, 'mark_date' => $request->mark_date, 'user_id' => $request->user_id]);
                        }
                    }
                } elseif ($request->user_type == 3) {
                    if (isset($request->month)) {
                        $aa = explode('-', $request->month);
                        $year = $aa[0];
                        $month = $aa[1];
                        $total_days = 31;
                        $data['date'] = $request->month;
                    } else {
                        $ch = Attendance::where('mark_date', $request->mark_date)->where('user_id', $request->user_id)->first();
                        // print_r($ch);exit;
                        if ($ch) {
                            $ch->update(['login_time' => $request->login_time, 'logout_time' => $request->logout_time, 'mark' => $request->mark]);
                        } else {
                            Attendance::create(['login_time' => $request->login_time, 'logout_time' => $request->logout_time, 'mark' => $request->mark, 'mark_date' => $request->mark_date, 'user_id' => $request->user_id]);
                        }
                    }
                } elseif ($request->user_type == 4) {
                    if (isset($request->month)) {
                        $aa = explode('-', $request->month);
                        $year = $aa[0];
                        $month = $aa[1];
                        $total_days = 31;
                        $data['date'] = $request->month;
                    } else {
                        $ch = Attendance::where('mark_date', $request->mark_date)->where('user_id', $request->user_id);
                        if ($ch->count() > 0) {
                            $ch->update(['login_time' => $request->login_time, 'logout_time' => $request->logout_time, 'mark' => $request->mark]);
                        } else {
                            Attendance::create(['login_time' => $request->login_time, 'logout_time' => $request->logout_time, 'mark' => $request->mark, 'mark_date' => $request->mark_date, 'user_id' => $request->user_id]);
                        }
                    }
                }
                // dd(\DB::getQueryLog());
                print_r('<script>window.close();</script>');
            } else {
                print_r('<script>window.close();</script>');
            }
        } else {
            return redirect(env('APP_URL') . 'adper');
        }
    }
    public function leave(Request $request)
    {
        if (!empty(Session::get('user'))) {
            $user_id = Session::get('user');
            $user = $this->user($user_id);
            $data['date'] = date('Y-m');
            if (!empty($request->post('_token'))) {
                $data['date'] = $request->month;
            }
            $data['user'] = $user;
            $from = $data['date'] . '-01';
            $to = $data['date'] . '-31';
            if (isset($request->showall)) {
                $data['leaves'] = Leave::select('leave_application.id', 'leave_application.created_at', 'leave_application.user_id', 'leave_application.leave_type', 'leave_application.leave_from', 'leave_application.leave_to', 'leave_application.reason', 'leave_application.approved', 'user.user_id AS user_ida')->join('user', 'leave_application.user_id', 'user.id')->where('user.status', 1)->get();
            } else {
                $data['leaves'] = Leave::select('leave_application.id', 'leave_application.created_at', 'leave_application.user_id', 'leave_application.leave_type', 'leave_application.leave_from', 'leave_application.leave_to', 'leave_application.reason', 'leave_application.approved', 'user.user_id AS user_ida')->whereBetween('leave_from', [$from, $to])->join('user', 'leave_application.user_id', 'user.id')->where('user.status', 1)->get();
            }
            return view('user.admin.leave', $data);
        } else {
            return redirect(env('APP_URL') . 'adper');
        }
    }
    public function leave_approve(Request $request,$id = '')
    {
        if (!empty(Session::get('user'))) {
            $user_id = Session::get('user');
            $user = $this->user($user_id);
            $userName = $user->name;
            if (!empty($id)) {
                $leave = Leave::where('id', $id)->where('approved', 0);
                if ($leave->count() > 0) {
                    $leavedata = $leave->get()[0];
                    $response = $request->input('response', ''); //response
                    $leave_user_data = User::where('id', $leavedata->user_id)->first();
                    $user_leave_count = $leave_user_data->leave_count;
                    $user_used_leave_count = $leave_user_data->used_leave_count;
                    if ($leavedata->leave_type == "1st Half" or $leavedata->leave_type == "2nd Half") {
                        $today = Carbon::now()->format('Y-m-d'); 
                        $applied_leave = Leave::where('id', $id)->where('leave_from','<',$today)->where('approved',0)->exists();
                        if(!$applied_leave ){
                         return redirect()->back()->with('error', 'Leave will be approved on the next day in case of half day');
                        }else{
                        $mark_date = $leavedata->leave_from;
                        $azxs = Attendance::where(['mark_date' => $mark_date, 'user_id' => $leavedata->user_id]);
                        if ($azxs->count() > 0) {
                            $mark = $azxs->first()->mark;
                            if ($mark == "H") {
                                $azxs->update(['mark' => 'HPHL']);
                                $user_used_leave_count += 0.5;
                                $user_leave_count -= 0.5;
                            } elseif ($mark == "P") {
                            } else {
                                $azxs->update(['mark' => 'HPL']);
                                $user_used_leave_count += 0.5;
                                $user_leave_count -= 0.5;
                            }
                        } else {
                            Attendance::create(['mark' => 'HPL', 'mark_date' => $mark_date, 'user_id' => $leavedata->user_id]);
                            $user_used_leave_count += 0.5;
                            $user_leave_count -= 0.5;
                        }}                    } else {
                        $leavedata->leave_from;
                        $leavedata->leave_to;
                        $date1 = date_create($leavedata->leave_from);
                        $date2 = date_create($leavedata->leave_to);
                        $diff = date_diff($date1, $date2);
                        $leave_count = $diff->format("%a") + 1;
                        $i = 0;
                        while ($leave_count > $i) {
                            $mark_date = date('Y-m-d', strtotime($leavedata->leave_from . ' +' . $i . ' day'));
                            $azxs = Attendance::where(['mark_date' => $mark_date, 'user_id' => $leavedata->user_id]);
                            if ($user_leave_count > 0) {
                                if ($user_leave_count < 1) {
                                    $user_leave_count = 0;
                                    $user_used_leave_count += 0.5;
                                    if ($leave_user_data->user_type == 1) {
                                        if ($azxs->count() > 0) {
                                            $azxs->update(['mark' => 'HPL']);
                                        } else {
                                            Attendance::create(['mark' => 'HPL', 'mark_date' => $mark_date, 'user_id' => $leavedata->user_id]);
                                        }
                                    } else {
                                        if ($azxs->count() > 0) {
                                            $azxs->update(['mark' => 'HPL']);
                                        } else {
                                            Attendance::create(['mark' => 'HPL', 'mark_date' => $mark_date, 'user_id' => $leavedata->user_id]);
                                        }
                                    }
                                } else {
                                    $user_leave_count--;
                                    $user_used_leave_count++;
                                    if ($leave_user_data->user_type == 1) {
                                        if ($azxs->count() > 0) {
                                            $azxs->update(['mark' => 'PL']);
                                        } else {
                                            Attendance::create(['mark' => 'PL', 'mark_date' => $mark_date, 'user_id' => $leavedata->user_id]);
                                        }
                                    } else {
                                        if ($azxs->count() > 0) {
                                            $azxs->update(['mark' => 'PL']);
                                        } else {
                                            Attendance::create(['mark' => 'PL', 'mark_date' => $mark_date, 'user_id' => $leavedata->user_id]);
                                        }
                                    }
                                }
                            } else {
                                if ($leave_user_data->user_type == 1) {
                                    if ($azxs->count() > 0) {
                                        $azxs->update(['mark' => 'UPL']);
                                    } else {
                                        Attendance::create(['mark' => 'UPL', 'mark_date' => $mark_date, 'user_id' => $leavedata->user_id]);
                                    }
                                } else {
                                    if ($azxs->count() > 0) {
                                        $azxs->update(['mark' => 'UPL']);
                                    } else {
                                        Attendance::create(['mark' => 'UPL', 'mark_date' => $mark_date, 'user_id' => $leavedata->user_id]);
                                    }
                                }
                            }
                            $i++;
                        }
                    }
                    User::where('id', $leavedata->user_id)->update(['leave_count' => $user_leave_count, 'used_leave_count' => $user_used_leave_count]);
                    $leave->update(['approved' => 1, 'response' => $response,'approved_by' => $userName]);
                    //   }
                }
                return redirect(env('APP_URL') . 'adper/leave');
            } else {
                return redirect(env('APP_URL') . 'adper/leave');
            }
        } else {
            return redirect(env('APP_URL') . 'adper');
        }
    }
    public function users(Request $request)
    {
        if (!empty(Session::get('user'))) {
            $user_id = Session::get('user');
            $user = $this->user($user_id);
            $data['user'] = $user;
            $data['users'] = User::where('status', 1)
                ->leftjoin('department', 'department.id', '=', 'user.user_type')->select('user.id', 'user.name', 'user.user_id', 'user.work_type', 'user.salary', 'user.email', 'user.mobile', 'user.server_ip', 'department.d_name', 'user.lead')
                ->orderBy('status', 'DESC')->get();
            $data['users_d'] = User::select(
                'user.id',
                'user.name',
                'user.user_id',
                'user.salary',
                'user.mobile',
                'user.status',
                'user_status.reason',
                'department.d_name'
            )->where('user.status', 0)
                ->leftJoinSub(
                    DB::table('user_status')
                        ->select('uid', DB::raw('MAX(created_at) as latest_created_at'))
                        ->groupBy('uid'),
                    'latest_statuses',
                    function ($join) {
                        $join->on('user.id', '=', 'latest_statuses.uid');
                    }
                )
                ->leftJoin('user_status', function ($join) {
                    $join->on('user.id', '=', 'user_status.uid')
                        ->on('user_status.created_at', '=', 'latest_statuses.latest_created_at');
                })
                ->leftJoin('department', 'user.user_type', '=', 'department.id')
                ->orderBy('user.status', 'DESC')
                ->get();
            return view('user.admin.users', $data);
        } else {
            return redirect(env('APP_URL') . 'adper');
        }
    }
    public function teams(Request $request)
    {
        if (!empty(Session::get('user'))) {
            $user_id = Session::get('user');
            $data['user'] = $user = $this->user($user_id);
            if ($request->isMethod('POST')) {
                $ext = $request->post();
                unset($ext['add_leader'], $ext['add_member'], $ext['add_department'], $ext['remove_user']);
                if ($request->has('add_leader')) {
                    if ($request->leader_id == $request->userid) {
                        return back()->with('error', 'The new leader cannot be the same as the current leader.');
                    }
                    $a = User::where('id', $request->leader_id)->where('user_type', $request->dep_id)->exists();
                    $b = User::where('id', $request->userid)->where('user_type', $request->dep_id)->exists();
                    if ($a && $b) {
                        DB::beginTransaction();
                        User::where('id', $request->leader_id)->update(['lead' => 0]);
                        User::where('id', $request->userid)->update(['lead' => 1]);
                        User_lead_by::where('leader_id', $request->leader_id)->update(['leader_id' => $request->userid]);
                        DB::commit();
                        return back()->with('success', 'Leader change Successfully');
                    } else {
                        return back()->with('error', $a ? 'New user not found.' : 'Current leader not found.');
                    }
                } elseif ($request->has('add_member')) {
                    
                    $userIds = $request->input('userids', []); // Default to an empty array if not set
                    $leaderId = $request->input('leader_id');
                    $leaderExists = User::where('id', $leaderId)->exists();
                    if (!$leaderExists) {
                        return back()->with('error', 'Leader not found.');
                    }
                    foreach ($userIds as $userId) {
                        if ($userId == $leaderId) {
                            continue;                         }
                        $alreadyLed = User_lead_by::where('uid', $userId)->where('leader_id', $leaderId)->exists();
                
                        if (!$alreadyLed) {
                            User_lead_by::create([
                                'uid' => $userId,
                                'leader_id' => $leaderId,
                                'status' => 1,
                                'from' => Carbon::now()->format('Y-m-d'),
                            ]);
                        }
                    }
                
                    return back()->with('success', 'Users added successfully under the leader.');
                    // print_r($ext);exit;
                } elseif ($request->has('add_department')) {
                    $dep = Department::where('d_name', $ext['d_name'])->exists();
                    if (!$dep) {
                        Department::create([
                            'd_name' => $ext['d_name']
                        ]);
                        return back()->with('success', 'Department added successfully.');
                    } else {
                        // dd(44);
                        return back()->with('error', 'Department already exists.');
                    }
                } elseif ($request->has('remove_user')) {

                    if (!empty($request->userIds) && is_array($request->userIds)) {
                        // Update status to 0 for all userIds provided
                        User_lead_by::whereIn('uid', $request->userIds)
                            ->where('leader_id', $request->leader_id)
                            ->update(['status' => 0]);

                        return back()->with('success', 'User remove successfully.');
                    }
                }elseif($request->has('make_new_leader')){
                    // dd($request->post());
                    $depId = $request->input('dep_id');
                    $leaderId = $request->input('leader_id');
                
                    // Check if there's already a leader in the department
                    $existingLeader = User::where('user_type', $depId)->where('lead', 1)->first();
                
                    // If there's already a leader in the department
                    if ($existingLeader) {
                        // Check if the existing leader is the same as the one being set
                        if ($existingLeader->id == $leaderId) {
                            return back()->with('error', 'This user is already a leader.');
                        }
                    }
                
                    // If no leader exists in the department, set the specified user as the leader
                    $user = User::find($leaderId);
                    if ($user) {
                        $user->lead = 1;
                        $user->save();
                        return back()->with('success', 'User successfully set as leader.');
                    } else {
                        return back()->with('error', 'User not found.');
                    }
                }
            } else {
                $data['selected'] = $request->input('teams', 0);
                if ($request->has('teams')) {
                    $departmentId = $request->teams;

                    $data['user'] = $user;
                    // dd($departmentId);
                    if ($departmentId == 0) {
                        $data['teams'] = User::select('user.id', 'user.name', 'department.d_name', 'department.id AS dep_id')->where('status', 1)->where('lead', 1)
                            ->leftjoin('department', 'department.id', '=', 'user.user_type')->get();
                        foreach ($data['teams'] as $key => $team) {
                            $data['teams'][$key]->teams = User_lead_by::select('user.id', 'user.name', 'department.d_name')->where('leader_id', $team->id)
                                ->where('user_lead_by.status', 1)
                                ->leftjoin('user', 'user.id', '=', 'user_lead_by.uid')
                                ->leftjoin('department', 'department.id', '=', 'user.user_type')
                                ->get();
                        }
                    } else {
                        $data['teams'] = User::select('user.id', 'user.name', 'department.d_name', 'department.id AS dep_id')
                            ->where('user.status', 1)
                            ->where('lead', 1)
                            ->where('user.user_type', $departmentId)
                            ->leftJoin('department', 'department.id', '=', 'user.user_type')
                            ->get();
                        foreach ($data['teams'] as $key => $team) {
                            $data['teams'][$key]->teams = User_lead_by::select('user.id', 'user.name', 'department.d_name')
                                ->where('user_lead_by.leader_id', $team->id)
                                ->where('user_lead_by.status', 1)
                                ->leftJoin('user', 'user.id', '=', 'user_lead_by.uid')
                                ->leftJoin('department', 'department.id', '=', 'user.user_type') // This join is to fetch department name
                                ->where('user.user_type', $departmentId)
                                ->get();
                        }
                    }
                } else {
                    $data['teams'] = User::select('user.id', 'user.name', 'department.d_name', 'department.id AS dep_id')->where('status', 1)->where('lead', 1)
                        ->leftjoin('department', 'department.id', '=', 'user.user_type')->get();
                    foreach ($data['teams'] as $key => $team) {
                        $data['teams'][$key]->teams = User_lead_by::select('user.id', 'user.name', 'department.d_name')->where('leader_id', $team->id)
                            ->where('user_lead_by.status', 1)
                            ->leftjoin('user', 'user.id', '=', 'user_lead_by.uid')
                            ->leftjoin('department', 'department.id', '=', 'user.user_type')
                            ->get();
                    }
                    // dd(44);
                }
                $data['department'] = Department::all();
                // dd($data['teams']->toArray());
                $data['users'] = User::where('status', 1)->get();
                return view('user.admin.team', $data);
            }
        } else {
            return redirect(env('APP_URL') . 'adper');
        }
    }
    public function userstatus(Request $request)
    {
        if (!empty(Session::get('user'))) {
            $user_id = Session::get('user');
            $user = $this->user($user_id);
            $data['user'] = $user;
            // dd($request->post());
            if ($request->isMethod('POST')) {
                if ($request->status == 0) {
                    User::where('id', $request->id)->update(['status' => 0, 'leave_count' => 0]);
                    User_status::where('uid',$request->id)->where('status_h',1)->update(['status_h'=>0,'to'=>Carbon::now()->format('Y-m-d')]);
                    User_assets::where('uid',$request->id)->where('status','assign')->update(['to'=>Carbon::now()->format('Y-m-d')]);
                } elseif ($request->status == 1) {
                    User::where('id', $request->id)->update(['status' => 1]);   
                    User_status::create([
                        'uid' => $request->id,
                        'status_h' => $request->status,
                        'reason' => $request->reason
                    ]);
                } else {
                    return back()->with('Erorr', 'Enable to Upadate');
                }
                return back()->with('success', 'Status Updated Successfully');
            }
        } else {
            return redirect(env('APP_URL') . 'adper');
        }
    }
    public function worktype(Request $request)
    {
        if (!empty(Session::get('user'))) {
            $user_id = Session::get('user');
            $user = $this->user($user_id);
            $data['user'] = $user;
            if ($request->worktype == 1) {
                // dd($request->id);
                User::where('id', $request->id)->update(['work_type' => 1]);
            } elseif ($request->worktype == 2) {
                User::where('id', $request->id)->update(['work_type' => 2]);
            }
        } else {
            return redirect(env('APP_URL') . 'adper');
        }
    }
    public function ticketstatus(Request $request)
    {
        if (!empty(Session::get('user'))) {
            $user_id = Session::get('user');
            $user = $this->user($user_id);
            $data['user'] = $user;
            Ticket::where('id', $request->id)->update(['status' => $request->status, 'response' => $request->response]);
        } else {
            return redirect(env('APP_URL') . 'adper');
        }
    }
    public function add_user(Request $request)
    {
            if (!empty(Session::get('user'))) {
                $user_id = Session::get('user');
                $user = $this->user($user_id);
                if (!empty($request->post('_token'))) {
                    $selectedKeys = [
                        'name', 'gender', 'mobile', 'work_type', 'pf', 'joining_date', 'server_ip', 'email',
                        'salary', 'designation', 'lead', 'user_id', 'password', 'current_month'
                    ];
                    $ext = $request->only($selectedKeys);
                    $leader_id = $request->leader_id;
                    $dep_name = $request->post('d_name');
                    $dep = Department::firstOrCreate(['d_name' => $dep_name]);
                    // dd($dep->id);
                    $ext['user_type'] = $dep->id;
                    $userIds = $request->input('userIds');
                    $userIdsArray = explode(',', $userIds);
                    unset($ext['_token'], $ext['d_name']);
                    $cm = date('m');
                    $ext['current_month'] = $cm > 3 ? $cm : 12;
                    $crm_id = null;
                    $err = "";
                    if ($ext['user_type'] == 1) {
                        $ch = $this->createdialer($ext);
                        $ch = json_decode($ch);
                        if ($ch->res == "USER ADDED") {} else {$err = "dialer not created ";}
                        $crm_id = $this->createcrmuser($ext);
                        if (empty($crm_id)){$err .= "crm not created";}
                    }
                    $ext['crm_id'] = $crm_id;
                    $new_user = User::create($ext);
                    
                    if ($new_user) {
                        User_status::create([
                            'uid' => $new_user->id,
                            'status_h' => 1,
                            'from' =>Carbon::now()->format('Y-m-d'),
                        ]);
                        if ($leader_id !== '') {
                            User_lead_by::create([
                                'uid' => $new_user->id,
                                'leader_id' => $request->leader_id,
                                'status' => 1,
                                'from' => Carbon::now()->format('Y-m-d'),
                            ]);
                        }
                        if (!empty($userIdsArray)) {
                            foreach ($userIdsArray as $userId) {
                                if (!empty($userId)) {
                                    User_lead_by::create([
                                        'uid' => $userId,
                                        'leader_id' => $new_user->id,
                                        'status' => 1,
                                        'from' => Carbon::now()->format('Y-m-d'),
                                    ]);
                                }
                            }
                        }
                    }
                    if(empty($err)){$err = "user created";}
                    return redirect(env('APP_URL') . 'adper/users')->withErrors(['msg' => $err]);
                } else {
                    $data['user'] = $user;
                    $data['users'] = User::where('status', 1)->get();
                    $data['depatment'] = Department::all();
                    $data['last_id'] = User::select('id')->orderBy('created_at', 'desc')->first();
                    return view('user.admin.add_user', $data);
                }
            } else {
                return redirect(env('APP_URL') . 'adper');
            }
    }
    public function getuserbyleader($dep_id, $leader_id)
    {
        $leaderIds = User_lead_by::where('leader_id', $leader_id)
            ->pluck('uid')
            ->toArray();
        $excludeIds = array_merge($leaderIds, [$leader_id]);
        $users = User::select('id', 'user_id', 'name')->where('user_type', $dep_id)->where('status', 1)->whereNotIn('id', $excludeIds)->get();
        // dd($users->toArray());
        $data = [
            'users' => $users
        ];
        // return $data;
        return response()->json($data);
    }
    public function getleaderbydiparment($dep_id)
    {
        $leaders = Department::where('department.id', '=', $dep_id)
            ->leftjoin('user', function ($join) use ($dep_id) {
                $join->on('user.user_type', '=', 'department.id')
                    ->where('user.lead', '=', 1)
                    ->where('department.id', '=', $dep_id);
            })->get(['user.id as leaderId', 'user.name AS leader_name']);
        $users = User::select('id', 'user_id')->where('user_type', $dep_id)->where('status', 1)->get();
        $data = [
            'leaders' => $leaders,
            'users' => $users
        ];
        return response()->json($data);
    }
    // public function holiday(Request $request)
    // {
    //     if (!empty(Session::get('user'))) {
    //         $user_id = Session::get('user');
    //         $user = $this->user($user_id);
    //         if (!empty($request->post('_token'))) {
    //             $ext = $request->post();
    //             unset($ext['_token']);
    //             $ext['hdate'] = date('Y-m-d', strtotime($ext['hdate']));
    //             Holiday::create($ext);
    //             return redirect(env('APP_URL') . 'adper/holiday');
    //         } else {
    //             $data['user'] = $user;
    //             $data['holi'] = Holiday::all();
    //             return view('user.admin.holiday', $data);
    //         }
    //     } else {
    //         return redirect(env('APP_URL') . 'adper');
    //     }
    // }
    public function holiday(Request $request)
    {
        if (!empty(Session::get('user'))) {
            $user_id = Session::get('user');
            $user = $this->user($user_id);
            if (!empty($request->post('_token'))) {
                $ext = $request->post();
                unset($ext['_token']);
                if($request->has('delete_holi') && $request->has('id')) {
                    $holidayId = $request->input('id');
                    Holiday::where('id', $holidayId)->delete();
                }else{
                    if ($ext['from'] == $ext['to']) {
                        $exists = Holiday::where('user_type', $ext['user_type'] ?? 0)
                            ->where('hdate', $ext['from'])
                            ->exists();
                        if ($exists) {
                            return redirect()->back()->with('error', 'Holiday already exists for this user type on the given day.');
                        }
                        // dd([
                        //     'user_type' => $ext['user_type'] ?? 0,
                        //     'hdate' => $ext['from'],
                        //     'description' => $ext['description'],
                        // ]);
                        Holiday::create([
                            'user_type' => $ext['user_type'] ?? 0,
                            'hdate' => $ext['from'],
                            'description' => $ext['description'],
                        ]);
                        return redirect()->back()->with('success', "Holiday added successfully.");
                    } else {
                        $period = new DatePeriod(
                            new DateTime($ext['from']),
                            new DateInterval('P1D'),
                            (new DateTime($ext['to']))->modify('+1 day')
                        );
    
                        foreach ($period as $date) {
                            $dateStr = $date->format('Y-m-d');
                            // Check if a holiday for the same user_type and date already exists
                            $exists = Holiday::where('user_type', $ext['user_type'] ?? 0)
                                ->where('hdate', $dateStr)
                                ->exists();
                            if ($exists) {
                                return redirect()->back()->with('error', 'Holiday already exists for this user type on the given day.');
                            }
                            Holiday::create([
                                'user_type' => $ext['user_type']  ?? 0,
                                'hdate' => $date->format('Y-m-d'),
                                'description' => $ext['description'],
                            ]);
                            return redirect()->back()->with('success', "Holiday added successfully.");
                        }
                    }
                }
                
                return redirect(env('APP_URL') . 'adper/holiday');
            } else {
                $data['user'] = $user;
                $data['holi'] = Holiday::whereYear('hdate', now()->year)->get();
                $data['dep'] = Department::all();
                return view('user.admin.holiday', $data);
            }
        } else {
            return redirect(env('APP_URL') . 'adper');
        }
    }
    public function blukholiday(Request $request)
    {
        $csvFile = $request->file('blukholiday');
        $duplicates = [];
        $uploaded = 0;
        if (($handle = fopen($csvFile->getRealPath(), 'r')) !== FALSE) {
            fgetcsv($handle);
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $fromDateStr = $data[1];
                $toDateStr = $fromDateStr ?? $data[1];
                $occasion = $data[3];
                $dep_id = Department::where('d_name', $data[0])->first();
                if (!$dep_id) {
                    continue;
                }
                $fromDate = new DateTime($fromDateStr);
                $toDate = new DateTime($toDateStr);
                $cdata = $fromDate->format('Y-m-d');
                $daysDiff = $fromDate->diff($toDate)->days;
                do {
                    $existingHoliday = Holiday::where('hdate', $cdata)
                        ->where('user_type', $dep_id->id)
                        ->first();
                    if ($existingHoliday) {
                        $duplicates[] = "Duplicate holiday for department ID {$dep_id->id} on {$cdata}";
                    } else {
                        Holiday::create([
                            'user_type' => $dep_id->id,
                            'hdate' => $cdata,
                            'description' => $occasion,
                        ]);
                        $uploaded++;
                    }
                    $cdata = date('Y-m-d', strtotime($cdata . ' + 1 day'));
                } while ($daysDiff-- > 0);
            }
            fclose($handle);
        }
        if (!empty($duplicates)) {
            return redirect()->back()->with('error', 'Some holidays were not uploaded due to duplicates.')->with('duplicates', $duplicates);
        } else {
            return redirect()->back()->with('success', "Holidays uploaded successfully. Total uploaded: $uploaded");
        }
    }
    public function ticket(Request $request)
    {
        if (!empty(Session::get('user'))) {
            $user_id = Session::get('user');
            $user = $this->user($user_id);
            $data['user'] = $user;
            $data['ticket'] = Ticket::select('ticket.*', 'user.name', 'assets.serial_number')->join('user', 'user.id', 'ticket.uid')->leftJoin('assets', 'assets.id', 'ticket.user_asset_id')->orderBy('created_at')->whereIn('ticket.status', [0, 2])->get();
            $data['cticket'] = Ticket::select('ticket.*', 'user.name')->join('user', 'user.id', 'ticket.uid')->orderBy('created_at')->where('ticket.status', 1)->get();
            return view('user.admin.ticket', $data);
        } else {
            return redirect(env('APP_URL') . 'adper');
        }
    }
    public function new_candidate(Request $request)
    {
        if (!empty(Session::get('user'))) {
            $user_id = Session::get('user');
            $user = $this->user($user_id);
            if (!empty($request->post('_token'))) {
                $ext = $request->post();
                unset($ext['_token']);
                print_r($ext);
                exit;
            } else {
                $data['user'] = $user;
                return view('user.admin.new_candidate', $data);
            }
        } else {
            return redirect(env('APP_URL') . 'adper');
        }
    }
    public function candidate(Request $request)
    {
        if (!empty(Session::get('user'))) {
            $user_id = Session::get('user');
            $user = $this->user($user_id);
            $data['user'] = $user;
            if ($request->_token) {
                if ($request->save) {
                    New_hiring::where('id', $request->id)->update(['salary' => $request->salary, 'server_ip' => $request->server_ip, 'status' => 1]);
                } elseif ($request->disabled) {
                    New_hiring::where('id', $request->id)->update(['status' => 0, 'leave_count' => 0]);
                } elseif ($request->enabled) {
                    New_hiring::where('id', $request->id)->update(['status' => 1]);
                }
                print_r('<script>window.close();</script>');
            } else {
                $data['users'] = New_hiring::where('status', 'pending')->orderBy('id', 'DESC')->get();
                return view('user.admin.candidate', $data);
            }
        } else {
            return redirect(env('APP_URL') . 'adper');
        }
    }
    public function create_offer(Request $request)
    {
        if (!empty(Session::get('user'))) {
            $user_id = Session::get('user');
            $data['user'] = $this->user($user_id);
            return view('user.admin.create_offer', $data);
        } else {
            return redirect(env('APP_URL') . 'adper');
        }
    }
    public function announcement(Request $request)
    {
        if (!empty(Session::get('user'))) {
            $user_id = Session::get('user');
            if ($request->_token) {
                $ext = $request->post();
                unset($ext['_token']);
                if ($ext['by_user_type'] == 'osw') {
                    if (isset($ext['user_ids']) and !empty($ext['user_ids'])) {
                        $ext['by_user_ids'] = implode(',', $ext['user_ids']);
                        unset($ext['user_ids']);
                        $ext['by_user_type'] = NULL;
                    } else {
                        Session::flash('message', 'Please Select User ID');
                        Session::flash('alert-class', 'alert-danger');
                        return redirect(env('APP_URL') . 'adper/announcement');
                    }
                }
                Announcement::create($ext);
                Session::flash('message', 'Announcement post successfully');
                Session::flash('alert-class', 'alert-success');
                return redirect(env('APP_URL') . 'adper/announcement');
            } else {
                $data['user'] = $this->user($user_id);
                $data['users'] = User::where('status', 1)->get();
                return view('user.admin.announcement', $data);
            }
        } else {
            return redirect(env('APP_URL') . 'adper');
        }
    }
    public function offer(Request $request)
    {
        if (!empty(Session::get('user'))) {
            $user_id = Session::get('user');
            $user = $this->user($user_id);
            $data['ext'] = $ext = $request->post();
            $data['sal'] = $sal = $ext['salary'] * 12;
            $no = floor($sal);
            $point = round($sal - $no, 2) * 100;
            $hundred = null;
            $digits_1 = strlen($no);
            $i = 0;
            $str = array();
            $words = array(
                '0' => '', '1' => 'ONE', '2' => 'TWO',
                '3' => 'THREE', '4' => 'FOUR', '5' => 'FIVE', '6' => 'SIX',
                '7' => 'SEVEN', '8' => 'EIGHT', '9' => 'NINE',
                '10' => 'TEN', '11' => 'ELEVEN', '12' => 'TWELVE',
                '13' => 'THIRTEEN', '14' => 'FOURTEEN',
                '15' => 'FIFTEEN', '16' => 'SIXTEEN', '17' => 'SEVENTEEN',
                '18' => 'EIGHTEEN', '19' => 'NINETEEN', '20' => 'TWENTY',
                '30' => 'THIRTY', '40' => 'FORTY', '50' => 'FIFTY',
                '60' => 'SIXTY', '70' => 'SEVENTY',
                '80' => 'EIGHTY', '90' => 'NINETY'
            );
            $digits = array('', 'HUNDRED', 'THOUSAND', 'LAKH', 'CRORE');
            while ($i < $digits_1) {
                $divider = ($i == 2) ? 10 : 100;
                $number = floor($no % $divider);
                $no = floor($no / $divider);
                $i += ($divider == 10) ? 1 : 2;
                if ($number) {
                    $plural = (($counter = count($str)) && $number > 9) ? 'S' : null;
                    $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                    $str[] = ($number < 21) ? $words[$number] .
                        " " . $digits[$counter] . $plural . " " . $hundred
                        :
                        $words[floor($number / 10) * 10]
                        . " " . $words[$number % 10] . " "
                        . $digits[$counter] . $plural . " " . $hundred;
                } else $str[] = null;
            }
            $str = array_reverse($str);
            $result = implode('', $str);
            $points = ($point) ?
                "." . $words[$point / 10] . " " .
                $words[$point = $point % 10] : '';
            $data['salary_in_word'] = $result . "RUPEES";
            return view('user.admin.offer', $data);
        } else {
            return redirect(env('APP_URL') . 'adper');
        }
    }
    public function fnf(Request $request)
    {
        if (!empty(Session::get('user'))) {
            $user_id = Session::get('user');
            $user = $this->user($user_id);
            $emp = User::where('id', $request->id)->get();
            if ($emp->count()) {
                $data['emp'] = $emp[0];
            } else {
                $data['emp'] = [];
            }
            $data['post'] = $request->post();
            // ---------------------------------------------------------------------------------------------------------------------   
            $data['sal'] = $sal = $data['emp']->salary * 12;
            //   $no = floor($sal);
            $sal = round(($data['emp']->salary / $data['post']['tdm']) * $data['post']['pd']);
            $no = floor($sal);
            $point = round($sal - $no, 2) * 100;
            $hundred = null;
            $digits_1 = strlen($no);
            $i = 0;
            $str = array();
            $words = array(
                '0' => '', '1' => 'ONE', '2' => 'TWO',
                '3' => 'THREE', '4' => 'FOUR', '5' => 'FIVE', '6' => 'SIX',
                '7' => 'SEVEN', '8' => 'EIGHT', '9' => 'NINE',
                '10' => 'TEN', '11' => 'ELEVEN', '12' => 'TWELVE',
                '13' => 'THIRTEEN', '14' => 'FOURTEEN',
                '15' => 'FIFTEEN', '16' => 'SIXTEEN', '17' => 'SEVENTEEN',
                '18' => 'EIGHTEEN', '19' => 'NINETEEN', '20' => 'TWENTY',
                '30' => 'THIRTY', '40' => 'FORTY', '50' => 'FIFTY',
                '60' => 'SIXTY', '70' => 'SEVENTY',
                '80' => 'EIGHTY', '90' => 'NINETY'
            );
            $digits = array('', 'HUNDRED', 'THOUSAND', 'LAKH', 'CRORE');
            while ($i < $digits_1) {
                $divider = ($i == 2) ? 10 : 100;
                $number = floor($no % $divider);
                $no = floor($no / $divider);
                $i += ($divider == 10) ? 1 : 2;
                if ($number) {
                    $plural = (($counter = count($str)) && $number > 9) ? 'S' : null;
                    $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                    $str[] = ($number < 21) ? $words[$number] . " " . $digits[$counter] . $plural . " " . $hundred : $words[floor($number / 10) * 10] . " " . $words[$number % 10] . " " . $digits[$counter] . $plural . " " . $hundred;
                } else {
                    $str[] = null;
                }
            }
            $str = array_reverse($str);
            $result = implode('', $str);
            $points = ($point) ? "." . $words[$point / 10] . " " . $words[$point = $point % 10] : '';
            $data['salary_in_word'] = $result . "RUPEES  ";
            // ---------------------------------------------------------------------------------------------------------------------
            return view('user.admin.fnf', $data);
        } else {
            return redirect(env('APP_URL') . 'adper');
        }
    }
    public function experience(Request $request)
    {
        if (!empty(Session::get('user'))) {
            $user_id = Session::get('user');
            $user = $this->user($user_id);
            $data['ext'] = $ext = $request->post();
            return view('user.admin.exper', $data);
        } else {
            return redirect(env('APP_URL') . 'adper');
        }
    }
    public function confirmation(Request $request)
    {
        if (!empty(Session::get('user'))) {
            $user_id = Session::get('user');
            $user = $this->user($user_id);
            $data['ext'] = $ext = $request->post();
            return view('user.admin.confirmation', $data);
        } else {
            return redirect(env('APP_URL') . 'adper');
        }
    }
    public function relieving(Request $request)
    {
        if (!empty(Session::get('user'))) {
            $user_id = Session::get('user');
            $user = $this->user($user_id);
            $data['ext'] = $ext = $request->post();
            return view('user.admin.relieving', $data);
        } else {
            return redirect(env('APP_URL') . 'adper');
        }
    }
    public function appoint(Request $request)
    {
        if (!empty(Session::get('user'))) {
            $user_id = Session::get('user');
            $user = $this->user($user_id);
            $data['ext'] = $ext = $request->post();
            $data['sal'] = $sal = $ext['salary'] * 12;
            $no = floor($sal);
            $point = round($sal - $no, 2) * 100;
            $hundred = null;
            $digits_1 = strlen($no);
            $i = 0;
            $str = array();
            $words = array(
                '0' => '', '1' => 'ONE', '2' => 'TWO',
                '3' => 'THREE', '4' => 'FOUR', '5' => 'FIVE', '6' => 'SIX',
                '7' => 'SEVEN', '8' => 'EIGHT', '9' => 'NINE',
                '10' => 'TEN', '11' => 'ELEVEN', '12' => 'TWELVE',
                '13' => 'THIRTEEN', '14' => 'FOURTEEN',
                '15' => 'FIFTEEN', '16' => 'SIXTEEN', '17' => 'SEVENTEEN',
                '18' => 'EIGHTEEN', '19' => 'NINETEEN', '20' => 'TWENTY',
                '30' => 'THIRTY', '40' => 'FORTY', '50' => 'FIFTY',
                '60' => 'SIXTY', '70' => 'SEVENTY',
                '80' => 'EIGHTY', '90' => 'NINETY'
            );
            $digits = array('', 'HUNDRED', 'THOUSAND', 'LAKH', 'CRORE');
            while ($i < $digits_1) {
                $divider = ($i == 2) ? 10 : 100;
                $number = floor($no % $divider);
                $no = floor($no / $divider);
                $i += ($divider == 10) ? 1 : 2;
                if ($number) {
                    $plural = (($counter = count($str)) && $number > 9) ? 'S' : null;
                    $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                    $str[] = ($number < 21) ? $words[$number] .
                        " " . $digits[$counter] . $plural . " " . $hundred
                        :
                        $words[floor($number / 10) * 10]
                        . " " . $words[$number % 10] . " "
                        . $digits[$counter] . $plural . " " . $hundred;
                } else $str[] = null;
            }
            $str = array_reverse($str);
            $result = implode('', $str);
            $points = ($point) ?
                "." . $words[$point / 10] . " " .
                $words[$point = $point % 10] : '';
            $data['salary_in_word'] = $result . "RUPEES  ";
            return view('user.admin.appoint', $data);
        } else {
            return redirect(env('APP_URL') . 'adper');
        }
    }
    public function increment(Request $request)
    {
        if (!empty(Session::get('user'))) {
            $user_id = Session::get('user');
            $user = $this->user($user_id);
            $data['ext'] = $ext = $request->post();
            $data['sal'] = $sal = $ext['salary'] * 12;
            $no = floor($sal);
            $point = round($sal - $no, 2) * 100;
            $hundred = null;
            $digits_1 = strlen($no);
            $i = 0;
            $str = array();
            $words = array(
                '0' => '', '1' => 'ONE', '2' => 'TWO',
                '3' => 'THREE', '4' => 'FOUR', '5' => 'FIVE', '6' => 'SIX',
                '7' => 'SEVEN', '8' => 'EIGHT', '9' => 'NINE',
                '10' => 'TEN', '11' => 'ELEVEN', '12' => 'TWELVE',
                '13' => 'THIRTEEN', '14' => 'FOURTEEN',
                '15' => 'FIFTEEN', '16' => 'SIXTEEN', '17' => 'SEVENTEEN',
                '18' => 'EIGHTEEN', '19' => 'NINETEEN', '20' => 'TWENTY',
                '30' => 'THIRTY', '40' => 'FORTY', '50' => 'FIFTY',
                '60' => 'SIXTY', '70' => 'SEVENTY',
                '80' => 'EIGHTY', '90' => 'NINETY'
            );
            $digits = array('', 'HUNDRED', 'THOUSAND', 'LAKH', 'CRORE');
            while ($i < $digits_1) {
                $divider = ($i == 2) ? 10 : 100;
                $number = floor($no % $divider);
                $no = floor($no / $divider);
                $i += ($divider == 10) ? 1 : 2;
                if ($number) {
                    $plural = (($counter = count($str)) && $number > 9) ? 'S' : null;
                    $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                    $str[] = ($number < 21) ? $words[$number] .
                        " " . $digits[$counter] . $plural . " " . $hundred
                        :
                        $words[floor($number / 10) * 10]
                        . " " . $words[$number % 10] . " "
                        . $digits[$counter] . $plural . " " . $hundred;
                } else $str[] = null;
            }
            $str = array_reverse($str);
            $result = implode('', $str);
            $points = ($point) ?
                "." . $words[$point / 10] . " " .
                $words[$point = $point % 10] : '';
            $data['salary_in_word'] = $result . "RUPEES";
            // echo $data['salary_in_word'];exit;
            return view('user.admin.increment', $data);
        } else {
            return redirect(env('APP_URL') . 'adper');
        }
    }
    public function appraisal(Request $request)
    {
        if (!empty(Session::get('user'))) {
            $user_id = Session::get('user');
            $user = $this->user($user_id);
            $data['ext'] = $ext = $request->post();
            return view('user.admin.appraisal', $data);
        } else {
            return redirect(env('APP_URL') . 'adper');
        }
    }
    public function user($user_id, $lt = 0)
    {
        $user = User::select('user.*', 'department.d_name','user_permission.permission')->where('user.id', $user_id)->leftJoin('department', 'user.user_type', 'department.id')->leftjoin('user_permission','user.id','user_permission.uid')->get();
        if (!empty($user)) {
            if ($lt == 0) {
                $this->login_time($user_id);
            }
            return $user[0];
        } else {
            print_r("<script>window.location.replace('" . env('APP_URL') . 'adper/logout' . "');</script>");
            exit;
        }
    }
    public function login_time($user_id)
    {
        $date = date('Y-m-d');
        $user = $this->user($user_id, 1);
        if ($user->user_type == 1) {
            $check = Attendance::where('user_id', $user_id)->where('mark_date', $date);
            if ($check->count() == 0) {
                $login_time = date('H:i');
                Attendance::create(['user_id' => $user_id, 'mark_date' => $date, 'login_time' => $login_time]);
                $date = new DateTime(date('Y-m-d'));
                $week = $date->format("W");
                if ($user->current_week < $week) {
                    if (strtotime("11:15") < strtotime($login_time)) {
                        User::where('id', $user_id)->update(['current_week' => $week, 'late_count' => 1]);
                    } else {
                        User::where('id', $user_id)->update(['current_week' => $week, 'late_count' => 0]);
                    }
                } else {
                    if (strtotime("11:15") < strtotime($login_time)) {
                        User::where('id', $user_id)->increment('late_count', '1');
                    }
                }
            } else {
                if (empty($check->get()[0]->login_time)) {
                    $login_time = date('H:i');
                    $check->update(['login_time' => $login_time]);
                }
            }
        } elseif ($user->user_type == 3 or $user->user_type == 4) {
            $timezone = 'Asia/Kolkata';
            $now = Carbon::now();
            $now->timezone($timezone);
            $login_time = $now->format('H:i');
            $date = $now->format('Y-m-d');
            $check = Attendance::where('user_id', $user_id)->where('mark_date', $date);
            if ($check->count() == 0) {
                Attendance::create(['user_id' => $user_id, 'mark_date' => $date, 'login_time' => $login_time]);
            } else {
                if (empty($login_time)) {
                    $check->update(['login_time' => $login_time]);
                }
            }
        } else {
            $check = Attendance::where('user_id', $user_id)->where('mark_date', $date);
            if ($check->count() == 0) {
                $login_time = date('H:i');
                Attendance::create(['user_id' => $user_id, 'mark_date' => $date, 'login_time' => $login_time]);
            } else {
                if (empty($check->get()[0]->login_time)) {
                    $login_time = date('H:i');
                    $check->update(['login_time' => $login_time]);
                }
            }
        }
    }
    public function logout()
    {
        Session::flush();
        return redirect(env('APP_URL') . 'adper');
    }
    public function user_mode($id, Request $request)
    {
        if (!empty(Session::get('user'))) {
            $user_id = Session::get('user');
            $user = $this->user($user_id);
            $request->session()->put('user', $id);
            return redirect(env('APP_URL') . 'user');
        } else {
            return redirect(env('APP_URL') . 'adper');
        }
    }
    public function x_week_range($date)
    {
        $ts = strtotime($date);
        $start = (date('w', $ts) == 1) ? $ts : strtotime('last Monday', $ts);
        return array(
            date('Y-m-d', $start),
            date('Y-m-d', strtotime('next Sunday', $start))
        );
    }
    public function offup(Request $request)
    {
        if ($request->hasFile('pdfFile')) {
            // dd('uploding');
            $pan_card = $request->file('pdfFile');
            $te = $pan_card->store('imgs');
            if($request->has('id')){
                $id = $request->id;
                User_file::create([
                        'uid'=>$request->id,
                        'file_type'=>$request->file_type,
                        'file'=>$te,
                        'file_date'=>now(),
                ]);
                return  redirect(env('APP_URL') . 'adper/attendance/full_report/' . $id);
            }
            return $te;
        }
    }
    public function reject($id, Request $request)
    {
        if (!empty(Session::get('user'))) {
            $user_id = Session::get('user');
            $a = New_hiring::where('id', $id);
            $a->update(['status' => 'rejected']);
            $data = array('name' => $a->get()[0]->name);
            $to = $a->get()[0]->email;
            Mail::send('rejected', $data, function ($message)  use ($to) {
                $message->to($to)->subject('Re: Update regarding your application');
                $message->cc('admin@pantheondigitals.com');
                $message->from('hr@pantheondigitals.com');
            });
            return redirect(env('APP_URL') . 'adper/onboard/candidate');
        } else {
            return redirect(env('APP_URL') . 'adper');
        }
    }
    public function schedule_interview(Request $request)
    {
        if (!empty(Session::get('user'))) {
            $user_id = Session::get('user');
            $a = New_hiring::where('id', $request->interviewid);
            $a->update(['status' => 'ongoing', 'progress' => 'interview', 'interview_date' => $request->interview_date]);;
            $data = array('name' => $a->get()[0]->name, 'interview_date' => $a->get()[0]->interview_date, 'apply_for' => $a->get()[0]->apply_for);
            $to = $a->get()[0]->email;
            Mail::send('schedule_interview', $data, function ($message)  use ($to) {
                $message->to($to)->subject('Re: Interview Scheduled');
                $message->cc('admin@pantheondigitals.com');
                $message->from('hr@pantheondigitals.com');
            });
            return redirect(env('APP_URL') . 'adper/onboard/candidate');
        } else {
            return redirect(env('APP_URL') . 'adper');
        }
    }
    // public function hired($id, Request $request)
    // {
    //     if (!empty(Session::get('user'))) {
    //         $user_id = Session::get('user');
    //         New_hiring::where('id', $id)->update(['status' => 'hired', 'progress' => 'joined']);
    //         return redirect(env('APP_URL') . 'adper/onboard/candidate');
    //     } else {
    //         return redirect(env('APP_URL') . 'adper');
    //     }
    // }
    public function leave_reject($id = '', Request $request)
    {
        if (!empty(Session::get('user'))) {
            $user_id = Session::get('user');
            $user = $this->user($user_id);
            $userName = $user->name;
            if (!empty($id)) {
                $leave = Leave::where('id', $id)->where('approved', 0);
                if ($leave->count() > 0) {
                    $response = $request->input('response', '');
                    $leave->update(['approved' => 2, 'response' => $response,'approved_by' => $userName]);
                }
                return redirect(env('APP_URL') . 'adper/leave');
            } else {
                return redirect(env('APP_URL') . 'adper/leave');
            }
        } else {
            return redirect(env('APP_URL') . 'adper');
        }
    }
    public function hired_candidate(Request $request)
    {
        if (!empty(Session::get('user'))) {
            $user_id = Session::get('user');
            $user = $this->user($user_id);
            $data['user'] = $user;
            if ($request->_token) {
                if ($request->save) {
                    New_hiring::where('id', $request->id)->update(['salary' => $request->salary, 'server_ip' => $request->server_ip, 'status' => 1]);
                } elseif ($request->disabled) {
                    New_hiring::where('id', $request->id)->update(['status' => 0, 'leave_count' => 0]);
                } elseif ($request->enabled) {
                    New_hiring::where('id', $request->id)->update(['status' => 1]);
                }
                print_r('<script>window.close();</script>');
            } else {
                $data['users'] = New_hiring::where('status', 'hired')->orderBy('id', 'DESC')->get();
                return view('user.admin.rejected', $data);
            }
        } else {
            return redirect(env('APP_URL') . 'adper');
        }
    }
    public function add_candidate(Request $request)
    {
        if (!empty(Session::get('user'))) {
            $user_id = Session::get('user');
            $user = $this->user($user_id);
            if (!empty($request->post('_token'))) {
                $ext = $request->post();
                unset($ext['_token']);
                if ($request->hasFile('resume')) {
                    $resume = $request->file('resume');
                    $te = $resume->store('imgs');
                    $ext['resume'] = env('APP_URL') . 'public/uploads/' . $te;
                }
                // print_r($ext);
                // exit;
                New_hiring::create($ext);
                return redirect(env('APP_URL') . 'adper/onboard/add_candidate');
            } else {
                $data['user'] = $user;
                return view('user.admin.add_candidate', $data);
            }
        } else {
            return redirect(env('APP_URL') . 'adper');
        }
    }
    public function rejected(Request $request)
    {
        // review karna hai or reject rout and file ko remove karna hai uski jgha onbord wala funciton thik karna hai onboard/candidate
        if (!empty(Session::get('user'))) {
            $user_id = Session::get('user');
            $user = $this->user($user_id);
            $data['user'] = $user;
            if ($request->_token) {
                if ($request->save) {
                    New_hiring::where('id', $request->id)->update(['salary' => $request->salary, 'server_ip' => $request->server_ip, 'status' => 1]);
                } elseif ($request->disabled) {
                    New_hiring::where('id', $request->id)->update(['status' => 0, 'leave_count' => 0]);
                } elseif ($request->enabled) {
                    New_hiring::where('id', $request->id)->update(['status' => 1]);
                }
                print_r('<script>window.close();</script>');
            } else {
                $data['users'] = New_hiring::where('status', 'rejected')->orderBy('id', 'DESC')->get();
                return view('user.admin.rejected', $data);
            }
        } else {
            return redirect(env('APP_URL') . 'adper');
        }
    }
    public function interview(Request $request)
    {
        if (!empty(Session::get('user'))) {
            $user_id = Session::get('user');
            $user = $this->user($user_id);
            $data['user'] = $user;
            if ($request->_token) {
                if ($request->save) {
                    New_hiring::where('id', $request->id)->update(['salary' => $request->salary, 'server_ip' => $request->server_ip, 'status' => 1]);
                } elseif ($request->disabled) {
                    New_hiring::where('id', $request->id)->update(['status' => 0, 'leave_count' => 0]);
                } elseif ($request->enabled) {
                    New_hiring::where('id', $request->id)->update(['status' => 1]);
                }
                print_r('<script>window.close();</script>');
            } else {
                $data['users'] = New_hiring::where('status', 'ongoing')->orderBy('id', 'DESC')->get();
                return view('user.admin.interview', $data);
            }
        } else {
            return redirect(env('APP_URL') . 'adper');
        }
    }
    public function usdata($ym = '2023-03')
    {
        $datausersale = Attendance::where('user_id', '!=', 15)->where('user_id', '!=', 1)->whereBetween('mark_date', [date($ym . '-') . '01', date($ym . '-') . '31'])->groupBy('user_id')->orderBy('sum', 'DESC')->selectRaw('sum(sale_made) as sum, user_id')->pluck('sum', 'user_id');
        $data['usersale'] = [];
        foreach ($datausersale as $k => $as) {
            $data['usersale'][$k] = $as;
        }
        $usersale = ($data['usersale']);
        $i = 1;
        foreach ($usersale as $k => $as) {
            $ka = User::where('id', $k)->get();
            if ($ka->count() > 0) {
                $ka = $ka[0];
                $x[] = $ka->user_id;
                $y[] = $as;
                if ($i == 8) {
                    break;
                }
                $i++;
            }
        }
        echo json_encode(['x' => $x, 'y' => $y]);
    }
    public function salary(Request $request)
    {
        if (!empty(Session::get('user'))) {
            $user_id = Session::get('user');
            $user = $this->user($user_id);
            $user_id = Session::get('user');
            $user = $this->user($user_id);
            if (!empty($request->month)) {
                $e = explode('-', $request->month);
                $data['year'] = $year = $e[0];
                $data['month'] = $month = $e[1];
                $data['date'] = $request->month;
            } else {
                $data['year'] = $year = date('Y');
                $data['month'] = $month = date('m');
                $data['date'] = date('Y-m');
            }
            $fdate = date($year . '-' . $month . '-01');
            $tdate = date($year . '-' . $month . '-31');
            $check_date = "$year-$month-01";
            $data['cmo'] = "$year-$month";
            $data['user'] = $user;
            $users = User::select(
                'user.*',
                'user_salary.salary AS csalary',
                DB::raw('SUM(attendance.incentive) AS total_incentive'),
                DB::raw("SUM(CASE WHEN attendance.mark = 'P' THEN 1 ELSE 0 END) AS total_P"),
                DB::raw("SUM(CASE WHEN attendance.mark = 'H' THEN 1 ELSE 0 END) AS total_H"),
                DB::raw("SUM(CASE WHEN attendance.mark = 'A' THEN 1 ELSE 0 END) AS total_A"),
                DB::raw("SUM(CASE WHEN attendance.mark = 'UPL' THEN 1 ELSE 0 END) AS total_UPL"),
                DB::raw("SUM(CASE WHEN attendance.mark = 'HPL' THEN 1 ELSE 0 END) AS total_HPL"),
                DB::raw("SUM(CASE WHEN attendance.mark = 'HPHL' THEN 1 ELSE 0 END) AS total_HPHL"),
                DB::raw("SUM(CASE WHEN attendance.mark = 'PL' THEN 1 ELSE 0 END) AS total_PL"),
                DB::raw("SUM(attendance.sale_made) AS total_sales"),
                DB::raw("SUM(attendance.leads) AS total_leads"),
            )
                ->leftJoin('user_salary', 'user.id', 'user_salary.uid')->whereDate('from', '<=', $check_date)
                ->whereDate('to', '>=', $check_date)
                ->leftJoin('attendance', 'user.id', '=', 'attendance.user_id')
                ->where('user.status', 1)
                ->whereBetween('attendance.mark_date', [$fdate, $tdate])
                ->groupBy('user.id')
                ->get();
            $use = [];
            $holi = Holiday::whereBetween('hdate', [$year . '-' . $month . '-01', $year . '-' . $month . '-31'])->count();
            $data['total_working'] = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            $data['hsun'] = $this->dayCount('Sunday', $month, $year) + $holi;
            foreach ($users as $us) {
                $use[$us->id] = $us;
                $adjustedSundays = 0;
                $sundays = $this->getSundays($year, $month);
                // old
                    // foreach ($sundays as $sunday) {
                    //     $saturday = date('Y-m-d', strtotime("$sunday -1 day"));
                    //     $monday = date('Y-m-d', strtotime("$sunday +1 day"));
                
                    //     $attendanceSaturday = Attendance::where('user_id', $us->id)
                    //                                      ->whereDate('mark_date', $saturday)
                    //                                      ->first();
                
                    //     $attendanceMonday = Attendance::where('user_id', $us->id)
                    //                                   ->whereDate('mark_date', $monday)
                    //                                   ->first();
                    //     if (($attendanceSaturday && ($attendanceSaturday->mark == 'A' || $attendanceSaturday->mark == 'PL')) &&
                    //         ($attendanceMonday && ($attendanceMonday->mark == 'A' || $attendanceMonday->mark == 'PL'))) {
                    //         $adjustedSundays++;
                    //     }
                    // }
                // old
                // new
                    $userAttendances = $users->where('user_id', $us->id);
                    foreach ($sundays as $sunday) {
                        $saturday = date('Y-m-d', strtotime("$sunday -1 day"));
                        $monday = date('Y-m-d', strtotime("$sunday +1 day"));
                
                        // Use Collection's filter method
                        $attendanceSaturday = $userAttendances->first(function ($attendance) use ($saturday) {
                            return $attendance->mark_date == $saturday;
                        });
                
                        $attendanceMonday = $userAttendances->first(function ($attendance) use ($monday) {
                            return $attendance->mark_date == $monday;
                        });
                
                        if (($attendanceSaturday && in_array($attendanceSaturday->mark, ['A', 'PL'])) &&
                            ($attendanceMonday && in_array($attendanceMonday->mark, ['A', 'PL']))) {
                            $adjustedSundays++;
                        }
                    }
                // new
                $use[$us->id]->adjustedSundays = $adjustedSundays;
                $use[$us->id]->total_salary = round(($us->csalary / $data['total_working']) * (($us->total_P  + $us->total_PL  + ($us->total_H / 2)  + ($us->total_HPL / 2)  + ($us->total_HPHL)) + $data['hsun'] - $adjustedSundays));
                $today = date('Y-m-d', strtotime($data['date'] . '-1'));
                
                
                $ult = User_target::where('target_type',1)->where('server_type',$us->server_ip)->whereDate('from', '<=', $today)->whereDate('to', '>=', $today);
                $ulta = $ult->count() ? $ult->first()->target : 0;
                
                // user minimum sales target
                $umst = User_target::where('target_type',0)->where('server_type',$us->server_ip)->whereDate('from', '<=', $today)->whereDate('to', '>=', $today);
                $us_umst = $umst->count() ? $umst->first()->target : 0;
                
                // user monthly sales target
                $umt = User_target::where('target_type',2)->where('server_type',$us->server_ip)->whereDate('from', '<=', $today)->whereDate('to', '>=', $today);
                $us_umt = $umt->count() ? $umt->first()->target : 0;
                $bp = ($us->server_ip == '144.76.0.239') ? 5000 : 3000;
                $basePay = $umt->count() ? $umt->first()->bonus : $bp;
                
                if($us->server_ip == '144.76.0.239'){
                    ($targ = round((($us->csalary / 1000)/100) * $us_umst));
                    $us_umtv = $us_umt ? $us_umt : 100;
                    ($ftarg = round((($us->csalary / 1000)/100) * $us_umtv));
                }else{
                    ($targ = $us_umst);
                    $us_umtv = $us_umt ? $us_umt : $us_umst;
                    ($ftarg = $us_umtv);
                }
                $mts = $us->total_sales - $ftarg;
                if ($mts >= 0) {
                    $payableAmount = $basePay + $mts * 500;
                } else {
                    $payableAmount = 0;
                }
                $use[$us->id]->isPayable = ($us->total_sales >= $targ and $us->total_leads >= $ulta) ? 1 : 0;
                $use[$us->id]->payableAmount = $payableAmount;
            }
            $data['users'] = $use;
            return view('user.admin.salary', $data);
        } else {
            return redirect(env('APP_URL') . 'adper');
        }
    }
    public function ass_ass2(Request $request)
    {
        if (!empty(Session::get('user'))) {
            $user_id = Session::get('user');
            $user = $this->user($user_id);
            $data['user'] = $user;
            if (!empty($request->id)) {
                $ass = Assets::where('id');
            }
            if ($request->_token) {
                $ext = $request->post();
                unset($ext['_token']);
                if (Assets::where('serial_number', $ext['serial_number'])->count() == 0) {
                    $id = Assets::create([
                        'asset_name' => $ext['asset_name'], 'asset_type' => $ext['asset_type'], 'serial_number' => $ext['serial_number'], 'ass_spec' => $ext['ass_spec'], 'asset_owner' => $ext['asset_owner'], 'vander' => $ext['vander'], 'purchase_date' => $ext['purchase_date'], 'warranty' => $ext['warranty']
                    ]);
                    if (!empty($request->uid)) {
                        User_assets::create(['uid' => $ext['user_id'], 'assets_id' => $id->id]);
                    }
                } else {
                    return redirect(env('APP_URL') . 'adper/ass_ass')->with('success', 'serial_number already exists');
                }
                return redirect(env('APP_URL') . 'adper/ass_ass');
            } else {
                if (!empty($request->id)) {
                    $data['edit'] = $ass->get();
                    return view('user.admin.edit_ass', $data);
                } else {
                    $data['tot_ass'] = Assets::select('assets.*', 'user.user_id', 'user_assets.created_at')->leftJoin('user_assets', 'user_assets.assets_id', 'assets.id')->leftJoin('user', 'user_assets.uid', 'user.id')->get();
                    $data['alluser'] = User::where('status', 1)->get();
                    return view('user.admin.ass_ass', $data);
                }
            }
        } else {
            return redirect(env('APP_URL') . 'adper');
        }
    }
    // public function ass_ass(Request $request)
    // {
    //     if (!empty($request->pgno)) {
    //         $pgno = $request->pgno;
    //     } else {
    //         $pgno = 1;
    //     }
    //     $limit = 15;
    //     $oset = ($pgno - 1) * $limit;
    //     $data['pgno'] = $pgno;
    //     if (empty(Session::get('user'))) {
    //         return redirect(config('app.url') . 'adper');
    //     }

    //     $userId = Session::get('user');
    //     $user = $this->user($userId);
    //     $data['user'] = $user;

    //     // Check if the request is POST for creating or updating an asset
    //     if ($request->isMethod('post')) {

    //         $request->validate([
    //             'asset_name' => 'required',
    //             'asset_type' => 'required',
    //             'serial_number' => 'required',
    //             // other validation rules as per your requirements
    //         ]);
    //         $ext = $request->post();
    //         try {
    //             if (!empty($request->id)) {
    //                 $user_id = $ext['user_id'];
    //                 $asset_id = $ext['id'];
    //                 $asset = Assets::findOrFail($asset_id);

    //                 // Check if the asset exists and needs to be updated
    //                 unset($ext['_token']);unset($ext['id']);unset($ext['user_id']);
    //                 if (!empty($asset)) {
    //                     if ($request->hasFile('product_img')) {
    //                         $file = $request->file('product_img');
    //                         $ext['product_img'] = $file->store('imgs');
    //                     }
    //                     if ($request->hasFile('invoice')) {
    //                         $file = $request->file('invoice');
    //                         $ext['invoice'] = $file->store('imgs');
    //                     }
    //                     $asset->update($ext);
    //                     session()->flash('success', 'Assets, ' . $ext['serial_number'] . ' Updated');

    //                     if (!empty($user_id)) {
    //                         $username = User::where('id', $user_id)->first();

    //                         if (!empty($ext['uid'])) {
    //                             User_assets::where('uid', $ext['uid'])
    //                                 ->where('assets_id', $ext['asset_id'])
    //                                 ->update(['status' => 'unassignd', 'to' => Carbon::now()->subDay()]);
    //                         }

    //                         $currentDate = Carbon::now();
    //                         User_assets::create([
    //                             'uid' => $request->user_id,
    //                             'assets_id' => $request->id,
    //                             'from' => $currentDate->format('Y-m-d'),
    //                             'to' => $currentDate->addYear(2)->format('Y-m-d'),
    //                             'status' => 'assign'
    //                         ]);
    //                         session()->flash('success', 'Assets assignd to ' . $username->name);
    //                     }
    //                     return redirect(config('app.url') . 'adper/ass_ass');
    //                 }

    //                 // If the asset doesn't exist or couldn't be updated
    //                 session()->flash('error', 'Failed to update asset');
    //                 return redirect(config('app.url') . 'adper/ass_ass');
    //             } else {
    //                 $existingAsset = Assets::where('serial_number', $ext['serial_number'])->first();
    //                 if ($existingAsset) {
    //                     session()->flash('error', 'Asset with this serial number already exists');
    //                 } else {
    //                     $ass_data = $request->except(['_token', 'user_id']);
    //                     // Create new asset
    //                     if ($request->hasFile('product_img')) {
    //                         $file = $request->file('product_img');
    //                         $ass_data['product_img'] = $file->store('imgs');
    //                     }
    //                     if ($request->hasFile('invoice')) {
    //                         $file = $request->file('invoice');
    //                         $ass_data['invoice'] = $file->store('imgs');
    //                     }
    //                     if (!$request->user_id) {
    //                         session()->flash('success', 'Assets with serail number' . $ext['serial_number'] . 'created');
    //                     }
    //                     $asset = Assets::create($ass_data);
    //                     if (!empty($request->user_id)) {
    //                         $username = User::select('user.*')->where('user.id', $ext['user_id'])->first();
    //                         $f = Carbon::now();
    //                         $a = User_assets::create([
    //                             'uid' => $request->user_id,
    //                             'assets_id' => $asset->id,
    //                             'from' => $f->format('Y-m-d'),
    //                             'to' => $f->addYears(2)->format('Y-m-d'),
    //                             'assign_type' => $request->assign_type,
    //                             'status' => 'assign'
    //                         ]);
    //                         session()->flash('success', 'Assets assignd to ' . $username->name);
    //                     }
    //                 }
    //             }
    //         } catch (\Exception $e) {
    //             // dd($e);
    //             exit;
    //             return back()->with('error', 'Error in asset management');
    //         }
    //         // exit;
    //         return redirect(config('app.url') . 'adper/ass_ass');
    //     }
    //     $data['alluser'] = User::where('status', 1)->get();

    //     if (!empty($request->id)) {
    //         $data['asset'] = Assets::findOrFail($request->id);
    //         $data['edit'] = Assets::select('assets.*', 'assets.status as asset_status', 'user.user_id', 'user_assets.uid', 'user_assets.assets_id', 'user_assets.assign_type', 'user_assets.assign_type', 'user_assets.status', 'user_assets.from', 'user_assets.to')
    //             ->leftJoin('user_assets', 'user_assets.assets_id', '=', 'assets.id')
    //             ->leftJoin('user', 'user_assets.uid', '=', 'user.id')
    //             ->where('assets.id', $request->id)->orderBy('user_assets.created_at', 'desc')
    //             ->first();


    //         return response()->json($data['edit']);
    //     }

    //     $data['assign_ass'] = Assets::select('assets.*', 'user.user_id', 'user_assets.from', 'user_assets.uid')
    //         ->leftJoin('user_assets', 'user_assets.assets_id', '=', 'assets.id')
    //         ->leftJoin('user', 'user_assets.uid', '=', 'user.id')
    //         ->where('user_assets.status', 'assign')
    //         ->get();
    //     $data['ass_count'] = Assets::all()->count();
    //     // dd($data['ass_count']);
    //     $data['assign_count'] = User_assets::where('status', 'assign')->count();
    //     $data['faulty'] = Assets::whereIn('status', ['faulty', 'lost', 'return'])->count();
    //     $total_ass = Assets::select(
    //         'assets.*',
    //         'user.id as user_id',
    //         DB::raw("CASE WHEN user_assets.status = 'assign' THEN 'assignd' END as assignment_status")
    //     )
    //         ->leftJoin('user_assets', function ($join) {
    //             $join->on('user_assets.assets_id', '=', 'assets.id')
    //                 ->where('user_assets.status', '=', 'assign')
    //                 ->leftJoin('user', 'user_assets.uid', '=', 'user.id');
    //         })->orderBy('assets.created_at', 'desc');

    //     $data['lpg'] = ceil($total_ass->count() / $limit);
    //     $data['total_ass'] = $total_ass->limit($limit)->offset($oset)->get();
    //     // dd($total_ass->toSql());
    //     $data['lastval'] = Assets::orderBy('created_at', 'desc')->first();
    //     return view('user.admin.ass_ass', $data);
    // }

    public function ass_ass(Request $request)
    {
        if (!empty($request->pgno)) {
            $pgno = $request->pgno;
        } else {
            $pgno = 1;
        }
        $limit = 15;
        $oset = ($pgno - 1) * $limit;
        $data['pgno'] = $pgno;
        if (empty(Session::get('user'))) {
            return redirect(config('app.url') . 'adper');
        }

        $userId = Session::get('user');
        $user = $this->user($userId);
        $data['user'] = $user;

        // Check if the request is POST for creating or updating an asset
        if ($request->isMethod('post')) {


            $ext = $request->post();

            try {
                if (!empty($request->id)) {

                    $asset_id = $ext['id'];
                    $asset = Assets::findOrFail($asset_id);
                    if (!empty($asset)) {
                        $asset->update($request->except(['_token', 'id']));
                        session()->flash('success', 'Assets, ' . $ext['serial_number'] . ' Updated');
                        // dd($ext);
                        if ($request->status == 'faulty' || $request->status == 'lost' || $request->status == 'return') {
                            echo $ext['uid'];
                            User_assets::where('uid', $ext['uid'])
                                ->where('assets_id', $ext['asset_id'])
                                ->update(['status' => 'unassignd', 'to' => Carbon::now()->subDay()]);
                        }
                        if (!empty($ext['user_id'])) {
                            $username = User::select('user.*')->where('user.id', $ext['user_id'])->first();

                            if (!empty($ext['uid'])) {
                                User_assets::where('uid', $ext['uid'])
                                    ->where('assets_id', $ext['asset_id'])
                                    ->update(['status' => 'unassignd', 'to' => Carbon::now()->subDay()]);
                            }

                            $currentDate = Carbon::now();
                            User_assets::create([
                                'uid' => $request->user_id,
                                'assets_id' => $request->id,
                                'from' => $currentDate->format('Y-m-d'),
                                'to' => $currentDate->addYear(2)->format('Y-m-d'),
                                'status' => 'assign'
                            ]);
                            session()->flash('success', 'Assets assignd to ' . $username->name);
                        }
                        return redirect(config('app.url') . 'adper/ass_ass');
                    }
                    session()->flash('error', 'Failed to update asset');
                    return redirect(config('app.url') . 'adper/ass_ass');
                } else {
                    $existingAsset = Assets::where('serial_number', $ext['serial_number'])->first();
                    if ($existingAsset) {
                        session()->flash('error', 'Asset with this serial number already exists');
                    } else {
                        $ass_data = $request->except(['_token', 'user_id']);
                        // Create new asset
                        if ($request->hasFile('product_img')) {
                            $file = $request->file('product_img');
                            $ass_data['product_img'] = $file->store('imgs');
                        }
                        if ($request->hasFile('invoice')) {
                            $file = $request->file('invoice');
                            $ass_data['invoice'] = $file->store('imgs');
                        }
                        if (!$request->user_id) {
                            session()->flash('success', 'Assets with serail number' . $ext['serial_number'] . 'created');
                        }
                        $asset = Assets::create($ass_data);
                        if (!empty($request->user_id)) {
                            $username = User::select('user.*')->where('user.id', $ext['user_id'])->first();
                            $f = Carbon::now();
                            $a = User_assets::create([
                                'uid' => $request->user_id,
                                'assets_id' => $asset->id,
                                'from' => $f,
                                'to' => $f->addYears(2)->format('Y-m-d'),
                                'assign_type' => $request->assign_type,
                                'status' => 'assign'
                            ]);
                            session()->flash('success', 'Assets assignd to ' . $username->name);
                        }
                    }
                }
            } catch (\Exception $e) {
                // dd($e);
                exit;
                return back()->with('error', 'Error in asset management');
            }
            // exit;
            return redirect(config('app.url') . 'adper/ass_ass');
        }
        $data['alluser'] = User::where('status', 1)->get();

        if (!empty($request->id)) {
            $data['asset'] = Assets::findOrFail($request->id);
            $data['edit'] = Assets::select('assets.*', 'assets.status as asset_status', 'user.user_id', 'user_assets.uid', 'user_assets.assets_id', 'user_assets.assign_type', 'user_assets.assign_type', 'user_assets.status', 'user_assets.from', 'user_assets.to')
                ->leftJoin('user_assets', 'user_assets.assets_id', '=', 'assets.id')
                ->leftJoin('user', 'user_assets.uid', '=', 'user.id')
                ->where('assets.id', $request->id)->orderBy('user_assets.created_at', 'desc')
                ->first();


            return response()->json($data['edit']);
        }

        $data['assign_ass'] = Assets::select('assets.*', 'user.user_id', 'user_assets.from', 'user_assets.uid')
            ->leftJoin('user_assets', 'user_assets.assets_id', '=', 'assets.id')
            ->leftJoin('user', 'user_assets.uid', '=', 'user.id')
            ->where('user_assets.status', 'assign')
            ->get();
        $data['ass_count'] = Assets::all()->count();
        // dd($data['ass_count']);
        $data['assign_count'] = User_assets::where('status', 'assign')->count();
        $data['faulty'] = Assets::whereIn('status', ['faulty', 'lost', 'return'])->count();
        // $data['lpg'] = ceil($total_ass->count() / $limit);
        $data['total_ass'] = Assets::select(
            'assets.*',
            'user.id as user_id',
            DB::raw("CASE WHEN user_assets.status = 'assign' THEN 'assignd' END as assignment_status")
        )
            ->leftJoin('user_assets', function ($join) {
                $join->on('user_assets.assets_id', '=', 'assets.id')
                    ->where('user_assets.status', '=', 'assign')
                    ->leftJoin('user', 'user_assets.uid', '=', 'user.id');
            })->orderBy('assets.created_at', 'desc')->get();
        $data['defaulty_ass'] = Assets::whereIn('status', ['faulty', 'lost', 'return'])->get();
        // $data['lpg'] = ceil($total_ass->count() / $limit);
        // $data['total_ass'] = $total_ass->limit($limit)->offset($oset)->get();
        // dd($data['defaulty_ass']);
        $data['lastval'] = Assets::orderBy('created_at', 'desc')->first();
        return view('user.admin.ass_ass', $data);
    }

    public function getall()
    {

        // $data['alluser'] = User::where('status', 1)->get();

        $data = Assets::select(
            'assets.*',
            'user.id as user_id',
            'user_assets.status as assignment_status',
        )
            ->where(function ($query) {
                $query->where('assets.status', '<>', 'faulty')
                    ->orWhereNull('assets.status');
            })
            ->leftJoin('user_assets', function ($join) {
                $join->on('user_assets.assets_id', '=', 'assets.id')
                    ->where('user_assets.status', '=', 'assign')
                    ->leftJoin('user', 'user_assets.uid', '=', 'user.id');
            })->orderBy('assets.created_at', 'desc')
            ->get();
        // dd($data->toSql());
        return response()->json($data);
    }
    public function unassignd(Request $request)
    {
        if (!empty(Session::get('user'))) {
            $user_id = Session::get('user');
            $user = $this->user($user_id);
            $ext = request()->post();
            $userAssId = $request->route('uid');
            $AssId = $request->route('aid');
            unset($ext['_token']);
            echo 'unassiging the user';
            // dd($ext['id']);
            $up = User_assets::where('assets_id', $AssId)->where('uid', $userAssId)
                ->update(['status' => 'unassignd', 'to' => Carbon::now()]);
            if ($up) {
                session()->flash('success', 'Assets unassignd');
                return redirect(env('APP_URL') . 'adper/ass_ass');
            } else {
                session()->flash('error', 'Error in unassigning the assets');
                return redirect(env('APP_URL') . 'adper/ass_ass');
            }
        } else {
            return redirect(env('APP_URL') . 'adper');
        }
    }
    public function filter(Request $request)
    {
        if (!$request->has('custome_filter')) {
            $query = Assets::select(
                'assets.*',
                'user_assets.status as assignment_status'
            )->where(function ($query) {
                $query->where('assets.status', '<>', 'faulty')
                    ->orWhereNull('assets.status');
            })
                ->leftJoin('user_assets', function ($join) {
                    $join->on('user_assets.assets_id', '=', 'assets.id')
                        ->where('user_assets.status', '=', 'assign');
                });

            if ($request->has('asset_type') && $request->input('asset_type')) {

                $query->where('asset_type', $request->input('asset_type'));
            }
            if ($request->has('user') && $request->input('user')) {

                $query->where('uid', $request->input('user'));
            }
            if ($request->has('assorunass') && $request->input('assorunass')) {
                $status = $request->input('assorunass');
                // dd($status);

                if ($status == 'Pantheon') {
                    // Fetch assets that are assignd
                    $query = Assets::select('assets.*', 'user_assets.status as assignment_status')
                        ->leftJoin('user_assets', 'user_assets.assets_id', '=', 'assets.id')
                        ->where('assets.asset_owner', '=', $status);
                } elseif ($status == 'Other') {
                    // Fetch assets that are unassignd or not present in user_assets
                    $query = Assets::select('assets.*', 'user_assets.status as assignment_status')
                        ->leftJoin('user_assets', 'user_assets.assets_id', '=', 'assets.id')
                        ->where('assets.asset_owner', '=', $status);
                    // $sqlQuery = $query->toSql();
                    // $bindings = $query->getBindings();

                    // // // Output the query and bindings
                    // dd($sqlQuery, $bindings);
                }
            }
            if ($request->has('date') && $request->input('date')) {
                $date = $request->input('date');
                $today = Carbon::today();
                switch ($date) {
                    case 'today':
                        $query->whereDate('purchase_date', $today);
                        break;
                    case 'yesterday':
                        $query->whereDate('purchase_date', $today->subDay());
                        break;
                    case 'week':
                        $query->whereBetween('purchase_date', [$today->startOfWeek(), $today->endOfWeek()]);
                        break;
                    case 'fortnight':
                        $query->whereBetween('purchase_date', [$today->subWeeks(2), $today]);
                        break;
                    case 'month':
                        $query->whereBetween('purchase_date', [$today->startOfMonth(), $today->endOfMonth()]);
                        break;
                    case 'six-month':
                        $query->whereBetween('purchase_date', [$today->subMonths(6), $today]);
                        break;
                    case 'year':
                        $query->whereBetween('purchase_date', [$today->startOfYear(), $today->endOfYear()]);
                        break;
                }
            }
        } else {
            if ($request->has('custome_filter') && $request->input('custome_filter')) {
                $customFilter = $request->input('custome_filter');
               $query = Assets::select('assets.*', 'user_assets.status as assignment_status')
    ->leftJoin('user_assets', function ($join) {
        $join->on('user_assets.assets_id', '=', 'assets.id')
             ->where(function ($query) {
                 $query->where('user_assets.from', '<=', date('Y-m-d'))
                       ->where(function ($q) {
                           $q->where('user_assets.to', '>=', date('Y-m-d'))
                             ->orWhereNull('user_assets.to');
                       });
             });
    })
    ->where(function ($query) {
        $query->where('assets.status', '<>', ['faulty','return','lost'])
              ->orWhereNull('assets.status');
    })
    ->where(function ($query) use ($customFilter) {
        if ($customFilter) {
            $query->where('assets.serial_number', 'like', "%$customFilter%")
                  ->orWhere('user_assets.status', 'like', "%$customFilter%");
        }
    })
    // Include assets without any user_assets entries or that meet the above join criteria
    ->groupBy('assets.id')
    ->havingRaw('COUNT(user_assets.id) = 0 OR MAX(user_assets.status) IS NOT NULL');

            }
        }

        $assets = $query->get();
// dd(\DB::getQueryLog());
        return response()->json($assets);
    }

    public function faulty($id)
    {
        if (!empty(Session::get('user'))) {
            $user_id = Session::get('user');
            // $user = $this->user($user_id);
            // dd($ext);
            $user_id = request()->route('uid');

            if (!empty($user_id)) {
                $up = User_assets::where('uid', $user_id)
                    ->where('assets_id', $id)
                    ->where('status', 'assign')
                    ->update(['status' => 'unassignd']);

                Assets::where('id', $id)
                    ->update(['status' => 'faulty']);
            } else {
                $up = Assets::select('asset.*')->where('id', $id)->update(['status' => 'faulty']);
            }

            if ($up) {

                session()->flash('error', 'Asset set to Faulty');
                return redirect(env('APP_URL') . 'adper/ass_ass');
            } else {
                session()->flash('error', 'unable to set assset as Faulty');
                return redirect(env('APP_URL') . 'adper/ass_ass');
            }
        }
    }
    public function resolved($id)
    {
        if (!empty(Session::get('user'))) {
            $user_id = Session::get('user');
            // $user = $this->user($user_id);
            // dd($ext);
            $up = Assets::select('asset.*')->where('id', $id)->update(['status' => 'well']);


            if ($up) {

                session()->flash('success', 'Asset set to well');
                return redirect(env('APP_URL') . 'adper/ass_ass');
            } else {
                session()->flash('error', 'unable to set assset as Faulty');
                return redirect(env('APP_URL') . 'adper/ass_ass');
            }
        }
    }
    public function asset_history($id)
    {
        if (!empty(Session::get('user'))) {
            $user_id = Session::get('user');
            $user = $this->user($user_id);
            $ext = request()->post();
            unset($ext['_token']);
            $data = User_assets::select('user_assets.*', 'user.photo', 'user.user_id')
                ->where('assets_id', $id)
                ->leftjoin('user', 'user_assets.uid', 'user.id')->get();
            return response()->json($data);
        } else {
            return redirect(env('APP_URL') . 'adper');
        }
    }
    public function policies(Request $request)
    {
        if (!empty(Session::get('user'))) {
            $user_id = Session::get('user');
            $data['user'] = $this->user($user_id);
            $ext = request()->post();
            unset($ext['_token']);
            if ($request->isMethod('post')) {

                $ext['status'] = 1;
                if (!empty($request->id)) {
                    $policy = Policies::find($request->id);
                    $policy->update($ext);
                } else {
                    // dd($ext);z`
                    Policies::create($ext);
                }

                return redirect(env('APP_URL') . 'adper/policies');
            } else {
                $data['get_policies'] = Policies::select('policies.*')->where('status', 1)->get();
                return view('user.admin.policies', $data);
            }
        }
    }

    public function policy_Expire(Request $request)
    {
        if (!empty(Session::get('user'))) {
            $user_id = Session::get('user');
            $user = $this->user($user_id);
            $data['user'] = $user;
            if ($request->status == 0) {
                policies::where('id', $request->id)->update(['status' => 0]);
            }
        } else {
            return redirect(env('APP_URL') . 'adper');
        }
    }
    public function dayCount($day, $month, $year)
    {
        $totalDay = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $count = 0;
        for ($i = 1; $totalDay >= $i; $i++) {
            if (date('l', strtotime($year . '-' . $month . '-' . $i)) == ucwords($day)) {
                $count++;
            }
        }
        return $count;
    }
    public function delete_assets($id)
    {
        if (!empty(Session::get('user'))) {
            $user_id = Session::get('user');
            $user = $this->user($user_id);
            $e = Assets::where('id', $id);
            if ($e->count() > 0) {
                $e->delete();
                return redirect(env('APP_URL') . 'adper/ass_ass');
            } else {
                return redirect(env('APP_URL') . 'adper/ass_ass');
            }
        } else {
            return redirect(env('APP_URL') . 'adper');
        }
    }
    public function bulk_upload(Request $request)
    {
        if (!empty(Session::get('user'))) {
            $user_id = Session::get('user');
            $user = $this->user($user_id);
            $csvFile = $request->file('bulkUpload');
            $currentYear = now()->year;
            $ext = $request->post();
            $duplicates = [];
            $uploaded = 0;
            //   dd($ext);
            if (($handle = fopen($csvFile->getRealPath(), 'r')) !== FALSE) {

                fgetcsv($handle);

                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    $purchaseDate = $data[6];
                    $dateObject = DateTime::createFromFormat('d-m-Y', $purchaseDate);
                    $formattedDate = $dateObject ? $dateObject->format('Y-m-d') : null;
                    $assetType = $data[3];
                    $serialNumber = $data[2];
                    if (Assets::where('serial_number', $serialNumber)->exists()) {
                        $duplicates[] = $serialNumber;
                        continue;
                    }

                    $assetCode = strtoupper(substr($assetType, 0, 3));
                    $lastAsset = Assets::orderBy('id', 'desc')->first();
                    $lastNumber = $lastAsset ? intval(substr($lastAsset->product_code, -9, 4)) : 0;
                    $uniqueNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
                    $productCode = 'PD/' . $assetCode . '/' . $uniqueNumber . '/' . $currentYear;

                    $newAsset = new Assets([
                        'product_code' => $productCode,
                        'asset_name' => $data[0],
                        'asset_type' => $data[1],
                        'serial_number' => $serialNumber,
                        'ass_spec' => $data[3],
                        'asset_owner' => $data[4],
                        'vander' => $data[5],
                        'purchase_date' => $formattedDate,
                        'warranty' => $data[7],
                        'remark' => $data[8],
                    ]);

                    $newAsset->save();
                    $uploaded++;
                }
                fclose($handle);
            }

            if (!empty($duplicates)) {
                return redirect()->back()->with('error', 'Some assets were not uploaded due to duplicate serial numbers.')->with('duplicates', $duplicates);
            } else {
                return redirect()->back()->with('success', 'Assets uploaded successfully.')->with('uploaded_count', $uploaded);
            }
        }
    }
    // public function  userReport($date,$id){
    //     $data['user']= Attendance::select('attendance.mark','attendance.mark_date','attendance.login_time','attendance.logout_time','attendance.nonpause','attendance.sale_made','attendance.customer','attendance.leads','user.name')->where('mark_date',$date)
    //     ->where('attendance.user_id',$id)
    //     ->leftJoin('user','user.id','=','attendance.user_id')
    //     ->where('user.id',$id)->get();
    //     return response()->json($data);
    // }
    private function getfromcrm() {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crm4.pantheondigitals.com/api.php?getcloser=1',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response, true);
    }
    private function createdialer($user) {
        if($user['server_ip'] == "122.186.6.91"){
            $url = "122.186.6.91";
        }else{
            $url = "176.9.17.110";
        }
        $murl = 'http://'.$url.'/vicidial/zzadduser.php';
        $sdata = array('ADD' => '2','user_toggle' => '0','user' => $user['user_id'],'pass' => $user['password'],'full_name' => $user['name'],'user_level' => '1','user_group' => 'Agents','phone_login' => '','phone_pass' => '');
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => $murl,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => $sdata,
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return json_encode(["res"=>$response]);
    }
    private function createcrmuser($user) {
        // return 'https://crm4.pantheondigitals.com/api.php?createuser=1&user_id='.$user['user_id'].'&name='.$user['name'].'&password='.$user['password'];
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crm4.pantheondigitals.com/api.php?createuser=1&user_id='.$user['user_id'].'&name='.$user['name'].'&password='.$user['password'],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }
    private function getSundays($year, $month) {
        $date = "$year-$month-01";
        $firstDay = new DateTime($date);
        $lastDay = new DateTime($date);
        $lastDay->modify('last day of this month');
        $interval = new \DateInterval('P1D');
        $dateRange = new \DatePeriod($firstDay, $interval, $lastDay);
    
        $sundays = [];
        foreach ($dateRange as $day) {
            if ($day->format('w') == 0) { // Sunday
                $sundays[] = $day->format('Y-m-d');
            }
        }
        return $sundays;
    }
    
    
    public function attendance2(Request $request)
    {
        if (!empty(Session::get('user'))) {
            $user_id = Session::get('user');
            $user = $this->user($user_id);
            $data['user'] = $user;
            return view('user.admin.attendance2', $data);
        } else {
            return redirect(env('APP_URL') . 'adper');
        }
    }
    public function sales2(Request $request)
    {
        if (!empty(Session::get('user'))) {
            $user_id = Session::get('user');
            $user = $this->user($user_id);
            $data['user'] = $user;
            if (!empty($request->month)) {
                $e = explode('-', $request->month);
                $data['year'] = $year = $e[0];
                $data['month'] = $month = $e[1];
                $data['date'] = $request->month;
            } else {
                $data['year'] = $year = date('Y');
                $data['month'] = $month = date('m');
                $data['date'] = date('Y-m');
            }
            $utype = $data['type'] = $request->type;
            $firstDay = date('Y-m-d', strtotime("$year-$month-21 last month"));
            $lastDay = date('Y-m-d', strtotime("$year-$month-20"));
            $workType = $request->input('workType');

            $usersQuery = Attendance::select('attendance.*', 'user.user_id', 'user.id', 'user_salary.salary', 'user.server_ip')
                ->join('user', 'attendance.user_id', '=', 'user.id')
                ->leftJoin('user_salary', 'attendance.user_id', '=', 'user_salary.uid')
                ->where('user.status', '=', '1')
                ->where('user.user_type', '=', $request->input('type'))
                ->whereBetween('mark_date', [$firstDay, $lastDay]);

            if (!empty($workType)) {
                $usersQuery->where('user.work_type', '=', $workType);
            }

            $users = $usersQuery->whereBetween('mark_date', [$firstDay, $lastDay])
                ->orderBy('mark_date', 'asc')
                ->get();
            if ($users->count() == 0) {
                $data['attendance'] = [];
                return view('user.admin.attendance.sales', $data);
            }
            $today = date('Y-m-d', strtotime($data['date'] . '-1'));
            $todate = date('Y-m-d');
            if($utype == 1){
            $targets = User_target::whereIn('server_type', ['144.76.0.239', '122.186.6.91'])
            ->whereDate('from', '<=', $today)
            ->whereDate('to', '>=', $today)
            ->groupBy('server_type', 'target_type')
            ->selectRaw('server_type, target_type, SUM(CASE WHEN target_type = 0 THEN target ELSE 0 END) as target_sum_targ, SUM(CASE WHEN target_type = 1 THEN target ELSE 0 END) as target_sum_lead')
            ->get();
            
            $data['us_umst'] = $us_umst44 = $targets->where('server_type', '144.76.0.239')->where('target_type', 0)->first()->target_sum_targ ?? 0;
            $data['us_umst'] = $us_umst22 = $targets->where('server_type', '122.186.6.91')->where('target_type', 0)->first()->target_sum_targ ?? 0;
            $data['us_umsl'] = $us_umsl44 = $targets->where('server_type', '144.76.0.239')->where('target_type', 1)->first()->target_sum_lead ?? 0;
            $data['us_umsl'] = $us_umsl22 = $targets->where('server_type', '122.186.6.91')->where('target_type', 1)->first()->target_sum_lead ?? 0;
            }
            $holi = Holiday::whereBetween('hdate', [$year . '-' . $month . '-01', $year . '-' . $month . '-31'])->count();
            $data['total_working'] = cal_days_in_month(CAL_GREGORIAN, $month, $year) - $this->dayCount('Sunday', $month, $year) - $holi;
            $holidayCheck = Holiday::select('hdate')->whereBetween('hdate', [$firstDay, $lastDay])->where(function($q) use ($request){$q->where('user_type', $request->input('type'))->orWhere('user_type',0);})->get();
            $data['hdates'] = $hdates = array_column($holidayCheck->toArray(), "hdate");
            foreach ($users as $user) {
                $userId = $user->user_id;
                $markdateday = explode('-', $user->mark_date);
                $markornot = end($markdateday);
                $isCurrentDay = $user->mark_date == $todate;
                if(in_array($user->mark_date,$hdates)){
                    $data['attendance'][$userId][$markornot] = "NH";
                }else{
                    if ($isCurrentDay && is_null($user->mark)) {
                        $data['attendance'][$userId][$markornot] = "LI";
                    }else{
                        $data['attendance'][$userId][$markornot] = $user->mark;
                    }
                }
                if (!empty($data['attendance'][$user->user_id]['sale_done'])) {
                    $data['attendance'][$user->user_id]['sale_done'] += $user->sale_made;
                } else {
                    $data['attendance'][$user->user_id]['sale_done'] = $user->sale_made;
                }
                $data['attendance'][$userId]['id'] = $user->id;
                if($utype == 1){
                if ($user->server_ip == '122.186.6.91') {
                        $user_target = $us_umst22;
                        $user_lead = $us_umsl22;
                    } elseif ($user->server_ip == '144.76.0.239') {
                        $user_target = $us_umst44;
                        $user_lead = $us_umsl44;
                    }
                    $userTargets = Targetcalculation::targetSolution($user, $user_target, $user_lead);
                    $data['attendance'][$userId]['target'] = $userTargets;
                    if(isset($data['attendance'][$userId]['total_leads'])){
                        $data['attendance'][$userId]['total_leads'] += $user->leads;
                    }else{
                        $data['attendance'][$userId]['total_leads'] = $user->leads;
                    }
                }
            }
            return view('user.admin.attendance.sales2', $data);
        } else {
            return redirect(env('APP_URL') . 'adper');
        }
    }
    
    public function user_letter(Request $request){
        if (!empty(Session::get('user'))) {
            $user_id = Session::get('user');
            $user = $this->user($user_id);
            $data['ext'] = $ext = $request->post();
            if($request->has('increment')){
                $data['sal'] = $sal = $ext['salary'] * 12;
                $no = floor($sal);
                $point = round($sal - $no, 2) * 100;
                $hundred = null;
                $digits_1 = strlen($no);
                $i = 0;
                $str = array();
                $words = array(
                    '0' => '', '1' => 'one', '2' => 'two',
                    '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
                    '7' => 'seven', '8' => 'eight', '9' => 'nine',
                    '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
                    '13' => 'thirteen', '14' => 'fourteen',
                    '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
                    '18' => 'eighteen', '19' => 'nineteen', '20' => 'twenty',
                    '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
                    '60' => 'sixty', '70' => 'seventy',
                    '80' => 'eighty', '90' => 'ninety'
                );
                $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
                while ($i < $digits_1) {
                    $divider = ($i == 2) ? 10 : 100;
                    $number = floor($no % $divider);
                    $no = floor($no / $divider);
                    $i += ($divider == 10) ? 1 : 2;
                    if ($number) {
                        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                        $str[] = ($number < 21) ? $words[$number] .
                            " " . $digits[$counter] . $plural . " " . $hundred
                            :
                            $words[floor($number / 10) * 10]
                            . " " . $words[$number % 10] . " "
                            . $digits[$counter] . $plural . " " . $hundred;
                    } else $str[] = null;
                }
                $str = array_reverse($str);
                $result = implode('', $str);
                $points = ($point) ?
                    "." . $words[$point / 10] . " " .
                    $words[$point = $point % 10] : '';
                $data['salary_in_word'] = $result . "Rupees  ";
                return view('user.admin.increment', $data);
            }elseif($request->has('experience')){
                return view('user.admin.experience', $data);
            }elseif($request->has('appraisal')){
                return view('user.admin.appraisal', $data);
            }
           
        } else {
            return redirect(env('APP_URL') . 'adper');
        }
    }

}