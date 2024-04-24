<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Home;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Adper;
use App\Http\Controllers\Chat;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [Home::class, 'login']);
Route::any('login', [Home::class, 'login']);
Route::get('logout', [Home::class, 'logout']);
Route::get('unauthorized-access', [Home::class, 'unauthorized_access']);
Route::group(['middleware'=> ['isLeader']], function(){
    Route::any('user', [Home::class, 'index']);
    Route::any('attendance', [Home::class, 'attendance']);
    Route::post('attendance/mark', [Home::class, 'attendance_mark']);
    Route::post('attendance/mark', [Home::class, 'attendance_mark']);
    Route::get('leave', [Home::class, 'leave']);
    Route::post('leave/mark', [Home::class, 'leave_mark']);
    Route::get('ticket', [Home::class, 'ticket']);
    Route::post('ticket', [Home::class, 'ticket']);
    Route::get('profile', [Home::class, 'uprofile']);
    Route::get('reponses', [Home::class, 'reponses']);   
    Route::get('profile/edit', [Home::class, 'editprofile']);   
    Route::post('profile/edit', [Home::class, 'editprofile']); 
    Route::get('profile/documentUpload', [Home::class, 'document']);   
    Route::post('profile/documentUpload', [Home::class, 'document']); 
    Route::post('profile', [Home::class, 'profile']);
    Route::get('general_info', [Home::class, 'general_info']);
    Route::get('wfh', [Home::class, 'wfh']);
    Route::post('wfh', [Home::class, 'wfh']);
    Route::post('update_crm_id', [Home::class, 'update_crm_id']);
    Route::any('policy_accept', [Home::class, 'accept_policy']);
    Route::post('update_password', [Home::class, 'pass_change']);
    Route::any('team/leave_approve/{id}', [Home::class, 'team_leave_approve']);
    Route::any('team/leave_reject/{id}', [Home::class, 'team_leave_reject']);
    Route::any('payslip', [Home::class, 'payslip']);
    Route::any('payslip2', [Home::class, 'payslip2']); 
    Route::any('offer', [Home::class, 'offer']);
    Route::any('request_for_leave', [Home::class, 'request_for_leave']);
    Route::any('holiday', [Home::class, 'holiday']);
    Route::any('team/attendance', [Home::class, 'team_attendance']);
    Route::any('team/leave', [Home::class, 'team_leave']);
    Route::post('asset_verify', [Home::class, 'asset_verify']);
    Route::post('training', [Home::class, 'training']);
    
    

// Route::any('adper/attendance', [Adper::class, 'attendance']);
// Route::any('adper/sales', [Adper::class, 'sales']);
// Route::any('adper/qa', [Adper::class, 'qa']);
// Route::any('adper/attendance/mark', [Adper::class, 'attendance_mark']);
// Route::any('adper/incentive', [Adper::class, 'incentive']);
// Route::any('adper/attendance/full_report/{id}', [Adper::class, 'full_report']);
// Route::any('adper/attendance/full_report2/{id}', [Adper::class, 'full_report2']);
// // Route::any('adper/ass_ass', [Adper::class, 'ass_ass']);
// Route::any('adper/relieving', [Adper::class, 'relieving']);
// // Route::any('adper/leave', [Adper::class, 'leave']);
// // Route::any('adper/leave_approve/{id}', [Adper::class, 'leave_approve']);
// // Route::any('adper/leave_reject/{id}', [Adper::class, 'leave_reject']);
// Route::any('adper/users/create', [Adper::class, 'add_user']);
// Route::any('adper/users', [Adper::class, 'users']);
// Route::any('adper/userstatus', [Adper::class, 'userstatus']);
// Route::any('adper/qa_attendance', [Adper::class, 'qa_attendance']);
// Route::any('adper/attendance/qa_full_report/{id}', [Adper::class, 'qa_full_report']);
// Route::post('adper/save_profile/{id}', [Adper::class, 'save_profile']);
// Route::any('adper/save_user_file/{id}', [Adper::class, 'save_user_file']);
// Route::any('adper/user_mode/{id}', [Adper::class, 'user_mode']);
// Route::any('adper/holiday', [Adper::class, 'holiday']);
// Route::any('adper/onboard/add_candidate', [Adper::class, 'add_candidate']);
// Route::any('adper/onboard/candidate', [Adper::class, 'candidate']);
// Route::any('adper/create_offer', [Adper::class, 'create_offer']);
// Route::any('adper/offer', [Adper::class, 'offer']);
// Route::any('adper/fnf', [Adper::class, 'fnf']);
// Route::any('adper/appoint', [Adper::class, 'appoint']);
// Route::any('adper/increment', [Adper::class, 'increment']);
// Route::any('adper/appraisal', [Adper::class, 'appraisal']);
// Route::any('adper/experience', [Adper::class, 'experience']);
// Route::any('adper/confirmation', [Adper::class, 'confirmation']);
// Route::any('adper/markincentive', [Adper::class, 'markincentive']);
// Route::any('adper/basic_email', [Adper::class, 'basic_email']);
// Route::any('adper/html_email', [Adper::class, 'html_email']);
// Route::any('adper/attachment_email', [Adper::class, 'attachment_email']);
// Route::any('adper/interview', [Adper::class, 'interview']);
// Route::any('adper/rejected', [Adper::class, 'rejected']);
// Route::get('adper/reject/{cid}', [Adper::class, 'reject']);
// Route::post('adper/schedule', [Adper::class, 'schedule_interview']);
// Route::any('adper/hired', [Adper::class, 'hired_candidate']);
// Route::any('adper/hiredcan/{hid}', [Adper::class, 'hired']);
// Route::any('adper/assets', [Adper::class, 'assets']);
// Route::any('adper/delete_assets/{id}', [Adper::class, 'delete_assets']);
// Route::any('adper/ass_ass/{id}', [Adper::class, 'ass_ass']);
// Route::any('adper/asset_history/{id}', [Adper::class, 'asset_history']);
// Route::any('adper/filter', [Adper::class, 'filter']);
// Route::any('adper/getall', [Adper::class, 'getall']);
// Route::any('adper/policyExpire', [Adper::class, 'policy_Expire']);
// Route::any('adper/policies', [Adper::class, 'policies']);//my route
// Route::any('adper/unassigend/{aid}/{uid}', [Adper::class, 'unassignd']);//my route//my route
// Route::any('adper/faulty/{id}/{uid}', [Adper::class, 'faulty']);//my route
// Route::any('adper/faulty/{id}', [Adper::class, 'faulty']);//my route
// Route::any('adper/resolved/{id}', [Adper::class, 'resolved']);//my route
// Route::any('adper/getuserbyleader/{dep_id}/{leader_id}', [Adper::class, 'getuserbyleader']);//my route
// Route::any('adper/getleaderbydiparment/{dep_id}', [Adper::class, 'getleaderbydiparment']);//my route
// Route::any('adper/teams', [Adper::class, 'teams']);//my route
// Route::any('adper/userReport/{date}/{id}', [Adper::class, 'userReport']);
// Route::get('adper/ticket', [Adper::class, 'ticket']);
// Route::get('adper/ticketstatus', [Adper::class, 'ticketstatus']);

// // Route::get('adper/salary', [Adper::class, 'salary']);
// Route::any('adper/bulkUpload', [Adper::class, 'bulk_upload']);
// Route::any('adper/per_day_report/{date}', [Adper::class, 'per_day_report']);
// Route::any('adper/bh', [Adper::class, 'blukholiday']);
// Route::any('adper/user_letter', [Adper::class, 'user_letter']);
    
});
Route::prefix('adper')->group(function () {
    Route::get('/index', [Adper::class, 'index'])->middleware('user.permission:13');

    Route::any('/attendance', [Adper::class, 'attendance'])->middleware('user.permission:1');
    Route::any('/sales', [Adper::class, 'sales'])->middleware('user.permission:1');
    Route::any('/userReport/{date}/{id}', [Adper::class, 'userReport'])->middleware('user.permission:1');
    Route::any('/per_day_report/{date}', [Adper::class, 'per_day_report'])->middleware('user.permission:1');

    Route::any('/salary', [Adper::class, 'salary'])->middleware('user.permission:2');

    Route::any('/leave', [Adper::class, 'leave'])->middleware('user.permission:3');
    Route::any('/leave_approve/{id}', [Adper::class, 'leave_approve'])->middleware('user.permission:3');
    Route::any('/leave_reject/{id}', [Adper::class, 'leave_reject'])->middleware('user.permission:3');

    Route::any('/holiday', [Adper::class, 'holiday'])->middleware('user.permission:4');
    Route::any('/bh', [Adper::class, 'blukholiday'])->middleware('user.permission:4');

    Route::any('/users', [Adper::class, 'users'])->middleware('user.permission:5');
    Route::any('/userstatus', [Adper::class, 'userstatus'])->middleware('user.permission:5');

    Route::any('/getuserbyleader/{dep_id}/{leader_id}', [Adper::class, 'getuserbyleader'])->middleware('user.permission:6');//my route
    Route::any('/getleaderbydiparment/{dep_id}', [Adper::class, 'getleaderbydiparment'])->middleware('user.permission:6');//my route
    Route::any('/teams', [Adper::class, 'teams'])->middleware('user.permission:6');

    Route::any('/users/create', [Adper::class, 'add_user'])->middleware('user.permission:7');

    Route::any('/ass_ass', [Adper::class, 'ass_ass'])->middleware('user.permission:8');
    Route::any('/delete_assets/{id}', [Adper::class, 'delete_assets'])->middleware('user.permission:8');
    Route::any('/ass_ass/{id}', [Adper::class, 'ass_ass'])->middleware('user.permission:8');
    Route::any('/asset_history/{id}', [Admin::class, 'asset_history'])->middleware('user.permission:8');
    Route::any('/filter', [Adper::class, 'filter'])->middleware('user.permission:8');
    Route::any('/getall', [Adper::class, 'getall'])->middleware('user.permission:8');
    Route::any('/unassigend/{aid}/{uid}', [Adper::class, 'unassignd'])->middleware('user.permission:8');//my route
    Route::any('/faulty/{id}/{uid}', [Admin::class, 'faulty'])->middleware('user.permission:8');//my route
    Route::any('/faulty/{id}', [Adper::class, 'faulty'])->middleware('user.permission:8');//my route
    Route::any('/resolved/{id}', [Adper::class, 'resolved'])->middleware('user.permission:8');//my route
    Route::any('/bulkUpload', [Adper::class, 'bulk_upload'])->middleware('user.permission:8');

    Route::any('/onboard/add_candidate', [Adper::class, 'add_candidate'])->middleware('user.permission:9');
    Route::any('/onboard/candidate', [Adper::class, 'candidate'])->middleware('user.permission:9');
    Route::any('/create_offer', [Adper::class, 'create_offer'])->middleware('user.permission:9');
    Route::any('/offer', [Adper::class, 'offer'])->middleware('user.permission:9');
    Route::any('/fnf', [Adper::class, 'fnf'])->middleware('user.permission:9');
    Route::any('/appoint', [Adper::class, 'appoint'])->middleware('user.permission:9');
    Route::any('/increment', [Adper::class, 'increment'])->middleware('user.permission:9');
    Route::any('/appraisal', [Adper::class, 'appraisal'])->middleware('user.permission:9');
    Route::any('/experience', [Adper::class, 'experience'])->middleware('user.permission:9');
    Route::any('/confirmation', [Adper::class, 'confirmation'])->middleware('user.permission:9');
    Route::any('/markincentive', [Adper::class, 'markincentive'])->middleware('user.permission:9');
    Route::any('/relieving', [Adper::class, 'relieving'])->middleware('user.permission:9');

    Route::any('/policyExpire', [Adper::class, 'policy_Expire'])->middleware('user.permission:10');
    Route::any('/policies', [Adper::class, 'policies'])->middleware('user.permission:10');//my route

    Route::get('/ticket', [Adper::class, 'ticket'])->middleware('user.permission:11');
    Route::get('/ticketstatus', [Adper::class, 'ticketstatus'])->middleware('user.permission:11');

    Route::get('/announcement', [Adper::class, 'announcement'])->middleware('user.permission:12');
    Route::post('/announcement', [Adper::class, 'announcement'])->middleware('user.permission:12');
    // Additional routes
});
Route::any('admin/create_payslip', [Home::class, 'create_payslip']);
Route::middleware(['log.request'])->group(function () {
Route::get('admin/', [Admin::class, 'login']);
Route::any('admin/login', [Admin::class, 'login']);
Route::get('admin/index', [Admin::class, 'index']);
Route::any('admin/attendance', [Admin::class, 'attendance']);
Route::any('admin/sales', [Admin::class, 'sales']);
Route::any('admin/qa', [Admin::class, 'qa']);
Route::any('admin/attendance/mark', [Admin::class, 'attendance_mark']);
Route::any('admin/incentive', [Admin::class, 'incentive']);
Route::any('admin/attendance/full_report/{id}', [Admin::class, 'full_report']);
Route::any('admin/attendance/full_report2/{id}', [Admin::class, 'full_report2']);
Route::any('admin/doc_verify/{id}', [Admin::class, 'doc_verify']);
Route::any('admin/ass_ass', [Admin::class, 'ass_ass']);
Route::any('admin/relieving', [Admin::class, 'relieving']);
Route::any('admin/leave', [Admin::class, 'leave']);
Route::any('admin/leave_approve/{id}', [Admin::class, 'leave_approve']);
Route::any('admin/leave_reject/{id}', [Admin::class, 'leave_reject']);
Route::any('admin/users/create', [Admin::class, 'add_user']);
Route::any('admin/users', [Admin::class, 'users']);
Route::any('admin/userstatus', [Admin::class, 'userstatus']);
Route::any('admin/user-role', [Admin::class, 'user_role']);
Route::any('admin/qa_attendance', [Admin::class, 'qa_attendance']);
Route::any('admin/attendance/qa_full_report/{id}', [Admin::class, 'qa_full_report']);
Route::post('admin/save_profile/{id}', [Admin::class, 'save_profile']);
Route::any('admin/save_user_file/{id}', [Admin::class, 'save_user_file']);
Route::any('admin/user_mode/{id}', [Admin::class, 'user_mode']);
Route::any('admin/holiday', [Admin::class, 'holiday']);
Route::any('admin/onboard/add_candidate', [Admin::class, 'add_candidate']);
Route::any('admin/onboard/candidate', [Admin::class, 'candidate']);
Route::any('admin/create_offer', [Admin::class, 'create_offer']);
Route::any('admin/offer', [Admin::class, 'offer']);
Route::any('admin/fnf', [Admin::class, 'fnf']);
Route::any('admin/appoint', [Admin::class, 'appoint']);
Route::any('admin/increment', [Admin::class, 'increment']);
Route::any('admin/appraisal', [Admin::class, 'appraisal']);
Route::any('admin/experience', [Admin::class, 'experience']);
Route::any('admin/confirmation', [Admin::class, 'confirmation']);
Route::any('admin/markincentive', [Admin::class, 'markincentive']);
Route::any('admin/basic_email', [Admin::class, 'basic_email']);
Route::any('admin/html_email', [Admin::class, 'html_email']);
Route::any('admin/attachment_email', [Admin::class, 'attachment_email']);
Route::any('admin/interview', [Admin::class, 'interview']);
Route::any('admin/rejected', [Admin::class, 'rejected']);
Route::get('admin/reject/{cid}', [Admin::class, 'reject']);
Route::post('admin/schedule', [Admin::class, 'schedule_interview']);
Route::any('admin/hired', [Admin::class, 'hired_candidate']);
Route::any('admin/hiredcan/{hid}', [Admin::class, 'hired']);
Route::any('admin/assets', [Admin::class, 'assets']);
Route::any('admin/delete_assets/{id}', [Admin::class, 'delete_assets']);
Route::any('admin/ass_ass/{id}', [Admin::class, 'ass_ass']);
Route::any('admin/asset_history/{id}', [Admin::class, 'asset_history']);
Route::any('admin/filter', [Admin::class, 'filter']);
Route::any('admin/getall', [Admin::class, 'getall']);
Route::any('admin/policyExpire', [Admin::class, 'policy_Expire']);
Route::any('admin/policies', [Admin::class, 'policies']);//my route
Route::any('admin/unassigend/{aid}/{uid}', [Admin::class, 'unassignd']);//my route//my route
Route::any('admin/faulty/{id}/{uid}', [Admin::class, 'faulty']);//my route
Route::any('admin/faulty/{id}', [Admin::class, 'faulty']);//my route
Route::any('admin/resolved/{id}', [Admin::class, 'resolved']);//my route
Route::any('admin/getuserbyleader/{dep_id}/{leader_id}', [Admin::class, 'getuserbyleader']);//my route
Route::any('admin/getleaderbydiparment/{dep_id}', [Admin::class, 'getleaderbydiparment']);//my route
Route::any('admin/teams', [Admin::class, 'teams']);//my route
Route::any('admin/userReport/{date}/{id}', [Admin::class, 'userReport']);
Route::get('admin/ticket', [Admin::class, 'ticket']);
Route::get('admin/ticketstatus', [Admin::class, 'ticketstatus']);
Route::get('admin/announcement', [Admin::class, 'announcement']);
Route::post('admin/announcement', [Admin::class, 'announcement']);
Route::get('admin/salary', [Admin::class, 'salary']);
Route::any('admin/bulkUpload', [Admin::class, 'bulk_upload']);
Route::any('admin/per_day_report/{date}', [Admin::class, 'per_day_report']);
Route::any('admin/bh', [Admin::class, 'blukholiday']);
Route::any('admin/user_letter', [Admin::class, 'user_letter']);
Route::any('admin/attendance2', [Admin::class, 'attendance2']);
Route::any('admin/sales2', [Admin::class, 'sales2']);
// user roles routes
Route::any('admin/grants', [Admin::class, 'grants']);
 
});
Route::any('admin/worktype', [Admin::class, 'worktype']);//my route
Route::get('admin/logout', [Admin::class, 'logout'])->name('logout');


// chat
Route::get('sse', [Chat::class, 'stream']);
Route::get('messdata', [Chat::class, 'messdata']);
Route::get('get_message', [Chat::class, 'get_message']);
Route::post('chat_send_message', [Chat::class, 'send_message']);