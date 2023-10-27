<?php
require_once 'is_admin.php';
$_SESSION['title'] = "Admin Dashboard";
require_once '../db.php';
require_once 'header.php';
?>

<div class="d-flex align-items-center justify-content-center p-3 my-3 text-white bg-purple rounded shadow-sm">
  <img class="me-3" src="../<?= $_SESSION['company']['image_light'] ?>" alt="<?= $_SESSION['company']['name'] ?>" height="80">
  <!-- <div class="lh-1">
    <h1 class="h2 mb-0 text-white lh-1"><?= $_SESSION['company']['name'] ?></h1>
  </div> -->
</div>

<?php if (isset($_SESSION['error'])) { ?>
  <div class="alert alert-danger" role="alert">
    <?php
    echo $_SESSION['error'];
    unset($_SESSION['error']);
    ?>
  </div>
<?php } ?>

<?php if (isset($_SESSION['success'])) { ?>
  <div class="alert alert-success" role="alert">
    <?php
    echo $_SESSION['success'];
    unset($_SESSION['success']);
    ?>
  </div>
<?php } ?>


<?php require_once 'footer.php'; ?>