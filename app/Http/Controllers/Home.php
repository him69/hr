<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Session;
use App\Models\Adminmodel;
use App\Models\User;
use App\Models\Attendance;
use App\Models\QA_attendance;
use App\Models\Leave;
use App\Models\Holiday;
use App\Models\Assets;
use App\Models\Policies;
use App\Models\User_document;
use App\Models\User_assets;
use App\Models\User_target;
use App\Models\Ticket;
use App\Models\Chat_group;
use App\Models\Group_member;
use App\Models\Training;
use App\Models\User_salary;
use App\Models\Wfh;
use Exception;
use DateTime;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Http\helper\Targetcalculation;

class Home extends controller
{
    public function login(Request $request)
    {
        if (!empty(Session::get('user'))) {
            return redirect(env('APP_URL') . 'user');
        } else {
            if (!empty($request->post('_token'))) {
                $ext = $request->post();
                $user = User::where('user_id', $ext['user_id'])->where('password', $ext['password'])->where('status', 1)->get();
                // print_r($user->count());exit;
                if ($user->count() > 0) {
                    $request->session()->put('user', $user[0]->id);
                    $this->login_time($user[0]->id);
                    return redirect(env('APP_URL') . 'user');
                } else {
                    Session::flash('message', 'Your Username or password is incorrect.');
                    Session::flash('alert-class', 'alert-danger');
                    return redirect(env('APP_URL'));
                }
            } else {
                return view('user.login');
            }
        }
    }
    public function index(Request $request)
    {
        if (!empty(Session::get('user'))) {
            $user_id = Session::get('user');
            $user = $this->user($user_id);
            $data['isEmpty'] = empty($user->name) ||
                empty($user->email) ||
                empty($user->mobile) ||
                empty($user->gender) ||
                empty($user->curnt_adrs) ||
                empty($user->prmt_adrs) ||
                empty($user->adhar_no) ||
                empty($user->pan_no) ||
                empty($user->bank_name) ||
                empty($user->bank_account_holder_name) ||
                empty($user->account_no) ||
                empty($user->ifsc_code) ||
                empty($user->dob);
            // dd($data['isEmpty']);
            $data['ass_exist'] = Assets::select('user_assets.assets_id',)->join('user_assets', 'user_assets.assets_id', 'assets.id')->where('user_assets.uid', $user_id)->where('user_assets.status', '=', 'assign')->where('user_assets.verify', 2)->exists();
            $data['policy_exist'] = Policies::where('status', '1')->whereIn('user_type', [0, $user->user_type])->whereRaw('FIND_IN_SET(?, uids) = 0', [$user_id])->orWhere('uids', NULL)->exists();
            $data['ass'] = Assets::select('assets.*', 'user_assets.uid', 'user_assets.id')->join('user_assets', 'user_assets.assets_id', 'assets.id')->where('user_assets.uid', $user_id)->where('user_assets.status', '=', 'assign')->where('user_assets.verify', 2)->get();
            $data['traning_exist'] = Training::where('uid', $user->id)->exists();
            if (!$data['isEmpty'] || !$data['policy_exist'] || !$data['ass_exist'] || $data['traning_exist']) {
                if (!session()->has('setuppp901111')) {
                    session()->put('setuppp901111', 'Your account is successfully set up');
                    $data['setupMessage'] = session('setup');
                }
            }

            if (
                empty($user->name) or empty($user->email) or empty($user->mobile)
                // or empty($user->adhar_no) or empty($user->pan_no)
            ) {
                return redirect(env('APP_URL') . 'profile/edit');
            } else {
                $data['user'] = $user;
                $data['total_users'] = User::all()->count();
                $date = date('Y-m-d');
                $data['leave_application'] = $check = Leave::where('user_id', $user_id)->where('approved', 0)->count();
                if (isset($request->date)) {
                    $ddate = $request->date;
                    $data['year'] = $year = date('Y', strtotime($ddate));
                    $data['month'] = $month = date('m', strtotime($ddate));
                    $data['date'] = date('Y-m', strtotime($ddate));
                } else {
                    $ddate = date('Y-m-d');
                    $data['year'] = $year = date('Y');
                    $data['month'] = $month = date('m');
                    $data['date'] = date('Y-m');
                }
                $cus = Attendance::where('user_id', $user_id)->whereBetween('mark_date', [date($data['date'] . '-') . '01', date($data['date'] . '-') . '31']);
                // $data['total_leads'] = 50;
                $data['total_leads'] = $cus->sum('leads');
                $data['total_sales'] = $cus->sum('sale_made');
                $data['total_incentive'] = $cus->sum('incentive');
                $total_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
                $users = Attendance::where('attendance.user_id', $user_id)->whereBetween('mark_date', ["$year-$month-01", "$year-$month-$total_days"])->orderBy('mark_date', 'asc')->join('user', 'attendance.user_id', 'user.id')->get();
                if ($users->count() > 0) {
                    foreach ($users as $user) {
                        $markdateday = explode('-', $user->mark_date);
                        $data['attendance'][$user->user_id][end($markdateday)] = $user->sale_made;
                        $data['attendance'][$user->user_id]['id'] = $user->id;
                        if (!empty($data['attendance'][$user->user_id]['sale_done'])) {
                            $data['attendance'][$user->user_id]['sale_done'] += $user->sale_made;
                        } else {
                            $data['attendance'][$user->user_id]['sale_done'] = $user->sale_made;
                        }
                    }
                } else {
                    $data['attendance'] = [];
                }
                $holi = Holiday::whereBetween('hdate', [$year . '-' . $month . '-01', $year . '-' . $month . '-31'])->count();
                $data['total_working'] = cal_days_in_month(CAL_GREGORIAN, $month, $year);
                $td['P'] = 0;
                $td['H'] = 0;
                $td['PL'] = 0;
                $td['HPL'] = 0;
                $td['UPL'] = 0;
                foreach (Attendance::select('mark')->selectRaw('COUNT(*) AS count')->where('attendance.user_id', $user_id)->whereBetween('mark_date', ["$year-$month-01", "$year-$month-$total_days"])->groupBy('mark')->get() as $aa) {
                    $td[$aa->mark] = $aa->count;
                }
                $data['total_salary'] = round(($data['user']->salary / $data['total_working']) * (($td['P']  + ($td['H'] / 2) + ($td['HPL'] / 2) + ($td['PL'])) + $this->dayCount('Sunday', $month, $year) + $holi));
                $today = date('Y-m-d', strtotime($data['date'] . '-1'));



                $ult = User_target::where('target_type', 1)->where('server_type', $user->server_ip)->whereDate('from', '<=', $today)->whereDate('to', '>=', $today);
                $data['ulta'] = $ulta = $ult->count() ? $ult->first()->target : 0;

                // user minimum sales target
                $umst = User_target::where('target_type', 0)->where('server_type', $user->server_ip)->whereDate('from', '<=', $today)->whereDate('to', '>=', $today);
                $data['us_umst'] = $us_umst = $umst->count() ? $umst->first()->target : 0;

                // user monthly sales target
                $umt = User_target::where('target_type', 2)->where('server_type', $user->server_ip)->whereDate('from', '<=', $today)->whereDate('to', '>=', $today);
                $data['us_umt'] = $us_umt = $umt->count() ? $umt->first()->target : 0;
                $bp = ($user->server_ip == '144.76.0.239') ? 5000 : 3000;
                $data['basePay'] = $basePay = $umt->count() ? $umt->first()->bonus : $bp;
                $today = now();
                $data['user_targer'] = $us_umst;
                $data['request'] = $request;
                $data['chat_group'] = Group_member::where('member_id', $user_id)->join('chat_group', 'chat_group.id', 'group_member.group_id')->get();
                $data['chat_admin'] = Adminmodel::select('admin.id AS uid', 'admin.name')->get();
                $data['chat_group_list'] = User::select('user.user_id', 'user.id AS uid', 'user.name', 'user.photo', 'user.user_type')->where('status', 1)->get();

                $data['birthdays'] = User::select('name', 'user_id', 'dob')->where('status', 1)->where(function ($query) use ($today) {
                    $query->whereMonth('dob', '>', $today->month)->orWhere(function ($subQuery) use ($today) {
                        $subQuery->whereMonth('dob', $today->month)->whereDay('dob', '>=', $today->day);
                    });
                })->orderByRaw('MONTH(dob) ASC, DAY(dob) ASC')->limit(5)->get();

                $data['policies'] = Policies::select('policies.*')->where('status', '1')->whereIn('user_type', [0, $user->user_type])->whereBetween('created_at', [Carbon::now()->subMonth(), Carbon::now()])
                    ->get();

                $data['pop_policies'] = Policies::where('status', '1')->whereRaw('FIND_IN_SET(?, uids) = 0', [$user_id])->orWhere('uids', NULL)->get();



                // $data['usersAnniversary'] = User::select('name', 'user_id', 'joining_date')
                //     ->where('status', 1)
                //     ->whereMonth('joining_date', '=', $today->month)
                //     ->whereDay('joining_date', '<=', $today->day)
                //     ->where('joining_date', '<=', $today->toDateString())
                //     ->get()
                //     ->filter(function ($user) use ($today) {
                //         $years = $today->diffInYears(Carbon::parse($user->joining_date));
                //         $user->years = $years;
                //         return $years >= 1;
                //     })
                //     ->sortBy('joining_date')
                //     ->take(5);
                $data['document'] = User_document::select('User_document.*')->where('uid', $user->id)->where('doc_verify', 2)->get();
                return view('user.index', $data);
            }
        } else {
            return redirect(env('APP_URL'));
        }
    }
    public function training(Request $request)
    {
        $user_id = Session::get('user');
        $user = $this->user($user_id);
        if ($request->isMethod('POST')) {
            $ext = $request->post();
            unset($ext['_token']);
            Training::create([
                'uid' => $ext['uid'],
                'name' => $ext['name'],
            ]);
            return redirect(env('APP_URL'));
        }
    }

