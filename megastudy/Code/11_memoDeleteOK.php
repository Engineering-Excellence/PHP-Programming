<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <title>Insert title here</title>
</head>

<body>
<?php
include './function/11_DBFunction.php';
//	POST 방식으로 넘어오는 삭제할 글번호와 돌아갈 페이지 번호 및 입력한 비밀번호를 받는다.
$idx = $_POST["idx"];
$page = $_POST["page"];
$password = $_POST["password"];

$link = getLink();
//	삭제할 글을 꺼내온다.	
$query = "SELECT * FROM memo WHERE idx = " . $idx;
$result = mysqli_query($link, $query);
$row = mysqli_fetch_array($result);

//	삭제할 글의 비밀번호와 넘겨받은 비밀번호를 비교해 일치하면 삭제한다. MySQL에 PASSWORD() 함수로 암호화 하지 않은 경우
// 	if($row["password"] == $password) {
// 		$query = "delete from memo where idx = " . $idx;
// 		mysqli_query($query, $link);
// 		echo "<script>";
// 		echo "alert('" . $idx . "번 글이 삭제되었습니다.');";
// 		echo "location.href='11_memoList.php?page=" . $page . "';";
// 		echo "</script>";
// 	} else {
// 		echo "<script>";
// 		echo "alert('비밀번호가 올바르지 않습니다.');";
// 		echo "location.href='11_memoList.php?page=" . $page . "';";
// 		echo "</script>";
// 	}

//	삭제할 글의 비밀번호와 넘겨받은 비밀번호를 비교해 일치하면 삭제한다. MySQL에 PASSWORD() 함수로 암호화 한 경우	
$query = "DELETE FROM MEMO WHERE idx = " . $idx . " && password = password('" . $password . "')";
//	echo $query . "<br/>";
echo "<script>";
if (mysqli_query($link, $query) == 1) {
    echo "alert('" . $idx . "번 글이 삭제되었습니다.');";
} else {
    echo "alert('비밀번호가 올바르지 않습니다.');";
}
echo "location.href='11_memoList.php?page=" . $page . "';";
echo "</script>";

dbClose($link);
?>
</body>

</html>