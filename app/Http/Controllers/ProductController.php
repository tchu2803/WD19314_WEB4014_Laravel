<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    private Category $category;

    private Product $product;
    public function __construct()
    {
        $this->category = new Category();
        $this->product = new Product();
    }
    public function index(Request $request)
    {
        $query = Product::with('category');
        if($request->filled('ma_san_pham')){
            $query->where('ma_san_pham', 'LIKE', '%' . $request->ma_san_pham . '%');
        }
        // Tương tự thực hiện tìm kiếm theo sản phẩm :
        // Không dùng all vì khi dùng all nó phải dùng for để lấy category => dư thừa dữ liệu 
        $products = $query->paginate(10);

        return view('admins.products.index',  compact('products'));
    }

    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);
        return view('admins.products.show', compact('product'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admins.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // // Khởi tạo 1 đối tượng 
        // $product = new Product();

        // // Lấy dữ liệu từ form
        // $product->ma_san_pham = $request->ma_san_pham;
        // $product->ten_san_pham = $request->ten_san_pham;
        // $product->ten_san_pham = $request->ten_san_pham;
        // $product->category_id = $request->category_id;
        // $product->gia = $request->gia;
        // $product->gia_khuyen_mai = $request->gia_khuyen_mai;
        // $product->so_luong = $request->so_luong;
        // $product->ngay_nhap = $request->ngay_nhap;
        // $product->mo_ta = $request->mo_ta;
        // $product->trang_thai = $request->trang_thai;

        // // Xử lý hình ảnh
        // if ($request->hasFile('hinh_anh')) {
        //     $imagePath = $request->file('hinh_anh')->store('images/products', 'public');
        //     $product->hinh_anh = $imagePath;
        // }

        // // Lưu hình ảnh
        // $product->save();

        // Validate

        $dataValidate = $request->validate([
            'ma_san_pham' => 'required|string|max:20|unique:products,ma_san_pham',
            'ten_san_pham' => 'required|string|max:255',
            'ma_danh_muc' => 'required|exists:categories,id',
            'hinh_anh' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
            'gia' => 'required|numeric|min:0|max:99999999',
            'gia_khuyen_mai' => 'nullable|numeric|min:0|lt:gia',
            'so_luong' => 'required|integer|min:1',
            'mo_ta' => 'nullable|string',
            'ngay_nhap' => 'required|date',
            'trang_thai' => 'required|boolean'
        ]);

        if ($request->hasFile('hinh_anh')) {
            $imagePath = $request->file('hinh_anh')->store('images/products', 'public');
            $dataValidate['hinh_anh'] = $imagePath;
        }

        Product::create($dataValidate);
        return redirect()->route('admins.products.index')->with('success' , 'Thêm sản phẩm thành công');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admins.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {   
        $product = Product::findOrFail($id);

        // Validate
        $dataValidate = $request->validate([
            'ma_san_pham' => 'required|string|max:20|unique:products,ma_san_pham,' . $id,
            'ten_san_pham' => 'required|string|max:255',
            'ma_danh_muc' => 'required|exists:categories,id',
            'hinh_anh' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
            'gia' => 'required|numeric|min:0|max:99999999',
            'gia_khuyen_mai' => 'nullable|numeric|min:0|lt:gia',
            'so_luong' => 'required|integer|min:1',
            'mo_ta' => 'nullable|string',
            'ngay_nhap' => 'required|date',
            'trang_thai' => 'required|boolean'
        ]);

        // Xử lý hình ảnh
        if ($request->hasFile('hinh_anh')) {
            $imagePath = $request->file('hinh_anh')->store('images/products', 'public');
            $dataValidate['hinh_anh'] = $imagePath;

            if ($product->hinh_anh)
            {
                Storage::disk('public')->delete($product->hinh_anh);
            }
        }

        $product->update($dataValidate);
        return redirect()->route('admins.products.index')->with('success' , 'Cập nhật sản phẩm thành công');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admins.products.index')->with('success' , 'Xóa sản phẩm thành công');
    }

    public function thungrac()
    {
        $products = Product::onlyTrashed()->get();
        return view('admins.products.thungrac', compact('products'));
    }

    public function restore($id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);
        $product->restore();
        return redirect()->route('admins.products.thungrac')->with('success' , 'Khôi phục sản phẩm thành công');
    }

   public function forceDelete($id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);
        if ($product->hinh_anh)
        {
            Storage::disk('public')->delete($product->hinh_anh);
        }
        $product->forceDelete();
        return redirect()->route('admins.products.thungrac')->with('success' , 'Xóa vĩnh viễn sản phẩm thành công');
    }
}
