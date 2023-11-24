<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Dcblogdev\MsGraph\Facades\MsGraph;

class SocialController extends Controller
{
    public function connect(string $service): mixed
    {
        if ($service == 'microsoft') {

            return $this->connectMicrosoft();
        }


        return abort(404);
    }



    protected function connectMicrosoft()
    {
        return MsGraph::connect();
    }
}
