<html>
<link rel="stylesheet" href="style.php" media="screen">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<body>

    <h1> Query Page </h1>

    <form method="POST" action="cpsc304-project.php">

        <p class="formfield">
        <h2> Back To Main Menu</h2>
        <input type="submit" class="btn btn-primary" value="Go Back">
        </p>

    </form>

    <h3> Find number of vacant rooms for each room type </h3>

    <form method="GET" action="query-page.php"> <!--refresh page when submitted-->
            <!-- <input type="hidden" id="groupbyQueryRequest" name="groupbyQueryRequest" value="true"> -->
            <input type="submit" class="btn btn-primary" name="do_groupbyQueryRequest"></p>
    </form>

    <h3>For each floor, grab the cheapest available room</h3>
    <form method="GET" action="query-page.php"> <!--refresh page when submitted-->
        <!-- <input type="hidden" id="havingQueryRequest" name="havingQueryRequest" value="true"> -->
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
                    aggregationGroupByRequest();
                }
            } else if (array_key_exists('do_havingQueryRequest', $_GET)) {
                if (isset($_GET['do_havingQueryRequest'])) {
                    aggregationHavingRequest();
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


</body>

</html>