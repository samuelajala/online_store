<div id="bodyleft">
  <h3>Content Management</h3>

  <ul>
    <li><a href="index.php">Home</a></li>
    <li><a href="index.php?viewall_cat">Viewall Categories</a></li>
    <li><a href="index.php?viewall_sub_cat">Viewall sub Categories</a></li>
    <li><a href="index.php?add_products">Add New Products</a></li>
    <li><a href="index.php?viewall_products">View All Products</a></li>
  </ul>
</div> <!--end of bodyleft-->

<?php
  if(isset($_GET['viewall_cat'])){
    include("cat.php");
  }
  else if (isset($_GET['viewall_sub_cat'])){
    include("sub_cat.php");
  }
  else if (isset($_GET['viewall_products'])){
    include("viewall_products.php");
  }
  else if (isset($_GET['add_products'])){
    include("add_products.php");
  }
?>
