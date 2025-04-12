<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    private Review $review;
    private Customer $customer;

    private Product $product;
    public function __construct()
    {
        $this->review = new Review();
        $this->customer = new Customer();
        $this->product = new Product();
    }

    public function index(Request $request)
    {
        $query = Review::query();
        if($request->filled('so_sao')){
            $query->where('so_sao', 'LIKE', '%' . $request->so_sao . '%');
        }
        // Tương tự thực hiện tìm kiếm theo sản phẩm :
        // Không dùng all vì khi dùng all nó phải dùng for để lấy category => dư thừa dữ liệu 
        $reviews = $query->paginate(10);

        return view('admins.reviews.index', compact('reviews'));
    }

    public function create()
        {
            return view('admins.reviews.create');
        }

        public function show($id)
        {
            $review = Review::query()->findOrFail($id);
            return view('admins.reviews.show', compact('review'));
        }

        public function store(Request $request)
    {
        $dataValidate = $request->validate([
            'danh_gia' => 'required|string|max:50',
            'so_sao' => 'required|string|max:5|min:0',
        ]);

        Review::create($dataValidate);

        return redirect()->route('admins.reviews.index')->with('success', 'Đánh giá thành công');
    }

    public function edit($id)
    {
        $review = Review::findOrFail($id);
        return view('admins.reviews.edit' , compact('review'));
    }

    public function update(Request $request, $id)
    {
        $review = Review::findOrFail($id);

        $dataValidate = $request->validate([
            'danh_gia' => 'required|string|max:50',
            'so_sao' => 'required|string|max:5|min:0',
        ]);

        $review->update($dataValidate);

        return redirect()->route('admins.reviews.index')->with('success', 'Cập nhật đánh giá thành công');
    }

    public function destroy($id)
    {
        $review = Review::findOrFail($id);

        $review->delete();

        return redirect()->route('admins.reviews.index')->with('success' , 'Xóa đánh giá thành công');
    }

    public function thungrac()
    {
        $reviews = Review::onlyTrashed()->get();
        return view('admins.reviews.thungrac', compact('reviews'));
    }

    public function restore($id)
    {
        $review = Review::onlyTrashed()->findOrFail($id);

        $review->restore();
        return redirect()->route('admins.reviews.thungrac')->with('success' , 'Khôi phục đánh giá thành công');
    }

   public function forceDelete($id)
    {
        $review = Review::onlyTrashed()->findOrFail($id);

        $review->forceDelete();
        return redirect()->route('admins.reviews.thungrac')->with('success' , 'Xóa vĩnh viễn đánh giá thành công');
    }
}