<?php
include './function/11_DBFunction.php';
//	POST 방식으로 넘어오는 수정할 글번호와 돌아갈 페이지 번호 및 입력한 비밀번호, 수정할 내용을 받는다.
$idx = $_POST["idx"];
$page = $_POST["page"];
$password = $_POST["password"];
$memo = $_POST["memo"];

$link = getLink();
//	수정할 글을 꺼내온다.	
$query = "SELECT * FROM MEMO WHERE idx = " . $idx;
$result = mysqli_query($link, $query);
$row = mysqli_fetch_array($result);

//	수정할 글의 비밀번호와 넘겨받은 비밀번호를 비교해 일치하면 수정한다. 
if ($row["password"] == $password) {
    $query = "UPDATE MEMO SET memo = '" . $memo . "' WHERE idx = " . $idx;
    mysqli_query($link, $query);
    echo "<script>";
    echo "alert('" . $idx . "번 글이 수정되었습니다.');";
} else {
    echo "<script>";
    echo "alert('비밀번호가 올바르지 않습니다.');";
}
echo "location.href='11_memoList.php?page=" . $page . "';";
echo "</script>";

dbClose($link);