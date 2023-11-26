<?php
include './function/12_freeboardFunction.php';
$currentPage = $_POST["page"];
$idx = $_POST["idx"];
$ref = $_POST["ref"];
$name = $_POST["name"];
$password = $_POST["password"];
$content = $_POST["content"];
//	넘겨받은 내용을 댓글 DB에 저장한다.
insertComment($ref, $name, $password, $content);
echo "<script>location.href='12_view.php?idx=" . $idx . "&page=" . $currentPage . "';</script>";
