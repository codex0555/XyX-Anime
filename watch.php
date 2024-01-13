<?php
$wurl = "http://localhost/anime-invalid-code/";
$api = "https://animezia1.onrender.com";
$parts = parse_url($_SERVER["REQUEST_URI"]);
$page_url = explode("/", $parts["path"]);
$url = $page_url[count($page_url) - 1];
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "$api/getEpisode/$url");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
$response = curl_exec($ch);
$getEpisode = json_decode($response, true);
curl_close($ch);
$anime = $getEpisode['anime_info'];
$download = str_replace("Gogoanime", "Animezia", $getEpisode['ep_download']);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "$api/getAnime/$anime");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
$respon = curl_exec($ch);
$getAnime = json_decode($respon, true);
//$getAnime = file_get_contents("$api/getAnime/$anime");
//$getAnime = json_decode($getAnime, true);
curl_close($ch);

$episodelist = $getAnime['episode_id'];
?>

<?php
function getMalId($animeTitle) {
    $url = "https://myanimelist.net/anime.php?q=" . urlencode($animeTitle);
    $userAgent = "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.3";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
    $response = curl_exec($ch);

    if ($response) {
        $doc = new DOMDocument();
        @$doc->loadHTML($response); // Suppressing errors due to possible invalid HTML

        $xpath = new DOMXPath($doc);
        $animeEntry = $xpath->query('//div[contains(@class, "picSurround")]')->item(0);

        if ($animeEntry) {
            $malId = explode('/', $animeEntry->getElementsByTagName('a')->item(0)->getAttribute('href'))[4];
            return $malId;
        } else {
            return null;
        }
    } else {
        return null;
    }
}

$animeName = !empty($getAnime["othername"]) ? $getAnime["othername"] : $getAnime["name"];

