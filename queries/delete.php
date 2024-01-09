<html>

<head>
    <h2> delete stuff </h2>
</head>

<body>
    <hr />

    <h2> delete anime </h2>
    <form method="POST" action="delete.php">
        <input type="hidden" id="deleteAnimeQueryRequest" name="deleteAnimeQueryRequest">
        anime title: <input type="text" name="deletedAnimeTitle"> <br /><br />
        <input type="submit" value="Delete" name="deleteSubmit"></p>
    </form>

    <hr />

    <h2>delete studio</h2>
    <form method="POST" action="delete.php">
        <input type="hidden" id="deleteStudioQueryRequest" name="deleteStudioQueryRequest">
        studio name: <input type="text" name="deletedStudioName"> <br /><br />
        <input type="submit" value="Delete" name="deleteSubmit"></p>
    </form>

    <hr />

    <h2>display results on various tables</h2>
    <form method="GET" action="delete.php">
        <input type="hidden" id="displayAnimeTupleRequest" name="displayAnimeTupleRequest">
        <input type="submit" value="ANIMES" name="displayAnimeTuples">
    </form>

    <form method="GET" action="delete.php">
        <input type="hidden" id="displayStudioTupleRequest" name="displayStudioTupleRequest">
        <input type="submit" value="STUDIOS" name="displayStudioTuples">
    </form>

    <form method="GET" action="delete.php">
        <input type="hidden" id="displaySourceTupleRequest" name="displaySourceTupleRequest">
        <input type="submit" value="SOURCE MATERIAL" name="displaySourceTuples"></p>
    </form>

    <?php
    include("idk.php");
    $success = True;

    function handleDeleteAnimeRequest()
    {
        global $db_conn;

        $input = $_POST['deletedAnimeTitle'];
        executePlainSQL("DELETE FROM Anime WHERE title='" . $input . "'");

        OCICommit($db_conn);
    }

    function handleDeleteStudioRequest()
    {
        global $db_conn;

        $input = $_POST['deletedStudioName'];
        executePlainSQL("DELETE FROM Studio WHERE name='" . $input . "'");

        OCICommit($db_conn);
    }

    function handleDisplaySourceRequest()
    {
        global $db_conn;

        $result = executePlainSQL("SELECT * FROM SourceMaterialInfographics");

        echo "<table border='0'>
  	    <tr>
  	    <th>Title</th>
  	    <th>Source Type</th>
        <th>Publisher</th>
        <th>Volumes</th>
        <th>Release Date</th>
        <th>Publisher</th>
        <th>Related anime</th>
  	    </tr>";

        while (($row = oci_fetch_row($result)) != false) {
            echo "<tr>";
            echo "<td>" . $row[0] . "</td>";
            echo "<td>" . $row[2] . "</td>";
            echo "<td>" . $row[3] . "</td>";
            echo "<td>" . $row[4] . "</td>";
            echo "<td>" . $row[5] . "</td>";
            echo "<td>" . $row[6] . "</td>";
            echo "</tr>";
        }
    }

    function handleDisplayStudioRequest()
    {
        global $db_conn;

        $result = executePlainSQL("SELECT * FROM Studio");

        echo "<table border='0'>
  	    <tr>
  	    <th>Name</th>
  	    <th>Location</th>
        <th>Founding Year</th>
  	    </tr>";

        while (($row = oci_fetch_row($result)) != false) {
            echo "<tr>";
            echo "<td>" . $row[0] . "</td>";
            echo "<td>" . $row[1] . "</td>";
            echo "<td>" . $row[2] . "</td>";
            echo "</tr>";
        }
    }

    function handleDisplayAnimeRequest()
    {
        global $db_conn;

        $result = executePlainSQL("SELECT * FROM Anime");

        echo "<table border='0'>
  	    <tr>
  	    <th>Title</th>
  	    <th>Rating</th>
        <th>Demographic</th>
  	    </tr>";

        while (($row = oci_fetch_row($result)) != false) {
            echo "<tr>";
            echo "<td>" . $row[0] . "</td>";
            echo "<td>" . $row[1] . "</td>";
            echo "<td>" . $row[2] . "</td>";
            echo "</tr>";
        }
    }


    if (connectToDB()) {
        if (array_key_exists('displayAnimeTuples', $_GET)) {
            handleDisplayAnimeRequest();
        } if (array_key_exists('displayStudioTuples', $_GET)) {
            handleDisplayStudioRequest();
        } if (array_key_exists('displaySourceTuples', $_GET)) {
            handleDisplaySourceRequest();
        }
        disconnectFromDB();
    }

    if (isset($_POST['deleteSubmit'])) {
        if (connectToDB()) {
            if (array_key_exists('deleteAnimeQueryRequest', $_POST)) {
                handleDeleteAnimeRequest();
            } if (array_key_exists('deleteStudioQueryRequest', $_POST)) {
                handleDeleteStudioRequest();
            }
        }
        disconnectFromDB();
    }
    ?>

</body>

</html>
