<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = ['property_id', 'title', 'amount', 'expense_date', 'status', 'description'];
    protected $casts = ['amount'=>'decimal:2','expense_date'=>'datetime'];
}
