<?php
include("layout/include/header.php");
?>

<div class="banar">
    <div class="lib-info">
        <h4>حمل عشرات الكتب <span class="text-success">مجانا</span></h4>
        <p>من اجل نشر المعرفة والثقافة وغرس حب القراءة بين المتحدثين باللغة العربية</p>
    </div>
</div>
<!-- end banar -->

<!-- start book -->
<div class="books mt-5 mb-5">
    <div class="container">
        <div class="row">
            <?php
            $query = 'SELECT * FROM books ORDER BY id DESC';
            $result = mysqli_query($con, $query);
            if (mysqli_num_rows($result)) {
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
                    <div class="col-md-6 col-lg-4 mt-4 d-flex">
                        <div class="card custom-card text-center w-100">
                            <div class="img-cover">
                                <img src="uploads/bookCovers/<?php echo htmlspecialchars($row['bookCover']); ?>" alt="<?php echo htmlspecialchars($row['bookTitle']); ?>">
                            </div>
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">
                                    <a href="book1.php?id=<?php echo $row['id']; ?>&&category=<?php echo $row['bookCat']; ?>" class="text-success">
                                        <?php echo htmlspecialchars($row['bookTitle']); ?>
                                    </a>
                                </h5>
                                <p class="card-text">
                                    <?php echo mb_substr($row['bookContent'], 0, 200, 'UTF-8'); ?>...
                                </p>
                                <a href="book1.php?id=<?php echo $row['id']; ?>" class="btn btn-success mt-auto">
                                    تحميل الكتاب
                                </a>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </div>
</div>
<!-- end book -->

<!-- start footer -->
<?php include("layout/include/footer.php"); ?>

<style>
    .card.custom-card {
        border-radius: 15px;
        box-shadow: 0 4px 10px rgb(0 0 0 / 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        overflow: hidden;
        background-color: #fff;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .card.custom-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 10px 20px rgb(0 0 0 / 0.15);
    }

    .card.custom-card .img-cover {
        height: 350px;
        overflow: hidden;
    }

    .card.custom-card .img-cover img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    .card.custom-card:hover .img-cover img {
        transform: scale(1.05);
    }

    .card.custom-card .card-body {
        flex-grow: 1;
        padding: 1rem 1.25rem;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .card.custom-card .card-title a {
        color: #198754;
        font-weight: 700;
        font-size: 1.25rem;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .card.custom-card .card-title a:hover {
        color: #145c32;
        text-decoration: underline;
    }

    .card.custom-card .card-text {
        color: #6c757d;
        flex-grow: 1;
        margin-top: 0.5rem;
        margin-bottom: 1rem;
        font-size: 0.95rem;
        line-height: 1.4;
    }

    .card.custom-card .btn-success {
        border-radius: 50px;
        font-weight: 600;
        padding: 0.4rem 1.2rem;
        box-shadow: 0 3px 6px rgb(25 135 84 / 0.4);
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
    }

    .card.custom-card .btn-success:hover,
    .card.custom-card .btn-success:focus {
        background-color: #145c32;
        box-shadow: 0 5px 12px rgb(20 92 50 / 0.6);
        color: #fff;
        text-decoration: none;
    }
</style>
