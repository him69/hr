<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;
use DB;
use Session;
use App\Models\User;
use App\Models\Adminmodel;
use App\Models\Chat_group;
use App\Models\Group_member;
use App\Models\Chat as ChatModel;
use Exception;
use DateTime;
use Mail;

class Chat extends controller{
    public function get_message(Request $request){
        if($request->sender_type){$c_type = $request->sender_type;}elseif($request->receiver_type){$c_type = $request->receiver_type;}else{$c_type = 1;}
        if(!empty(Session::get('admin'))){
            $user_id = Session::get('admin');
            $user_type = 3;
        }elseif(!empty(Session::get('user'))){
            $user_id = Session::get('user');
            $user_type = 1;
        }else{
            return response(['status'=>400,'message'=>'user not valid']);
        }
        $user = $this->user($user_id,$user_type);
        if($user){
        if($request->group_id && $request->last_id){
            if($request->type == 2){
                // \DB::enableQueryLog();
            $data = ChatModel::select('chat.*','user.photo','user.name','user.user_id')->whereIn('receiver_id', [$request->group_id,$user->id])->whereIn('sender_id', [$request->group_id,$user->id])->where('chat.id','>',$request->last_id)->leftJoin('user','user.id','chat.sender_id')->where(function ($query) use ($c_type) {$query->where('receiver_type', $c_type)->orWhere('sender_type', $c_type);})->orderBy('chat.id')->get();
            // dd(\DB::getQueryLog());
            }else{
            $data = ChatModel::select('chat.*','user.photo','user.name','user.user_id')->where('group_id',$request->group_id)->where('chat.id','>',$request->last_id)->leftJoin('user','user.id','chat.sender_id')->where(function ($query) use ($c_type) {$query->where('receiver_type', $c_type)->orWhere('sender_type', $c_type);})->orderBy('chat.id')->get();
            }
            return response(['status'=>200,'data'=>$data,'new_message'=>$data]);
        }elseif($request->group_id){
            // \DB::enableQueryLog();
            if($request->type == 2){
            $data = ChatModel::select('chat.*', 'user.photo','user.name', 'user.user_id', 'user.user_type')->leftJoin('user', 'user.id', '=', 'chat.sender_id')->whereIn('receiver_id', [$request->group_id,$user->id])->whereIn('sender_id', [$request->group_id,$user->id])->where(function ($query) use ($c_type) {$query->where('receiver_type', $c_type)->orWhere('sender_type', $c_type);})->orderBy('chat.id', 'desc')->limit(500)->get()->reverse()->values()->toArray();
            }else{
            $data = ChatModel::select('chat.*', 'user.photo','user.name', 'user.user_id', 'user.user_type')->leftJoin('user', 'user.id', '=', 'chat.sender_id')->where('group_id', $request->group_id)->orderBy('chat.id', 'desc')->limit(500)->get()->reverse()->values()->toArray();
            }
            // dd(\DB::getQueryLog());
            return response(['status'=>200,'data'=>$data]);
        }else{
            return response(['status'=>400,'message'=>'Please send all perameter']);
        }
        }else{
            return response(['status'=>400,'message'=>'user not valid']);
        }
    }
    public function send_message(Request $request){
        if($request->sender_type){$sender_type = $request->sender_type;}else{$sender_type = 1;}
        if($request->receiver_type){$receiver_type = $request->receiver_type;}else{$receiver_type = 1;}
        if(!empty(Session::get('admin'))){
            $user_id = Session::get('admin');
            $user_type = 3;
        }elseif(!empty(Session::get('user'))){
            $user_id = Session::get('user');
            $user_type = 1;
        }else{
            return response(['status'=>400,'message'=>'user not valid']);
        }
        $user = $this->user($user_id,$user_type);
        if($user){
        if($request->group_id){
            if($request->chat_type == 2){
                $mess = htmlspecialchars($request->message);
                $ch = ChatModel::create(['message'=>$mess,'receiver_id'=>$request->group_id,'sender_id'=>$user->id,'sender_type'=>$sender_type,'receiver_type'=>$receiver_type]);
            }else{
                $mess = htmlspecialchars($request->message);
                $ch = ChatModel::create(['message'=>$mess,'group_id'=>$request->group_id,'sender_id'=>$user->id,'sender_type'=>$sender_type]);
            }
            return response(['status'=>200,'data'=>[$ch]]);
        }else{
            return response(['status'=>400,'message'=>'Please send all perameter']);
        }
        }else{
            return response(['status'=>400,'message'=>'user not valid']);
        }
    }
    public function user($user_id,$user_type){
        if($user_type == 3){
            $user = Adminmodel::where('id',$user_id)->get();
            if($user->count() > 0){
                return $user[0];
            }else{
                return 0;
            }
        }else{
            $user = user::where('id',$user_id)->get();
            if($user->count() > 0){
                return $user[0];
            }else{
                return 0;
            }
        }
    }
    public function stream(Request $request){
        $c_type = 1;
        if($request->sender_type){$c_type = $request->sender_type;}elseif($request->receiver_type){$c_type = $request->receiver_type;}
        if(!empty(Session::get('admin'))){
            $user_id = Session::get('admin');
            $user_type = 3;
        }elseif(!empty(Session::get('user'))){
            $user_id = Session::get('user');
            $user_type = 1;
        }else{
            echo "data: " .json_encode(['status'=>400,'message'=>'user not valid']) . "\n\n";
                exit;
        }
            $user = $this->user($user_id,$user_type);
            $response = new StreamedResponse(function () use ($user_id,$user,$request,$c_type) {
            while (true) {
            if($user){
            if($request->group_id && $request->last_id){
                if($request->type == 2){
                    // \DB::enableQueryLog();
                    $baseQuery = ChatModel::where('sender_id', $request->group_id)
                                          ->where('receiver_id', $user->id)
                                          ->where(function ($query) use ($c_type) {
                                              $query->where('receiver_type', $c_type)->orWhere('sender_type', $c_type);
                                          });
                    $updateQuery = clone $baseQuery;
                    $updateQuery->update(['seen' => 1]);
                    // print_r(\DB::getQueryLog());
                        $baseQuery->whereIn('receiver_id', [$request->group_id, $user->id])
                                  ->whereIn('sender_id', [$request->group_id, $user->id])
                                  ->where('chat.id', '>', $request->last_id);
                    $data = $baseQuery->select('chat.*', 'user.photo','user.name', 'user.user_id')
                                      ->leftJoin('user', 'user.id', 'chat.sender_id')
                                      ->get();

                }else{
                    // \DB::enableQueryLog();
                    $baseQuery = ChatModel::where('group_id', $request->group_id)
                                          ->where('chat.id', '>', $request->last_id)
                                          ->orderBy('chat.id');
                    // print_r(\DB::getQueryLog());
                    $updateQuery = clone $baseQuery;
                    $updateQuery->update(['seen' => 1]);
                    $data = $baseQuery->select('chat.*', 'user.photo','user.name', 'user.user_id')
                                      ->leftJoin('user', 'user.id', 'chat.sender_id')
                                      ->get();
                }
                $group = Group_member::select('group_member.group_id')->selectRaw('COALESCE(SUM(CASE WHEN chat.seen = 0 THEN 1 ELSE 0 END), 0) AS new_message')->leftJoin('chat', function($join) use ($request) {$join->on('group_member.group_id', '=', 'chat.group_id')->where('chat.id', '>', $request->last_id);})->where('group_member.member_id', $user_id)->groupBy('group_member.group_id')->get();

                
                $userc = ChatModel::select('sender_id')->selectRaw('COALESCE(SUM(CASE WHEN chat.seen = 0 THEN 1 ELSE 0 END), 0) AS new_message')->where(function($query) use ($user) {$query->where('receiver_id', $user->id)->orWhere('sender_id', $user->id);})->groupBy('sender_id')->get();

                echo "data: " .json_encode(['status'=>200,'data'=>$data,'new_message'=>$data->count(),'group'=>$group,'user'=>$userc]) . "\n\n";
                DB::disconnect('mysql');
            }else{}
            }else{
                echo "data: " .json_encode(['status'=>400,'message'=>'user not valid']) . "\n\n";
            }
                    ob_flush();
                    flush();
                    sleep(1);
                }
            });
        
            $response->headers->set('Content-Type', 'text/event-stream');
            $response->headers->set('Cache-Control', 'no-cache');
            $response->headers->set('Connection', 'keep-alive');
        
            return $response;
        }
    public function messdata(Request $request){
        if(!empty(Session::get('admin'))){
            $user_id = Session::get('admin');
            $user_type = 3;
        }elseif(!empty(Session::get('user'))){
            $user_id = Session::get('user');
            $user_type = 1;
        }else{
            echo "data: " .json_encode(['status'=>400,'message'=>'user not valid']) . "\n\n";
                exit;
        }
            $user = $this->user($user_id,$user_type);
            $response = new StreamedResponse(function () use ($user,$request,$user_id) {
            while (true) {
            if($user){
                $group = Group_member::select('group_member.group_id')->selectRaw('COALESCE(SUM(CASE WHEN chat.seen = 0 THEN 1 ELSE 0 END), 0) AS new_message')->leftJoin('chat', function($join) use ($request) {$join->on('group_member.group_id', '=', 'chat.group_id')->where('chat.id', '>', $request->last_id);})->where('group_member.member_id', $user_id)->groupBy('group_member.group_id')->get();
                $userc = ChatModel::select('sender_id')->selectRaw('COALESCE(SUM(CASE WHEN chat.seen = 0 THEN 1 ELSE 0 END), 0) AS new_message')->where(function($query) use ($user) {$query->where('receiver_id', $user->id);})->groupBy('sender_id')->get();

                echo "data: " .json_encode(['status'=>200,'group'=>$group,'user'=>$userc]) . "\n\n";
                DB::disconnect('mysql');
            }else{
                echo "data: " .json_encode(['status'=>400,'message'=>'user not valid']) . "\n\n";
            }
                    ob_flush();
                    flush();
                    sleep(1);
                }
            });
            $response->headers->set('Content-Type', 'text/event-stream');
            $response->headers->set('Cache-Control', 'no-cache');
            $response->headers->set('Connection', 'keep-alive');
            return $response;
        }
}