

<div class="swiper-container">
  <div class="swiper-wrapper">
    <?php
    $api = "https://api.anime-dex.workers.dev/home"; // Replace with your API URL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);

    if ($response === false) {
      echo 'Error: ' . curl_error($ch);
    } else {
      $data = json_decode($response, true);

      if(isset($data["results"]["anilistTrending"]) && is_array($data["results"]["anilistTrending"])){
        $dataAni= $data["results"]["anilistTrending"];
      }

      if ($data) {
        foreach ($dataAni as $index => $item) {
          echo '<div class="swiper-slide">';
          echo '<img data-src="' . $item["bannerImage"] . '" alt="" class="lazy">';
          echo '<p class="spot_trend">Spot #'.($index +1).'</p>';
          echo '<p class="spot_anime_related text-truncate text-break">'.$item["description"].'</p>';
          echo '<h3 class="spot_title text-truncate text-break">' . $item['title']["english"] . '</h3>';
          if (isset($item['genres']) && is_array($item['genres'])) {
            $genreCount = 0; // Initialize a counter to keep track of displayed genres
        
            foreach ($item['genres'] as $genre) {
                if ($genreCount < 4) { // Display up to four genres
                    echo '<div class="spot_genres">' . $genre . '</div>';
                    $genreCount++; // Increment the counter for each displayed genre
                } else {
                    break; // If four genres have been displayed, exit the loop
                }
            }
        }
$anime_id= $item["title"]["userPreferred"];
$anime_id_str_low= strtolower($anime_id);
$gogoID= str_replace(' ','-',$anime_id_str_low);

        
          echo '<a href="https://xyxanime.rf.gd/watch/'.$gogoID.'-episode-1"><h3 class="spot_watch"><i class="fa-solid fa-circle-play"></i> Watch</h3></a>';
          echo '<div class="slide-content">';
          
    
          echo '</div>';
          echo '</div>';
        }
      } else {
        echo 'No data available.';
      }
    }
    curl_close($ch);
    ?>
  </div>
  <!-- If you want pagination -->
  <div class="swiper-pagination"></div>
</div>

<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script>
  const swiper = new Swiper('.swiper-container', {
    direction: 'horizontal',
    loop: true,
    autoplay: {
      delay: 2500, // Delay between slides in milliseconds
      disableOnInteraction: false, // Continue autoplay even when the user interacts with the slider
    },
    // If you want pagination
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
    // Navigation arrows
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    // And if we need scrollbar
    scrollbar: {
      el: '.swiper-scrollbar',
    },
  });
</script>
