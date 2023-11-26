<?php
include './function/12_freeboardFunction.php';

$pageSize = 5;                                    // 한 페이지에 표시할 글의 개수
$currentPage = 1;                                // 현재 화면에 표시할 페이지
//	이전 페이지에서 GET 방식으로 넘어오는 페이지가 있으면 현재 페이지를 GET 방식으로 넘어온 페이지로 변경한다.
if (isset($_GET["page"])) {
    $currentPage = $_GET["page"];
}
//	페이지 작업에 관련된 정보를 얻어오는 함수를 실행한다.
$pageInfo = pageInfo($currentPage, $pageSize);
//	화면에 출력할 한 페이지 분량의 부모글을 얻어온다.
$result = selectList($pageInfo["startNo"], $pageSize);
?>

<!-- 자유 게시판 목록보기 -->
<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <title>자유 게시판 목록보기</title>
</head>

<body>
<table width="800" align="center" border="1">
    <tr>
        <th colspan="5" align="center">자유 게시판</th>
    </tr>
    <tr>
        <td colspan="5" align="right">
            전체 개수 : <?= $pageInfo["totalCount"] ?>(<?= $pageInfo["currentPage"] ?> / <?= $pageInfo["totalPage"] ?>)page
        </td>
    </tr>
    <tr>
        <th>번호</th>
        <th>작성자</th>
        <th width="400">제목</th>
        <th>작성일</th>
        <th>조회수</th>
    </tr>
    <?php
    if ($pageInfo["totalCount"] > 0) {
        while ($row = mysqli_fetch_array($result)) {
            // 		print_r($row);
            // 		echo "<br/>";
            ?>
            <tr>
                <td><?= $row["idx"] ?></td>
                <td><?= htmlspecialchars($row["name"]) ?></td>
                <td>
                    <a href="12_hitIncrement.php?idx=<?= $row["idx"] ?>&page=<?= $pageInfo["currentPage"] ?>">
                        <?= htmlspecialchars($row["subject"]) ?>[100]
                    </a>
                </td>
                <td><?= date("Y-m-d", strtotime($row["writeDate"])) ?></td>
                <td><?= $row["hit"] ?></td>
            </tr>
            <?php
        }
    } else {
        echo "<tr>";
        echo "<td align='center' colspan='5'>작성된 글이 없습니다.</td>";
        echo "</tr>";
    }

    echo "<tr>";
    echo "<td align='center' colspan='5'>";
    if ($pageInfo["startPage"] > 1) {
        echo "<a href='?page=1'>☜</a>";
        echo "<a href='?page=" . ($pageInfo["startPage"] - 1) . "'>◀</a>";
    }
    for ($i = $pageInfo["startPage"]; $i <= $pageInfo["endPage"]; $i++) {
        if ($i > $pageInfo["totalPage"]) {
            break;
        }
        echo "[";
        if ($i == $pageInfo["currentPage"]) {
            echo $i;
        } else {
            echo "<a href='?page=" . $i . "'>" . $i . "</a>";
        }
        echo "]";
    }
    if ($pageInfo["endPage"] < $pageInfo["totalPage"]) {
        echo "<a href='?page=" . ($pageInfo["endPage"] + 1) . "'>▶</a>";
        echo "<a href='?page=" . $pageInfo["totalPage"] . "'>☞</a>";
    }
    echo "</td>";
    echo "</tr>";
    ?>
    <tr>
        <td colspan="5" align="right">
            <input type="button" value="글쓰기" onclick="location.href='12_write.php'"/>
        </td>
    </tr>
</table>
</body>

</html>
