<?php

namespace App;

use OauthPhirehose;
use App\Jobs\ProcessTweet;
use Illuminate\Foundation\Bus\DispatchesJobs;

class TwitterStream extends OauthPhirehose
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
    public function enqueueStatus($status)
    {
        $this->dispatch(new ProcessTweet($status));
    }
}
