<?php 
include("layout/include/header.php");
require_once("dashbord/include/db.php");

// جلب كل التصنيفات مع حساب عدد الكتب لكل تصنيف
$query = "
    SELECT bookCat, COUNT(*) as totalBooks 
    FROM books 
    GROUP BY bookCat
    ORDER BY bookCat ASC
";
$result = mysqli_query($con, $query);
?>

<style>
.category-card {
    background: #fff;
    border-radius: 15px;
    padding: 25px 20px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    text-align: center;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    cursor: pointer;
}
.category-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
}
.category-name {
    font-size: 1.5rem;
    font-weight: 700;
    color: #198754;
    margin-bottom: 10px;
    text-decoration: none;
    display: block;
}
.category-count {
    font-size: 1.1rem;
    color: #555;
}
.container {
    margin-top: 50px;
    margin-bottom: 50px;
}
</style>

<main>
    <div class="container">
        <h2 class="text-center mb-5 fw-bold">📚 جميع الأقسام وعدد الكتب فيها</h2>
        <div class="row g-4 justify-content-center">
            <?php
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    $cat = htmlspecialchars($row['bookCat']);
                    $count = $row['totalBooks'];
                    // رابط يوجه إلى صفحة عرض الكتب داخل هذا التصنيف
                    $link = "category_books.php?category=" . urlencode($row['bookCat']);
                    ?>
                    <div class="col-md-4 col-lg-3 col-sm-6">
                        <a href="<?php echo $link; ?>" class="text-decoration-none">
                            <div class="category-card">
                                <span class="category-name"><?php echo $cat; ?></span>
                                <span class="category-count">عدد الكتب: <strong><?php echo $count; ?></strong></span>
                            </div>
                        </a>
                    </div>
            <?php
                }
            } else {
                echo "<p class='text-center'>لا توجد أقسام حالياً.</p>";
            }
            ?>
        </div>
    </div>
</main>

<?php include("layout/include/footer.php"); ?>
