<?php
namespace App\Services;
use App\Services\BaseService;
use App\Models\Address;
use App\Models\DeviceToken;
use Illuminate\Support\Facades\Auth;

/**
 * @todo
 */
class DeviceTokenService {
    public function add($data) {
            $newfcm = new DeviceToken();
            $newfcm->user_id = $data['user_id'];
            $newfcm->token = $data['deviceToken'];
            $newfcm->device_id = $data['deviceId'];
            $newfcm->device_name = $data['deviceName'];
            $newfcm->device_type = $data['deviceType'];
            $newfcm->save();
            return $newfcm;

    }

    public function checkfcm(array $data)
    {
        $fcm = Fcmtoken::where('user_id',$data['user_id'])->where('token',$data['deviceToken'])->first();
        if($fcm!=null)
        {
            return $fcm;
        }else{
            return $this->UpdateFcm($data);
        }

    }

    public function delfcm($token)
    {
        Fcmtoken::where('token', $token)->delete();
    }

}