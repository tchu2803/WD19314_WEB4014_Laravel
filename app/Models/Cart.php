<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    //Để sử dụng đc factory tạo dữ liệu mẫu ta cần phải sử  dụng thư viện use Illuminate\Database\Eloquent\Factories\HasFactory;
    use HasFactory;
    // Quy định model này thao tác với bảng nào 
    protected $table = 'carts';
    // Các trường trong bảng đều phải đưa vào fillable 
    protected $fillable = [
        'ma_khach_hang',
        'ma_san_pham',
        'so_luong',
        'gia',
        'gia_khuyen_mai'
    ];

    public function product()
{
    return $this->belongsTo(Product::class, 'ma_san_pham');
}

public function customer()
{
    return $this->belongsTo(Customer::class, 'ma_khach_hang');
}
    
}