<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quản lý Siêu Thị</title>
  <link rel="stylesheet" href="QLSieuThi/resources/bootstrap/css/bootstrap.min.css">
</head>
<body class="bg-light">

  <?php include "views/layouts/header.php"; ?>

  <?php include "views/layouts/nav.php"; ?>

  <main class="container-fluid my-4 flex-grow-1 d-flex flex-column">
    <?php include($viewFile); ?>
  </main>
  <?php include "views/layouts/footer.php"; ?>

  <script src="QLSieuThi/resources/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
