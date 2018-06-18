<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\LaravelTwitterStreamingApi\TwitterStreamingApi;

class ListenForLocation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'twitter:locale';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Listen for locale specified on Twitter';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        TwitterStreamingApi::publicStream()->create(
            $accessToken,
            $accessTokenSecret,
            $consumerKey,
            $consumerSecret
        )->whenFrom([ // [<south-west point longitude>, <south-west point latitude>, <north-east point longitude>, <north-east point latitude>]
            [-46.63330939999997, -23.5505199], // São Paulo [não encontrei no formato pedido]
            [-43.93455929999999, -19.9172987], // Belo Horizonte [não encontrei no formato pedido]
        ], function(array $tweet) {
                echo "{$tweet['user']['screen_name']} just tweeted {$tweet['text']} from SF or NYC";
        })->startListening();
    }
}
