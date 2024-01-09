<html>

<body>
  <!-- projection on Person table and its children; -->
    <h2> projection page: stuff related to characters</h2>
    <hr />

    <form method="GET" action="projection.php">
        <input type="hidden" id="projectionQueryRequest" name="projectionQueryRequest">

        <h4>anime</h4>
        <!-- anime_title: CAST -->
        <input type="checkbox" name="input[]" value="anime_title"> title </p>

        <h4>characters</h4>
        <!-- character_name: CAST. gender, role: CHARACTER -->
        <input type="checkbox" name="input[]" value="name"> name </p>
        <input type="checkbox" name="input[]" value="gender"> gender </p>
        <input type="checkbox" name="input[]" value="role"> role </p>

        <h4>crew</h4>
        <!-- voice_actor_ID: CAST. voice_actor_name - VoiceActor person_name -->
        <input type="checkbox" name="input[]" value="voice_actor_name"> name </p>

        <input type="submit" value="show me the PROJECTION WOOHOO"></p>
    </form>

    <?php
    include("idk.php");
    $success = True;

    function handleDisplayProjectionRequest()
    {
        global $db_conn;

        $request = $_GET['input'];
        $checkbox = ["VoiceActor va, Cast ca, Characters ch"];
        $requests = [];
        $titles = [];

        if (isset($_GET['input'])) {
            foreach ($request as $input) {
                if ($input == "voice_actor_name"){
                    array_push($requests, "va.person_name");
                    array_push($titles, "Voice Actor Name");
                } else if ($input == "anime_title"){
                    array_push($requests, "ca.anime_title");
                    array_push($titles, "Anime Title");
                } else if ($input == "name"){
                    array_push($requests, "ch.name");
                    array_push($titles, "Character Name");
                } else if ($input == "gender"){
                    array_push($requests, "ch.gender");
                    array_push($titles, "Character Gender");
                } else {
                    array_push($requests, "ch.role");
                    array_push($titles, "Character Role");
                }
            }

            $requests_result = implode(", ", $requests);
            $checkbox_result = implode(", ", $checkbox);

            $result = executePlainSQL("SELECT DISTINCT $requests_result
                                       FROM $checkbox_result
                                       WHERE va.id = ca.voice_actor_id AND ca.character_name = ch.name
                                       ORDER BY $requests[0]");
            OCICommit($db_conn);

        } else {
          echo "You didn't choose anything.";
        }

        echo "<table border='0'>
  	    <tr>
  	    <th>$titles[0]</th><th>$titles[1]</th><th>$titles[2]</th><th>$titles[3]</th><th>$titles[4]</th>
  	    </tr>";

        while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
            echo "<tr>";
            echo "<td>" . $row[0] . "</td>";
            echo "<td>" . $row[1] . "</td>";
            echo "<td>" . $row[2] . "</td>";
            echo "<td>" . $row[3] . "</td>";
            echo "<td>" . $row[4] . "</td>";
            echo "</tr>";
        }
    }

    if (connectToDB()) {
        if (array_key_exists('projectionQueryRequest', $_GET)) {
            handleDisplayProjectionRequest();
        }
        disconnectFromDB();
    }

    ?>

</body>

</html>
