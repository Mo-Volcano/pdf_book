<?php
session_start();
include "include/db.php";

if(!isset($_SESSION['adminInfo'])){
  header("Location:index.php");
  exit();
 
}
if (isset($_GET['id'])) {
  echo "<h1>ejejawejwjaeja</h1>" ;
  $id = (int)$_GET['id'];  // تأكد من تحويله لعدد صحيح للحماية
  $delete_query = "DELETE FROM categories WHERE id = $id";
  mysqli_query($con, $delete_query);
  header("Location:" . $_SERVER['PHP_SELF']);
  exit();
}

else {
  
include "include/header.php";

?>


<!-- Bootstrap Icons -->
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
    word-break: break-word;
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
    margin: 0 2px;
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

.book-cover img {
    width: 50px;
    height: auto;
    border-radius: 5px;
}

.file-link {
    color: #198754;
    font-weight: 600;
    text-decoration: none;
}

.file-link:hover {
    text-decoration: underline;
}

.content-preview {
    max-width: 150px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    margin: auto;
}
</style>

<div class="container mt-4">
    <div class="table-container">
        <table class="table table-striped align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>اسم الكتاب</th>
                    <th>اسم الكاتب</th>
                    <th>تصنيف الكتاب</th>
                    <th>غلاف الكتاب</th>
                    <th>ملف الكتاب</th>
                    <th>محتوى الكتاب</th>
                    <th>تاريخ الإضافة</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if(isset($_GET['page'])) { $page = $_GET['page']; } else { $page=1; }
                $limit=8;
                $start = ($page -1) * $limit;
                $query = "SELECT * FROM books ORDER BY id DESC LIMIT $start, $limit";
                $result = mysqli_query($con, $query);
                $number = $start;
                while($row = mysqli_fetch_assoc($result)) {
                    $number++;
                ?>
                <tr>
                    <td><?php echo $number; ?></td>
                    <td><?php echo htmlspecialchars($row['bookTitle']); ?></td>
                    <td><?php echo htmlspecialchars($row['bookAuthor']); ?></td>
                    <td><?php echo htmlspecialchars($row['bookCat']); ?></td>
                    <td class="book-cover">
                        <?php if(!empty($row['bookCover'])): ?>
                            <img src="../uploads/bookCovers/<?php echo $row['bookCover'];?>" alt="غلاف الكتاب">
                        <?php else: ?>
                            لا يوجد
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php 
                        if(!empty($row['book'])){
                            echo '<a href="../uploads/books/'.$row['book'].'" target="_blank" class="file-link">ملف الكتاب</a>';
                        } else {
                            echo 'لا يوجد';
                        }
                        ?>
                    </td>
                    <td><div class="content-preview" title="<?php echo htmlspecialchars($row['bookContent']); ?>">
                        <?php echo htmlspecialchars(mb_strimwidth($row['bookContent'], 0, 50, "...")); ?>
                    </div></td>
                    <td><?php echo $row['bookDate']; ?></td>
                    <td>
                        <a href="edit-book.php?id=<?php echo $row['id'];?>" 
                           class="btn-action" data-bs-toggle="tooltip" title="تعديل">
                            <i class="bi bi-pencil-fill"></i>
                        </a>
                        <a href="books.php?id=<?php echo $row['id'];?>" 
                           
                           class="btn-action" data-bs-toggle="tooltip" title="حذف">
                            <i class="bi bi-trash-fill"></i>
                        </a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

        <?php 
        $query= "SELECT * FROM books";
        $result = mysqli_query($con , $query);
        $total_cat = mysqli_num_rows($result);
        $total_page = ceil($total_cat / $limit);
        ?>
        <nav>
            <ul class="pagination justify-content-center">
                <li class="page-item <?php if($page <= 1) echo 'disabled'; ?>">
                    <a class="page-link" href="books.php?page=<?php echo max($page-1, 1); ?>">السابق</a>
                </li>
                <?php for($i=1 ; $i <= $total_page; $i++){ ?>
                    <li class="page-item <?php if($page==$i) echo 'active'; ?>">
                        <a class="page-link" href="books.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>
                <?php } ?>
                <li class="page-item <?php if($page >= $total_page) echo 'disabled'; ?>">
                    <a class="page-link" href="books.php?page=<?php echo min($page+1, $total_page); ?>">التالي</a>
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

<?php include "include/footer.php"; ?>
<?php } ?>