if ($animeName != '') {
    $malId = getMalId($animeName);
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400&family=Source+Sans+3&display=swap" rel="stylesheet">
    <meta property="og:title" content="Xyx Anime Is a Anime Streaming Website.">
    <meta property="og:description" content="Xyx Anime Is A streaming Platform Where You Can Watch Anime At Free Of Cost And Easy To Access.
    I am Watching <?= $getAnime["name"] ?> You Can Join Me Here.">
    <meta property="og:image" content="https://xyxanime.rf.gd/main.png">
    <meta property="og:url" content="https://xyxanime.rf.gd">
    <meta property="og:type" content="website">
    <meta name="theme-color" content="#007BFF">
    <link rel="stylesheet" href="<?= $wurl  ?>/header-style.css">
    <link rel="stylesheet" href="<?= $wurl  ?>/watch-style.css">
    <link rel="stylesheet" href="<?= $wurl ?>/scroller-style.css">
    <link rel="stylesheet" href="<?= $wurl ?>/navbar-style.css">
    <!-- <style>

    </style> -->
    <title>Watch <?= $getAnime["name"]; ?> On XyX Anime</title>

    <script type="application/ld+json">
        {
      "@context": "https://schema.org",
      "@type": "WebSite",
      "url": "https://xyxanime.rf.gd/",
      "potentialAction": {
        "@type": "SearchAction",
        "target": "https://xyxanime.rf.gd/query?name={keyword}",
        "query-input": "required name=keyword"
      }
    }
    
        </script>

        <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-32WGHD6RE8"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-32WGHD6RE8');
</script>

</head>

<body class="bg-black">
    <div class="min-h-screen overflow-x-hidden bg-black w-full mx-auto max-w-screen-2xl adj">
        
        <div class="container-fluid">

        <!-- <div class="bg-video" style="background-image: url('<?= $getAnime["imageUrl"]; ?>');">
                </div> -->
                <?php
        include("header.php");
        ?>
     <div class="spinner-border text-info spinning"></div>

        <div class="container">
            <div class="video_part">
                <div class="video-player">
                    <div class="iframe-container">
                        <iframe src="https://the.animezia.com/player/v1.php?id=<?= $url ?>" name="iframe" id="myIframe" frameborder="0" scrolling="no" allow="accelerometer; autoplay; encrypted-media;gyroscope; picture-in-picture" allowfullscreen="true" webkitallowfullscreen="true" mozallowfullscreen="true"></iframe>
                    </div>
                </div>
                <div class="ep_changerr">
                <?php if($getEpisode['prevEpText'] == "") {
                                            echo "";
                                        } else { ?>
                    <a href="<?= $wurl ?>/watch<?=$getEpisode['prevEpLink']?>">
                    <div class="rewind_epp"><svg xmlns="http://www.w3.org/2000/svg" height="16" fill="white" width="16" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path d="M459.5 440.6c9.5 7.9 22.8 9.7 34.1 4.4s18.4-16.6 18.4-29V96c0-12.4-7.2-23.7-18.4-29s-24.5-3.6-34.1 4.4L288 214.3V256v41.7L459.5 440.6zM256 352V256 128 96c0-12.4-7.2-23.7-18.4-29s-24.5-3.6-34.1 4.4l-192 160C4.2 237.5 0 246.5 0 256s4.2 18.5 11.5 24.6l192 160c9.5 7.9 22.8 9.7 34.1 4.4s18.4-16.6 18.4-29V352z"/></svg></div>
                    </a>
                    <?php } ?>
                    <?php if($getEpisode['nextEpText'] == "") {
                                            echo "";
                                        } else { ?>          
                    <a href="<?= $wurl ?>/watch<?=$getEpisode['nextEpLink']?>">
                    <div class="forward_epp"><svg xmlns="http://www.w3.org/2000/svg" height="16" fill="white" width="16" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path d="M52.5 440.6c-9.5 7.9-22.8 9.7-34.1 4.4S0 428.4 0 416V96C0 83.6 7.2 72.3 18.4 67s24.5-3.6 34.1 4.4L224 214.3V256v41.7L52.5 440.6zM256 352V256 128 96c0-12.4 7.2-23.7 18.4-29s24.5-3.6 34.1 4.4l192 160c7.3 6.1 11.5 15.1 11.5 24.6s-4.2 18.5-11.5 24.6l-192 160c-9.5 7.9-22.8 9.7-34.1 4.4s-18.4-16.6-18.4-29V352z"/></svg></div>
                    </a>
                    <?php } ?>
                    <div class="reload_epp" onclick="reloadIframe()">Reload <svg xmlns="http://www.w3.org/2000/svg" height="15" fill="white" width="16" viewBox="0 0 512 512" style="top:-0.014rem; position:relative;"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path d="M463.5 224H472c13.3 0 24-10.7 24-24V72c0-9.7-5.8-18.5-14.8-22.2s-19.3-1.7-26.2 5.2L413.4 96.6c-87.6-86.5-228.7-86.2-315.8 1c-87.5 87.5-87.5 229.3 0 316.8s229.3 87.5 316.8 0c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0c-62.5 62.5-163.8 62.5-226.3 0s-62.5-163.8 0-226.3c62.2-62.2 162.7-62.5 225.3-1L327 183c-6.9 6.9-8.9 17.2-5.2 26.2s12.5 14.8 22.2 14.8H463.5z"/></svg></div>
                </div>
            </div>

            <div class=" text-center text-white flex-column p-2 info">
                <div class="current_streaming">
                    You Are Watching
                </div>
                <strong><span class="clr_episode"><?= $getAnime["name"] ?> - EP <?= $getEpisode["ep_num"] ?></span></strong>
                <div>
                    If Doesnt Work Just Switch The Server!
                </div>
            </div>
            <div class="clearfix"></div>

            <?php
            $apiA="https://api.anime-dex.workers.dev/episode/$url";
            $ch= curl_init();
            curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
            curl_setopt($ch, CURLOPT_URL, $apiA);
            curl_setopt($ch,CURLOPT_HEADER,0);
            curl_setopt($ch,CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
            $response_out= curl_exec($ch);
            $decode_out= json_decode($response_out,1);
            ?>

<?php
        $apiC="https://api.jikan.moe/v4/anime/$malId/full";
        $ch= curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_URL, $apiC);
        curl_setopt($ch, CURLOPT_HEADER,0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
        $response_v1= curl_exec($ch);
        $decode_v1= json_decode($response_v1,1);
        ?>

<?php
        $apiD="https://api.jikan.moe/v4/anime/$malId/characters";
        $ch= curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_URL, $apiD);
        curl_setopt($ch, CURLOPT_HEADER,0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
        $response_v2= curl_exec($ch);
        $decode_v2= json_decode($response_v2,1);
        ?>

            <div class="provider-section text-center">
                <div class="text-white font-weight-bold">
                   
                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="20" style="position: relative; top: -0.3rem;">
    <path d="M300-720q-25 0-42.5 17.5T240-660q0 25 17.5 42.5T300-600q25 0 42.5-17.5T360-660q0-25-17.5-42.5T300-720Zm0 400q-25 0-42.5 17.5T240-260q0 25 17.5 42.5T300-200q25 0 42.5-17.5T360-260q0-25-17.5-42.5T300-320ZM160-840h640q17 0 28.5 11.5T840-800v280q0 17-11.5 28.5T800-480H160q-17 0-28.5-11.5T120-520v-280q0-17 11.5-28.5T160-840Zm40 80v200h560v-200H200Zm-40 320h640q17 0 28.5 11.5T840-400v280q0 17-11.5 28.5T800-80H160q-17 0-28.5-11.5T120-120v-280q0-17 11.5-28.5T160-440Zm40 80v200h560v-200H200Zm0-400v200-200Zm0 400v200-200Z" fill="#ffffff"/>
</svg>
<?php

?>
 PROVIDERS:
                    <a class="provider-button" href="https://xyxanime.rf.gd/playerx?id=<?= $url ?>" target="iframe">JW PLAYER</a>
                    <?php
                    if(isset($decode_out["results"]["servers"]["filelions"])){
                        $server = $decode_out["results"]["servers"]["filelions"];
                        echo '<a class="provider-button" href="' .$server. '" target="iframe">FILELION</a>';
                    }
                    elseif(isset($decode_out["results"]["servers"]["doodstream"])){
                        $serverz= $decode_out["results"]["servers"]["doodstream"];
                        echo '<a class="provider-button" href="' .$serverz. '" target="iframe">Doodstream</a>';
                    }
                    else{
                        echo '';
                    }
                    ?>
                </div>
            </div><!-- Its Needs To Be Fixed! -->

            <!-- Start Est. Next Episode Time -->
            <?php

// Assuming $decode_v1 is your decoded JSON data
if (isset($decode_v1["data"]["broadcast"]["string"]) && isset($decode_v1["data"]["aired"]["string"])) {
    $broadcastString = $decode_v1["data"]["broadcast"]["string"];
    $airedString = $decode_v1["data"]["aired"]["string"];

    // Extract broadcast information
    preg_match('/([a-zA-Z]+) at (\d{2}:\d{2}) \((\w+)\)/', $broadcastString, $broadcastMatches);
    $broadcastDay = $broadcastMatches[1] ?? null;
    $broadcastTime = $broadcastMatches[2] ?? null;
    $broadcastTimezone = $broadcastMatches[3] ?? null;

    // Extract aired information
    preg_match('/(\w+ \d{1,2}, \d{4}) to (\?|\w+ \d{1,2}, \d{4})/', $airedString, $airedMatches);
    $airedFrom = strtotime($airedMatches[1] ?? "");
    $airedTo = ($airedMatches[2] == "?") ? null : strtotime($airedMatches[2] ?? "");

    // Get the current time
    $currentTime = time();

    // Check if the current time is after the end date (if available)
    if ($airedTo !== null && $currentTime > $airedTo) {
        echo '';
    } else {
        // Calculate the next broadcast date
        $nextBroadcast = strtotime("$broadcastDay $broadcastTime $broadcastTimezone");

        // Calculate the time difference for the next broadcast
        $timeDifference = $nextBroadcast - $currentTime;

        // Check if the next broadcast is in the future
        if ($nextBroadcast > $currentTime) {
            // Calculate days, hours, minutes, and seconds
            $days = floor($timeDifference / (60 * 60 * 24));
            $hours = floor(($timeDifference % (60 * 60 * 24)) / (60 * 60));
            $minutes = floor(($timeDifference % (60 * 60)) / 60);

            // Display the countdown along with the broadcast information
            echo '<div class="est_time_episode rounded">
            <div class="bg-primary text-center">
                <div class="est_time">💖 Estimated Next Ep: '.$days.' days : '.$hours.' hrs : '.$minutes.' min</div>
            </div>
        </div>';
        } else {
            echo '';
        }
    }
} else {
    echo '';
}
?>



            <!-- End Est. Next Episode Time -->

            <!-- Start Share Button -->
            <div class="sharethis-inline-share-buttons"></div>
            <!-- End Share Button -->

        </div> 

        <div class="container-fluid mt-4">
            <!-- Start detail of Anime -->
            <div class="rounded mb-4 text-white flex">
                <div class="p-3 box-detail">
               <div class="image">
                    <img src="<?= $getAnime['imageUrl'] ?>" width="140" height="180" alt="">
                    </div>
                    <div>
                    <div class="anime_name text-truncate">
    <?php
    if (!empty($getAnime["othername"])) {
        $other = $getAnime["othername"];
        echo $other;
    } else {
        $name = $getAnime["name"];
        echo $name;
    }
    ?>
</div>
<div class="clearfix"></div>

                    <div class="synopsis px-2"  data-bs-spy="scroll"><?= $getAnime['synopsis']; ?></div>
                    <div class="p-4 width">
                    
                    <div class="anime_type py-2"><strong>Type:</strong> <span class="clr_episode"> <?php if(isset($decode_v1["data"]["type"])){
                        $type= $decode_v1["data"]["type"];
                        echo $type;
                    }
                    else{
                        echo "TV";
                    } ?></span></div>
                    <div class="anime_quality mb-1"> <?php if(isset($decode_v1["data"]["score"])){
                        $score= $decode_v1["data"]["score"];
                        echo "<strong>Score: </strong>" .$score;
                    }
                    else{
                        echo "";
                    } ?></div>
                    <div class="anime_status"><?php if(isset($getAnime['status'])){
                        $status1= $getAnime['status'];
                        echo "<strong>Status: </strong>" .$status1;
                    }?></div>
                    <div class="anime_quality py-2"> <?php if(isset($decode_v1["data"]["duration"])){
                        $studio= $decode_v1["data"]["duration"];
                        echo "<strong>Duration: </strong>" .$studio;
                    }
                    else{
                        echo "";
                    } ?></div>
                    <div class="anime_quality py-"><strong>Genre:</strong> <span class="clr_episode"><?php if(isset($getAnime["genres"])){
                    $var= array_slice($getAnime["genres"],0,2);
                    echo implode(",",$var);
                }
                else{
                    echo "Genre: 404_Not Found";
                } ?></span></div>
                    <div class="anime_quality py-2"> <?php if(isset($decode_v1["data"]["aired"]["string"])){
                        $studio= $decode_v1["data"]["aired"]["string"];
                        echo "<strong>Aired: </strong>" .$studio;
                    }
                    else{
                        echo "";
                    } ?></div>
                    <div class="anime_quality py-"><strong>Episodes:</strong> <?php echo $getAnime['totalEpisodes']; ?></div>
                    <div class="anime_quality py-2"> <?php if(isset($decode_v1["data"]["studios"][0]["name"])){
                        $studio= $decode_v1["data"]["studios"][0]["name"];
                        echo "<strong>Studio: </strong>" .$studio;
                    }
                    else{
                        echo "";
                    } ?>
                    </div>
                    <div class="anime_quality py-"> <?php if(isset($decode_v1["data"]["source"])){
                        $premiered= $decode_v1["data"]["source"];
                        echo "<strong>Source: </strong>" .$premiered;
                    }
                    else{
                        echo "";
                    } ?></div>
                    <div class="anime_quality py-2"> <?php
                    if(isset($decode_v1["data"]["producers"][0]["name"])){
                        $producer= $decode_v1["data"]["producers"][0]["name"];
                        echo '<strong>Producer: </strong>' .$producer;
                    }
                    else{
                        echo "";
                    }
                    ?>
</div>
<?php
                if (isset($decode_v1["data"]["rating"])) {
                    $rating = strtoupper($decode_v1["data"]["rating"]);
                
                    if (strpos($rating, "PG-13") !== false) {
                        echo '<div class="anime_adult" style=" background-color: #05cf05;">PG-13</div>';
                    } elseif (strpos($rating, "R+") !== false) {
                        echo '<div class="anime_adult" style="background-color: #FF0000;"> R+  </div>';
                    } elseif (strpos($rating, "R - 17+") !== false) {
                        echo '<div class="anime_adult" style="background-color: #FFA500;">R-17+</div>';
                    }
                    elseif(strpos($rating,"G") !== false){
                        echo '<div class="anime_adult" style="background-color: #05cf05;">G-All</div>';
                    }
                    else {
                        echo '';
                    }
                } else {
                    echo '';
                }
                
                
                ?>
                    </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
               
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>


            <!-- End details of Anime -->

            <!-- Start Of Voice Actor/Actess Details -->
            <?php
if (isset($decode_v2["data"]) && !empty($decode_v2["data"])) {
?>
<div class="voice-char">
    <div class="anime_art">Characters & Voice Artist:</div>
    <div class="scroll_voice">
        <?php
        foreach ($decode_v2["data"] as $voice_act) {
        ?>
        <div class="voice rounded">
            <img src="<?= $voice_act["character"]["images"]["jpg"]["image_url"] ?>" alt="" width="50" class="img-fluid">
            <div class="voice_border">
                <img src="<?= $voice_act["voice_actors"][0]["person"]["images"]["jpg"]["image_url"] ?>" alt="" width="50" class="img-fluid voice_actress">
            </div>
            <div class="anime_character_details">
                <div class="anime_character text-truncate"><?= $voice_act["character"]["name"] ?></div>
                <div class="designation"><?= $voice_act["role"] ?></div>
            </div>
            <div class="voice_character_details">
                <div class="voice_character text-truncate"><?= $voice_act["voice_actors"][0]["person"]["name"] ?></div>
                <div class="designation_voice"><?= $voice_act["voice_actors"][0]["language"] ?></div>
            </div>
        </div>
        <?php
        }
        ?>
    </div>
</div>
<?php
}
?>


            <!-- End Of Voice Actor/Actress Details -->

            <!-- start -->
            <h4 class="text-white flex-column episode"> List Of Episodes:</h4>
            <div class="episode-list mb-4 bg-dark rounded p-2 h-2" target="iframe">
            <div class="bg-video" style="background-image: url('<?= $getAnime["imageUrl"]; ?>');">
                </div>
                <?php
                foreach ($episodelist as $episode) {
                ?>
                    <a class="episode-link" href="<?= $wurl ?>/watch/<?=$episode['episodeId']?>"><?= $episode["episodeNum"] ?></a>
                <?php
                }
                ?>
            </div>

            <!-- end -->
        </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=657d8c4f4850bc00125990be&product=inline-share-buttons&source=platform" async="async"></script>

</body>

</html>
