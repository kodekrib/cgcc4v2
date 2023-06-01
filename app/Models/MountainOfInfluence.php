<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MountainOfInfluence extends Model
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use Auditable;
    use HasFactory;

    public $table = 'mountain_of_influences';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'my_mountain_of_culture_id',
        'created_by_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function my_mountain_of_culture()
    {
        return $this->belongsTo(MountainsOfInfluence::class, 'my_mountain_of_culture_id');
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
