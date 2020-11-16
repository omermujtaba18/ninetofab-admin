<?php

namespace App\Models;

use CodeIgniter\Model;

class RestaurantModel extends Model
{
    protected $table = 'restaurants';
    protected $primaryKey = 'rest_id';
    protected $returnType     = 'array';
    protected $allowedFields = [
        'rest_name',
        'rest_address',
        'rest_api_id',
        'rest_api_key',
        'rest_phone',
        'url',
        'type'
    ];
}
