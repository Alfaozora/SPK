<?php

namespace App\Http\Controllers;

use App\Mail\TesEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SendEmailController extends Controller
{
    public function index()
    {

        Mail::to('ao.tech89@gmail.com')->send(new TesEmail());
    }
}
