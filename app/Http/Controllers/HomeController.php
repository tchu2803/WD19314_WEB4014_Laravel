<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Customer;
use App\Models\Post;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\OrderMail;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;


class HomeController extends Controller
{
    private Product $product;

    private Banner $banner;

    private Post $post;

    private Review $review;

    private Category $category;

    private Contact $contact;

    private Customer $customer;

    public function __construct()
    {
        $this->product = new Product();
        $this->banner = new Banner();
        $this->post = new Post();
        $this->review = new Review();
        $this->category = new Category();
        $this->contact = new Contact();
        $this->customer = new Customer();
    }

    public function home(Request $request)
    {
        $products = $this->product->latest()->take(8)->get();

        $posts = $this->post->latest()->take(4)->get();

        $banners = Banner::all();

        $reviews = $this->review->with('customer')->orderBy('so_sao', 'desc')->take(10)->get();

        return view('clients.home', compact('products', 'posts', 'banners', 'reviews'));
    }

    public function index(Request $request)
    {
        $query = Product::with('category');
        if ($request->filled('ten_san_pham')) {
            $query->where('ten_san_pham', 'LIKE', '%' . $request->ten_san_pham . '%');
        }

        if ($request->filled('ma_danh_muc')) {
            $query->where('ma_danh_muc', $request->ma_danh_muc);
        }

        if ($request->filled('min_price') && $request->filled('max_price')) {
            $query->whereBetween('gia', [$request->min_price, $request->max_price]);
        }

        if ($request->filled('sort_price')) {
            $query->orderBy('gia', $request->sort_price);
        }

        $products = $query->paginate(10);

        $categories = Category::all();

        return view('clients.products.index',  compact('products', 'categories'));
    }

    public function show($id)
    {

        $product = Product::with('category')->findOrFail($id);

        // 5 sản phẩm cùng danh mục, ngoại trừ chính sản phẩm đang xem
        $relatedProducts = Product::where('ma_danh_muc', $product->ma_danh_muc)
            ->where('id', '!=', $product->id)
            ->latest()
            ->take(5)
            ->get();

        $reviews = $product->reviews()->with('customer')->latest()->get();

        return view('clients.products.show', compact('product', 'relatedProducts', 'reviews'));
    }

    public function store(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $dataValidate = $request->validate([
            'danh_gia' => 'required|string|max:50',
            'so_sao' => 'required|string|max:5|min:0',
        ]);

        Review::create([
            'ma_san_pham' => $product->id,
            'ma_khach_hang' => Auth::user()->id,
            'danh_gia' => $dataValidate['danh_gia'],
            'so_sao' => $dataValidate['so_sao'],
        ]);

        return redirect()->route('clients.products.show', ['id' => $id])->with('success', 'Đánh giá thành công');
    }

    public function post()
    {
        $posts = Post::all();
        return view('clients.posts.index', compact('posts'));
    }

    public function contact()
    {
        return view('clients.contacts.send');
    }

    public function viewCart()
    {
        $cartItems = Cart::with('customer', 'product')->get();

        return view('clients.carts.index', compact('cartItems'));
    }

    public function addToCart(Request $request)
{
    $user = Auth::user();

    $product = Product::findOrFail($request->ma_san_pham);
    $quantity = $request->input('so_luong', 1);

    $cartItem = Cart::where('ma_khach_hang', $user->id)
                    ->where('ma_san_pham', $product->id)
                    ->first();

    if ($cartItem) {
        $cartItem->so_luong += $quantity;
        $cartItem->save();
    } else {
        Cart::create([
            'ma_khach_hang' => $user->id,
            'ma_san_pham' => $product->id,
            'so_luong' => $quantity,
            'gia' => $product->gia,
            'gia_khuyen_mai' => $product->gia_khuyen_mai,
        ]);
    }

    return redirect()->back();
}

    public function deleteCart($id)
    {
        $cartItem = Cart::findOrFail($id);
        $cartItem->delete();

        return redirect()->back()->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng!');
    }

    public function updateCart(Request $request, $id)
    {
        $cartItem = Cart::findOrFail($id);
    
        if ($request->has('increase')) {
            $cartItem->so_luong += 1;
        } elseif ($request->has('decrease')) {
            if ($cartItem->so_luong > 1) {
                $cartItem->so_luong -= 1;
            }
        }
    
        $cartItem->save();
    
        return redirect()->back();
    }

    public function checkout()
    {
        $cartItems = Cart::with('customer', 'product')->get();

    $total = $cartItems->sum(function ($item) {
        $price = $item->gia_khuyen_mai ?? $item->gia;
        return $price * $item->so_luong;
    });

    $subtotal = $cartItems->sum(function ($item) {
        return $item->gia * $item->so_luong;
    });

    // Nếu bạn dùng phí vận chuyển mặc định
    $shippingFee = session('shipping_fee', 30000);
    $tongThanhToan = $total + $shippingFee;

    return view('clients.orders.index', compact('cartItems', 'subtotal', 'total', 'shippingFee', 'tongThanhToan'));
    }

    public function placeOrder(Request $request)
    {
        $validated = $request->validate([
            'ho_ten' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'so_dien_thoai' => 'required|string|min:9|max:20',
            'dia_chi' => 'required|string|max:500',
        ]);
    
        $user = Auth::user();

        $cartItems = Cart::where('ma_khach_hang', $user->id)->get();
    
        if ($cartItems->isEmpty()) {
            return redirect()->route('clients.carts.index')->with('error', 'Giỏ hàng của bạn đang trống.');
        }
    
        $total = $cartItems->sum(function ($item) {
            $price = $item->gia_khuyen_mai ?? $item->gia;
            return $price * $item->so_luong;
        });
    
        $order = Order::create($validated + [
            'ma_khach_hang' => $user->id,
            'tong_tien' => $total,
            'trang_thai' => 'chờ xử lý',
            'phuong_thuc_thanh_toan' => $request->phuong_thuc_thanh_toan,
        ]);
    
        Mail::to($order->email)->queue(new OrderMail($order));
    
        Cart::where('ma_khach_hang', $user->id)->delete();
    
        return redirect()->route('clients.orders.successOrder', ['id' => $order->id]);
    }

    public function successOrder($id)
    {
        $order = Order::findOrFail($id);
        return view('clients.orders.success', compact('order'));
    }
    
}
