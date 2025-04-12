<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Banner extends Model
{
    //Để sử dụng đc factory tạo dữ liệu mẫu ta cần phải sử  dụng thư viện use Illuminate\Database\Eloquent\Factories\HasFactory;
    use HasFactory, SoftDeletes;
    // Quy định model này thao tác với bảng nào 
    protected $table = 'banners';
    // Các trường trong bảng đều phải đưa vào fillable 
    protected $fillable = [
        'ten_banner',
        'hinh_anh',
        'mo_ta'
    ];

    protected $dates = ['deleted_at'];

    
}