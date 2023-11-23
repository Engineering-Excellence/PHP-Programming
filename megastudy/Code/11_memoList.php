<?php
if (!isset($_SESSION)) {
    session_start();
}
include "./function/11_DBFunction.php";
?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <title>메모장</title>
    <script type="text/javascript">
        function formCheck() {							// 폼에 입력된 값이 유효한지 검사하는 함수
            f = document.memoForm;
            if (!f.name.value || f.name.value.trim().length === 0) {
                alert("이름을 입력하세요!!!");
                f.name.value = "";
                f.name.focus();
                return false;
            }
            if (!f.password.value || f.password.value.trim().length === 0) {
                alert("비밀번호를 입력하세요!!!");
                f.password.value = "";
                f.password.focus();
                return false;
            }
            if (!f.memo.value || f.memo.value.trim().length === 0) {
                alert("메모를 입력하세요!!!");
                f.memo.value = "";
                f.memo.focus();
                return false;
            }
            return true;
        }
    </script>
    <style type="text/css">
        a:LINK {
            color: black;
            text-decoration: none;
        }

        a:VISITED {
            color: black;
            text-decoration: none;
        }

        a:HOVER {
            color: red;
            text-decoration: none;
            font-weight: bold;
        }

        a:ACTIVE {
            color: black;
            text-decoration: none;
        }
    </style>
</head>

<body>
<?php
$link = getLink();                                            // DB 연결을 얻어온다.

if (isset($_GET["viewCount"])) {
// 		넘겨받은 화면에 표시할 페이지 수(viewCount)로 $pageSize를 초기화 한다.
    $pageSize = $_GET["viewCount"];
//		넘겨받은 화면에 표시할 페이지 수를 세션에 저장한다.
    $_SESSION["viewCount"] = $_GET["viewCount"];
} else {
    /*
    if (isset($_SESSION["viewCount"])) {
//			세션에 저장된 화면에 표시할 페이지 수가 있으면 $pageSize를 초기화 한다.
        $pageSize = $_SESSION["viewCount"];
    } else {
//			게시판이 최초로 실행될 경우 넘겨받는 화면에 표시할 페이지 수가 없으므로 $pageSize를 기본값 으로 초기화 한다.
        $pageSize = 5;
    }
    */
    $pageSize = $_SESSION["viewCount"] ?? 5;
}

$totalCount = getTotalCount();                                // 전체 글의 개수
//	echo $totalCount . "<br/>";
$totalPage = (int)(($totalCount - 1) / $pageSize) + 1;        // 전체 페이지의 개수
// 	echo $totalPage . "<br/>";

// 	게시판이 최초로 실행되면 이전 페이지가 존재하지 않는다.
//	따라서 GET 방식이던 POST 방식이던 넘어오는 현재 화면에 표시할 페이지가 존재하지 않으므로 에러가 발생된다.
//	일단 현재 화면에 표시할 페이지 번호를 1로 설정해 주고 GET 방식으로 넘어오는 페이지 번호가 존재하면 변경해 준다.
$currentPage = 1;                                            // 현재 화면에 표시될 페이지 번호
if (isset($_GET["page"])) {
    $currentPage = (int)($_GET["page"]);
}
//	GET 방식으로 넘어온 페이지 번호가 페이지의 유효 범위를 넘어가면 1로 설정해 준다.
if ($currentPage <= 0 || $currentPage > $totalPage) {
    $currentPage = 1;
}

//	화면에 표시할 페이지의 시작 글번호를 계산한다.
//	MySQL은 select 실행시 출력되는 첫 레코드의 인덱스 번호가 0이다.
//	ORACLE을 이용해서 아래의 식을 처리할 경우 select 실행시 출력되는 첫 레코드의 인덱스 번호는 1이므로 1을 더해줘야 한다.
$startNo = ($currentPage - 1) * $pageSize;
//	$endNo = $startNo + $pageSize - 1;

//	게시판 하단의 페이지 이동 하이퍼링크 시작 페이지 번호와 끝 페이지 번호를 계산한다.
$startPage = (int)(($currentPage - 1) / 10) * 10 + 1;
$endPage = $startPage + 9;
?>
<table width="1000" align="center" border="1">
    <tr>
        <td>
            <form action="?" method="get">
                <select name="viewCount">
                    <option>화면에 표시할 글 개수 선택</option>
                    <option>3</option>
                    <option>5</option>
                    <option>10</option>
                    <option>15</option>
                    <option>20</option>
                </select>
                <input type="submit" value="보기"/>
            </form>
        </td>
    </tr>
