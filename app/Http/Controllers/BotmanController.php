<?php

namespace App\Http\Controllers;
use App\Models\ChatBot;
use BotMan\BotMan\BotMan;
use Illuminate\Http\Request;
use BotMan\BotMan\Messages\Incoming\Answer;
use Illuminate\Support\Facades\DB;


class BotmanController extends Controller
{

    public function handle()

    {

        $botman = app('botman');

        $botman->hears('{message}', function($botman, $message) {
            $newmsg = strtolower($message);

            if ($newmsg == 'hi') {
                $this->askName($botman);
            }elseif ($newmsg=='bye' ||$newmsg=='goodbye'){
                $botman->reply('Goodbye');
            }elseif ($newmsg=='how are you' ||$newmsg=='hw are you'||$newmsg=='how are you?'){
                $botman->reply('fine and you');
            }elseif ($newmsg=='how old are you?' ||$newmsg=='old are you'){
                $botman->reply('Iam a chatbot');
                $this->askAge($botman);
            }elseif ($newmsg=='what about products' ||$newmsg=='show me products'||$newmsg=='products'){
                $botman->reply('ok good  i will send to you list of all products');
            }
            else{
                $botman->reply('sorry i donot know about that');

            }

        });

        $botman->listen();

    }



    /**

     * Place your BotMan logic here.

     */

    public function askName($botman)

    {

        $botman->ask('Hello! What is your Name?', function(Answer $answer) {

            $name = $answer->getText();

            $this->say('Nice to meet you '.$name);

        });

    }
    public function askAge($botman)

{

    $botman->ask('Hello! how old are you?', function(Answer $answer) {

        $age= $answer->getText();
        $isint = is_numeric($age);
        if ($isint)
            $this->say('all the lifetime is yours');
        else
            $this->say('that\'s not real age');

    });

}
}
