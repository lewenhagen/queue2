<?php
    $title = "Admin";
    include("includes/header.php");

    $action = isset($_GET["action"]) ? htmlentities($_GET["action"]) : null;

    if ($action != null) {
        if ($action == "clearHelped") {
            clear("helped");
        } elseif ($action == "clearQueue") {
            clear("queue");
        } elseif ($action == "clearAll") {
            clear("all");
        }
        header("Location: admin.php");
    }
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
        <div class="col-md-2">
            <ul class="clearLinks"><h4>Clear data-files</h4>
                <li><a href="admin.php?action=clearHelped">Clear helped</a></li>
                <li><a href="admin.php?action=clearQueue">Clear queued</a></li>
                <li><a href="admin.php?action=clearAll">Clear all</a></li>
            </ul>
            </div>
        <div class="col-md-6">
            <form action="includes/admin-process.php" method="POST">
                <button type="submit" name="admin-button" value="next" class="btn nextbtn btn-lg btn-block nextbtn">Nästa</button>
            </form>
            <form action="includes/admin-process.php" method="POST">
                <button type="submit" name="admin-button" value="prev" class="btn nextbtn btn-lg btn-block prevbtn">Föregående</button>
            </form>
        </div>
        <div class="col-md-4">
            <table class="table table-striped">
                <thead><legend>Helped students</legend>
                    <tr>
                        <th class="col-xs-1">#</th>
                        <th class="col-xs-3">Namn</th>
                        <th class="col-xs-2 col-centered">Uppgift</th>
                        <th class="col-xs-2">Tid</th>
                    </tr>
                </thead>
                <tbody id="queueBody">
                    <?= printHelpedQueue(); ?>
              </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">


        </div>
        <div class="col-md-6"></div>
        <div class="col-md-2"></div>
    </div>
</div>

<?php include("includes/footer.php"); ?>
