<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BankAccountDetail extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'bank_account_details';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'account_name',
        'account_type_id',
        'currency_id',
        'account_number',
        'sort_code',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function account_type()
    {
        return $this->belongsTo(BankAccountType::class, 'account_type_id');
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
