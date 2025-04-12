<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use function Psy\debug;

class BannerController extends Controller
{
    private Banner $banner;

    public function __construct()
    {
        $this->banner = new Banner();
    }

    public function index(Request $request)
    {
        $query = Banner::query();
        if($request->filled('ten_banner')){
            $query->where('ten_banner', 'LIKE', '%' . $request->ten_banner . '%');
        }
        // Tương tự thực hiện tìm kiếm theo sản phẩm :
        // Không dùng all vì khi dùng all nó phải dùng for để lấy category => dư thừa dữ liệu 
        $banners = $query->paginate(10);

        return view('admins.banners.index', compact('banners'));
    }

    public function create()
    {
        return view('admins.banners.create');
    }
    
    public function show($id)
    {
        $banner = Banner::query()->findOrFail($id);
        return view('admins.banners.show', compact('banner'));
    }

    public function store(Request $request)
{
    
    $dataValidate = $request->validate([
        'ten_banner' => 'required|string|max:255',
        'hinh_anh' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        'mo_ta' => 'nullable|string',
    ]);

    
    if ($request->hasFile('hinh_anh')) {
        $imagePath = $request->file('hinh_anh')->store('images/banners', 'public');
        $dataValidate['hinh_anh'] = $imagePath;
    }

  
    Banner::create($dataValidate);

    return redirect()->route('admins.banners.index')->with('success', 'Thêm banner thành công');
}

public function edit($id)
{
    $banner = Banner::findOrFail($id); 
    return view('admins.banners.edit', compact('banner'));
}

public function update(Request $request, $id)
{
    $banner = Banner::findOrFail($id);

    
    $dataValidate = $request->validate([
        'ten_banner' => 'required|string|max:255',
        'hinh_anh' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        'mo_ta' => 'nullable|string',
    ]);

    
    if ($request->hasFile('hinh_anh')) {
        $imagePath = $request->file('hinh_anh')->store('images/banners', 'public');
        $dataValidate['hinh_anh'] = $imagePath;

        
        if ($banner->hinh_anh) {
            Storage::disk('public')->delete($banner->hinh_anh);
        }
    }

    
    $banner->update($dataValidate);

    return redirect()->route('admins.banners.index')->with('success', 'Cập nhật banner thành công');
}

public function destroy($id)
{
    $banner = Banner::findOrFail($id);

    $banner->delete();
    return redirect()->route('admins.banners.index')->with('success', 'Xóa banner thành công');
}

public function thungrac()
{
    $banners = Banner::onlyTrashed()->get(); 
    return view('admins.banners.thungrac', compact('banners'));
}

public function restore($id)
{
    $banner = Banner::onlyTrashed()->findOrFail($id); 
    $banner->restore(); 
    return redirect()->route('admins.banners.thungrac')->with('success', 'Khôi phục banner thành công');
}

public function forceDelete($id)
{
    $banner = Banner::onlyTrashed()->findOrFail($id); 

    
    if ($banner->hinh_anh) {
        Storage::disk('public')->delete($banner->hinh_anh);
    }

    $banner->forceDelete();
    return redirect()->route('admins.banners.thungrac')->with('success', 'Xóa vĩnh viễn banner thành công');
}

}