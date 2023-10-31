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
?> <!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1"><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"><meta property="og:title" content="Xyx Anime Is a Anime Streaming Website."><meta property="og:description" content="Xyx Anime Is A streaming Platform Where You Can Watch Anime At Free Of Cost And Easy To Access.I am Watching <?= $getAnime["name"] ?> You Can Join Me Here."><meta property="og:image" content="https://xyxanime.rf.gd/main.png"><meta property="og:url" content="https://xyxanime.rf.gd"><meta property="og:type" content="website"><meta name="theme-color" content="#007BFF"><link rel="stylesheet" href="<?= $wurl  ?>/header-style.css"><link rel="stylesheet" href="<?= $wurl  ?>/watch-style.css"><link rel="stylesheet" href="<?= $wurl ?>/scroller-style.css"><!-- <style>

    </style> --><title>Watch <?= $getAnime["name"]; ?> On XyX Anime</title><script type="application/ld+json">{"@context": "https://schema.org", "@type": "WebSite", "url": "https://xyxanime.rf.gd/", "potentialAction": { "@type": "SearchAction", "target": "https://xyxanime.rf.gd/filter?keyword={keyword}", "query-input": "required name=keyword"}}</script></head><body class="bg-black"><div class="min-h-screen overflow-x-hidden bg-black w-full mx-auto max-w-screen-2xl"><div class="container-fluid"><div class="bg-video" style="background-image:url(<?= $getAnime["imageUrl"]; ?>)"></div> <?php
        include("header.php");
        ?> <div class="spinner-border text-info spinning"></div><div class="container"><div class="video_part"><div class="video-player"><div class="iframe-container"><iframe src="https://the.animezia.com/player/v2.php?id=<?= $url ?>" name="iframe" frameborder="0" scrolling="no" allow="accelerometer; autoplay; encrypted-media;gyroscope; picture-in-picture" allowfullscreen webkitallowfullscreen="true" mozallowfullscreen="true"></iframe></div></div></div><div class="text-center text-white flex-column p-2 info"><div class="current_streaming">You Are Watching</div><strong><?= $getAnime["name"] ?> - EP <?= $getEpisode["ep_num"] ?></strong><div>If Doesnt Work Just Switch The Server!</div></div><div class="clearfix"></div><div class="provider-section text-center rounded"><div class="text-white font-weight-bold">PROVIDERS: <a class="provider-button" href="https://the.animezia.com/player/v1.php?id=<?= $url ?>" target="iframe">SERVER1</a> <a class="provider-button" href="https://the.animezia.com/player/v2.php?id=<?= $url ?>" target="iframe">SERVER2</a></div></div><!-- Its Needs To Be Fixed! --><div class="episode_changer text-center mt-4"><div class="text-white episode_changing"> <?php if($getEpisode['prevEpText'] == "") {
                                            echo "";
                                        } else { ?> <a href="watch<?=$getEpisode['prevEpLink']?>" class="episode-nxt">PREVIOUS EP</a> <?php } ?> <?php if($getEpisode['nextEpText'] == "") {
                                            echo "";
                                        } else { ?> <a href="watch<?=$getEpisode['nextEpLink']?>" class="episode-nxt">NEXT EP</a> <?php } ?> </div></div></div><div class="container-fluid mt-4"><!-- Start detail of Anime --><div class="bg-dark rounded mb-4 text-white flex"><div class="p-3 box-detail"><div class="image"><img src="<?= $getAnime['imageUrl'] ?>" width="140" height="180" alt=""></div><div><div class="synopsis px-2" data-bs-spy="scroll"><?= $getAnime['synopsis']; ?></div><div class="p-4 width"><div class="anime_name text-truncate">Name: <?= $str = $getAnime["name"] ?></div><div class="anime_type py-2">Type: <?=$getAnime['type']?></div><div class="anime_status">Status: <?=$getAnime['status']?></div><div class="anime_quality py-2">Quality: HD</div></div></div><div class="clearfix"></div></div><div class="clearfix"></div></div><div class="clearfix"></div><!-- End details of Anime --><!-- start --><h4 class="text-white flex-column episode">List Of Episodes:</h4><div class="episode-list mb-4 bg-dark rounded p-2 h-2" target="iframe"><div class="bg-video" style="background-image:url(<?= $getAnime["imageUrl"]; ?>)"></div> <?php
                foreach ($episodelist as $episode) {
                ?> <a class="episode-link" href="watch/<?=$episode['episodeId']?>"><?= $episode["episodeNum"] ?></a> <?php
                }
                ?> </div><!-- end --></div></div></div><script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script></body></html>