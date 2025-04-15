<?php

namespace App\Http\Controllers;

use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;

class TestMailController
{
    public function sendMail()
    {
        Mail::to('tsyrzhima@gmail.com')->send(new TestMail());
        echo "Mail has been sent";
    }

}
