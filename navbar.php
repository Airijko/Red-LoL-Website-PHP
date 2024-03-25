<nav class="navbar fixed-top navbar-expand-sm navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="./">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2a/LoL_icon.svg/2048px-LoL_icon.svg.png" width="40" alt="Logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
                <li class="nav-item">
                    <a class="nav-link" href="./Reviews">
                        Reviews
                    </a>
                </li>
            </ul>
            <?php if (isset($_SESSION["username"]) && $_SESSION["username"] === 'admin' && basename($_SERVER['SCRIPT_NAME']) == 'reviews.php') { ?>
            <a class="manage-btn btn btn-secondary btn-outline-light" href="./ManageFeedback" role="button">
                Manage
            </a>
            <?php } ?>
            <?php if (basename($_SERVER['SCRIPT_NAME']) != 'index.php') { ?>
            <form class="d-flex m-0" role="search" action="./" method="post">
                <input type="hidden" name="formType" value="navsearch">
                <div class="input-group">
                    <input class="form-control" type="search" name="searchProfile" placeholder="Search"
                        aria-label="Search">
                    <button class="btn btn-outline-light" type="submit" id="navlogobutton">
                        <img src="images/logo.png" alt="logo" id="navlogo">
                    </button>
                </div>
            </form>
            <?php } ?>
            <?php if (isset($_SESSION["username"])) { ?>
            <a class="login-btn btn btn-outline-light" href="./backend/logout.php" role="button">
                Logout
            </a>
            <?php } else { ?>
            <a class="login-btn btn btn-outline-light" data-bs-toggle="modal" href="#toggleLoginModal"
                role="button">
                Login
            </a>
            <?php } ?>
        </div>
    </div>
</nav>