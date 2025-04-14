<?php 
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

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
        $faker = Faker::create();
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

        $customer = Customer::create([
            'ho_ten' => $data['name'],
            'email' => $data['email'],
            'hinh_anh' => $faker->imageUrl(200, 200, 'people', true, 'Faker'),
            'so_dien_thoai' => $faker->phoneNumber,
            'dia_chi' => $faker->address
        ]);

        Auth::login($user);

        return redirect()->route('admins.dashboard');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function redirectToGoogle()
{
    return Socialite::driver('google')->redirect();
}
public function handleGoogleCallback()
{
    try {
        $faker = Faker::create();
        $googleUser = Socialite::driver('google')->user();

        // Kiểm tra xem người dùng đã tồn tại
        $user = User::where('email', $googleUser->getEmail())->first();

        if (!$user) {
            // Tạo mới user
            $user = User::create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'password' => bcrypt(Str::random(16)),
                'role' => User::ROLE_USER
            ]);

            // Tạo mới customer tương ứng
            $customer = Customer::create([
                'ho_ten' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'hinh_anh' => $googleUser->getAvatar(),
                'so_dien_thoai' => $faker->phoneNumber,
                'dia_chi' => $faker->address
            ]);
        }

        Auth::login($user);
        return redirect()->intended('/');

    } catch (\Exception $e) {
        // Ghi lại lỗi vào log để kiểm tra chi tiết
        Log::error('Lỗi đăng nhập Google: ' . $e->getMessage());
        return redirect('/showLogin')->withErrors(['msg' => 'Đăng nhập Google thất bại!']);
    }
}

}