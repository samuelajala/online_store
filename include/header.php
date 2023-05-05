<div id="header">
    <div id="logo">
      <a href="index.php"><img src="imgs/logo.png"/></a>
    </div><!--end of logo-->
    <div id="link">
      <ul>
        <li><a href="#">Download App</a></li>
        <li><a href="#">Signup</a>
          <form method="post" enctype="multipart/form-data">
            <table>
              <tr>
                <td>Enter Your Name</td>
                <td><input type="text" name="u_name" required="required"/></td>
              </tr>
              <tr>
                <td>Enter Your Email</td>
                <td><input type="email" name="u_email"  required="required"/></td>
              </tr>
              <tr>
                <td>Upload your Picture</td>
                <td><input type="file" name="u_img"  required="required" /></td>
              </tr>
              <tr>
                <td>Enter Your Address</td>
                <td><textarea name='u_add'  required="required"></textarea></td>
              </tr>
              <tr>
                <td>Enter Your Country</td>
                <td><input type="text" name="u_country"  required="required" /></td>
              </tr>
              <tr>
                <td>Enter Your State</td>
                <td><input type="text" name="u_state"  required="required"/></td>
              </tr>
              <tr>
                <td>Enter Your Pincode</td>
                <td><input type="text" name="u_pin"  required="required"/></td>
              </tr>
              <tr>
                <td>Enter Your DOB</td>
                <td><input type="date" name="u_date"  required="required"/></td>
              </tr>
              <tr>
                <td>Enter Your Phone No.</td>
                <td><input type="tel" name="u_phone"  required="required"/></td>
              </tr>
            </table>
            <center>
              <input type="submit" name="u_signup" value='signup' />
              <input type="reset" name="reset" value='reset' />
            </center>
          </form>
        </li>
        <li><a href="#">Login</a>
          <form style="margin-left: -585px"  method="post" >
            <table>
              <tr>
                <td>Enter Your Email</td>
                <td><input type="email" name="login_email" /></td>
              </tr>
              <tr>
                <td>Enter Your password</td>
                <td><input type="password" name="login_pass" /></td>
              </tr>
              <tr>
                <center>
                  <td>
                    <input type="submit" name="login_btn" value='Login'/>
                  </td>
                  <td>
                    <input type="button" name="for_pass" value="Forget Password ?" />
                  </td>
              </center>
            </tr>
            </table>
          </form>
        </li>
      </ul>
    </div><!--end of link-->
    <div id="search">
      <a href="cart.php"><button id="cart_btn">Cart <?php echo cat_count(); ?></button></a>
      <form method="get" action="search.php" enctype="multipart/form-data">
        <input type="text" name='user_query' placeholder="Search From Here...">
        <button id="search_btn" name='search'>Search</button>
    </form>

    </div><!--end of search-->
</div><!--end of header-->
