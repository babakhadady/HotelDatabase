<html>
<link rel="stylesheet" href="style.php" media="screen">

<body>

    <h1> Hotel Application Queries </h1>

    <form method="POST" action="cpsc304-project.php">

        <p class="formfield">
        <h2> Back To Main Menu</h2>
        <input type="submit" value="Go Back">
        </p>

    </form>

    <h2>Find number of vacant rooms for each room type</h2>
    <form method="GET" action="cpsc304-project.php"> <!--refresh page when submitted-->
        <input type="hidden" id="groupbyQueryRequest" name="groupbyQueryRequest" value="true">
        <input type="submit"></p>
    </form>

    <h2>For each floor, grab the min price of all vacant rooms</h2>
    <form method="GET" action="cpsc304-project.php"> <!--refresh page when submitted-->
        <input type="hidden" id="havingQueryRequest" name="havingQueryRequest" value="true">
        <input type="submit"></p>
    </form>



    <h2>Find the floor and room number of vacant rooms</h2>
    <form method="GET" action="cpsc304-project.php"> <!--refresh page when submitted-->
        <input type="hidden" id="groupbyQueryRequest" name="groupbyQueryRequest" value="true">
        <input type="submit"></p>
    </form>


    <h2>Find reservations that reserved all rooms</h2>
    <form method="GET" action="cpsc304-project.php"> <!--refresh page when submitted-->
        <input type="hidden" id="divisionRequest" name="divisionRequest" value="true">
        <input type="submit"></p>
    </form>


</body>

</html>