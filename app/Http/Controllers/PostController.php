<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    private Post $post;

    public function __construct()
    {
        $this->post = new Post();
    }

    public function index(Request $request)
    {
        $query = Post::query();
        if($request->filled('tieu_de')){
            $query->where('tieu_de', 'LIKE', '%' . $request->tieu_de . '%');
        }
        // Tương tự thực hiện tìm kiếm theo sản phẩm :
        // Không dùng all vì khi dùng all nó phải dùng for để lấy category => dư thừa dữ liệu 
        $posts = $query->paginate(10);

        return view('admins.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admins.posts.create');
    }

    public function show($id)
    {
        $post = Post::query()->findOrFail($id);
        return view('admins.posts.show', compact('post'));
    }

    public function store(Request $request)
    {
        $dataValidate = $request->validate([
            'tieu_de' => 'required|string|max:20|unique:posts,tieu_de',
            'noi_dung' => 'required|string|max:255',
            'trang_thai' =>'required|boolean',
            'tac_gia' => 'required|string|max:255',
            'hinh_anh' => 'nullable|image|mimes:jpeg,png,jpg,gif'
        ]);

        if ($request->hasFile('hinh_anh')) {
            $imagePath = $request->file('hinh_anh')->store('images/posts', 'public');
            $dataValidate['hinh_anh'] = $imagePath;
        }

        Post::create($dataValidate);

        return redirect()->route('admins.posts.index')->with('success', 'Thêm bài viết thành công');
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('admins.posts.edit' , compact('post'));
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $dataValidate = $request->validate([
            'tieu_de' => 'required|string|max:255|unique:posts,tieu_de,' . $id,
            'noi_dung' => 'required|string|max:1000',
            'trang_thai' =>'required|boolean',
            'tac_gia' => 'required|string|max:255',
            'hinh_anh' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        if ($request->hasFile('hinh_anh')) {
            $imagePath = $request->file('hinh_anh')->store('images/posts', 'public');
            $dataValidate['hinh_anh'] = $imagePath;

            if ($post->hinh_anh)
            {
                Storage::disk('public')->delete($post->hinh_anh);
            }
        }

        $post->update($dataValidate);

        return redirect()->route('admins.posts.index')->with('success', 'Cập nhật bài viết thành công');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        $post->delete();

        return redirect()->route('admins.posts.index')->with('success' , 'Xóa bài viết thành công');
    }

    public function thungrac()
    {
        $posts = Post::onlyTrashed()->get();
        return view('admins.posts.thungrac', compact('posts'));
    }

    public function restore($id)
    {
        $post = Post::onlyTrashed()->findOrFail($id);

        $post->restore();
        return redirect()->route('admins.posts.thungrac')->with('success' , 'Khôi phục bài viết thành công');
    }

   public function forceDelete($id)
    {
        $post = Post::onlyTrashed()->findOrFail($id);
        if ($post->hinh_anh)
        {
            Storage::disk('public')->delete($post->hinh_anh);
        }
        $post->forceDelete();
        return redirect()->route('admins.posts.thungrac')->with('success' , 'Xóa vĩnh viễn bài viết thành công');
    }
}