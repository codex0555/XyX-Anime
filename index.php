<?php
$page = isset($_GET['page']) ? $_GET['page'] : 1;
?>

<?php
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

    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta name="description" content="Anime Streaming Website.">
    <meta name="keywords" content="anime website, xyxanime, xyx anime website , animezia">
    <meta name="author" content="10th_fail.sayan">
    <meta name="robots" content="index, follow">
    
    <!-- Open Graph Meta Tags for social media sharing -->
    <meta property="og:title" content="Xyx Anime Is a Anime Streaming Website.">
    <meta property="og:description" content="Xyx Anime Is A streaming Platform Where You Can Watch Anime At Free Of Cost And Easy To Access.">
    <meta property="og:image" content="https://xyxanime.rf.gd/main.png">
    <meta property="og:url" content="https://xyxanime.rf.gd">
    <meta property="og:type" content="website">
    <meta name="theme-color" content="#007BFF">
    
    <!-- Favicon (the icon that appears in the browser tab) -->
    <link rel="icon" type="image/png" href="path/to/favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="custom-style.css">
    <link rel="stylesheet" href="header-style.css">
    <link rel="stylesheet" href="navbar-style.css">
    <link rel="stylesheet" href="footer-style.css">
    <link rel="stylesheet" href="scroller-style.css">
    <link rel="stylesheet" href="slider-style.css">
    <title>XyX Anime Homepage</title>

    <script type="application/ld+json">
{
  "@context": "https://schema.org/",
  "@type": "WebSite",
  "name": "Xyx Anime",
  "url": "https://xyxanime.rf.gd",
  "potentialAction": {
    "@type": "SearchAction",
    "target": "{search_term_string}",
    "query-input": "required name=search_term_string"
  }
}
</script>
</head>
<body class="bg-black text-white">
    <div class="min-h-screen overflow-x-hidden bg-black w-full mx-auto max-w-screen-2xl">
    <?php
        include("header.php");
        ?>
        <?php
        include("navbar5.php");
        ?>
        <?php
        include("slider.php");
        ?>
        <!-- Start of Sub -->

    <main class="">
    <div class="container-fluid">
        <div class="all-item">
            <div class="top-part mb-2">
        <h2 class="mt-5 fs-4">Latest Subbed</h2>
        <?php  if (!empty($nextJson)) {
        // Display the "View More" button if there is more data
        echo '<span class="mt-5 arrow" id="more_arrow"><a href="?page=' . $nextPage . '"><i class="fa-solid fa-arrow-right"></i></a></span>';
    }
    ?>
        </div>
        <div class="row">
            <?php
            $api = "https://webdis-zgj8.onrender.com";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "$api/recent-release?type=1&page=$page");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
            $response = curl_exec($ch);
            $json1 = json_decode($response, true);

            foreach ((array)$json1 as $recentUpdated) {
                ?>
                <div class="col-sm-6 col-md-4 col-lg-2 mb-5 adj">
                    <div class="holder mt-2">
                    <div class="card bg-dark">
                    <div class="spinner-border text-info spinning"></div>
                        <a href="watch/<?= $recentUpdated["episodeId"] ?>">
                        <img src="<?= $recentUpdated["animeImg"] ?>" class="card-img-top" height="240" alt="">
                        </a>
                        <div class="play"><i class="fa-solid fa-play"></i></div>
                        <div class="card-body">
                            <span class="subordub"><?= $recentUpdated["subOrDub"] ?></span>
                            <span class="ep rounded-tr-md bg-red-600">Ep <?= $recentUpdated['episodeNum'] ?></span>
                        </div>
                        <div class="title text-truncate"><?= $recentUpdated["animeTitle"] ?></div>
                    </div>
                    </div>
                </div>
                <?php
            }
            curl_close($ch);
            ?>
        </div>
        </div>
    </div>
    </main>

    <!-- End of Sub -->

    <!-- Start of Dub -->

    <main class="">
    <div class="container-fluid">
        <div class="all-item">
            <div class="top-part mb-2">
        <h2 class="mt-5 fs-4">Latest Dub</h2>
        <?php  if (!empty($nextJson)) {
        // Display the "View More" button if there is more data
        echo '<span class="mt-5 arrow" id="more_arrow"><a href="?page=' . $nextPage . '"><i class="fa-solid fa-arrow-right"></i></a></span>';
    }
    ?>
        </div>
        <div class="row">
            <?php
            $api = "https://webdis-zgj8.onrender.com";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "$api/recent-release?type=2&page=$page");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
            $response = curl_exec($ch);
            $json1 = json_decode($response, true);

            foreach ((array)$json1 as $recentUpdated) {
                ?>
                <div class="col-sm-6 col-md-4 col-lg-2 mb-5 adj">
                    <div class="holder mt-2">
                    <div class="card bg-dark">
                    <div class="spinner-border text-info spinning"></div>
                        <a href="watch/<?= $recentUpdated["episodeId"] ?>">
                        <img src="<?= $recentUpdated["animeImg"] ?>" class="card-img-top" height="240" alt="">
                        </a>
                        <div class="play"><i class="fa-solid fa-play"></i></div>
                        <div class="card-body">
                            <span class="subordub"><?= $recentUpdated["subOrDub"] ?></span>
                            <span class="ep1 rounded-tr-md bg-red-600">Ep <?= $recentUpdated['episodeNum'] ?></span>
                        </div>
                        <div class="title text-truncate"><?= $recentUpdated["animeTitle"] ?></div>
                    </div>
                    </div>
                </div>
                <?php
            }
            curl_close($ch);
            ?>
        </div>
        </div>
    </div>
    </main>

    <!-- End of Dub -->

    <!-- Start of Chinese -->

    <main class="">
    <div class="container-fluid">
        <div class="all-item">
            <div class="top-part mb-2">
        <h2 class="mt-5 fs-4">Latest Chinese</h2>
        <?php  if (!empty($nextJson)) {
        // Display the "View More" button if there is more data
        echo '<span class="mt-5 arrow" id="more_arrow"><a href="?page=' . $nextPage . '"><i class="fa-solid fa-arrow-right"></i></a></span>';
    }
    ?>
        </div>
        <div class="row">
            <?php
            $api = "https://webdis-zgj8.onrender.com";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "$api/recent-release?type=3&page=$page");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
            $response = curl_exec($ch);
            $json1 = json_decode($response, true);

            foreach ((array)$json1 as $recentUpdated) {
                ?>
                <div class="col-sm-6 col-md-4 col-lg-2 mb-5 adj">
                    <div class="holder mt-2">
                    <div class="card bg-dark">
                    <div class="spinner-border text-info spinning"></div>
                        <a href="watch/<?= $recentUpdated["episodeId"] ?>">
                        <img src="<?= $recentUpdated["animeImg"] ?>" class="card-img-top" height="240" alt="">
                        </a>
                        <div class="play"><i class="fa-solid fa-play"></i></div>
                        <div class="card-body">
                            <span class="subordub">Chinese</span>
                            <span class="ep rounded-tr-md bg-red-600">Ep <?= $recentUpdated['episodeNum'] ?></span>
                        </div>
                        <div class="title text-truncate"><?= $recentUpdated["animeTitle"] ?></div>
                    </div>
                    </div>
                </div>
                <?php
            }
            curl_close($ch);
            ?>
        </div>
        </div>
    </div>
    </main>


    <!-- End of Chinese -->

    <?php
    include("footer.php");
    ?>
    </div>
    
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</html>
