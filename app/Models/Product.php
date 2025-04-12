<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    //
    use HasFactory, SoftDeletes;
    protected $table = 'products';
    protected $fillable = [
        'ma_san_pham',
        'ten_san_pham',
        'ma_danh_muc',
        'gia',
        'gia_khuyen_mai',
        'so_luong',
        'ngay_nhap',
        'mo_ta',
        'hinh_anh',
        'trang_thai'
    ];

    protected $dates = ['deleted_at'];
    
    // tạo quan hệ n-1 với bảng category
    public function category(){
        return $this->belongsTo(Category::class,'ma_danh_muc');
    }

    public function reviews()
{
    return $this->hasMany(Review::class, 'ma_san_pham');
}
}