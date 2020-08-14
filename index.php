<?php

/*********************************************\
#   Script que exibe o conteúdo de uma        #
#   pasta de forma mais organizada. Salve     #
#   como "index.php", mas não se esqueça de   #
#   verificar se já existe um arquivo com     #
#   esse nome na pasta.                       #
#                                             #
#   Autor: Carlos H. Reche                    #
#   E-mail: carlosreche@yahoo.com             #
#                                             #
#   Por favor, mantenha os créditos =)        #
#                                             #
\*********************************************/

?>
<html>
<head>
<style type="text/css">

body {
    margin-left: 20px;
    margin-right: 20px;
    color: #333333;
    font-family: arial black;
}

a:link {font-size: 50px; pxcolor: #023f88; font-weight: bold; text-decoration: none;}
a:hover {font-size: 50px; color: #00aeef; font-weight: bold; text-decoration: none;}
a:active {font-size: 50px; color: #00aeef; font-weight: bold; text-decoration: none;}
a:visited {font-size: 50px; font-weight: bold; text-decoration: none;}

#pasta {font-size: 50px; color: #023f88; font-weight: normal; text-decoration: none;}
#pasta a:hover {color: #0099ff;}

</style>
</head>
<body vlink="#023f88">

<div id="pasta" style="margin-top: 20px; margin-left: 50px;">
<font color="#666666"><strong>Pasta:</strong></font>
<?php
$raiz = end(explode("/", $_SERVER['DOCUMENT_ROOT']));

$pasta = explode("/", $_SERVER['PHP_SELF']);
$tot = count($pasta); $tot--;

if ($tot > "1") {
    echo "<a id=\"pasta\" href=\"";
    for ($z = 0; $z <= $tot; $z++) { echo "../"; }
    echo "\">";
} else { echo "<font color=\"#0066cc\">"; }
    echo $raiz . "/</a></font>";

for ($i = 1; $i <= $tot; $i++) {
    if (@$pasta[$i+1]) {
        if (@$pasta[$i+2]) {
            echo "<a style=\"font-weight: normal;\" href=\"";
            for ($z = 1; $z <= $i; $z++) { echo "../"; }
            echo "\">";
        } else { echo "<font color=\"#0066cc\">";}
        echo $pasta[$i] . "/</a></font>"; $tem = 1;
    }
}
?>
</div>

<div style="margin-top: 20px;">

<?php
// Abre um diretorio conhecido, e faz a leitura de seu conteudo
$dir = ".";

if ($dh = opendir($dir)) {
    while (($file = readdir($dh)) !== false) {
        if ($file == '..') {
            if (@$tem == 1) {
                echo "<a href=\"" . $file . "\"><img src=\"http://localhost/icons/back.gif\" border=\"0\" /> ";
                echo "Diretório anterior</a><br />";
            } else {
                echo "<br style=\"line-height: 26px;\" />";
            }
            echo "<hr noshade color=\"#cccccc\" style=\"margin-left: -20px;\" />";
        }
        if (is_dir($file) && ($file != ".") && ($file != "..")) {
            echo "<a href=\"" . $file . "\"><img src=\"/icons/folder.gif\" border=\"0\" /> $file</a><br />";
        }
    }
    closedir($dh);
}
?>
<table border="0" cellpadding="0" cellspacing="0">
<?php
if ($dh = opendir($dir)) {
    while (($file = readdir($dh)) !== false) {
        $quebra = explode('.', $file);
        $ext = strtolower(end($quebra));

        if (($file != '.') && ($file != '..') && ($ext != $quebra[0]) && ($ext != false)) {
            echo "<tr><td><a href=\"$dir/$file\">";

            if ($quebra[0] == "index") {
                echo "<img src=\"/icons/index.gif\" border=\"0\" /> ";
            }
            else if ($ext == "exe" || $ext == "msi") {
                echo "<img src=\"/icons/comp.gray.gif\" border=\"0\" /> ";
            }
            else if ($ext == "html" || $ext == "msi") {
                echo "<img src=\"/icons/html.gif\" border=\"0\" /> ";
            }
            else if ($ext == "php" || $ext == "asp" || $ext == "htm" || $ext == "html" || $ext == "shtml" || $ext == "phtml") {
                echo "<img src=\"icons/layout.gif\" border=\"0\" /> ";
            }
            else if ($ext == "jpg" || $ext == "jpeg" || $ext == "gif" || $ext == "png") {
                echo "<img src=\"icons/image2.gif\" border=\"0\" /> ";
            }
            else if ($ext == "js" || $ext == "cgi") {
                echo "<img src=\"/icons/script.gif\" border=\"0\" /> ";
            }
            else if ($ext == "mp3" || $ext == "asf" || $ext == "au" || $ext == "wav" || $ext == "mid") {
                echo "<img src=\"/icons/sound1.gif\" border=\"0\" /> ";
            }
            else if ($ext == "mpg" || $ext == "mpeg" || $ext == "qt" || $ext == "wmv" || $ext == "mov" || $ext == "avi") {
                echo "<img src=\"/icons/movie.gif\" border=\"0\" /> ";
            }
            else if ($ext == "doc" || $ext == "txt" || $ext == "pdf") {
                echo "<img src=\"/icons/text.gif\" border=\"0\" /> ";
            }
            else if ($ext == "zip" || $ext == "tar" || $ext == "arj") {
                echo "<img src=\"/icons/compressed.gif\" border=\"0\" /> ";
            } else {
                echo "<img src=\"/icons/generic.gif\" border=\"0\" /> ";
            }

            echo "" . $file . " </a></td><td align=\"right\" style=\"padding-left: 50px; padding-right: 5px;\">";
            $tamanho = filesize($file);
            if ($tamanho < "1024") {
                echo number_format($tamanho, 0, ",", ".") . " </td><td> bytes </td></tr>";
            }
            else if ($tamanho/1024 < "1024") {
                echo number_format($tamanho/1024, 2, ",", ".") . " </td><td> KB </td></tr>";
            } else {
                echo number_format($tamanho/(1024*1024), 2, ",", ".") . " </td><td> MB </td></tr>";
            }
        }
    }
    closedir($dh);
}
?>

</table>
</div>

</body>
</html>