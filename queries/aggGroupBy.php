<html>

<body>
    <h2> Aggregation with Group By </h2>
    <hr />

    <form method="POST" action="aggGroupBy.php">
        ~ The Average Age of the Characters of Each Anime ~ 
        <input type="submit" value="Go" name="aggGroupBySubmit"></p>
    </form>

    <hr />

    <?php
    include("idk.php");

    // hmmmm: select type, avg(num_volumes) from sourceMaterialInfographics group by type;
    //        select anime_title, avg(age) from characters group by anime_title; 

    function handleDisplayAggGroupByRequest()
    {
        $result = executePlainSQL("SELECT anime_title, avg(age) FROM characters GROUP BY anime_title");

        echo "<table border='0'>
	    <tr>
	    <th>Anime Title</th>
	    <th>Average Age of Characters</th>
	    </tr>";

        while (($row = oci_fetch_row($result)) != false) {
            echo "<tr>";
            echo "<td>" . $row[0] . "</td>";
            echo "<td>" . round($row[1], 1) . "</td>";
            echo "</tr>";
        }
    }

    if (isset($_POST['aggGroupBySubmit'])) {
        if (connectToDB()) {
            handleDisplayAggGroupByRequest();
        }
        disconnectFromDB();
    }
    ?>

</body>

</html>
