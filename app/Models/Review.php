<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Review extends Model
{
    //Để sử dụng đc factory tạo dữ liệu mẫu ta cần phải sử  dụng thư viện use Illuminate\Database\Eloquent\Factories\HasFactory;
    use HasFactory, SoftDeletes;
    // Quy định model này thao tác với bảng nào 
    protected $table = 'reviews';
    // Các trường trong bảng đều phải đưa vào fillable 
    protected $fillable = [
        'danh_gia',
        'so_sao',
        'ma_khach_hang',
        'ma_san_pham',
    ];

    protected $dates = ['deleted_at'];

    public function customer()
{
    return $this->belongsTo(Customer::class, 'ma_khach_hang');
}

    public function product()
    {
        return $this->belongsTo(Product::class, 'ma_san_pham');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'ma_khach_hang'); // 'ma_khach_hang' là khóa ngoại
    }

}