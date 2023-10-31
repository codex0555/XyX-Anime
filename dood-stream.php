<?php
$animeId = $_GET['anime_Id'] ?? '';

// Construct the API URL with the anime ID
$apiUrl = 'https://animezia1.render.com' . $animeId;

// Output the HTML with the video player embedded in an iframe
?>
<!DOCTYPE html>
<html>
<head>
  <title>Watch Anime</title>
  <link href="https://vjs.zencdn.net/7.16.0/video-js.css" rel="stylesheet">
  <script src="https://vjs.zencdn.net/7.16.0/video.js"></script>
</head>
<body>
  <video
    id="my-video"
    class="video-js vjs-default-skin"
    controls
    width="800"
    height="450"
    data-setup='{ "techOrder": ["html5", "flash"], "sources": [{ "type": "application/x-mpegURL", "src": "<?php echo $apiUrl; ?>" }] }'
  ></video>
  <script>
    var player = videojs('my-video');
  </script>
</body>
</html>
