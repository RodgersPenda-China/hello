#Global Wallet <br><br>
This Is Main's Standard way of Connecting To Sites Via Php, Its a Php Class That Sends Data To Global-Wallet.
Once You Have php running, just plugin and play. I recommend using a very updated editor as the class is neatly documented
<br>
If You Are Very Familiar With Php, A glance at Transactions.php is enough but if you are new I Will explain the code here
All codes are from [Global Wallet Merchant Page](https://globalwallet.hicf.online/merchant)
<br>
<h1>Class Filer</h1>

```
<?php
class global_wallet{

//All needed methods and objects are listed in this folder, please do not change anything at ALL

}
```
This File, Should be left untouchde, Wherever you need it, Just include It and make an instance of the class
<h1>Transactions File</h1>

```
<?php
include("Global_Wallet.php");
$wallet = new global_wallet();

//remember, For registering Details, All Methods Are Chained, While The Acutal Pay and Verification Are Not, You Should Call Them Separately
$wallet = setMerchant($yourMerchantAccount,$yourMerchantKey)->setOrder->($theItemNumber,$theItemName,$theItemPrice,$theItemCurrency)->setUrl($SuccessUrl,$Failurl,$CancelUrl);

// We Recommend You Use Some Html To All Javascript To Keep This Function From Lanuching As It Will Reload The Page
// The Transactions.php File Provided, Contains Errors Which Are Hidden With ob_start(), error_reporting(0),functions.
// Please Make Some Button Or Something TO Launch This Function
$wallet->Pay();

//After This Function is Launched, We need to receive The <h5>$txid</h5>, Its Important To Know Whether The Transactions Was Successful Or Not
$txid = $_GET['txid']
$results = $wallet->getDetails($txid);   //This Functions Sends The Details Back To Global Wallet Where The $txid Is Processed, Something is returned
if($results->status == 'success'){
 //The Code You Would Want To Run If The Transactions Was Successful 
}
?>
```

If Verification Is Done On A Different Page From Where The Pay() method is made, Please use the following code, Just make sure, The Verification url is the success url
<h1>Verification File </h1>


````
<?php
include("Global_Wallet.php");
$wallet = new global_wallet();
$wallet->setMerchant($yourMechantAccount,$yourMerchantKey);

//Immediately After This, Just Call The Get Details Method
$txid = $_GET['txid']
$results = $wallet->getDetails($txid);   //This Functions Sends The Details Back To Global Wallet Where The $txid Is Processed, Something is returned
if($results->status == 'success'){
 //The Code You Would Want To Run If The Transactions Was Successful 
}
?>

```

Thats All, Thanks For Using Global Wallet

