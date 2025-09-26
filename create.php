<?php
$dbFile = "links.json";
$uploadDir = "uploads/";

// Load existing links
$links = file_exists($dbFile) ? json_decode(file_get_contents($dbFile), true) : [];

// Handle image upload
$imageName = time() . "_" . basename($_FILES["image"]["name"]);
$targetFile = $uploadDir . $imageName;
move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile);

// Form data
$url = $_POST['url'];
$timer = intval($_POST['timer']);

// Generate unique short code
$shortCode = substr(md5(uniqid()), 0, 6);

// Save link info
$links[$shortCode] = [
    "image" => $targetFile,
    "url" => $url,
    "timer" => $timer
];
file_put_contents($dbFile, json_encode($links));

// Show short link (plain text only)
$domain = $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'];
$shortLink = $domain . "/" . $shortCode;

echo $shortLink;
?>
