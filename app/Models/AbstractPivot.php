<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

abstract class AbstractPivot extends Pivot
{
    protected $keyType = 'string';
    protected $dateFormat = 'Y-m-d H:i:sO';
}
