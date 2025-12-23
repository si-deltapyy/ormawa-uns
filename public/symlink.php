<?php
$target =$_SERVER['DOCUMENT_ROOT'].'/storage/app';
$link = $_SERVER['DOCUMENT_ROOT'].'./public_html/public/storage';
symlink($target, $link);
echo "Done";
?> 