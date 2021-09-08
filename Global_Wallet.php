<?php
class global_wallet{
    /**
     * Delcaring Needed Variables
     */
    //Merchant Details
    public $merchant_account;
    public $merchant_key;

    // Order Details
    public $item_number;
    public $item_name;
    public $item_price;
    public $item_currency;

    //return url
    public $return_success;
    public $return_fail;
    public $return_cancel;

    /**
     * Function Used to set Values For The Merchant
     * @param mixed $merchant_account Merchant Email-address
     * @param mixed $merchant_key Got From Merchant Dashboard, Must Be Present To Retreive IPN
     */

    public function setMerchant($merchant_account,$merchant_key=0)
    {
        $this->merchant_account = $merchant_account;
        $this->merchant_key = $merchant_key;
        return $this;
    }


    /**
     * Function Used to set Values To Globalwallet url
     * @param mixed $item_number The Id Number Of Order
     * @param mixed $item_name The Name Of Items Used, More Than 1, Insert A lot
     * @param mixed $item_price The Amount Of The Order Without The The Currency
     * @param mixed $item_currency The Currency, 3-Letters in Capital
     */
    public function setOrder($item_number,$item_name,$item_price,$item_currency)
    {
        $this->item_number = $item_number;
        $this->item_name = $item_name;
        $this->item_price = $item_price;
        $this->item_currency = $item_currency; 
        return $this;
    }
    /**
     * Setting Urls
     * @param mixed $return_success Url When Transaction is Successful, If The Success_url Is the Same Page (advised), Please call the recall function all read 
     * http://globalwallet.hicf.online/merchant to know how to set an ipn, $merchant_id should not be null for recall function to work
     * @param mixed $return_fail Url used if the Transaction Had Failed, No Data is Sent For Verification
     * @param mixed $return_cancel Url Used If The user had cancelled The Transaction Or An error had occured
     */
    public function setUrl($return_success,$return_fail,$return_cancel)
    {
        $this->return_success = $return_success;
        $this->return_fail = $return_fail;
        $this->return_cancel = $return_cancel;
        return $this;
    }

    /**
     * This Is The Function That Makes The Actual Transaction, Merchant_id Not Need 
     */
    public function Pay()
    {
        $url = "https://globalwallet.hicf.online/payment-$this->merchant_account-$this->item_number-$this->item_name-$this->item_price-$this->item_currency-$this->return_success-$this->return_fail-$this->return_cancel";
        header("Location: $url");
    }
    /**
     * used To Verify The Transaction, If Payment And Verification (Success_url and The Url In Which Payment was made from is different)
     * Please Redecalre This class, First Call the setMerchant function, insert the merchant key and merchant_account there then invoke this function to get the details
     */
    public function getDetails($txid)
    {
        $verification_url = "https://globalwallet.hicf.online/payment_status.php?merchant_key=$this->merchant_key&merchant_account=$this->merchant_account&txid=$txid";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL,$verification_url);
        $results=curl_exec($ch);
        curl_close($ch);
        $results = json_decode($results);
        return $results;
    }
}