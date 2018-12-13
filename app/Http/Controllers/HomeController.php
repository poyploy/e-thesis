<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Prettus\Repository\Criteria\RequestCriteria;

class HomeController extends Controller
{

    /** @var  UsersRepository */
    private $usersRepository;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $userRepo)
    {
        //$this->middleware('auth');
        $this->usersRepository = $userRepo;
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
        return view('auth.login');
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

            return redirect()->route('home');
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
