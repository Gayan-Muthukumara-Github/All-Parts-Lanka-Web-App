<?php
include('includes/header.php');
?>
    <div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="index.php">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Feedback</strong></div>
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
          <h3 class="hny-title text-center mb-0 ">Customers <span class="text-warning">FEEDBACK</span></h3>
          <p class="mb-5 text-center">What People Say</p>
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
                      $query = "SELECT * FROM feedback, users WHERE feedback.user_ID = users.user_ID LIMIT 4";
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
                      $query = "SELECT * FROM feedback, users WHERE feedback.user_ID = users.user_ID LIMIT 4 OFFSET 4";
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
                      $query = "SELECT * FROM feedback, users WHERE feedback.user_ID = users.user_ID LIMIT 4 OFFSET 8";
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

    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h2 class="h3 mb-3 text-black text-center">Your Feedback</h2>
          </div>
          <div class="col-md-12">
            <form action="code.php" method="POST">
              <div class="p-3 p-lg-5 border">
                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="q_01" class="text-black">How satisfied about the uniform?<span class="text-danger">*</span></label>
                    <select class="form-control" name="q_01" id="q_01" required>
                      <option></option>
                      <option>Satisfied</option>
                      <option>Fair-minded</option>
                      <option>Not satisfied</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="q_02" class="text-black">What's your idea about the prices of the uniforms?<span class="text-danger">*</span></label>
                    <select class="form-control" name="q_02" id="q_02" required>
                      <option></option>
                      <option>Fair prices</option>
                      <option>Very expensive</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="q_03" class="text-black">What do you think about your overall process?<span class="text-danger">*</span></label>
                    <select class="form-control" name="q_03" id="q_03" required>
                      <option></option>
                      <option>Satisfied</option>
                      <option>Fair-minded</option>
                      <option>Not satisfied</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="message" class="text-black">Extra note<span class="text-danger"></span></label>
                    <textarea name="message" id="message" cols="30" rows="4" class="form-control"></textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-lg-12">
                    <input type="submit" name="addfeedback" class="btn btn-dark btn-lg btn-block" value="Send Feedback">
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

<?php
include('includes/footer.php');
?> 