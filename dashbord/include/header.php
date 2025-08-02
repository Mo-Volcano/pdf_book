<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
    <link rel="stylesheet" href="../bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../css/dashbordstyle.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

    <title>Admin panel</title>

    <style>
        /* ✅ تحسين شكل الهيدر */
        .navbar {
            padding: 12px 0;
            background: #212529;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }

        .nav-link {
            font-weight: 500;
            font-size: 1rem;
            transition: color 0.3s ease;
        }

        .nav-link:hover {
            color: #20c997 !important;
        }

        /* ✅ تحسين شكل القائمة الجانبية */
        .offcanvas-body .nav-link {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* ✅ أيقونة المستخدم في الهيدر */
        .admin-icon {
            font-size: 1.2rem;
            margin-right: 5px;
        }

        /* ✅ تحسين شكل زر الـ toggle */
        .navbar-toggler {
            border: none;
        }

        /* ✅ تغيير لون زر الإغلاق في offcanvas */
        .offcanvas-header {
            background: #198754;
        }
    </style>
</head>
<body>
   
<nav class="navbar navbar-dark bg-dark">
<div class="container pb-2">
    
    <div class="content1">
      
    <?php
        $query = "SELECT adminName FROM admin";
        $result = mysqli_query($con , $query);
        $row = mysqli_fetch_assoc($result);
    ?>

        <ul class="nav nav-pills">
            <li class="nav-item">
              <a class="nav-link text-light" href="../../bookstor/" target="_blank">
                <i class="bi bi-globe2"></i> عرض الموقع
              </a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle text-light" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
                <i class="bi bi-person-circle admin-icon"></i><?php echo $row["adminName"]; ?> 
              </a>
              <ul class="dropdown-menu bg-success">
                <li><a class="dropdown-item text-light" href="include/logout.php">
                  <i class="bi bi-box-arrow-right"></i> تسجيل خروج
                </a></li>
              </ul>
            </li>
        </ul>
    </div>

  <button class="navbar-toggler text-success" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
    <div class="offcanvas-header bg-success">
      <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel"><i class="bi bi-speedometer2"></i> لوحة التحكم</h5>
      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
      <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="admin.php">
            <i class="bi bi-house-door-fill"></i> نظرة عامة
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="profile.php">
            <i class="bi bi-person-lines-fill"></i> البروفايل
          </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="categories.php">
              <i class="bi bi-tags-fill"></i> التصنيفات
            </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-book"></i> الكتب
          </a>
          <ul class="dropdown-menu dropdown-menu-dark bg-success">
            <li><a class="dropdown-item" href="newBook.php"><i class="bi bi-plus-circle"></i> كتاب جديد</a></li>
            <li><a class="dropdown-item" href="books.php"><i class="bi bi-journal-text"></i> كل الكتب</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</div>
</nav>
