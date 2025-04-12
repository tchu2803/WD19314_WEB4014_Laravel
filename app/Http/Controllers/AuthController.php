<?php 
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function dashboard()
{
    $user = Auth::user();

    if ($user->role !== 'admin') {
        return redirect()->route('login')->withErrors('Bạn không có quyền truy cập vào trang Admin.');
    }
    return view('admins.dashboard', compact('user'));
}
    public function showLogin()
    {
        return view('auths.login');
    }

    public function showRegister()
    {
        return view('auths.register');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'nullable|email',
            'password' => 'nullable'
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
    
            // Kiểm tra vai trò của người dùng
            if ($user->role === 'admin') {
                return redirect()->route('admins.dashboard'); // Chuyển hướng đến trang admin
            } elseif ($user->role === 'user') {
                return redirect()->route('clients.home'); // Chuyển hướng đến trang client
            }
        }

        return back()->withErrors((['email' => 'Thông tin đăng nhập không chính xác']));
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'role' => User::ROLE_USER
        ]);

        Auth::login($user);

        return redirect()->route('admins.dashboard');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}