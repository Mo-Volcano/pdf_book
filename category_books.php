<?php 
include("layout/include/header.php");
require_once("dashbord/include/db.php");

if(isset($_GET['category'])){
    $category = mysqli_real_escape_string($con, $_GET['category']);
} else {
    $category = "";
}

// جلب عدد الكتب في التصنيف الحالي
$countQuery = "SELECT COUNT(*) as total FROM books WHERE bookCat = '$category'";
$countResult = mysqli_query($con, $countQuery);
$countRow = mysqli_fetch_assoc($countResult);
$totalBooks = $countRow['total'];
?>

<style>
.book-card {
    background: #fff;
    border-radius: 15px;
    padding: 15px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    height: 100%;
    text-align: center;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}
.book-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
}
.book-card img {
    width: 100%;
    height: 350px;
    object-fit: cover;
    border-radius: 12px;
    margin-bottom: 12px;
}
.book-card h5 {
    font-weight: 700;
    font-size: 1.25rem;
    margin-bottom: 8px;
    color: #198754;
}
.book-card p {
    color: #555;
    font-size: 0.95rem;
    min-height: 50px;
    flex-grow: 1;
}
.download-btn {
    margin-top: 15px;
    background-color: #198754;
    color: #fff;
    padding: 10px 20px;
    border-radius: 8px;
    font-weight: 600;
    transition: background-color 0.3s ease;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
}
.download-btn:hover {
    background-color: #157347;
    color: #fff;
}
.download-btn i {
    margin-left: 8px;
    font-size: 1.1rem;
}
.header-section {
    margin-bottom: 30px;
}
.header-section h2 {
    font-weight: 800;
}
.header-section p {
    font-size: 1.1rem;
    color: #555;
}
</style>

<main>
    <div class="books-by-category mt-5 mb-5">
        <div class="container">
            <div class="header-section text-center">
                <h2>📚 الكتب في قسم: <span class="text-success"><?php echo htmlspecialchars($category); ?></span></h2>
                <p>عدد الكتب المتاحة: <strong><?php echo $totalBooks; ?></strong></p>
            </div>

            <div class="row g-4">
                <?php 
                $query = "SELECT * FROM books WHERE bookCat = '$category' ORDER BY id DESC";
                $result = mysqli_query($con, $query);

                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_assoc($result)){ ?>
                        <div class="col-md-4 col-lg-3 col-sm-6">
                            <div class="book-card">
                                <a href="book1.php?id=<?php echo $row['id'];?>&&category=<?php echo $row['bookCat']; ?>">
                                    <img src="uploads/bookCovers/<?php echo $row['bookCover']; ?>" alt="<?php echo htmlspecialchars($row['bookTitle']); ?>">
                                </a>
                                <h5>
                                    <a href="book1.php?id=<?php echo $row['id'];?>&&category=<?php echo $row['bookCat']; ?>" class="text-success text-decoration-none">
                                        <?php echo htmlspecialchars($row['bookTitle']); ?>
                                    </a>
                                </h5>
                                <p><?php echo mb_substr($row['bookContent'], 0, 80, 'UTF-8'); ?>...</p>

                                <a class="download-btn" href="uploads/books/<?php echo $row['book']; ?>" download>
                                    تحميل الكتاب <i class="bi bi-download"></i>
                                </a>
                            </div>
                        </div>
                    <?php }
                } else { ?>
                    <p class="text-center text-muted">لا توجد كتب حالياً في هذا القسم.</p>
                <?php } ?>
            </div>
        </div>
    </div>
</main>

<?php include("layout/include/footer.php"); ?>
