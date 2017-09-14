<?php
    $title = "Admin";
    include("includes/header.php");
?>

<div class="container">
    <div class="row">
        <img src="img/lessonqueue.svg" style="width: 100%">
        <div class="jumbotron center">
            <?php if (isset($_SESSION["nextstudent"])): ?>
                <h2><?php echo $_SESSION["nextstudent"]; unset($_SESSION["nextstudent"]); ?></h2>
            <?php else: ?>
                <h2>Admin</h2>
            <?php endif; ?>
        </div>

    </div>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <form action="includes/admin-process.php" method="POST">
                <!-- <input type="hidden" name="admin-button-next" value="1"> -->
                <button type="submit" name="admin-button" value="next" class="btn nextbtn btn-lg btn-block nextbtn">Nästa</button>
            </form>
            <form action="includes/admin-process.php" method="POST">
                <!-- <input type="hidden" name="admin-button-prev" value="1"> -->
                <button type="submit" name="admin-button" value="prev" class="btn nextbtn btn-lg btn-block prevbtn">Föregående</button>
            </form>
        <div class="col-md-2"></div>
    </div>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-6"><h3><span id="queueStarted"></span></h3></div>
        <div class="col-md-2"></div>
    </div>
</div>

<?php include("includes/footer.php"); ?>
