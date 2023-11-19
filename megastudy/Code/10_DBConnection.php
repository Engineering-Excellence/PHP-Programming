<?php
$link = mysqli_connect("localhost", "root", "");
//	mysql_connect() 함수가 오류를 발생시킬 경우 php.ini에 수정할 내용
//	extension_dir="C:\xampp\php\ext" 아래에 다음의 내용을 추가한다.
//	추가할 내용 ==> extension = php_mysql.dll

//	$link = mysql_connect("localhost", "root", "", "phpdb");			// 이전 DB 연결방법

if (!$link) {
    die('Could not connect: ' . mysqli_connect_error());
    echo "연결 실패<br/>";
} else {
    echo "연결 성공<br/>";
}
?>