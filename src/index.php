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

// read each file and print content
foreach ($files as $file) {
	if ($file != "." && $file != "..") {

		// convert filename to date
		$file_date = substr_replace($file, "-", 4, 0);
		$file_date = substr_replace($file_date, "-", 7, 0);
		$file_date = substr($file_date, 0, -9);

		// print file content to html
		echo "<div id='$file'>\n";
		echo "<span class='entry-url'>Published: <a href='#$file'>$file_date</a></span>\n";
		echo "\n<div class='content'>\n";
		echo "<a class='standalone-link' href='article.php?src=$file'>&#128279;</a>\n";
		echo file_get_contents("source/$file");
		echo "</div><!--content-->\n";
		echo "</div>\n\n";
	}
}
?>
</main>
</body>
</html>
