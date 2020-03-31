<?php


namespace App\Models;

use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractModel extends Model
{
    use Cachable;

    protected $keyType = 'string';
    protected $dateFormat = 'Y-m-d H:i:sO';
}
