<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\User\UserResource;
use Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;

class UserController extends Controller
{
    protected $userservice;

    public function __construct(UserService $userservice)
    {
        $this->userservice = $userservice;
    }

    public function registration(Request $request)
    {
       $validator = Validator::make($request->all(), [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'deviceName' => 'required',
            'deviceId'=> 'required',
            'deviceToken' => 'required',
            'deviceType' => 'required',
        ]);
        if($validator->fails()){
            $messages = $validator->messages();
            return $this->apiResponse('Here is some error',[],422,[],$messages);
        }
        $data = [];
        $data['first_name'] = $request->first_name;
        $data['last_name'] = $request->last_name;
        $data['email'] = $request->email;
        $data['password'] = $request->password;
        $userObj =  $this->userservice->create($data);
        $data['deviceName'] = $request->deviceName;
        $data['deviceId'] = $request->deviceId;
        $data['deviceToken'] = $request->deviceToken;
        $data['deviceType'] = $request->deviceType;
        $data['user_id'] = $userObj->id; 
        $this->userservice->createFcm($data);
        $userObj->token = $userObj->createToken($userObj->email)->accessToken->token;
        $welcome = new WelcomeMail();
        $this->fireMail($userObj->email,$welcome,null);
        return $this->apiResponse('You have been Sucessfully Registered',new UserResource($userObj),201,[],[]);
    }

    public function login(Request $request)
    {
       
        $validator = Validator::make(request()->all(),[
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string', 'min:8'],
            'deviceName' => 'required',
            'deviceId'=> 'required',
            'deviceToken' => 'required',
            'deviceType' => 'required',
        ]);
        if ($validator->fails()) { 
            $messages = $validator->messages();
            return $this->apiResponse('Here is some error',new \StdClass(),401,[],$messages);
        }  
        
        $user = $this->userservice->Checkauth($request->email, $request->password);
        $data = [];
        if($user)
        {
        $data['deviceName'] = $request->deviceName;
        $data['deviceId'] = $request->deviceId;
        $data['deviceToken'] = $request->deviceToken;
        $data['deviceType'] = $request->deviceType;
        $data['user_id'] = $user->id;
        $this->userservice->checkfcm($data);
        }
        if($user) {
            return $this->apiResponse('Welcome',new UserResource($user),200,[],[]);        
        } else {
            return $this->apiResponse('Credentials does not match',[],401,[],['message'=>[__('Credentials does not match')]]);
        }
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $data = $request->all();
        $user = $this->userservice->updateProfile($user,$data);
        return $this->apiResponse('Your profile is updated',new UserResource($user),200,[],[]);
    }

    public function logout(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'device_type' => 'required|in:Android,iOS',
            'device_token' => 'required',
        ]);
        if ($validator->fails()) {
            $messages = $validator->messages();
            return $this->apiResponse('Here is some error',new \StdClass(),401,[],$messages);
        }
        $token = $request->user()->token();
        $token->revoke();
        $this->userservice->delfcm($request->device_token);
        return $this->apiResponse('Logged out',[],200,[],[]);
    }

    public function forgotPasswd(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);
        if ($validator->fails()) {
            $messages = $validator->messages();
            return $this->apiResponse('Here is some error',new \StdClass(),401,[],$messages);
        }
        $reset = $this->userservice->forgotpasswd($request, $request->email);
        if($reset)
        {
            return $this->apiResponse('Password reset Otp has been sent to your registered email',[],200,[],[]);
         }else{
            return $this->apiResponse('This mail is not registered',[],200,[],[]);
         }

    }

    public function checkOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'otp' => 'required|integer|min:6',
        ]);
        if ($validator->fails()) {
            $messages = $validator->messages();
            return $this->apiResponse('Here is some error',new \StdClass(),401,[],$messages);
        }

        return $this->userservice->matchOtp($request->email,$request->otp);
    }

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        if ($validator->fails()) {
            $messages = $validator->messages();
            return $this->apiResponse('Here is some error',new \StdClass(),401,[],$messages);
        }
        return $this->userservice->Updatepassword($request->user_id,$request->password);
    }

    public function resendOtp(Request $request)
    {
        return $this->forgotPasswd($request);
    }
}
