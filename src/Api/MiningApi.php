<?php
namespace McCaulay\Bitcoin\Api;

class MiningApi extends Api
{
    /**
     * Gets a block template or proposal for use with mining software.
     *
     * @see https://bitcoin.org/en/developer-reference#getblocktemplate
     * @param $data
     * @return object|array
     */
    public function getBlockTemplate(array $data)
    {
        return $this->request('getBlockTemplate', [$data]);
    }

    /**
     * Gets various mining-related information such as the number of blocks
     * and the difficulty.
     *
     * @see https://bitcoin.org/en/developer-reference#getmininginfo
     * @return object|array
     */
    public function getMiningInfo()
    {
        return $this->request('getMiningInfo');
    }

    /**
     * Gets the estimated current or historical network hashes per second based
     * on the last n blocks.
     *
     * @see https://bitcoin.org/en/developer-reference#getnetworkhashps
     * @param $blocks The number of blocks to average together for calculating
     * the estimated hashes per second. Default is 120. Use -1 to average all
     * blocks produced since the last difficulty change.
     * @param $height The height of the last block to use for calculating the
     * average. Defaults to -1 for the highest-height block on the local best
     * block chain. If the specified height is higher than the highest block on
     * the local best block chain, it will be interpreted the same as -1.
     * @return object|array
     */
    public function getNetworkHashPerSecond(int $blocks = 120, int $height = -1)
    {
        return $this->request('getNetworkHashps', [$blocks, $height]);
    }

    /**
     * Adds virtual priority or fee to a transaction, allowing it to be accepted
     * into blocks mined by this node (or miners which use this node) with a
     * lower priority or fee.
     *
     * @see https://bitcoin.org/en/developer-reference#prioritisetransaction
     * @param $transactionId The transaction id of the transaction whose virtual
     * priority or fee you want to modify, encoded as hex in RPC byte order.
     * @param $priority If positive, the priority to add to the transaction in
     * addition to its computed priority; if negative, the priority to subtract
     * from the transaction’s computed priory. Computed priority is the age of
     * each input in days since it was added to the block chain as an output
     * (coinage) times the value of the input in satoshis (value) divided by the
     * size of the serialized transaction (size), which is coinage * value / size.
     * @param $fee <b>Warning</b>: this value is in satoshis, not bitcoins.
     * If positive, the virtual fee to add to the actual fee paid by
     * the transaction; if negative, the virtual fee to subtract from the actual
     * fee paid by the transaction. No change is made to the actual fee paid by
     * the transaction.
     * @return void
     */
    public function prioritiseTransaction(string $transactionId, float $priority, int $fee): void
    {
        $this->request('prioritiseTransaction', [$transactionId, $priority, $fee]);
    }

    /**
     * Accepts a block, verifies it is a valid addition to the block chain, and
     * broadcasts it to the network. Extra parameters are ignored by Bitcoin Core
     * but may be used by mining pools or other programs.
     *
     * @see https://bitcoin.org/en/developer-reference#submitblock
     * @param $block The full block to submit in serialized block format as hex.
     * @param $parameters A JSON object containing extra parameters. Not used
     * directly by Bitcoin Core and also not broadcast to the network. This is
     * available for use by mining pools and other software. A common parameter
     * is a workid string.
     * @return void
     */
    public function submitBlock(string $block, array $parameters = []): void
    {
        $this->request('submitBlock', [$block, $parameters]);
    }
}
