<?php

namespace App\Models\Table;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tr_penjualan extends Model {
    use HasFactory;
    protected $table = "tr_penjualan";
    protected $id = "id";
    // protected $fillable = ['*'];
    protected $guarded = ['id', 'created_at', 'updated_at'];
}
