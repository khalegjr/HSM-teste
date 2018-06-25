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
        $this->twitterStream->setLocations(array(
            array(-47.0762088, -22.8488021, -47.0761509, -22.8119143),
        ));
        //$this->twitterStream->setTrack(array('scotch_io'));
        $this->twitterStream->consume();
    }
}
