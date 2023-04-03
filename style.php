<?php
header("Content-type: text/css");


$font_family = 'Arial, Helvetica, sans-serif';
$font_size = '0.7em';
$border = '1px solid';
?>

table {
margin: 8px;
}

body {
    display: flex;
    flex-direction: column;
    align-items: center;
    border-color: #000;
    border-style: solid;
}
* {
    font-family: <?=$font_family?>;
}

hr {
}

.formfield {
    margin-top: 0px;
    margin-bottom: 0px;
}

form {
    display:flex;
    align-items: center;
    flex-direction: column;
}

h1 {
    text-align: center;
}

h2 {
    margin-bottom: 10px;
}


strong {
    font-size: 20px;
}
.attribute {
    margin-top: 2.5px;
    margin-bottom: 2.5px;
}