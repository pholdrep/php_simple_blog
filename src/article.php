<?php
// filename: article.php

// get the file
$filename = $_GET["id"];

// add the .html extension the file name:
$file = "$filename.html";

// get the article title from <h2> tag
$file_content = file_get_contents("source/$file");
$pattern = preg_quote("<h2>", '/');
$pattern = "/^.*$pattern.*\$/m";
if (preg_match_all($pattern, $file_content, $matches)) {
	$article_title = implode("\n", $matches[0]);
	$article_title = substr($article_title, 4, -5);
} else {
	$article_title = "";
}

// include blog info
include("info.php");

// if file exist, then open the article in the article.php page
// if not, redirect page to index.php
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
<title><?php echo "$blog_title - $article_title"; ?></title>
</head>
<body>
<header>
<h1><?php echo $blog_title; ?></h1>
<div id="blog-info">
<?php echo "$blog_info\n"; ?>
</div>
	<p>&lt;== <a href="./"><?php echo $go_back; ?></a></p>
</header>
<main>
<?php
		// read selected file info

		// convert filename to date
		$file_date = substr_replace($file, "-", 4, 0);
		$file_date = substr_replace($file_date, "-", 7, 0);
		$file_date = substr($file_date, 0, -9);

		// print file content to html
		echo "<div class='article' id='$filename'>";
		echo "<span class='entry-url'>$published: $file_date</span>";
		echo "<div class='content'>";
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
