<?php
session_start();
include "include/db.php";

if(!isset($_SESSION['adminInfo'])){
  header("Location:index.php");
  exit();
}

// معالجة إرسال النموذج
if(isset($_POST['submit'])){
    $bookTitle = filter_var($_POST['bookTitle'], FILTER_SANITIZE_STRING);
    $bookCat = filter_var($_POST['bookCat'], FILTER_SANITIZE_STRING);
    $bookAuthor = filter_var($_POST['bookAuthor'], FILTER_SANITIZE_STRING);
    $bookContent = filter_var($_POST['bookContent'], FILTER_SANITIZE_STRING);
    // book cover
    $imageName= $_FILES['bookCover']['name'];
    $imageTmp =  $_FILES['bookCover']['tmp_name'];
    // book file
    $bookName= $_FILES['book']['name'];
    $bookTmp =  $_FILES['book']['tmp_name'];

    if(empty($bookTitle) || empty($bookCat) || empty($bookContent)){
      echo '<div class="alert alert-danger text-center mt-3">الرجاء ملىء الحقول ادناه</div>';
    } elseif(empty($imageName)){
      echo '<div class="alert alert-danger text-center mt-3"> الرجاء اختيار صورة مناسبة</div>';
    } elseif(empty($bookName)){
      echo '<div class="alert alert-danger text-center mt-3"> الرجاء اختيار ملف الكتاب</div>';
    } else {
      // حفظ الملفات
      $bookCover = rand(0,1000) . "_" . $imageName;
      move_uploaded_file($imageTmp , "../uploads/bookCovers/".$bookCover);
      $book = rand(0,1000) . "_" . $bookName;
      move_uploaded_file($bookTmp , "../uploads/books/".$book);

      $query = "INSERT INTO books(bookCover, bookTitle, bookContent, bookCat, book, bookAuthor) 
                VALUES('$bookCover', '$bookTitle', '$bookContent', '$bookCat', '$book', '$bookAuthor')";
      $res = mysqli_query($con , $query);
      if($res){
        echo '<div class="alert alert-success text-center mt-3">تمت العملية بنجاح</div>';
      }
    }
}

include "include/header.php";
?>


  <style>
    body {
      background-color: #f8f9fa;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .new-book {
      max-width: 700px;
      margin: 50px auto 100px;
      padding: 30px 25px;
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }
    .new-book label {
      font-weight: 600;
      font-size: 1.1rem;
      color: #333;
    }
    .form-control {
      font-size: 1rem;
      padding: 10px 12px;
    }
    textarea.form-control {
      resize: vertical;
    }
    .btn-success {
      border-radius: 50px;
      font-size: 1.1rem;
      padding: 12px 30px;
      width: 140px;
    }
  </style>
</head>
<body>

<div class="container mt-5">
  <div class="new-book">
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data" novalidate>
      
      <div class="mb-3">
        <label for="bookTitle" class="form-label">عنوان الكتاب</label>
        <input type="text" name="bookTitle" id="bookTitle" class="form-control" 
          value="<?php if(isset($bookTitle)) echo htmlspecialchars($bookTitle); ?>" required>
      </div>
      
      <div class="mb-3">
        <label for="bookAuthor" class="form-label">اسم الكاتب</label>
        <input type="text" name="bookAuthor" id="bookAuthor" class="form-control" 
          value="<?php if(isset($bookAuthor)) echo htmlspecialchars($bookAuthor); ?>">
      </div>
      
      <div class="mb-3">
        <label for="bookCat" class="form-label">التصنيف</label>
        <select name="bookCat" id="bookCat" class="form-select" required>
          <option value="" disabled selected>اختر التصنيف</option>
          <?php 
          $query = "SELECT categoryName FROM categories"; 
          $result = mysqli_query($con, $query);
          while ($row = mysqli_fetch_assoc($result)) {
            $selected = (isset($bookCat) && $bookCat === $row['categoryName']) ? "selected" : "";
            echo "<option $selected>" . htmlspecialchars($row['categoryName']) . "</option>";
          }
          ?>
        </select>
      </div>
      
      <div class="mb-3">
        <label for="bookCover" class="form-label">غلاف الكتاب</label>
        <input type="file" name="bookCover" id="bookCover" class="form-control" accept="image/*" required>
      </div>
      
      <div class="mb-3">
        <label for="book" class="form-label">ملف الكتاب</label>
        <input type="file" name="book" id="book" class="form-control" accept=".pdf,.epub,.mobi" required>
      </div>
      
      <div class="mb-4">
        <label for="bookContent" class="form-label">نبذة عن الكتاب</label>
        <textarea name="bookContent" id="bookContent" cols="30" rows="6" class="form-control"><?php if(!empty($bookContent)) echo htmlspecialchars($bookContent); ?></textarea>
      </div>
      
      <button class="btn btn-success" name="submit" type="submit">نشر الكتاب</button>
      
    </form>
  </div>
</div>

<?php
include "include/footer.php";
?>
</body>
</html>
