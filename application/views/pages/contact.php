
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
          <div style="padding:50px" class="alert alert-block">
            <h2 class="alert-heading">Contact Us</h2><h5>
           We are happy to answer any questions or inquiries you might have</br>
                <section id="demo" class=" text-dark">
                  <div class="container text-left">
                    <form id="contact-form">
                    </br>
                  </br>
                      <div class="row">
                        <div class="col-md-4">
                          <input name="full-name" class="form-control" placeholder="Full Name" value="">
                        </div>
                        <div class="col-md-4">
                          <input type="text" name="email" class="form-control" placeholder="Email">
                        </div>
                      </div>
                    </br>        </br>

                    <div class="row">
                      <div class="col-md-4">
                        <input type="text" name="subject" class="form-control" placeholder="Subject">
                      </div>

                    </div>
                  </br>      </br>


            <div class="row">
              <div class="col">

            <textarea type="text" placeholder="Message" id="message" name="message" rows="2" class="form-control md-textarea"></textarea>
</div>
</div>

            </br>      </br>
            <button type="submit" class="btn btn-primary">Submit <span class="fa fa-arrow-right"></span></button>
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
                    $("#contact-form").submit(function(){
                        dataString = $("#contact-form").serialize();

                        $.ajax({
                            type: "POST",
                            url: "<?php echo base_url(); ?>/FormSubmission/demoform",
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

          </div>

          <div class="row">

      </div>
