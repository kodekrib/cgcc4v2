<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mailing extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public const JOB_MAILING_LIST_SELECT = [
        'yes' => 'Yes',
        'no'  => 'No',
    ];

    public $table = 'mailings';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'job_mailing_list',
        'area_of_specialization_id',
        'job_level_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function area_of_specialization()
    {
        return $this->belongsTo(AreaOfSpecialization::class, 'area_of_specialization_id');
    }

    public function job_level()
    {
        return $this->belongsTo(JobLevel::class, 'job_level_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
