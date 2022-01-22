<?php
namespace App\Services;

use App\Models\Setting;
use App\Models\User;
use App\Models\UserSetting;
use App\Models\UserSocial;
use App\Notifications\User\OtpNotification;
use Http;
use Bouncer;
use Hash;
//use Ichtrojan\Otp\Otp;
use RuntimeException;
use Traversable;
use DB;
/**
 * @todo work in progress
 */
class UserService {

    public const AUTH_ERR_OTP = 2;

    protected $deviceTokenService;

    public function __construct(DeviceTokenService $deviceTokenService)
    {
        $this->deviceTokenService = $deviceTokenService;
    }

    // public function updateProfilePicture(User $user, $picture) {
    //     /**
    //      * Remove all images
    //      */
    //     $user->clearMediaCollection(User::MEDIA_COL_PROFILE);
    //     $user->addMedia($picture)
    //         ->toMediaCollection(User::MEDIA_COL_PROFILE);
    //      return $user;
    // }


    public function updateProfile(User $user, $data) 
    {
        $user->first_name = $data['first_name'] ?? null;
        $user->last_name = $data['last_name'] ?? null;
        $user->mobile = $data['mobile'] ?? null;

        $user->save();

        return $user;
    }

    /**
     * @todo configurable paginaion
     */
    public function search(array $filter = [], array $sort = [], bool $isPaginate = true) : Traversable
    {
        $userQuery = User::query();

        if (!empty($filter['role'])) {
            $userQuery->whereIs($filter['role']);
        }
        if (!empty($filter['name'])) {
            $userQuery->where('name', 'like', "{$filter['name']}%");
        }
        if (!empty($filter['email'])) {
            $userQuery->where('email', $filter['email']);
        }

        if (!empty($sort)) {
            $userQuery->orderBy($sort['sort'], $sort['order']);
        }

        if ($isPaginate) {
            return $userQuery->paginate(5);
        } else {    
            return $userQuery->get();
        }
    }

    // public function fetchByMobile(string $mobile) : User {
    //     return User::where('mobile', $mobile)->firstOrFail();
    // }
    
    
    public function fetchUserByRole($role, $isPaginate = false)
    {
        if ($isPaginate) {
            return User::whereIs($role)->paginate(10);
        } else {
            return User::whereIs($role)->get();
        }
        
    }

    public function fetchByEmail(string $email): User
    {
        return User::where('email', $email)->firstOrFail();
    }

    public function create(array $data): User
    {
            $user = new User();
            $user->first_name = $data['first_name'];
            $user->last_name = $data['last_name'];
            //$user->mobile = $data['mobile'];
            $user->email = $data['email'];
            $user->password = Hash::make($data['password']);
            $user->save();

            $user->assign('user');
            return $user;
    }

    public function checkauth($email, $password)
    {
        $user = User::where('email', $email)->where('status', 'active')->first();
        // dd($user);
       if ($user){
            if (Hash::check($password,$user->password,)){
                //dd($user->createToken($user->email)->accessToken);
                $user->token = $user->createToken('auth')->accessToken;
                return $user;
            }
        }else {
            return null;
        }
    }
    
    public function assignRoles(User $user, $roles) 
    {
        //dd($roles);
        try {
            DB::transaction(function () use ($user, $roles) {
                foreach ($user->getRoles() as $role) {
                    $user->retract($role);
                }
        
                foreach ($roles as $role) {
                    $user->assign($role);
                }
            });
        } catch (\Exception $exp) {
            dd($exp);
        }
       

        return $user;
    }

    public function assignAbilities(User $user, $abilities) 
    {
        //dd($roles);
        try {
            DB::transaction(function () use ($user, $abilities) {
                foreach ($user->getAbilities() as $ability) {
                    $user->disallow($ability);
                }
        
                foreach ($abilities as $ability) {
                    $user->allow($ability);
                }
            });
        } catch (\Exception $exp) {
            dd($exp);
        }
       

        return $user;
    }
}