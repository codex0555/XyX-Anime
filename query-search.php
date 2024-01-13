<!-- <?php
include("config.php");
?> -->
<?php
$keyword=$_GET["name"];
$key= htmlspecialchars($keyword);
$keyword = str_replace(' ', '%20', $key);
?>

<!-- Start of Result Of Query (Using Back-Up Engine)-->

<main class="">
    <div class="container-fluid">
        <div class="all-item">
            <div class="top-part mb-2">
        <h2 class="mt-5 fs-4">Search Result:</h2>
        </div>
        <div class="row">
            <?php
            $api = "https://api.anime-dex.workers.dev/search";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "$api/$keyword");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
            $response = curl_exec($ch);
            $jsonData = json_decode($response, true);

            // Loop through each anime result
            foreach ($jsonData["results"] as $result) {

                if(isset($result)){
                    $img = $result["img"];
                    $title = $result["title"];
                    $release = $result["releaseDate"];
                    $id = $result["id"];
                }
?>
                <div class="col-sm-6 col-md-4 col-lg-2 mb-2 adj">
                    <div class="holder mt-2">
                    <div class="card bg-dark">
                    <div class="spinner-border text-info spinning"></div>
                    <?php ?>
                        <a href="watch/<?= $id; ?>-episode-1">
                        <img data-src="<?= $img; ?>" class="card-img-top lazy" height="240" alt="">
                        </a>
                        <div class="play"><i class="fa-solid fa-play"></i></div>
                        <div class="card-body">
                            <span class="subordub"><?php
$inputString = $release;

// Use regular expression to extract the integer part
if (preg_match('/\d+/', $inputString, $matches)) {
    $intPart = $matches[0];
    echo $intPart;
} else {
    echo "404";
}
?></span>
                            <span class="ep rounded-tr-md bg-red-600"><?php $str = $title;
                                                  $last_word_start = strrpos ( $str , " ") + 1;
                                                  $last_word_end = strlen($str) - 1;
                                                  $last_word = substr($str, $last_word_start, $last_word_end);
                                                  if ($last_word == "(Dub)"){echo "DUB";} else {echo "SUB";}
                                                ?></span>
                        </div>
                    </div>
                    <div class="title text-truncate"><?= $title; ?></div>
                    </div>
                </div>
<?php
            }
?>
            
                
            
        </div>
        </div>
    </div>
    </main>

    <!-- End of Result of Query -->
