<?php
    require "../config/connection.php";

    $output = '';
    $query = "SELECT * FROM brend";
    $brands = queryFunc($query);

    if(count($brands) > 0){
        $output .= "<table class='excelTable'>
                <thead>
                <tr>
                <td>id</td>
                <td>Name</td>
                <td>Text</td>
                <td>Opis</td>
                </tr>
                </thead>
                <tbody>";
        foreach($brands as $brand){
            $output .= "<tr>
                    <td>" . $brand ->id ."</td>
                    <td>" .$brand -> naziv ."</td>
                    <td>" .$brand ->text."</td>
                    <td>" .$brand -> opis ."</td>
                    </tr>";
        }
        $output .= "</tbody></table>";
    }
    header("Content-Type: application/xls");
    header("Content-Disposition: attachment; filename=brands.xls");
    echo $output;
?>