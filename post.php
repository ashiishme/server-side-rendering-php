<?php

// Your API URL with slug as a param. If you are using WordPress please correct the url structure
// wp-json/wp/v2/posts?slug=

$api = 'https://www.yourdomain.com/api/wp-json/wp/v2/posts?slug=';
// Your site root
$siteRoot = 'https://www.yourdomain.com/';

$title = $excerpt = $content = $images_url = $page_url = '';

// We will check if the slug param is set and get the slug value using $_GET method
$slug = (isset($_GET['slug'])) ? $_GET['slug'] : '';
// Returns the raw data from API.
$raw_data = file_get_contents($api . $slug);
$data = json_decode($raw_data);

$title = $data[0]->title->rendered;
$excerpt = $data[0]->excerpt->rendered;
$content = $data[0]->content->rendered;

// featured_image_src is the custom field provided by our headless CMS theme.
$images_url = $data[0]->featured_image_src;
$page_url = $siteRoot . "blog/" . $data[0]->slug;
?>

// Your HTML code 
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $title; ?></title>
  <!--SEO-->
  <meta name="description" content="<?php echo $excerpt; ?>">
  <meta name="author" content="Author Name">
  <!-- Open Graph For Facebook -->
  <meta property="og:site_name" content="Site Name">
  <meta property="og:type" content="website">
  <meta property="og:title" content="<?php echo $title; ?>" />
  <meta property="og:url" content="<?php echo $page_url; ?>">
  <meta property="og:description" content="<?php echo $excerpt; ?>">
  <meta property="og:image" content="<?php echo $image_url; ?>">
  <!--/ Open Graph -->
</head>
<body>
  <img src="<?php echo $image_url; ?>">
  <h1><?php echo $title; ?></h1>
  <p><?php echo $content; ?></p>
</body>
</html>