<?php

namespace App\Services;

use App\Services\BaseService;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;

class AddressService extends BaseService
{


    public function createAdds($data)
    {

        $address = new Address();
        $address->user_id = Auth::user()->id;
        $address->address_type = $data->address_type;
        $address->address = $data->address;
        $address->street_no = $data->street_no;
        $address->house_flat_no = $data->house_flat_no;
        $address->landmark = $data->landmark;
        $address->latitude = $data->latitude;
        $address->longitude = $data->longitude;
        $address->is_default = $data->is_default;
        $address->save();
        return $address;
    }

    public function addIndex($auth_id)
    {
        $address = Address::where('user_id', $auth_id)->where('is_del', '0')->get();
        return $address;
    }
    /**
* One liner description
* @param [type] [name] [short purpose]
* @param [type] [name] [short purpose]
* @return [type] [short purpose]
*/
    public function updateadd($data)
    {

        $address = Address::where('id', $data->address_id)->where('user_id', Auth::user()->id)->first();
        if ($address != null) {
            $address = Address::find($data->address_id);
            $address->address_type = $data->address_type;
            $address->address = $data->address;
            $address->street_no = $data->street_no;
            $address->house_flat_no = $data->house_flat_no;
            $address->landmark = $data->landmark;
            $address->latitude = $data->latitude;
            $address->longitude = $data->longitude;
            $address->is_default = $data->is_default;
            $address->save();
            return $address;
        } else {
            return null;
        }
    }

    public function deladd($data)
    {

        $address = Address::where('id', $data->address_id)->where('user_id', Auth::user()->id)->first();
        if ($address != null) {
            Address::where('id', $data->address_id)->update([
                'is_del' => '1',
            ]);
            return 'success';
        } else {
            return null;
        }
    }
}
