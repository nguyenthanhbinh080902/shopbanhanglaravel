<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'product_name', 'meta_keywords', 'product_quantity', 
        'product_sold', 'product_slug', 'category_id', 'brand_id',
        'product_desc', 'product_content', 'product_price',
        'product_image', 'product_status', 
    ];
    protected $primaryKey = 'product_id';
    protected $table = 'tbl_product';

    public function product(){
        return $this->belongsTo(product::class);
    }
}
