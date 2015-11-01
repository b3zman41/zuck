<?php

namespace App\Http\Controllers;

use App\FacebookService;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FacebookController extends Controller
{
    private $facebook;

    public function __construct(FacebookService $facebook)
    {
        $this->facebook = $facebook;
    }

    public function updateMembers()
    {
        $this->facebook->updateMembers(\Auth::user());
    }

}
