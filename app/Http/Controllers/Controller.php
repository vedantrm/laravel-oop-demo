<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Traits\ApiResponses;

class Controller extends BaseController
{   
    use ApiResponses;
    use AuthorizesRequests, ValidatesRequests;
}
