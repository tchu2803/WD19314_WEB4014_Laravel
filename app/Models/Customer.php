<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Customer extends Model
{
    //Để sử dụng đc factory tạo dữ liệu mẫu ta cần phải sử  dụng thư viện use Illuminate\Database\Eloquent\Factories\HasFactory;
    use HasFactory, SoftDeletes;
    // Quy định model này thao tác với bảng nào 
    protected $table = 'customers';
    // Các trường trong bảng đều phải đưa vào fillable 
    protected $fillable = [
        'ho_ten',
        'email',
        'so_dien_thoai',
        'dia_chi',
        'hinh_anh',
        'ma_khach_hang',
    ];

    protected $dates = ['deleted_at'];
    
    public function reviews()
{
    return $this->hasMany(Review::class, 'ma_khach_hang');
}
}