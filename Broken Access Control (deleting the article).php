<?php
session_start();
include("config.php");
include("lib/db.php");

$aid = $_GET['aid'];
$result = get_article_list($dbconn);
while ($row = pg_fetch_array($result)) {
	if ($_SESSION['username'] == 'admin' or $_SESSION['username'] == $row['author']) {
		#echo "aid=".$aid."<br>";
		$result = delete_article($dbconn, $aid);
		#echo "result=".$result."<br>";
		# Check result
		header("Location: /admin.php");
		}
	}

?>
