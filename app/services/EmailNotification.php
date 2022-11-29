<?php
namespace App\services;
use App\Models\User;
use Mail;
class EmailNotification {

    public function hello()
    {
        return "hello from service";
    }
    public function login_email($name,$email,$password,$push_message,$description)
    {
        try {
                $data['subject'] = $push_message;
                $data['description'] = $description;
                $data['password'] = $password;
                $data['to'] = $email;
                $data['name'] = $name;
          
                Mail::send('email.welcome_email', $data, function ($message) use ($data) {
                    $message->from(env('MAIL_USERNAME'));
                    $message->subject($data['subject']);
                    $message->to($data['to']);
                });
            
            return 1;
        } catch (\Exception $e) {
            return 0;
        }
        
    }
}