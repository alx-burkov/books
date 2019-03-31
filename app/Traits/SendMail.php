<?php

namespace App\Traits;

use Mail;

trait SendMail
{

    public function basic_email($data)
    {
        Mail::send(['text' => 'textmail'], $data, function($message) {
            $message->to('humpty_dumpty@rambler.ru', 'Alex')->subject('Обновление данных в базе книг');
            $message->from('alx.burkov@rambler.ru', 'Alex');
        });
        return "отправлены на почту";
    }

    public function html_email($data)
    {
        Mail::send('mail', $data, function($message) {
            $message->to('humpty_dumpty@rambler.ru', 'Alex')->subject('Обновление данных в базе книг');
            $message->from('alx.burkov@rambler.ru', 'Alex');
        });
        return "отправлены на почту";
    }

    public function attachment_email($data)
    {
        Mail::send('mail', $data, function($message) {
            $message->to('humpty_dumpty@rambler.ru', 'Alex')->subject('Обновление данных в базе книг');
            //$message->attach('~/Projects/laravel/public/uploads/image.png');
            //$message->attach('~/Projects/laravel/public/uploads/test.txt');
            $message->from('alx.burkov@rambler.ru', 'Alex');
        });
        return "отправлены на почту";
    }
}
