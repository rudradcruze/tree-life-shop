<?php
  require_once 'is_admin.php';
  $_SESSION['title'] = "New Category";
  require_once 'header.php';
  require_once '../db.php';
?>

  <!-- Heading -->
  <div class="d-flex align-items-center justify-content-center p-3 my-3 text-white bg-purple rounded shadow-sm">
    <div class="lh-1">
      <h1 class="h2 mb-0 text-white lh-1">Create New Category</h1>
    </div>
  </div>

  <!-- Main Create New Category Content -->
  <div class="mt-5 p-3 bg-body rounded shadow">

    <?php if (isset($_SESSION['error'])) { ?>
        <div class="alert alert-danger" role="alert">
            <?php
              echo $_SESSION['error'];
              unset($_SESSION['error']);
            ?>
        </div>
    <?php } ?>

    <form action="category_new_post.php" method="post">
        <div class="mb-3">
            <label class="form-label" for="categoryName">Category Name <span class="text-danger">*</span></label>
            <input type="text" name="categoryName" class="form-control" id="categoryName" required>
        </div>

        <div class="login_submit">
            <button class="btn btn-primary rounded" id="submit" name="submit" type="submit">Create Category</button>
        </div>
    </form>
  </div>

<?php require_once 'footer.php';?>