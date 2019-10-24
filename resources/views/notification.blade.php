
@extends('layouts.app')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
   
    <h1>Real-time notifications using Pusher In Laravel</h1>
    <ul class="new-notification">
    </ul>
    <!-- Incldue Pusher Js Client via CDN -->
    <script src="https://js.pusher.com/4.2/pusher.min.js"></script>

    <?php  if(Auth::user()->id == 2) : ?>
    <script>
        //Remember to replace key and cluster with your credentials.
        var pusher = new Pusher('<?php echo env('PUSHER_APP_KEY'); ?>', {
            cluster: 'ap2',
            encrypted: true
        });

        //Also remember to change channel and event name if your's are different.
        var channel = pusher.subscribe('notification2');
        channel.bind('notification-event', function(message) {
            $('.new-notification').append('<li>' + message + '</li>');
        });

    </script>
    <?php endif; ?>
@endsection