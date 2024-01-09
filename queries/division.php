<html>

<body>
    <h2> Division </h2>
    <hr />

    <form method="POST" action="division.php">
        ~ Find Popular Genres (that are in all the Animes) ~
        <input type="submit" value="Go" name="divisionSubmit"></p>
    </form>

    <hr />

    <?php
    include("idk.php");

    function handleDisplayDivisionRequest()
    {
        $result = executePlainSQL("SELECT name FROM genre g WHERE NOT EXISTS ((SELECT a.title FROM anime a) MINUS (SELECT c.anime_title FROM category c WHERE c.genre_name=g.name))");
        echo "<table border='0'>
	    <tr>
	    <th>Genres that are in Every Anime</th>
	    </tr>";

        while (($row = oci_fetch_row($result)) != false) {
            echo "<tr>";
            echo "<td>" . $row[0] . "</td>";
            echo "</tr>";
        }
    }

    if (isset($_POST['divisionSubmit'])) {
        if (connectToDB()) {
            handleDisplayDivisionRequest();
        }
        disconnectFromDB();
    }
    ?>

</body>

</html>
