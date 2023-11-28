<?php

namespace App\Listeners;

use App\Events\ActiveCode;
use App\Mail\VerificationMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendActiveCode
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ActiveCode $event): void
    {
        $event->user->GenerateCode();
        Mail::to($event->user->email)->queue(new VerificationMail($event->user));
        // Auth::login($event->user);
    }
}
