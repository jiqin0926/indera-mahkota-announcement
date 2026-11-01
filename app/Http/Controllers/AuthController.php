<?php
namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

/**
 * @group Authentication
 *
 * Register, login and logout.
 */
class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $v = Validator::make($request->all(), [
            'name'     => ['required', 'string', 'max:100'],
            'email'    => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        if ($v->fails()) {
            return back()->withErrors($v)->withInput();
        }

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'user',
        ]);

        $request->session()->put('user_id', $user->id);
        $request->session()->put('user_name', $user->name);
        $request->session()->put('user_role', $user->role);

        return redirect()->route('dashboard')->with('success', 'Account created. Welcome!');
    }

    public function login(Request $request)
    {
        $v = Validator::make($request->all(), [
            'email' => ['required','email'],
            'password' => ['required','string','min:6'],
        ]);
        if ($v->fails()) {
            return back()->withErrors($v)->withInput();
        }

        $user= User::where('email', $request->email)->first();

        if (!$user|| !Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Invalid credentials.')->withInput();
        }
        // put minimal identity into the session
        $request->session()->put('user_id', $user->id);
        $request->session()->put('user_name', $user->name);
        $request->session()->put('user_role', $user->role);
        // redirect to intended or default
        $intended= $request->session()->pull('intended', route('dashboard'));
        return redirect($intended)->with('success', 'Welcome back.');
    }
    public function logout(Request$request)
    {
        $request->session()->flush();
        $request->session()->regenerate(true);
        return redirect()->route('login.show')->with('success', 'You have been logged out.');
    }
}