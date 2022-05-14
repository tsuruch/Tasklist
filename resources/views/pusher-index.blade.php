<!DOCTYPE html>
<head>
  <title>Pusher Test</title>
  <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
  <script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = false;

    var pusher = new Pusher('2806c3bed490d6f14c78', {
      cluster: 'ap3'
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
       let test = document.getElementById("test");
       test.textContent = data.message;
       console.log(data.message);
    });

    console.log(channel);


  </script>
</head>
<body>
  <h1>Pusher Test</h1>
  <h2 id="test">ココが変わるよ</h2>
  <p>
    Try publishing an event to channel <code>my-channel</code>
    with event name <code>my-event</code>.
  </p>
</body>
