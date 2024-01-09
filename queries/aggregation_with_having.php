<html>

<head>
    <h2> aggregation </h2>
</head>

<body>
    <hr />

    <h4> query: find the info of the source material with the lowest number of source material volumes, for each source type that has a source material with at least (10) volumes </h4>

    <form method="GET" action="aggregation_with_having.php">
      <input type="hidden" id="aggregationQueryRequest" name="aggregationQueryRequest">
        <input type="submit" value="HAVING" name="aggregationSubmit"></p>
    </form>

    <?php
    include("idk.php");
    $success = True;

    function handleDisplayRequest()
    {
        global $db_conn;

        $result = executePlainSQL("SELECT title, MIN(num_volumes), release_date
                                   FROM SourceMaterialInfographics
                                   WHERE num_volumes > 10
                                   GROUP BY title, release_date
                                   HAVING release_date > 2000");

        echo "<table border='0'>
  	    <tr>
  	    <th>Title</th>
  	    <th>Number of Volumes</th>
        <th>Year Released</th>
  	    </tr>";

        while (($row = oci_fetch_row($result)) != false) {
            echo "<tr>";
            echo "<td>" . $row[0] . "</td>";
            echo "<td>" . $row[1] . "</td>";
            echo "<td>" . $row[2] . "</td>";
            echo "</tr>";
        }
    }

    if (isset($_GET['aggregationSubmit'])) {
      if (connectToDB()) {
          if (array_key_exists('aggregationQueryRequest', $_GET)) {
              handleDisplayRequest();
          }
          disconnectFromDB();
      }
    }

    ?>

</body>

</html>
