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
                            <input type="text" id="searchFeedback" class="form-control mb-3" placeholder="Search...">
                            <table class="table table-bordered" id="feedbackTable">
                                <thead>
                                    <tr>
                                        <th>Feedback ID</th>
                                        <th>User ID</th>
                                        <th>Feedback Date</th>
                                        <th>Q 01</th>
                                        <th>Q 02</th>
                                        <th>Q 03</th>
                                        <th>Feedback Description</th>
                                        <th>Status</th>
                                        <th>Active</th>
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
                                                <td>
                                                    <?php echo isset($fed['status']) && intval($fed['status']) === 1 ? 'Active' : 'Inactive'; ?>
                                                </td>
                                                <td>
                                                    <form action="code.php" method="POST" class="m-0 p-0 d-inline-block">
                                                        <input type="hidden" name="feedback_id" value="<?= $fed['feedback_ID'] ?>">
                                                        <div class="custom-control custom-switch">
                                                          <input type="checkbox" class="custom-control-input" id="fb_switch_<?= $fed['feedback_ID'] ?>" <?= (isset($fed['status']) && intval($fed['status'])===1) ? 'checked' : '' ?> onchange="this.form.submit()">
                                                          <label class="custom-control-label" for="fb_switch_<?= $fed['feedback_ID'] ?>"></label>
                                                          <input type="hidden" name="toggle_feedback_status" value="1">
                                                        </div>
                                                    </form>
                                                </td>
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
<script>
  $(document).ready(function() {
    function attachTableFilter(inputSelector, tableSelector) {
      $(inputSelector).on('keyup', function () {
        const term = $(this).val().toLowerCase();
        $(tableSelector + ' tbody tr').each(function () {
          const rowText = $(this).text().toLowerCase();
          $(this).toggle(rowText.indexOf(term) !== -1);
        });
      });
    }
    attachTableFilter('#searchFeedback', '#feedbackTable');
  });
</script>