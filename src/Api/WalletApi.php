<?php
namespace McCaulay\Bitcoin\Api;

class WalletApi extends Api
{
    // == Wallet ==
    // abandontransaction "txid"
    // abortrescan
    // addmultisigaddress nrequired ["key",...] ( "label" )
    // backupwallet "destination"
    // dumpprivkey "address"
    // dumpwallet "filename"
    // encryptwallet "passphrase"
    // getaccount "address"
    // getlabeladdress "label"
    // getaddressesbyaccount "account"

    /**
     * Gets the balance in decimal bitcoins across all accounts or for a
     * particular account.
     *
     * @see https://bitcoin.org/en/developer-reference#getbalance
     * @param  string  $accountName
     * @return double
     */
    public function getBalance(string $accountName = "")
    {
        return $this->request('getBalance', empty($accountName) ? [] : [$accountName]);
    }

    // getnewaddress ( "label" )
    // getrawchangeaddress
    // getreceivedbylabel "label" ( minconf )
    // getreceivedbyaddress "address" ( minconf )

    /**
     * Gets detailed information about the wallet transaction.
     *
     * @see https://bitcoin.org/en/developer-reference#gettransaction
     * @param  string  $transactionId
     * @return object|array
     */
    public function getTransaction(string $transactionId)
    {
        return $this->request('getTransaction', [$transactionId]);
    }

    // getunconfirmedbalance
    // getwalletinfo
    // importaddress "address" ( "label" rescan p2sh )
    // importmulti "requests" ( "options" )
    // importprivkey "privkey" ( "label" ) ( rescan )
    // importprunedfunds
    // importpubkey "pubkey" ( "label" rescan )
    // importwallet "filename"
    // keypoolrefill ( newsize )
    // listaccounts ( minconf include_watchonly)
    // listaddressgroupings
    // listlockunspent
    // listreceivedbylabel ( minconf include_empty include_watchonly)
    // listreceivedbyaddress ( minconf include_empty include_watchonly address_filter )
    // listsinceblock ( "blockhash" target_confirmations include_watchonly include_removed )
    // listtransactions ( "account" count skip include_watchonly)
    // listunspent ( minconf maxconf  ["addresses",...] [include_unsafe] [query_options])
    // listwallets
    // lockunspent unlock ([{"txid":"txid","vout":n},...])
    // move "fromaccount" "toaccount" amount ( minconf "comment" )
    // removeprunedfunds "txid"
    // rescanblockchain ("start_height") ("stop_height")
    // sendfrom "fromaccount" "toaddress" amount ( minconf "comment" "comment_to" )
    // sendmany "fromaccount" {"address":amount,...} ( minconf "comment" ["address",...] )
    // sendtoaddress "address" amount ( "comment" "comment_to" subtractfeefromamount )
    // setlabel "address" "label"
    // settxfee amount
    // signmessage "address" "message"
    // signrawtransactionwithwallet "hexstring" ( [{"txid":"id","vout":n,"scriptPubKey":"hex","redeemScript":"hex"},...] sighashtype )
}
