<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class checklogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        // session()->put('abc', "abc123");
        // dd(session('abc')); 
        // return response($request->session()->get('thew_session'));
        // header('Content-Type:application/json');
        // echo json_encode(session()->all());die();
        // return response(session()->get("thew_session"));
        /*$check_flag = 0;

        $return = array();
        //This condition for checking session
        if (!Session::has('thew_session')) {
            $return['ERROR_CODE'] = '1';
            $return['ERROR_DESCRIPTION'] = 'Session Not available';
            $check_flag = 1;
        }else{
            $token = \Request::header('Authorization');
            $session_data = session('thew_session');

            //This condition for checking token is match or not
            if($token != $session_data['login_token'])
            {
                $return['ERROR_CODE'] = '1';
                $return['ERROR_DESCRIPTION'] = 'Token Mismatch';
                $check_flag = 1;    
            }

        }
        //this condition for checking session not present
        if($check_flag)
        {
            return response($return);
        }*/
        
        $return = array();

        $request_data = $request->all();

        $login = false;    

        if ($request->session()->has('thew_session')) {
            $session_data = $request->session()->get('thew_session');
            if($session_data['login_token'] == $request_data['token_id'])
            {
                $login = true; 
            }
        }
        
        if(!$login)
        {
            
            $return['DATA'] = '';
            $return['ERROR_CODE'] = '2';
            $return['ERROR_DESCRIPTION'] = '';

            return response($return);
        }

        return $next($request);
    }
}
