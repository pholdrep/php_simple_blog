<?php
// filename: index.php

// include blog info
include("info.php");
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
<p>[[ <a href="toc.php"><?php echo "$toc_link"; ?></a> ]]</p>
</div>
</header>
<main>

<?php
// read all files in source folder
$files = array();
$dir = opendir('source');
while(false != ($file = readdir($dir))) {
	if(($file != ".") and ($file != "..") and ($file != "index.php")) {
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
		echo "<!-- ARTICLE -->\n";
		echo "<div class='article' id='$filename'>\n";
		echo "<span class='entry-url'>$published: $file_date</span>\n";
		echo "<div class='content'>\n";
		echo "<a class='standalone-link' href='article.php?id=$filename'>&#128279;</a>\n";
		echo file_get_contents("source/$file");
		echo "</div><!--content-->\n";
		echo "</div><!--$filename-->\n\n";
	}
}

// if there are more than 10 articles, show the next message:
if ($max_articles > $max_number_articles) {
	echo "<p id='toc_message'>[[ <a href='toc.php'>$toc_message</a>. ]]</p>";
}

?>
</main>
</body>
</html>
