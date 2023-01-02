<?php include("templates/page_header.php");?>
<?php
//First, check to see if we got an article id to lookup.
//If there was no article id suppled, redirect to homepage.
//Since we're potentially doing a redirect, this has to come before ANY html content.
	if (!isset($_GET['aid'])) {
		header("Location: /"); 
	}
	$aid = $_GET['aid'];
	$result=get_article($dbconn, $aid);
	$row = pg_fetch_array($result, 0); //There should only be one row
?>
<!doctype html>
<html lang="en">
<head>
<title><?php echo htmlspecialchars($row['title'], ENT_QUOTES, 'UTF-8');?></title>
	<?php include("templates/header.php"); ?>



</head>
<body>
	<?php include("templates/nav.php"); ?>
	<?php include("templates/contentstart.php"); ?>

	<h3 class="pb-4 mb-4 font-italic border-bottom">
        Off the dome. Here we go ... 
      	</h3>

	<div class="blog-post">
	<h2 class="blog-post-title"><?php echo htmlspecialchars($row['title'], ENT_QUOTES, 'UTF-8');?></h2>
	<p class="blog-post-meta">
		<?php echo substr($row['date'], 0, 10)." by ".$row['author'] ?>
	</p><p>
		<?php echo htmlspecialchars($row['content'], ENT_QUOTES, 'UTF-8');?>
	</p>
      </div><!-- /.blog-post -->
	<?php include("templates/contentstop.php"); ?>
	<?php include("templates/footer.php"); ?>
</body>
</html>
