<?php
include './function/12_freeboardFunction.php';
$currentPage = $_GET["page"];
$idx = $_GET["idx"];
//	해당 글번호의 글 1건을 얻어온다.
$data = selectByIdx($idx);
// 	print_r($data);
?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <title>자유 게시판 글보기</title>
</head>

<body>
<table width="600" align="center" border="1">
    <!-- 여기부터 -->
    <tr>
        <th colspan="4">자유 게시판 글보기</th>
    </tr>
    <tr>
        <td align="center">이름</td>
        <td><?= $data["name"] ?></td>
        <td align="center">작성일</td>
        <td><?= date("l, M d, Y g:i:s A", strtotime($data["writeDate"])) ?>
    </tr>
    <tr>
        <td align="center">제목</td>
        <td colspan="3"><?= htmlspecialchars($data["subject"]) ?></td>
    </tr>
    <tr>
        <td align="center" valign="top">내용</td>
        <!-- nl2br() : 괄호 안의 문자열에서 \n을 <br/> 태그로 변경한다. -->
        <td colspan="3"><?= nl2br(htmlspecialchars($data["content"])) ?></td>
    </tr>
    <tr>
        <td colspan="4" align="right">
            <input type="button" value="돌아가기" onclick="history.back();"/>
            <input type="button" value="수정하기"
                   onclick="location.href='update.php?idx=<?= $idx ?>&page=<?= $currentPage ?>'"/>
            <input type="button" value="삭제하기"
                   onclick="location.href='delete.php?idx=<?= $idx ?>&page=<?= $currentPage ?>'"/>
        </td>
    </tr>
    <!-- 여기까지 선택한 글을 화면에 표시하는 부분 -->

    <!-- 여기부터 -->
    <tr>
        <td colspan="4">
            <form action="12_commentInsertOK.php" method="post">
                <input type="hidden" name="page" value="<?= $currentPage ?>"/>
                <input type="hidden" name="idx" value="<?= $idx ?>"/>
                <input type="hidden" name="ref" value="<?= $idx ?>"/>
                이름 : <input type="text" name="name"/>
                암호 : <input type="password" name="password"/>
                <textarea rows="3" cols="60" name="content"></textarea>
                <input type="submit" value="댓글달기">
            </form>
        </td>
    </tr>
    <!-- 여기까지 댓글 입력 폼 -->

    <!-- 여기부터 -->
    <tr>
        <td colspan="4">
            <?php
            $result = selectListComment($idx);
            if ($row = mysqli_fetch_array($result)) {
//		print_r($row);
                do {
                    ?>
                    <?= $row["name"] ?>님이 <?= $row["writeDate"] ?>에 남긴글<br/>
                    <?= nl2br(htmlspecialchars($row["content"])) ?>
                    <hr/>
                    <?php
                } while ($row = mysqli_fetch_array($result));
            }
            ?>
        </td>
    </tr>
    <!-- 여기까지 댓글 리스트를 출력한다. -->
</table>
</body>

</html>
