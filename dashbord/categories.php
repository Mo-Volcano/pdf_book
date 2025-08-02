<?php

session_start();
include "include/db.php";

if(!isset($_SESSION['adminInfo'])){
  header("Location:index.php");
  exit();
} else {
include "include/header.php";
?>

<!-- تأكد من وجود Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
.table-container {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 3px 10px rgba(0,0,0,0.1);
    padding: 20px;
}

.table thead th {
    background-color: #198754; /* أخضر Bootstrap */
    color: white;
    text-align: center;
    font-weight: 600;
    border: none;
}

.table tbody tr:hover {
    background-color: #e6f4ea; /* أخضر فاتح */
    transition: background-color 0.3s ease;
}

.table td, .table th {
    vertical-align: middle;
    text-align: center;
}

.btn-action {
    border-radius: 50px;
    padding: 6px 12px;
    font-size: 18px;
    transition: all 0.3s ease;
    border: 1.5px solid #198754;
    color: #198754;
    background-color: transparent;
    width: 40px;
    height: 40px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.btn-action:hover {
    background-color: #198754;
    color: white;
    text-decoration: none;
    transform: scale(1.1);
}

.pagination .page-link {
    color: #198754;
    font-weight: 500;
    border-radius: 50px;
    margin: 0 4px;
    transition: background-color 0.3s, color 0.3s;
}

.pagination .page-link:hover {
    background-color: #198754;
    color: white;
}

.pagination .active .page-link {
    background-color: #198754 !important;
    color: white !important;
    border-color: #198754 !important;
}

.add-cat-btn {
    background-color: #198754;
    border: none;
    border-radius: 50px;
    padding: 10px 25px;
    font-size: 18px;
    color: white;
    transition: background-color 0.3s ease;
}

.add-cat-btn:hover {
    background-color: #145c32;
}
</style>

<div class="container mt-4">
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-success text-white fw-bold">
            إضافة تصنيف جديد
        </div>
        <div class="card-body">
            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" class="row g-2">
                <div class="col-md-9">
                    <input type="text" name="category" id="cat" class="form-control" placeholder="أدخل اسم التصنيف">
                </div>
                <div class="col-md-3 d-grid">
                    <button class="add-cat-btn w-100">إضافة</button>
                </div>
            </form>
        </div>
    </div>

    <div class="table-container">
        <table class="table table-striped align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>عنوان التصنيف</th>
                    <th>تاريخ الإضافة</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if(isset($_GET['page'])) { $page = $_GET['page']; } else { $page=1; }
                $limit=4;
                $start = ($page -1) * $limit;
                $query = "SELECT * FROM categories ORDER BY id DESC LIMIT $start, $limit";
                $result = mysqli_query($con, $query);
                $number = 0;
                while($row = mysqli_fetch_assoc($result)) {
                    $number++;
                ?>
                <tr>
                    <td><?php echo $number; ?></td>
                    <td><?php echo htmlspecialchars($row['categoryName']); ?></td>
                    <td><?php echo htmlspecialchars($row['categoryDate']); ?></td>
                    <td>
                        <a href="edit-cat.php?id=<?php echo $row['id'];?>" 
                           class="btn-action" data-bs-toggle="tooltip" title="تعديل">
                            <i class="bi bi-pencil-fill"></i>
                        </a>
                        <a href="categories.php?id=<?php echo $row['id'];?>" 
                           onclick="return confirm('هل أنت متأكد من الحذف؟');" 
                           class="btn-action" data-bs-toggle="tooltip" title="حذف">
                            <i class="bi bi-trash-fill"></i>
                        </a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

        <?php 
        $query= "SELECT * FROM categories";
        $result = mysqli_query($con , $query);
        $total_cat = mysqli_num_rows($result);
        $total_page = ceil($total_cat / $limit);
        ?>
        <nav>
            <ul class="pagination justify-content-center">
                <li class="page-item <?php if($page <= 1) echo 'disabled'; ?>">
                    <a class="page-link" href="categories.php?page=<?php echo max($page-1, 1); ?>">السابق</a>
                </li>
                <?php for($i=1 ; $i <= $total_page; $i++){ ?>
                    <li class="page-item <?php if($page==$i) echo 'active'; ?>">
                        <a class="page-link" href="categories.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>
                <?php } ?>
                <li class="page-item <?php if($page >= $total_page) echo 'disabled'; ?>">
                    <a class="page-link" href="categories.php?page=<?php echo min($page+1, $total_page); ?>">التالي</a>
                </li>
            </ul>
        </nav>
    </div>
</div>

<!-- تفعيل tooltips -->
<script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    })
</script>

<?php include "include/footer.php";} ?>