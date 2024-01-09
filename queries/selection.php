<html>

<body>
    <!-- need to work a subset of tables-->

    <h2>Select</h2>
    <form method="POST" action="selection.php">
        Table:
        <select name="targetTable" id="targetTable">
            <option value="">...</option>
            <option value="Anime">Anime</option>
            <option value="VoiceActor">Voice Actor</option>
            <option value="Studio">Studio</option>
        </select> <br> <br>

        <div id="animeDiv" style="display:none">
            <!-- Attributes to show: <br>
            <label><input type="checkbox" id="showAnimeTitle" name="showAnimeTitle" value="true"> Title </label>
            <label><input type="checkbox" id="showAnimeRating" name="showAnimeRating" value="true"> Rating </label>
            <label><input type="checkbox" id="showAnimeDemographic" name="showAnimeDemographic" value="true"> Demographic </label>
            <br><br> -->

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
            <!-- Attributes to show: <br>
            <label><input type="checkbox" id="showVoiceActorID" name="showVoiceActorID" value="true"> ID </label>
            <label><input type="checkbox" id="showVoiceActorName" name="showVoiceActorName" value="true"> Name </label>
            <label><input type="checkbox" id="showVoiceActorRole" name="showVoiceActorRole" value="true"> Role </label>
            <label><input type="checkbox" id="showVoiceActorLanguage" name="showVoiceActorLanguage" value="true"> Language </label>
            <br><br> -->
            
            ID: <input type="text" name="targetVAID" placeholder="Enter number"> <br><br>
            
            Name: <input type="text" name="targetVAName" placeholder="Enter keyword"> <br><br>

            Language: <input type="text" name="targetVALanguage"> <br><br>
            
        </div>

        <div id="studioDiv" style="display:none">
            <!-- Attributes to show: <br>
            <label><input type="checkbox" id="showStudioName" name="showStudioName" value="showStudioName"> Name </label>
            <label><input type="checkbox" id="showStudioLocation" name="showStudioLocation" value="showStudioLocation"> Location </label>
            <label><input type="checkbox" id="showStudioFoundingYear" name="showStudioFoundingYear" value="showStudioFoundingYear"> Foudning Year </label>
            <br><br> -->

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

    <?php
    include("idk.php");

    function handleDisplaySelectAnimeRequest()
    {
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
        echo $conditions;
        $result = executePlainSQL("SELECT * FROM $targetTable" . $conditions);

        $topString = "";
        // if ($targetTable == "Anime") {
        //     if (isset($_POST['showAnimeTitle'])) $topString = $topString . "<th>Title</th>";
        //     if (isset($_POST['showAnimeRating'])) $topString = $topString . "<th>Rating</th>";
        //     if (isset($_POST['showAnimeDemographic'])) $topString = $topString . "<th>Demographic</th>";
        // }
        if ($targetTable == "Anime") $topString = "<th>Title</th><th>Rating</th><th>Demographic</th>";
        if ($targetTable == "VoiceActor") $topString = "<th>ID</th><th>Name</th><th>Language</th>";
        if ($targetTable == "Studio") $topString = "<th>Name</th><th>Location</th><th>Founding Year</th>";
        echo "<table border='0'>
        <tr>
        $topString
        </tr>";

        while (($row = oci_fetch_row($result)) != false) {
            echo "<tr>";
            if($targetTable!="VoiceActor"){
                echo "<td>" . $row[0] . "</td>";
                echo "<td>" . $row[1] . "</td>";
                echo "<td>" . $row[2] . "</td>";
                echo "<td>" . $row[3] . "</td>";
            }else{
                echo "<td>" . $row[0] . "</td>";
                echo "<td>" . $row[1] . "</td>";
                echo "<td>" . $row[3] . "</td>";
            }
            echo "</tr>";
        }
    }

    if (isset($_POST['displaySelectAnimeTuplesSubmit'])) {
        if (connectToDB()) {
            if (array_key_exists('displaySelectAnimeTupleRequest', $_POST)) {
                handleDisplaySelectAnimeRequest();
            }
        }
        disconnectFromDB();
    }
    ?>

</body>

</html>
