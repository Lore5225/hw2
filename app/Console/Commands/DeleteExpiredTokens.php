<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\PasswordReset;

class DeleteExpiredTokens extends Command
{
    protected $signature = 'tokens:clean';
    protected $description = 'Delete expired password reset tokens';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->info('Eseguito il comando per eliminare i token scaduti.');

        PasswordReset::where('expiration_date', '<', Carbon::now())->delete();

        $this->info('Token di reset scaduti cancellati.');
    }
}
