<?php
// filename: toc.php

// include blog info
include("info.php");

?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
<?php echo "$head_content\n"; ?>
<title><?php echo "$blog_title - $toc_title"; ?></title>
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

<div id="table-of-contents">
<h2><?php echo $toc_title; ?></h2>

<ul>

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

		// print filename without the html extension for the article ID:
		$filename = pathinfo("$file");
		$filename = $filename['filename'];

		// convert filename to date
		$file_date = substr_replace($file, "-", 4, 0);
		$file_date = substr_replace($file_date, "-", 7, 0);
		$file_date = substr($file_date, 0, -9);

		// get the article title from <h2> tag
		$file_content = file_get_contents("source/$file");
		$pattern = preg_quote("<h2>", '/');
		$pattern = "/^.*$pattern.*\$/m";
		if (preg_match_all($pattern, $file_content, $matches)) {
			$article_title = implode("\n", $matches[0]);
			$article_title = substr($article_title, 4, -5);
		} else {
			$article_title = "[[untitled]]";
		}

		// print file content to html
		echo "<li class='toc-entry'>";
		echo "<span>$file_date : </span>";
		echo "<a href='article.php?id=$filename'>$article_title</a>";
		echo "</li>\n";
	}
}
?>

</ul>
</div><!--table-of-contents-->

</main>
</body>
</html>
