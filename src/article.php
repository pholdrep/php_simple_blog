<?php
// filename: article.php

// include blog info
include("info.php");

// if file exist, then open the article in the article.php page
// if not, redirect page to index.php
	$file = $_GET["src"];
	if ($file == "" ) {
		header("location: ./");
	} elseif (!file_exists("source/$file")) {
		header("location: ./");
	} else {
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
<?php echo "$head_content\n"; ?>
<title><?php echo $blog_title; ?></title>
</head>
<body>
<header>
<h1><?php echo $blog_title; ?></h1>
<div id="blog-info">
<?php echo "$blog_info\n"; ?>
</div>
<p>&lt;== <a href="./">go back</a></p>
</header>
<main>
<?php
		// read selected file info

		// convert filename to date
		$file_date = substr_replace($file, "-", 4, 0);
		$file_date = substr_replace($file_date, "-", 7, 0);
		$file_date = substr($file_date, 0, -9);

		// print file content to html
		echo "<div id='$file'>\n";
		echo "<span class='entry-url'>Published: $file_date</span>\n";
		echo "\n<div class='content'>\n";
		echo file_get_contents("source/$file");
		echo "</div><!--content-->\n";
		echo "</div>\n";
?>
</main>
</body>
</html>
<?php
	}
?>
