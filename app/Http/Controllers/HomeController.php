<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Post;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    private Product $product;

    private Banner $banner;

    private Post $post;

    private Review $review;

    private Category $category;

    private Contact $contact;

    public function __construct()
    {
        $this->product = new Product();
        $this->banner = new Banner();
        $this->post = new Post();
        $this->review = new Review();
        $this->category = new Category();
        $this->contact = new Contact();
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
}
