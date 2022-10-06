<?php

namespace App\Listeners;



use App\Events\CompanyRegisteredEvent;
use App\Models\Company;
use App\Models\User;
use Mail;

class CompanyRegisteredListener
{
    public function __construct()
    {
    }

    public function handle(CompanyRegisteredEvent $company)
    {
        /*
         * I can use auth here, and get user data.
         * but here I target only admin to email notification.
         * */
        $user = User::first();

        Mail::send('emails.companies.registered', (array) $company, function ($message) use ($user) {
            $message->to($user['email']);
            $message->subject("New Company Registered");
        });
    }
}
