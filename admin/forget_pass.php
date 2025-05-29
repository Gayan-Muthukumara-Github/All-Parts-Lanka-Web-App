<?php
include('includes/header.php');
include('config/dbcon.php');
session_start();
$message = $link = '';
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $query = "SELECT * FROM users WHERE email = '" . $email . "'";
    $result = $con->query($query);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $id = $row['user_ID'];
            $id_encode = base64_encode($id);
            $link = "<a href='reset_pass.php?MnoQtyPXZORTE=$id_encode' class='btn btn-dark btn-block'>Recieve Mail</a>";
        }
    } else {
        $_SESSION['status'] = "Invalid Email..!!";
    }
}
?>

<div class="login-section" style="background-image: url('assets/dist/img/bgimage_1.jpg'); height: 100vh; background-size: cover; background-position: center; background-repeat: no-repeat;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 my-5">
                <?php include('message.php'); ?>
                <div class="card my-5">
                    <div class="card-header">
                        <h5>Forget Password</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <div class="form-group">
                                <input type="text" name="email" class="form-control" placeholder="Email Id">
                            </div>
                            <div class="form-group">
                                <button type="submit" name="submit" class="btn btn-dark btn-block">Reset Password</button>
                                <?php echo $link; ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include('includes/script.php'); ?>