<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FirstTimer extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public const CITY_SELECT = [
    ];

    public const STATE_SELECT = [
    ];

    public const COUNTRY_SELECT = [
    ];

    public const GENDER_SELECT = [
        'male'   => 'Male',
        'female' => 'Female',
    ];

    public const ATS_MODE_SELECT = [
        'physical' => 'Physical',
        'online'   => 'Online',
    ];

    public const JOIN_CGCC_SELECT = [
        'yes'       => 'Yes',
        'no'        => 'No',
        'undecided' => 'Undecided',
    ];

    public const START_ATS_SELECT = [
        'yes'       => 'Yes',
        'no'        => 'No',
        'undecided' => 'Undecided',
    ];

    public $table = 'first_timers';

    protected $dates = [
        'service',
        'date_of_birth',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'service',
        'surname',
        'first_name',
        'middle_name',
        'date_of_birth',
        'marital_status_id',
        'occupation',
        'gender',
        'age',
        'phone_number',
        'email',
        'residential_address',
        'nearest_bus_stop',
        'country',
        'state',
        'city',
        'join_cgcc',
        'start_ats',
        'ats_mode',
        'prayer_request',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getServiceAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setServiceAttribute($value)
    {
        $this->attributes['service'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getDateOfBirthAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDateOfBirthAttribute($value)
    {
        $this->attributes['date_of_birth'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function marital_status()
    {
        return $this->belongsTo(MaritalStatus::class, 'marital_status_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
