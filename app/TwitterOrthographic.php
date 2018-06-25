<?php

namespace App;

use App\Jobs\ProcessTweet;
use Illuminate\Foundation\Bus\DispatchesJobs;

class TwitterOrthographic
{
    /* usa a classe DispatchesJobs para facilitar o envio
    do tweet para a fila. */
    use DispatchesJobs;

    /**
    * Enqueue each status
    *
    * @param string $status
    * Chama o Job para processar o tweet
    */
    public function check($tweet)
    {
        $word = explode(" ", $tweet->tweet_text);
        //$dic = pspell_new(json_decode($tweet->json)->lang);
        $dic = pspell_new("pt_BR");
        
        foreach($word as $k => $v) {
            if (pspell_check($dic, $v)) {
               $status = "spelled right";
            } else {
               return "Sorry, wrong spelling";
            };
         };
         return $status;
    }
}

?>