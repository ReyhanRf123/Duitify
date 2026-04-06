<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['user_id', 'account_id', 'category_id', 'saving_goal_id', 'type', 'amount', 'description', 'attachment', 'date'];

    public function account() { return $this->belongsTo(Account::class); }
    public function savingGoal() { return $this->belongsTo(SavingGoal::class); }
}
