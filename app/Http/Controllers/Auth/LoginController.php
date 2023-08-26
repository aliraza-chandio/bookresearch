<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Hash;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except(['changePassword','changePasswordStore','profile','profileUpdate','logout']);
    }
    public function changePassword()
    {

      return view('auth.change-password');
    }

    public function changePasswordStore(Request $request)
    {

        $this->validate($request, [
            'old_password' => 'required',
            'new_password' => 'required',
            'password_confirmation' => 'required',
        ]);
        $hashedPassword = Auth::user()->password;

        if (\Hash::check($request->old_password , $hashedPassword )) {

            if (!\Hash::check($request->new_password , $hashedPassword)) {
                if ($request->new_password == $request->password_confirmation) {
                    $users =User::find(Auth::user()->id);
                    $users->password = Hash::make($request->new_password);
                    User::where( 'id' , Auth::user()->id)->update(array( 'password' =>  $users->password));
                    session()->flash('success','Password updated successfully');
                    return redirect()->back();
                }
                else
                {
                    session()->flash('error','Confirm Password does not match');
                    return redirect()->back();
                }
            }
            else
            {
                session()->flash('error','New Password can not be the old Password!');
                return redirect()->back();
            }
        }
        else
        {
            session()->flash('error','Old Password does not matched ');
            return redirect()->back();
        }

    }
    public function profile()
    {
        return view('profile');
    }
    public function profileUpdate(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
        ]);
        User::where( 'id' , Auth::user()->id)->update(array( 'name' =>  $request->name,'email' =>  $request->email));
        session()->flash('success','Profile updated successfully');
        return redirect()->back();

    }
    public function login(Request $request)
    {
        $this->validateLogin($request);
        if($request->email){
            $user = User::where('email',$request->email)->where('role','subscriber')->first();
            if(!empty($user)){
            dd($user);
                return redirect('/login')->with('error',"You don't have permission to login admin panel");
            }
        }
        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            if ($request->hasSession()) {
                $request->session()->put('auth.password_confirmed_at', time());
            }

            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }
}
