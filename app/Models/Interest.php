<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Interest extends Model
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use Auditable;
    use HasFactory;

    public $table = 'interests';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'other_sports',
        'social_causes',
        'entrepreneurial_interests',
        'industry_sector_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by_id',
    ];

    public function interests()
    {
        return $this->belongsToMany(Sport::class);
    }

    public function industry_sector()
    {
        return $this->belongsTo(IndustrySector::class, 'industry_sector_id');
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
