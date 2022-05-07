<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styling/styleSetup.css" />
    <link rel="stylesheet" href="styling/signStyle.css" />
    <title>Abstrakt - Login/Register</title>
  </head>
  <body>
    <div class="global-container">

      <!--Navigation Bar-->
      <header>
        <a href="index.php">
          <img
            src="images/logo/AbstraktLogo.png"
            alt="Abstrakt Logo"
            width="200px"
            class="site-icon disabled-pointer"
            style="z-index: 1"
        /></a>
        <nav>
          <a href="index.php">Home</a>
          <a href="events.php">Events</a>
        </nav>
        <a href="sign.php" class="sign">Login/Register</a>
      </header>

      <!--Register Block-->
      <div class="div1">
        <h2 class="abstrakt-marking disabled-pointer">ABSTRAKT</h2>
        <div class="register-box" id="reg" style="display: block">
          <form
            action="processPage/register.php"
            method="POST"
            onsubmit="return checkPass()"
          >
            <section>
              <h6 class="text-box">Register</h6>
              <div class="form-wrap">
                <div class="form-box">
                  <img src="images/icon/Profile.png" class="disabled-pointer" />
                  <input
                    type="text"
                    name="username"
                    id="checkExist"
                    placeholder="Username"
                    title="Username should be unique and be between 6 to 30 characters. Usernames can't be changed later."
                    minlength="6"
                    maxlength="30"
                    size="30"
                    required
                  />
                </div>
                <div class="form-box">
                  <img src="images/icon/Mail.png" class="disabled-pointer" />
                  <input
                    type="email"
                    name="email"
                    placeholder="abc123@email.com"
                    title="Please insert a valid email."
                    minlength="3"
                    maxlength="320"
                    size="320"
                    required
                  />
                </div>
                <div class="form-box">
                  <img
                    src="images/icon/Password.png"
                    class="disabled-pointer"
                  />
                  <input
                    type="password"
                    name="pwd"
                    id="pwd1"
                    placeholder="Your Password"
                    title="Password should be between 8 to 30 characters."
                    minlength="8"
                    maxlength="30"
                    size="30"
                    required
                  />
                </div>
                <div class="form-box">
                  <img
                    src="images/icon/Password.png"
                    class="disabled-pointer"
                  />
                  <input
                    type="password"
                    id="pwd2"
                    placeholder="Confirm Password"
                    title="Confirm your password. Password should be between 8 to 30 characters."
                    minlength="8"
                    maxlength="30"
                    size="30"
                    required
                  />
                </div>
                
                <div class="two-column">
                  <div class="form-box phone-box">
                    <img src="images/icon/Phone.png" class="disabled-pointer" />
                    <input
                      type="tel" 
                      name="phone"
                      placeholder="Phone" 
                      title="Enter your phone number."
                      minlength="7"
                      maxlength="11"
                      size="11"
                      pattern="[0-9]*"
                      oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" 
                    />
                  </div>
                  <div class="form-box age-box">
                    Age
                    <select name="age">
                      <option value="18">18</option>
                      <option value="19">19</option>
                      <option value="20">20</option>
                      <option value="21">21</option>
                      <option value="22">22</option>
                      <option value="23">23</option>
                      <option value="24">24</option>
                      <option value="25">25</option>
                      <option value="26">26</option>
                      <option value="27">27</option>
                      <option value="28">28</option>
                      <option value="29">29</option>
                      <option value="30">30</option>
                    </select>
                  </div>
                </div>
                <div class="submit-box">
                  <!-- Submit Register -->
                  <input
                    type="submit"
                    value="Sign Up"
                    onclick="return checkPass()"
                  />
                </div>

                <div class="bottom">
                  <a onclick="myFunction()">
                    <span class="bottom-text"
                      >Already have an account ?
                      <span class="gradient-text">Log In Now</span></span
                    >
                  </a>
                </div>
              </div>
            </section>
          </form>
        </div>

        <!--Login Block-->
        <div class="login-box" id="log" style="display: block">
          <form
            name="signForm"
            action="processPage/login.php"
            method="POST"
            onsubmit="return checkLogin()"
          >
            <section>
              <h6 class="text-box">Login</h6>
              <div class="form-wrap">
                <div class="form-box">
                  <img src="images/icon/Mail.png" class="disabled-pointer" />
                  <input
                    type="text"
                    name="username"
                    placeholder="Username"
                    title="Enter your username"
                    minlength="3"
                    maxlength="320"
                    size="320"
                    required
                  />
                </div>
                <div class="form-box">
                  <img
                    src="images/icon/Password.png"
                    class="disabled-pointer"
                  />
                  <input
                    type="password"
                    name="pwd"
                    placeholder="Your Password"
                    title="Password should be between 8 to 30 characters"
                    minlength="8"
                    maxlength="30"
                    size="30"
                    required
                  />
                </div>
                <div class="form-box submit-box">
                  <input type="submit" value="Log In" class="submit-button" />
                </div>
                <div class="bottom">
                  <a onclick="myFunction()">
                    <span class="bottom-text"
                      >Dont have an account?
                      <span class="gradient-text">Sign Up Now</span></span
                    >
                  </a>
                </div>
              </div>
            </section>
          </form>
        </div>
      </div>
    </div>
    <script>
      function myFunction() {
        var log = document.getElementById("log");
        var reg = document.getElementById("reg");
        if (log.style.display === "block") {
          log.style.display = "none";
          reg.style.display = "block";
        } else {
          log.style.display = "block";
          reg.style.display = "none";
        }
      }

      function checkPass() {
        // password match check
        if (
          document.getElementById("pwd1").value !=
          document.getElementById("pwd2").value
        ) {
          alert("Password and Confirmed Password are not the same");
          return false;
        } else return true;
      }

    </script>
  </body>
</html>
