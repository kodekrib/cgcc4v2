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

class AttendanceManagement extends Model implements HasMedia
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use InteractsWithMedia;
    use Auditable;
    use HasFactory;

    public const GENDER_CATEGORY_SELECT = [
        'male'   => 'Male',
        'female' => 'Female',
    ];

    public const AGE_CATEGORY_SELECT = [
        'adult'    => 'Adult',
        'youth'    => 'Youth',
        'teenager' => 'Teenager',
    ];

    public $table = 'attendance_managements';

    protected $appends = [
        'external_files',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'meeting_type_id',
        'meeting_title_id',
        'dateData',
        'timeData',
        'summary_report',
        'members_in_attendancesL',
        'members_in_absence',
        'members_in_excuse',
        'age_category',
        'gender_category',
        'state_of_the_flock',
        'created_by_id',
        'cih_centre_id',
        'present',
        'absent',
        'excused',
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

    public function meeting_title()
    {
        return $this->belongsTo(Meeting::class, 'meeting_title_id');
    }

    // public function getDateAttribute($value)
    // {
    //     return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    // }

    // public function setDateAttribute($value)
    // {
    //     $this->attributes['date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    // }

    public function getExternalFilesAttribute()
    {
        return $this->getMedia('external_files');
    }

    // public function members_in_attendances()
    // {
    //     return $this->belongsToMany(Member::class);
    // }

    public function created_by()
    {
        return $this->belongsTo(Member::class, 'created_by_id');
    }

    public function cih_centre()
    {
        return $this->belongsTo(Cihzone::class, 'cih_centre_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
