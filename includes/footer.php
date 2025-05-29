    <footer class="site-footer border-top custom-bg">
      <div class="container">
        <div class="row">
          
          <div class="col-md-6 col-lg-8">
            <div class="block-5 mb-5">
              <div class="site-logo">
                <img src="images/companylogo.png" class="w-40 p-3" alt="User Image">
              </div>
              <p>Nibh quisque suscipit fermentum netus nulla cras porttitor euismod nulla. Orci, dictumst nec aliquet id ullamcorper venenatis.</p>
            </div>
          </div>
          <div class="col-lg-4 mb-5 mb-lg-0">
            <div class="row">
              <div class="col-md-12">
                <h3 class="footer-heading mb-4 text-light">Navigations</h3>
              </div>
              <div class="col-md-6 col-lg-6">
                <ul class="list-unstyled">
                  <li><a href="index.php" class="text-light">HOME</a></li>
                  <li><a href="product.php" class="text-light">SHOP</a></li>
                  <li><a href="aboutus.php" class="text-light">ABOUT US</a></li>
                  <li><a href="contactus.php" class="text-light">CONTACT US</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="text-center text-light">
          © 2025 Copyright:
          <a class="text-light" href="index.php">www.ALLPARTSLANKA.com</a>
        </div>
      </div>
    </footer>
  </div>


  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>

  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>

  <script src="js/main.js"></script>
  <script src="js/background.js"></script>
  <script src="js/filter.js"></script>
  <script src="js/product-single.js"></script>

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>
  

  <script type="text/javascript">
    $(document).ready(function() {
      
      $("#placeOrder").submit(function(e) {
        e.preventDefault();
        $.ajax({
          url: 'code.php',
          method: 'post',
          data: $('form').serialize() + "&action=order",
          success: function(response) {
            $("#order").html(response);
          }
        });
      });
      // Send product details in the server
      $(".addSingleItemBtn").click(function(e) {
        debugger;
          var $form = $(this).closest(".form-submit");
          var u_id = $form.find(".u_id").val();
          var u_qty = $form.find(".u_qty").val();
          var u_price = $form.find(".unit-price").text().replace(/,/g, '').trim();
          var total_price = $form.find(".total-price").text().replace(/,/g, '').trim();
          location.reload(true);
          $.ajax({
              url: 'code.php',
              method: 'post',
              data: {
                  u_id: u_id,
                  u_qty: u_qty,
                  u_price: u_price,
                  total_price: total_price
              },
              success: function(response) {
                load_cart_item_number();
              }
          });
      });

      $(".addItemBtn").click(function(e) {
        debugger;
        var $form = $(this).closest(".form-submit");
        var u_id = $form.find(".u_id").val();
        var u_qty = $form.find(".u_qty").val();
        var u_price = $form.find(".unit-price").text().replace(/[$,]/g, '').trim();
        var total_price = $form.find(".unit-price").text().replace(/[$,]/g, '').trim();

        location.reload(true);
        $.ajax({
            url: 'code.php',
            method: 'post',
            data: {
                u_id: u_id,
                u_qty: u_qty,
                u_price: u_price,
                total_price: total_price
            },
            success: function(response) {
              load_cart_item_number();
            }
        });
    });

      $(".itemQty").on('change', function() {
      var $el = $(this).closest('tr');

      var o_id = $el.find(".o_id").val();
      var price = $el.find(".price").val();
      var qty = $el.find(".itemQty").val();
      location.reload(true);
      $.ajax({
        url: 'code.php',
        method: 'post',
        cache: false,
        data: {
          qty: qty,
          o_id: o_id,
          price: price
        },
        success: function(response) {
          console.log(response);
        }
      });
    });

      // Load total no.of items added in the cart and display in the navbar
      load_cart_item_number();

      function load_cart_item_number() {
        $.ajax({
          url: 'code.php',
          method: 'get',
          data: {
            cartItem: "cart_item"
          },
          success: function(response) {
            $("#cart-item").html(response);
          }
        });
      }
      
    });
  </script>
  <script>
    function toggleFaq(element) {
        const isActive = element.classList.toggle("active");
        const icon = element.querySelector(".faq-icon");
        icon.textContent = isActive ? "×" : "+";
    }
  </script>

</body>

</html>