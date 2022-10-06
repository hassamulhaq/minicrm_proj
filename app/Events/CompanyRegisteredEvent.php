<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;

class CompanyRegisteredEvent
{
    use Dispatchable;

    public function __construct(public $company)
    {

    }
}
