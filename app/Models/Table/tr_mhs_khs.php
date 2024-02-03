<?php

namespace App\Models\table;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tr_mhs_khs extends Model
{
    use HasFactory;
    protected $table = "tr_mhs_khs";
    protected $id = "id";
    // protected $fillable = ['*'];
    protected $guarded = ['id', 'created_at', 'updated_at'];
}
