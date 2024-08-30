<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = "products";
    protected $primaryKey= "id";
    protected $keyType = "int";

    public $timestamps = true;
    public $incrementint = true;

    protected $fillable = [
        "product_name",
        "category",
        "price",
        "discount"
    ];


}
