<?php
include('includes/header.php');
?>

    <div class="site-blocks-cover" id="background" data-aos="fade">
      <div class="container">
      </div>
    </div>

    <div class="site-section block-8">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-7 text-center">
            <h1 class="topic-color">We welcome you to APL,</h1>
            <h1 class="topic-color">#Tag Line</h1>
            <p class="text-center">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quisquam iste dolor accusantium facere corporis ipsum animi deleniti fugiat. Ex, veniam?</p>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section shop-by-category">
      <div class="container">
          <div class="row justify-content-center mb-5">
              <div class="col-md-7 text-center">
                  <h1 class="topic-color">Shop By Brand</h1>
              </div>
          </div>
          <div class="row">
          <?php
              $query = "SELECT * FROM brand LIMIT 7";
              $query_run = mysqli_query($con, $query);

              if (mysqli_num_rows($query_run) > 0) {
                  while ($pro = mysqli_fetch_assoc($query_run)) {
            ?>
              <div class="col-md-4 col-lg-2 mb-4">
                  <div class="category-item">
                      <figure class="image">
                      <?php if (!empty($pro['brand_image'])) : ?>
                                                  <img src="data:image/jpeg;base64,<?= base64_encode($pro['brand_image']) ?>" class="product-image" alt="Product Image">
                                              <?php else : ?>
                                                  <p>No Image</p>
                                              <?php endif; ?>
                      </figure>
                      <div class="text">
                          <h3 class="product-title"><?php $pro['brand_name']?></h3>
                      </div>
                      <div class="overlay">
                        <a href="product.php" class="view-product-btn">View On Shop</a>
                      </div>
                  </div>
              </div>
              <?php
                }
            } else {
                echo "<p>No Record Found</p>";
            }
            ?>
          </div>
      </div>
    </div>

    <div class="site-section shop-by-category">
      <div class="container">
          <div class="row justify-content-center mb-5">
              <div class="col-md-7 text-center">
                  <h1 class="topic-color">Top Selling Products</h1>
              </div>
          </div>
          <div class="row">
          <?php
              $query = "SELECT p.product_id,p.product_name, p.product_image, p.unit_price, 
                              SUM(o.quantity) AS total_sold
                        FROM orders o
                        JOIN product p ON o.product_id = p.product_id
                        GROUP BY p.product_id
                        ORDER BY total_sold DESC
                        LIMIT 7";
              $query_run = mysqli_query($con, $query);

              if (mysqli_num_rows($query_run) > 0) {
                  while ($pro = mysqli_fetch_assoc($query_run)) {
            ?>
              <div class="col-md-4 col-lg-2 mb-4">
                  <div class="category-item">
                      <figure class="image">
                      <?php if (!empty($pro['product_image'])) : ?>
                                                  <img src="data:image/jpeg;base64,<?= base64_encode($pro['product_image']) ?>" class="product-image" alt="Product Image">
                                              <?php else : ?>
                                                  <p>No Image</p>
                                              <?php endif; ?>
                      </figure>
                      <div class="text">
                          <h3 class="product-title"><?php $pro['product_name']?></h3>
                          <p class="product-price"><?php $pro['unit_price']?></p>
                          <button class="earn-points-btn">Earn 188 Points</button>
                      </div>
                      <div class="overlay">
                      <a href="product-single.php?product_id=<?= $pro['product_id']; ?>" class="view-product-btn">View Product</a>
                      </div>
                  </div>
              </div>
              <?php
                }
            } else {
                echo "<p>No Record Found</p>";
            }
            ?>
          </div>
      </div>
    </div>

    <section class="w3l-customers-sec-6">
      <div class="customers-sec-6-cintent py-5">
        <!-- /customers-->
        <div class="container py-lg-5">
        <?php
      include('messageJT.php');
        ?>
          <div class="row justify-content-center mb-5">
            <div class="col-md-7 text-center pt-4">
              <h1 class="topic-color">What Our Customer Say!</h1>
            </div>
          </div>
          <div class="row customerhny my-lg-5 my-4">
            <div class="col-md-12">
              <div id="customerhnyCarousel" class="carousel slide" data-ride="carousel">

                <ol class="carousel-indicators">
                  <li data-target="#customerhnyCarousel" data-slide-to="0" class="active"></li>
                  <li data-target="#customerhnyCarousel" data-slide-to="1"></li>
                  <li data-target="#customerhnyCarousel" data-slide-to="2"></li>
                </ol>
                <!-- Carousel items -->
                <div class="carousel-inner">

                  <div class="carousel-item active">
                    <div class="row">


                      <?php
                      $query = "SELECT * FROM feedback, users WHERE feedback.user_ID = users.user_ID AND IFNULL(feedback.status,1)=1 LIMIT 4";
                      $query_run = mysqli_query($con, $query);

                      if (mysqli_num_rows($query_run) > 0) {
                        foreach ($query_run as $row) {
                      ?>
                          <div class="col-md-3">
                            <div class="customer-info text-center">
                              <div class="feedback-hny">
                                <span class="icon icon-quote-left text-warning"></span>
                                <p class="feedback-para"><?php echo $row['f_description'] ?></p>
                              </div>
                              <div class="feedback-review mt-4">
                                <img src="assets/images/c1.jpg" class="img-fluid" alt="">
                                <h5><?php echo $row['username'] ?></h5>
                              </div>
                            </div>
                          </div>
                        <?php
                        }
                      } else {
                        ?>
                        <tr>
                          <td>No Record Found</td>
                        </tr>
                      <?php
                      }
                      ?>


                    </div>
                    <!--.row-->
                  </div>
                  <!--.item-->

                  <div class="carousel-item">
                    <div class="row">


                      <?php
                      $query = "SELECT * FROM feedback, users WHERE feedback.user_ID = users.user_ID AND IFNULL(feedback.status,1)=1 LIMIT 4 OFFSET 4";
                      $query_run = mysqli_query($con, $query);

                      if (mysqli_num_rows($query_run) > 0) {
                        foreach ($query_run as $row) {
                      ?>
                          <div class="col-md-3">
                            <div class="customer-info text-center">
                              <div class="feedback-hny">
                                <span class="icon icon-quote-left text-warning"></span>
                                <p class="feedback-para"><?php echo $row['f_description'] ?></p>
                              </div>
                              <div class="feedback-review mt-4">
                                <img src="assets/images/c1.jpg" class="img-fluid" alt="">
                                <h5><?php echo $row['username'] ?></h5>
                              </div>
                            </div>
                          </div>
                        <?php
                        }
                      } else {
                        ?>
                        <tr>
                          <td>No Record Found</td>
                        </tr>
                      <?php
                      }
                      ?>


                    </div>
                    <!--.row-->
                  </div>
                  <!--.item-->

                  <div class="carousel-item">
                    <div class="row">


                      <?php
                      $query = "SELECT * FROM feedback, users WHERE feedback.user_ID = users.user_ID AND IFNULL(feedback.status,1)=1 LIMIT 4 OFFSET 8";
                      $query_run = mysqli_query($con, $query);

                      if (mysqli_num_rows($query_run) > 0) {
                        foreach ($query_run as $row) {
                      ?>
                          <div class="col-md-3">
                            <div class="customer-info text-center">
                              <div class="feedback-hny">
                                <span class="icon icon-quote-left text-warning"></span>
                                <p class="feedback-para"><?php echo $row['f_description'] ?></p>
                              </div>
                              <div class="feedback-review mt-4">
                                <img src="assets/images/c1.jpg" class="img-fluid" alt="">
                                <h5><?php echo $row['username'] ?></h5>
                              </div>
                            </div>
                          </div>
                        <?php
                        }
                      } else {
                        ?>
                        <tr>
                          <td>No Record Found</td>
                        </tr>
                      <?php
                      }
                      ?>


                    </div>
                    <!--.row-->
                  </div>
                  <!--.item-->

                </div>
                <!--.carousel-inner-->
              </div>
              <!--.Carousel-->

            </div>
          </div>
        </div>
      </div>
    </section>

    <div class="site-section block-8">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-7 text-center">
            <h1 class="topic-color">About Us</h1>
            <p class="text-center">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quisquam iste dolor accusantium facere corporis ipsum animi deleniti fugiat. Ex, veniam?</p>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">
          <div class="row">
              <div class="col-md-12 text-center mb-5">
                  <h1 class="topic-color">Contact Us</h1>
              </div>
              <div class="col-md-4">
                  <div class="contact-info">
                      <h2>Call To Us</h2>
                      <p>We are available 24/7, 7 days a week.</p>
                      <p>Phone: +8801711222222</p>
                      
                      <h2>Write To Us</h2>
                      <p>Fill out our form and we will contact you within 24 hours.</p>
                      <p>Emails: customer@exclusive.com<br>support@exclusive.com</p>
                  </div>
              </div>
              <div class="col-md-8">
                  <form id="contact-form" name="contact-form" action="mailto:allpartslanka@gmail.com?cc=test@gmail.com&subject='<? $_GET['subject'] ?>'" method="POST" enctype="text/plain">
                      <div class="p-3 p-lg-5 border">
                          <div class="form-group row">
                              <div class="col-md-4">
                                  <label for="name" class="text-black">Your Name <span class="text-danger">*</span></label>
                                  <input type="text" class="form-control" id="name" name="name">
                              </div>
                              <div class="col-md-4">
                                  <label for="email" class="text-black">Your Email <span class="text-danger">*</span></label>
                                  <input type="email" class="form-control" id="email" name="email" placeholder="">
                              </div>
                              <div class="col-md-4">
                                  <label for="phone" class="text-black">Your Phone <span class="text-danger">*</span></label>
                                  <input type="text" class="form-control" id="phone" name="phone">
                              </div>
                          </div>
                          <div class="form-group row">
                              <div class="col-md-12">
                                  <label for="message" class="text-black">Your Message</label>
                                  <textarea name="message" id="message" cols="30" rows="7" class="form-control"></textarea>
                              </div>
                          </div>
                          <div class="form-group row">
                              <div class="col-lg-12 text-right">
                                  <input type="submit" class="btn btn-danger btn-lg" value="Send Message">
                              </div>
                          </div>
                      </div>
                  </form>
              </div>
          </div>
      </div>
    </div>
    
    <div class="site-section block-8">
      <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7 text-center">
              <h1 class="topic-color text-center">FAQs</h1>
            </div>
            <div class="faq-section">
              <div class="faq-item">
                  <button class="faq-question" onclick="toggleFaq(this)">
                      Where can I watch?
                      <span class="faq-icon">+</span>
                  </button>
                  <div class="faq-answer">
                      <p>Nibh quisque suscipit fermentum netus nulla cras porttitor euismod nulla. Orci, dictumst nec aliquet id ullamcorper venenatis.</p>
                  </div>
              </div>
              <div class="faq-item">
                  <button class="faq-question" onclick="toggleFaq(this)">
                      Mauris id nibh eu fermentum mattis purus?
                      <span class="faq-icon">+</span>
                  </button>
                  <div class="faq-answer">
                      <p>Content for the second FAQ goes here.</p>
                  </div>
              </div>
              <div class="faq-item">
                  <button class="faq-question" onclick="toggleFaq(this)">
                      Eros imperdiet rhoncus?
                      <span class="faq-icon">+</span>
                  </button>
                  <div class="faq-answer">
                      <p>Content for the third FAQ goes here.</p>
                  </div>
              </div>
            </div>
          </div>
      </div>
    </div>
                    
<?php
include('includes/footer.php');
?> 