<?php
namespace McCaulay\Bitcoin\Api;

class RawTransactionApi extends Api
{
    // == Rawtransactions ==
    // combinerawtransaction ["hexstring",...]
    // createrawtransaction [{"txid":"id","vout":n},...] {"address":amount,"data":"hex",...} ( locktime )
    // decoderawtransaction "hexstring"
    // decodescript "hexstring"
    // fundrawtransaction "hexstring" ( options )
    // getrawtransaction "txid" ( verbose "blockhash" )
    // sendrawtransaction "hexstring" ( allowhighfees )
    // signrawtransaction "hexstring" ( [{"txid":"id","vout":n,"scriptPubKey":"hex","redeemScript":"hex"},...] ["privatekey1",...] sighashtype )
    // signrawtransactionwithkey "hexstring" ["privatekey1",...] ( [{"txid":"id","vout":n,"scriptPubKey":"hex","redeemScript":"hex"},...] sighashtype )
}
