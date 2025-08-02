<?php
session_start();
include "include/db.php";

if(!isset($_SESSION['adminInfo'])){
  header("Location:index.php");
  exit();
} else {
?>

<?php include "include/header.php"; ?>

<!-- ✅ تحسين شكل الإحصائيات مع أيقونات Bootstrap -->
<style>
    .dashboard-wrapper {
        min-height: 100vh;
        background-color: #f8f9fa;
        padding: 40px 20px;
    }

    .stat-card {
        background: #ffffff;
        border-radius: 15px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        padding: 30px 20px;
        text-align: center;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    .stat-card h3 {
        font-size: 2.5rem;
        font-weight: bold;
        color: #198754;
        margin-bottom: 10px;
    }

    .stat-card p {
        font-size: 1.2rem;
        color: #555;
        font-weight: 600;
    }

    /* ✅ أيقونات */
    .icon-box {
        width: 80px;
        height: 80px;
        background-color: #e9f7ef;
        color: #198754;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        font-size: 2.5rem;
        margin: 0 auto 15px;
    }
</style>

<div class="dashboard-wrapper">
    <div class="container">
        <h2 class="text-center mb-5 fw-bold text-success">لوحة تحكم الإدارة</h2>
        <div class="row g-4 justify-content-center">
            
            <!-- ✅ بطاقة عدد الكتب -->
            <div class="col-md-4 col-sm-6">
                <div class="stat-card">
                    <div class="icon-box">
                        <i class="bi bi-book"></i> <!-- 📘 أيقونة الكتب -->
                    </div>
                    <?php 
                    $query = "SELECT id FROM books";
                    $result = mysqli_query($con, $query);
                    $bookNum = mysqli_num_rows($result);
                    ?>
                    <h3><?php echo $bookNum; ?></h3>
                    <p>عدد الكتب</p>
                </div>
            </div>

            <!-- ✅ بطاقة عدد التصنيفات -->
            <div class="col-md-4 col-sm-6">
                <div class="stat-card">
                    <div class="icon-box">
                        <i class="bi bi-tags-fill"></i> <!-- 🏷️ أيقونة التصنيفات -->
                    </div>
                    <?php 
                    $query = "SELECT id FROM categories";
                    $result = mysqli_query($con, $query);
                    $catNum = mysqli_num_rows($result);
                    ?>
                    <h3><?php echo $catNum; ?></h3>
                    <p>عدد التصنيفات</p>
                </div>
            </div>

            <!-- ✅ مثال لإضافة بطاقة مستخدمين إذا أردت لاحقاً -->
            <!-- 
            <div class="col-md-4 col-sm-6">
                <div class="stat-card">
                    <div class="icon-box">
                        <i class="bi bi-people-fill"></i> 
                    </div>
                    <?php 
                    // $query = "SELECT id FROM users";
                    // $result = mysqli_query($con, $query);
                    // $userNum = mysqli_num_rows($result);
                    ?>
                    <h3><?php //echo $userNum; ?></h3>
                    <p>عدد المستخدمين</p>
                </div>
            </div>
            -->

        </div>
    </div>
</div>

<?php include "include/footer.php"; ?>

<?php } ?>
