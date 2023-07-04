<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Child extends Model
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use Auditable;
    use HasFactory;

    public const GENDER_SELECT = [
        'male'   => 'Male',
        'female' => 'Female',
    ];

    public const RELATIONSHIP_SELECT = [
        'son'           => 'Son',
        'daughter'      => 'Daughter',
        'step-son'      => 'Step Son',
        'step-daughter' => 'Step Daughter',
        'other'         => 'Other',
    ];

    public $table = 'children';

    protected $dates = [
        'date_of_birth',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'full_names',
        'mobile',
        'email',
        'relationship',
        'specify',
        'gender',
        'position_in_family',
        'date_of_birth',
        'father_name_id',
        'mothers_name_id',
        'created_by_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getDateOfBirthAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDateOfBirthAttribute($value)
    {
        $this->attributes['date_of_birth'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function father_name()
    {
        return $this->belongsTo(Member::class, 'father_name_id');
    }

    public function mothers_name()
    {
        return $this->belongsTo(Member::class, 'mothers_name_id');
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
