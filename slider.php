
<!-- Carousel -->
<div id="demo" class="carousel slide" data-bs-ride="carousel">

  <!-- Indicators/dots -->
  <div class="carousel-indicators">
    <!-- Your PHP loop should generate these indicators based on the number of items -->
    <?php
    $api = "https://webdis-zgj8.onrender.com";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "$api/top-airing");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
    $response = curl_exec($ch);
    $json1 = json_decode($response, true);
    
    $indicatorCount = count($json1);
    for ($i = 0; $i < $indicatorCount; $i++) {
        // Add 'active' class to the first indicator
        $activeClass = ($i === 0) ? 'active' : '';
        echo '<button type="button" data-bs-target="#demo" data-bs-slide-to="' . $i . '" class="' . $activeClass . '"></button>';
    }
    curl_close($ch);
    ?>
  </div>
  
  <div class="carousel-inner">
    <!-- Slides -->
    <?php
    foreach ($json1 as $index => $recentUpdated) {
        $activeClass = ($index === 0) ? ' active' : ''; // Set 'active' class for the first slide

        echo '<a href="watch/' .$recentUpdated["animeId"]. '-episode-1"><div class="carousel-item slider_item' . $activeClass . '">
                <img src="' . $recentUpdated["animeImg"] . '" alt="' . $recentUpdated["animeTitle"] . '" class="d-block img-fluid">
                <div class="carousel-caption spotlight">
                  <h3>' . $recentUpdated["animeTitle"] . '</h3>
                  <p>#'.$index.' Spotlight</p>
                </div>
              </div></a>';
    }
    ?>
  </div>

  <!-- Left and right controls/icons -->
  <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
  </button>
</div>
