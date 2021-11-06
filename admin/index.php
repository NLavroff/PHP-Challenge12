<?php

if (isset($_POST["content"])) {
    $file = "/home/nath/Documents/PHP/PHP-Challenge12/XFiles/files/" . $_POST['file'];
    $fileOpen = fopen($file, "w");
    fwrite($fileOpen, stripslashes($_POST["content"]));
    fclose($fileOpen);
}
?>

<?php include('../inc/head.php'); ?>

C'est ici que tu vas devoir afficher le contenu de tes repertoires et fichiers. <br>

<?php

$dir = opendir("/home/nath/Documents/PHP/PHP-Challenge12/XFiles/files/");
while ($file = readdir($dir)) {
    if (!in_array($file, array(".", ".."))) {
        echo '<a href="?f=' . $file . '">';
        echo $file . ' ';
        echo '</a>';
    }
}

$display = false;

if (isset($_GET["f"])) {
    echo "<h2>{$_GET["f"]}</h2>";
    $path = "/home/nath/Documents/PHP/PHP-Challenge12/XFiles/files/" . $_GET["f"];
    if (is_file($path)) {
        $display = true;
        $content = file_get_contents($path);
    }
    if (is_dir($path)) {
        $display = false;
        $dir_handle = opendir($path);
        while ($pathFile = readdir($dir_handle)) {
            if (!in_array($pathFile, array(".", ".."))) {
                echo '<a href="?f=' . $_GET["f"] . "/" . $pathFile . '">';
                echo $pathFile . ' ';
                echo '</a>';
            }
        }
    }

if ($display == true) {
        $finfo = finfo_open(FILEINFO_MIME);
        if (substr(finfo_file($finfo, $path), 0, 4) == 'text') { ?>
            <form method="POST" action="admin">
                <textarea name="content" style="width:100%; height:500px;">
            <?php echo $content; ?>
            </textarea>
                <input type="hidden" name="file" value="<?php echo $_GET["f"] ?>" />
                <input type="submit" value="Envoyer" />
            </form>
    <?php
        } else {
            echo "<img src=" . str_replace("/home/nath/Documents/PHP/PHP-Challenge12/XFiles", ".", $path) . " width=100% height=500px;>";
        }
    } ?>

<?php } ?>

<?php include('../inc/foot.php'); ?>