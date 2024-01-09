<html>
    <head>
        <title>CPSC 304 Project: Anime Database</title>
    </head>

    <link href="https://fonts.googleapis.com/css2?family=Exo:wght@400;600;800;900&display=swap" rel="stylesheet">

    <style>

        body {

            background-image: url("https://images.hdqwalls.com/wallpapers/anime-night-scenery-8r.jpg");

            font-family: 'Exo';
            font-size: 14.5px;
            font-weight: bolder;
            color: white;

            display: grid;
            grid-template-columns: 1fr 1fr 1fr 2fr;
            gap: 15px;
            margin: 15px;

        }

        th {
            text-align: left;
        }

        h3 {
            text-transform: uppercase;
            text-align: center;
            font-size: 25px;
            letter-spacing: 2px;
            color: black;
            background: white;
            clip-path: polygon(25% 0%, 100% 0%, 75% 100%, 0% 100%);
        }

        .align {

            display: flex;
            align-items: center;

        }

        .align form {

            margin: 2px;

        }


    </style>

    <body>

        <div>

            <h3>Anime Database</h3>
            <p>If you wish to reset the table press on the reset button. If this is the first time you're running this page, you MUST use reset</p>

            <!-- BUTTONS -->
            <div class = "align">
                <!-- clear all tables-->
                <form method="POST" action="anime-db-final.php">
                    <input type="hidden" id="resetTablesRequest" name="resetTablesRequest">
                    <p><input type="submit" value="Reset" name="reset"></p>
                </form>

                <!-- count tuples in anime-->
                <form method="GET" action="anime-db-final.php">
                    <input type="hidden" id="countTupleRequest" name="countTupleRequest">
                    <p><input type="submit" value="Count Animes" name="countTuples"></p>
                </form>

                <!-- display tuples in anime-->
                <form method="GET" action="anime-db-final.php">
                    <input type="hidden" id="displayTupleRequest" name="displayTupleRequest">
                    <p><input type="submit" value="Display Animes" name="displayTuples"></p>
                </form>

                <!-- display tuples in studio -->
                <form method="GET" action="anime-db-final.php">
                    <input type="hidden" id="displayStudiosRequest" name="displayStudiosRequest">
                    <p><input type="submit" value="Display Studios" name="displayStudios"></p>
                </form>

                
                </div>
            
                <div class = "align">

                <!-- display tuples in source material FOR TESTING DELETE-->
                <form method="GET" action="anime-db-final.php">
                    <input type="hidden" id="displaySourceRequest" name="displaySourceRequest">
                    <p><input type="submit" value="Display Source Material" name="displaySource"></p>
                </form>

                <!-- display tuples in source material FOR TESTING DELETE-->
                <form method="GET" action="anime-db-final.php">
                    <input type="hidden" id="displayCharactersRequest" name="displayCharactersRequest">
                    <p><input type="submit" value="Display Characters" name="displayCharacters"></p>
                </form>

            </div>

            <h2> Insert New Studio </h2>
            <hr />

            <form method="POST" action="anime-db-final.php">
                <input type="hidden" id="insertStudioRequest" name="insertStudioRequest">
                Studio Name : <input type="text" name="insStudioName"> <br /><br />
                Location : <input type="text" name="insLocation"> <br /><br />
                Founding Year: <input type="text" name="insFoundingYear"> <br /><br />
                <input type="submit" value="Insert Studio" name="insertStudioSubmit"></p>
            </form>

            <hr />

            <h2>Insert New Anime</h2>
            <p>*Studio being specified must already exist in the database! If not please insert it first.</p>
            <form method="POST" action="anime-db-final.php">
                <input type="hidden" id="insertAnimeRequest" name="insertAnimeRequest">
                Anime Title: <input type="text" name="insTitle"> <br /><br />
                Rating: <input type="text" name="insRating"> <br /><br />
                Demographic: <input type="text" name="insDemo"> <br /><br />
                Studio*: <input type="text" name="insStudio"> <br /><br />
                Release Date: <input type="text" placeholder='e.g. January 1 2021' name="insRelDate"> <br /><br />
                <input type="submit" value="Insert Anime" name="insertAnimeSubmit"></p>
            </form>

            <hr />

            <h2> Remove Anime or Studio </h2>
            <form method="POST" action="anime-db-final.php">
                <input type="hidden" id="deleteStudioRequest" name="deleteStudioRequest">
                Studio Name: <input type="text" name="delStudio">
                <input type="submit" value="Delete Studio" name="deleteStudioSubmit"></p>
            </form>
            <form method="POST" action="anime-db-final.php">
                <input type="hidden" id="deleteAnimeRequest" name="deleteAnimeRequest">
                Anime Title: <input type="text" name="delAnime">
                <input type="submit" value="Delete Anime" name="deleteAnimeSubmit"></p>
            </form>

        </div>

        <div>

            <h2>Update Anime Info</h2>
            <p>Enter anime title and the information you would like to update. Anime title is REQUIRED and CASE-SENSITIVE!</p>

            <form method="POST" action="anime-db-final.php">
                <input type="hidden" id="updateQueryRequest" name="updateQueryRequest">
                Anime Title: <input type="text" name="animeTitle"> <br /><br />
                New Rating: <input type="text" name="newRating"> <br /><br />
                New Demographic: <input type="text" name="newDemo"> <br /><br />

                <input type="submit" value="Update" name="updateSubmit"></p>
            </form>

            <hr />

            <h2>Search</h2>
            <form method="POST" action="anime-db-final.php">
                Table:
                <select name="targetTable" id="targetTable">
                    <option value="">...</option>
                    <option value="Anime">Anime</option>
                    <option value="VoiceActor">Voice Actor</option>
                    <option value="Studio">Studio</option>
                </select> <br> <br>

                <div id="animeDiv" style="display:none">
                    Title: <input type="text" name="targetAnimeTitle" placeholder="Enter keyword"> <br><br>

                    Rating:
                    <select name="animeRatingOperand" id="animeRatingOperand">
                        <option value="<"><</option>
                        <option value="=">=</option>
                        <option value=">">></option>
                    </select>
                    <input name="targetAnimeRating" placeholder="Enter number 0 - 9.9"> <br> <br>

                    Demographic: <input type="text" name="targetAnimeDemographic"> <br><br>
                </div>

                <div id="voiceActorDiv" style="display:none">

                    ID: <input type="text" name="targetVAID" placeholder="Enter number"> <br><br>

                    Name: <input type="text" name="targetVAName" placeholder="Enter keyword"> <br><br>

                    Language: <input type="text" name="targetVALanguage"> <br><br>

                </div>

                <div id="studioDiv" style="display:none">

                    Name: <input type="text" name="targetStudioName" placeholder="Enter keyword"> <br><br>

                    Location: <input type="text" name="targetStudioLocation" placeholder="Enter keyword"> <br><br>

                    Founding Year:
                    <select name="targetStudioFoundingYearOperand" id="targetStudioFoundingYearOperand">
                        <option value="<"><</option>
                        <option value="=">=</option>
                        <option value=">">></option>
                    </select>
                    <input name="targetStudioFoundingYear" placeholder="Enter number"> <br> <br>
                </div>


                <input type="hidden" id="displaySelectAnimeTupleRequest" name="displaySelectAnimeTupleRequest">
                <input type="submit" name="displaySelectAnimeTuplesSubmit"></p>
            </form>

            <script>
                var elementTable = document.getElementById("targetTable");
                var elementDivAnime = document.getElementById("animeDiv");
                var elementDivVoiceActor = document.getElementById("voiceActorDiv");
                var elementDivStudio = document.getElementById("studioDiv");
                elementTable.onchange = function() {
                    elementDivAnime.style.display = this.value == "Anime" ? "block" : "none";
                    elementDivVoiceActor.style.display = this.value == "VoiceActor" ? "block" : "none";
                    elementDivStudio.style.display = this.value == "Studio" ? "block" : "none";
                }
            </script>

            <hr />

            <h2>Projection</h2>

            <form method="GET" action="anime-db-final.php">
                <input type="hidden" id="projectionQueryRequest" name="projectionQueryRequest">

                <h4>Anime</h4>
                <input type="checkbox" name="input[]" value="anime_title"> Title

                <h4>Characters</h4>
                <input type="checkbox" name="input[]" value="name"> Name
                <input type="checkbox" name="input[]" value="gender"> Gender
                <input type="checkbox" name="input[]" value="role"> Role

                <h4>Voice Actor</h4>
                <input type="checkbox" name="input[]" value="voice_actor_name"> Name </p>

                <input type="submit" value="Project" name="projectionSubmit"></p>
            </form>

            <hr />

            <h2>Search Anime By Studio</h2>
            <p>Please enter a valid studio name. Studio name is CASE-SENSITIVE!</p>

            <form method="POST" action="anime-db-final.php">
                <input type="hidden" id="joinQueryRequest" name="joinQueryRequest">
                Studio Name: <input type="text" name="studioName"> <br /><br />

                <input type="submit" value="Submit" name="joinSubmit"></p>
            </form>


        </div>

        <div>

            <h2> Average Age of Characters </h2>
            <p>Click Button To Find The Average Age of Characters in Animes</p>

            <form method="GET" action="anime-db-final.php">
                <input type="hidden" id="displayGroupByRequest" name="displayGroupByRequest">
                <input type="submit" value="Average Age?" name="displayGroupBy"></p>
            </form>

            <hr />

            <h2> Active Source Materials </h2>
            <p>Click Button To Find Plentiful Source Materials</p>

            <form method="GET" action="anime-db-final.php">
                <input type="hidden" id="aggregationQueryRequest" name="aggregationQueryRequest">
                <input type="submit" value="Get Active Source Materials" name="aggregationSubmit"></p>
            </form>

            <hr />

            <h2>Highly Rated Animes</h2>
            <p>Click Button To Find Binge Worthy Animes</p>

            <form method="GET" action="anime-db-final.php">
                <input type="hidden" id="displayNestedRequest" name="displayNestedRequest">
                <input type="submit" value="Give Me Suggestions" name="displayNested"></p>
            </form>

            <hr />

            <h2>Get Popular Genres</h2>
            <p>Click Button to Find Popular Genres</p>

            <form method="GET" action="anime-db-final.php">
                <input type="hidden" id="displayGenres" name="displayGenres">
                <input type="submit" value="Get Genres" name="divisionSubmit"></p>
            </form>


        </div>

        <div>
            <h2>Query Results<h2>


        <?php
    		//this tells the system that it's no longer just parsing html; it's now parsing PHP

        $success = True; //keep track of errors so it redirects the page only if there are no errors
        $db_conn = NULL; // edit the login credentials in connectToDB()
        $show_debug_alert_messages = False; // set to True if you want alerts to show you which methods are being triggered (see how it is used in debugAlertMessage())

        function debugAlertMessage($message) {
            global $show_debug_alert_messages;

            if ($show_debug_alert_messages) {
                echo "<script type='text/javascript'>alert('" . $message . "');</script>";
            }
        }

        function executePlainSQL($cmdstr) { //takes a plain (no bound variables) SQL command and executes it
            //echo "<br>running ".$cmdstr."<br>";
            global $db_conn, $success;

            $statement = OCIParse($db_conn, $cmdstr);
            //There are a set of comments at the end of the file that describe some of the OCI specific functions and how they work

            if (!$statement) {
                echo "<br>Cannot parse the following command: " . $cmdstr . "<br>";
                $e = OCI_Error($db_conn); // For OCIParse errors pass the connection handle
                echo htmlentities($e['message']);
                $success = False;
            }

            $r = OCIExecute($statement, OCI_DEFAULT);
            if (!$r) {
                echo "<br>Cannot execute the following command: " . $cmdstr . "<br>";
                $e = oci_error($statement); // For OCIExecute errors pass the statementhandle
                echo htmlentities($e['message']);
                $success = False;
            }

			return $statement;
		}

        function executeBoundSQL($cmdstr, $list) {
            /* Sometimes the same statement will be executed several times with different values for the variables involved in the query.
		In this case you don't need to create the statement several times. Bound variables cause a statement to only be
		parsed once and you can reuse the statement. This is also very useful in protecting against SQL injection. */

			global $db_conn, $success;
			$statement = OCIParse($db_conn, $cmdstr);

            if (!$statement) {
                echo "<br>Cannot parse the following command: " . $cmdstr . "<br>";
                $e = OCI_Error($db_conn);
                echo htmlentities($e['message']);
                $success = False;
            }

            foreach ($list as $tuple) {
                foreach ($tuple as $bind => $val) {
                    //echo $val;
                    //echo "<br>".$bind."<br>";
                    OCIBindByName($statement, $bind, $val);
                    unset ($val); //make sure you do not remove this. Otherwise $val will remain in an array object wrapper which will not be recognized by Oracle as a proper datatype
				}

                $r = OCIExecute($statement, OCI_DEFAULT);
                if (!$r) {
                    echo "<br>Cannot execute the following command: " . $cmdstr . "<br>";
                    $e = OCI_Error($statement); // For OCIExecute errors, pass the statementhandle
                    echo htmlentities($e['message']);
                    echo "<br>";
                    $success = False;
                }
            }
        }

        function printResult($result) { //prints results from a select statement
            echo "<table>";
            echo "<table style='border-collapse:separate;border-spacing:30px 10px;'><tr><th>Title</th><th>Rating</th><th>Demographic</th></tr>";

            while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td><td>" . $row[2] . "</td></tr>"; //or just use "echo $row[0]"
            }

            echo "</table>";
        }

        function connectToDB() {
            global $db_conn;

            // username is ora_(CWL_ID) and the password is a(student number).
            // For example, ora_platypus is the username and a12345678 is the password.
            $db_conn = OCILogon("ora_ethanly", "a89125033", "dbhost.students.cs.ubc.ca:1522/stu");

            if ($db_conn) {
                debugAlertMessage("Database is Connected");
                return true;
            } else {
                debugAlertMessage("Cannot connect to Database");
                $e = OCI_Error(); // For OCILogon errors pass no handle
                echo htmlentities($e['message']);
                return false;
            }
        }

        function disconnectFromDB() {
            global $db_conn;

            debugAlertMessage("Disconnect from Database");
            OCILogoff($db_conn);
        }

        function handleUpdateRequest() {
            global $db_conn;

            $anime_title = $_POST['animeTitle'];
            $new_rating = $_POST['newRating'];
            $new_demo = $_POST['newDemo'];

            $result = executePlainSQL("SELECT title FROM Anime WHERE title='" . $anime_title . "'");

            if (empty($_POST['animeTitle']) || oci_fetch_row($result) == false) {
                exit("Please enter a valid anime title!");
            }

            if (!empty($_POST['newRating'])) {
                executePlainSQL("UPDATE Anime SET rating='" . $new_rating . "' WHERE title='" . $anime_title . "'");
                echo nl2br("Rating for " . $anime_title . " updated to " . $new_rating . "\r\n");
            } else {
                echo nl2br("Rating for " . $anime_title . " unchanged \r\n");
            }

            if (!empty($_POST['newDemo'])) {
                executePlainSQL("UPDATE Anime SET demographic='" . $new_demo . "' WHERE title='" . $anime_title . "'");
                echo nl2br("Demographic for " . $anime_title . " updated to " . $new_demo . "\r\n");
            } else {
                echo nl2br("Demographic for " . $anime_title . " unchanged \r\n");
            }

            OCICommit($db_conn);
        }

        function handleDisplaySelectAnimeRequest() {

            $targetTable = $_POST['targetTable'];

            $conditions = " ";
            if($targetTable=="Anime"){
                if($_POST['targetAnimeTitle']!=null) {
                    if($conditions==" ") $conditions = $conditions . "WHERE ";
                    $conditions = $conditions . "title like '%" .$_POST['targetAnimeTitle'] . "%' ";
                }
                if($_POST['targetAnimeRating']!=null) {
                    if($conditions==" ") $conditions = $conditions . "WHERE ";
                    else $conditions = $conditions . " AND ";
                    $conditions = $conditions . "rating " . $_POST['animeRatingOperand']." ".$_POST['targetAnimeRating'];
                }
                if($_POST['targetAnimeDemographic']!=null) {
                    if($conditions==" ") $conditions = $conditions . "WHERE ";
                    else $conditions = $conditions . " AND ";
                    $conditions = $conditions . "demographic = '" . $_POST['targetAnimeDemographic'] . "'";
                }
            }else
            if($targetTable=="VoiceActor"){
                if($_POST['targetVAID']!=null) {
                    if($conditions==" ") $conditions = $conditions . "WHERE ";
                    $conditions = $conditions . "id = " .$_POST['targetVAID'];
                }
                if($_POST['targetVAName']!=null) {
                    if($conditions==" ") $conditions = $conditions . "WHERE ";
                    else $conditions = $conditions . " AND ";
                    $conditions = $conditions . "person_name LIKE '%" .$_POST['targetVAName'] . "%'";
                }
                if($_POST['targetVALanguage']!=null) {
                    if($conditions==" ") $conditions = $conditions . "WHERE ";
                    else $conditions = $conditions . " AND ";
                    $conditions = $conditions . "language = '" . $_POST['targetVALanguage'] . "'";
                }
            }else
            if($targetTable=="Studio"){
                if($_POST['targetStudioName']!=null) {
                    if($conditions==" ") $conditions = $conditions . "WHERE ";
                    $conditions = $conditions . "name LIKE '%" .$_POST['targetStudioName'] . "%' ";
                }
                if($_POST['targetStudioLocation']!=null) {
                    if($conditions==" ") $conditions = $conditions . "WHERE ";
                    else $conditions = $conditions . " AND ";
                    $conditions = $conditions . "location LIKE '%" . $_POST['targetStudioLocation'] . "%'";
                }
                if($_POST['targetStudioFoundingYear']!=null) {
                    if($conditions==" ") $conditions = $conditions . "WHERE ";
                    else $conditions = $conditions . " AND ";
                    $conditions = $conditions . "founding_year " . $_POST['targetStudioFoundingYearOperand']." ". $_POST['targetStudioFoundingYear'];
                }
            }

            $result = executePlainSQL("SELECT * FROM $targetTable" . $conditions);

            $topString = "";
            if ($targetTable == "Anime") $topString = "<table style='border-collapse:separate;border-spacing:15px 10px;'><th>Title</th><th>Rating</th><th>Demographic</th>";
            if ($targetTable == "VoiceActor") $topString = "<table style='border-collapse:separate;border-spacing:15px 10px;'><th>ID</th><th>Name</th><th>Language</th>";
            if ($targetTable == "Studio") $topString = "<table style='border-collapse:separate;border-spacing:15px 10px;'><th>Name</th><th>Location</th><th>Founding Year</th>";
            echo "<table border='0'>
            <tr>
            $topString
            </tr>";

            while (($row = oci_fetch_row($result)) != false) {
                echo "<tr>";
                if($targetTable=="Studio"){
                    echo "<td>" . $row[0] . "</td>";
                    echo "<td>" . $row[1] . "</td>";
                    echo "<td>" . $row[2] . "</td>";
                    echo "<td>" . $row[3] . "</td>";
                }else if ($targetTable=="VoiceActor"){
                    echo "<td>" . $row[0] . "</td>";
                    echo "<td>" . $row[1] . "</td>";
                    echo "<td>" . $row[3] . "</td>";
                } else if ($targetTable=="Anime") {
                    echo "<td>" . $row[0] . "</td>";
                    echo "<td>" . $row[1] . "</td>";
                    echo "<td>" . $row[2] . "</td>";
                }
                echo "</tr>";
            }
        }

        function handleResetRequest() {
            global $db_conn;
            // Drop old table
            executePlainSQL("DROP TABLE Category");
            executePlainSQL("DROP TABLE Production");
            executePlainSQL("DROP TABLE Cast");
            executePlainSQL("DROP TABLE SourceMaterialInfographics");
            executePlainSQL("DROP TABLE Characters");
            executePlainSQL("DROP TABLE Anime");

            // Create new table
            executePlainSQL(
                "CREATE TABLE Anime (
                    title           VARCHAR(40) NOT NULL,
                    rating          DECIMAL(2,1) NULL,
                    demographic     VARCHAR(20) NOT NULL,
                    studio VARCHAR(20) NOT NULL,
                    PRIMARY KEY (title),
                    FOREIGN KEY (studio) REFERENCES Studio)"
                );

            executePlainSQL(
                "CREATE TABLE Characters(
                    name VARCHAR(20) NOT NULL,
                    gender CHAR(1) NULL,
                    role CHAR(20) NOT NULL,
                    age INT NULL,
                    world VARCHAR(40) NOT NULL,
                    PRIMARY KEY (name),
                    FOREIGN KEY(world) REFERENCES Anime)"
                );

            executePlainSQL(
                "CREATE TABLE SourceMaterialInfographics (
                    title           VARCHAR(40) NOT NULL,
                    writer_id       INT NOT NULL,
                    type            VARCHAR(20) NOT NULL,
                    publisher       VARCHAR(20) NOT NULL,
                    num_volumes     INT NOT NULL,
                    release_date    INT NOT NULL,
                    anime_title     VARCHAR(40) NOT NULL,
                    PRIMARY KEY (title),
                    FOREIGN KEY (writer_id) references Writer,
                    FOREIGN KEY (anime_title) references Anime)"
                );

            executePlainSQL(
                "CREATE TABLE Cast (
                    anime_title     VARCHAR(20) NOT NULL,
                    character_name  VARCHAR(20) NOT NULL,
                    voice_actor_id  INT NOT NULL,
                    PRIMARY KEY (anime_title, character_name),
                    FOREIGN KEY (anime_title) references Anime,
                    FOREIGN KEY (character_name) references Characters,
                    FOREIGN KEY (voice_actor_id) references VoiceActor)"
                );

            executePlainSQL(
                "CREATE TABLE Production (
                    anime_title     VARCHAR(40) NOT NULL,
                    studio_name     VARCHAR(40) NOT NULL,
                    release_date    VARCHAR(40) NOT NULL,
                    PRIMARY KEY (anime_title, studio_name),
                    FOREIGN KEY (anime_title) references Anime ON DELETE CASCADE,
                    FOREIGN KEY (studio_name) references Studio)"
                );

            executePlainSQL(
                "CREATE TABLE Category (
                    anime_title     VARCHAR(40) NOT NULL,
                    genre_name      VARCHAR(40) NOT NULL,
                    PRIMARY KEY (anime_title, genre_name),
                    FOREIGN KEY (anime_title) references Anime ON DELETE CASCADE,
                    FOREIGN KEY (genre_name) references Genre)"
                );

            echo ("Reset Complete!");

            OCICommit($db_conn);
        }

        function handleInsertStudioRequest() {
            global $db_conn;

            //Getting the values from user and insert data into the table
            $tuple = array (
                ":bind1" => $_POST['insStudioName'],
                ":bind2" => $_POST['insLocation'],
                ":bind3" => $_POST['insFoundingYear'],
            );

            if (empty($_POST['insStudioName']) || empty($_POST['insLocation']) || empty($_POST['insFoundingYear'])) {
                exit("Please fill out all the information!");
            }

            $alltuples = array (
                $tuple
            );

            executeBoundSQL("INSERT into Studio VALUES (:bind1, :bind2, :bind3)", $alltuples);
            OCICommit($db_conn);
        }

        function handleInsertAnimeRequest() {
            global $db_conn;

            //Getting the values from user and insert data into the table
            $tuple = array (
                ":bind1" => $_POST['insTitle'],
                ":bind2" => $_POST['insRating'],
                ":bind3" => $_POST['insDemo'],
                ":bind4" => $_POST['insStudio'],
                ":bind5" => $_POST['insRelDate']
            );

            if (empty($_POST['insTitle']) || empty($_POST['insRating']) || empty($_POST['insDemo']) || empty($_POST['insStudio']) || empty($_POST['insRelDate'])) {
                exit("Please fill out all the information!");
            }

            $result = executePlainSQL("SELECT *
                                       FROM Studio S
                                       WHERE S.name = '" . $_POST['insStudio'] ."'");

            if (oci_fetch_row($result) == false) {
                exit("Please enter a valid Studio name!");
            }

            $alltuples = array (
                $tuple
            );

            executeBoundSQL("INSERT into Anime VALUES (:bind1, :bind2, :bind3, :bind4)", $alltuples);
            executeBoundSQL("INSERT into Production VALUES (:bind1, :bind4, :bind5)", $alltuples);
            OCICommit($db_conn);
        }

        function handleDeleteStudioRequest() {
            global $db_conn;

            $studio_name = $_POST['delStudio'];

            $result = executePlainSQL("SELECT *
                                       FROM Studio S
                                       WHERE S.name = '" . $studio_name . "'");

            if (empty($_POST['delStudio']) || oci_fetch_row($result) == false) {
                exit('Please enter valid studio name!');
            }

            executePlainSQL("DELETE FROM Studio WHERE name='" . $studio_name . "'");
            echo ("Studio '" . $studio_name . "' has been successfully deleted!");

            OCICommit($db_conn);
        }

        function handleDeleteAnimeRequest() {
            global $db_conn;

            $anime_title = $_POST['delAnime'];

            $result = executePlainSQL("SELECT *
                                       FROM Anime A
                                       WHERE A.title = '" . $anime_title . "'");

            if (empty($_POST['delAnime']) || oci_fetch_row($result) == false) {
                exit('Please enter valid anime name!');
            }


            executePlainSQL("DELETE FROM Anime WHERE title='" . $anime_title . "'");
            echo ("Anime '" . $anime_title . "' has been successfully deleted!");

            OCICommit($db_conn);
        }

        function handleDisplayProjectionRequest() {
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
              <table style='border-collapse:separate;border-spacing:10px 10px;'><tr>
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


        function handleJoinRequest() {
            global $db_conn;

            $studioName = $_POST['studioName'];

            $exists = executePlainSQL("SELECT *
                                       FROM Studio S
                                       WHERE S.name = '" . $_POST['studioName'] ."'");

            if (oci_fetch_row($exists) == false) {
                exit("Please enter a valid Studio name!");
            }

            if (!empty($_POST['studioName'])) {
                $result = executePlainSQL("SELECT *
                                           FROM Anime A
                                           INNER JOIN Studio S ON A.studio = S.name
                                           INNER JOIN Production P ON S.name = P.studio_name AND A.title = P.anime_title
                                           WHERE A.studio = '" . $studioName . "' AND P.studio_name = '" . $studioName . "'");



                echo "<table>";
                echo "<table style='border-collapse:separate;border-spacing:30px 10px;'><tr><th>Title</th><th>Rating</th><th>Demographic</th><th>Release Date</th><th>Studio</th><th>Location</th><th>Founding Year</th></tr>";

                while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                    echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td><td>" . $row[2] . "</td><td>" . $row[9] . "</td><td>" . $row[4] . "</td><td>" . $row[5] . "</td><td>" . $row[6] . "</td></tr>"; //or just use "echo $row[0]"
                }

                echo "</table>";

            } else {
                exit("Please enter a valid studio name!");
            }

            OCICommit($db_conn);

        }

        function handleDisplayAggGroupByRequest() {
            global $db_conn;

            $result = executePlainSQL("SELECT world, avg(age) FROM characters GROUP BY world");

            echo "<table border='0'>
            <table style='border-collapse:separate;border-spacing:30px 10px;'><tr>
            <th>Anime Title</th>
            <th>Average Age of Characters</th>
            </tr>";

            while (($row = oci_fetch_row($result)) != false) {
                echo "<tr>";
                echo "<td>" . $row[0] . "</td>";
                echo "<td>" . round($row[1], 1) . "</td>";
                echo "</tr>";
            }

            OCICommit($db_conn);
        }

        function handleDisplayAggHavingRequest() {
            global $db_conn;

            $result = executePlainSQL("SELECT title, MIN(num_volumes), type, release_date
                                    FROM SourceMaterialInfographics
                                    WHERE num_volumes > 1
                                    GROUP BY type, title, release_date
                                    HAVING release_date > 1980");

            echo "<table border='0'>
            <table style='border-collapse:separate;border-spacing:30px 10px;'><tr>
            <th>Title</th>
            <th>Number of Volumes</th>
            <th>Type</th>
            <th>Year Released</th>
            </tr>";

            while (($row = oci_fetch_row($result)) != false) {
                echo "<tr>";
                echo "<td>" . $row[0] . "</td>";
                echo "<td>" . $row[1] . "</td>";
                echo "<td>" . $row[2] . "</td>";
                echo "<td>" . $row[3] . "</td>";
                echo "</tr>";
            }

            OCICommit($db_conn);

        }


        function handleNestedRequest() {
            global $db_conn;

            $result = executePlainSQL("SELECT *
                                       FROM Anime A
                                       WHERE A.rating > ALL (SELECT AVG(A2.rating)
                                                              FROM Anime A2
                                                              GROUP BY A.studio)");

            echo "<table>";
            echo "<table style='border-collapse:separate;border-spacing:30px 10px;'><tr><th>Title</th><th>Rating</th><th>Demographic</th><th>Studio</th></tr>";

            while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td><td>" . $row[2] . "</td><td>" . $row[3] . "</td></tr>";
            }

            echo "</table>";

            OCICommit($db_conn);

        }

        function handleCountRequest() {
            global $db_conn;

            $result = executePlainSQL("SELECT Count(*) FROM Anime");

            if (($row = oci_fetch_row($result)) != false) {
                echo ("Current number of Animes: " . $row[0]);
            }
        }

        function handleDisplayDivisionRequest() {
            global $db_conn;

            $result = executePlainSQL("SELECT name FROM Genre g WHERE NOT EXISTS ((SELECT a.title FROM Anime a) MINUS (SELECT c.anime_title FROM Category c WHERE c.genre_name=g.name))");

            echo "<table border='0'>
            <table style='border-collapse:separate;border-spacing:15px 10px;'><tr>
            <th>Popular Genres in Every Anime</th>
            </tr>";

            while (($row = oci_fetch_row($result)) != false) {
                echo "<tr>";
                echo "<td>" . $row[0] . "</td>";
                echo "</tr>";
            }

            OCICommit($db_conn);
        }

        function handleDisplayRequest() {

            $table_vals = executePlainSQL("SELECT * FROM Anime");
            printResult($table_vals);

        }

        function handleDisplayStudiosRequest() {

            $table_vals = executePlainSQL("SELECT * FROM Studio");

            echo "<table>";
            echo "<table style='border-collapse:separate;border-spacing:15px 10px;'><tr><th>Studios Name</th><th>Location</th><th>Founding Year</th></tr>";

            while ($row = OCI_Fetch_Array($table_vals, OCI_BOTH)) {
                echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td><td>" . $row[2] . "</td></tr>";
            }

            echo "</table>";

        }

        function handleDisplaySourceRequest() {

            $table_vals = executePlainSQL("SELECT * FROM SourceMaterialInfographics");

            echo "<table>";
            echo "<table style='border-collapse:separate;border-spacing:15px 10px;'><tr><th> Source Material Title </th><th> Type </th><th> Publisher </th><th> Volumes </th><th> Release Date </th><th> Corresponding Anime</th></tr>";

            while ($row = OCI_Fetch_Array($table_vals, OCI_BOTH)) {
                echo "<tr><td>" . $row[0] . "</td><td>" . $row[2] . "</td><td>" . $row[3] . "</td><td>" . $row[4] . "</td><td>" . $row[5] . "</td><td>" . $row[6] . "</td></tr>";
            }

            echo "</table>";

        }

        function handleDisplayCharactersRequest() {

            $table_vals = executePlainSQL("SELECT * FROM Characters");

            echo "<table>";
            echo "<table style='border-collapse:separate;border-spacing:15px 10px;'><tr><th> Character Name </th><th> Character Gender </th><th> Character Role </th><th> Age </th><th> Corresponding Anime</th></tr>";

            while ($row = OCI_Fetch_Array($table_vals, OCI_BOTH)) {
                echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td><td>" . $row[2] . "</td><td>" . $row[3] . "</td><td>" . $row[4] . "</td></tr>";
            }

            echo "</table>";

        }

        // HANDLE ALL POST ROUTES
	// A better coding practice is to have one method that reroutes your requests accordingly. It will make it easier to add/remove functionality.
        function handlePOSTRequest() {
            if (connectToDB()) {
                if (array_key_exists('resetTablesRequest', $_POST)) {
                    handleResetRequest();
                } else if (array_key_exists('updateQueryRequest', $_POST)) {
                    handleUpdateRequest();
                } else if (array_key_exists('displaySelectAnimeTupleRequest', $_POST)) {
                    handleDisplaySelectAnimeRequest();
                } else if (array_key_exists('insertStudioRequest', $_POST)) {
                    handleInsertStudioRequest();
                } else if (array_key_exists('insertAnimeRequest', $_POST)) {
                    handleInsertAnimeRequest();
                } else if (array_key_exists('deleteStudioRequest', $_POST)) {
                    handleDeleteStudioRequest();
                } else if (array_key_exists('deleteAnimeRequest', $_POST)) {
                    handleDeleteAnimeRequest();
                } else if (array_key_exists('joinQueryRequest', $_POST)) {
                    handleJoinRequest();
                }

                disconnectFromDB();
            }
        }


        // HANDLE ALL GET ROUTES
	// A better coding practice is to have one method that reroutes your requests accordingly. It will make it easier to add/remove functionality.
        function handleGETRequest() {
            if (connectToDB()) {
                if (array_key_exists('countTuples', $_GET)) {
                    handleCountRequest();
                } else if (array_key_exists('displayTuples', $_GET)) {
                    handleDisplayRequest();
                } else if (array_key_exists('displayStudios', $_GET)) {
                    handleDisplayStudiosRequest();
                } else if (array_key_exists('displaySource', $_GET)) {
                    handleDisplaySourceRequest();
                } else if (array_key_exists('displayCharacters', $_GET)) {
                    handleDisplayCharactersRequest();
                } else if (array_key_exists('displayNested', $_GET)) {
                    handleNestedRequest();
                } else if (array_key_exists('projectionQueryRequest', $_GET)) {
                    handleDisplayProjectionRequest();
                } else if (array_key_exists('displayGroupBy', $_GET)) {
                    handleDisplayAggGroupByRequest();
                } else if (array_key_exists('aggregationSubmit', $_GET)) {
                    handleDisplayAggHavingRequest();
                } else if (array_key_exists('divisionSubmit', $_GET)) {
                    handleDisplayDivisionRequest();
                }

                disconnectFromDB();
            }
        }

		if (isset($_POST['reset']) || isset($_POST['updateSubmit']) || isset($_POST['displaySelectAnimeTuplesSubmit']) ||isset($_POST['insertStudioSubmit']) || isset($_POST['insertAnimeSubmit']) || isset($_POST['deleteStudioSubmit']) ||
            isset($_POST['deleteAnimeSubmit'])  || isset($_POST['joinSubmit'])) {
            handlePOSTRequest();
        } else if (isset($_GET['countTupleRequest']) || isset($_GET['displayTupleRequest']) || isset($_GET['displayStudiosRequest']) || isset($_GET['displaySourceRequest']) || isset($_GET['displayNestedRequest']) || isset($_GET['projectionSubmit']) || isset($_GET['displayGroupByRequest']) ||
                   isset($_GET['aggregationQueryRequest']) || isset($_GET['displayCharactersRequest']) || isset($_GET['displayGenres'])) {
            handleGETRequest();
        }
		?>
	</body>
</html>
