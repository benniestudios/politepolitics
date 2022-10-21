<?php

if (isset($_POST["user"])) {

    session_start();

    # Requirements
    require_once 'dbh.inc.php';

    # Set variables
    $userSeller = $_POST["user"];
    $userBuyer = $_SESSION["useruid"];
    $item = ucfirst($_POST["item"]);
    $price = $_POST["price"];
    $quantity = $_POST["quantity"];
    $money = $_POST["money"];
    $amount = $_POST["amount"];
    
    function buy($conn, $userSeller, $userBuyer, $item, $price, $quantity, $money, $amount) {
        $totalprice = $amount * $price;
        $items = "items" . $item;
        if ($amount > $quantity or $totalprice > $money or $userBuyer === $userSeller) {
            header("location: ../market/index.php?market=error");
        } else {
            
            
            $sql = "UPDATE users, items, market SET usersMoney = usersMoney - $totalprice, $items = $items + $amount, marketQuantity=marketQuantity-$amount WHERE usersUid=? AND itemsUser=? AND marketUser=?;";
            $stmt= $conn->prepare($sql);
            $stmt->bind_param("sss", $userBuyer, $userBuyer, $userSeller);
            $stmt->execute();

            $sql3 = "UPDATE items SET $items = $items - $amount WHERE itemsUser=?;";
            $stmt= $conn->prepare($sql3);
            $stmt->bind_param("s", $userSeller);
            $stmt->execute();

            $sql4 = "INSERT INTO evts (evtsUser, evtsTitel, evtsMessage) VALUES('$userSeller', 'sell', '$userBuyer has bought $amount $item.');";
            $stmt= $conn->prepare($sql4);
            $stmt->execute();
        
            if ($quantity - $amount == 0) {
                $sql2 = "DELETE FROM market WHERE marketUser=? AND marketItem=?;";
                $stmt= $conn->prepare($sql2);
                $stmt->bind_param("ss", $userSeller, $item);
                $stmt->execute();
            }
        
            header("location: ../market/index.php?market=success");
            exit();
        }
    }

    buy($conn, $userSeller, $userBuyer, $item, $price, $quantity, $money, $amount);

} else {
    header("location: ../market/index.php?error=notworking");
    exit();
}
