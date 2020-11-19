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

// Max articles to show in the homepage
$max_number_articles = "10";

// blog info in html
$blog_info = <<<HTML
<p>a brief blog description</p>
HTML;

// translation
$published = "published";
$go_back = "go back";
$toc_link = "view table of contents";
$toc_title = "table of contents";
$toc_message = "There all more articles. View all of them in the table of contents";

// head
$head_content = <<<HTML
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="title" content="$blog_title">
<meta name="author" content="$blog_author">
<meta name="description" content="$meta_description">
<meta name="keywords" content="$meta_keywords">
<link rel="icon" href="files/favicon.ico" type="image/ico">
<link type="text/css" rel="stylesheet" href="style.css">
HTML;
?>
