<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JoinDepartment extends Model
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use Auditable;
    use HasFactory;

    public const PRIMARY_FUNCTION_SELECT = [
        'Yes' => 'Yes',
        'No'  => 'No',
    ];

    public const MEMBER_TYPE_SELECT = [
        'ordinary_member' => 'Ordinary Member',
        'exco'            => 'Exco',
    ];

    public const APPROVAL_STATUS = [
        0 => 'Pending',
        1 => 'Disapproved',
        2 => 'Approved',
        3 => 'Delist'
    ];

    public $table = 'join_departments';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'department_id',
        'member_type',
        'primary_function',
        'approval_status',
        'status',
        'reason',
      	'member_Id',
        'created_by_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

  public function member()
    {
        return $this->belongsTo(Member::class, 'member_Id');
    }
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
