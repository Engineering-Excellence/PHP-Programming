<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <title>투표하기</title>
</head>

<body>
<?php
$filename = "../data/09_poll.txt";
//	file_exists("파일명") : 괄호 안의 파일이 있으면 true, 없으면 false를 리턴한다.
if (file_exists($filename)) {
    $poll = file($filename);                    // 파일 내용 전체를 읽어 배열에 저장한다.
    $itemCount = (count($poll) - 1) / 2;        // 투표 항목 수를 계산한다.
    ?>
    <form action="09_pollWrite.php" method="post">
        <table width="400" align="center" style="border: solid 3px;">
            <tr>
                <th><?= $poll[0] ?></th>
            </tr>
            <?php
            //	투표 항목수 만큼 반복하며 라디오 상자와 항목을 출력한다.
            for ($i = 1; $i <= $itemCount; $i++) {
                echo "<tr><td>";
                echo "<input type='radio' name='poll' value='" . $i . "' ";
                if ($i == 9) {
                    echo "checked=checked";
                }
                echo "/>";
                echo $poll[$i];
                echo "</td></tr>";
            }
            ?>
            <!-- 투표하기와 결과보기 버튼을 만든다. -->
            <tr>
                <td align="center">
                    <input type="submit" value="투표하기"/>
                    <input type="button" value="결과보기" onclick="location.href='09_pollResult.php'"/>
                </td>
            </tr>
        </table>
    </form>
    <?php

} else {
    echo "<script>";
    echo "alert('파일 없거덩~~~~ 만들고 하세용~~~');";
    echo "</script>";
}
?>
</body>

</html>