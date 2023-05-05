<div id="bodyright">
  <h3>View All Sub Categories</h3>
  <form enctype="multipart/form-data" method="post">
    <table>
      <tr>
        <th>Sr No.</th>
        <th>Sub Category Name</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
        <?php include("include/function.php"); echo viewall_sub_category(); ?>
    </table>
  </form>

  <h3 id="add_cat">Add New Sub Category From Here</h3>
  <form method="post">
    <table>
      <tr>
        <td>Select Category Name:</td>
        <td>
            <select name="main_cat">
              <?php echo viewall_cat(); ?>
          </select>
        </td>
      </tr>
      <tr>
        <td>Enter Sub Category Name:</td>
        <td><input type="text" name="sub_cat_name" required = "required"/></td>
      </tr>
    </table>
    <center><button name="add_sub_cat">Add Sub Category</button></center>
  </form>
</div>

<?php
  //include("include/function.php"); we do not need to call the function again since we've alredy called the function before.
  echo add_sub_cat();
?>
