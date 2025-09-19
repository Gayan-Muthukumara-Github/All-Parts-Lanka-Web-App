<?php
session_start();
include('config/dbcon.php');

if(isset($_POST['logout_btn']))
{
    //session_destroy();
    unset($_SESSION['auth']);
    unset($_SESSION['auth_user']);
    
    $_SESSION['status'] = "Logged out successfully";
    header('Location: login.php');
    exit(0);
}
//email check function for signup
if(isset($_POST['check_Emailbtn']))
{
    $email = $_POST['email'];

    $checkemail = "SELECT email FROM users WHERE email='$email'";
    $checkemail_run = mysqli_query($con, $checkemail);

    if(mysqli_num_rows($checkemail_run)>0)
    {
        echo "Email id already taken.!";
    }
    else
    {
        echo "It's Available";
    }
}
//user table add data from website
//user table add data from admin panel
if(isset($_POST['addUser']))
{
    $name = $_POST['username'];
    $phone = $_POST['phonenumber'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];

    if($password == $confirmpassword)
    {

        $checkemail = "SELECT email FROM users WHERE email='$email'";
        $checkemail_run = mysqli_query($con, $checkemail);

        if(mysqli_num_rows($checkemail_run)>0)
        {
            //Taken Already exists
            $_SESSION['status'] = "Email id is already taken.!";
            header("Location: registered.php");
        }
        else
        {
            //Available = Record not found
            $user_query = "INSERT INTO users (username,phonenumber,email,password,created_at) VALUES ('$name','$phone','$email','$password', NOW())";
            $user_query_run = mysqli_query($con, $user_query);

            if($user_query_run)
            {
                $_SESSION['status'] = "User Added Successfully";
                header("Location: registered.php");
            }
            else
            {
                $_SESSION['status'] = "User Registration Failed";
                header("Location: registered.php");
            }
        }

        
    }
    else
    {
        $_SESSION['status'] = "Password and confirm password does not match.!";
        header("Location: registered.php");
    }

    

}
//user table edit data from admin panel
if(isset($_POST['updateUser']))
{
    $user_id = $_POST['user_id'];
    $name = $_POST['username'];
    $phone = $_POST['phonenumber'];
    $email = $_POST['email'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $address = $_POST['address'];
    $password = $_POST['password'];
    $uType_ID = $_POST['uType_ID'];

    $query = "UPDATE users SET username='$name', phonenumber='$phone', email='$email', password='$password',first_name='$first_name' ,last_name='$last_name',address='$address' ,uType_ID='$uType_ID' WHERE user_ID='$user_id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['status'] = "User Updated Successfully";
        header("Location: registered.php");
    }
    else
    {
        $_SESSION['status'] = "User Updating Failed";
        header("Location: registered.php");
    }

}
//user table delete data from admin panel
if(isset($_POST['DeleteUserbtn']))
{
    $user_id = $_POST['delete_id'];
   
    $query = "DELETE FROM users WHERE user_ID='$user_id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['status'] = "User Deleted Successfully";
        header("Location: registered.php");
    }
    else
    {
        $_SESSION['status'] = "User Deleting Failed";
        header("Location: registered.php");
    }

}
//Product Type table add data from admin panel
if(isset($_POST['addProductType']))
{
    $producttype_id = $_POST['producttype_id'];
    $producttype_name = $_POST['producttype_name'];
    $parameter1 = $_POST['parameter1'];
    $parameter2 = $_POST['parameter2'];
    $parameter3 = $_POST['parameter3'];
    $parameter4 = $_POST['parameter4'];
    $parameter5 = $_POST['parameter5'];
    $parameter6 = $_POST['parameter6'];
    $parameter7 = $_POST['parameter7'];
    $parameter8 = $_POST['parameter8'];
    $parameter9 = $_POST['parameter9'];
    $parameter10 = $_POST['parameter10'];
    $parameter11 = $_POST['parameter11'];
    $parameter12 = $_POST['parameter12'];
    $parameter13 = $_POST['parameter13'];
    $parameter14 = $_POST['parameter14'];
    $parameter15 = $_POST['parameter15'];
    $parameter16 = $_POST['parameter16'];
    $parameter17 = $_POST['parameter17'];
    $parameter18 = $_POST['parameter18'];
    $parameter19 = $_POST['parameter19'];
    $parameter20 = $_POST['parameter20'];
    
    $cate_query = "INSERT INTO producttype (producttype_name, parameter1, parameter2, parameter3, parameter4, parameter5, parameter6, parameter7, parameter8, parameter9, parameter10, parameter11, parameter12, parameter13, parameter14, parameter15, parameter16, parameter17, parameter18, parameter19, parameter20) VALUES ('$producttype_name','$parameter1','$parameter2','$parameter3','$parameter4','$parameter5','$parameter6','$parameter7','$parameter8','$parameter9','$parameter10','$parameter11','$parameter12','$parameter13','$parameter14','$parameter15','$parameter16','$parameter17','$parameter18','$parameter19','$parameter20')";
    $cate_query_run = mysqli_query($con, $cate_query);

    if($cate_query_run)
    {
        $_SESSION['status'] = "Product Type Added Successfully";
        header("Location: producttype.php");
    }
    else
    {
        $_SESSION['status'] = "Product Type Add Failed";
        header("Location: producttype.php");
    }
      

}
//Product Type table edit data from admin panel
if(isset($_POST['editProductType']))
{
    $producttype_id = $_POST['producttype_id'];
    $producttype_name = $_POST['producttype_name'];
    $parameter1 = $_POST['parameter1'];
    $parameter2 = $_POST['parameter2'];
    $parameter3 = $_POST['parameter3'];
    $parameter4 = $_POST['parameter4'];
    $parameter5 = $_POST['parameter5'];
    $parameter6 = $_POST['parameter6'];
    $parameter7 = $_POST['parameter7'];
    $parameter8 = $_POST['parameter8'];
    $parameter9 = $_POST['parameter9'];
    $parameter10 = $_POST['parameter10'];
    $parameter11 = $_POST['parameter11'];
    $parameter12 = $_POST['parameter12'];
    $parameter13 = $_POST['parameter13'];
    $parameter14 = $_POST['parameter14'];
    $parameter15 = $_POST['parameter15'];
    $parameter16 = $_POST['parameter16'];
    $parameter17 = $_POST['parameter17'];
    $parameter18 = $_POST['parameter18'];
    $parameter19 = $_POST['parameter19'];
    $parameter20 = $_POST['parameter20'];

    $query = "UPDATE producttype SET producttype_name='$producttype_name', parameter1='$parameter1', parameter2='$parameter2', parameter3='$parameter3', parameter4='$parameter4', parameter5='$parameter5', parameter6='$parameter6', parameter7='$parameter7', parameter8='$parameter8', parameter9='$parameter9', parameter10='$parameter10', parameter11='$parameter11', parameter12='$parameter12', parameter13='$parameter13', parameter14='$parameter14', parameter15='$parameter15', parameter16='$parameter16', parameter17='$parameter17', parameter18='$parameter18', parameter19='$parameter19', parameter20='$parameter20' WHERE producttype_id='$producttype_id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Product Type Updated Successfully";
        header("Location: producttype.php");
    }
    else
    {
        $_SESSION['status'] = "Product Type Updating Failed";
        header("Location: producttype.php");
    }

}
//Product Type table delete data from admin panel
if(isset($_POST['deleteProductType']))
{
    $producttype_id = $_POST['delete_id'];
   
    $query = "DELETE FROM producttype WHERE producttype_id='$producttype_id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Product Type Deleted Successfully";
        header("Location: producttype.php");
    }
    else
    {
        $_SESSION['status'] = "Product Type Deleting Failed";
        header("Location: producttype.php");
    }

}
//orders table edit data from admin panel
if(isset($_POST['editOrders']))
{
    $status = $_POST['status'];
    $order_id = $_POST['order_id'];

    $query = "UPDATE orders SET status='$status' WHERE order_ID='$order_id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Order Status Updated Successfully";
        header("Location: orders.php");
    }
    else
    {
        $_SESSION['status'] = "Order Status Updating Failed";
        header("Location: orders.php");
    }

}
//orders table delete data from admin panel
if(isset($_POST['deleteOrder']))
{
    $order_id = $_POST['delete_id'];
   
    $query = "DELETE FROM orders WHERE order_ID='$order_id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Order Deleted Successfully";
        header("Location: orders.php");
    }
    else
    {
        $_SESSION['status'] = "order Deleting Failed";
        header("Location: orders.php");
    }

}
//Brand table add data from admin panel
if (isset($_POST['addBrand'])) {
    $brand_name = mysqli_real_escape_string($con, $_POST['brand_name']);

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = $_FILES['image']['tmp_name'];
        $imageData = addslashes(file_get_contents($image)); 

        $query = "INSERT INTO brand (brand_name, brand_image) VALUES ('$brand_name', '$imageData')";
        $query_run = mysqli_query($con, $query);

        if ($query_run) {
            $_SESSION['status'] = "Brand Added Successfully";
            header("Location: brand.php");
            exit();
        } else {
            $_SESSION['status'] = "Brand Add Failed";
            header("Location: brand.php");
            exit();
        }
    } else {
        $_SESSION['status'] = "Please upload a valid image";
        header("Location: brand.php");
        exit();
    }
}
//Brand table edit data from admin panel
if (isset($_POST['editBrand'])) {

    $brand_id = mysqli_real_escape_string($con, $_POST['brand_id']);
    $brand_name = mysqli_real_escape_string($con, $_POST['brand_name']);
    $existing_image = $_POST['existing_image']; // Existing image in case no new image is uploaded

    // Check if a new image is uploaded
    if (!empty($_FILES['brand_image']['name'])) {
        $image = $_FILES['brand_image']['tmp_name'];
        $imageData = addslashes(file_get_contents($image)); // Convert image to binary
    } else {
        $imageData = base64_decode($existing_image); // Keep old image if no new file is uploaded
    }

    $query = "UPDATE brand SET brand_name='$brand_name', brand_image='$imageData' WHERE brand_id='$brand_id'";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['status'] = "Brand Updated Successfully";
        header("Location: brand.php");
        exit();
    } else {
        $_SESSION['status'] = "Brand Update Failed";
        header("Location: brand.php");
        exit();
    }
}
//Brand table delete data from admin panel
if(isset($_POST['deletebrand']))
{
    $brand_id = $_POST['brand_id'];
   
    $query = "DELETE FROM brand WHERE brand_id='$brand_id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Brand Deleted Successfully";
        header("Location: brand.php");
    }
    else
    {
        $_SESSION['status'] = "Brand Deleting Failed";
        header("Location: brand.php");
    }

}
if (isset($_POST['producttype_id'])) {
    $producttype_id = $_POST['producttype_id'];

    $query = "SELECT parameter1, parameter2, parameter3, parameter4, parameter5, parameter6, parameter7, parameter8, parameter9, parameter10, parameter11, parameter12, parameter13, parameter14, parameter15, parameter16, parameter17, parameter18, parameter19, parameter20 FROM producttype WHERE producttype_id = $producttype_id";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        foreach ($row as $key => $value) {
            if (!empty($value)) {
                echo "
                <div class='form-group'>
                    <label for=''>$value</label>
                    <input type='text' name='$key' class='form-control' placeholder='Enter $value'>
                </div>";
            }
        }
    } else {
        echo "<p>No Parameters Found</p>";
    }
}
//Product table add data from admin panel
if (isset($_POST['addProduct'])) {
    $product_name = mysqli_real_escape_string($con, $_POST['product_name']);
    $brand_id = mysqli_real_escape_string($con, $_POST['brand_id']);
    $producttype_id = mysqli_real_escape_string($con, $_POST['producttype_id']);
    $product_description = '';
    $unit_price = floatval($_POST['unit_price']);
    

    // Handling product description based on parameters
    $parameter_query = "SELECT parameter1, parameter2, parameter3, parameter4, parameter5, parameter6, parameter7, parameter8, parameter9, parameter10, parameter11, parameter12, parameter13, parameter14, parameter15, parameter16, parameter17, parameter18, parameter19, parameter20 FROM producttype WHERE producttype_id = $producttype_id";
    $parameter_result = mysqli_query($con, $parameter_query);
    $parameter_map = [];

    if (mysqli_num_rows($parameter_result) > 0) {
        $row = mysqli_fetch_assoc($parameter_result);
        foreach ($row as $key => $value) {
            if (!empty($value)) {
                $parameter_map[$key] = $value;
            }
        }
    }

    foreach ($_POST as $key => $value) {
        if (!in_array($key, ['addProduct', 'product_name', 'brand_id', 'producttype_id','unit_price']) && !empty($value)) {
            if (isset($parameter_map[$key])) { 
                $parameter_value = $parameter_map[$key]; 
                $product_description .= "$parameter_value:$value;"; 
            }
        }
    }
    $product_description = rtrim($product_description, ";"); 

    // Handle Image Upload as Binary Data
    $imageData = null;
    if (!empty($_FILES['product_image']['tmp_name'])) {
        $imageData = file_get_contents($_FILES['product_image']['tmp_name']); // Read image as binary
        $imageData = mysqli_real_escape_string($con, $imageData); // Escape for SQL
    }

    // Insert product into database
    $cate_query = "INSERT INTO product (product_name, brand_id, producttype_id, product_description, product_image, unit_price) 
                   VALUES ('$product_name', '$brand_id', '$producttype_id', '$product_description', '$imageData', '$unit_price')";

    $cate_query_run = mysqli_query($con, $cate_query);

    if ($cate_query_run) {
        $_SESSION['status'] = "Product Added Successfully";
        header("Location: product.php");
        exit();
    } else {
        $_SESSION['status'] = "Product Add Failed";
        header("Location: product.php");
        exit();
    }
}
//Product table edit data from admin panel
if (isset($_POST['editproduct'])) {

    // Secure input values
    $product_id = intval($_POST['product_id']); // Ensure it's an integer
    $product_name = mysqli_real_escape_string($con, trim($_POST['product_name']));
    $brand_id = intval($_POST['brand_id']);
    $producttype_id = intval($_POST['producttype_id']);
    $unit_price = floatval($_POST['unit_price']);

    // Fetch Existing Image from Database if No New Image is Uploaded
    $query = "SELECT product_image FROM product WHERE product_id = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "i", $product_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $existing_image);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    // Handle Image Upload
    $product_image = $existing_image; // Default to existing image
    if (!empty($_FILES['product_image']['tmp_name'])) {
        $product_image = file_get_contents($_FILES['product_image']['tmp_name']); // Read binary image data
    }

    // Reconstruct product_description dynamically
    $product_description = "";
    if (isset($_POST['description']) && is_array($_POST['description'])) {
        foreach ($_POST['description'] as $key => $value) {
            if (!empty(trim($value))) {
                $product_description .= "$key:" . trim($value) . ";";
            }
        }
    }
    $product_description = rtrim($product_description, ";"); // Remove trailing semicolon

    // Prepare and execute query (using prepared statement)
    $query = "UPDATE product SET 
                product_name = ?, 
                brand_id = ?, 
                producttype_id = ?, 
                product_description = ?, 
                product_image = ?,
                unit_price = ? 
              WHERE product_id = ?";

    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "siissii", $product_name, $brand_id, $producttype_id, $product_description, $product_image, $unit_price, $product_id);
    $query_run = mysqli_stmt_execute($stmt);

    if ($query_run) {
        $_SESSION['status'] = "Product Updated Successfully!";
    } else {
        $_SESSION['status'] = "Product Update Failed: " . mysqli_error($con);
    }

    header("Location: product.php");
    exit();
}
//Product table delete data from admin panel
if(isset($_POST['deleteProduct']))
{
    $product_id = $_POST['delete_id'];
   
    $query = "DELETE FROM product WHERE product_id='$product_id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Product Deleted Successfully";
        header("Location: product.php");
    }
    else
    {
        $_SESSION['status'] = "Product Deleting Failed";
        header("Location: product.php");
    }

}
// Save Background Image
if(isset($_POST['save_background'])) {
    $image_name = mysqli_real_escape_string($con, $_POST['image_name']);

    if (isset($_FILES['background_image']) && $_FILES['background_image']['error'] == 0) {
        $image = $_FILES['background_image'];
        
        // Check file size (limit to 10MB)
        $max_size = 10 * 1024 * 1024; // 10MB in bytes
        if ($image['size'] > $max_size) {
            $_SESSION['status'] = "Image size should be less than 10MB";
            header("Location: manage_background.php");
            exit();
        }

        // Check file type
        $allowed_types = array('image/jpeg', 'image/jpg', 'image/png');
        $file_type = $image['type'];
        
        if (!in_array($file_type, $allowed_types)) {
            $_SESSION['status'] = "Only JPG and PNG images are allowed";
            header("Location: manage_background.php");
            exit();
        }

        // Generate unique filename
        $file_extension = pathinfo($image['name'], PATHINFO_EXTENSION);
        $new_filename = uniqid() . '.' . $file_extension;
        $upload_path = '../images/background_image/' . $new_filename;
        $full_path = __DIR__ . '/../images/background_image/' . $new_filename;

        // Create directory if it doesn't exist
        if (!file_exists(dirname($full_path))) {
            mkdir(dirname($full_path), 0755, true);
        }

        // Move uploaded file
        if (move_uploaded_file($image['tmp_name'], $full_path)) {
            // Store the relative path in database (without the ../ prefix)
            $db_path = 'images/background_image/' . $new_filename;
            $query = "INSERT INTO background_images (image_name, image_path, status) VALUES (?, ?, 1)";
            $stmt = mysqli_prepare($con, $query);
            
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "ss", $image_name, $db_path);
                
                if (mysqli_stmt_execute($stmt)) {
                    $_SESSION['status'] = "Background Image Added Successfully";
                } else {
                    $_SESSION['status'] = "Background Image Add Failed: " . mysqli_error($con);
                    // Delete the uploaded file if database insert fails
                    unlink($full_path);
                }
                
                mysqli_stmt_close($stmt);
            } else {
                $_SESSION['status'] = "Error preparing statement: " . mysqli_error($con);
                // Delete the uploaded file if statement preparation fails
                unlink($full_path);
            }
        } else {
            $_SESSION['status'] = "Failed to upload image file";
        }
        
        header("Location: manage_background.php");
        exit();
    } else {
        $_SESSION['status'] = "Please upload a valid image";
        header("Location: manage_background.php");
        exit();
    }
}

