<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmploymentDetail extends Model
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use Auditable;
    use HasFactory;

    public const STATE_SELECT = [
    ];

    public const COUNTRY_SELECT = [
    ];

    public $table = 'employment_details';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'employer_name',
        'employer_address',
        'employer_address_2',
        'country',
        'state',
        'city',
        'position_held',
        'industry_id',
        'subsector_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by_id',
    ];

    public function industry()
    {
        return $this->belongsTo(IndustrySector::class, 'industry_id');
    }

    public function subsector()
    {
        return $this->belongsTo(SubSector::class, 'subsector_id');
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
