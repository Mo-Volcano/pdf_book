<?php 
    include("layout/include/header.php");
    
    if(isset($_GET['author'])){
        $author= $_GET['author'];

    }
    
    
    ?>
<style>
    .author-info span {
        font-size:20px;
    }
</style>
<div class="books">
    <div class="container">
        <div class="author-info">
            <span class="p-4 bg-success rounded-pill m-5 text-light"> <?php echo $author?> جميع كتب</span>
            
        </div>
        <div class="row m-5">
            <?php 
            $query = "SELECT * FROM books WHERE bookAuthor = '$author' ";
            $result = mysqli_query($con,$query);
            while($row = mysqli_fetch_assoc($result)){
 ?>

<div class="col-md-6 col-lg-4 mt-3 mb-3  ddd">

<div class="card text-center" style="width: 18rem;">
    <div class="img-cover"> <img src="uploads\bookCovers\<?php echo $row['bookCover']?>" class="card-img-top" alt="img"></div>
    <div class="card-body">
    
        <h5 class="card-title"><a href="book1.php?id=<?php echo $row['id'] ;?>&&category=<?php echo $row['bookCat'] ?>" class="text-success"><?php echo $row['bookTitle']; ?></a></h5>
        <p class="card-text text-black-50"> <?php echo mb_substr($row['bookContent'] , 0,200 ,'UTF-8')?> </p>
        <button class="custom-btn btn"><a href="book1.php?id=<?php echo $row['id'] ;?>&&category=<?php echo $row['bookCat'] ?>" class="btn btn-success">تحميل
                الكتاب</a></button>
    </div>
</div>
</div>
            <?php }?>
           
            <div class="col-lg-3 col-md-6 ">
                 
            </div>
        </div>
    </div>
</div>












   <!-- start footer -->
   <?php 
    include("layout/include/footer.php");?>