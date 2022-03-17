<!DOCTYPE html>
<html lang="en">
<?php $this->load->view("general_content_block/head"); ?>

  <body>
    <?php $this->load->view("general_content_block/navigation"); ?>

    <?php $this->load->view($destination["site"]); ?>
    
    <?php $this->load->view("general_content_block/footer"); ?>

    <?php $this->load->view("general_content_block/scripts"); ?>
  </body>
</html>
