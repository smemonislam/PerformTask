<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function getSuccessMessage( $message )
    {
        session()->flash( 'message', $message );
        session()->flash( 'type', 'success' );
    }

    public function getErrorMessage( $message )
    {
        session()->flash( 'message', $message );
        session()->flash( 'type', 'danger' );
    }
}
