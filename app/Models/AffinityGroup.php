<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AffinityGroup extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public const STATUS_SELECT = [
        'active'    => 'Active',
        'inactive'  => 'Inactive',
        'cancelled' => 'Cancelled',
    ];

    public $table = 'affinity_groups';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'affinity_group',
        'affinity_group_code',
        'criteria',
        'head_of_group_id',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function head_of_group()
    {
        return $this->belongsTo(User::class, 'head_of_group_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
