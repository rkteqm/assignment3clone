    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="home.php">Home</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    <?php
                    if (isset($_SESSION['id'])) {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="logout.php">Logout</a>
                        </li>
                        <li class="nav-item">
                            <?php
                            if (isset($_SESSION['admin'])) {
                            ?>
                                <a class="nav-link active" aria-current="page" href="users.php">Users</a>
                            <?php
                            } elseif (isset($_SESSION['client'])) {
                            ?>
                                <a class="nav-link active" aria-current="page" href="client.php">Users</a>
                            <?php
                            }
                        } else {
                            ?>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="login.php">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">Register</a>
                        </li>

                    <?php
                        }
                    ?>

                </ul>
            </div>
        </div>
    </nav>