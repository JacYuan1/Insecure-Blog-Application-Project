<?php include("templates/page_header.php");?>
<?php include("lib/auth.php") ?>
<!doctype html>
<html lang="en">
<head>
	<title>Admin</title>
	<?php include("templates/header.php"); ?>
</head>
<body>
	<?php include("templates/nav.php"); ?>
	<?php include("templates/contentstart.php"); ?>

<h2>Article Management</h2>

<p><button type="button" class="btn btn-primary" aria-label="Left Align" onclick="window.location='/newarticle.php';">
New Post <span class="fa fa-plus" aria-hidden="true"></span>
</button></p>

<table class="table">
<tr><th>Post Title</th><th>Author</th><th>Date</th><th>Modify</th><th>Delete</th></tr>

<?php
# get articles by user or, if role is admin, all articles
	if ($_SESSION['username'] == 'admin'){
		$result = get_article_list($dbconn);
		while ($row = pg_fetch_array($result)) {
	?>
<tr>
  <td><a href='article.php?aid=<?php echo $row['aid'] ?>'><?php echo $row['title'] ?></a></td>
  <td><?php echo $row['author'] ?></td>
  <td><?php echo substr($row['date'],0,10) ?></td>
  <td><a href="/editarticle.php?aid=<?php echo $row['aid'] ?>"><i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i></a></td>
  <td><a href="/deletearticle.php?aid=<?php echo $row['aid'] ?>"><i class="fa fa-times fa-2x" aria-hidden="true"></i></a></td>
</tr>
	<?php }} //close while loop ?>
<?php
# get articles by user or, if role is admin, all articles
	if ($_SESSION['username'] != 'admin'){
		$result = get_article_list($dbconn);
		while ($row = pg_fetch_array($result)) {
		if ($_SESSION['username'] == $row['author']){
	?>
<tr>
  <td><a href='article.php?aid=<?php echo $row['aid'] ?>'><?php echo $row['title'] ?></a></td>
  <td><?php echo $row['author'] ?></td>
  <td><?php echo substr($row['date'],0,10) ?></td>
  <td><a href="/editarticle.php?aid=<?php echo $row['aid'] ?>"><i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i></a></td>
  <td><a href="/deletearticle.php?aid=<?php echo $row['aid'] ?>"><i class="fa fa-times fa-2x" aria-hidden="true"></i></a></td>
</tr>
	<?php }}} //close while loop ?>
</table>
	<?php include("templates/contentstop.php"); ?>
	<?php include("templates/footer.php"); ?>
</body>
</html>