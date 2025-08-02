<?php 
include("layout/include/header.php");

$id = $_GET['id'] ?? null;
$bookCat = $_GET['category'] ?? null;

if (!$id) {
    echo '<div class="container mt-5"><div class="alert alert-warning">الكتاب غير موجود.</div></div>';
    include("layout/include/footer.php");
    exit;
}

// جلب بيانات الكتاب
$query = "SELECT * FROM books WHERE id = ?";
$stmt = mysqli_prepare($con, $query);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);

if (!$row) {
    echo '<div class="container mt-5"><div class="alert alert-danger">الكتاب غير موجود.</div></div>';
    include("layout/include/footer.php");
    exit;
}

?>

<!-- عرض الكتاب -->
<!-- عرض الكتاب -->
<div class="books mt-5 mb-5">
    <div class="container">
        <div class="row g-4 align-items-center">
            <div class="col-md-4 text-center">
                <div class="book-cover shadow-sm rounded overflow-hidden">
                    <img src="uploads/bookCovers/<?php echo htmlspecialchars($row['bookCover']); ?>" alt="<?php echo htmlspecialchars($row['bookTitle']); ?>" class="img-fluid rounded">
                </div>
            </div>
            <div class="col-md-8">
                <div class="book-content">
                    <h5 class="mb-2"><strong>اسم الكتاب:</strong> <?php echo htmlspecialchars($row['bookTitle']); ?></h5>
                    <h5 class="mb-3"><strong>اسم الكاتب:</strong> 
                        <a href="author.php?author=<?php echo urlencode($row['bookAuthor']); ?>&category=<?php echo urlencode($row['bookCat']); ?>" class="text-success text-decoration-none">
                            <?php echo htmlspecialchars($row['bookAuthor']); ?>
                        </a>
                    </h5>
                    <hr>
                    <p class="text-secondary mb-4" style="line-height: 1.6;"><?php echo nl2br(htmlspecialchars($row['bookContent'])); ?></p>
                    <a href="uploads/books/<?php echo htmlspecialchars($row['book']); ?>" download class="btn btn-success btn-lg rounded-pill shadow">
                        <i class="bi bi-download me-2"></i> تحميل الكتاب
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- كتب ذات صلة -->
<div class="related-books bg-light py-5">
    <div class="container">
        <h3 class="mb-4 fw-bold text-success">كتب ذات صلة</h3>
        <div class="row g-4">
            <?php 
            if ($bookCat) {
                $queryRelated = "SELECT * FROM books WHERE bookCat = ? AND id != ? LIMIT 8";
                $stmtRelated = mysqli_prepare($con, $queryRelated);
                mysqli_stmt_bind_param($stmtRelated, "si", $bookCat, $id);
                mysqli_stmt_execute($stmtRelated);
                $resRelated = mysqli_stmt_get_result($stmtRelated);

                if (mysqli_num_rows($resRelated) == 0) {
                    echo '<p class="text-muted">لا توجد كتب ذات صلة.</p>';
                } else {
                    while ($rel = mysqli_fetch_assoc($resRelated)) {
            ?>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="card h-100 shadow-sm border-0">
                                <a href="book1.php?id=<?php echo $rel['id']; ?>&category=<?php echo urlencode($rel['bookCat']); ?>">
                                    <img src="uploads/bookCovers/<?php echo htmlspecialchars($rel['bookCover']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($rel['bookTitle']); ?>" style="height: 350px; object-fit: cover; border-radius: 0.5rem 0.5rem 0 0;">
                                </a>
                                <div class="card-body p-3">
                                    <h5 class="card-title">
                                        <a href="book1.php?id=<?php echo $rel['id']; ?>&category=<?php echo urlencode($rel['bookCat']); ?>" class="text-success text-decoration-none">
                                            <?php echo htmlspecialchars($rel['bookTitle']); ?>
                                        </a>
                                    </h5>
                                </div>
                            </div>
                        </div>
            <?php
                    }
                }
            }
            ?>
        </div>
    </div>
</div>

<?php 
include("layout/include/footer.php");
?>

<!-- تحسينات CSS بسيطة -->
<style>
    .book-cover img {
        transition: transform 0.3s ease;
    }
    .book-cover:hover img {
        transform: scale(1.05);
    }
    .related-books .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 15px rgb(0 0 0 / 0.15);
        transition: all 0.3s ease;
    }
</style>
