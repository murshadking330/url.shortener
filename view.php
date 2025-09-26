<?php
$dbFile = "links.json";
$links = file_exists($dbFile) ? json_decode(file_get_contents($dbFile), true) : [];

$code = trim($_GET['code'] ?? '');

if ($code && isset($links[$code])) {
    $image = $links[$code]['image'];
    $url = $links[$code]['url'];
    $timer = $links[$code]['timer'];
    ?>
    <!DOCTYPE html>
    <html>
    <head>
      <meta charset="UTF-8">
      <title>🇮🇳মেট্রো রেলের ঢাকা🌿🍀🌹</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <style>
        body, html {
          margin: 0;
          padding: 0;
          background: black;
          height: 100%;
          display: flex;
          justify-content: center;
          align-items: center;
        }
        img {
          max-width: 100%;
          max-height: 100%;
          object-fit: contain;
        }
      </style>
    </head>
    <body>
      <img src="<?php echo $image; ?>" alt="Redirect Image">
      <script>
        setTimeout(function() {
          window.location.href = "<?php echo $url; ?>";
        }, <?php echo $timer * 1000; ?>);
      </script>
    </body>
    </html>
    <?php
} else {
    echo "❌ Invalid or expired link";
}
?>
