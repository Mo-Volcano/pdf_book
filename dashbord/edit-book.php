
 
 <?php
session_start();
include "include/db.php";



// include "include\db.php";
if(!isset($_SESSION['adminInfo'])){
  header("Location:index.php");
  exit();
}

else{
    
?>

 <?php
 include "include/header.php";
?>
<?php 
if(isset($_GET['id'])){
    $id= $_GET['id'];
    $query = "SELECT *  FROM books WHERE id ='$id' ";
    $result = mysqli_query($con , $query);
    $row = mysqli_fetch_assoc($result);
}

?>
<!-- edit category -->
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $bookTitle = $_POST['bookTitle'];
    $bookAuthor = $_POST['bookAuthor'];
    $bookCat = $_POST['bookCat'];
    $bookCover = $_POST['bookCover'];
    $book = $_POST['book'];
    $bookContent = $_POST['bookContent'];

    $query = "UPDATE `books` SET `bookTitle`='$bookTitle',`bookAuthor`='$bookAuthor',`bookCat`='$bookCat',`bookCover`='$bookCover',`book`='$book',`bookContent`='$bookContent' WHERE `id` = '$id'";
    $result = mysqli_query($con , $query);
    header("Location:books.php");
    exit();

}
?>
<div class="container mt-5">
    <div class="edit-cat">
        <form action=""  method="POST" >
        <div class="form-group">
     <label for="title" class="mb-2 mt-2">عنوان الكتاب</label>
<input type="text" name="bookTitle" id="title" class="form-control" value="<?php echo $row['bookTitle']  ?>">
    </div>
       <label for="title" class="mb-2 mt-2"> اسم الكاتب</label>
<input type="text" name="bookAuthor" id="title" class="form-control" value="<?php echo $row['bookAuthor']  ?>">
    </div>
     
<div class="form-group">
 <label for="" class="mb-2 mt-2">التصنيف</label>
 <select name="bookCat" id="" class="form-control">
  <option ><?php echo $row['bookCat']  ?></option>
    <?php 
    $query="SELECT categoryName FROM categories "; 
    $result = mysqli_query($con, $query);
    while ($rowCat = mysqli_fetch_assoc($result)){
  ?>
<option ><?php echo $rowCat['categoryName'] ?></option>
   <?php }?>
    
  
 </select>
</div>
<div class="form-group">
    <label for="img" class="mb-2 mt-2">غلاف الكتاب</label>
    <input type="file" name="bookCover" id="img" class="form-control" value='<?php echo$row['bookCover']?>'>
</div>
<div class="form-group">
     <label for="title" class="mb-2 mt-2">ملف الكتاب</label>
<input type="file" name="book" id="title" class="form-control" value='<?php echo $row['book']?>'>
    </div>
<div class="form-group">
    <label for="img" class="mb-2 mt-2">نبذة عن الكتاب</label>
    <textarea name="bookContent" id="" cols="30" rows="10" class="form-control" ><?php echo $row['bookContent']; ?></textarea>
</div>
    <button class="btn btn-success my-3 w-25 ">تعديل</button>
    </form>
    </div>
</div>











<?php
  include "include/footer.php";
?>

<?php }?>


