<?php
namespace App\Services;
use App\Services\BaseService;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;
use Silber\Bouncer\Database\Ability;
use Silber\Bouncer\Database\Role;

class RbacService {
  
    public function searchRole(array $filter=[], array $sort=[], bool $isPaginate=true) {
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

    public function searchAbilities(array $filter=[], array $sort=[], bool $isPaginate=true) {
        $abilityQuery = Ability::query();

        if(!empty($filter['role'])) {
            $abilityQuery->whereIs($filter['role']);
        } 

        if($isPaginate) {
            return $abilityQuery->paginate(5);
        } else {
            
        return $abilityQuery->get();
        }
    }

    public function fetchRolesById(array $idList) {
        return Role::whereIn('id', $idList)->get();
    }

    
    public function fetchAbilitiesById(array $idList) {
        return Ability::whereIn('id', $idList)->get();
    }

  
}