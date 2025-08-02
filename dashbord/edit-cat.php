<?php
session_start();
include "include/db.php";

if(!isset($_SESSION['adminInfo'])){
  header("Location:index.php");
  exit();
}

if(isset($_GET['id'])){
    $id = intval($_GET['id']);
    $query = "SELECT * FROM categories WHERE id = $id";
    $result = mysqli_query($con, $query);
    if(mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_assoc($result);
        $categoryName = $row['categoryName'];
    } else {
        header("Location: categories.php");
        exit();
    }
} else {
    header("Location: categories.php");
    exit();
}

$error = '';
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $categoryName = trim($_POST['category']);
    if(empty($categoryName)){
        $error = "اسم التصنيف لا يمكن أن يكون فارغًا.";
    } else {
        $categoryNameEscaped = mysqli_real_escape_string($con, $categoryName);
        $query = "UPDATE categories SET categoryName = '$categoryNameEscaped' WHERE id = $id";
        $result = mysqli_query($con, $query);
        if($result){
            header("Location: categories.php?updated=1");
            exit();
        } else {
            $error = "حدث خطأ أثناء التحديث، حاول مرة أخرى.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>تعديل التصنيف</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <style>
    body {
      background-color: #f8f9fa;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .edit-cat-form {
      max-width: 500px;
      margin: 60px auto;
      padding: 30px 25px;
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    .edit-cat-form label {
      font-weight: 600;
      font-size: 1.2rem;
      color: #333;
    }
    .btn-edit {
      border-radius: 50px;
      font-size: 18px;
      padding: 12px 30px;
      display: inline-flex;
      align-items: center;
      gap: 10px;
      transition: background-color 0.3s ease, box-shadow 0.3s ease;
      cursor: pointer;
    }
    .btn-edit:focus, .btn-edit:hover {
      box-shadow: 0 4px 15px rgba(0,0,0,0.2);
      text-decoration: none;
    }
    .btn-success {
      background-color: #28a745;
      border-color: #28a745;
    }
    .btn-success:hover {
      background-color: #218838;
      border-color: #1e7e34;
    }
    .btn-secondary {
      background-color: #6c757d;
      border-color: #6c757d;
      color: #fff;
      margin-left: 15px;
    }
    .btn-secondary:hover {
      background-color: #5a6268;
      border-color: #545b62;
      color: #fff;
    }
    .alert-custom {
      max-width: 500px;
      margin: 20px auto;
      font-weight: 600;
      text-align: center;
    }
    .btn-secondary {
  background-color: #2c7a2c; /* لون أخضر غامق مختلف */
  border-color: #2c7a2c;
  color: #fff;
  margin-left: 20px; /* مسافة أكبر بين الزرين */
}

.btn-secondary:hover {
  background-color: #255d25;
  border-color: #204d20;
  color: #fff;
}


  </style>
</head>
<body>

  <?php include "include/header.php"; ?>

  <div class="container">
    <?php if(!empty($error)): ?>
      <div class="alert alert-danger alert-custom" role="alert">
        <i class="bi bi-exclamation-triangle-fill"></i> <?php echo $error; ?>
      </div>
    <?php endif; ?>

    <div class="edit-cat-form">
      <form action="" method="POST" autocomplete="off">
        <div class="mb-4">
          <label for="cat" class="form-label">اسم التصنيف</label>
          <input type="text" name="category" id="cat" class="form-control form-control-lg" 
                 value="<?php echo htmlspecialchars($categoryName); ?>" required autofocus>
        </div>
        <div class="d-flex justify-content-start">
  <button type="submit" class="btn btn-success btn-edit">
    <i class="bi bi-pencil-square"></i> تحديث
  </button>
  <a href="categories.php" class="btn btn-secondary btn-edit">
    <i class="bi bi-arrow-left"></i> العودة
  </a>
</div>

      </form>
    </div>
  </div>

  <?php include "include/footer.php"; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
