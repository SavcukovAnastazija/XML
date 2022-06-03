<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Movies 2022</title>
    <script>
        function onload(){
            <?php
            if (isset($_GET['filmovi'])){
                echo "document.getElementById('filmovi').value='".$_GET['filmovi']."';";
            }
            ?>
        }
    </script>
    <style>
        select{font-size: 20px; padding: 5px 10px;}
        body{
            display: flex;
            justify-content: center;
        }
        p{font-size: 22px;}
        *{
            font-family: sans-serif;
        }
        form{padding-bottom: 20px; font-size: 20px;}
        table{
            font-size: 18px;
            padding-top: 30px;
        }
        th{
            padding: 10px;
            background-color: gold;
        }
        td{padding:10px;}
        input{
            background-color: gold;
            margin: 0px 20px;
            padding: 10px;
            font-weight: bold; font-size: 16px;
        }
        img{
            width: 150px;
            padding-left: 20px;
            text-align: center;
            transform: rotate(10deg);
        }
        .uvod{
            width:100%;
            display: flex;
            flex-direction: row;
            align-items: center;
            padding-bottom: 20px;
        }
        tr:nth-child(even) {background: #CCC;}
        tr:nth-child(odd) {background: #FFF;}
    </style>
</head>
<body onload="onload()">
    <div class="sve">
        <div class="uvod">
            <div>
            <h1>Best movies of 2022</h1>
            <p>Dont't know what to watch? This list will help!</p>
            </div>
            <img src = "icon.svg"/>
        </div>
    <form action="filmovi.php" method="GET">
        <label for="filmovi">Choose your favourite genre:</label>
        <select class="custom-select" id="filmovi" name="filmovi">
        <option value="action">Action</option>
        <option value="fantasy">Fantasy</option>
        <option value="comedy">Comedy</option>
        <option value="romance">Romance</option>
        <option value="drama">Drama</option>
        <option value="crime">Crime</option>
        <option value="mystery">Mystery</option>
        <option value="history">History</option>
        <option value="animation">Animation</option>
        </select>
        <input type="submit" id="odabir" value="CONFIRM"/>
    </form>
    <table>
        <tr>
            <th>Name</th>
            <th>Length(min)</th>
            <th>Release</th>
            <th>IMDB score</th>
            <th>Genres</th>
        </tr>
        <?php
    $xml = simplexml_load_file("film.xml");
    foreach($xml->Film as $film){
        $str = "";
        $found = false;
        foreach($film->Zanrovi->Zanr as $zanr){
            if (strlen($str) > 0) $str.=", ";
            $str.=$zanr;
            if (!(isset($_GET['filmovi'])) || strtolower($zanr)==$_GET['filmovi']) $found = true;
        }
        if ($found){
            echo '<tr>
            <td>'.$film->Naslov.'</td>
            <td>'.$film->Trajanje.'</td>
            <td>'.$film->PocetakPrikazivanja.'</td>
            <td>'.$film->IMDBscore.'</td>
            <td>'.$str.'</td>
            </tr>';
        } 
    }
    ?>
    </table>
    </div>
</body>
</html>
