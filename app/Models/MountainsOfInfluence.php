<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MountainsOfInfluence extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public const STATUS_SELECT = [
        'active'    => 'Active',
        'inactive'  => 'Inactive',
        'cancelled' => 'Cancelled',
    ];

    public $table = 'mountains_of_influences';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'nation',
        'corresponding_mountain',
        'prevailing_culture',
        'counter_culture',
        'counter_culture_text',
        'attributes_of_christ',
        'motivational_gifts',
        'mountain_leader_id',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function mountain_leader()
    {
        return $this->belongsTo(User::class, 'mountain_leader_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
