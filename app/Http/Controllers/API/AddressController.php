<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\AddressService;
use Illuminate\Support\Facades\Auth;
use Validator;
class AddressController extends Controller
{
    protected $addressservice;
    public function __construct(AddressService $addressservice)
    {
        return $this->addressservice = $addressservice;
        
    }
    public function AddAddress(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'address_type' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'street_no' => ['required', 'string'],
            'house_flat_no' => ['required', 'string'],
            'landmark' =>['required','string'],
            'latitude'=> 'required',
            'longitude' => 'required',
            'is_default' => 'required',
        ]);
        if($validator->fails()){
            $messages = $validator->messages();
            return $this->addressservice->apiResponse('Here is some error',[],422,[],$messages);
        }
        $address = $this->addressservice->CreateAdds($request);
        return $this->apiResponse('New address added to your address book',$address,200,[],[]);
    }

    public function AddressIndex()
    {
        $address_list =  $this->addressservice->AddIndex(Auth::user()->id);
        return  $this->addressservice->apiResponse('Address Book',$address_list,200,[],[]);
        
    }

    public function UpdateAddress(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'address_id' => 'required',
        ]);
        if($validator->fails()){
            $messages = $validator->messages();
            return $this->addressservice->apiResponse('Here is some error',[],422,[],$messages);
        }
        $address = $this->addressservice->updateadd($request);
        if($address!=null){
            return $this->addressservice->apiResponse('Address Updated',$address,200,[],[]);
        }else{
            return $this->addressservice->apiResponse('Unable to update address',[],402,[],[]);
        }
    }

    public function DelAddress(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'address_id' => 'required',
        ]);
        if($validator->fails()){
            $messages = $validator->messages();
            return $this->apiResponse('Here is some error',[],422,[],$messages);
        }
        $address = $this->addressservice->deladd($request);
        if($address){
          return  $this->addressservice->apiResponse('Your address deleted',[],200,[],[]);
        }else{
          return  $this->addressservice->apiResponse('Address not found',[],404,[],[]);
        }
    }
}
