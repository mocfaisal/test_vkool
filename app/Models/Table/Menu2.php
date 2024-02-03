<?php

namespace App\Models\Table;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu2 extends Model
{
    use HasFactory;

    // public $timestamps = false;
    public const CREATED_AT = 'date_create';
    public const UPDATED_AT = 'date_update';

    protected $table = "cp_menu";
    protected $id = "id";
    // protected $fillable = ['*'];
    protected $guarded = ['id'];
}
