<?php

namespace App\Services\Contracts;

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
interface UserServiceInterface {
    public function updateProfile(User $user, $data);
    public function search(array $filter = [], array $sort = [], bool $isPaginate = true) : Traversable;
    public function fetchUserByRole($role, $isPaginate = false);
    public function fetchByEmail(string $email): User;
    public function create(array $data): User;
    public function checkauth($email, $password);
    public function assignRoles(User $user, $roles);
    public function assignAbilities(User $user, $abilities);
}