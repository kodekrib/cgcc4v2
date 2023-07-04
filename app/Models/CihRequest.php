<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CihRequest extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'cih_requests';

    protected $dates = [
        'date_of_request',
        'date_of_request_event',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'date_of_request',
        'requester_name_id',
        'types_of_request_id',
        'date_of_request_event',
        'approve',
        'decline',
        'pending',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getDateOfRequestAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDateOfRequestAttribute($value)
    {
        $this->attributes['date_of_request'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function requester_name()
    {
        return $this->belongsTo(Member::class, 'requester_name_id');
    }

    public function types_of_request()
    {
        return $this->belongsTo(CihTypesOfRequest::class, 'types_of_request_id');
    }

    public function getDateOfRequestEventAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDateOfRequestEventAttribute($value)
    {
        $this->attributes['date_of_request_event'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
