<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use Auditable;
    use HasFactory;

    public $table = 'departments';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'dept_code',
        'department_name',
        'department_email',
        'hod_id',
        'organization_type_id',
        'created_at',
        'inactive',
        'active',
        'pending',
        'updated_at',
        'deleted_at',
        'created_by_id',
    ];

    public function departmentJoinDepartments()
    {
        return $this->hasMany(JoinDepartment::class, 'department_id', 'id');
    }

    public function hod()
    {
        return $this->belongsTo(Member::class, 'hod_id');
    }

    public function organization_type()
    {
        return $this->belongsTo(OrganizationType::class, 'organization_type_id');
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
