<?php
session_start();
require_once("dashbord/include/db.php");
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Volcano-Store</title>
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" href="layout/style.css" />
    <style>
      /* تحسين الهيدر */
      .navbar {
        background-color: #f8f9fa; /* خلفية فاتحة ناعمة */
        box-shadow: 0 2px 5px rgb(0 0 0 / 0.1);
        font-weight: 500;
      }
      .navbar-brand {
        font-weight: 700;
        font-size: 1.5rem;
        color: #198754 !important; /* أخضر Bootstrap */
        letter-spacing: 1px;
      }
      .nav-link {
        color: #333 !important;
        font-size: 1rem;
        padding: 0.5rem 1rem;
        transition: color 0.3s ease;
      }
      .nav-link:hover,
      .nav-link:focus {
        color: #198754 !important;
        text-decoration: underline;
      }
      .btn-control {
        background-color: #198754;
        border-radius: 50px;
        padding: 0.35rem 1.2rem;
        font-weight: 600;
        box-shadow: 0 3px 6px rgb(25 135 84 / 0.4);
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
      }
      .btn-control:hover,
      .btn-control:focus {
        background-color: #145c32;
        box-shadow: 0 4px 12px rgb(20 92 50 / 0.6);
        text-decoration: none;
        color: white !important;
      }
      /* تحسين زر القائمة (توجل) */
      .navbar-toggler {
        border: none;
      }
      .navbar-toggler:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(25, 135, 84, 0.5);
      }
      /* جعل القائمة تظهر من اليمين لليسار */
      .navbar-collapse {
        text-align: right;
      }
    </style>
</head>

<body>
<nav class="navbar navbar-expand-sm">
  <div class="container d-flex justify-content-between align-items-center">
    <!-- القائمة على اليمين -->
    <ul class="navbar-nav d-flex flex-row gap-3 mb-0">
      <li class="nav-item">
        <a href="index.php" class="nav-link">الرئيسية</a>
      </li>
      <li class="nav-item">
        <a href="categories.php" class="nav-link">الأقسام</a>
      </li>
      <li class="nav-item">
        <a href="contact.php" class="nav-link">تواصل معنا</a>
      </li>
      <?php if (isset($_SESSION['adminInfo'])): ?>
      <li class="nav-item">
        <a href="dashbord/index.php" class="btn btn-control text-white">لوحة التحكم <i class="bi bi-speedometer2 ms-1"></i></a>
      </li>
      <?php endif; ?>
    </ul>

    <!-- الشعار على اليسار -->
    <a href="index.php" class="navbar-brand">Volcano-Store</a>

  
</nav>

<script src="bootstrap/bootstrap.bundle.min.js"></script>
</body>
</html>

