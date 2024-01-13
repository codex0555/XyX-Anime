<?php
$page = isset($_POST['page']) ? $_POST['page'] : 1;
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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&family=Source+Sans+3&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="custom-style.css">
    <link rel="stylesheet" href="header-style.css">
    <link rel="stylesheet" href="navbar-style.css">
    <link rel="stylesheet" href="footer-style.css">
    <link rel="stylesheet" href="scroller-style.css">
    <link rel="stylesheet" href="slider-style.css">
  <title>XyX Anime - Watch Anime Online</title>
  <meta name="description" content="Watch high-quality anime online for free at XyX Anime. Explore a vast collection of the latest and classic anime series.">
  
  <!-- Canonical URL (if applicable) -->
  <link rel="canonical" href="https://xyxanime.rf.gd/">

  <!-- Open Graph Tags for Social Media (Optional but recommended) -->
  <meta property="og:title" content="XyX Anime - Watch Anime Online">
  <meta property="og:description" content="Watch high-quality anime online for free at XyX Anime. Explore a vast collection of the latest and classic anime series.">
  <meta property="og:url" content="https://xyxanime.rf.gd/">
  <meta property="og:image" content="https://xyxanime.rf.gd/cover-image.jpg">
  <meta property="og:type" content="website">

  <!-- Twitter Card Tags for Social Media (Optional but recommended) -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="XyX Anime - Watch Anime Online">
  <meta name="twitter:description" content="Watch high-quality anime online for free at XyX Anime. Explore a vast collection of the latest and classic anime series.">
  <meta name="twitter:image" content="https://xyxanime.rf.gd/cover-image.jpg">

  <!-- Schema.org Structured Data -->
  <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebSite",
      "url": "https://xyxanime.rf.gd/",
      "name": "XyX Anime",
      "description": "Watch high-quality anime online for free. Explore a vast collection of the latest and classic anime series.",
      "publisher": {
        "@type": "Organization",
        "name": "XyX Anime",
        "logo": {
          "@type": "ImageObject",
          "url": "https://xyxanime.rf.gd/main.png",
          "width": 600,
          "height": 60
        }
      },
      "image": {
        "@type": "ImageObject",
        "url": "https://xyxanime.rf.gd/cover-image.jpg",
        "width": 800,
        "height": 600
      }
    }
  </script>

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

    <!-- Google tag (gtag.js) pre-DNS resolution only -->
<link rel="dns-prefetch" href="//www.googletagmanager.com">

<script async src="https://www.googletagmanager.com/gtag/js?id=G-32WGHD6RE8"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-32WGHD6RE8');
</script>


  <!-- Additional Meta Tags for SEO -->
  <meta name="keywords" content="anime, zoro anime, 9anime, kissanime, animedex, hindi dub anime, free anime site, streaming, watch anime, XyX Anime">
  <meta name="robots" content="index, follow">
  <meta name="googlebot" content="index, follow">
  <meta name="google" content="notranslate">
  <meta name="theme-color" content="#007BFF">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="path/to/favicon/ms-icon-144x144.png">
  <meta name="application-name" content="XyX Anime">

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
                <div class="col-sm-6 col-md-4 col-lg-2 mb-2 adj">
                    <div class="holder mt-2">
                    <div class="card bg-dark">
                    <div class="spinner-border text-info spinning"></div>
                        <a href="watch/<?= $recentUpdated["episodeId"] ?>">
                        <img data-src="<?= $recentUpdated["animeImg"] ?>" class="card-img-top lazy" height="240" alt="">
                        </a>
                        <div class="play"><i class="fa-solid fa-play"></i></div>
                        <div class="card-body">
                            <span class="subordub"><?= $recentUpdated["subOrDub"] ?></span>
                            <span class="ep rounded-tr-md bg-red-600">Ep <?= $recentUpdated['episodeNum'] ?></span>
                        </div>
                    </div>
                    <div class="title text-truncate"><?= $recentUpdated["animeTitle"] ?></div>
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
                <div class="col-sm-6 col-md-4 col-lg-2 mb-2 adj">
                    <div class="holder mt-2">
                    <div class="card bg-dark">
                    <div class="spinner-border text-info spinning"></div>
                        <a href="watch/<?= $recentUpdated["episodeId"] ?>">
                        <img data-src="<?= $recentUpdated["animeImg"] ?>" class="card-img-top lazy" height="240" alt="">
                        </a>
                        <div class="play"><i class="fa-solid fa-play"></i></div>
                        <div class="card-body">
                            <span class="subordub"><?= $recentUpdated["subOrDub"] ?></span>
                            <span class="ep1 rounded-tr-md bg-red-600">Ep <?= $recentUpdated['episodeNum'] ?></span>
                        </div>
                    </div>
                    <div class="title text-truncate"><?= $recentUpdated["animeTitle"] ?></div>
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
                <div class="col-sm-6 col-md-4 col-lg-2 mb-2 adj">
                    <div class="holder mt-2">
                    <div class="card bg-dark">
                    <div class="spinner-border text-info spinning"></div>
                        <a href="watch/<?= $recentUpdated["episodeId"] ?>">
                        <img data-src="<?= $recentUpdated["animeImg"] ?>" class="card-img-top lazy" height="240" alt="">
                        </a>
                        <div class="play"><i class="fa-solid fa-play"></i></div>
                        <div class="card-body">
                            <span class="subordub">Chinese</span>
                            <span class="ep rounded-tr-md bg-red-600">Ep <?= $recentUpdated['episodeNum'] ?></span>
                        </div>
                    </div>
                    <div class="title text-truncate"><?= $recentUpdated["animeTitle"] ?></div>
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
