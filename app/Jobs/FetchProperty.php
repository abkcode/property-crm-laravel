<?php

namespace App\Jobs;

use App\Models\Property;
use App\Models\PropertyType;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class FetchProperty implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $page = 1;
            do {
                dump('page: '.$page);
                $response = Property::fetchFromAPI($page);
                foreach ($response->json('data') as $propertyDetails) {
                    PropertyType::firstOrCreate([
                        'id' => $propertyDetails['property_type']['id'],
                        'title' => $propertyDetails['property_type']['title']
                    ]);
                    $newProperty = [
                        'property_type_id' => $propertyDetails['property_type']['id'],
                        'county' => $propertyDetails['county'],
                        'country' => $propertyDetails['country'],
                        'town' => $propertyDetails['town'],
                        'description' => $propertyDetails['description'],
                        'address' => $propertyDetails['address'],
                        'image_full' => $propertyDetails['image_full'],
                        'image_thumbnail' => $propertyDetails['image_thumbnail'],
                        'latitude' => $propertyDetails['latitude'],
                        'longitude' => $propertyDetails['longitude'],
                        'num_bedrooms' => $propertyDetails['num_bedrooms'],
                        'num_bathrooms' => $propertyDetails['num_bathrooms'],
                        'price' => $propertyDetails['price'],
                        'type' => ($propertyDetails['type'] == 'rent') ? 1 : 0,
                    ];
                    dump($newProperty);

                    Property::updateOrCreate(
                        ['api_uuid' => $propertyDetails['uuid']],
                        $newProperty
                    );
                }

                $totalPages = $response->json('last_page');
                $page++;
            } while ($page <= $totalPages);
        } catch (\Exception $e) {
            dump($e->getMessage());
        }
        
    }
}
