<?php

  function u_signup(){
      include("include/db.php");

      if(isset($_POST['u_signup'])){
        $u_name = $_POST['u_name'];
        $u_email = $_POST['u_email'];

        $u_img = $_FILES['u_img']['name'];
        $u_img_tmp = $_FILES['u_img']['tmp_name'];

        move_uploaded_file($u_img_tmp,"imgs/u_img/$u_img");

        $u_add = $_POST['u_add'];
        $u_country = $_POST['u_country'];
          $u_date = $_POST['u_date'];
        $u_state=$_POST['u_state'];
        $u_pin = $_POST['u_pin'];
        $u_date = $_POST['u_date'];
        $u_phone = $_POST['u_phone'];
        //HELPS TO GET A NEW PASSWORD FOR EACH REGISTRATION
        $u_pass=mt_rand();

        $add_user=$con->prepare("insert into user(u_name, u_email, u_img, u_add, u_country, u_state, u_pin, u_dob, u_phone, u_pass, u_reg_date)
        values('$u_name','$u_email','$u_img','$u_add','$u_country','$u_state','$u_pin','$u_date','$u_phone','$u_pass',NOW())");

        if ($add_user->execute()) {
          echo "<script>alert('Registration Successful, Check your Email we send your password there')</script>";
          echo "<scritp>window.open('index.php','_self');</script>";
        }
        else {
          echo "<script>alert('Registration failed, please try Again')</script>";

        }
      }
  }


  function getIp(){
    $ip = $_SERVER['REMOTE_ADDR'];

    if (!empty($_SERVER['HTTP_CLIENT_IP'])){
      $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
      $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    return $ip;
  }

  function add_cart(){
      include("include/db.php");
      if(isset($_POST['cart_btn'])){
        $pro_id=$_POST['pro_id'];
        $ip= getIp();

        $check_cart=$con->prepare("select * from cart where pro_id='$pro_id' AND ip_add='$ip'");
        $check_cart->execute();

        $row_check=$check_cart->rowCount();

        if($row_check==1){
              echo "<script>alert('This Product Already Added in Your cart'); </script>";
            }else {
            $add_cart=$con->prepare("insert into cart(pro_id,qty,ip_add)values('$pro_id','1','$ip')");

            if($add_cart->execute()){
              echo "<script> window.open('index.php','_self'); </script>";
            }else{
              echo "<script> alert('Try Again !!!'); </script>";
        }
      }
    }
  }

  function cat_count(){
    include("include/db.php");
    $ip=getIp();
    $get_cart_item=$con->prepare("select * from cart where ip_add='$ip'");
    $get_cart_item->execute();

    $count_cart=$get_cart_item->rowCount();
    echo $count_cart;
  }

  function cart_display(){
    include("include/db.php");
    $ip=getIp();
    $get_cart_item=$con->prepare("select * from cart where ip_add='$ip'");
    $get_cart_item->setFetchMode(PDO:: FETCH_ASSOC);
    $get_cart_item->execute();
    $cart_empty=$get_cart_item->rowCount();

    $net_total=0;
    if($cart_empty==0){
      echo "<center><h2>No Product Found in Cart <a href='index.php'>Countinue Shopping</a></h2><center>";
    }else {
      if(isset($_POST['up_qty'])){
        $quantity=$_POST['qty'];

        foreach ($quantity as $key => $value) {
          $update_qty=$con->prepare("update cart set qty='$value' where cart_id= $key");
          if($update_qty->execute()){
            echo "<script>window.open('cart.php','_self');</script>";
          }
        }
      }
      echo "
      <table cellpadding='0' cellspacing='0'>
      <tr>
        <th>Image</th>
        <th>Product Name</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Remove</th>
        <th>Sub Total</th>
      </tr>";
    while($row=$get_cart_item->fetch()):
      $pro_id=$row['pro_id'];

      $get_pro=$con->prepare("select * from products where pro_id='$pro_id'");
      $get_pro->setFetchMode(PDO::FETCH_ASSOC);
      $get_pro->execute();

      $row_pro=$get_pro->fetch();
      echo "<tr>
            <td><img src='imgs/pro_img/".$row_pro['pro_img1']."'/></td>
            <td>".$row_pro['pro_name']."</td>
            <td><input type='text' name='qty[".$row['cart_id']."]' value='".$row['qty']."'/>
            <input type='submit' name='up_qty' value='save' /></td>
            <td>".$row_pro['pro_price']."</td>
            <td><a href='delete.php?delete_id=".$row_pro['pro_id']."'>Delete</a></td>
            <td>";
            error_reporting(0);
              $qty = $row['qty'];
              $pro_price = $row_pro['pro_price'];
              $sub_total = $pro_price * $qty;
              echo $sub_total;
              $net_total=$net_total + $sub_total;
            echo"</td>
          </tr>";
    endwhile;

    echo "<tr>
      <td></td>
      <td><a href='index.php'><button id='buy_now'>continue shopping</button></a></td>
      <td><button id='buy_now'>Checkout</button></td>
      <td></td><td><b>Net Total = </b></td>
      <td><b>$net_total</b></td>
    </tr>";
  }
}
  function delete_cart_items(){
    include("include/db.php");
    if(isset($_GET['delete_id'])){
      $pro_id=$_GET['delete_id'];

      $delete_pro=$con->prepare("delete from cart where pro_id='$pro_id'");

      if($delete_pro->execute()){
        echo "<script>alert('Product Deleted Sucessfully')</script>";
        echo "<script>window.open('cart.php','_self')</script>";
      }
    }
  }
  function mtn(){
    include("include/db.php");

    $fetch_cat=$con->prepare("select * from main_cat where cat_id='20'");
    $fetch_cat->setFetchMode(PDO:: FETCH_ASSOC);
    $fetch_cat->execute();

    $row_cat=$fetch_cat->fetch();
    $cat_id=$row_cat['cat_id'];
    echo"<h3>".$row_cat['cat_name']."</h3>";

    $fetch_pro=$con->prepare("select * from products where cat_id='$cat_id' LIMIT 0,3");//DISPLAY FROM 0 TO 6
    $fetch_pro->setFetchMode(PDO::FETCH_ASSOC);
    $fetch_pro->execute();

    while($row_pro=$fetch_pro->fetch()):
      echo"<li>
            <form method='post' enctype='multipart/form-data'>
            <a href='pro_detail.php?pro_id=".$row_pro['pro_id']."'>
              <h4>".$row_pro['pro_name']."</h4>
              <img src='imgs/pro_img/".$row_pro['pro_img1']."'/>
              <center id='mycenter'>
                <a href='pro_detail.php?pro_id=".$row_pro['pro_id']."'><button id='pro_btn'>View</button></a>
                <input type='hidden' value='".$row_pro['pro_id']."' name='pro_id'/>
                <button id='pro_btn' name='cart_btn'>cart</button>
                <a href='pro_detail.php'><button id='pro_btn'>wishlist</button></a>
              </center>
            </a>
            </form>
          </li>";
    endwhile;
  }

  function glo(){
    include("include/db.php");

    $fetch_cat=$con->prepare("select * from main_cat where cat_id='21'");
    $fetch_cat->setFetchMode(PDO:: FETCH_ASSOC);
    $fetch_cat->execute();

    $row_cat=$fetch_cat->fetch();
    $cat_id=$row_cat['cat_id'];
    echo"<h3>".$row_cat['cat_name']."</h3>";

    $fetch_pro=$con->prepare("select * from products where cat_id='$cat_id' LIMIT 0,3");
    $fetch_pro->setFetchMode(PDO::FETCH_ASSOC);
    $fetch_pro->execute();

    while($row_pro=$fetch_pro->fetch()):
      echo"<li>
            <form method='post' enctype='multipart/form-data'>
            <a href='pro_detail.php?pro_id=".$row_pro['pro_id']."'>
              <h4>".$row_pro['pro_name']."</h4>
              <img src='imgs/pro_img/".$row_pro['pro_img1']."'/>
              <center id='mycenter'>
                <a href='pro_detail.php?pro_id=".$row_pro['pro_id']."'><button id='pro_btn'>View</button></a>
                <input type='hidden' value='".$row_pro['pro_id']."' name='pro_id'/>
                <button id='pro_btn' name='cart_btn'>cart</button>
                <a href='pro_detail.php'><button id='pro_btn'>wishlist</button></a>
              </center>
            </a>
            </form>
          </li>";
    endwhile;
  }

  function airtel(){
    include("include/db.php");

    $fetch_cat=$con->prepare("select * from main_cat where cat_id='22' ");
    $fetch_cat->setFetchMode(PDO:: FETCH_ASSOC);
    $fetch_cat->execute();

    $row_cat=$fetch_cat->fetch();
    $cat_id=$row_cat['cat_id'];
    echo"<h3>".$row_cat['cat_name']."</h3>";

    $fetch_pro=$con->prepare("select * from products where cat_id='$cat_id' LIMIT 0,3");
    $fetch_pro->setFetchMode(PDO::FETCH_ASSOC);
    $fetch_pro->execute();

    while($row_pro=$fetch_pro->fetch()):
      echo"<li>
          <form method='post' enctype='multipart/form-data'>
          <a href='pro_detail.php?pro_id=".$row_pro['pro_id']."'>
            <h4>".$row_pro['pro_name']."</h4>
            <img src='imgs/pro_img/".$row_pro['pro_img1']."'/>
            <center id='mycenter'>
              <a href='pro_detail.php?pro_id=".$row_pro['pro_id']."'><button id='pro_btn'>View</button></a>
              <input type='hidden' value='".$row_pro['pro_id']."' name='pro_id'/>
              <button id='pro_btn' name='cart_btn'>cart</button>
              <a href='pro_detail.php'><button id='pro_btn'>wishlist</button></a>
            </center>
          </a>
          </form>
        </li>";
    endwhile;
  }
  function etisalat(){
    include("include/db.php");

    $fetch_cat=$con->prepare("select * from main_cat where cat_id='24' ");
    $fetch_cat->setFetchMode(PDO:: FETCH_ASSOC);
    $fetch_cat->execute();

    $row_cat=$fetch_cat->fetch();
    $cat_id=$row_cat['cat_id'];
    echo"<h3>".$row_cat['cat_name']."</h3>";

    $fetch_pro=$con->prepare("select * from products where cat_id='$cat_id' LIMIT 0,3");
    $fetch_pro->setFetchMode(PDO::FETCH_ASSOC);
    $fetch_pro->execute();

    while($row_pro=$fetch_pro->fetch()):
      echo"<li>
        <form method='post' enctype='multipart/form-data'>
        <a href='pro_detail.php?pro_id=".$row_pro['pro_id']."'>
          <h4>".$row_pro['pro_name']."</h4>
          <img src='imgs/pro_img/".$row_pro['pro_img1']."'/>
          <center id='mycenter'>
            <a href='pro_detail.php?pro_id=".$row_pro['pro_id']."'><button id='pro_btn'>View</button></a>
            <input type='hidden' value='".$row_pro['pro_id']."' name='pro_id'/>
            <button id='pro_btn' name='cart_btn'>cart</button>
            <a href='pro_detail.php'><button id='pro_btn'>wishlist</button></a>
          </center>
        </a>
        </form>
      </li>";
    endwhile;
  }

  function pro_details(){
    include("include/db.php");

    if(isset($_GET['pro_id'])){
      $pro_id=$_GET['pro_id'];

      $pro_fetch=$con->prepare("select * from products where pro_id='$pro_id'");
      $pro_fetch->setFetchMode(PDO::FETCH_ASSOC);
      $pro_fetch->execute();

      $row_pro=$pro_fetch->fetch();
      $cat_id=$row_pro['cat_id'];

      echo "<div id='pro_img'>
            <img src='imgs/pro_img/".$row_pro['pro_img1']."'/>
            <ul>
              <li><img src='imgs/pro_img/".$row_pro['pro_img1']."'/></li>
              <li><img src='imgs/pro_img/".$row_pro['pro_img2']."'/></li>
              <li><img src='imgs/pro_img/".$row_pro['pro_img3']."'/></li>
              <li><img src='imgs/pro_img/".$row_pro['pro_img4']."'/></li>
            </ul>
            </div>
            <div id='pro_features'>
              <h3>".$row_pro['pro_name']."</h3>
              <ul>
                <li>".$row_pro['pro_feature1']."</li>
                <li>".$row_pro['pro_feature2']."</li>
                <li>".$row_pro['pro_feature3']."</li>
                <li>".$row_pro['pro_feature4']."</li>
              </ul>
              <ul>
                <li>Model No.: ".$row_pro['pro_model']."</li>
                <li>Warranty :".$row_pro['pro_warranty']."</li>
                <li>Keywords :".$row_pro['pro_keyword']."</li>
              </ul><br clear='all'/>
              <center>
                <h4>Selling Price : ".$row_pro['pro_price']."</h4>
                <form method='post'>
                  <input type='hidden' value='".$row_pro['pro_id']."' name='pro_id'/>
                  <button id='buy_now' name='buy_now'>BUY NOW</button>
                  <button id='buy_now' name='cart_btn'>Add To Cart</button>
                </form>
              </center>
            </div><br clear='all' />
            <div id='sim_pro'>
              <h3>Related products</h3>
              <ul>";//we close this echo because we want to write a loop
                echo add_cart();
                $sim_pro=$con->prepare("select * from products where pro_id!='$pro_id' AND cat_id='$cat_id' LIMIT 0,5");
                $sim_pro->setFetchMode(PDO:: FETCH_ASSOC);
                $sim_pro->execute();
                while($row=$sim_pro->fetch()):
                  echo"<li>
                        <a href='pro_detail.php?pro_id=".$row['pro_id']."'>
                          <img src='imgs/pro_img/".$row['pro_img1']."' />
                          <p>".$row['pro_name']."</p>
                          <p>Price : ".$row['pro_price']."</p>
                        </a>
                      </li>";
                endwhile;
              echo "</ul>
            </div>";

    }
  }

  function all_cat(){
    include("include/db.php");

    $all_cat=$con->prepare("select * from main_cat");
    $all_cat->setFetchMode(PDO:: FETCH_ASSOC);
    $all_cat->execute();

    while($row=$all_cat->fetch()):
      echo "<li><a href='cat_detail.php?cat_id=".$row['cat_id']."'>".$row['cat_name']."</a></li>";
    endwhile;
  }

  function cat_detail(){
    include("include/db.php");

    if(isset($_GET['cat_id'])){
      $cat_id=$_GET['cat_id'];
      $cat_pro=$con->prepare("select * from products where cat_id='$cat_id'");
      $cat_pro->setFetchMode(PDO:: FETCH_ASSOC);
      $cat_pro->execute();

      $cat_name=$con->prepare("select * from main_cat where cat_id='$cat_id'");
      $cat_name->setFetchMode(PDO:: FETCH_ASSOC);
      $cat_name->execute();

      $row=$cat_name->fetch();
      $row_main_cat=$row['cat_name'];
      echo"<h3>$row_main_cat</h3>";


      while($row_cat=$cat_pro->fetch()):
        echo"<li>
              <a href='pro_detail.php?pro_id=".$row_cat['pro_id']."'>
                <h4>".$row_cat['pro_name']."</h4>
                <img src='imgs/pro_img/".$row_cat['pro_img1']."'/>
                <center id='mycenter'>
                  <a href='pro_detail.php?pro_id=".$row_cat['pro_id']."'><button id='pro_btn'>View</button></a>
                  <a href='pro_detail.php'><button id='pro_btn'>cart</button></a>
                  <a href='pro_detail.php'><button id='pro_btn'>wishlist</button></a>
                </center>
              </a>
            </li>";
      endwhile;
    }
  }

  function viewall_sub_cat(){
    include("include/db.php");
    if(isset($_GET['cat_id'])){
      $cat_id=$_GET['cat_id'];
      $sub_cat=$con->prepare("select * from sub_cat where cat_id='$cat_id'");
      $sub_cat->setFetchMode(PDO:: FETCH_ASSOC);
      $sub_cat->execute();

      echo "<h3>Sub Categories</h3>";
      while($row=$sub_cat->fetch()):
         echo "<li><a href='cat_detail.php?sub_cat_id=".$row['sub_cat_id']."'>".$row['sub_cat_name']."</a></li>";
      endwhile;

    }
  }

  function sub_cat_detail(){
    include("include/db.php");

    if(isset($_GET['sub_cat_id'])){
      $sub_cat_id=$_GET['sub_cat_id'];
      $sub_cat_pro=$con->prepare("select * from products where sub_cat_id='$sub_cat_id'");
      $sub_cat_pro->setFetchMode(PDO:: FETCH_ASSOC);
      $sub_cat_pro->execute();

      $sub_cat_name=$con->prepare("select * from sub_cat where sub_cat_id='$sub_cat_id'");
      $sub_cat_name->setFetchMode(PDO:: FETCH_ASSOC);
      $sub_cat_name->execute();

      $row=$sub_cat_name->fetch();
      $row_sub_cat=$row['sub_cat_name'];
      echo"<h3>$row_sub_cat</h3>";

      while($row_sub_cat=$sub_cat_pro->fetch()):
        echo"<li>
              <a href='pro_detail.php?pro_id=".$row_sub_cat['pro_id']."'>
                <h4>".$row_sub_cat['pro_name']."</h4>
                <img src='imgs/pro_img/".$row_sub_cat['pro_img1']."'/>
                <center id='mycenter'>
                  <a href='pro_detail.php?pro_id=".$row_sub_cat['pro_id']."'><button id='pro_btn'>View</button></a>
                  <a href='pro_detail.php'><button id='pro_btn'>cart</button></a>
                  <a href='pro_detail.php'><button id='pro_btn'>wishlist</button></a>
                </center>
              </a>
            </li>";
      endwhile;
    }
  }
  function viewall_cat(){
    include("include/db.php");
    if(isset($_GET['sub_cat_id'])){
      $main_cat=$con->prepare("select * from main_cat");
      $main_cat->setFetchMode(PDO:: FETCH_ASSOC);
      $main_cat->execute();

      echo "<h3>Categories</h3>";
      while($row=$main_cat->fetch()):
         echo "<li><a href='cat_detail.php?cat_id=".$row['cat_id']."'>".$row['cat_name']."</a></li>";
      endwhile;

    }
  }

  function search(){
    include("include/db.php");
    if(isset($_GET['search'])){
    $user_query = $_GET['user_query'];

    $search =$con->prepare("select * from products where pro_name like '%$user_query%' or pro_keyword like '%$user_query%'");
    $search->setFetchMode(PDO::FETCH_ASSOC);
    $search->execute();

    echo"<div id='bodyleft'><ul>";
    if ($search->rowCount()==0) {
      echo "<h2>Product NOT Found with This Keyword</h2>";
    }else {
    while($row=$search->fetch()):
      echo"<li>
            <a href='pro_detail.php?pro_id=".$row['pro_id']."'>
              <h4>".$row['pro_name']."</h4>
              <img src='imgs/pro_img/".$row['pro_img1']."'/>
              <center id='mycenter'>
                <a href='pro_detail.php?pro_id=".$row['pro_id']."'><button id='pro_btn'>View</button></a>
                <button id='pro_btn' name='cart_btn'>cart</button>
                <a href='pro_detail.php'><button id='pro_btn'>wishlist</button></a>
              </center>
            </a>
          </li>";
    endwhile;
  }
    echo "</ul></div>";
  }
}
  function high_card(){
    include("include/db.php");
    if(isset($_GET['high_card'])){
      $fetch_pro=$con->prepare("select * from products where for_whom='high'");
      $fetch_pro->setFetchMode(PDO:: FETCH_ASSOC);
      $fetch_pro->execute();

      echo "<h3>High Cards Available</h3>";
      while($row_men=$fetch_pro->fetch()):
        echo"<li>
              <a href='pro_detail.php?pro_id=".$row_men['pro_id']."'>
                <h4>".$row_men['pro_name']."</h4>
                <img src='imgs/pro_img/".$row_men['pro_img1']."'/>
                <center id='mycenter'>
                  <a href='pro_detail.php?pro_id=".$row_men['pro_id']."'><button id='pro_btn'>View</button></a>
                  <a href='pro_detail.php'><button id='pro_btn'>cart</button></a>
                  <a href='pro_detail.php'><button id='pro_btn'>wishlist</button></a>
                </center>
              </a>
            </li>";
      endwhile;
    }
  }

  function medium_card(){
    include("include/db.php");
    if(isset($_GET['medium_card'])){
      $fetch_pro=$con->prepare("select * from products where for_whom='medium'");
      $fetch_pro->setFetchMode(PDO:: FETCH_ASSOC);
      $fetch_pro->execute();

      echo "<h3>Medium Cards Available</h3>";
      while($row_men=$fetch_pro->fetch()):
        echo"<li>
              <a href='pro_detail.php?pro_id=".$row_men['pro_id']."'>
                <h4>".$row_men['pro_name']."</h4>
                <img src='imgs/pro_img/".$row_men['pro_img1']."'/>
                <center id='mycenter'>
                  <a href='pro_detail.php?pro_id=".$row_men['pro_id']."'><button id='pro_btn'>View</button></a>
                  <a href='pro_detail.php'><button id='pro_btn'>cart</button></a>
                  <a href='pro_detail.php'><button id='pro_btn'>wishlist</button></a>
                </center>
              </a>
            </li>";
      endwhile;
    }
  }

  function low_card(){
    include("include/db.php");
    if(isset($_GET['low_card'])){
      $fetch_pro=$con->prepare("select * from products where for_whom='low'");
      $fetch_pro->setFetchMode(PDO:: FETCH_ASSOC);
      $fetch_pro->execute();

      echo "<h3>Low Cards Available</h3>";
      while($row_men=$fetch_pro->fetch()):
        echo"<li>
              <a href='pro_detail.php?pro_id=".$row_men['pro_id']."'>
                <h4>".$row_men['pro_name']."</h4>
                <img src='imgs/pro_img/".$row_men['pro_img1']."'/>
                <center id='mycenter'>
                  <a href='pro_detail.php?pro_id=".$row_men['pro_id']."'><button id='pro_btn'>View</button></a>
                  <a href='pro_detail.php'><button id='pro_btn'>cart</button></a>
                  <a href='pro_detail.php'><button id='pro_btn'>wishlist</button></a>
                </center>
              </a>
            </li>";
      endwhile;
    }
  }

  function all_about_high(){
    include("include/db.php");
    if(isset($_GET['mtn_high'])){
      $men_watch="mtn";

      $watch=$con->prepare("select * from products where for_whom='high' and pro_keyword like '%$men_watch%'");
      $watch->setFetchMode(PDO:: FETCH_ASSOC);
      $watch->execute();

      echo "<h3>Watches for Men</h3>";
      while($row_watch=$watch->fetch()):
        echo"<li>
              <a href='pro_detail.php?pro_id=".$row_watch['pro_id']."'>
                <h4>".$row_watch['pro_name']."</h4>
                <img src='imgs/pro_img/".$row_watch['pro_img1']."'/>
                <center id='mycenter'>
                  <a href='pro_detail.php?pro_id=".$row_watch['pro_id']."'><button id='pro_btn'>View</button></a>
                  <a href='pro_detail.php'><button id='pro_btn'>cart</button></a>
                  <a href='pro_detail.php'><button id='pro_btn'>wishlist</button></a>
                </center>
              </a>
            </li>";
      endwhile;
    }
    if(isset($_GET['glo_high'])){
      $men_watch="glo";

      $watch=$con->prepare("select * from products where for_whom='high' and pro_keyword like '%$men_watch%'");
      $watch->setFetchMode(PDO:: FETCH_ASSOC);
      $watch->execute();

      echo "<h3>Watches for Men</h3>";
      while($row_watch=$watch->fetch()):
        echo"<li>
              <a href='pro_detail.php?pro_id=".$row_watch['pro_id']."'>
                <h4>".$row_watch['pro_name']."</h4>
                <img src='imgs/pro_img/".$row_watch['pro_img1']."'/>
                <center id='mycenter'>
                  <a href='pro_detail.php?pro_id=".$row_watch['pro_id']."'><button id='pro_btn'>View</button></a>
                  <a href='pro_detail.php'><button id='pro_btn'>cart</button></a>
                  <a href='pro_detail.php'><button id='pro_btn'>wishlist</button></a>
                </center>
              </a>
            </li>";
      endwhile;
    }

    if(isset($_GET['airtel_high'])){
      $men_watch="aitel";

      $watch=$con->prepare("select * from products where for_whom='high' and pro_keyword like '%$men_watch%'");
      $watch->setFetchMode(PDO:: FETCH_ASSOC);
      $watch->execute();

      echo "<h3>Watches for Men</h3>";
      while($row_watch=$watch->fetch()):
        echo"<li>
              <a href='pro_detail.php?pro_id=".$row_watch['pro_id']."'>
                <h4>".$row_watch['pro_name']."</h4>
                <img src='imgs/pro_img/".$row_watch['pro_img1']."'/>
                <center id='mycenter'>
                  <a href='pro_detail.php?pro_id=".$row_watch['pro_id']."'><button id='pro_btn'>View</button></a>
                  <a href='pro_detail.php'><button id='pro_btn'>cart</button></a>
                  <a href='pro_detail.php'><button id='pro_btn'>wishlist</button></a>
                </center>
              </a>
            </li>";
      endwhile;
    }

    if(isset($_GET['etisalat_high'])){
      $men_watch="etisalat";

      $watch=$con->prepare("select * from products where for_whom='high' and pro_keyword like '%$men_watch%'");
      $watch->setFetchMode(PDO:: FETCH_ASSOC);
      $watch->execute();

      echo "<h3>Watches for Men</h3>";
      while($row_watch=$watch->fetch()):
        echo"<li>
              <a href='pro_detail.php?pro_id=".$row_watch['pro_id']."'>
                <h4>".$row_watch['pro_name']."</h4>
                <img src='imgs/pro_img/".$row_watch['pro_img1']."'/>
                <center id='mycenter'>
                  <a href='pro_detail.php?pro_id=".$row_watch['pro_id']."'><button id='pro_btn'>View</button></a>
                  <a href='pro_detail.php'><button id='pro_btn'>cart</button></a>
                  <a href='pro_detail.php'><button id='pro_btn'>wishlist</button></a>
                </center>
              </a>
            </li>";
      endwhile;
    }
  }

  function all_about_medium(){
    include("include/db.php");
    if(isset($_GET['mtn_medium'])){
      $men_watch="mtn";

      $watch=$con->prepare("select * from products where for_whom='medium' and pro_keyword like '%$men_watch%'");
      $watch->setFetchMode(PDO:: FETCH_ASSOC);
      $watch->execute();

      echo "<h3>Watches for Men</h3>";
      while($row_watch=$watch->fetch()):
        echo"<li>
              <a href='pro_detail.php?pro_id=".$row_watch['pro_id']."'>
                <h4>".$row_watch['pro_name']."</h4>
                <img src='imgs/pro_img/".$row_watch['pro_img1']."'/>
                <center id='mycenter'>
                  <a href='pro_detail.php?pro_id=".$row_watch['pro_id']."'><button id='pro_btn'>View</button></a>
                  <a href='pro_detail.php'><button id='pro_btn'>cart</button></a>
                  <a href='pro_detail.php'><button id='pro_btn'>wishlist</button></a>
                </center>
              </a>
            </li>";
      endwhile;
    }
    if(isset($_GET['glo_medium'])){
      $men_watch="glo";

      $watch=$con->prepare("select * from products where for_whom='medium' and pro_keyword like '%$men_watch%'");
      $watch->setFetchMode(PDO:: FETCH_ASSOC);
      $watch->execute();

      echo "<h3>Watches for Men</h3>";
      while($row_watch=$watch->fetch()):
        echo"<li>
              <a href='pro_detail.php?pro_id=".$row_watch['pro_id']."'>
                <h4>".$row_watch['pro_name']."</h4>
                <img src='imgs/pro_img/".$row_watch['pro_img1']."'/>
                <center id='mycenter'>
                  <a href='pro_detail.php?pro_id=".$row_watch['pro_id']."'><button id='pro_btn'>View</button></a>
                  <a href='pro_detail.php'><button id='pro_btn'>cart</button></a>
                  <a href='pro_detail.php'><button id='pro_btn'>wishlist</button></a>
                </center>
              </a>
            </li>";
      endwhile;
    }

    if(isset($_GET['airtel_medium'])){
      $men_watch="aitel";

      $watch=$con->prepare("select * from products where for_whom='medium' and pro_keyword like '%$men_watch%'");
      $watch->setFetchMode(PDO:: FETCH_ASSOC);
      $watch->execute();

      echo "<h3>Watches for Men</h3>";
      while($row_watch=$watch->fetch()):
        echo"<li>
              <a href='pro_detail.php?pro_id=".$row_watch['pro_id']."'>
                <h4>".$row_watch['pro_name']."</h4>
                <img src='imgs/pro_img/".$row_watch['pro_img1']."'/>
                <center id='mycenter'>
                  <a href='pro_detail.php?pro_id=".$row_watch['pro_id']."'><button id='pro_btn'>View</button></a>
                  <a href='pro_detail.php'><button id='pro_btn'>cart</button></a>
                  <a href='pro_detail.php'><button id='pro_btn'>wishlist</button></a>
                </center>
              </a>
            </li>";
      endwhile;
    }

    if(isset($_GET['etisalat_medium'])){
      $men_watch="etisalat";

      $watch=$con->prepare("select * from products where for_whom='medium' and pro_keyword like '%$men_watch%'");
      $watch->setFetchMode(PDO:: FETCH_ASSOC);
      $watch->execute();

      echo "<h3>Watches for Men</h3>";
      while($row_watch=$watch->fetch()):
        echo"<li>
              <a href='pro_detail.php?pro_id=".$row_watch['pro_id']."'>
                <h4>".$row_watch['pro_name']."</h4>
                <img src='imgs/pro_img/".$row_watch['pro_img1']."'/>
                <center id='mycenter'>
                  <a href='pro_detail.php?pro_id=".$row_watch['pro_id']."'><button id='pro_btn'>View</button></a>
                  <a href='pro_detail.php'><button id='pro_btn'>cart</button></a>
                  <a href='pro_detail.php'><button id='pro_btn'>wishlist</button></a>
                </center>
              </a>
            </li>";
      endwhile;
    }
  }


    function all_about_low(){
      include("include/db.php");
      if(isset($_GET['mtn_low'])){
        $men_watch="mtn";

        $watch=$con->prepare("select * from products where for_whom='low' and pro_keyword like '%$men_watch%'");
        $watch->setFetchMode(PDO:: FETCH_ASSOC);
        $watch->execute();

        echo "<h3>Watches for Men</h3>";
        while($row_watch=$watch->fetch()):
          echo"<li>
                <a href='pro_detail.php?pro_id=".$row_watch['pro_id']."'>
                  <h4>".$row_watch['pro_name']."</h4>
                  <img src='imgs/pro_img/".$row_watch['pro_img1']."'/>
                  <center id='mycenter'>
                    <a href='pro_detail.php?pro_id=".$row_watch['pro_id']."'><button id='pro_btn'>View</button></a>
                    <a href='pro_detail.php'><button id='pro_btn'>cart</button></a>
                    <a href='pro_detail.php'><button id='pro_btn'>wishlist</button></a>
                  </center>
                </a>
              </li>";
        endwhile;
      }
      if(isset($_GET['glo_low'])){
        $men_watch="glo";

        $watch=$con->prepare("select * from products where for_whom='low' and pro_keyword like '%$men_watch%'");
        $watch->setFetchMode(PDO:: FETCH_ASSOC);
        $watch->execute();

        echo "<h3>Watches for Men</h3>";
        while($row_watch=$watch->fetch()):
          echo"<li>
                <a href='pro_detail.php?pro_id=".$row_watch['pro_id']."'>
                  <h4>".$row_watch['pro_name']."</h4>
                  <img src='imgs/pro_img/".$row_watch['pro_img1']."'/>
                  <center id='mycenter'>
                    <a href='pro_detail.php?pro_id=".$row_watch['pro_id']."'><button id='pro_btn'>View</button></a>
                    <a href='pro_detail.php'><button id='pro_btn'>cart</button></a>
                    <a href='pro_detail.php'><button id='pro_btn'>wishlist</button></a>
                  </center>
                </a>
              </li>";
        endwhile;
      }

      if(isset($_GET['airtel_low'])){
        $men_watch="aitel";

        $watch=$con->prepare("select * from products where for_whom='low' and pro_keyword like '%$men_watch%'");
        $watch->setFetchMode(PDO:: FETCH_ASSOC);
        $watch->execute();

        echo "<h3>Watches for Men</h3>";
        while($row_watch=$watch->fetch()):
          echo"<li>
                <a href='pro_detail.php?pro_id=".$row_watch['pro_id']."'>
                  <h4>".$row_watch['pro_name']."</h4>
                  <img src='imgs/pro_img/".$row_watch['pro_img1']."'/>
                  <center id='mycenter'>
                    <a href='pro_detail.php?pro_id=".$row_watch['pro_id']."'><button id='pro_btn'>View</button></a>
                    <a href='pro_detail.php'><button id='pro_btn'>cart</button></a>
                    <a href='pro_detail.php'><button id='pro_btn'>wishlist</button></a>
                  </center>
                </a>
              </li>";
        endwhile;
      }

      if(isset($_GET['etisalat_low'])){
        $men_watch="etisalat";

        $watch=$con->prepare("select * from products where for_whom='low' and pro_keyword like '%$men_watch%'");
        $watch->setFetchMode(PDO:: FETCH_ASSOC);
        $watch->execute();

        echo "<h3>Watches for Men</h3>";
        while($row_watch=$watch->fetch()):
          echo"<li>
                <a href='pro_detail.php?pro_id=".$row_watch['pro_id']."'>
                  <h4>".$row_watch['pro_name']."</h4>
                  <img src='imgs/pro_img/".$row_watch['pro_img1']."'/>
                  <center id='mycenter'>
                    <a href='pro_detail.php?pro_id=".$row_watch['pro_id']."'><button id='pro_btn'>View</button></a>
                    <a href='pro_detail.php'><button id='pro_btn'>cart</button></a>
                    <a href='pro_detail.php'><button id='pro_btn'>wishlist</button></a>
                  </center>
                </a>
              </li>";
        endwhile;
      }
    }


?>
