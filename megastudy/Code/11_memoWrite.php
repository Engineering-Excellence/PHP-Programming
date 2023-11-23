<?php
include './function/11_DBFunction.php';
//	memoList.php에서 POST 방식으로 넘어오는 데이터를 받아 DB에 저장한다.
if (!isset($_POST["name"]) || !isset($_POST["password"]) || !isset($_POST["memo"])) {
//		이름, 비밀번호, 메모중 1가지 이상이 POST 방식으로 넘어오지 않았으므로 memoList.php로 돌려보낸다.
    echo "<script>location.href='11_memoList.php';</script>";
    return;
}
//	위의 조건을 통과해서 여기까지 왔으면 셋다 POST 방식으로 넘어왔다는 것이다.
//	POST 방식으로 넘어온 데이터와 접속자 IP를 받는다.
$name = $_POST["name"];
$password = $_POST["password"];
$memo = $_POST["memo"];
$ip = $_SERVER["REMOTE_ADDR"];                    // 접속자 IP 주소를 받는다.
//	echo $ip;

//	insert 쿼리를 만든다.
$query = "INSERT INTO MEMO(name, password, memo, ip) VALUES (";
$query = $query . "'" . $name . "', '" . $password . "', '" . $memo . "', '" . $ip . "')";
//	echo $query;

$link = getLink();                                // DB에 접속한다.
mysqli_query($link, $query);                        // 쿼리를 실행한다.
dbClose($link);                                    // DB와 접속을 끊는다.

echo "<script>location.href='11_memoList.php';</script>";