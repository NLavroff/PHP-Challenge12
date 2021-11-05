
<?php
if (isset($_POST["content"])){
    $file = "/home/nath/Documents/PHP/PHP-Challenge12/XFiles/files/roswell/".$_POST['file'];
    $fileOpen = fopen($file, "w");
    fwrite($fileOpen, stripslashes($_POST["content"]));
    fclose($fileOpen);
}
?>

<?php include('../inc/head.php'); ?>

C'est ici que tu vas devoir afficher le contenu de tes repertoires et fichiers. <br>

<?php
    $dir = opendir("/home/nath/Documents/PHP/PHP-Challenge12/XFiles/files/roswell");
    while ($file = readdir($dir)){
        if (!in_array($file, array(".", ".."))) {
            echo '<a href="?f='.$file.'">';
            echo $file . ' ';
            echo '</a>';
    }
}
?>
<?php
if (isset($_GET["f"])) {
    echo "<h2>{$_GET["f"]}</h2>";
$file = "/home/nath/Documents/PHP/PHP-Challenge12/XFiles/files/roswell/". $_GET["f"];
$content = file_get_contents($file);
?>

<form method="POST" action="admin">
    <textarea name="content" style="width:100%; height:500px;">
    <?php echo $content; ?>
</textarea>
<input type="hidden" name="file" value="<?php echo $_GET["f"]?>"/>
    <input type="submit" value="Envoyer" />
</form>
<?php } ?>
<?php include('../inc/foot.php'); ?>