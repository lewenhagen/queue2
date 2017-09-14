<?php
$title = "Add yourself";
include("includes/header.php");
// include("includes/functions.php");
?>

<div class="container">
    <div class="row">
        <img src="img/lessonqueue.svg" style="width: 100%">
        <div class="jumbotron center">
            <?php if (isset($_SESSION["flash"])): ?>
                <h2><?php echo $_SESSION["flash"]; unset($_SESSION["flash"]); ?></h2>
            <?php else: ?>
                <h2>Ställ dig i kön</h2>
            <?php endif; ?>
        </div>

    </div>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <form action="includes/process.php" method="POST">
                <div class="form-group">
                    <input type="text" id="name" name ="name" class="form-control" placeholder="Namn:" aria-describedby="sizing-addon1">
                </div>
                <div class="form-group">
                    <input type="text" id="exercise" name="exercise" class="form-control" placeholder="Uppgift/Uppgiftsnummer:" aria-describedby="sizing-addon1">
                </div>
                <button type="submit" name="startQueue" value="addToQueue" class="btn nextbtn btn-lg btn-block startQueueBtn">Börja köa!</button>
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
