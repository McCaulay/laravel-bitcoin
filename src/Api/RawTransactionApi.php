<?php
namespace McCaulay\Bitcoin\Api;

class RawTransactionApi extends Api
{
    /**
     * Creates an unsigned serialized transaction that spends a previous output
     * to a new output with a P2PKH or P2SH address. The transaction is not
     * stored in the wallet or transmitted to the network.
     *
     * @see https://bitcoin.org/en/developer-reference#createrawtransaction
     * @param $inputs An array of objects, each one to be used as an input to
     * the transaction. Each input has a txid (transaction id) and vout.
     * @param $outputs The addresses and amounts to pay as an array of key/pair
     * values. address:amount.
     * @param $locktime Indicates the earliest time a transaction can be added
     * to the block chain.
     * @return string
     */
    public function createRawTransaction(array $inputs, array $outputs, int $locktime = null): string
    {
        $parameters = [$inputs, $outputs];
        if ($locktime != null) {
            $parameters[] = $locktime;
        }
        return $this->request('createRawTransaction', $parameters);
    }

    /**
     * Decodes a serialized transaction hex string into a JSON object describing
     * the transaction.
     *
     * @see https://bitcoin.org/en/developer-reference#decoderawtransaction
     * @param $transaction The transaction to decode in serialized transaction format.
     * @return object|array
     */
    public function decodeRawTransaction(string $transaction)
    {
        return $this->request('decodeRawTransaction', [$transaction]);
    }

    /**
     * Decodes a hex-encoded P2SH redeem script.
     *
     * @see https://bitcoin.org/en/developer-reference#decoderawtransaction
     * @param $script The redeem script to decode as a hex-encoded serialized script.
     * @return object|array
     */
    public function decodeScript(string $script)
    {
        return $this->request('decodeScript', [$script]);
    }

    /**
     * Adds inputs to a transaction until it has enough in value to meet its out
     * value. This will not modify existing inputs, and will add one change output
     * to the outputs. Note that inputs which were signed may need to be resigned
     * after completion since in/outputs have been added. The inputs added will
     * not be signed, use signrawtransaction for that. All existing inputs must
     * have their previous output transaction be in the wallet.
     *
     * @see https://bitcoin.org/en/developer-reference#fundrawtransaction
     * @param $hex The hex string of the raw transaction.
     * @param $options
     * @return object|array
     */
    public function fundRawTransaction(string $hex, array $options = [])
    {
        return $this->request('fundRawTransaction', [$hex, $options]);
    }

    /**
     * Gets a hex-encoded serialized transaction or a JSON object describing
     * the transaction. By default, Bitcoin Core only stores complete transaction
     * data for UTXOs and your own transactions, so the RPC may fail on historic
     * transactions unless you use the non-default txindex=1 in your Bitcoin
     * Core startup settings.
     *
     * @see https://bitcoin.org/en/developer-reference#getrawtransaction
     * @param $transactionId The transaction id of the transaction to get,
     * encoded as hex in RPC byte order.
     * @return object|array
     */
    public function getRawTransaction(string $transactionId)
    {
        return $this->request('getRawTransaction', [$transactionId]);
    }

    /**
     * Validates a transaction and broadcasts it to the peer-to-peer network.
     *
     * @see https://bitcoin.org/en/developer-reference#sendrawtransaction
     * @param $transaction The serialized transaction to broadcast encoded as hex.
     * @param $allowHighFees Set to true to allow the transaction to pay a high
     * transaction fee. Set to false (the default) to prevent Bitcoin Core from
     * broadcasting the transaction if it includes a high fee. Transaction fees
     * are the sum of the inputs minus the sum of the outputs, so this high fees
     * check helps ensures user including a change address to return most of the
     * difference back to themselves.
     * @return string
     */
    public function sendRawTransaction(string $transaction, bool $allowHighFees = false): string
    {
        return $this->request('sendRawTransaction', [$transaction, $allowHighFees]);
    }
}
