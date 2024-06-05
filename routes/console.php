<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Console\Commands\DeleteExpiredTokens;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();


Artisan::command('tokens:clean', function () {
    $command = new DeleteExpiredTokens();
    $command->handle();
})->purpose('Elimino token di reset scaduti')->everyFifteenMinutes();
