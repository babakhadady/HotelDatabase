<html>
<link rel="stylesheet" href="style.php" media="screen">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<body>
    <div>
    <h1> Query Page </h1>

    <form method="POST" action="cpsc304-project.php">

        <p class="formfield">
        <h2> Back To Main Menu</h2>
        <input type="submit" class="btn btn-primary" value="Go Back">
        </p>

    </form>

    <h3> Find number of vacant or occupied rooms for each room type </h3>

    <form method="GET" action="query-page.php"> <!--refresh page when submitted-->
            <!-- <input type="hidden" id="groupbyQueryRequest" name="groupbyQueryRequest" value="true"> -->
            <select name="room-status-table">
                <?php
                $tables = array("vacant", "occupied");
                foreach ($tables as $table) {
                    echo '<option value="' . $table . '"' . (($_GET['room-status-table'] == $table) ? 'selected = selected' : '') . '>' . $table . '</option>';
                }
                ?>
            </select>
            <input type="submit" class="btn btn-primary" name="do_groupbyQueryRequest"></p>
    </form>

    <h3>For each floor that has more than X amount of available rooms, grab the cheapest available room</h3>
    <form method="GET" action="query-page.php"> <!--refresh page when submitted-->
        <!-- <input type="hidden" id="havingQueryRequest" name="havingQueryRequest" value="true"> -->
        <select name="number-table">
                <?php
                $tables = array("0", "1", "2", "3");
                foreach ($tables as $table) {
                    echo '<option value="' . $table . '"' . (($_GET['number-table'] == $table) ? 'selected = selected' : '') . '>' . $table . '</option>';
                }
                ?>
            </select>
        <input type="submit" class="btn btn-primary" name="do_havingQueryRequest"></p>
    </form>



    <h3>Find the most expensive available room</h3>
    <form method="GET" action="query-page.php"> <!--refresh page when submitted-->
        <!-- <input type="hidden" id="nestedQueryRequest" name="nestedQueryRequest" value="true"> -->
        <input type="submit" class="btn btn-primary" name="do_nestedQueryRequest"></p>
    </form>


    <h3>Find reservation ID that reserved all rooms on 3rd floor</h3>
    <form method="GET" action="query-page.php"> <!--refresh page when submitted-->
        <!-- <input type="hidden" id="divisionRequest" name="divisionRequest" value="true"> -->
        <input type="submit" class="btn btn-primary" name="do_divisionRequest"></p>
    </form>

    <?php

    require_once('db-requests.php');

    function handleRequest()
    {
        if (connectToDB()) {
            if (array_key_exists('do_groupbyQueryRequest', $_GET)) {
                if (isset($_GET['do_groupbyQueryRequest'])) {
                    aggregationGroupByRequest($_GET['room-status-table']);
                }
            } else if (array_key_exists('do_havingQueryRequest', $_GET)) {
                if (isset($_GET['do_havingQueryRequest'])) {
                    aggregationHavingRequest($_GET['number-table']);
                }
            } else if (array_key_exists('do_nestedQueryRequest', $_GET)) {
                if (isset($_GET['do_nestedQueryRequest'])) {
                    aggregationNestedRequest();
                }
            } else if (array_key_exists('do_divisionRequest', $_GET)) {
                if (isset($_GET['do_divisionRequest'])) {
                    divisionRequest();
                }
            }

            disconnectFromDB();
        }
    }

    handleRequest();

    ?>

</div>
</body>

</html>