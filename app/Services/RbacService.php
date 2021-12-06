<?php
namespace App\Services;
use App\Services\BaseService;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;
use Silber\Bouncer\Database\Role;

class RbacService {
  
    public function search(array $filter=[], array $sort=[], bool $isPaginate=true) {
        $roleQuery = Role::query();

        if(!empty($filter['role'])) {
            $roleQuery->whereIs($filter['role']);
        } 

        if($isPaginate) {
            return $roleQuery->paginate(5);
        } else {
            
        return $roleQuery->get();
        }
    }

    public function fetchByIdList(array $idList) {
        return Role::whereIn('id', $idList)->get();
    }
}