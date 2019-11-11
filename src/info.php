<?php
// filename: info.php

// blog language
$lang = "en";

// blog title
$blog_title = "a simple blog";

// blog author
$blog_author = "author name";

// head meta description
$meta_description = "a simple php blog";

// head meta keywords
$meta_keywords = "blog, php";

// blog info in html
$blog_info = <<<HTML
<p>a brief blog description</p>
HTML;

// head
$head_content = <<<EOF
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="title" content="$blog_title">
<meta name="author" content="$blog_author">
<meta name="description" content="$meta_description">
<meta name="keywords" content="$meta_keywords">
<link type="text/css" rel="stylesheet" href="style.css">
EOF;
?>
