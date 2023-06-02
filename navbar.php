<header>
    <nav>
        <a href="index.php">G@m3rZ Ipsum</a>
        <div>

            <?php

            if (!isset($_SESSION["user"])) {
                echo
                "<a href='login.php'>Login</a>";
            }
            if (isset($_SESSION["user"])) {
                echo
                "<a href='backoffice.php'>Backoffice</a>
    <a href='disconnect.php'>déco</a>";
            }
            ?>
        </div>
    </nav>
</header>