<?php
    $title = "Queue";
    include("includes/header.php");
    // include("includes/functions.php");
?>
<script>
    var previous = null;
    var current = null;
    setInterval(function() {
        $.getJSON("db/students_in_queue.json", function(json) {
            current = JSON.stringify(json);
            if (previous && current && previous !== current) {
                console.log('refresh');
                location.reload();
            }
            previous = current;
        });
    }, 2000);
</script>
<div class="container">
    <div class="row">
        <img src="img/lessonqueue.svg" style="width: 100%">
        <div class="jumbotron">
            <!-- <h2>Nu hjälper jag: <br><span id="currentStudent"><script>getCurrentStudent();</script></span></h2> -->
        </div>
    </div>
    <div class="row">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="col-xs-1">#</th>
                    <th class="col-xs-5">Namn</th>
                    <th class="col-xs-4 col-centered">Uppgift</th>
                    <th class="col-xs-2">Tid</th>
                </tr>
            </thead>
            <tbody id="queueBody">
                <?= printQueue(); ?>
                <script>
                    // updateTable();
                </script>
          </tbody>
        </table>
    </div>
</div>

<?php include("includes/footer.php");?>
