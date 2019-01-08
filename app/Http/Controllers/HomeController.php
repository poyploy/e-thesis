<?php

namespace App\Http\Controllers;

use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use App\Repositories\UserRoleRepository;
use Carbon\Carbon;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Prettus\Repository\Criteria\RequestCriteria;
use Validator;

class HomeController extends Controller
{

    /** @var  UsersRepository */
    private $usersRepository;

    /** @var  UserRoleRepository */
    private $userRoleRepository;

    private $roleRepository;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $userRepo, UserRoleRepository $userRoleRepo, RoleRepository $roleRepo)
    {
        //$this->middleware('auth');
        $this->usersRepository = $userRepo;
        $this->roleRepository = $roleRepo;
        $this->userRoleRepository = $userRoleRepo;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('home');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        //Flash::success('Register successfully.');
        // dd(session()->all());
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function registerStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:users|max:255|email',
            'name' => 'required',
            'role' => 'required',
            'password' => 'required|min:6|max:18',
            'password_confirmation' => 'required|same:password|min:6|max:18',
            'student_id' => 'digits:8|required_if:role,3|unique:users',

        ]);

        if ($validator->fails()) {
            return redirect()->route("register")
                ->withErrors($validator)
                ->withInput();
        }

        // dd($request->all());
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $input['updated_at'] = Carbon::now()->toDateTimeString();

        $user = $this->usersRepository->create($input);

        if (empty($user)) {
            return redirect()->route("register")
                ->withErrors(['error' => 'register fail'])
                ->withInput();
        }
        $role = $input['role'];
        $this->userRoleRepository->create([
            'user_id' => $user->id,
            'role_id' => $role,
            'status' => 1,
        ]);

        Flash::success('Register successfully.');

        return redirect()->route('login');
    }

    /**
     * Store a newly created Roles in storage.
     *
     * @param CreateRolesRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $this->usersRepository->pushCriteria(new RequestCriteria($request));
        $user = $this->usersRepository->findWhere([
            'email' => $email,
        ])->first();

        $checked = Hash::check($password, $user['password']);
        if (isset($user) && $checked) {
            Auth::login($user);

            if (session()->has('redirect')) {
                $url = session()->get('redirect');
                session()->forget('redirect');
                return redirect($url);
            }

            $roleId = Auth::user()->usersRoles()->first()->role_id;
            $role = $this->roleRepository->findWithoutFail($roleId);
            if ($role->name == "ADMIN") {
                return redirect()->route('rooms.index');
            } else if ($role->name == "TEACHER") {
                return redirect()->route('basicInformations.index');
            } else if ($role->name == "STUDENT") {
                return redirect()->route('basicInformations.index');
            }

            return redirect()->route('rooms.index');
        }
        return view('auth.login', compact('email'))
            ->withErrors(['email' => 'username or password invalid']);
    }
    /**
     * Store a newly created Roles in storage.
     *
     * @param CreateRolesRequest $request
     *
     * @return Response
     */
    public function destroy(Request $requst)
    {
        // if (Auth::check()) {
        Auth::logout();
        session()->flush();
        // }
        return redirect()->route('login');
    }

}
