<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property int $product_id
 * @property string $product_name
 * @property int $product_quantity
 * @property string $product_price
 * @property string $sub_total
 * @property string $created_at
 * @property string $updated_at
 */
class Pos extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['product_id', 'product_name', 'product_quantity', 'product_price', 'sub_total', 'created_at', 'updated_at'];
}
