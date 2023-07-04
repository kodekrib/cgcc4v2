<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cihmember extends Model
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use Auditable;
    use HasFactory;

    public const GENDER_SELECT = [
        'male'   => 'Male',
        'female' => 'Female',
    ];

    public $table = 'cihmembers';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'member_name',
        'gender',
        'email',
        'phone_number',
        'zone_id',
        'cih_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by_id',
    ];

    public function zone()
    {
        return $this->belongsTo(Cihzone::class, 'zone_id');
    }

    public function cih()
    {
        return $this->belongsTo(Centre::class, 'cih_id');
    }

    public function created_by()
    {
        return $this->belongsTo(Member::class, 'created_by_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
