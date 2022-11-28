<?php

namespace App\Models;
use Illuminate\Support\Facades\Mail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use StaticMethodFile;

class SendMail extends Model
{
    use HasFactory;
    public Static function sender($name, $email, $messages)
    {
        $data = array(
            'name' => $name,
            'email' => $email,
            'msg' => $messages
        );

        $subject = "Welcome";
        $from = "dineN'Stay";
        $fromEmail = "mail@dinenstay.com";

        Mail::send('mail', $data, function($message) use ($subject, $from, $fromEmail, $name, $email){
            $message->from($fromEmail, $from);
            $message->to($email, $name)->subject($subject);
        });
    }

    public static function Notify($name, $email, $messages)
    {
        $data = array(
            'name' => $name,
            'email' => $email,
            'msg' => $messages
        );

        $subject = "Booking";
        $from = "dineN'Stay";
        $fromEmail = "mail@dinenstay.com";

        Mail::send('mail', $data, function($message) use ($subject, $from, $fromEmail, $name, $email){
            $message->from($fromEmail, $from);
            $message->to($email, $name)->subject($subject);
        });
    }
}


