<?php require_once("config.php"); 
// session_destroy();

if(isset($_GET['add']))
{
    global $connection;
    $query = "SELECT * FROM products WHERE product_id = " . $_GET['add'] ." ";
    $fetch = mysqli_query($connection , $query);

    while ($row = mysqli_fetch_array($fetch)) 
    {
        if($_SESSION['product_' . $_GET['add']] < $row['product_limit'])
        {
            $_SESSION['product_' . $_GET['add']] += 1;
            redirect("../public/cart_user");
        }
        else
        {
            set_message("Sorry, the maximum limit for each item is {$row['product_limit']}.");
            redirect("../public/cart_user");
        }
    }
} 

if(isset($_GET['remove']))
{  
    if(!($_SESSION['product_' . $_GET['remove']] <= 0))
    {
        $_SESSION['product_' . $_GET['remove']]--;
        unset($_SESSION['item_quantity']);
        unset($_SESSION['item_total']);
        redirect("../public/cart_user");
    }
    else
    {
        redirect("../public/cart_user");
    }   
}

if(isset($_GET['delete']))
{
    $_SESSION['product_' . $_GET['delete']] = '0';
    unset($_SESSION['item_quantity']);
    unset($_SESSION['item_total']);
    redirect("../public/cart_user");
}

// function currency($from_Currency,$to_Currency,$amount) 
// {
//     global $conv;

//     $url = "https://www.google.com/search?q=".$from_Currency."+to+".$to_Currency."";
//     $get = file_get_contents($url);
//     $data = preg_split('/\D\s(.*?)\s=\s/',$get);
//     $exhangeRate = (float) substr($data[1],0,7);

//     $convertedAmount = $amount*$exhangeRate;

//     return $convertedAmount;

// }

function cart_user()
{
    $sub = 0.00;
    $enc = 'urlencode';
    $base = 'base64_encode';
    $currency = 'currency';
    $total = $item_quantity = 0;
    $i = 0;
    $item_name = 1;
    $item_number = 1;
    global $amount1;
    $amount1 = 1;
    $quantity = 1;
    global $conv;
    global $total;

    foreach ($_SESSION as $name => $value) 
    {
        if($value > 0)
        {

            if(substr($name, 0, 8) == "product_")
            { 
            	// echo "name".$name;
                $length = strlen($name - 10);
                // echo "<br>length".$length;
                $id = substr($name, 8, $length);
                // echo "<br>id".$id;
                global $connection;    
                $query = "SELECT * FROM products WHERE product_id = " . $id . " ";
                $run_query = mysqli_query($connection , $query);

                while($row = mysqli_fetch_array($run_query))
                {   
                    $sub = $row['product_price'] * $value;
                    $sub = sprintf('%0.2f', $sub);
                    $total += $sub;
                    $total = sprintf('%0.2f', $total);
                    $_SESSION['item_total'] = $total; 
                    
                    
                    $item_quantity += $value;

                    $_SESSION['item_quantity'] = $item_quantity;
                    $qua = $_SESSION['item_quantity'];
                    (int) $del = 0;
                    if($_SESSION['item_quantity'] < 2)
                    {
                        $del = 40;
                    }
                    else
                    {
                        $del = 0;
                    }
                    
                    // $converted_total = currency('INR','USD',$row['product_price'] + $del);

                    $try = <<<HERE
                    <tr>
                        <td class='td-img'><img class='cart-img' src="{$row['product_image']}" width='30' height='30'></td>
                        <td>{$row['product_title']}</td>
                        <td>&#8377; {$row['product_price']}</td>
                        <td><a href='../resources/cart.php?add={$row['product_id']}'><img width='15' height='15' src='images/add.png'></a> {$value}
                            <a href='../resources/cart.php?remove={$row['product_id']}'><img width='15' height='15' src='images/remove.png'></a></td>
                        <td>&#8377; {$sub}</td>
                        <td width='1'><a href='../resources/cart.php?delete={$row['product_id']}'><img src='images/cancel.png' width='15' height='15'></a></td>
                    </tr> 

                    <input type='hidden' name='item_name_{$item_name}' value='{$row['product_title']}'>
                    <input type='hidden' name='item_number_{$item_number}' value='{$row['product_id']}'>
                    <input type='hidden' name='amount_{$amount1}' value='{$row['product_price']}'>
                    <input type='hidden' name='item_quantity_{$quantity}' value='{$value}'> 
HERE;
echo $try;

                    $item_name++;   
                    $item_number++;
                    $amount1++;   
                    $quantity++;                
                } 
            }   
        }
    }
} 

?>