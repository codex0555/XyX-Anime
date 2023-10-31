<?php
$page = isset($_GET['page']) ? $_GET['page'] : 1;
?> <?php
    // Check if there is more data to load
    $nextPage = $page + 1;
    $nextApi = "https://webdis-zgj8.onrender.com/recent-release?type=2&page=$nextPage";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $nextApi);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
    $nextApiResponse = curl_exec($ch);
    $nextJson = json_decode($nextApiResponse, true);
    curl_close($ch);

    ?> <?php
    $variation= $_GET['name'];
     ?> <!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1"><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"><link rel="stylesheet" href="custom-style.css"><link rel="stylesheet" href="header-style.css"><link rel="stylesheet" href="navbar-style.css"><link rel="stylesheet" href="footer-style.css"><link rel="stylesheet" href="scroller-style.css"><title>Search Result On <?= $variation ?>- XyX Anime</title></head><body class="bg-black text-white"><div class="min-h-screen overflow-x-hidden bg-black w-full mx-auto max-w-screen-2xl"> <?php
        include("header.php");
        ?> <?php
        include("navbar5.php");
        ?> <?php
        include("query-search.php");
        ?> <?php
    include("footer.php");
    ?> </div></body><script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script></html>