<?php
//	POST 방식으로 넘어오는 투표 항목을 받는다.
if (!isset($_POST["poll"])) {
//		POST 방식으로 넘어온 데이터가 없다면 누군가가 URI 창에 GET 방식으로 데이터를 던진것이다.
//		투표 항목이 정상적으로 넘어오지 않았으므로 투표하기로 다시 돌려보낸다.
    echo "<script>";
    echo "alert('장난해??');";
    echo "location.href='09_poll.php';";
//		echo "<meta http-equiv='refresh' content='0; url=09_poll.php'>";
    echo "</script>";
} else {
    $vote = $_POST["poll"];
//		echo $vote."번에 투표 하셨습니다.<br/>";
//		파일을 읽어서 해당 번호의 값을 1증가 시킨 후 다시 저장한다.
    $filename = "../data/09_poll.txt";
    if (file_exists($filename)) {

        $poll = file($filename);                    // 파일 내용 전체를 읽어 배열에 저장한다.
        $itemCount = (count($poll) - 1) / 2;        // 투표 항목 수를 계산한다.
//			투표된 항목의 득표수를 1증가 시킨다.
// 			$poll[$vote + $itemCount] += 1;
        $poll[$vote + $itemCount] = $poll[$vote + $itemCount] + 1 . "\r\n";
// 			\r(carriage return) : 줄의 처음으로 커서를 보낸다.
//			\n(new line) : 줄을 바꾼다.
//			echo $poll[$vote + $itemCount]."<br/>";
//			DB 였다면 숫자 1개만 수정하면 되지만 텍스트 파일이기 때문에 모두 기록해야 한다.

        $f = fopen($filename, "w");                    // 파일을 출력용으로 연다.
        for ($i = 0; $i < count($poll); $i++) {
            fwrite($f, $poll[$i]);                    // 배열의 내용을 파일로 출력한다.
        }
//			출력 작업 후 출력 파일을 닫지 않으면 파일에 데이터가 저장되지 않으니 반드시 닫아준다.
        fclose($f);                                    // 출력 파일을 닫는다.

//			결과 보기로 보낸다.
        echo "<script>location.href='09_pollResult.php';</script>";

    } else {
        echo "<script>";
        echo "alert('파일 없거덩~~~~ 만들고 하세용~~~');";
        echo "</script>";
    }
}
?>