<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property int $customer_id
 * @property string $date
 * @property string $start_time
 * @property string $end_time
 * @property boolean $status
 * @property string $note
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class Appointment extends Model
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
    protected $fillable = ['customer_id', 'date', 'start_time', 'end_time', 'status', 'note', 'created_at', 'updated_at', 'deleted_at'];
}
