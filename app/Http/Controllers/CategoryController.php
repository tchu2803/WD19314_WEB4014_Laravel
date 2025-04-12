<?php 

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;


class CategoryController extends Controller
{
    private Category $category;

    public function __construct()
    {
        $this->category = new Category();
    }

    public function index(Request $request)
    {
        $query = Category::query();
        if($request->filled('ten_danh_muc')){
            $query->where('ten_danh_muc', 'LIKE', '%' . $request->ten_danh_muc . '%');
        }
        // Tương tự thực hiện tìm kiếm theo sản phẩm :
        // Không dùng all vì khi dùng all nó phải dùng for để lấy category => dư thừa dữ liệu 
        $categories = $query->paginate(10);

        return view('admins.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admins.categories.create');
    }

    public function show($id)
    {
        $category = Category::query()->findOrFail($id);
        return view('admins.categories.show', compact('category'));
    }

    public function store(Request $request)
    {
        $dataValidate = $request->validate([
            'ten_danh_muc' => 'required|string|max:20',
            'trang_thai' => 'required|boolean'
        ]);

        Category::create($dataValidate);

        return redirect()->route('admins.categories.index')->with('success', 'Thêm danh mục thành công');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admins.categories.edit' , compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $dataValidate = $request->validate([
            'ten_danh_muc' => 'required|string|max:20',
            'trang_thai' => 'required|boolean'
        ]);

        $category->update($dataValidate);

        return redirect()->route('admins.categories.index')->with('success', 'Cập nhật danh mục thành công');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        $category->delete();

        return redirect()->route('admins.categories.index')->with('success' , 'Xóa danh mục thành công');
    }

    public function thungrac()
    {
        $categories = Category::onlyTrashed()->get();
        return view('admins.categories.thungrac', compact('categories'));
    }

    public function restore($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);

        $category->restore();
        return redirect()->route('admins.categories.thungrac')->with('success' , 'Khôi phục sản phẩm thành công');
    }

   public function forceDelete($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);

        $category->forceDelete();
        return redirect()->route('admins.categories.thungrac')->with('success' , 'Xóa vĩnh viễn sản phẩm thành công');
    }
}