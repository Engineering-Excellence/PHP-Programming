<?php
include './function/07_myCalendar.php';
?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <title>Calendar</title>
    <link rel="stylesheet" href="../css/07_calendar.css">
</head>

<body>
<?php
//	현재 페이지가 최초로 로드되면 이전 페이지가 존재하지 않으므로 GET 방식이던 POST 방식이던 넘어오는 값이 존재하지 않는다.
//	최초로 로드될 때 현재 컴퓨터의 년, 월을 가지고 달력을 출력하기 위해 컴퓨터 시스템의 년, 월을 받아서 처리한다.
if (isset($_GET["year"]) && isset($_GET["month"])) {
    $year = $_GET["year"];                    // GET 방식으로 넘어오는 년을 받는다.
    $month = $_GET["month"];                // GET 방식으로 넘어오는 월을 받는다.
//		월이 0이 되면 전년도 12월로 변경하고 월이 13이 되면 다음년도 1월로 변경한다.
    if ($month <= 0) {
        $month = 12;
        if (--$year <= 0) {
//				신나게 전달을 누르다 기원전이 되면 컴퓨터 시스템의 날짜로 달력을 출력한다.
            $year = date("Y");
            $month = date("m");
        }
    } elseif ($month >= 13) {
        $year++;
        $month = 1;
    }
} else {
    $year = date("Y");                        // 컴퓨터 시스템의 년을 받는다.
    $month = date("m");                        // 컴퓨터 시스템의 년을 받는다.
}

/* 여기부터
echo $year."년 ".$month."월<br/>";
echo (isYoun($year) ? "윤년" : "평년")."<br/>";
echo (isYoun(2017) ? "윤년" : "평년")."<br/>";
echo lastDay($year, $month)."<br/>";
echo lastDay(2016, 2)."<br/>";
echo totalDay($year, $month, 22)."<br/>";
echo weekDay($year, $month, 22)."<br/>";
여기까지 달력 관련 함수 테스트 코드 */
?>
<table width="700" align="center" border="1">
    <tr>
        <th>
            <a href="?year=<?= $year ?>&month=<?= $month - 1 ?>">전달</a>
        </th>
        <th style="font-size: 30px; color: blue;" colspan="5"><?= $year ?>년 <?= $month ?>월</th>
        <th>
            <a href="?year=<?= $year ?>&month=<?= $month + 1 ?>">다음달</a>
        </th>
    </tr>
    <tr>
        <td class="sun">일</td>
        <td class="etc">월</td>
        <td class="etc">화</td>
        <td class="etc">수</td>
        <td class="etc">목</td>
        <td class="etc">금</td>
        <td class="sat">토</td>
    </tr>
    <tr>
        <?php
        //	1일이 출력될 위치를 맞추기 위해 1일의 요일만큼 반복하며 전달의 날짜를 출력한다.
        $week = weekDay($year, $month, 1);                            // 1일의 요일을 숫자로 구한다.
        if ($month == 1) {
            $start = lastDay($year - 1, 12) - $week + 1;                // 출력을 시작할 전달 날짜를 계산한다. 1월
        } else {
            $start = lastDay($year, $month - 1) - $week + 1;            // 출력을 시작할 전달 날짜를 계산한다. 2~12월
        }

        for ($i = 1; $i <= $week; $i++) {
// 		echo "<td>&nbsp;</td>";									// 빈칸을 출력한다.
            echo "<td class='pday'>";
            echo ($month == 1 ? "12" : $month - 1) . "/" . $start++;        // 전달의 날짜를 출력한다.
            echo "</td>";

        }

        //	1일 부터 그 달의 마지막 날짜까지 반복하며 날짜를 출력한다.
        for ($i = 1; $i <= lastDay($year, $month); $i++) {
            $week = weekDay($year, $month, $i);                        // 출력한 날짜의 요일을 숫자로 구한다.

            switch ($week) {
                case 0:
                    echo "<td class='day0'>" . $i;                    // 날짜를 출력한다. 일요일
                    break;
                case 6:
                    echo "<td class='day6'>" . $i;                    // 토요일
                    break;
                default:
                    echo "<td class='day'>" . $i;                        // 평일
            }

            if ($month == 1 && $i == 1) echo "<br/><div class='hday'>신정</div>";
            if ($month == 3 && $i == 1) echo "<br/><div class='hday'>삼일절</div>";
            if ($month == 5 && $i == 5) echo "<br/><div class='hday'>어린이날</div>";
            if ($month == 6 && $i == 6) echo "<br/><div class='hday'>현충일</div>";
            if ($month == 8 && $i == 15) echo "<br/><div class='hday'>광복절</div>";
            if ($month == 10 && $i == 3) echo "<br/><div class='hday'>개천절</div>";
            if ($month == 10 && $i == 9) echo "<br/><div class='hday'>한글날</div>";
            if ($month == 12 && $i == 25) echo "<br/><div class='hday'>크리스마스</div>";

            echo "</td>";

// 		출력한 날짜가 토요일이고 마지막 날짜가 아니면 줄을 바꿔준다.
            if ($week == 6 && $i != lastDay($year, $month)) {
                echo "</tr><tr>";
            }
        }

        //	마지막 날짜 출력 후 빈 칸에 다음달 날짜를 출력한다.
        $start = 1;
        for ($i = $week + 1; $i < 7; $i++) {
            echo "<td class='pday'>";
            echo ($month == 12 ? "1" : $month + 1) . "/" . $start++;        // 다음달의 날짜를 출력한다.
            echo "</td>";
        }
        ?>
    </tr>
    <tr>
        <td colspan="7">
            <form action="?" method="get">
                <select name="year">
                    <option>년도를 선택하세요</option>
                    <?php
                    for ($i = 1950; $i <= 2050; $i++) {
                        echo "<option>" . $i . "</option>";
                    }
                    ?>
                </select>
                <select name="month">
                    <option>월을 선택하세요</option>
                    <?php
                    for ($i = 1; $i <= 12; $i++) {
                        echo "<option>" . $i . "</option>";
                    }
                    ?>
                </select>
                <input type="submit" value="달력보기">
            </form>
        </td>
    </tr>
</table>
</body>

</html>