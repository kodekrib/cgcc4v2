<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubSector extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'sub_sectors';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'industry_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function industry()
    {
        return $this->belongsTo(IndustrySector::class, 'industry_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
