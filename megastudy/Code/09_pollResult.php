<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="5; url=09_pollResult.php">
    <title>결과보기</title>
</head>

<body>
<?php
$filename = "../data/09_poll.txt";
if (file_exists($filename)) {
    $poll = file($filename);
    $itemCount = (count($poll) - 1) / 2;

//		총 투표수를 구한다.
    $sum = 0;
    for ($i = $itemCount + 1; $i < count($poll); $i++) {
        $sum += $poll[$i];
    }
    ?>
    <table width="700" align="center" border="0" style="border: solid 3px;">
        <tr>
            <th colspan="2"><?= $poll[0] ?></th>
        </tr>
        <tr>
            <td align="right" colspan="2">총 투표수 : <?= $sum ?>표</td>
        </tr>
        <?php
        $color = array("red", "blue", "lime", "maroon", "green", "aqua", "navy", "purple", "teal", "olive");
        for ($i = 1; $i <= $itemCount; $i++) {
            echo "<tr>";
            echo "<td width='200'>";
//		round(숫자, 자리수) : 숫자를 반올림해서 자리수 까지 표시한다.
//		$per = round($poll[$itemCount + $i] / $sum * 100, 2);
//		자리수가 -3이면 백의 자리에서 반올림해 천의 자리까지 표시한다.
//		자리수가 -2이면 십의 자리에서 반올림해 백의 자리까지 표시한다.
//		자리수가 -1이면 일의 자리에서 반올림해 십의 자리까지 표시한다.
//		자리수가 0이면 소수점 아래 첫째 자리에서 반올림해 일의 자리까지 표시한다.
//		자리수가 1이면 소수점 아래 둘째 자리에서 반올림해 첫째 자리까지 표시한다.
//		자리수가 2이면 소수점 아래 셋째 자리에서 반올림해 둘째 자리까지 표시한다.
//		자리수가 3이면 소수점 아래 넷째 자리에서 반올림해 셋째 자리까지 표시한다.

// 		number_format(숫자) : 괄호 안의 숫자에 천 단위마다 ","를 찍어준다.
// 		number_format(숫자, 소수점 아래 자리수) : 괄호 안의 숫자에 천 단위마다 ","를 찍고 지정된 자리까지 소수를 출력한다.
            $per = number_format($poll[$itemCount + $i] / $sum * 100, 2);
            echo $poll[$i] . "(" . $poll[$itemCount + $i] . "표, " . $per . "%)";
            echo "</td><td>";
// 		echo "<hr size='10' color='". $color[$i - 1] . "' align='left' width='" . 500 * $per / 100 . "'/>";
            echo "<hr size='10' color='" . $color[$i - 1] . "' align='left' width='" . $per . "%'/>";
            echo "</td></tr>";
        }
        ?>
        <tr>
            <td colspan="2" align="center">
                <input type="button" value="투표하기로 가기" onclick="location.href='09_poll.php'"/>
            </td>
        </tr>
    </table>
    <?php
} else {
    echo "<script>";
    echo "alert('파일 없거덩~~~~ 만들고 하세용~~~');";
    echo "</script>";
}
?>
</body>

</html>