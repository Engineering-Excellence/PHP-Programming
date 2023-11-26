<?php
include './function/12_freeboardFunction.php';
$currentPage = $_GET["page"];
$idx = $_GET["idx"];
hitIncrement($idx);
echo "<script>location.href='12_view.php?idx=" . $idx . "&page=" . $currentPage . "';</script>";
