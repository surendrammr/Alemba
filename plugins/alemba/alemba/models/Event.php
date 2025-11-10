<?php namespace Alemba\Alemba\Models;

use Model;

use Carbon\Carbon;

/**
 * Model
 */
class Event extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\SoftDelete;

    public $implement = ['@Renatio.SeoManager.Behaviors.SeoModel'];

    protected $dates = ['startdate', 'finishdate', 'deleted_at'];

    protected $jsonable = ['images'];

    public function getSchemaAttribute()
    {

        // Set PostalAddress as the default location type
        
        switch ($this->location_type) {
            case 'virtual':
                $location_type = 'VirtualLocation';
                $location_attendance = "https://schema.org/OnlineEventAttendanceMode";
                $location_array = [
                  "@type" => $location_type,
                  "url" => $this->registration_url,
                  "name" => $this->location
                ];
                break;
            
            default:
                $location_type = 'Place';
                $location_attendance = "https://schema.org/OfflineEventAttendanceMode";
                $location_array = [
                  "@type" => $location_type,
                  "name" => $this->location,
                  "address" => $this->address
                ];
                break;
        }

        $array = [

            "@context" => "https://schema.org",
            "@type" => "Event",
            "name" => $this->name,
            "startDate" => $this->startdate->format('Y-m-d'),
            "endDate" => $this->finishdate->format('Y-m-d'),
            "url" => "https://alemba.com/events/".$this->slug,
            "description" => $this->intro,
            "eventAttendanceMode" => $location_attendance,
            "location" => $location_array

        ];

        return $array;
    }

    /*
     * Validation
     */
    public $rules = [
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'alemba_alemba_events';

    public $belongsTo = [
        'region' => 'Alemba\Alemba\Models\Region'
    ];

    /**
     * Scope a query to only include published, up-coming events.
     */
    public function scopeActive($query)
    {

        $now = Carbon::now();

        return $query->where('finishdate', '>', $now);
    }

}