    public function ticket(Request $request)
    {
        if (!empty(Session::get('user'))) {
            $user_id = Session::get('user');
            $data['user'] = $this->user($user_id);
            if ($request->post('_token')) {
                $ext = $request->post();
                // dd($ext);
                unset($ext['_token']);
                $ext['uid'] = $user_id;
                $ext['response'] = 'none';
                Ticket::create($ext);
                return redirect(env('APP_URL') . 'ticket');
            } else {
                $data['ass'] = Assets::select('assets.*', 'user_assets.from')->join('user_assets', 'user_assets.assets_id', 'assets.id')->where('user_assets.uid', $user_id)->where('user_assets.status', '=', 'assign')->get();
                return view('user.ticket', $data);
            }
        } else {
            return redirect(env('APP_URL'));
        }
    }
    public function asset_verify(Request $request)
    {
        if (!empty(Session::get('user'))) {
            $user_id = Session::get('user');
            $data['user'] = $this->user($user_id);
            if ($request->isMethod('POST')) {
                $ext = $request->post();
                unset($ext['_token']);
                // dd($ext);
                User_assets::where('id', $ext['id'])->update(['verify' => $ext['verify']]);
                return redirect(env('APP_URL'));
            }
        }
    }
    public function uprofile(Request $request)
    {
        if (!empty(Session::get('user'))) {
            $user_id = Session::get('user');
            $user = $this->user($user_id);
            $data['user'] = $user;
            $data['ass'] = Assets::select('assets.*', 'user_assets.from')->join('user_assets', 'user_assets.assets_id', 'assets.id')->where('user_assets.uid', $user_id)->where('user_assets.status', '=', 'assign')->where('user_assets.verify', 0)->get();
            $data['document'] = User_document::select('User_document.*')->where('uid', $user->id)->get();
            return view('user.uprofile', $data);
        } else {
            return redirect(env('APP_URL'));
        }
    }
    public function document(Request $request)
    {
        $user_id = Session::get('user');
        $user = $this->user($user_id);
        $data['user'] = $user;
        if ($request->isMethod('POST')) {
            $ext = $request->post();
            $data['document_image'] = [];

            if ($request->has('aadhaar')) {
                $files = $request->file('document_image');
                foreach ($files as $file) {
                    $path = $file->store('imgs/' . $user->user_id);
                    $data['document_image'][] = $path;
                }
                $file_paths_string = implode(',', $data['document_image']); 
            } elseif ($request->has('pancard') || $request->has('lastcom')) {
                $files = $request->file('document_image');
                if ($files) {
                    $path = $files->store('imgs/' . $user->user_id);
                    $file_paths_string = $path;  
                }
            } elseif ($request->has('studydoc')) {
                $fileOne = $request->file('document_image_one');
                $documentNameOne = $request->input('document_name_one');
                $fileTwo = $request->file('document_image_two');
                $documentNameTwo = $request->input('document_name_two');
                // if($documentNameOne == $documentNameTwo){
                //     return back()->with('error',  ' both documents can not be same.');
                // }
                if ($fileOne) {
                    $existingDocument = User_document::where('uid', $user->id)
                        ->where('document_name', $documentNameOne)
                        ->first();
                    if ($existingDocument) {
                        if ($existingDocument->doc_verify != 2) {
                            return back()->with('error', $documentNameOne . ' already uploaded.');
                        }
                        User_document::where('uid', $user->id)->where('document_name', $documentNameOne)->update([
                            'document_image' => $file_paths_string ?? '',
                            'doc_verify' => 0,
                        ]);
                        return back()->with('success', $documentNameOne . ' Updated Successfully.');
                        //  dd($existingDocument->toArray());
                    } else {
                        $pathOne = $fileOne->store('imgs/' . $user->user_id);
                        User_document::create([
                            'uid' => $ext['uid'],
                            'document_name' => $documentNameOne,
                            'document_image' => $pathOne,
                            'doc_date' => now()->format('Y-m-d'),
                            'doc_verify' => 0,
                        ]);
                    }
                }

                
                if ($fileTwo) {
                    $existingDocument = User_document::where('uid', $user->id)
                        ->where('document_name', $documentNameTwo)
                        ->first();
                    if ($existingDocument) {
                        if ($existingDocument->doc_verify != 2) {
                            return back()->with('error', $documentNameTwo . ' already uploaded.');
                        }
                        User_document::where('uid', $user->id)->where('document_name', $documentNameTwo)->update([
                            'document_image' => $file_paths_string ?? '',
                            'doc_verify' => 0,
                        ]);
                        return back()->with('success', $documentNameTwo . ' Updated Successfully.');
                        //  dd($existingDocument->toArray());
                    } else {
                        $pathTwo = $fileTwo->store('imgs/' . $user->user_id);
                        User_document::create([
                            'uid' => $ext['uid'],
                            'document_name' => $documentNameTwo,
                            'document_image' => $pathTwo,
                            'doc_date' => now()->format('Y-m-d'),
                            'doc_verify' => 0,
                        ]);
                    }
                }
               

                return back()->with('success', 'Study Documents Uploaded Succefully');
            }
            if ($request->has('aadhaar') || $request->has('pancard') || $request->has('lastcom')) {
                $documentType = '';

                if ($request->has('aadhaar')) {
                    $documentType = 'Aadhaar Card';
                } elseif ($request->has('pancard')) {
                    $documentType = 'PAN Card';
                } elseif ($request->has('lastcom')) {
                    $documentType = $ext['document_name'];
                }
                $existingDocument = User_document::where('uid', $user->id)
                    ->where('document_name', $documentType)
                    ->first();
                //    dd($documentType);
                if ($existingDocument) {
                    if ($existingDocument->doc_verify != 2) {
                        return back()->with('error', $documentType . ' already uploaded.');
                    }
                    User_document::where('uid', $user->id)->where('document_name', $documentType)->update([
                        'document_image' => $file_paths_string ?? '',
                        'doc_verify' => 0,
                    ]);
                    return back()->with('success', $documentType . ' Updated Successfully.');
                    //  dd($existingDocument->toArray());
                } else {
                    User_document::create([
                        'uid' => $ext['uid'],
                        'document_name' => $documentType,
                        'document_value' => $ext['document_value'] ?? '',
                        'document_image' => $file_paths_string ?? '',
                        'doc_date' => now()->format('Y-m-d'),
                        'doc_verify' => 0,
                    ]);
                    return back()->with('success', $documentType . ' Uploaded Successfully');
                }
            } else {
                return back()->with('error', 'No document was uploaded.');
            }
        } else {
            $data['document'] = User_document::select('User_document.*')->where('uid', $user->id)->get();
            // $data['documents'] = User_document::select('User_document.*')->where('uid', $user->id)
            // ->where('doc_verify', [0, 1])
            // ->where('document_name', 'Aadhaar Card')
            // ->first();
            // $data['documents'] = User_document::select('User_document.*')->where('uid', $user->id)
            // ->where('doc_verify', [0, 1])
            // ->where('document_name', 'Pan Card')
            // ->first();
            // $data['documents'] = User_document::select('User_document.*')->where('uid', $user->id)
            // ->where('doc_verify', [0, 1])
            // ->where('document_name', ['Experianse & releving','Salary slip'])
            // ->first();
            // $data['documents'] = User_document::select('User_document.*')->where('uid', $user->id)
            // ->where('doc_verify', [0, 1])
            // ->where('document_name', 'Aadhaar Card')
            // ->first();
            return view('user.document', $data);
        }
    }
    public function pass_change(Request $request)
    {
        if (!empty(Session::get('user'))) {
            $user_id = Session::get('user');
            $data['user'] = $this->user($user_id);
            // dd($request->post());
            if ($request->isMethod('POST')) {
                $oldpass = $data['user']->password;
                $newpass = $request->Npassword;
                $givenpass = $request->password;
                if ($oldpass == $givenpass) {
                    if ($givenpass == $newpass) {
                        return back()->with('error', 'old pass and new pass can not be same');
                    }
                    User::where('id', $user_id)->update(['password' => $newpass]);
                    Session::flush();
                    Session::flash('message', 'Password changed successfully');
                    Session::flash('alert-class', 'alert-success');
                    return redirect(env('APP_URL'));
                } else {
                    return back()->with('error', 'Your given password is wrong');
                }
            }
        } else {
            // dd(44);
            return redirect(env('APP_URL'));
        }
    }

