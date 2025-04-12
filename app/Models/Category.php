<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Category extends Model
{
    //Để sử dụng đc factory tạo dữ liệu mẫu ta cần phải sử  dụng thư viện use Illuminate\Database\Eloquent\Factories\HasFactory;
    use HasFactory, SoftDeletes;
    // Quy định model này thao tác với bảng nào 
    protected $table = 'categories';
    // Các trường trong bảng đều phải đưa vào fillable 
    protected $fillable = [
        'ten_danh_muc',
        'trang_thai'
    ];

    protected $dates = ['deleted_at'];

    //tạo quan hệ 1-n với bảng product 
    public function products(){
        return $this->hasMany(Product::class,'ma_danh_muc');
    }
    
}