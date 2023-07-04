<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Meeting extends Model implements HasMedia
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use InteractsWithMedia;
    use Auditable;
    use HasFactory;

    public $table = 'meetings';

    public const GROUP = [
        'all' => 'All Members',
        'department' => 'Department',
        'affinity_group' => 'Affinity Group',
        'hod' => 'Heads of department (HOD)'
    ];

    public const AFFINITY_GROUP = [
        'Legacy Fellowship' => 'Legacy Fellowship',
        'Crown of Glory' => ' Crown of Glory',
        'Couple Fellowship' => 'Couple Fellowship',
        '686 Fellowship' => '686 Fellowship',
    ];

    protected $appends = [
        'meeting_minutes',
        'files',
    ];

    protected $dates = [
        //'date_of_meeting',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'meeting_type_id',
        'date_of_meeting',
        'time_duration',
        'meeting_title',
        'selected_groups',
        'department_id',
        'affinity_group',
        're_occurence',
        're_occurence_json',
        'addictional_json',
        'start_time',
        'venue_id',
        'attendees_id_list',
        'approval_status',
        'created_by_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function meeting_type()
    {
        return $this->belongsTo(MeetingType::class, 'meeting_type_id');
    }

    // public function getDateOfMeetingAttribute($value)
    // {
    //     return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    // }

    // public function setDateOfMeetingAttribute($value)
    // {
    //     $this->attributes['date_of_meeting'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    // }

    public function venue()
    {
        return $this->belongsTo(Venue::class, 'venue_id');
    }

    // public function attendees()
    // {
    //     return $this->belongsTo(Member::class, 'attendees_id');
    // }

    public function getMeetingMinutesAttribute()
    {
        return $this->getMedia('meeting_minutes');
    }

    public function getFilesAttribute()
    {
        return $this->getMedia('files');
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
