<?php
session_start();
?>
<script>
if (typeof jQuery === 'undefined') { // Only load jquery if it's not already included. Leads to issues otherwise.
  document.write('<script src="/FindAStudio/js/jquery.min.js"><\/script>'); // Extra backslash to escape end tag
}
</script>
<script src="/FindAStudio/js/seeMore.js"></script>

<div class="row navbar">
  <div class="col-4">
    <nav class="navbar-expand-md">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
        <span class="navbar-dark navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarContent">
        <div class="navbar-nav px-3">
          <a class="nav-item nav-link" href="/FindAStudio/#studios_anchor">Studios</a>
          <a class="nav-item nav-link" href="/FindAStudio/#map_anchor">Map</a>
          <a class="nav-item nav-link" href="/FindAStudio/#reviews_anchor">Reviews</a>
        </div>
      </div>
    </nav>
  </div>
  <div class="col-4 text-center align-self-center">
    <a class="nav-link d-inline-block py-3" href="/FindAStudio" title="Home"><h1>Find A Studio</h1></a>
  </div>
  <div class="col-4 d-flex justify-content-end align-self-center">
    <!-- if successfully logged in or signed up message -->
    <div class="px-5">
      <?php if(isset($_SESSION['logged_in'])): ?>
      <div class="alert alert-success" role="alert">
          <?php
          echo $_SESSION['logged_in'];
          unset($_SESSION['logged_in']);
          ?>
      </div>
      <?php endif; ?>
      <!-- if login error message -->
      <?php if(isset($_SESSION['error'])): ?>
      <div class="alert alert-danger" role="alert">
          <?php
          echo $_SESSION['error'];
          unset($_SESSION['error']);
          ?>
      </div>
      <?php endif; ?>
      <!-- if successfully logged out message -->
      <?php if(isset($_SESSION['logged_out'])): ?>
      <div class="alert alert-info" role="alert">
          <?php
          echo $_SESSION['logged_out'];
          unset($_SESSION['logged_out']);
          ?>
      </div>
      <?php endif; ?>
    </div>
    <!-- if user is alreaady logged in -->
    <?php
    if(isset($_SESSION['Email'])): ?>
      <div class="align-self-center">Welcome, <?php echo $_SESSION['First_Name']; ?></div>
    <?php endif; ?>

    <a class="nav-link d-inline-block align-self-center" id="dropdown-login-button">
      <?php
      if(isset($_SESSION['Email'])): ?>
        <h1 class="bi-person-fill px-4"></h1>
      <?php else: ?>
      <h1 class="bi-person px-4"></h1>
      <?php endif; ?>
    </a>
      <div class="top-100 dropdown-menu dropdown-menu-dark dropdown-menu-end" style="display:none;">
        <form name="frm_userLogin" method="post" action="/FindAStudio/php/loginUser.php">
          <?php
          if(isset($_SESSION['Email'])): ?>
            <div class="text-center py-1">
              <a href="/FindAStudio/php/logoutUser.php" class="btn btn-primary">Logout</a>
            </div>
          <?php else: ?>
          <div class="py-1">
            <input type="text" name="Email" class="form-control w-50 mx-auto" placeholder="E-Mail">
          </div>
          <div class="py-1">
            <input type="password" name="User_Password" class="form-control w-50 mx-auto"placeholder="Password">
          </div>
          <div class="text-center py-1">
            <button type="submit" name="submit" value="submit" class="btn btn-primary">Login</button>
          </div>
          <div class="text-center pt-3 py-1">
            <label class="label border-top">Or create an account</label>
          </div>
          <div class="text-center p-y1">
            <a href="/FindAStudio/pages/SignUp.php" class="btn btn-primary">Sign up</a>
          </div>
          <?php endif; ?>
        </form>
      </div>
  </div>
</div>