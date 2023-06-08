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
use App\Models\User;

class Member extends Model implements HasMedia
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use InteractsWithMedia;
    use Auditable;
    use HasFactory;

    public const LGA_SELECT = [
    ];

    public const NATIONALITY_SELECT = [
    ];

    public const PLACE_OF_BIRTH_SELECT = [
    ];

    public const STATE_OF_ORIGIN_SELECT = [
    ];

    public const COUNTRY_OF_BIRTH_SELECT = [
    ];

    public const GENDER_SELECT = [
        'male'   => 'Male',
        'female' => 'Female',
    ];


    public const MAILING_SETUP_OPERATION_CODE = [
        1 => 'Nofication on Joining Department',
        2 => 'Joining Department Approval',
        3 => 'Joining Department Disapproval',
        4 => 'Delist a member from a department',
        5 => 'Notification For Approintment',
        6 => 'Approintment Approval',
        7 => 'Approintment Disapproval',
        8 => 'Notification for Meetings',
        9 => 'Notification On Issue Management',

    ];


    public const MAILING_SETUP_CATEGORY = [
        'member' => 'Member',
        'department' => 'Department'
    ];

    public function getAgeAttribute()
    {
        return Carbon::parse($this->attributes['date_of_birth'])->age;
    }

    public const MARITAL_STATUS_SELECT = [
        'divorced'           => 'Divorced',
        'divorced_remarried' => 'Divorced/Remarried',
        'engaged'            => 'Engaged',
        'married'            => 'Married',
        'widower'            => 'Widower',
        'widower_remarried'  => 'Widower/Remarried',
        'single'             => 'Single',
        'single_parent'      => 'Single Parent',
        'widow'              => 'Widow',
        'widow_remarried'    => 'Widow/Remarried',
    ];

    public $table = 'members';

    protected $appends = [
        'image',
    ];

    protected $dates = [
        'date_of_birth',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title_id',
        'member_name',
        'middlename',
        'mobile',
        'email',
        'date_of_birth',
        'age',
        'gender',
        'marital_status',
        'employment_status_id',
        'born_in_nigeria',
        'place_of_birth',
        'country_of_birth',
        'nationality',
        'state_of_origin',
        'lga',
        'address_1',
        'address_2',
        'nearest_bus_stop',
        'created_by_id',
        'affinity_group',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function createdByChildren()
    {
        return $this->hasMany(Child::class, 'created_by_id', 'id');
    }

    public function createdByMembersAffinityGroups()
    {
        return $this->hasMany(MembersAffinityGroup::class, 'created_by_id', 'id');
    }

    public function fatherNameChildren()
    {
        return $this->hasMany(Child::class, 'father_name_id', 'id');
    }

    public function mothersNameChildren()
    {
        return $this->hasMany(Child::class, 'mothers_name_id', 'id');
    }

    public function membersInAttendanceAttendanceManagements()
    {
        return $this->belongsToMany(AttendanceManagement::class);
    }

    public function getImageAttribute()
    {
        $file = $this->getMedia('image')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function title()
    {
        return $this->belongsTo(Title::class, 'title_id');
    }

    public function getDateOfBirthAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDateOfBirthAttribute($value)
    {
        $this->attributes['date_of_birth'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function employment_status()
    {
        return $this->belongsTo(EmploymentStatus::class, 'employment_status_id');
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    // public function user()
    // {
    //     return $this->belongsTo(User::class, 'created_by_id');
    // }

    // public function setMaritalStatusAttribute($value)
    // {
    //     $this->attributes['marital_status'] = $value;

    //     // Check if the authenticated user exists
    //     if (auth()->check()) {
    //         // Get the authenticated user
    //         $user = auth()->user();

    //         // Check if the user's current role is not "Single" and the member's marital status is "Single"
    //         if ($user->role !== 'Single' && $value === 'Single') {
    //             // Update the user's role to "Single"
    //             $user->role = 'Single';
    //             $user->save();
    //         }
    //     }
    // }
}
