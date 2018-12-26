
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
          <a class="navbar-brand" href=""><img style ="border-radius: 50%;" src="<?php echo $userInfo->profile_image_url;?>"> @<?php echo $userInfo->screen_name;
              ?></a>

          <div class="row">

            <?php foreach ($rankings as $rank) {
                  ?>

            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-info card-header-icon">
                  <div class="card-icon">
                    <i class="fa fa-twitter"></i>
                  </div>
                  <p class="card-category"><?php echo $rank[1]; ?></p>
                  <h3 class="card-title">#<?php echo $rank[0]; ?>/<?php echo $rank[2]; ?></h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons">update</i> Just Updated
                  </div>
                </div>
              </div>
            </div>
        <?php
              } ?>

</div>

<div class="row">
  <?php foreach ($rankings as $rank) {
                  ?>

            <div class="col-lg-12 col-md-12">
                            <div class="card">
                <div class="card-header card-header-warning">
                  <h4 class="card-title"><?php echo $rank[1]; ?></h4>
                </div>
                <div class="card-body table-responsive">

<?php
if ($rank[1] == "College Football") {
                      $rank[1] = "cfb";
                  } ?>
                  <table id="<?php echo $rank[1]; ?>-accounts" class="table table-striped " style="width:100%">
                  <thead>
                    <tr>

                      <th>Rank</th>
                      <th>+/-</th>

                      <th>Name</th>

                      <th>Followers</th>
                                        <th>Following</th>
                                                                  <th>Followers Today</th>



                    </tr>
                  </thead>
                  <tbody>

                  </tbody>
                </table>
                </div>

        </div>

              </div>  <?php
              } ?>
      </div>
