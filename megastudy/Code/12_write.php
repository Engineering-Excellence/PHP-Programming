<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <title>자유 게시판 글쓰기</title>
</head>

<body>
<form action="12_writeOK.php" method="post">
    <table width="600" align="center" border="1">
        <tr>
            <td colspan="4" align="center">자유 게시판 글쓰기</td>
        </tr>
        <tr>
            <td align="center">이름</td>
            <td><input type="text" name="name"/></td>
            <td align="center">암호</td>
            <td><input type="password" name="password"/></td>
        </tr>
        <tr>
            <td align="center">제목</td>
            <td colspan="3"><input type="text" name="subject"/>
        </tr>
        <tr>
            <td align="center" valign="top">내용</td>
            <td colspan="3"><textarea rows="10" cols="65" name="content"></textarea>
        </tr>
        <tr>
            <td colspan="4" align="center">
                <input type="submit" value="저장하기"/>
                <input type="reset" value="다시쓰기"/>
                <input type="button" value="돌아가기" onclick="history.back();"/>
            </td>
        </tr>
    </table>
</form>
</body>

</html>
