<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/web_init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/part/head.php';

$conn = getDatabaseConnection();

$sql = "SELECT * FROM article ORDER BY id DESC";
$result = $conn->query($sql);
?>

<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>날짜</th>
            <th>제목</th>
            <th>비고</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($articleInfo = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= htmlspecialchars($articleInfo['id']) ?></td>
            <td><?= htmlspecialchars($articleInfo['regDate']) ?></td>
            <td><a href="./detail.php?id=<?= $articleInfo['id'] ?>"><?= htmlspecialchars($articleInfo['title']) ?></a></td>
            <td>
                <a href="./doDelete.php?id=<?= $articleInfo['id'] ?>">삭제</a>
            </td>
        </tr>    
        <?php } ?>
    </tbody>
</table>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/part/foot.php';
?>
