        <!-- Inner Banner -->
        <div class="inner-banner bg-shape2 bg-color2">
            <div class="d-table">
                <div class="d-table-cell">
                    <div class="conatiner">
                        <div class="inner-title text-center">
                            <h3><?php echo lang('od_h1'); ?></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="container">
<?php if(!empty($order)){ ?>
    <div class="col-md-12">
        <div class="alert alert-success"><?php echo lang('od_m1'); ?></div>
    </div>
    <div class="row col-lg-12">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th><b><?php echo lang('od_m2'); ?></b></th>
                    <th><b><?php echo lang('od_m3'); ?></b> </th>
                    <th><b><?php echo lang('od_m4'); ?></b></th>
                    <th><b><?php echo lang('od_m5'); ?></b></th>
                    <th><b><?php echo lang('od_m6'); ?></b> </th>
                    <th><b><?php echo lang('od_m7'); ?></b> </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td> #<?php echo $order['id']; ?></td>
                    <td><?php echo '฿'.$order['grand_total'].' '.lang('cs_m8');?></td>
                    <td> <?php echo $order['created']; ?></td>
                    <td> <?php echo $order['name']; ?></td>
                    <td><?php echo $order['email']; ?></td>
                    <td><?php echo $order['phone']; ?></td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Order items -->
<?php } else{ ?>
<div class="col-md-12">
    <div class="alert alert-danger">Your order submission failed.</div>
</div>
<?php } ?>
        </div>
        <!-- Inner Banner End -->
