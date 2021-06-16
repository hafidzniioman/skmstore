<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'users_id',
        'address',        
        'payment',
        'tags',
        'total_price',
        'shipping_price',
        'status',
    ];

    //menyambungkan ke model user
    public function user(){
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    //menyambungkan ke model transactionItem
    public function item(){
        return $this->hasMany(TransactionItem::class, 'transactions_id', 'id');
    }
}
