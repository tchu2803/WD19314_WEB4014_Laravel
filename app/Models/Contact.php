<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    //
    use HasFactory, SoftDeletes;
    protected $table = 'contacts';
    protected $fillable = [
        'ho_ten',
        'email',
        'so_dien_thoai',
        'tin_nhan',
        'ma_khach_hang',
        'trang_thai'
    ];

    protected $dates = ['deleted_at'];
    
}