<!-- <h2>Sent Email Using SMTP</h2><br>


  <?php if ($error = $this->session->flashdata('msg')) { ?>
       <p style="color: green;"><strong>Success!</strong> <?php echo  $error; ?><p>
  <?php } ?>



<form action="<?php echo base_url(); ?>email_send/send" method="post">
   <input type="email" name="from" class="form-control" placeholder="Enter Email" required><br>
   <textarea name="message" class="form-control" placeholder="Enter message here" required></textarea><br>
   <button type="submit" class="btn btn-primary">Send Message</button>
</form> -->
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>itOffside.com CodeIgniter Pagination</title>
  <style type="text/css">
    a {
      color: #003399;
      background-color: transparent;
      font-weight: normal;
      margin: 3px;
      border: 1px solid #000000;
      padding: 2px;
    }

    h1 {
      color: #444;
      background-color: transparent;
      border-bottom: 1px solid #D0D0D0;
      font-size: 19px;
      font-weight: normal;
      margin: 0 0 14px 0;
      padding: 14px 15px 10px 15px;
    }

    #container {
      margin: 10px;
      border: 1px solid #D0D0D0;
      box-shadow: 0 0 8px #D0D0D0;
      padding: 5px;
    }

    p {
      margin: 12px 15px 12px 15px;
    }
  </style>
</head>

<body style="margin-top: 10px;">
  <div id="container">
    <h1>Product</h1>
    <div id="body">
      <?php
      foreach ($results as $data) {
        echo "{" . $data->id . "}" . $data->name . " - " . $data->price . "<br>";
      }
      ?>
      <p><?php echo $links; ?></p>
    </div>
    <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
  </div>
</body>

</html>