<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/web_init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/part/head.php';

$conn = getDatabaseConnection();

$sql = "SELECT * FROM article WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_REQUEST['id']);
$stmt->execute();
$articleInfo = $stmt->get_result()->fetch_assoc();
$stmt->close();
?>

<table border="1">
    <tbody>
        <tr>
            <th>ID</th>
            <td><?=$articleInfo['id']?></td>
        </tr>
        <tr>
            <th>날짜</th>
            <td><?=$articleInfo['regDate']?></td>
        </tr>
        <tr>
            <th>제목</th>
            <td><?=$articleInfo['title']?></td>
        </tr>
        <tr>
            <th>내용</th>
            <td><?=nl2br(htmlspecialchars($articleInfo['body']))?></td>
        </tr>
        <tr>
            <th>비고</th>
            <td>
                <a href="./doDelete.php?id=<?=$articleInfo['id']?>">삭제</a>
            </td>
        </tr>
    </tbody>
</table>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/part/foot.php';
?>
