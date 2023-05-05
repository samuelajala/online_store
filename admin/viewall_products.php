<div class="scroll" id="bodyright">
  <form method="post" enctype="multipart/form-data">
    <h3>Add New Products From Here</h3>
    <table>
      <tr>
        <th>Sr No.</th>
        <th>Edit</th>
        <th>Delete</th>
        <th>Product Name</th>
        <th>Product Images</th>
        <th>Feature 1</th>
        <th>Feature 2</th>
        <th>Feature 3</th>
        <th>Feature 4</th>
        <th>Price</th>
        <th>Model No.</th>
        <th>Warranty No.</th>
        <th>Keyword</th>
        <th>Added Date</th>
      </tr>
        <?php include("include/function.php"); echo viewall_products(); ?>
    </table>
  </form>
</div>
