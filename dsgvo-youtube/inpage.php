<?php
function dsgvo_youtube_inpage_shortcode($atts, $content = null ) {

    $values = shortcode_atts( array(
        'videoid'   	=> '#',
        'target'	=> '_self',
        'images'	=> '#',
        'alt'	=> '#',
        'width'	=> '#',
        'height'	=> '#',
    ), $atts );



$array = explode("=", $values['videoid']);

// Überprüfen, ob das Array mindestens zwei Elemente enthält, bevor auf Index 1 zugegriffen wird
$youtubecode = isset($array[1]) ? $array[1] : '';

$images = preg_replace('/\sonerror=([^\s>]+)/i', '', $values['images']);
$images = esc_url($images);
$alt = esc_attr($values['alt']);
$width = esc_attr($values['width']);
$height = esc_attr($values['height']);
$videoid = esc_attr($values['videoid']);

// eindeutige id pro shortcode-instanz, sonst funktioniert nur das erste video
$uid = 'dsgvoyt_' . uniqid();


    ob_start(); ?>
    <a href="#" id="<?php echo $uid; ?>_link">
    <img src="<?php echo $images; ?>" alt="<?php echo $alt; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>">
</a>
<div id="<?php echo $uid; ?>_container" style="width: <?php echo $width; ?>px; height: <?php echo $height; ?>px;"></div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var loadVideoLink = document.getElementById("<?php echo $uid; ?>_link");
            var videoContainer = document.getElementById("<?php echo $uid; ?>_container");

            if (!loadVideoLink || !videoContainer) return;

            loadVideoLink.addEventListener("click", function(e) {
                // verhindert das hochspringen zum seitenanfang
                e.preventDefault();

                // YouTube-iFrame erst beim klick erzeugen
                var iframe = document.createElement("iframe");
                iframe.setAttribute("width", "<?php echo $width; ?>");
                iframe.setAttribute("height", "<?php echo $height; ?>");
                iframe.setAttribute("src", "https://www.youtube.com/embed/<?php echo $videoid; ?>");
                iframe.setAttribute("frameborder", "0");
                iframe.setAttribute("allowfullscreen", "");
                iframe.setAttribute("title", "<?php echo $alt; ?>");

                // iFrame in den container einsetzen
                videoContainer.appendChild(iframe);

                // thumbnail/link ausblenden
                loadVideoLink.style.display = "none";
            });
        });
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('dsgvo-youtube-inpage', 'dsgvo_youtube_inpage_shortcode');
?>
