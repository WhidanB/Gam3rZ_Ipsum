<?php
require("connect.php");

if (isset($_POST["search"]) && !empty($_POST["search"])) {

    header("Location: recherche.php?search=" . $_POST["search"]);
}
require("close.php");
?>





<header>
    <nav>
        <a class="logo" href="index.php">G@m3rZ Ipsum</a>
        <form method="post">
            <div class="search_bar">
                <svg width="30" height="30" fill="none" stroke="#2b2b2b" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M11 3a8 8 0 1 0 0 16 8 8 0 1 0 0-16z"></path>
                    <path d="m21 21-4.35-4.35"></path>
                </svg>
                <input type="text" class="search" name="search">
            </div>
        </form>
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