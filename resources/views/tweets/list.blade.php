<!-- list.blade.php 
será a lista pública de tweets recentes -->
@foreach($tweets as $tweet)
    <div class="tweet">
        @include('tweets.tweet')
    </div>
@endforeach