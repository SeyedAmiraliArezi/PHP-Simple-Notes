<?php
// ===== دریافت و ذخیره =====
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title   = trim($_POST['title'] ?? "");
    $content = trim($_POST['content'] ?? "");

    if ($title !== '' && $content !== '') {
        $line = $title . " | " . $content . "\n";
        file_put_contents('deta.txt', $line, FILE_APPEND);
    }
}
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>دفترچه</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>دفترچه یادداشت</h1>

<form method="post">
  <input type="text" name="title" placeholder="عنوان">
  <textarea name="content" placeholder="متن"></textarea>
  <input name = "submit" type="submit" value="افزودن">
  <input name = "delete" type="submit" value="حذف">
</form>

<?php

if(isset($_POST['delete'])){
        if (file_exists('deta.txt')) {
            unlink('deta.txt');
        }
}

if (file_exists('deta.txt')) {
$lines = explode("\n", trim(file_get_contents('deta.txt')));

    foreach ($lines as $line) {
        if ($line === '') continue;
            echo "<div>";
            echo "<h3>" . htmlspecialchars(explode(" | ", $line)[0]) . "</h3>";
            echo "<p>" . htmlspecialchars(explode(" | ", $line)[1] ?? '') . "</p>";
            echo "</div>";
            echo date('d:h');
    }
}

?>
</body>
</html>
