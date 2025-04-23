<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'ma_khach_hang',
        'ho_ten',
        'email',
        'so_dien_thoai',
        'dia_chi',
        'tong_tien',
        'trang_thai',
        'phuong_thuc_thanh_toan',
    ];
}
