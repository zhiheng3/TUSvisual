<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>启迪视觉后台</title>
    <!-- Javascript -->
    <script src="./static/js/jquery-1.8.2.min.js"></script>
</head>
<body>
    <?php
session_start();
echo $_SESSION["username"];
?>
</body>
</html>
