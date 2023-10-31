<!-- <?php
include("config.php");
?> --> <?php
$keyword=$_GET["name"];
$keyword = str_replace(' ', '%20', $keyword);
?> <!-- Start of Result Of Query --><main class=""><div class="container-fluid"><div class="all-item"><div class="top-part mb-2"><h2 class="mt-5 fs-4">Search Result</h2></div><div class="row"> <?php
            $api = "https://webdis-zgj8.onrender.com";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "$api/search?keyw=$keyword");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
            $response = curl_exec($ch);
            $json1 = json_decode($response, true);

            foreach ((array)$json1 as $xamp) {
                ?> <div class="col-sm-6 col-md-4 col-lg-2 mb-5 adj"><div class="holder mt-2"><div class="card bg-dark"><div class="spinner-border text-info spinning"></div><a href="watch/<?= $xamp["animeId"] ?>-episode-1"><img src="<?= $xamp["animeImg"]; ?>" class="card-img-top" height="240" alt=""></a><div class="play"><i class="fa-solid fa-play"></i></div><div class="card-body"><span class="subordub"><?php $str = $xamp['animeTitle'];
                                                  $last_word_start = strrpos ( $str , " ") + 1;
                                                  $last_word_end = strlen($str) - 1;
                                                  $last_word = substr($str, $last_word_start, $last_word_end);
                                                  if ($last_word == "(Dub)"){echo "DUB";} else {echo "SUB";}
                                                ?></span><span class="ep rounded-tr-md bg-red-600"><?php
$inputString = $xamp['status'];

// Use regular expression to extract the integer part
if (preg_match('/\d+/', $inputString, $matches)) {
    $intPart = $matches[0];
    echo $intPart;
} else {
    echo "404";
}
?></span></div><div class="title text-truncate"><?= $xamp["animeTitle"] ?></div></div></div></div> <?php
            }
            curl_close($ch);
            ?> </div></div></div></main><!-- End of Result of Query -->