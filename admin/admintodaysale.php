<div class="col-12 col-sm-4 col-md-4">
            <div class="info-box">
              <span class="info-box-icon bg-gradient-primary elevation-1"><i class="fas fa-calendar"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Today's Sales</span>
                <span class="info-box-number text-right">
                  <?php 
                    if($_settings->userdata('type') == 3):
                      $total = $conn->query("SELECT sum(amount) as total FROM sale_list where user_id = '{$_settings->userdata('id')}' ");
                    else:
                      $total = $conn->query("SELECT sum(amount) as total FROM sale_list");
                    endif;
                    $total = $total->num_rows > 0 ? $total->fetch_array()['total'] : 0; 
                    $total = $total > 0 ? $total : 0;
                    echo format_num($total);
                  ?>
                  <?php ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>