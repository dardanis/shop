<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignUpRequest;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Category;
use Illuminate\Http\Request;
use App\User;
use App\Mailers\AppMailer;
use Illuminate\Support\Facades;
use Wishlist;
use Cart;

class AuthController extends Controller
{

    use AuthenticatesAndRegistersUsers;

    protected $loginPath = "/login";
    protected $redirectPath = '/';


    /**
     * Create a new authentication controller instance.
     *
     * @param  \Illuminate\Contracts\Auth\Guard $auth
     * @param  \Illuminate\Contracts\Auth\Registrar $registrar
     * @return void
     */
    public function __construct(Guard $auth, Registrar $registrar)
    {
        $this->auth = $auth;
        $this->registrar = $registrar;

        $this->middleware('guest',
            [
                'except' =>
                    ['getLogout', 'resendEmail', 'activateAccount']
            ]);
    }

    public function getLogin()
    {

        $redirecturl = "";
        if (isset($_GET['redirecturl'])) {
            $redirecturl = $_GET['redirecturl'];
        }
        $categories = Category::with('translations', 'subcategories')->whereHas('products', function ($q) {
            $q->where('status', '!=', 0);
        })->get();

        return view('auth.login')->with('categories', $categories)->with('redirecturl', $redirecturl);

    }

    public function postLogin(Request $request)
    {
        $redirecturl = $request->input('redirecturl');

        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);

        $field = filter_var($request->input('email'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $request->merge([$field => $request->input('email')]);
        $credentials = $request->only($field, 'password');

        if ($this->auth->attempt($credentials, $request->has('remember'))) {
            if (!\Auth::user()->active) {

                return view('auth.guest_activate')
                    ->with('email', \Auth::user()->email)
                    ->with('date', \Auth::user()->created_at);
            } else {

                $this->checkIfUserHasActiveStripe(\Auth::user()->id);
                if ($redirecturl != "") {
                    return redirect()->intended($redirecturl);
                } else {
                    return redirect()->intended($this->redirectPath());
                }

            }

        }

        return redirect($this->loginPath())
            ->withInput($request->only('email', 'remember'))
            ->withErrors([
                'email' => $this->getFailedLoginMessage(),
            ]);
    }


    public function checkIfUserHasActiveStripe($userId)
    {

    }

    public function getRegister()
    {
        return view('new_template.client.pages.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function postRegister(SignUpRequest $request, AppMailer $mailer)
    {

        $activation_code = str_random(60) . $request->input('username');
        $user = new User;
        $user->profile = 'img/users/profile.png';
        $user->avatar = 'img/users/avatar-mini.png';
        $user->name = $request->input('name');
        $user->lastname = $request->input('lastname');
        $user->email = $request->input('email');
        $user->gender = $request->input('gender');
        $user->user_type = $request->input('user_type');
        $user->password = bcrypt($request->input('password'));
        $user->username = $request->input('username');
        $user->role_id = 2;
        $user->activation_code = $activation_code;
        $user->token = $activation_code;
        if ($user->save()) {


            $mailer->sendEmailConfirmationTo($user);
            \Session::flash('confirm_email', 'Please confirm your email address.');
            return redirect()->action('Auth\\AuthController@getLogin');

        } else {

            \Session::flash('message', \Lang::get('notCreated'));
            return redirect()->back()->withInput();

        }

    }

    public function confirmEmail($token)
    {
        User::whereToken($token)->firstOrFail()->confirmEmail();

        \Session::flash('confirmed_email', 'You are now confirmed. Please login.');
        return redirect('login');
    }

    public function getLogout()
    {
        Cart::clear();
        $this->auth->logout();

        return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/');
    }

    public function sendEmail(User $user)
    {
        $data = array(
            'name' => $user->name,
            'code' => $user->activation_code,
        );

        \Mail::queue('emails.activateAccount', $data, function ($message) use ($user) {
            $message->subject(\Lang::get('auth.pleaseActivate'));
            $message->to($user->email);
        });
    }

    public function resendEmail()
    {
        $user = \Auth::user();
        if ($user->resent >= 3) {
            return view('auth.tooManyEmails')
                ->with('email', $user->email);
        } else {
            $user->resent = $user->resent + 1;
            $user->save();
            $this->sendEmail($user);
            return view('auth.activateAccount')
                ->with('email', $user->email);
        }
    }

    public function activateAccount($code, User $user)
    {

        if ($user->accountIsActive($code)) {
            \Session::flash('message', \Lang::get('auth.successActivated'));
            return redirect('/');
        }

        \Session::flash('message', \Lang::get('auth.unsuccessful'));
        return redirect('/');

    }

}
