<section id="demo" class="bg-dark text-white">
  <div class="container text-center">
    <h2 class="mb-4">Sign up for a Free Demo and Walkthrough</h2>
    <form id="demo-form">
    </br>
  </br>
      <div class="row">
        <div class="col">
          <input name="first-name" class="form-control" placeholder="First name" value="">
        </div>
        <div class="col">
          <input type="text" name="last-name" class="form-control" placeholder="Last name">
        </div>
      </div>
    </br>        </br>

    <div class="row">
      <div class="col">
        <input type="text" name="email" class="form-control" placeholder="Email">
      </div>
      <div class="col">
        <input type="text" name="subject" class="form-control" placeholder="subject">
      </div>
    </div>
  </br>      </br>

<div class="row">
<div class="col">
<input type="text" name="organization"class="form-control" placeholder="organization">
</div>
</div>
</br>      </br>
<button type="submit" class="btn btn-success">Submit <span class="fa fa-arrow-right"></span></button>

<p id="success" style="display:none; color:green; padding-top:15px;">Successfully Submitted!</p>
</form>
  </div>
</section>
<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>


<script>
$(document).ready(function(){

$('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
   $($.fn.dataTable.tables(true)).DataTable()
      .columns.adjust()
      .fixedColumns().relayout();
});
});
$(function(){
    $("#demo-form").submit(function(){
        dataString = $("#demo-form").serialize();

        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>FormSubmission/demoform",
            data: dataString,
            success: function(data){
              if(data != "1"){
                alert('Error Submiting');
              }
              else {
                alert('Successfully Submitted!');
                location.reload();

              }
            }

        });

        return false;  //stop the actual form post !important!

    });
});

var uri = window.location.toString();
if (uri.indexOf("?") > 0) {
  var clean_uri = uri.substring(0, uri.indexOf("?"));
  window.history.replaceState({}, document.title, clean_uri);
}




    </script>

    <!-- Bootstrap core JavaScript -->
    <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="<?php echo base_url(); ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/scrollreveal/scrollreveal.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

    <!-- Custom scripts for this template -->
    <script src="<?php echo base_url(); ?>assets/js/creative.min.js"></script>


  </body>

</html>
