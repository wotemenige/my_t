<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use JWTAuth;
use App\Models\User;
use JWTFactory;

class ApiController extends Controller
{
	//登录
	public function log()
	{

		$f = fopen('a.txt','w');
		if (flock($f,LOCK_EX | LOCK_NB))
		{
			sleep(10);
			flock($f,LOCK_UN);
		}
		fclose($f);
		return '好';
		// $credentials['email'] = '1154472276@qq.com';
		// $credentials['password'] = '1518484482';

		//  if (! $token = auth('api')->attempt($credentials)) {
  //           return response()->json(['error' => 'Unauthorized'], 401);
  //       }

		// $a = User::where('id',1)->first();
		// $data['token'] = JWTAuth::fromUser($a);
  //       return $data;
        // $info = ['a'=>'这是a','b'=>'这是b'];
        // // //不依赖数据库使用
        // $payload = JWTFactory::sub(123)->aud('foo')->foo(['info' => $info])->make();
        // $token = JWTAuth::encode($payload);
        // $token = (array)$token;
        // $data['token'] = reset($token);
        // return $data;
        // // // $token = JWTAuth::getToken();
        // // $user = JWTAuth::decode($data['token']);
        // // var_dump($user);die;
        // return $this->respondWithToken($token);
	}



	//退出
    public function logout(Request $request)
    {
    	$f = fopen('a.txt','w');
    	if(flock($f,LOCK_EX  | LOCK_NB))
		{
  
  			flock($f,LOCK_UN);
  			echo '123';return;
		}
		echo '321';die;
    	// auth('api')->logout();

     //    return response()->json(['message' => 'Successfully logged out']);
    }
    
    //获取人物信息
    public function getAuthUser(Request $request)
    {
    	// $token = JWTAuth::getToken();
     //    $user = JWTAuth::decode($token);
     //    dd($user);    
    	// $a = JWTAuth::parseToken()->authenticate();
    	// var_dump($a);die;
    	
    	try{
    		$token = JWTAuth::getToken();
    		dd($token);
	        $user = JWTAuth::decode($token);
	        dd($user->get('foo')->info);    
    	}catch(\Exception $e){
    		return response()->json(['message' => $e->getMessage()]);
    	}
    	
    	// return response()->json(auth('api')->user());
    }

    //统一返回
    protected function respondWithToken($token)
    {
    	return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }
}
