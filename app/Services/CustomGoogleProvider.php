<?php

namespace App\Services;
use Laravel\Socialite\Two\GoogleProvider;
use GuzzleHttp\Client;

class CustomGoogleProvider extends GoogleProvider
{
    protected function getHttpClient()
    {
        return new Client(['verify' => false]); // SSL verify disabled (development only)
    }
}
