<?php
    session_start();
    $_SESSION['title'] = "404";
    require_once('../client/header.php');
?>

<div class="error_section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="error_form">
                    <h1>404</h1>
                    <h2>Opps! Something Wrong</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once('../client/footer.php');?>