// Delete Background Image
if(isset($_POST['delete_background'])) {
    $image_id = $_POST['delete_background'];
    
    // First get the image path
    $query = "SELECT image_path FROM background_images WHERE id = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "i", $image_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if ($row = mysqli_fetch_assoc($result)) {
        $image_path = $row['image_path'];
        $full_path = __DIR__ . '/../' . $image_path;
        
        // Delete the file if it exists
        if (file_exists($full_path)) {
            unlink($full_path);
        }
        
        // Delete from database
        $delete_query = "DELETE FROM background_images WHERE id = ?";
        $delete_stmt = mysqli_prepare($con, $delete_query);
        mysqli_stmt_bind_param($delete_stmt, "i", $image_id);
        
        if(mysqli_stmt_execute($delete_stmt)) {
            $_SESSION['message'] = "Background image deleted successfully!";
        } else {
            $_SESSION['message'] = "Error deleting background image!";
        }
        
        mysqli_stmt_close($delete_stmt);
    }
    
    header('Location: manage_background.php');
    exit(0);
}

// Toggle Background Status
if(isset($_POST['toggle_background_status'])) {
    $image_id = $_POST['toggle_background_status'];
    
    $query = "UPDATE background_images SET status = NOT status WHERE id = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "i", $image_id);
    
    if(mysqli_stmt_execute($stmt)) {
        $_SESSION['message'] = "Background status updated successfully!";
    } else {
        $_SESSION['message'] = "Error updating background status!";
    }
    
    header('Location: manage_background.php');
    exit(0);
}

// Toggle feedback active/inactive status
if (isset($_POST['toggle_feedback_status'])) {
    $feedback_id = intval($_POST['feedback_id']);

    $query = "UPDATE feedback SET status = IF(status=1,0,1) WHERE feedback_ID = ?";
    $stmt = mysqli_prepare($con, $query);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $feedback_id);
        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['status'] = "Feedback status updated successfully!";
        } else {
            $_SESSION['status'] = "Error updating feedback status!";
        }
        mysqli_stmt_close($stmt);
    } else {
        $_SESSION['status'] = "Error preparing feedback status update!";
    }
    header('Location: feedback.php');
    exit(0);
}
?>
