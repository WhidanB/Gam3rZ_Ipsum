<header>
    <nav>
        <a href="disconnect.php">déco</a>
        <a href="login.php">Login</a>
        <?php
        if (isset($_SESSION["user"])) {
            echo
            "<a href='backoffice.php'>Backoffice</a>";
        }
        ?>
    </nav>
</header>