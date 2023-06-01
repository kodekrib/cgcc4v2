<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SpouseDetail extends Model
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use Auditable;
    use HasFactory;

    public const TITLE_SELECT = [
        'mrs' => 'Mrs',
        'Mr'  => 'Mr',
    ];

    public const RELATIONSHIP_SELECT = [
        'wife'    => 'Wife',
        'husband' => 'Husband',
    ];

    public $table = 'spouse_details';

    protected $dates = [
        'date_of_birth',
        'wedding_anniv',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'last_name',
        'first_name',
        'maiden_name',
        'relationship',
        'date_of_birth',
        'wedding_anniv',
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by_id',
    ];

    public function getDateOfBirthAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDateOfBirthAttribute($value)
    {
        $this->attributes['date_of_birth'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getWeddingAnnivAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setWeddingAnnivAttribute($value)
    {
        $this->attributes['wedding_anniv'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
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
