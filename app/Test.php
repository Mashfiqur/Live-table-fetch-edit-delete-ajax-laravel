<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $table = 'products';
    protected $fillable = ['name','sku','barcode','purchase_price','selling_price'];
}
