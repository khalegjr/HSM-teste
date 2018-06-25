<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\TwitterStream;

class ConnectToStreamingAPI extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'twitter:track';
    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Connect to the Twitter Streaming API to see keyword';
    
    protected $twitterStream;
    
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(TwitterStream $twitterStream)
    {
        $this->twitterStream = $twitterStream;
        parent::__construct();
    }
    
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $twitter_consumer_key = env('TWITTER_CONSUMER_KEY', '');
        $twitter_consumer_secret = env('TWITTER_CONSUMER_SECRET', '');
        
        $this->twitterStream->consumerKey = $twitter_consumer_key;
        $this->twitterStream->consumerSecret = $twitter_consumer_secret;
        $this->twitterStream->setLocations(array( // TODO: desenvolver método para passar lista de localização
            array(-46.7755847, -24.004602, -46.5377017, -23.357259), // São Paulo [long sudoeste, lat sudoeste, long
            // noroeste, lat noroeste]
        ));
        //$this->twitterStream->setTrack(array('scotch_io'));
        $this->twitterStream->consume();
    }
}
