<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Property extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'property_type_id',
        'api_uuid',
        'county',
        'country',
        'town',
        'description',
        'address',
        'image_full',
        'image_thumbnail',
        'latitude',
        'longitude',
        'num_bedrooms',
        'num_bathrooms',
        'price',
        'type',
    ];

    public static function fetchFromAPI($page) {
        $params = [
            'api_key' => env('MTC_API_KEY'),
            'page[number]' => $page,
            'page[size]' => 100
        ];
        return Http::connectTimeout(30)->get('https://trial.craig.mtcserver15.com/api/properties', $params);
    }
}
