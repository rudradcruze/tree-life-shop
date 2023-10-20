<?php
require_once 'is_admin.php';
$_SESSION['title'] = "Edit Company";
require_once '../db.php';
require_once 'header.php';

$company_query = "SELECT name, image_light, image_dark, phone FROM company WHERE id = 1";
$company_result = mysqli_query(db_connect(), $company_query);
$company = mysqli_fetch_assoc($company_result);

if (!$company) {
    $_SESSION['error'] = "Company not found!";
    header('location: ../404.php');
}
?>

<!-- Heading -->
<div class="d-flex align-items-center justify-content-center p-3 my-3 text-white bg-purple rounded shadow-sm">
    <div class="lh-1">
        <h1 class="h2 mb-0 text-white lh-1">Edit Company</h1>
    </div>
</div>

<!-- Edit Company Form -->
<div class="mt-5 p-3 bg-body rounded shadow">
    <?php if (isset($_SESSION['error'])) { ?>
        <div class="alert alert-danger" role="alert">
            <?php
            echo $_SESSION['error'];
            unset($_SESSION['error']);
            ?>
        </div>
    <?php } ?>

    <form action="company_edit_post.php" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label" for="companyName">Company Name</label>
            <input type="text" name="companyName" class="form-control" value="<?= $company['name'] ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label" for="companyPhone">Phone Number</label>
            <input type="text" name="companyPhone" class="form-control" value="<?= $company['phone'] ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Current Light Image</label>
            <img src="../<?= $company['image_light'] ?>" class="bg-dark p-2 rounded" alt="Light Image" width="150">
        </div>

        <div class="mb-3">
            <label class="form-label">Change Light Image</label>
            <input type="file" name="companyImageLight" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Current Dark Image</label>
            <img src="../<?= $company['image_dark'] ?>" alt="Dark Image" width="150">
        </div>

        <div class="mb-3">
            <label class="form-label">Change Dark Image</label>
            <input type="file" name="companyImageDark" class="form-control">
        </div>

        <div class="login_submit">
            <button class="btn btn-primary rounded" type="submit" name="submit">Save Changes</button>
        </div>
    </form>
</div>

<?php require_once 'footer.php'; ?>