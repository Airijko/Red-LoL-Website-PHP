<head>
    <link href="css/global.css" type="text/css" rel="stylesheet">
</head>

<nav class="navbar fixed-top navbar-expand-sm navbar-dark">
<div class="container-fluid">
  <a class="navbar-brand" href="./">
    <img src="https://imgs.search.brave.com/58-tsSnqGtxLnb5Zn4xoNUaBkj_ex1LOG1XrwbYYFEs/rs:fit:256:256:1/g:ce/aHR0cDovL2ltZzEu/d2lraWEubm9jb29r/aWUubmV0L19fY2Iy/MDE1MDQwMjIzNDM0/My9sZWFndWVvZmxl/Z2VuZHMvaW1hZ2Vz/LzEvMTIvTGVhZ3Vl/X29mX0xlZ2VuZHNf/SWNvbi5wbmc" width="40px" alt="Logo">
  </a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="./">
          Home
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./Champions">
          Champions
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./Posts">
          Posts
        </a>
      </li>
    </ul>
    <?php if (basename($_SERVER['SCRIPT_NAME']) != 'index.php') { ?>
      <form class="d-flex" role="search">
        <div class="input-group">
          <input class="form-control" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-light" type="submit" id="logobutton">
            <img src="images/logo.png" alt="logo" id="logo">
          </button>
        </div>
      </form>
    <?php } ?>
    <a class="login-btn btn btn-outline-light btn-danger" href="./Login">
      Login
    </a>
  </div>
</div>
</nav>