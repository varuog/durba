<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\RbacService;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected UserService $userService;
    protected RbacService $rbacService;
    
    public function __construct(UserService $userService, RbacService $rbacService)
    {
        $this->middleware('auth');
        $this->userService = $userService;
        $this->rbacService = $rbacService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filter['role'] = request()->query('role');
        $filter['name'] = request()->query('name');
        $filter['email'] = request()->query('email');
        $sort['sort'] = request()->query('sort', 'id');
        $sort['order'] = request()->query('order', 'desc');

        $users = $this->userService->search($filter, $sort);
        $allRoles = $this->rbacService->search([], [], false);

        //dd($users, $allRoles);
        return view('user.list', compact('users', 'allRoles'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function assignRole(Request $request, User $user) {
        $rolesId = $request->input('roles_id');
        //dd($rolesId);
        $roles = $this->rbacService->fetchByIdList($rolesId);
        $this->userService->assignRoles($user, $roles);

        //session()->flash('message-success')
        return redirect()->back();
    }
}
