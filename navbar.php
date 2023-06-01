<header>
    <nav>
        <a href="index.php">Accueil</a>
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
    </nav>
</header>