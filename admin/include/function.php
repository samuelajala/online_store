<?php
  function add_cat(){
    include('include/db.php');
    if(isset($_POST['add_cat'])){
      $cat_name = $_POST['cat_name'];
      //prepare is very useful in php for security
      $add_cat = $con->prepare("insert into main_cat(cat_name)values('$cat_name')");
      if($add_cat->execute()){
        echo "<script>alert('Category Added successfully !!!');</script>";
        echo "<script>window.open('index.php?viewall_cat','_self');</script>";
      }
      else{
        echo "<script>alert('Category Not Added successfully !!!');</script>";
      }
    }
  }

  function viewall_cat(){
    include("include/db.php");

    $fetch_cat= $con ->prepare("select * from main_cat");
    $fetch_cat->setFetchMode(PDO:: FETCH_ASSOC);
    $fetch_cat->execute();
    while($row=$fetch_cat->fetch()):
      echo"<option value='".$row['cat_id']."'>".$row['cat_name']."</option>";
    endwhile;//used to end while loop
  }

    function viewall_category(){
    include("include/db.php");

    $fetch_cat= $con ->prepare("select * from main_cat ORDER BY cat_name");//ORDER BY cat_name helps to display the datas alphabetically
    $fetch_cat->setFetchMode(PDO:: FETCH_ASSOC);
    $fetch_cat->execute();
    $i=1;
    while($row=$fetch_cat->fetch()):
        echo "<tr>
              <td>".$i++."</td>
              <td>".$row['cat_name']."</td>
              <td><a href='index.php?edit_cat=".$row['cat_id']."'>Edit</a></td>
              <td><a href='delete_cat.php?delete_cat=".$row['cat_id']."'>Delete</a></td>
              </tr>";

    endwhile;

  }


  function delete_cat(){

    include("include/db.php");

      $delete_cat_id=$_GET['delete_cat'];

      $delete_cat = $con->prepare("delete from main_cat where cat_id='$delete_cat_id'");

      if($delete_cat->execute()){
        echo "<script>alert('Category Deleted Successfully !!!');</script>";
        echo "<script>window.open('index.php?viewall_cat','_self');</script>";
      }
    }



  function edit_cat(){
    include("include/db.php");
    if(isset($_GET['edit_cat'])){
        $cat_id=$_GET['edit_cat'];

        $fetch_cat_name=$con->prepare("select * from main_cat where cat_id='$cat_id'");
        $fetch_cat_name->setFetchMode(PDO:: FETCH_ASSOC);
        $fetch_cat_name->execute();

        $row=$fetch_cat_name->fetch();
        echo "<form method='post'>
          <table>
            <tr>
              <td>Edit Category Name:</td>
              <td><input type='text' name='cat_name' value='".$row['cat_name']."' required = 'required'/></td>
            </tr>
          </table>
          <center><button name='update_cat'>Update Category</button></center>
          </form>";
          if(isset($_POST['update_cat'])){
            $cat_name=$_POST['cat_name'];

            $update_cat=$con->prepare("update main_cat set cat_name='$cat_name' where cat_id='$cat_id'");
            if($update_cat->execute()){
              echo "<script>alert('Category Updated Successfully');</script>";
              echo "<script>window.open('index.php?viewall_cat','_self')</script>";//_target is use for another browser page
            }
          }
    }
  }

  function add_sub_cat(){

      include("include/db.php");
        if(isset($_POST['add_sub_cat'])){
          $cat_id = $_POST['main_cat'];
          $sub_cat_name = $_POST['sub_cat_name'];
          //prepare is very useful in php for security
          $add_sub_cat = $con->prepare("insert into sub_cat(sub_cat_name, cat_id)values('$sub_cat_name','$cat_id' )");
          if($add_sub_cat->execute()){
            echo "<script>alert('Sub Category Added successfully !!!');</script>";
            echo "<script>window.open('index.php?viewall_sub_cat','_self');</script>";
          }
          else{
            echo "<script>alert('Sub Category Not Added successfully !!!');</script>";
          }
        }
    }

    function viewall_sub_cat(){
    include("include/db.php");

    $fetch_sub_cat= $con ->prepare("select * from sub_cat");
    $fetch_sub_cat->setFetchMode(PDO:: FETCH_ASSOC);
    $fetch_sub_cat->execute();
    while($row=$fetch_sub_cat->fetch()):
      echo"<option value='".$row['sub_cat_id']."'>".$row['sub_cat_name']."</option>";
    endwhile;//used to end while loop
  }
  function viewall_sub_category(){
    include("include/db.php");


    $fetch_cat= $con ->prepare("select * from sub_cat ORDER BY sub_cat_name");//ORDER BY sub_cat_name helps to display the datas alphabetically

    $fetch_cat->setFetchMode(PDO:: FETCH_ASSOC);
    $fetch_cat->execute();
    $i=1;
    while($row=$fetch_cat->fetch()):
        echo "<tr>
              <td>".$i++."</td>
              <td>".$row['sub_cat_name']."</td>
              <td><a href='index.php?edit_sub_cat=".$row['sub_cat_id']."'>Edit</a></td>
              <td><a href='delete_cat.php?delete_sub_cat=".$row['sub_cat_id']."'>Delete</a></td>
              </tr>";

    endwhile;

  }

  function edit_sub_cat(){
    include("include/db.php");
    if(isset($_GET['edit_sub_cat'])){
      $sub_cat_id = $_GET['edit_sub_cat'];

      $fetch_sub_cat = $con->prepare("select * from sub_cat where sub_cat_id='$sub_cat_id'");
      $fetch_sub_cat->setFetchMode(PDO:: FETCH_ASSOC);
      $fetch_sub_cat->execute();
      $row=$fetch_sub_cat->fetch();
      $cat_id = $row['cat_id'];

      $fetch_cat= $con->prepare("select * from main_cat where cat_id='$cat_id'");
      $fetch_cat->setFetchMode(PDO:: FETCH_ASSOC);
      $fetch_cat->execute();
      $row_cat=$fetch_cat->fetch();
      echo "<form method='post'>
            <table>
              <tr>
                <td>Select Main Category Name :</td>
                <td>
                    <select name='main_cat'>
                      <option value='".$row_cat['cat_id']."'>".$row_cat['cat_name']."</option>";
                      echo viewall_cat();

                      echo"</select>
                  </td>
              </tr>

              <tr>
                <td>Update Sub Category Name:</td>
                <td><input type='text' name='up_sub_cat' value='".$row['sub_cat_name']."' /></td>
              </tr>
            </table>
            <center><button name='update_sub_cat'>Update Sub Category</button></center>
            </form>";

          if(isset($_POST['up_sub_cat'])){
            $cat_name=$_POST['main_cat'];
            $sub_cat_name=$_POST['up_sub_cat'];

            $update_cat= $con->prepare("update sub_cat set sub_cat_name='$sub_cat_name',cat_id='$cat_name' where sub_cat_id ='$sub_cat_id'");
            if($update_cat->execute()){
              echo"<script>alert('Sub Category Updated Successfully !!!'); </script>";
              echo"<script>window.open('index.php?viewall_sub_cat','_self')</script>";
            }
          }
    }
  }


  function delete_sub_cat(){
      include("include/db.php");
    $delete_sub_cat_id=$_GET['delete_sub_cat'];

    $delete_sub_cat=$con->prepare("delete from sub_cat where sub_cat_id='$delete_sub_cat_id'");
    if($delete_sub_cat->execute()){
      echo "<script>alert('Sub Category Deleted Successfully !!!');</script>";
      echo "<script>window.open('index.php?viewall_sub_cat','_self');</script>";
    }
  }


    function add_pro(){
      include("include/db.php");
      if(isset($_POST['add_product'])){
        $pro_name = $_POST['pro_name'];
        $cat_id = $_POST['main_cat'];
        $sub_cat_id = $_POST['sub_cat'];

        $pro_img1 = $_FILES['pro_img1']['name'];
        $pro_img1_tmp=$_FILES['pro_img1']['tmp_name'];

        $pro_img2 = $_FILES['pro_img2']['name'];
        $pro_img2_tmp=$_FILES['pro_img2']['tmp_name'];

        $pro_img3 = $_FILES['pro_img3']['name'];
        $pro_img3_tmp=$_FILES['pro_img3']['tmp_name'];

        $pro_img4 = $_FILES['pro_img4']['name'];
        $pro_img4_tmp=$_FILES['pro_img4']['tmp_name'];

        move_uploaded_file($pro_img1_tmp,"../imgs/pro_img/$pro_img1");
        move_uploaded_file($pro_img2_tmp,"../imgs/pro_img/$pro_img2");
        move_uploaded_file($pro_img3_tmp,"../imgs/pro_img/$pro_img3");
        move_uploaded_file($pro_img4_tmp,"../imgs/pro_img/$pro_img4");

        $pro_feature1 = $_POST['pro_feature1'];
        $pro_feature2 = $_POST['pro_feature2'];
        $pro_feature3 = $_POST['pro_feature3'];
        $pro_feature4 = $_POST['pro_feature4'];

        $pro_price = $_POST['pro_price'];
        $pro_model=$_POST['pro_model'];
        $pro_warranty=$_POST['pro_warranty'];
        $pro_for_whom=$_POST['pro_for_whom'];
        $pro_keyword=$_POST['pro_keyword'];

        //prepare is very useful in php for security
        $add_cat = $con->prepare("insert into products
                                (pro_name, cat_id, sub_cat_id, pro_img1, pro_img2, pro_img3, pro_img4,
                                pro_feature1, pro_feature2, pro_feature3, pro_feature4, pro_price,
                                pro_model, pro_warranty, pro_keyword, pro_added_date, for_whom)
                                values
                                ('$pro_name','$cat_id','$sub_cat_id','$pro_img1','$pro_img2','$pro_img3','$pro_img4',
                                '$pro_feature1','$pro_feature2','$pro_feature3','$pro_feature4','$pro_price',
                                '$pro_model','$pro_warranty','$pro_keyword', NOW(), '$pro_for_whom')");
        if($add_cat->execute()){
          echo "<script>alert('Product Added successfully !!!');</script>";
          echo "<script>window.open('index.php?add_products','_self');</script>";
}
        else{
          echo "<script>alert('Product Not Added successfully !!!');</script>";

        }
      }
    }
    function viewall_products(){
      include("include/db.php");

      $fetch_pro = $con->prepare("select * from products ORDER BY 1 DESC");
      $fetch_pro->setFetchMode(PDO:: FETCH_ASSOC);
      $fetch_pro->execute();

      $i=1;
      while ($row=$fetch_pro->fetch()):
        echo"<tr>
              <td> ".$i++."</td>
              <td><a href='index.php?edit_pro=".$row['pro_id']."'>Edit</a></td>
              <td><a href='delete_cat.php?delete_pro=".$row['pro_id']."'>Delete</a></td>
              <td style='min-width:200px;'>".$row['pro_name']."</td>
              <td style='min-width:200px;'>
                <img src='../imgs/pro_img/".$row['pro_img1']."'/>
                <img src='../imgs/pro_img/".$row['pro_img2']."'/>
                <img src='../imgs/pro_img/".$row['pro_img3']."'/>
                <img src='../imgs/pro_img/".$row['pro_img4']."'/>
              </td>
              <td>".$row['pro_feature1']."</td>
              <td>".$row['pro_feature2']."</td>
              <td>".$row['pro_feature3']."</td>
              <td>".$row['pro_feature4']."</td>
              <td>".$row['pro_price']."</td>
              <td>".$row['pro_model']."</td>
              <td>".$row['pro_warranty']."</td>
              <td>".$row['pro_keyword']."</td>
              <td style='min-width:200px;'>".$row['pro_added_date']."</td>
            </tr>";
      endwhile;
    }

    function edit_pro(){
      include("include/db.php");

      if(isset($_GET['edit_pro'])){
        $pro_id=$_GET['edit_pro'];

        $fetch_pro=$con->prepare("select * from products where pro_id='$pro_id'");
        $fetch_pro->setFetchMode(PDO:: FETCH_ASSOC);
        $fetch_pro->execute();

        $row=$fetch_pro->fetch();

        $cat_id=$row['cat_id'];
        $sub_cat_id=$row['sub_cat_id'];

        $fetch_cat=$con->prepare("select * from main_cat where cat_id='$cat_id'");
        $fetch_cat->setFetchMode(PDO:: FETCH_ASSOC);
        $fetch_cat->execute();
        $row_cat=$fetch_cat->fetch();
        $cat_name=$row_cat['cat_name'];

        $fetch_sub_cat=$con->prepare("select * from sub_cat where sub_cat_id='$sub_cat_id'");
        $fetch_sub_cat->setFetchMode(PDO:: FETCH_ASSOC);
        $fetch_sub_cat->execute();
        $row_sub_cat=$fetch_sub_cat->fetch();
        $sub_cat_name=$row_sub_cat['sub_cat_name'];

        echo "    <form method='post' enctype='multipart/form-data'>
            <table>
              <tr>
                <td>Update Product Name :</td>
                <td><input type='text' name='pro_name' value='".$row['pro_name']."' required = 'required'/></td>
              </tr>
              <tr>
                <td>Update Category Name:</td>
                <td>
                  <select name='cat_name'>
                    <option value='".$row['cat_id']."'>".$cat_name."</option>
                    ";  echo viewall_cat(); echo"
                  </select>
                </td>
              </tr>
              <tr>
                <td>Update Sub Category Name :</td>
                <td>
                  <select name='sub_cat_name'>
                      <option value='".$row['sub_cat_id']."'>".$sub_cat_name."</option>
                    "; echo viewall_sub_cat(); echo"
                  </select>
                </td>
              </tr>
              <tr>
                <td>Update Product Image 1:</td>
                <td>
                  <input type='file' name='pro_img1'/>
                  <center><img src='../imgs/pro_img/".$row['pro_img1']."' style='width:80px; height:80px;'/></center>
                </td>
              </tr>
              <tr>
                <td>Update Product Image 2:</td>
                <td>
                  <input type='file' name='pro_img2' />
                  <center><img src='../imgs/pro_img/".$row['pro_img2']."' style='width:80px; height:80px;'/></center>
                </td>
              </tr>
              <tr>
                <td>Update Product Image 3:</td>
                <td>
                  <input type='file' name='pro_img3' />
                <center><img src='../imgs/pro_img/".$row['pro_img3']."' style='width:80px; height:80px;'/></center>
                </td>
              </tr>
              <tr>
                <td>Update Product Image 4:</td>
                <td>
                  <input type='file' name='pro_img4' />
                  <center><img src='../imgs/pro_img/".$row['pro_img4']."' style='width:80px; height:80px;'/></center>
                </td>
              </tr>
              <tr>
                <td>Update Feature1:</td>
                <td><input type='text' name='pro_feature1' value='".$row['pro_feature1']."' required = 'required'/></td>
              </tr>
              <tr>
                <td>Update Feature2:</td>
                <td><input type='text' name='pro_feature2' value='".$row['pro_feature2']."' required = 'required'/></td>
              </tr>
              <tr>
                <td>Update Feature3:</td>
                <td><input type='text' name='pro_feature3' value='".$row['pro_feature3']."' required = 'required'/></td>
              </tr>
              <tr>
                <td>Update Feature4:</td>
                <td><input type='text' name='pro_feature4' value='".$row['pro_feature4']."' required = 'required'/></td>
              </tr>
              <tr>
                <td>Update Price:</td>
                <td><input type='text' name='pro_price' value='".$row['pro_price']."' required = 'required'/></td>
              </tr>
              <tr>
                <td>Update Model No. :</td>
                <td><input type='text' name='pro_model' value='".$row['pro_model']."' required = 'required'/></td>
              </tr>
              <tr>
                <td>Update Warranty :</td>
                <td><input type='text' name='pro_warranty' value='".$row['pro_warranty']."' required = 'required'/></td>
              </tr>
              <tr>
                <td>Update Keyword :</td>
                <td><input type='text' name='pro_keyword' value='".$row['pro_keyword']."' required = 'required'/></td>
              </tr>
            </table>
            <center><button name='update_product'>Update Product </button></center>
          </form>";

          if(isset($_POST['update_product'])){
            $pro_name = $_POST['pro_name'];
            $cat_id = $_POST['cat_name'];
            $sub_cat_id = $_POST['sub_cat_name'];

          if ($_FILES['pro_img1']['tmp_name']==""){/*do nothing*/}else {
              $pro_img1 = $_FILES['pro_img1']['name'];
              $pro_img1_tmp=$_FILES['pro_img1']['tmp_name'];
              move_uploaded_file($pro_img1_tmp,"../imgs/pro_img/$pro_img1");
              $up_img1=$con->prepare("update products set pro_img1 = '$pro_img1' where pro_id='$pro_id'");
              $up_img1->execute();
            }

          if ($_FILES['pro_img2']['tmp_name']==""){/*do nothing*/}else {
              $pro_img2 = $_FILES['pro_img2']['name'];
              $pro_img2_tmp=$_FILES['pro_img2']['tmp_name'];
              move_uploaded_file($pro_img2_tmp,"../imgs/pro_img/$pro_img2");
              $up_img2=$con->prepare("update products set pro_img2 = '$pro_img2' where pro_id='$pro_id'");
              $up_img2->execute();
            }
          if ($_FILES['pro_img3']['tmp_name']==""){/*do nothing*/}else {
              $pro_img3 = $_FILES['pro_img3']['name'];
              $pro_img3_tmp=$_FILES['pro_img3']['tmp_name'];
              move_uploaded_file($pro_img3_tmp,"../imgs/pro_img/$pro_img3");
              $up_img3=$con->prepare("update products set pro_img3 = '$pro_img3' where pro_id='$pro_id'");
              $up_img3->execute();
            }
          if ($_FILES['pro_img4']['tmp_name']==""){/*do nothing*/}else {
                  $pro_img4 = $_FILES['pro_img4']['name'];
                  $pro_img4_tmp=$_FILES['pro_img4']['tmp_name'];
                  move_uploaded_file($pro_img4_tmp,"../imgs/pro_img/$pro_img4");
                  $up_img4=$con->prepare("update products set pro_img4 = '$pro_img4' where pro_id='$pro_id'");
                  $up_img4->execute();
                }

            $pro_feature1 = $_POST['pro_feature1'];
            $pro_feature2 = $_POST['pro_feature2'];
            $pro_feature3 = $_POST['pro_feature3'];
            $pro_feature4 = $_POST['pro_feature4'];

            $pro_price = $_POST['pro_price'];
            $pro_model=$_POST['pro_model'];
            $pro_warranty=$_POST['pro_warranty'];
            $pro_keyword=$_POST['pro_keyword'];

            $up_pro=$con->prepare("update products set pro_name='$pro_name', cat_id='$cat_id', sub_cat_id='$sub_cat_id',
                                                      pro_feature1='$pro_feature1', pro_feature2='$pro_feature2',
                                                      pro_feature3='$pro_feature3',pro_feature4='$pro_feature4',pro_price='$pro_price',
                                                      pro_model='$pro_model', pro_warranty='$pro_warranty', pro_keyword='$pro_keyword'
                                                       where pro_id='$pro_id'");

            if($up_pro->execute()){
              echo "<script>alert('Product updated successfully');</script>";
              echo "<script>window.open('index.php?viewall_products','_self')</script>";
            }
          }
      }
    }

    function delete_product(){
      include("include/db.php");

      $delete_product_id=$_GET['delete_pro'];

      $delete_pro=$con->prepare("delete from products where pro_id='$delete_product_id '");
      if($delete_pro->execute()){
        echo "<script>alert('Product Deleted Successfully !!!');</script>";
        echo "<script>window.open('index.php?viewall_products','_self');</script>";
      }

    }
?>
