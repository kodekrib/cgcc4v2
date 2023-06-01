<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empowerment extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public const TRAININGS_SELECT = [
        'yes' => 'Yes',
        'no'  => 'No',
    ];

    public const COOPERATIVE_SELECT = [
        'yes' => 'Yes',
        'no'  => 'No',
    ];

    public const BUSINESS_ADVISORY_SELECT = [
        'yes' => 'Yes',
        'no'  => 'No',
    ];

    public const CONTRIBUTION_FREQUENCY_SELECT = [
        'monthly'   => 'Monthly',
        'quarterly' => 'Quarterly',
        'yearly'    => 'Yearly',
    ];

    public const START_MONTH_SELECT = [
        'january'   => 'January',
        'february'  => 'February',
        'march'     => 'March',
        'april'     => 'April',
        'may'       => 'May',
        'june'      => 'June',
        'july'      => 'July',
        'august'    => 'August',
        'september' => 'September',
        'october'   => 'October',
        'november'  => 'November',
        'december'  => 'December',
    ];

    public $table = 'empowerments';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'ats_membership_no_id',
        'cooperative',
        'contribution_amount',
        'contribution_frequency',
        'start_year',
        'start_month',
        'business_advisory',
        'advisory_team',
        'trainings',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function ats_membership_no()
    {
        return $this->belongsTo(AtsMembershipRecord::class, 'ats_membership_no_id');
    }

    public function training_needs()
    {
        return $this->belongsToMany(EmpowermentTrainingNeed::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
