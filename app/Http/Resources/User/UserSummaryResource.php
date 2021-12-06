<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserSummaryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [

            "id"=> $this->id,
            "mobile"=> $this->mobile,
            "first_name"=> $this->first_name,
            "middle_name"=> $this->middle_name ?? null,
            "last_name"=> $this->last_name,
            "full_name"=>  $this->full_name,
            "dob"=>  $this->dob,
            'age' => $this->age,
            "gender"=>  $this->gender,
            "email"=>  $this->email,
            "profile_picture"=>  $this->profile_picture,
            "email_verified_at"=>  $this->email_verified_at,
            "mobile_verified_at"=>  $this->mobile_verified_at,
            "is_active"=>  $this->is_active,
            "is_test_account"=>  $this->is_test_account,
            "is_flagged_email"=>  $this->is_flagged_email,
            "deleted_at"=>  $this->deleted_at,
            "created_at"=>  $this->created_at,
            "updated_at"=>  $this->updated_at,
        ];
    }
}
