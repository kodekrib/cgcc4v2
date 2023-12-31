<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VenueAccessory extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'venue_accessories';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'accessories',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function accessoriesEquipmentVenues()
    {
        return $this->belongsToMany(Venue::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