</table>

<table width="1000" align="center" border="1">
    <tr>
        <th style="font-size: 30px; color: blue;" colspan="6">허접한 메모장</th>
    </tr>
    <!-- 여기부터 -->
    <tr>
        <td colspan="6">
            <form action="11_memoWrite.php" method="post" name="memoForm" onsubmit="return formCheck();">
                이름 : <input type="text" name="name" size="10"/>
                비번 : <input type="password" name="password" size="10"/>
                메모 : <input type="text" name="memo" size="78"/>
                <input type="submit" value="저장"/>
            </form>
        </td>
    </tr>
    <!-- 여기까지 글쓰기 폼 -->
    <tr>
        <td align="right" colspan="6">
            전체 메모수 : <?= $totalCount ?>개(<?= $currentPage ?>/<?= $totalPage ?>)페이지
        </td>
    </tr>
    <tr>
        <td width="30" align="center">NO</td>
        <td width="80" align="center">이름</td>
        <td width="590" align="center">메모</td>
        <td width="100" align="center">작성일</td>
        <td width="100" align="center">IP</td>
        <td width="100" align="center">&nbsp;</td>
    </tr>
    <?php
    //	화면에 출력할 한 페이지 분량의 글 목록을 얻어온다.
    $query = "SELECT * FROM MEMO ORDER BY idx DESC LIMIT " . $startNo . ", " . $pageSize;
    //	echo $query . "<br/>";
    $result = selectList($query);

    // 	mysqli_fetch_array() : 괄호 안의 내용을 배열로 반환하거나 더 이상 반환할 내용이 없으면 false를 반환한다.
    //	$result에는 화며에 출력할 한 페이지 분량의 글이 넘어와 있고 이를 한 줄씩 읽어 인덱스 연관 배열에 넣어 처리한다.
    while ($row = mysqli_fetch_array($result)) {
// 		print_r($row) . "<br/>";
        ?>
        <tr>
            <td><?= $row["idx"] ?></td>
            <td><?= $row["name"] ?></td>
            <!-- htmlspecialchars() : HTML 태그를 허용하지 않는다. -->
            <td><?= htmlspecialchars($row["memo"]) ?></td>
            <!-- strtotime() : 괄호 안의 문자열을 날짜/시간 형식의 데이터로 변환한다. -->
            <td><?= date("Y-m-d", strtotime($row["writeDate"])) ?></td>
            <td><?= $row["ip"] ?></td>
            <td>
                <!-- 수정 또는 삭제할 글번호와 수정 또는 삭제 작업 후 돌아갈 페이지 번호가지고 넘어가야 한다. -->
                <input type="button" value="수정"
                       onclick="location.href='memoUpdate.php?idx=<?= $row["idx"] ?>&page=<?= $currentPage ?>'"/>
                <input type="button" value="삭제"
                       onclick="location.href='memoDelete.php?idx=<?= $row["idx"] ?>&page=<?= $currentPage ?>'"/>
                <?php
                //	echo "<input type='button' value='삭제' onclick='location.href=\"11_memoDelete.php?idx=" . $row["idx"] . "&page=" . $currentPage ."\"'/>"
                ?>
            </td>
        </tr>
        <?php
    }
    ?>
    <tr>
        <td colspan="6" align="center">
            <?php
            //	이전, $startPage가 1보다 크면 이전이 있다.
            if ($startPage > 1) {
                echo "<a href='?page=1'>☜</a>";
                echo "<a href='?page=" . ($startPage - 1) . "'>◀</a>";
            }

            //	여기부터
            for ($i = $startPage; $i <= $endPage; $i++) {
//		전체 페이지 번호를 초과하는 페이지 이동 하이퍼링크를 출력하지 않고 반복을 탈출한다.
                if ($i > $totalPage) {
                    break;
                }
//		현재 페이지는 하이퍼링크를 걸지 않고 나머지 페이지만 하이퍼링크를 걸어준다.
                echo "[";
                if ($i == $currentPage) {
                    echo $i;
                } else {
                    echo "<a href='?page=" . $i . "'>" . $i . "</a>";
                }
                echo "]";
            }
            //	여기까지 페이지 목록 표시

            //	이후, $endPage가 $totalPage 보다 작다면 이후가 있다.
            if ($endPage < $totalPage) {
                echo "<a href='?page=" . ($endPage + 1) . "'>▶</a>";
                echo "<a href='?page=" . $totalPage . "'>☞</a>";
            }
            ?>
        </td>
    </tr>
</table>

</body>
</html>