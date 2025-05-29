<?php
include('includes/header.php');
?>

    <div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="index.php">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Contact Us</strong></div>
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h2 class="h3 mb-3 topic-color">Get In Touch</h2>
          </div>
          <div class="col-md-6">

            <form id="contact-form" name="contact-form" action="mailto:allpartslanka@gmail.com?cc=test@gmail.com&subject='<? $_GET['subject'] ?>'" method="POST" enctype="text/plain">

              <div class="p-3 p-lg-5 border">
                <div class="form-group row">
                  <div class="col-md-6">
                    <label for="name" class="text-black">Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="name" name="name">
                  </div>
                  <div class="col-md-6">
                    <label for="email" class="text-black">Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="subject" class="text-black">Subject </label>
                    <input type="text" class="form-control" id="subject" name="subject">
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="message" class="text-black">Message </label>
                    <textarea name="message" id="message" cols="30" rows="7" class="form-control"></textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-lg-12">
                    <input type="submit" class="btn custom-bg btn-lg btn-block text-white" value="Send Message">
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="col-md-6">
            <div class="container-fluid">
              <div class="map-responsive">
                <iframe src="https://maps.google.com/maps?q=jayamal,polgolla,Gokarella,Sri%20Lanka&t=&z=13&ie=UTF8&iwloc=&output=embed" width="600" height="600" frameborder="0" style="border:0" allowfullscreen></iframe>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

<?php
include('includes/footer.php');
?> 