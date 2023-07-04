<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Outreach extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'outreaches';

    protected $dates = [
        'date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'description',
        'date',
        'time',
        'location_id',
        'contact_person_id',
        'type_id',
        'active',
        'completed',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDateAttribute($value)
    {
        $this->attributes['date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function contact_person()
    {
        return $this->belongsTo(User::class, 'contact_person_id');
    }

    public function type()
    {
        return $this->belongsTo(OutreachType::class, 'type_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
