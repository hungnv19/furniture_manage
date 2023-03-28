<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $code
 * @property int $type
 * @property float $amount
 * @property float $balance
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class GiftCard extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'gift_card';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['code', 'type', 'amount', 'balance', 'status', 'created_at', 'updated_at', 'deleted_at'];

    public function customerGiftCards()
    {
        return $this->hasMany(CustomerGift::class);
    }

    public function customers()
    {
        return $this->hasManyThrough(Customer::class, CustomerGiftCard::class, 'gift_card_id', 'id', 'id', 'customer_id');
    }
}
