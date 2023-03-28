<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property int $customer_id
 * @property int $gift_card_id
 * @property string $payment_date
 * @property string $expiress_date
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class CustomerGiftCard extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'customer_gift_card';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['customer_id', 'gift_card_id', 'payment_date', 'expiress_date', 'created_at', 'updated_at', 'deleted_at'];
}
