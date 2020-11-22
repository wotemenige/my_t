<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;

class Wechat extends Controller
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $this->app = $this->get_official();
        $oauth = $this->app->oauth;
        $this->uri = $request->route()->uri();
        $param = http_build_query($request->all());
        $users = Session('wechat_users');

        if (empty($users)) {
            //获取当前的路由
            Session(['target_url_f'=>env('APP_URL').$this->uri.'?'.$param]);
            Session::save();
            return $oauth->redirect();
        }

        $request->offsetSet('openid',$users['id']);
        return $next($request);
    }
}
