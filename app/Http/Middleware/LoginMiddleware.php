<?php

namespace App\Http\Middleware;

use App\Repositories\PermissionRepository;
use Closure;
use Illuminate\Support\Facades\Auth;

class LoginMiddleware
{
    private $permissionRepository;

    public function __construct(PermissionRepository $permissionRepo)
    {
        $this->permissionRepository = $permissionRepo;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // dd(Auth::check());
        if (Auth::check()) {
            // logined
            $role = Auth::user()->usersRoles()->first()->role;
            $permissions = $this->permissionRepository->with(['menu'])->findWhere([
                'role_id' => $role->id,
                'can_access' => 1,
            ])->sortBy('order');

            session(['permission' => $permissions]);
                // dd('next');
            return $next($request);
        } else {
          
            session()->put(['redirect' => $request->path()]);
            return redirect()->route('login');
        }

    }
}
