<div id="bodyright">
  <h3>Add New Products From Here</h3>
  <form method="post" enctype="multipart/form-data">
    <table>
      <tr>
        <td>Enter products Name:</td>
        <td><input type="text" name="pro_name" required = "required"/></td>
      </tr>
      <tr>
        <td>Select Category Name:</td>
        <td>
          <select name="main_cat">
            <?php include("include/function.php"); echo viewall_cat(); ?>
          </select>
        </td>
      </tr>
      <tr>
        <td>Select Sub Category Name:</td>
        <td>
          <select name="sub_cat">
            <?php echo viewall_sub_cat(); ?>
          </select>
        </td>
      </tr>
      <tr>
        <td>Select Product Image 1:</td>
        <td><input type="file" name="pro_img1" required = "required"/></td>
      </tr>
      <tr>
        <td>Select Product Image 2:</td>
        <td><input type="file" name="pro_img2" required = "required"/></td>
      </tr>
      <tr>
        <td>Select Product Image 3:</td>
        <td><input type="file" name="pro_img3" required = "required"/></td>
      </tr>
      <tr>
        <td>Select Product Image 4:</td>
        <td><input type="file" name="pro_img4" required = "required"/></td>
      </tr>
      <tr>
        <td>Enter Feature1:</td>
        <td><input type="text" name="pro_feature1" required = "required"/></td>
      </tr>
      <tr>
        <td>Enter Feature2:</td>
        <td><input type="text" name="pro_feature2" required = "required"/></td>
      </tr>
      <tr>
        <td>Enter Feature3:</td>
        <td><input type="text" name="pro_feature3" required = "required"/></td>
      </tr>
      <tr>
        <td>Enter Feature4:</td>
        <td><input type="text" name="pro_feature4" required = "required"/></td>
      </tr>
      <tr>
        <td>Enter Price:</td>
        <td><input type="text" name="pro_price" required = "required"/></td>
      </tr>
      <tr>
        <td>Enter Model No. :</td>
        <td><input type="text" name="pro_model" required = "required"/></td>
      </tr>
      <tr>
        <td>Enter Warranty :</td>
        <td><input type="text" name="pro_warranty" required = "required"/></td>
      </tr>
      <tr>
        <td>For Whom :</td>
        <td>
          <select name="pro_for_whom">
            <option></option>
            <option value="men">Men</option>
            <option value="women">Women</option>
            <option value="kids">Kids</option>
          </select>
        </td>
      </tr>
      <tr>
        <td>Enter Keyword :</td>
        <td><input type="text" name="pro_keyword" required = "required"/></td>
      </tr>
    </table>
    <center><button name="add_product">Add Product </button></center>
  </form>
</div>

<?php
add_pro();
?>
