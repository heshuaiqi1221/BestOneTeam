<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Models\OperationLog;
use DB;
use App\Http\Models\Lect;
class AdminOperationLog
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user_id = $request->session()->get('user');
        if(Auth::check()) {
            $user_id = (int) Auth::id();
        }
        $_SERVER['uid'] = $user_id;
        $name=$user_id['users_name'];
        $time=time();
        if('GET' != $request->method()){
            $input = $request->all();
            //var_dump($input);die;
            $log = new OperationLog(); # 提前创建表、model
            $log->name=$name;
            $log->ip = $request->ip();
            $log->method = $request->method();
            $log->time=$time;
            $log->sql = '';
            $log->input = json_encode($input, JSON_UNESCAPED_UNICODE);
            $log->save();  # 记录日志
        }
        return $next($request);
    }
}
