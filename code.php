<?php
session_start();
include('config/dbcon.php');

// Add PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer files
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if(isset($_POST['addUser_website'])){
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $phone = $_POST['phonenumber'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];

    function validate_phone_number($phone_num)
    {
        // Allow +, - and . in phone number
        $filtered_phone_number = filter_var($phone_num, FILTER_SANITIZE_NUMBER_INT);

        // Check the lenght of number
        // This can be customized if you want phone number from a specific country
        if (strlen($filtered_phone_number) == 10 ) {
            return true;
        } else {
        return false;
        }
    }

    if($password == $confirmpassword)
    {
        if (validate_phone_number($phone) == true) {
            if(filter_var($email, FILTER_VALIDATE_EMAIL) == true)
            {
                $checkemail = "SELECT email FROM users WHERE email='$email'";
                $checkemail_run = mysqli_query($con, $checkemail);

                if(mysqli_num_rows($checkemail_run)>0)
                {
                    //Taken Already exists
                    $_SESSION['status'] = "Email id is already taken.!";
                    header("Location: signup.php");
                }
                else
                {
                    //Available = Record not found
                    $user_query = "INSERT INTO users (username,phonenumber,email,password,first_name,last_name,address) VALUES ('$username','$phone','$email','$password','$firstname','$lastname','$address')";
                    $user_query_run = mysqli_query($con, $user_query);

                    if($user_query_run)
                    {
                        $_SESSION['status'] = "User Added Successfully";
                        header("Location: login.php");
                    }
                    else
                    {
                        $_SESSION['status'] = "User Registration Failed";
                        header("Location: signup.php");
                    }
                }  

            }
            else
            {
                $_SESSION['status'] = "Not a valid email address";
                header("Location: signup.php");
            }
        } 
        else 
        {
            $_SESSION['status'] = "Not a valid phone number";
            header("Location: signup.php");
        }
          
    }
    else
    {
        $_SESSION['status'] = "Password and confirm password does not match.!";
        header("Location: signup.php");
    }
}
if (isset($_POST['addUser'])) {
    $name = $_POST['username'];
    $phone = $_POST['phonenumber'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];

    if ($password == $confirmpassword) {

        $checkemail = "SELECT email FROM users WHERE email='$email'";
        $checkemail_run = mysqli_query($con, $checkemail);

        if (mysqli_num_rows($checkemail_run) > 0) {
            //Taken Already exists
            $_SESSION['status'] = "Email id is already taken.!";
            header("Location: index.php");
        } else {
            //Available = Record not found
            $user_query = "INSERT INTO users (username,phonenumber,email,password) VALUES ('$name','$phone','$email','$password')";
            $user_query_run = mysqli_query($con, $user_query);

            if ($user_query_run) {
                $_SESSION['status'] = "User Added Successfully";
                header("Location: index.php");
            } else {
                $_SESSION['status'] = "User Registration Failed";
                header("Location: index.php");
            }
        }
    } else {
        $_SESSION['status'] = "Password and confirm password does not match.!";
        header("Location: registered.php");
    }
}
if (isset($_POST['addfeedback'])) {
    if (isset($_SESSION['auth_user'])) {
    
    $date = date("Y-m-d");
    $q_01 = $_POST['q_01'];
    $q_02 = $_POST['q_02'];
    $q_03 = $_POST['q_03'];
    $message = $_POST['message'];
    $user_id = $_SESSION['auth_user']['user_id'];

    $user_query = "INSERT INTO feedback (user_ID,f_date,f_q_1,f_q_2,f_q_3,f_description) VALUES ('$user_id','$date','$q_01','$q_02','$q_03','$message')";
    $user_query_run = mysqli_query($con, $user_query);

    if ($user_query_run) {
        $_SESSION['status'] = "Sent your feedback";
        header("Location: feedback.php");
    } else {
        $_SESSION['status'] = "Failed to sending your feedback";
        header("Location: feedback.php");
    }
    }
    else{
        $_SESSION['status'] = "Logging first!";
        header("Location: feedback.php");
    }
}
if (isset($_POST['login_btn'])) {
    //session_destroy();
    unset($_SESSION['auth']);
    unset($_SESSION['auth_user']);

    header('Location: login.php');
    exit(0);
}
if (isset($_POST['signup_btn'])) {
    //session_destroy();
    unset($_SESSION['auth']);
    unset($_SESSION['auth_user']);

    header('Location: signup.php');
    exit(0);
}
if (isset($_POST['logout_btn'])) {
    //session_destroy();
    unset($_SESSION['auth']);
    unset($_SESSION['auth_user']);

    $_SESSION['status'] = "Logged out successfully";
    header('Location: index.php');
    exit(0);
}
if (isset($_POST['myorder_btn'])) {
    header('Location: myorders.php');
}
if (isset($_POST['adminlogin_btn'])) {
    //session_destroy();
    unset($_SESSION['auth']);
    unset($_SESSION['auth_user']);

    header('Location: ../admin/adminlogin.php');
    exit(0);
}
if (isset($_POST['check_Emailbtn'])) {
    $email = $_POST['email'];

    $checkemail = "SELECT email FROM users WHERE email='$email'";
    $checkemail_run = mysqli_query($con, $checkemail);

    if (mysqli_num_rows($checkemail_run) > 0) {
        echo "Email id already taken.!";
    } else {
        echo "It's Available";
    }
}
// Add products into the cart table
if (isset($_POST['u_id'])) {
    if (isset($_SESSION['auth_user'])) {
        $user_id = $_SESSION['auth_user']['user_id'];
        $u_id = $_POST['u_id'];
        $u_qty = $_POST['u_qty'];
        $u_price = intval($_POST['u_price']);
        $total_price = intval($_POST['total_price']);

        $user_query = "INSERT INTO orderdetails (product_id,user_ID,price,quantity,total_price) VALUES('$u_id','$user_id','$u_price','$u_qty','$total_price')";
        $user_query_run = mysqli_query($con, $user_query);

        if ($user_query_run) {

            $_SESSION['status'] = "Product added to the cart";
            header("Location: product-single.php?product_id=$u_id");
            exit();

        } else {

            $_SESSION['status'] = "Product added Failed";
            header("Location: product-single.php?product_id=$u_id");
            exit();
        }
        
    }
    else {
        echo '<script>alert("Logging first!")</script>';
    }
} 
// Get no.of items available in the cart table
if (isset($_SESSION['auth_user'])) {
    if (isset($_GET['cartItem']) && isset($_GET['cartItem']) == 'cart_item') {
        $user_id = $_SESSION['auth_user']['user_id'];
        $stmt = $con->prepare("SELECT * FROM orderdetails WHERE user_ID ='$user_id'");
        $stmt->execute();
        $stmt->store_result();
        $rows = $stmt->num_rows;

        echo $rows;
    } else {
        $rows = 0;
        echo $rows;
    }
}
// Remove single items from cart
if (isset($_GET['remove'])) {
    $id = $_GET['remove'];

    $stmt = $con->prepare('DELETE FROM orderdetails WHERE order_ID=?');
    $stmt->bind_param('i', $id);
    $stmt->execute();

    $_SESSION['status'] = "Item removed from the cart!";

    header('location:cart.php');
}
// Set total price of the product in the cart table
if (isset($_POST['qty'])) {
    $qty = $_POST['qty'];
    $o_id = $_POST['o_id'];
    $price = $_POST['price'];

    $tprice = $qty * $price;



    $user_query = "UPDATE orderdetails SET quantity= $qty,total_price=$tprice WHERE order_ID= $o_id";
    $user_query_run = mysqli_query($con, $user_query);
    if ($user_query_run) {
        $_SESSION['status'] = "Item quatity added successfully!";
        header("Location: cart.php");
    }
}
// Checkout and save customer info in the orders table
if (isset($_POST['action']) && isset($_POST['action']) == 'order') {
    $user_id = $_POST['user_id'];
    
    $grand_total = $_POST['grand_total'];
    $address = $_POST['address'];
    $district = $_POST['district'];
    $due_date = $_POST['due_date'];
    $order_date = date("Y-m-d");

    $data = '';

    // Get user email
    $user_query = "SELECT email FROM users WHERE user_id = '$user_id'";
    $user_result = mysqli_query($con, $user_query);
    $user_data = mysqli_fetch_assoc($user_result);
    $user_email = $user_data['email'];

    $sql = "SELECT product_id,quantity,total_price FROM orderdetails WHERE user_ID = '$user_id'";
    $stmt = $con->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $product_id = $row['product_id'];
        $qty = $row['quantity'];
        $total_price = $row['total_price'];

        $stmt = $con->prepare('INSERT INTO orders (user_ID,product_id,quantity,total_price,order_date,due_date,delivery_address,district)VALUES(?,?,?,?,?,?,?,?)');
        $stmt->bind_param('ssssssss', $user_id, $product_id, $qty, $total_price, $order_date, $due_date, $address, $district);
        $stmt->execute();
    }

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'mglmuthukumara@gmail.com'; // Your Gmail address
        $mail->Password   = 'tezu yybn qdnv zhwh';    // Your Gmail App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom('mglmuthukumara@gmail.com', 'APL');
        $mail->addAddress('muthukumaragayan@gmail.com'); // Where to send the order notification
        $mail->addReplyTo($user_email);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'New Order Placed';
        
        // Get order details for email
        $order_details = "<h2>Order Details:</h2><br>";
        $order_details .= "<p><strong>Order Date:</strong> " . $order_date . "</p>";
        $order_details .= "<p><strong>Delivery Address:</strong> " . $address . "</p>";
        $order_details .= "<p><strong>District:</strong> " . $district . "</p>";
        $order_details .= "<p><strong>Due Date:</strong> " . $due_date . "</p>";
        $order_details .= "<p><strong>Total Amount:</strong> Rs. " . number_format($grand_total, 2) . "</p><br>";
        
        // Get product details
        $order_details .= "<h3>Products:</h3>";
        $product_query = "SELECT p.product_name, o.quantity, o.total_price 
                         FROM orders o 
                         JOIN product p ON o.product_id = p.product_id 
                         WHERE o.user_ID = '$user_id' AND o.order_date = '$order_date'";
        $product_result = mysqli_query($con, $product_query);
        
        $order_details .= "<table border='1' cellpadding='5' cellspacing='0'>
                            <tr>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Total Price</th>
                            </tr>";
        
        while($product = mysqli_fetch_assoc($product_result)) {
            $order_details .= "<tr>
                                <td>" . $product['product_name'] . "</td>
                                <td>" . $product['quantity'] . "</td>
                                <td>Rs. " . number_format($product['total_price'], 2) . "</td>
                            </tr>";
        }
        
        $order_details .= "</table>";
        
        $mail->Body = $order_details;
        $mail->AltBody = strip_tags($order_details);

        $mail->send();
        
    } catch (Exception $e) {
        // Log the error but don't show it to the user
        error_log("Email sending failed: {$mail->ErrorInfo}");
    }

    $stmt2 = $con->prepare("DELETE FROM orderdetails WHERE user_ID = '$user_id'");
    $stmt2->execute();
    $data .= '<div class="site-section">
                <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                    <span class="icon-check_circle display-3 topic-color"></span>
                    <h2 class="display-3 text-black">Thank you!</h2>
                    <p class="lead mb-5">You order was successfuly completed.</p>
                    <p><a href="index.php" class="btn btn-sm text-white custom-bg">Back to shop</a></p>
                    </div>
                </div>
                </div>
            </div>';
    echo $data;
}

?>










