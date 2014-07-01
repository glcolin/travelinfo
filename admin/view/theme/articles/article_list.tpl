<?php echo $header; ?>
<div id="content">
  
  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>
  <?php if ($success) { ?>
  <div class="success"><?php echo $success; ?></div>
  <?php } ?>
  <div class="box">
  	<div class="heading">
      <h1><img src="view/image/product.png" alt="" /> Information </h1>
    </div>
	<div class="content">
      <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form">
      <textarea id="sort_string" name="sort_string" style="display:none;"></textarea>
        <table class="list">
          <thead>
            <tr>
                <td class="left">Title</td>
                <td class="center" width="200">Edit</td>

            </tr>
          </thead>
          <tbody>

          
          <?php if ($articles) { ?>
          <?php foreach ($articles as $article) { ?>
          	<tr>
				<td class="left"><?php echo $article['title']?></td>
				<td class="center">
					[ <a href="index.php?route=articles/articles/edit&article_id=<?php echo $article['item_id']; ?>">edit</a> ]
				</td>
            </tr>
          <?php }?>
          <?php }?>
          </tbody>
        </table>
      </form>
     </div>           
  </div>
</div>

<?php echo $footer; ?>