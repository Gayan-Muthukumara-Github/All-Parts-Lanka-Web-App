<?php
include('config/dbcon.php');
include('authentication.php');

include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content mt-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php include('message.php'); ?>
                    <div class="card">
                        <div class="card-header">
                            <h4>
                                Feedback
                                <a href="product-add.php" class="btn btn-primary float-right">Add</a>
                            </h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Feedback ID</th>
                                        <th>User ID</th>
                                        <th>Feedback Date</th>
                                        <th>Q 01</th>
                                        <th>Q 02</th>
                                        <th>Q 03</th>
                                        <th>Feedback Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    $query = "SELECT * FROM feedback";
                                    $query_run = mysqli_query($con, $query);

                                    if (mysqli_num_rows($query_run) > 0) {
                                        foreach ($query_run as $fed) {
                                    ?>
                                            <tr>
                                                <td><?= $fed['feedback_ID'] ?></td>
                                                <td><?= $fed['user_ID'] ?></td>
                                                <td><?= $fed['f_date'] ?></td>
                                                <td><?= $fed['f_q_1'] ?></td>
                                                <td><?= $fed['f_q_2'] ?></td>
                                                <td><?= $fed['f_q_3'] ?></td>
                                                <td><?= $fed['f_description'] ?></td>
                                            </tr>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="6">No Record Found</td>
                                        </tr>
                                    <?php
                                    }
                                    ?>

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php include('includes/script.php'); ?>
<?php include('includes/footer.php'); ?>