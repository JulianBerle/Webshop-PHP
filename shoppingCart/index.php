<script src='./assets/js/script.js'></script>
<?php
    include_once("../include.php");
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShoppingCart</title>
    <link rel="icon" href="../assets/images/favicon.png">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>	
    <?php 
        // if(!isset($_COOKIE['shoppingCart'])) {
        //     echo "Je hebt geen items in je winkelwagen staan";
        // } else {
        //     $items = explode("+", $_COOKIE['shoppingCart']);

        //     for($x = 0; $x < count($items); $x++) {
        //         $id = $items[$x];

                // $query = $database_connection->query("SELECT * FROM store WHERE id=$id");

        //         while($row = $query->fetch()) {
        //             echo "<div cl'> <img src='../assets/images/product-images/" .$row['img'] . "' alt='" . $row['name'] . "-img'> <h2>" . $row['name'] . "</h2> <p>€" . $row['price'] . "</p> <button class='add-to-cart' onclick='addToShoppingCart(" .$row['id'] . ")'><i class='fa-solid fa-cart-shopping'></i></button></div> <br>\n";
        //         };
        //     }
        // }    
        ?>
    </div>

    <table class="tbl-cart" cellpadding="10" cellspacing="1">
        <tbody>
            <tr>
                <th style="text-align:left;">Name</th>
                <th style="text-align:left;">Code</th>
                <th style="text-align:right;" width="5%">Quantity</th>
                <!-- <th style="text-align:right;" width="10%">Price</th> -->
                <th style="text-align:right;" width="10%">Price</th>
                <th style="text-align:center;" width="5%">Remove</th>
            </tr>	
            <?php
                $productIds = [];
                $query = $database_connection->query("SELECT * FROM store");
                while($row = $query->fetch()) {
                    array_push($productIds, $row['id']);
                };
                var_dump($productIds);
                for ($x = 0; $x < count($productIds); $x++) {
                    if (!isset($_COOKIE["shoppingCart" . $productIds[$x]])) {
                        echo $productIds[$x] . " bestaat niet <br>";
                    } else {
                        $cookieValue = $_COOKIE["shoppingCart" . $productIds[$x]];
                        echo $cookieValue . "<br>";
                        $query = $database_connection->query("SELECT * FROM store WHERE id = $productIds[$x]");
                        while($row = $query->fetch()) {
                            echo "
                                    <tr>
                                    <td><img src='../assets/images/product-images/" . $row['img'] . "' alt='" . $row['name'] . "-img' class='cart-item-image'>" . $row["name"] . "</td>
                                    <td>" . $row["id"] . "</td>
                                    <td style='text-align:right;'>" . $cookieValue . "</td>
                                    <!--<td  style='text-align:right;'>" . $row['price'] . "</td>-->
                                    <td  style='text-align:right;'>" . $row['price'] . "</td>
                                    <td style='text-align:center;'><a href='index.php?action=remove&code=" . $row['id'] . "' class='btnRemoveAction'><img src='../assets/images/icon-delete.png' alt='Remove Item' /></a></td>
                                    </tr>
                                    ";                        
                                };
                    }
                }
            ?>

            <!-- <tr>
                <td colspan="2" align="right">Total:</td>
                <td align="right"><?//php echo $total_quantity; ?></td>
                <td align="right" colspan="2"><strong><?//php echo "$ ".number_format($total_price, 2); ?></strong></td>
                <td></td>
            </tr> -->
        </tbody>
    </table>
</body>
</html>