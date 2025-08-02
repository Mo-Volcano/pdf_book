<?php
session_start();
include "include/db.php";

if(!isset($_SESSION['adminInfo'])){
  header("Location:index.php");
  exit();
}

include "include/header.php";
?>

<div class="container-fluid mt-5">
<?php
$query = "SELECT * FROM admin";
$result = mysqli_query($con,$query);
$row = mysqli_fetch_assoc($result);
?>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-success text-white text-center py-3 rounded-top">
                    <h4 class="mb-0"><i class="bi bi-person-circle"></i> الملف الشخصي</h4>
                </div>
                <div class="card-body p-4">
                    <form action="<?php echo $_SERVER["PHP_SELF"]?>" method='POST'>

                        <div class="form-group mb-3">
                            <label for="name" class="fw-bold"><i class="bi bi-person-fill"></i> الاسم</label>
                            <input type="text" class="form-control rounded-pill" id="name" name="adminName" 
                                   value="<?php echo $row["adminName"]?>">
                        </div>

                        <div class="form-group mb-3">
                            <label for="email" class="fw-bold"><i class="bi bi-envelope-fill"></i> البريد الإلكتروني</label>
                            <input type="email" class="form-control rounded-pill" id="email" name="adminEmail" 
                                   value="<?php echo $row["adminEmail"]?>">
                        </div>

                        <div class="form-group mb-3">
                            <label for="pass" class="fw-bold"><i class="bi bi-lock-fill"></i> كلمة السر</label>
                            <input type="password" class="form-control rounded-pill" id="pass" name="adminPass" 
                                   value="<?php echo $row["adminPass"]?>">
                        </div>

                        <div class="text-center">
                            <button class="btn btn-success px-5 py-2 rounded-pill shadow-sm" name="edit">
                                <i class="bi bi-pencil-square"></i> تعديل البيانات
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php
if(isset($_POST['edit'])){
    $adminName = $_POST['adminName'];
    $adminEmail = $_POST['adminEmail'];
    $adminPass = $_POST['adminPass'];

    $query = "UPDATE admin SET adminName = '$adminName', adminEmail = '$adminEmail', adminPass = '$adminPass' WHERE id = '1'";
    $res = mysqli_query($con, $query);  

    // ✅ حل التحذير بدون حلقة لانهائية
    echo "<script>window.location.href='profile.php?updated=1';</script>";
    exit();
}
?>
</div>

<?php include "include/footer.php"; ?>
