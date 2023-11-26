<?php
include './function/12_freeboardFunction.php';

//	write.php에서 모두 POST 방식으로 넘어올 때만 저장한다.
if (isset($_POST["name"]) && isset($_POST["password"]) && isset($_POST["subject"]) && isset($_POST["content"])) {
    $name = $_POST["name"];
    $password = $_POST["password"];
    $subject = $_POST["subject"];
    $content = $_POST["content"];
// 		받은 내용을 DB에 insert 한다.
    insert($name, $password, $subject, $content);
}
//	list.php로 보낸다.
echo "<script>location.href='12_list.php';</script>";
