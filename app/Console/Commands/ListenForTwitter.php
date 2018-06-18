<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\LaravelTwitterStreamingApi\TwitterStreamingApi;
use League\Flysystem\Config;
use Illuminate\Config\Repository;

class ListenForTwitter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'twitter:watch-hashtag';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Listen for hashtags being used on Twitter';

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
        //$access_Token = env('TWITTER_ACCESS_TOKEN');
        //$access_Token_Secret = env('TWITTER_ACCESS_TOKEN_SECRET');
        //$consumerKey = env('TWITTER_CONSUMER_KEY');
        $config = new Repository([
            'access_token' => env('TWITTER_ACCESS_TOKEN'),
            'access_token_secret' => env('TWITTER_ACCESS_TOKEN_SECRET'),
            'consumer_key' => env('TWITTER_CONSUMER_KEY'),
            'consumer_secret' => env('TWITTER_CONSUMER_SECRET'),
        ]);
        
        $twitterStreaming = new TwitterStreamingApi($config);
        $twitterStreaming->publicStream()->whenHears('#laravel', function (array $tweet) {
            dump("{$tweet['user']['screen_name']} tweeted {$tweet['text']}");
        })
        ->startListening();
    }
}
