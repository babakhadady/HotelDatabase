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
            <input type="hidden" id="groupbyQueryRequest" name="groupbyQueryRequest" value="true">

            <input type="submit" class="btn btn-primary">
    </form>

    <h3>For each floor, grab the min price of all vacant rooms</h3>
    <form method="GET" action="cpsc304-project.php"> <!--refresh page when submitted-->
        <input type="hidden" id="havingQueryRequest" name="havingQueryRequest" value="true">
        <input type="submit" class="btn btn-primary">
    </form>



    <h3>Find the floor and room number of vacant rooms</h3>
    <form method="GET" action="cpsc304-project.php"> <!--refresh page when submitted-->
        <input type="hidden" id="groupbyQueryRequest" name="groupbyQueryRequest" value="true">
        <input type="submit" class="btn btn-primary">
    </form>


    <h3>Find reservations that reserved all rooms</h3>
    <form method="GET" action="cpsc304-project.php"> <!--refresh page when submitted-->
        <input type="hidden" id="divisionRequest" name="divisionRequest" value="true">
        <input type="submit" class="btn btn-primary">
    </form>


</body>

</html>