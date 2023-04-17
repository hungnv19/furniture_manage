<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $details
 * @property string $amount
 * @property string $expense_date
 * @property string $created_at
 * @property string $updated_at
 */
class Expense extends Model
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
    protected $fillable = ['details', 'amount', 'expense_date', 'created_at', 'updated_at'];
}
