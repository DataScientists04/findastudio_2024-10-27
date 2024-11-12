<?php
session_start();
?>
<script src="/FindAStudio/js/jquery.min.js"></script>
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
    <!-- if successfully logged in message -->
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
    if(isset($_SESSION['username'])): ?>
      <div class="align-self-center">Welcome, <?php echo $_SESSION['First_Name']; ?></div>
    <?php endif; ?>

    <a class="nav-link d-inline-block align-self-center" id="dropdown-login-button">
      <?php
      if(isset($_SESSION['username'])): ?>
        <h1 class="bi-person-fill px-4"></h1>
      <?php else: ?>
      <h1 class="bi-person px-4"></h1>
      <?php endif; ?>
    </a>
      <div class="top-100 dropdown-menu dropdown-menu-dark dropdown-menu-end" style="display:none;">
        <form name="frm_userLogin" method="post" action="">
          <?php
          if(isset($_SESSION['username'])): ?>
            <div class="form-row text-center py-1">
              <a href="/FindAStudio/php/logoutUser.php" class="btn btn-primary">Logout</a>
            </div>
          <?php else: ?>
          <div class="form-row py-1">
            <input type="text" name="username" class="form-control w-50 mx-auto" id="inputUser" placeholder="E-Mail">
          </div>
          <div class="form-row py-1">
            <input type="password" name="password" class="form-control w-50 mx-auto" id="inputPassword4" placeholder="Password">
          </div>
          <div class="form-row text-center py-1">
            <button type="submit" name="submit" value="submit" class="btn btn-primary">Login</button>
          </div>
          <div class="form-row text-center pt-3">
            <label class="form-label border-top">Or create an account</label>
          </div>
          <div class="form-row text-center">
            <button class="btn btn-primary">Sign up</button>
          </div>
          <?php endif; ?>
        </form>
      </div>
  </div>
</div>
