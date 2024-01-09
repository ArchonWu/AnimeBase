<html>

<body>
    <h2> Insert Anime </h2>
    <hr />

    <form method="POST" action="insert.php">
        <!--refresh page when submitted-->
        <input type="hidden" id="insertAnimeRequest" name="insertAnimeRequest">
        Title : <input type="text" name="animeTitle"> <br /><br />
        Rating : <input type="text" name="rating"> <br /><br />
        Demographic: <input type="text" name="demographic"> <br /><br />

        <input type="submit" value="Insert" name="insertSubmit"></p>
    </form>

    <hr />

    <h2>Display the Tuples in Anime</h2>
    <form method="GET" action="insert.php">
        <!--refresh page when submitted-->
        <input type="hidden" id="displayAnimeTupleRequest" name="displayAnimeTupleRequest">
        <input type="submit" name="displayAnimeTuples"></p>
    </form>

    <hr />
    <hr />

    <h2> Insert Studio </h2>
    <hr />

    <form method="POST" action="insert.php">
        <!--refresh page when submitted-->
        <input type="hidden" id="insertStudioRequest" name="insertStudioRequest">
        Name : <input type="text" name="studioName"> <br /><br />
        Location : <input type="text" name="location"> <br /><br />
        Foudning Year: <input type="text" name="foundingYear"> <br /><br />

        <input type="submit" value="Insert" name="insertSubmit"></p>
    </form>

    <hr />

    <h2>Display the Tuples in Studio</h2>
    <form method="GET" action="insert.php">
        <!--refresh page when submitted-->
        <input type="hidden" id="displayStudioTupleRequest" name="displayStudioTupleRequest">
        <input type="submit" name="displayStudioTuples"></p>
    </form>

    <?php
    include("idk.php");
    $success = True;

    function handleInsertAnimeRequest()
    {
        global $db_conn;

        //Getting the values from user and insert data into the table
        $tuple = array(
            ":bind1" => $_POST['animeTitle'],
            ":bind2" => $_POST['rating'],
            ":bind3" => $_POST['demographic']
        );

        $alltuples = array(
            $tuple
        );

        executeBoundSQL("insert into Anime values (:bind1, :bind2, :bind3)", $alltuples);
        OCICommit($db_conn);
    }

    function handleInsertStudioRequest()
    {
        global $db_conn;

        //Getting the values from user and insert data into the table
        $tuple = array(
            ":bind1" => $_POST['studioName'],
            ":bind2" => $_POST['location'],
            ":bind3" => $_POST['foundingYear']
        );

        $alltuples = array(
            $tuple
        );

        executeBoundSQL("insert into Studio values (:bind1, :bind2, :bind3)", $alltuples);
        OCICommit($db_conn);
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
        if (array_key_exists('displayStudioTuples', $_GET)) {
            handleDisplayStudioRequest();
        }else
        if (array_key_exists('displayAnimeTuples', $_GET)) {
            handleDisplayAnimeRequest();
        }
        disconnectFromDB();
    }

    if (isset($_POST['insertSubmit'])) {
        if (connectToDB()) {
            if (array_key_exists('insertStudioRequest', $_POST)) {
                handleInsertStudioRequest();
                handleDisplayStudioRequest();
            } else
            if (array_key_exists('insertAnimeRequest', $_POST)) {
                handleInsertAnimeRequest();
                handleDisplayAnimeRequest();
            }
        }
        disconnectFromDB();
    }
    ?>

</body>

</html>
