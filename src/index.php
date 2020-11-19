<?php
// filename: index.php

// include blog info
include("info.php");

?>
<!DOCTYPE html>
<html lang="<?=$lang?>">
<head>
<meta charset="utf-8">
<?=$head_content?>
<title><?=$blog_title?></title>
</head>
<body>
<header>
<h1><?=$blog_title?></h1>
<div id="blog-info">
<?=$blog_info?>
<p>[[ <a href="toc.php"><?=$toc_link?></a> ]]</p>
</div>
</header>
<main>

<?php
// read all files in source folder
$files = array();
$dir = opendir('source');
while(false != ($file = readdir($dir))) {
	if(($file != ".") and ($file != "..")) {
		$files[] = $file;
	}
}

// reverse sort files (last article on top) - based on filename
rsort($files);

// iterating articles files

// reset max articles
$max_articles = 0;
foreach ($files as $file) {

	// if $max_number_articles variable is not a number, use 10 as default
	if (!is_numeric($max_number_articles)) {
		$max_number_articles = 10;
	}

	// if there are more than 10 articles, stop iterating:
	if (++$max_articles > $max_number_articles) break;

	// read each file and print content
	if ($file != "." && $file != "..") {

		// print filename without the html extension for the article ID:
		$filename = pathinfo("$file");
		$filename = $filename['filename'];

		// convert filename to date
		$file_date = substr_replace($file, "-", 4, 0);
		$file_date = substr_replace($file_date, "-", 7, 0);
		$file_date = substr($file_date, 0, -9);

		// print file content to html
?>

<!-- ARTICLE -->
<div class="article" id="<?=$filename?>">
<span class="entry-url"><?=$published?>: <?=$file_date?></span>
<div class="content">
<a class="standalone-link" href="article.php?id=<?=$filename?>">&#128279;</a>
<?php echo file_get_contents("source/$file"); ?>
</div><!--content-->
</div><!--$filename-->

<?php
	}
}

// if there are more than 10 articles, show the next message:
if ($max_articles > $max_number_articles)
{ ?>
<p id="toc_message">[[ <a href="toc.php"><?=$toc_message?></a>. ]]</p>
<?php } ?>

</main>
</body>
</html>
