<?php
include './function/11_DBFunction.php';
//	GET 방식으로 넘어오는 삭제할 글번호와 돌아갈 페이지 번호를 받는다.
$idx = $_GET["idx"];
$page = $_GET["page"];
//	echo $idx . " " . $page

$query = "SELECT * FROM MEMO WHERE idx = " . $idx;
// 	echo $query;
$link = getLink();
$result = mysqli_query($link, $query);
$row = mysqli_fetch_array($result);
// 	print_r($row);
dbClose($link);
?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <title>삭제할 글 확인</title>
    <script type="text/javascript">
        function formCheck() {
            f = document.memoDeleteForm;
            if (!f.password.value || f.password.value.trim().length === 0) {
                alert("비밀번호를 입력하세요!!!");
                f.password.value = "";
                f.password.focus();
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
<form action="11_memoDeleteOK.php" method="post" name="memoDeleteForm" onsubmit="return formCheck();">
    <table align="center" width="900" border="1">
        <tr>
            <th colspan="5" style="font-size: 30px; color: blue;">삭제할 메모 확인</th>
        </tr>
        <tr>
            <td width="30" align="center">NO</td>
            <td width="80" align="center">이름</td>
            <td width="590" align="center">메모</td>
            <td width="100" align="center">작성일</td>
            <td width="100" align="center">IP</td>
        </tr>
        <tr>
            <td><?= $row["idx"] ?></td>
            <td><?= $row["name"] ?></td>
            <!-- htmlspecialchars() : HTML 태그를 허용하지 않는다. -->
            <td><?= htmlspecialchars($row["memo"]) ?></td>
            <!-- strtotime() : 괄호 안의 문자열을 날짜/시간 형식의 데이터로 변환한다. -->
            <td><?= date("Y-m-d", strtotime($row["writeDate"])) ?></td>
            <td><?= $row["ip"] ?></td>
        </tr>
        <tr>
            <td colspan="5">
                <!-- memoDeleteOK.php로 넘겨줄 삭제할 글번호와 돌아갈 페이지 번호는 화면에 표시하면 안된다. -->
                <input type="hidden" name="idx" value="<?= $idx ?>"/>
                <input type="hidden" name="page" value="<?= $page ?>"/>
                비밀번호 : <input type="password" name="password"/>
                <input type="submit" value="삭제"/>
                <input type="reset" value="취소"/>
                <input type="button" value="돌아가기" onclick="history.back();"/>
            </td>
        </tr>
    </table>
</form>
</body>

</html>