    public function holiday(Request $request)
    {
        if (!empty(Session::get('user'))) {
            $user_id = Session::get('user');
            $user = $this->user($user_id);
            $data['user'] = $user;
            $data['holi'] = Holiday::all();
            $year = date('Y');
            $month = date('m');
            $total_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            $holi = Holiday::whereBetween('hdate', [$year . '-' . $month . '-01', $year . '-' . $month . '-31']);
            $holitotal = $holi->count();
            //   $data['holi'] = $holi->get();
            $data['total_working'] = cal_days_in_month(CAL_GREGORIAN, $month, $year) - $this->dayCount('Sunday', $month, $year) - $holitotal;
            $data['total_holiday'] = $this->dayCount('Sunday', $month, $year) + $holitotal;
            return view('user.holiday', $data);
        } else {
            return redirect(env('APP_URL') . 'user');
        }
    }
    public function attendance(Request $request)
    {
        if (!empty(Session::get('user'))) {
            $user_id = Session::get('user');
            $user = $this->user($user_id);
            $data['date'] = date('Y-m');
            if (!empty($request->_token)) {
                $e = explode('-', $request->post('month'));
                $data['year'] = $year = $e[0];
                $data['month'] = $month = $e[1];
                $data['date'] = $request->post('month');
            } else {
                $data['year'] = $year = date('Y');
                $data['month'] = $month = date('m');
            }
            $data['user'] = $user;
            $total_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            $Total_P = [];
            $Total_H = [];
            $Total_A = [];
            if ($user->user_type == 1) {
                $users = Attendance::whereBetween('mark_date', ["$year-$month-01", "$year-$month-$total_days"])->orderBy('mark_date', 'asc')->join('user', 'attendance.user_id', 'user.id')->where('attendance.user_id', $user->id)->get();
                foreach ($users as $user) {
                    $data['attendance'][$user->user_id][str_replace("$year-$month-", "", $user->mark_date)]['mark'] = $user->mark;
                    $data['attendance'][$user->user_id][str_replace("$year-$month-", "", $user->mark_date)]['login_time'] = $user->login_time;
                    $data['attendance'][$user->user_id][str_replace("$year-$month-", "", $user->mark_date)]['logout_time'] = $user->logout_time;
                    $data['attendance'][$user->user_id][str_replace("$year-$month-", "", $user->mark_date)]['nonpause'] = $user->nonpause;
                    $data['attendance'][$user->user_id][str_replace("$year-$month-", "", $user->mark_date)]['sale_made'] = $user->sale_made;
                    $data['attendance'][$user->user_id][str_replace("$year-$month-", "", $user->mark_date)]['customer'] = $user->customer;
                    $data['attendance'][$user->user_id][str_replace("$year-$month-", "", $user->mark_date)]['verify'] = $user->verify;
                    if (!empty($data['attendance'][$user->user_id]['Total_P'])) {
                        if ($user->mark == "P") {
                            $data['attendance'][$user->user_id]['Total_P'] += 1;
                        }
                    } else {
                        if ($user->mark == "P") {

                            $data['attendance'][$user->user_id]['Total_P'] = 1;
                        } else {
                            $data['attendance'][$user->user_id]['Total_P'] = 0;
                        }
                    }
                    if (!empty($data['attendance'][$user->user_id]['Total_H'])) {
                        if ($user->mark == "H") {
                            $data['attendance'][$user->user_id]['Total_H'] += 1;
                        }
                    } else {
                        if ($user->mark == "H") {
                            $data['attendance'][$user->user_id]['Total_H'] = 1;
                        } else {
                            $data['attendance'][$user->user_id]['Total_H'] = 0;
                        }
                    }
                    if (!empty($data['attendance'][$user->user_id]['Total_A'])) {
                        if ($user->mark == "A") {
                            $data['attendance'][$user->user_id]['Total_A'] += 1;
                        }
                    } else {
                        if ($user->mark == "A") {
                            $data['attendance'][$user->user_id]['Total_A'] = 1;
                        } else {
                            $data['attendance'][$user->user_id]['Total_A'] = 0;
                        }
                    }
                }
            } elseif ($user->user_type == 2) {
                $users = Attendance::whereBetween('mark_date', ["$year-$month-01", "$year-$month-$total_days"])->orderBy('mark_date', 'asc')->join('user', 'attendance.user_id', 'user.id')->where('attendance.user_id', $user->id)->get();
                foreach ($users as $user) {
                    $data['attendance'][$user->user_id][str_replace("$year-$month-", "", $user->mark_date)]['mark'] = $user->mark;
                    $data['attendance'][$user->user_id][str_replace("$year-$month-", "", $user->mark_date)]['login_time'] = $user->login_time;
                    $data['attendance'][$user->user_id][str_replace("$year-$month-", "", $user->mark_date)]['logout_time'] = $user->logout_time;
                    $data['attendance'][$user->user_id][str_replace("$year-$month-", "", $user->mark_date)]['recording'] = $user->recording;
                    if (!empty($data['attendance'][$user->user_id]['Total_P'])) {
                        if ($user->mark == "P") {
                            $data['attendance'][$user->user_id]['Total_P'] += 1;
                        }
                    } else {
                        if ($user->mark == "P") {

                            $data['attendance'][$user->user_id]['Total_P'] = 1;
                        } else {
                            $data['attendance'][$user->user_id]['Total_P'] = 0;
                        }
                    }
                    if (!empty($data['attendance'][$user->user_id]['Total_H'])) {
                        if ($user->mark == "H") {
                            $data['attendance'][$user->user_id]['Total_H'] += 1;
                        }
                    } else {
                        if ($user->mark == "H") {
                            $data['attendance'][$user->user_id]['Total_H'] = 1;
                        } else {
                            $data['attendance'][$user->user_id]['Total_H'] = 0;
                        }
                    }
                    if (!empty($data['attendance'][$user->user_id]['Total_A'])) {
                        if ($user->mark == "A") {
                            $data['attendance'][$user->user_id]['Total_A'] += 1;
                        }
                    } else {
                        if ($user->mark == "A") {
                            $data['attendance'][$user->user_id]['Total_A'] = 1;
                        } else {
                            $data['attendance'][$user->user_id]['Total_A'] = 0;
                        }
                    }
                }
            } elseif ($user->user_type == 3) {
                $users = Attendance::whereBetween('mark_date', ["$year-$month-01", "$year-$month-$total_days"])->orderBy('mark_date', 'asc')->join('user', 'attendance.user_id', 'user.id')->where('attendance.user_id', $user->id)->get();
                foreach ($users as $user) {
                    $data['attendance'][$user->user_id][str_replace("$year-$month-", "", $user->mark_date)]['mark'] = $user->mark;
                    $data['attendance'][$user->user_id][str_replace("$year-$month-", "", $user->mark_date)]['login_time'] = $user->login_time;
                    $data['attendance'][$user->user_id][str_replace("$year-$month-", "", $user->mark_date)]['logout_time'] = $user->logout_time;
                    $data['attendance'][$user->user_id][str_replace("$year-$month-", "", $user->mark_date)]['new_candidate'] = $user->new_candidate;
                    $data['attendance'][$user->user_id][str_replace("$year-$month-", "", $user->mark_date)]['old_candidate'] = $user->old_candidate;
                    if (!empty($data['attendance'][$user->user_id]['Total_P'])) {
                        if ($user->mark == "P") {
                            $data['attendance'][$user->user_id]['Total_P'] += 1;
                        }
                    } else {
                        if ($user->mark == "P") {
                            $data['attendance'][$user->user_id]['Total_P'] = 1;
                        } else {
                            $data['attendance'][$user->user_id]['Total_P'] = 0;
                        }
                    }
                    if (!empty($data['attendance'][$user->user_id]['Total_H'])) {
                        if ($user->mark == "H") {
                            $data['attendance'][$user->user_id]['Total_H'] += 1;
                        }
                    } else {
                        if ($user->mark == "H") {
                            $data['attendance'][$user->user_id]['Total_H'] = 1;
                        } else {
                            $data['attendance'][$user->user_id]['Total_H'] = 0;
                        }
                    }
                    if (!empty($data['attendance'][$user->user_id]['Total_A'])) {
                        if ($user->mark == "A") {
                            $data['attendance'][$user->user_id]['Total_A'] += 1;
                        }
                    } else {
                        if ($user->mark == "A") {
                            $data['attendance'][$user->user_id]['Total_A'] = 1;
                        } else {
                            $data['attendance'][$user->user_id]['Total_A'] = 0;
                        }
                    }
                }
            } elseif ($user->user_type == 4) {
                $users = Attendance::whereBetween('mark_date', ["$year-$month-01", "$year-$month-$total_days"])->orderBy('mark_date', 'asc')->join('user', 'attendance.user_id', 'user.id')->where('attendance.user_id', $user->id)->get();
                foreach ($users as $user) {
                    $data['attendance'][$user->user_id][str_replace("$year-$month-", "", $user->mark_date)]['mark'] = $user->mark;
                    $data['attendance'][$user->user_id][str_replace("$year-$month-", "", $user->mark_date)]['login_time'] = $user->login_time;
                    $data['attendance'][$user->user_id][str_replace("$year-$month-", "", $user->mark_date)]['logout_time'] = $user->logout_time;
                    $data['attendance'][$user->user_id][str_replace("$year-$month-", "", $user->mark_date)]['new_candidate'] = $user->new_candidate;
                    $data['attendance'][$user->user_id][str_replace("$year-$month-", "", $user->mark_date)]['old_candidate'] = $user->old_candidate;
                    if (!empty($data['attendance'][$user->user_id]['Total_P'])) {
                        if ($user->mark == "P") {
                            $data['attendance'][$user->user_id]['Total_P'] += 1;
                        }
                    } else {
                        if ($user->mark == "P") {
                            $data['attendance'][$user->user_id]['Total_P'] = 1;
                        } else {
                            $data['attendance'][$user->user_id]['Total_P'] = 0;
                        }
                    }
                    if (!empty($data['attendance'][$user->user_id]['Total_H'])) {
                        if ($user->mark == "H") {
                            $data['attendance'][$user->user_id]['Total_H'] += 1;
                        }
                    } else {
                        if ($user->mark == "H") {
                            $data['attendance'][$user->user_id]['Total_H'] = 1;
                        } else {
                            $data['attendance'][$user->user_id]['Total_H'] = 0;
                        }
                    }
                    if (!empty($data['attendance'][$user->user_id]['Total_A'])) {
                        if ($user->mark == "A") {
                            $data['attendance'][$user->user_id]['Total_A'] += 1;
                        }
                    } else {
                        if ($user->mark == "A") {
                            $data['attendance'][$user->user_id]['Total_A'] = 1;
                        } else {
                            $data['attendance'][$user->user_id]['Total_A'] = 0;
                        }
                    }
                }
            }
            $data['user_id'] = $user->user_id;
            return view('user.attendance', $data);
        } else {
            return redirect(env('APP_URL'));
        }
    }
    public function team_attendance(Request $request)
    {
        if (!empty(Session::get('user'))) {
            $user_id = Session::get('user');
            $user = $this->user($user_id);
            $data['user'] = $user;
            if (!empty($request->_token)) {
                $e = explode('-', $request->post('month'));
                $data['year'] = $year = $e[0];
                $data['month'] = $month = $e[1];
                $data['date'] = $request->post('month');
            } else {
                $data['year'] = $year = date('Y');
                $data['month'] = $month = date('m');
                $data['date'] = date('Y-m');
            }
            $total_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            $firstDay = $data['date'] . '-01';
            $lastDay = date('Y-m-t', strtotime($firstDay));
            $users = Attendance::whereBetween('mark_date', ["$year-$month-01", "$year-$month-$total_days"])->orderBy('mark_date', 'asc')->join('user', 'attendance.user_id', 'user.id')->where('user.status', '1')->where('user.user_type', '1')->join('user_lead_by', 'user_lead_by.uid', '=', 'user.id')->where('user_lead_by.leader_id', $user_id)->where('user_lead_by.status', 1)->get();
            if ($users->count() == 0) {
                $data['attendance'] = [];
                return view('user.team_att', $data);
            }
            $today = date('Y-m-d', strtotime($data['date'] . '-1'));
            $todate = date('Y-m-d');
            // dd($todate); 
            $min_targ44 = User_target::where('target_type', 0)->where('server_type', '144.76.0.239')
                ->whereDate('from', '<=', $today)
                ->whereDate('to', '>=', $today)
                ->get();
            $min_targ22 = User_target::where('target_type', 0)->where('server_type', '122.186.6.91')
                ->whereDate('from', '<=', $today)
                ->whereDate('to', '>=', $today)
                ->get();

            $min_lead44 = User_target::where('target_type', 1)->where('server_type', '144.76.0.239')
                ->whereDate('from', '<=', $today)
                ->whereDate('to', '>=', $today)
                ->get();
            $min_lead22 = User_target::where('target_type', 1)->where('server_type', '122.186.6.91')
                ->whereDate('from', '<=', $today)
                ->whereDate('to', '>=', $today)
                ->get();
            $data['us_umst'] = $us_umst44 = $min_targ44->count() ? $min_targ44->first()->target : 0;
            $data['us_umst'] = $us_umst22 = $min_targ22->count() ? $min_targ44->first()->target : 0;
            $data['us_umsl'] = $us_umsl44 = $min_lead44->count() ? $min_lead22->first()->target : 0;
            $data['us_umsl'] = $us_umsl22 = $min_lead22->count() ? $min_lead22->first()->target : 0;
            $holi = Holiday::whereBetween('hdate', [$year . '-' . $month . '-01', $year . '-' . $month . '-31'])->count();
            $data['total_working'] = cal_days_in_month(CAL_GREGORIAN, $month, $year) - $this->dayCount('Sunday', $month, $year) - $holi;
            foreach ($users as $user) {
                $userId = $user->user_id;
                $markdateday = explode('-', $user->mark_date);
                $markornot = end($markdateday);
                $isCurrentDay = $user->mark_date == $todate;
                if ($user->server_ip == '122.186.6.91') {
                    $user_target = $us_umst22;
                    $user_lead = $us_umsl22;
                } elseif ($user->server_ip == '144.76.0.239') {

                    $user_target = $us_umst44;
                    $user_lead = $us_umsl44;
                }
                $userTargets = Targetcalculation::targetSolution($user, $user_target, $user_lead);

                // Check for holidays first
                $holidayCheck = Holiday::whereBetween('hdate', [$firstDay, $lastDay])
                    ->where('user_type', '=', '1')
                    ->get();
                if ($isCurrentDay && is_null($user->mark)) {
                    $data['attendance'][$userId][$markornot] = "LI";
                } else {

                    $isHoliday = false;
                    if ($holidayCheck->isNotEmpty()) {
                        foreach ($holidayCheck as $mark_holi) {
                            $day = date('j', strtotime($mark_holi->hdate));
                            if ($day == $markornot) {
                                $isHoliday = true;
                            }
                            $data['attendance'][$userId][$day] = "NH";
                        }
                    }
                    if (!$isHoliday) {
                        $data['attendance'][$userId][$markornot] = $user->mark;
                    }
                }
                // Handle sales made
                if (!empty($data['attendance'][$user->user_id]['sale_done'])) {
                    $data['attendance'][$user->user_id]['sale_done'] += $user->sale_made;
                } else {
                    $data['attendance'][$user->user_id]['sale_done'] = $user->sale_made;
                }
                $data['attendance'][$userId]['id'] = $user->id;

                $data['attendance'][$userId]['target'] = $userTargets;
            }
            // dd($data['attendance']);

            return view('user.team_att', $data);
        } else {
            return redirect(env('APP_URL'));
        }
    }
    public function attendance_mark(Request $request)
    {
        if (!empty(Session::get('user'))) {
            $user_id = Session::get('user');
            $user = $this->user($user_id);
            if (!empty($request->_token)) {
                $ext = $request->post();
                $date = date('Y-m-d');

                $requiredDetail = [
                    'name', 'email', 'mobile', 'gender', 'curnt_adrs', 'prmt_adrs',
                    'aadhar_card', 'aadhar_card_back', 'pan_card', 'adhar_no', 'pan_no',
                    'bank_name', 'bank_account_holder_name', 'account_no', 'ifsc_code', 'dob',
                ];
                foreach ($requiredDetail as $rd) {

                    if (empty($user->$rd)) {
                        // Redirect to the profile edit page with an error message
                        return redirect('profile/edit')->with('error', 'Please complete all required fields in your profile.');
                    } else {
                        if ($user->user_type == 1) {
                            $verify = 0;
                            $check = Attendance::where('user_id', $user_id)->where('mark_date', $date);
                            if ($check->count() == 1) {
                                $response = '0';
                                if ($user->server_ip == '144.76.0.239') {
                                    $curl = curl_init();
                                    curl_setopt_array($curl, array(
                                        CURLOPT_URL => 'http://176.9.17.110/vicidial/zznonpauseapi.php?DB=&query_date=' . $date . '&query_time=00%3A00%3A00&end_date=' . $date . '&end_time=23%3A59%3A59&group%5B%5D=--ALL--&user_group%5B%5D=--ALL--&users%5B%5D=' . $user->user_id . '&report_display_type=TEXT&shift=--&SUBMIT=SUBMIT',
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
                                } else {
                                    $curl = curl_init();
                                    curl_setopt_array($curl, array(
                                        CURLOPT_URL => 'http://122.186.6.91/vicidial/zznonpauseapi.php?DB=&query_date=' . $date . '&query_time=00%3A00%3A00&end_date=' . $date . '&end_time=23%3A59%3A59&group%5B%5D=--ALL--&group%5B%5D=2001&group%5B%5D=3000&user_group%5B%5D=--ALL--&users%5B%5D=' . $user->user_id . '&report_display_type=TEXT&shift=--&SUBMIT=SUBMIT',
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
                                }
                                $crm = $this->getfromcrm($date, $user->crm_emp_id);
                                if (empty($crm['sale_made'])) {
                                    $sale_made = 0;
                                } else {
                                    $sale_made = $crm['sale_made'];
                                }
                                if (empty($crm['customer'])) {
                                    $customer = 0;
                                } else {
                                    $customer = $crm['customer'];
                                }
                                if (empty($crm['leads'])) {
                                    $leads = 0;
                                } else {
                                    $leads = $crm['leads'];
                                }
                                if (empty($crm['EAU'])) {
                                    $eau = 0;
                                } else {
                                    $eau = $crm['EAU'];
                                }
                                $sale_made += $eau;

                                $timestamp = strtotime('' . $date . '');
                                $day = date('D', $timestamp);
                                if ($day == "Sat") {
                                    if (strtotime("3:00:00") < strtotime($response)) {
                                        $mark = "P";
                                    } elseif (strtotime("0:30:00") < strtotime($response)) {
                                        $mark = "H";
                                    } else {
                                        $mark = "A";
                                    }
                                } else {
                                    if (strtotime("5:00:00") < strtotime($response)) {
                                        $mark = "P";
                                    } elseif (strtotime("2:00:00") < strtotime($response)) {
                                        $mark = "H";
                                    } else {
                                        $mark = "A";
                                    }
                                }
                                if (($sale_made >= 2) and strtotime("1:00:00") < strtotime($response)) {
                                    $mark = "P";
                                } elseif ($user->late_count > 1) {
                                    $mark = "H";
                                    User::where('id', $user_id)->update(['late_count' => 0]);
                                }
                                $i = 1;
                                $inc = 0;
                                $tc = $customer;
                                while ($i <= $tc) {
                                    $i++;
                                    $camt = $i * 100;
                                    $inc += $camt;
                                }
                                $tcaa = $sale_made - $customer;
                                $inc += ($eau * 200) + ($tcaa * 100);
                                if ((empty($check->get()[0]->login_time) or empty($ext['logout_time']) or empty($response))) {
                                    $verify = 0;
                                } else {
                                    $verify = 1;
                                }
                                $check->update(['mark' => $mark, 'nonpause' => $response, 'logout_time' => $ext['logout_time'], 'sale_made' => $sale_made, 'customer' => $customer, 'incentive' => $inc, 'verify' => $verify, 'leads' => $leads]);
                                // dd($check);
                                return redirect(env('APP_URL'));
                            } else {
                                return redirect(env('APP_URL'));
                            }
                        } else {
                            if ($user->user_type == 2) {
                                $check = Attendance::where('user_id', $user_id)->where('mark_date', $date);
                                if ($check->count() == 1) {
                                    $check->update(['mark' => 'P', 'logout_time' => $ext['logout_time'], 'recording' => $ext['recording']]);
                                    return redirect(env('APP_URL'));
                                }
                            } elseif ($user->user_type == 3) {
                                $timezone = 'Asia/Kolkata';
                                $now = Carbon::now();
                                $now->timezone($timezone);
                                $date = $now->format('Y-m-d');
                                $check = Attendance::where('user_id', $user_id)->where('mark_date', $date);
                                if ($check->count() == 1) {
                                    $check->update(['mark' => 'P', 'logout_time' => $ext['logout_time']]);
                                    return redirect(env('APP_URL'));
                                }
                            } elseif ($user->user_type == 4) {
                                $timezone = 'Asia/Kolkata';
                                $now = Carbon::now();
                                $now->timezone($timezone);
                                $date = $now->format('Y-m-d');
                                $check = Attendance::where('user_id', $user_id)->where('mark_date', $date);
                                if ($check->count() == 1) {
                                    $check->update(['mark' => 'P', 'logout_time' => $ext['logout_time']]);
                                    return redirect(env('APP_URL'));
                                }
                            } else {
                                return redirect(env('APP_URL'));
                            }
                        }
                    }
                }
            } else {
                return redirect(env('APP_URL'));
            }
        } else {
            return redirect(env('APP_URL'));
        }
    }
    public function leave()
    {
        if (!empty(Session::get('user'))) {
            $user_id = Session::get('user');
            $data['user'] = $this->user($user_id);
            $data['leaves'] = Leave::where('user_id', $user_id)->get();
            return view('user.leave', $data);
        }
    }
    public function team_leave(Request $request)
    {
        if (!empty(Session::get('user'))) {
            $user_id = Session::get('user');
            $user = $this->user($user_id);
            $data['date'] = date('Y-m');
            if (!empty($request->post('_token'))) {
                $data['date'] = $request->month;
            }
            $data['user'] = $user;
            $userId = $user->id;
            $from = $data['date'] . '-01';
            $to = $data['date'] . '-31';
            // dd($userId);
            $data['leaves'] = Leave::select(
                'user.user_id',
                'leave_application.leave_type',
                'leave_application.leave_from',
                'leave_application.leave_to',
                'leave_application.reason',
                'leave_application.id',
                'leave_application.response',
                'leave_application.approved'
            )
                ->join('user', 'user.id', '=', 'leave_application.user_id')
                ->join('user_lead_by', 'user_lead_by.uid', 'user.id')
                ->where('user_lead_by.leader_id', '=', $userId)
                ->where('user_lead_by.status', '=', 1)
                ->whereBetween('leave_application.leave_from', [$from, $to])
                // ->groupBy('leave_application.id')
                ->get();
            // $data['leave'] = Leave::select('leave_application.id', 'leave_application.user_id', 'leave_application.leave_from', 'leave_application.leave_to', 'leave_application.reason', 'leave_application.approved', 'user.user_id', 'user.user_id AS user_ida')->whereBetween('leave_from', [$from, $to])->join('user', 'leave_application.user_id', 'user.id')->where('user.status', 1)->where('user.lead_by', $user_id)->get();
            return view('user.team_leave', $data);
        } else {
            return redirect(env('APP_URL'));
        }
    }
    public function team_leave_reject($id = '', Request $request)
    {
        if (!empty(Session::get('user'))) {
            $user_id = Session::get('user');
            $user = $this->user($user_id);
            $userName = $user->name;
            if (!empty($id)) {
                $leave = Leave::where('id', $id)->where('approved', 0);
                if ($leave->count() > 0) {
                    $response = $request->input('response', '');
                    $leave->update(['approved' => 2, 'response' => $response, 'approved_by' => $userName]);
                }
                return redirect(env('APP_URL') . 'admin/leave');
            } else {
                return redirect(env('APP_URL') . 'admin/leave');
            }
        } else {
            return redirect(env('APP_URL') . 'admin');
        }
    }
    public function team_leave_approve(Request $request, $id = '')
    {
        if (!empty(Session::get('user'))) {
            $user_id = Session::get('user');
            $user = $this->user($user_id);
            $userName = $user->name;
            // dd($userName);
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
                        $applied_leave = Leave::where('id', $id)->where('leave_from', '<', $today)->where('approved', 0)->exists();
                        if (!$applied_leave) {
                            return redirect()->back()->with('error', 'Leave will be approved on the next day in case of half day');
                        } else {
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
                            }
                        }
                    } else {
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
                    $leave->update(['approved' => 1, 'response' => $response, 'approved_by' => $userName]);
                    //   }
                }
                return redirect(env('APP_URL') . 'team/leave');
            } else {
                return redirect(env('APP_URL') . 'team/leave');
            }
        } else {
            return redirect(env('APP_URL') . 'user');
        }
    }
    public function leave_mark(Request $request)
    {
        if (!empty(Session::get('user'))) {
            $user_id = Session::get('user');
            $user = $this->user($user_id);
            // echo $user;exit;
            if (!empty($request->_token)) {
                $ext = $request->post();
                unset($ext['_token']);
                $ext['user_id'] = $user_id;

                if (empty($ext['leave_to'])) {
                    $ext['leave_to'] = $ext['leave_from'];
                }

                // Calculate the duration of the leave
                $leaveFrom = Carbon::parse($ext['leave_from']);
                $leaveTo = Carbon::parse($ext['leave_to']);
                $leaveDuration = $leaveTo->diffInDays($leaveFrom);
                $leaveExist = Leave::where('user_id', $user_id)->where('leave_from', '<=', $leaveTo)
                    ->where('leave_to', '>=', $leaveFrom)->whereIn('approved', [0, 1])->exists();
                if ($leaveExist) {

                    return redirect()->back()->with('error', 'Leave application alredy exist');
                } else {
                    if ($leaveDuration > 2) {
                        // Leave is more than 2 days, apply at least 1 week in advance

                        dd(44);
                        $oneWeekInAdvance = Carbon::now()->addWeek();

                        if ($leaveFrom >= $oneWeekInAdvance) {
                            // The leave application is made at least 1 week in advance
                            if ($request->hasFile('document')) {
                                $document = $request->file('document');
                                $te = $document->store('imgs');
                                $ext['document'] = $te;
                            }
                            Leave::create($ext);
                            // Leave application is successful
                            return redirect()->back()->with('success', 'Leave application has been submitted successfully.');
                        } else {
                            // Leave application is not made 1 week in advance
                            return redirect()->back()->with('error', 'Leave of more than 2 days must be applied at least 1 week in advance.');
                        }
                    } else {
                        if ($user->user_type == 1 || $user->user_type = 2) {
                            $loginHoursStart = Carbon::createFromTime(5, 0, 0);
                        }
                        if ($user->user_type == 4) {
                            $loginHoursStart =  Carbon::createFromTime(10, 0, 0);
                        }
                        $latest_attendance = Attendance::where('user_id', $user_id)
                            ->orderBy('created_at', 'desc')
                            ->first();
                        $login_time = Carbon::parse($latest_attendance->login_time);

                        if ($login_time->greaterThanOrEqualTo($loginHoursStart)) {

                            if ($request->hasFile('document')) {
                                $document = $request->file('document');
                                $te = $document->store('imgs');
                                $ext['document'] = $te;
                            }
                            Leave::create($ext);
                            return redirect()->back()->with('success', 'Leave application has been submitted successfully.');
                            dd(session()->all());
                        } else {
                            return redirect()->back()->with('error', 'there is some error');
                            // dd(session()->all()); 
                        }
                        // dd(session()->all()); 
                    }
                }
                // dd(session()->all()); 
            }
        }
    }
    public function wfh(Request $request)
    {
        if (!empty(Session::get('user'))) {
            $user_id = Session::get('user');
            $user = $this->user($user_id);
            if (!empty($request->_token)) {
                $ext = $request->post();
                unset($ext['_token']);
                $ext['uid'] = $user_id;
                if (empty($ext['to'])) {
                    $ext['to'] = $ext['from'];
                }
                Wfh::create($ext);
                return redirect(env('APP_URL'));
            } else {
                $data['user'] = $user;
                $data['leaves'] = Wfh::where('uid', $user_id)->get();
                return view('user.wfh', $data);
            }
        }
    }
    public function bonus()
    {
        if (!empty(Session::get('user'))) {
            $user_id = Session::get('user');
            $data['user'] = $this->user($user_id);
            $data['month'] = date('F');
            $data['bonus'] = Leave::where('user_id', $user_id)->get();
            return view('user.bonus', $data);
        }
    }
    public function request_for_leave()
    {
        if (!empty(Session::get('user'))) {
            $user_id = Session::get('user');
            $data['user'] = $this->user($user_id);
            $data['leave_application'] = $check = Leave::where('user_id', $user_id)->where('approved', 0)->count();
            return view('user.request_for_leave', $data);
        } else {
            return redirect(env('APP_URL'));
        }
    }
    public function update_crm_id(Request $request)
    {
        if (!empty(Session::get('user'))) {
            $user_id = Session::get('user');
            $user = $this->user($user_id);
            $crm_emp_id = $this->verify_crm_emp_id($request->crm_emp_id);
            User::where('id', $user->id)->update(['crm_emp_id' => $crm_emp_id['user_id']]);
            return redirect(env('APP_URL') . 'user');
        } else {
            return redirect(env('APP_URL'));
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
    public function reponses(Request $request)
    {
        if (!empty(Session::get('user'))) {
            $user_id = Session::get('user');
            $user = $this->user($user_id);
            $data['user'] = $user;
            $data['ticket'] = Ticket::where('uid', $user_id)->get();
            return view('user.responses', $data);
        } else {
            return redirect(env('APP_URL'));
        }
    }
    public function profile(Request $request)
    {
        if (!empty(Session::get('user'))) {
            $user_id = Session::get('user');
            $user = $this->user($user_id);
            $ext = $request->post();
            if ($ext['_token']) {
                unset($ext['_token']);
                if ($request->hasFile('aadhar_card')) {
                    $aadhar_card = $request->file('aadhar_card');
                    $te = $aadhar_card->store('imgs');
                    $ext['aadhar_card'] = $te;
                }
                if ($request->hasFile('aadhar_card_back')) {
                    $aadhar_card_back = $request->file('aadhar_card_back');
                    $te = $aadhar_card_back->store('imgs');
                    $ext['aadhar_card_back'] = $te;
                }
                if ($request->hasFile('pan_card')) {
                    $pan_card = $request->file('pan_card');
                    $te = $pan_card->store('imgs');
                    $ext['pan_card'] = $te;
                }
                if ($request->hasFile('photo')) {
                    $photo = $request->file('photo');
                    $te = $photo->store('imgs');
                    $ext['photo'] = $te;
                }
                User::where('id', $user_id)->update($ext);
                return redirect(env('APP_URL') . 'profile');
            }
        } else {
            return redirect(env('APP_URL') . 'profile');
        }
    }
    public function editprofile(Request $request)
    {
        if (!empty(Session::get('user'))) {
            $user_id = Session::get('user');
            $user = $this->user($user_id);
            $data['user'] = $user;
            if ($request->_token) {
                $ext = $request->post();
                unset($ext['_token']);
                if ($request->filled('croppedImage')) {
                    $croppedImageData = $request->input('croppedImage');
                    list($type, $croppedImageData) = explode(';', $croppedImageData);
                    list(, $croppedImageData)      = explode(',', $croppedImageData);
                    $croppedImageData = base64_decode($croppedImageData);

                    // Use Intervention Image library (or similar) to save the image file
                    $imageName = 'cropped_photo_' . time() . '.png';
                    $path = 'imgs/' . $imageName;
                    Storage::put($path, $croppedImageData);
                    // Update the path in $ext to store in the database
                    $ext['photo'] = 'imgs/' . $imageName;
                    unset($ext['croppedImage']);
                    // dd($ext);
                } else {
                    unset($ext['photo']);
                    unset($ext['croppedImage']);
                    // dd($ext);
                }
                if ($request->hasFile('aadhar_card')) {
                    $document = $request->file('aadhar_card');
                    $te = $document->store('imgs');
                    $ext['aadhar_card'] = $te;
                } else {
                    unset($ext['aadhar_card']);
                }
                if ($request->hasFile('aadhar_card_back')) {
                    $document = $request->file('aadhar_card_back');
                    $te = $document->store('imgs');
                    $ext['aadhar_card_back'] = $te;
                } else {
                    unset($ext['aadhar_card_back']);
                }
                if ($request->hasFile('pan_card')) {
                    $document = $request->file('pan_card');
                    $te = $document->store('imgs');
                    $ext['pan_card'] = $te;
                } else {
                    unset($ext['pan_card']);
                }
                User::where('id', $user_id)->update($ext);
                return redirect(env('APP_URL') . 'profile/edit');
            } else {
                $data['ass'] = Assets::select('assets.*')->join('user_assets', 'user_assets.assets_id', 'assets.id')->where('user_assets.uid', $user_id)->get();
                return view('user.editprofile', $data);
            }
        } else {
            return redirect(env('APP_URL'));
        }
    }
    public function general_info(Request $request)
    {
        if (!empty(Session::get('user'))) {
            $user_id = Session::get('user');
            $data['user'] = $this->user($user_id);
            $policyA = explode(',', $data['user']->policy_acc);

            $data['policies'] = Policies::where('status', '1')
                ->whereRaw('FIND_IN_SET(?, uids) > 0', [$user_id])
                ->get();
            // dd($data['policies']);
            return view('user.general_info', $data);
        } else {
            return redirect(env('APP_URL'));
        }
    }
    public function payslip(Request $request)
    {
        if (!empty(Session::get('user'))) {
            $user_id = Session::get('user');
            $user = $data['user'] = $this->user($user_id);
            if (!empty($request->month)) {
                $e = explode('-', $request->month);
                $data['year'] = $year = $e[0];
                $data['month'] = $month = $e[1];
                $data['pay']['amonth'] = date_create($request->month);
                $data['pay']['omonth'] = date_format($data['pay']['amonth'], "Y-m");
                $data['pay']['month'] = date_format($data['pay']['amonth'], "F Y");
            } else {
                $data['pay']['omonth'] = date('Y-m');
                $data['pay']['month'] = date('F Y');
                $year = date('Y');
                $month = date('m');
            }
            if ($data['pay']['omonth'] == date('Y-m')) {
                return "This month salary slip is not generated yet";
            }
            $check_date = "$year-$month-01";
            $total_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            $holi = Holiday::whereBetween('hdate', [$year . '-' . $month . '-01', $year . '-' . $month . '-31'])->count();
            $td['P'] = 0;
            $td['H'] = 0;
            $td['PL'] = 0;
            $td['HPL'] = 0;
            $td['UPL'] = 0;
            $holi = Holiday::whereBetween('hdate', [$year . '-' . $month . '-01', $year . '-' . $month . '-31'])->count();
            $data['total_working'] = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            $data['hsun'] = $this->dayCount('Sunday', $month, $year) + $holi;
            $today = date('Y-m-d', strtotime($year . '-' . $month . '-1'));
            $data['payableAmount'] = 0;
            if ($data['user']->user_type == 1) {
                $td = User::select(
                    'user.*',
                    'user_salary.salary AS csalary',
                    DB::raw('SUM(attendance.incentive) AS total_incentive'),
                    DB::raw("SUM(CASE WHEN attendance.mark = 'P' THEN 1 ELSE 0 END) AS total_P"),
                    DB::raw("SUM(CASE WHEN attendance.mark = 'H' THEN 1 ELSE 0 END) AS total_H"),
                    DB::raw("SUM(CASE WHEN attendance.mark = 'A' THEN 1 ELSE 0 END) AS total_A"),
                    DB::raw("SUM(CASE WHEN attendance.mark = 'UPL' THEN 1 ELSE 0 END) AS total_UPL"),
                    DB::raw("SUM(CASE WHEN attendance.mark = 'HPL' THEN 1 ELSE 0 END) AS total_HPL"),
                    DB::raw("SUM(CASE WHEN attendance.mark = 'PL' THEN 1 ELSE 0 END) AS total_PL"),
                    DB::raw("SUM(attendance.sale_made) AS total_sales"),
                )
                    ->leftJoin('user_salary', 'user.id', 'user_salary.uid')->whereDate('from', '<=', $check_date)
                    ->whereDate('to', '>=', $check_date)
                    ->leftJoin('attendance', 'user.id', '=', 'attendance.user_id')
                    ->where('user.id', $user_id)
                    ->whereBetween('attendance.mark_date', ["$year-$month-01", "$year-$month-$total_days"])
                    ->groupBy('user.id')
                    ->first();


                $ult = User_target::where('target_type', 1)->where('server_type', $user->server_ip)->whereDate('from', '<=', $today)->whereDate('to', '>=', $today);
                $ulta = $ult->count() ? $ult->first()->target : 0;

                // user minimum sales target
                $umst = User_target::where('target_type', 0)->where('server_type', $user->server_ip)->whereDate('from', '<=', $today)->whereDate('to', '>=', $today);
                $us_umst = $umst->count() ? $umst->first()->target : 0;

                // user monthly sales target
                $umt = User_target::where('target_type', 2)->where('server_type', $user->server_ip)->whereDate('from', '<=', $today)->whereDate('to', '>=', $today);
                $us_umt = $umt->count() ? $umt->first()->target : 0;
                $bp = ($user->server_ip == '144.76.0.239') ? 5000 : 3000;
                $basePay = $umt->count() ? $umt->first()->bonus : $bp;

                if ($user->server_ip == '144.76.0.239') {
                    ($targ = round((($user->csalary / 1000) / 100) * $us_umst));
                    $us_umtv = $us_umt ? $us_umt : 100;
                    ($ftarg = round((($user->csalary / 1000) / 100) * $us_umtv));
                } else {
                    ($targ = $us_umst);
                    $us_umtv = $us_umt ? $us_umt : $us_umst;
                    ($ftarg = $us_umtv);
                }
                $mts = $user->total_sales - $ftarg;
                if ($mts >= 0) {
                    $payableAmount = $basePay + $mts * 500;
                } else {
                    $payableAmount = 0;
                }
                $data['isPayable'] = ($user->total_sales >= $targ and $user->total_leads >= $ulta) ? 1 : 0;
                $data['payableAmount'] = $payableAmount;


                $data['isPayable'] = $td->total_sales >= $targ ? 1 : 0;
                $data['payableAmount'] = $data['isPayable'] ? $payableAmount + $td['total_incentive'] : 0;
            } else {
                $td = User::select(
                    'user.*',
                    'user_salary.salary AS csalary',
                    DB::raw("SUM(CASE WHEN attendance.mark = 'P' THEN 1 ELSE 0 END) AS total_P"),
                    DB::raw("SUM(CASE WHEN attendance.mark = 'H' THEN 1 ELSE 0 END) AS total_H"),
                    DB::raw("SUM(CASE WHEN attendance.mark = 'A' THEN 1 ELSE 0 END) AS total_A"),
                    DB::raw("SUM(CASE WHEN attendance.mark = 'UPL' THEN 1 ELSE 0 END) AS total_UPL"),
                    DB::raw("SUM(CASE WHEN attendance.mark = 'HPL' THEN 1 ELSE 0 END) AS total_HPL"),
                    DB::raw("SUM(CASE WHEN attendance.mark = 'PL' THEN 1 ELSE 0 END) AS total_PL"),
                )
                    ->leftJoin('user_salary', 'user.id', 'user_salary.uid')->whereDate('from', '<=', $check_date)
                    ->whereDate('to', '>=', $check_date)
                    ->leftJoin('attendance', 'user.id', '=', 'attendance.user_id')
                    ->where('user.id', $user_id)
                    ->whereBetween('attendance.mark_date', ["$year-$month-01", "$year-$month-$total_days"])
                    ->groupBy('user.id')
                    ->first();
            }
            // dd($td->csalary);
            $data['user'] = $td;
            $data['total_paid_days'] = (($td->total_P  + $td->total_PL  + ($td->total_H / 2)  + ($td->total_HPL / 2)) + $data['hsun']);
            $data['total_working_day'] = (($td->total_P  + ($td->total_H / 2)) + $data['hsun']);
            $data['paid_leaves'] = (($td->total_PL  + ($td->total_HPL / 2)));
            $number = $data['total_salary'] = round(($td->csalary / $data['total_working']) * (($td->total_P  + $td->total_PL  + ($td->total_H / 2)  + ($td->total_HPL / 2)) + $data['hsun']));
            return view('user.payslip', $data);
        } else {
            return redirect(env('APP_URL'));
        }
    }
    public function offer()
    {
        return view('user.offer');
    }

    public function user($user_id, $lt = 0)
    {
        $user = User::select('user.*', 'department.d_name', 'user_permission.permission')->where('user.id', $user_id)->leftJoin('department', 'user.user_type', 'department.id', 'user_permission.permission')->leftjoin('user_permission', 'user.id', 'user_permission.uid')->get();
        if (!empty($user)) {
            if ($lt == 0) {
                $this->login_time($user_id);
            }
            return $user[0];
        } else {
            print_r("<script>window.location.replace('" . env('APP_URL') . 'admin/logout' . "');</script>");
            exit;
        }
    }
    public function getfromcrm($date, $user_id)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crm4.pantheondigitals.com/api.php?gettodaylead=' . $date . '&user_id=' . $user_id,
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
    public function verify_crm_emp_id($emp_id)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crm4.pantheondigitals.com/api.php?emp_id=' . $emp_id,
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
    public function logout()
    {
        Session::flush();
        return redirect(env('APP_URL'));
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
    public function x_week_range($date)
    {
        $ts = strtotime($date);
        $start = (date('w', $ts) == 1) ? $ts : strtotime('last Monday', $ts);
        return array(
            date('Y-m-d', $start),
            date('Y-m-d', strtotime('next Sunday', $start))
        );
    }
    public function accept_policy(Request $request)
    {
        if (!empty(Session::get('user'))) {
            $user_id = Session::get('user');
            $policyId = $request->input('policy_id', null);

            if ($policyId) {
                $policy = Policies::find($policyId);

                if ($policy) {
                    $acceptedUids = explode(',', $policy->uids);
                    if (!in_array($user_id, $acceptedUids)) {
                        $acceptedUids[] = $user_id;

                        $policy->uids = implode(',', array_filter($acceptedUids));
                        $policy->save();

                        return back()->with('success', 'Policy accepted successfully.');
                    } else {
                        return back()->with('info', 'You have already accepted this policy.');
                    }
                } else {
                    return back()->with('error', 'Policy not found.');
                }
            } else {
                return back()->with('error', 'No policy selected.');
            }
        } else {
            // User not logged in
            return redirect(env('APP_URL'));
        }
    }
    public function unauthorized_access()
    {
        $errorMessage = session('error');

        if ($errorMessage) {
            echo $errorMessage;
        } else {
        }
    }
    public function toword($number)
    {
        $no = floor($number);
        $point = round($number - $no, 2) * 100;
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
        return $result . "Rupees  ";
    }
}
