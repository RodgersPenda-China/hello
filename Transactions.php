<?php
ob_start();
error_reporting(0);
include 'Global_Wallet.php';
$wallet = new Global_Wallet();
$wallet->setMerchant("godfrey@gmail.com","C2B22-5C688-81A19-EA5E6-3C6D6")
->setOrder(2,"Iphone",0.1,"USD")
->setUrl("http://localhost/test/upload.php","http://localhost/test/upload.php","http://localhost/test/upload.php");

if($_GET['pay']){
$wallet->Pay();
echo $_POST['pay'];
}
if($_GET['txid']){
$txid = $_GET['txid'];
$results = $wallet->getDetails($txid);
    if($results->status == 'success'){
    #Your code here
    echo "Payment Successfull, You will receive your Products soon";
    } else {
        echo "Payment Failed, Please Retry";
    }
}
?>
<a href="?pay=1">
    <button type="submit" name="pay"> Pay With Global Wallet</button>
<a>

