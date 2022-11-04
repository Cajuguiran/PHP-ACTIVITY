<?php 

$arrDrinks = ["Coke" => 15,"Sprite" => 20,"Royal" => 20,"Pepsi" => 15,"Mountain Dew" => 20];
$arrSize   = ["Regular" => 0,"Up-size" => 5,"Jumbo" => 10];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendo Machine</title>
</head>
<body>
    <h1>Vendo Machine</h1>
    <div style =" width: 30%;">
        <form method="post">
            <fieldset>
                <legend>Products: </legend>
                <?php 

                    foreach($arrDrinks as $key => $value){
                        echo '<input type="checkbox" name="checkproduct[]" id="'.$key.'" value="'.$key.'">';
                        echo '<label for="'.$key.'">'.$key.' - ₱ '.$value.')</label><br>';
                    }
                ?>
            </fieldset>
            <fieldset>
                <legend>Options: </legend>
                <label for="size">Size: </label>
                    <select name="size" id="size">
                        <?php 
                            foreach($arrSize as $key => $value){
                                echo '<option value="'.$key.'">'.$key.' (add ₱ '.$value.')'.'</option>';
                            }
                        ?>
                    </select>
                </label>

                <label for="quantity">Quantity : </label>
                <input type="number" min=0 value=0 name="quantity">

                <button type="submit" name="btnprocess">Check Out</button>
            </fieldset>
        </form>
    </div>
   <?php 
        if(isset($_POST['btnprocess'])){
            echo '<hr>';

            if(isset($_POST['checkproduct']) and $_POST['quantity'] > 0){
                
                $drinks = $_POST['checkproduct'];
                $size = $_POST['size'];
                $qty = $_POST['quantity'];
                
                $totalAmount = 0;
                $totalItems = count($drinks) * $qty;

                echo '<h3>Purchase Sumarry : </h3>';
                echo '<ul>';
                foreach($drinks as $productname){
                    $tpdrink = ($arrDrinks[$productname] + $arrSize[$size]) * $qty;
                    $totalAmount += $tpdrink;

                    if($qty == 1)
                        echo '<li>'." $qty peice of $size $productname amounting to ₱ $tpdrink".'</li>';
                    else
                        echo '<li>'." $qty peices of $size $productname amounting to ₱ $tpdrink".'</li>';
                }
                echo
             '</ul>';

                echo '<b>Total Items: </b>'.$totalItems. '<br>';
                echo '<b>Total Amount: </b>'.$totalAmount;

            }
            else{
                echo 'No product selected.';
            }
        }
   ?>
</body>
</html>