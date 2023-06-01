<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Venue extends Model
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use Auditable;
    use HasFactory;

    public const STATUS_SELECT = [
        'processing' => 'Processing',
        'booked'     => 'Booked',
        'available'  => 'Available',
    ];

    public $table = 'venues';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'venue_name',
        'venue_description',
        'venue_capacity',
        'size',
        'venue_location_id',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by_id',
    ];

    public function venueBookings()
    {
        return $this->hasMany(Booking::class, 'venue_id', 'id');
    }

    public function accessories_equipments()
    {
        return $this->belongsToMany(VenueAccessory::class);
    }

    public function accessibility_features()
    {
        return $this->belongsToMany(AccessibilityFeature::class);
    }

    public function venue_location()
    {
        return $this->belongsTo(Location::class, 'venue_location_id');
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
