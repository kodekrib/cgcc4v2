<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AtsMembership extends Model
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use Auditable;
    use HasFactory;

    public $table = 'ats_memberships';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'created_by_id',
        'ats_membership_number_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function created_by()
    {
        return $this->belongsTo(Member::class, 'created_by_id');
    }

    public function ats_membership_number()
    {
        return $this->belongsTo(AtsMembershipRecord::class, 'ats_membership_number_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
