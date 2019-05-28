<?php
namespace McCaulay\Bitcoin\Api;

class BlockchainApi extends Api
{
    /**
     * Gets the header hash of the most recent block on the best block chain.
     *
     * @see https://bitcoin.org/en/developer-reference#getbestblockhash
     * @return string
     */
    public function getBestBlockHash(): string
    {
        return $this->request('getBestBlockHash');
    }

    /**
     * Gets a block with a particular header hash from the local block database.
     *
     * @see https://bitcoin.org/en/developer-reference#getblock
     * @param $hash The hash of the header of the block to get, encoded as hex
     * in RPC byte order.
     * @param $verbosity Set to 0 to get the block in serialized block format;
     * Set to 1 (the default) to get the decoded block as a JSON object;
     * Set to 2 to get the decoded block as a JSON object with verbose
     * transaction decoding.
     * @return string
     */
    public function getBlock(string $hash, int $verbosity = 1): string
    {
        return $this->request('getBlock', [$hash, $verbosity]);
    }

    /**
     * Get the current state of the block chain.
     *
     * @see https://bitcoin.org/en/developer-reference#getblockchaininfo
     * @return object|array
     */
    public function getBlockChainInfo()
    {
        return $this->request('getBlockChainInfo');
    }

    /**
     * Gets the number of blocks in the local best block chain.
     *
     * @see https://bitcoin.org/en/developer-reference#getblockcount
     * @return int
     */
    public function getBlockCount(): int
    {
        return $this->request('getBlockCount');
    }

    /**
     * Gets the header hash of a block at the given height in the local best
     * block chain.
     *
     * @see https://bitcoin.org/en/developer-reference#getblockhash
     * @param $blockHeight The height of the block whose header hash should be
     * returned. The height of the hardcoded genesis block is 0.
     * @return string
     */
    public function getBlockHash(int $blockHeight): string
    {
        return $this->request('getBlockHash', [$blockHeight]);
    }

    /**
     * Gets a block header with a particular header hash from the local block
     * database.
     *
     * @see https://bitcoin.org/en/developer-reference#getblockheader
     * @param $headerHash The hash of the block header to get, encoded as hex in
     * RPC byte order.
     * @return object|array
     */
    public function getBlockHeader(string $headerHash)
    {
        return $this->request('getBlockHeader', [$headerHash]);
    }

    /**
     * Gets information about the highest-height block (tip) of each local block
     * chain.
     *
     * @see https://bitcoin.org/en/developer-reference#getchaintips
     * @return array
     */
    public function getChainTips(): array
    {
        return $this->request('getChainTips');
    }

    /**
     * Gets the difficulty of creating a block with the same target threshold
     * (nBits) as the highest-height block in the local best block chain.
     * The number is a multiple of the minimum difficulty.
     *
     * @see https://bitcoin.org/en/developer-reference#getdifficulty
     * @return float
     */
    public function getDifficulty(): float
    {
        return $this->request('getDifficulty');
    }

    /**
     * Gets all in-mempool ancestors for a transaction in the mempool.
     *
     * @see https://bitcoin.org/en/developer-reference#getmempoolancestors
     * @param $transactionId The transaction id of the transaction. The
     * transaction id must be encoded as hex in RPC byte order.
     * @return array
     */
    public function getMemPoolAncestors(string $transactionId): array
    {
        return $this->request('getMemPoolAncestors', [$transactionId]);
    }

    /**
     * Gets all in-mempool descendants for a transaction in the mempool.
     *
     * @see https://bitcoin.org/en/developer-reference#getmempooldescendants
     * @param $transactionId The transaction id of the transaction. The
     * transaction id must be encoded as hex in RPC byte order.
     * @return array
     */
    public function getMemPoolDescendants(string $transactionId): array
    {
        return $this->request('getMemPoolDescendants', [$transactionId]);
    }

    /**
     * Gets mempool data for given transaction (must be in mempool).
     *
     * @see https://bitcoin.org/en/developer-reference#getmempoolentry
     * @param $transactionId The transaction id of the transaction. The
     * transaction id must be encoded as hex in RPC byte order.
     * @return object|array
     */
    public function getMemPoolEntry(string $transactionId)
    {
        return $this->request('getMemPoolEntry', [$transactionId]);
    }

    /**
     * Gets information about the node’s current transaction memory pool.
     *
     * @see https://bitcoin.org/en/developer-reference#getmempoolinfo
     * @return object|array
     */
    public function getMemPoolInfo()
    {
        return $this->request('getMemPoolInfo');
    }

    /**
     * Gets all transaction identifiers (TXIDs) in the memory pool as a array.
     *
     * @see https://bitcoin.org/en/developer-reference#getrawmempool
     * @return array
     */
    public function getRawMemPool(): array
    {
        return $this->request('getRawMemPool');
    }

    /**
     * Gets details about an unspent transaction output (UTXO).
     *
     * @see https://bitcoin.org/en/developer-reference#gettxout
     * @param $transactionId The transaction id of the transaction. The
     * transaction id must be encoded as hex in RPC byte order.
     * @param $vout The output index number (vout) of the output within the
     * transaction; the first output in a transaction is vout 0.
     * @param $unconfirmed Set to true to display unconfirmed outputs from the
     * memory pool; set to false (the default) to only display outputs from
     * confirmed transactions.
     * @return object|array
     */
    public function getTxOut(string $transactionId, int $vout, bool $unconfirmed = false)
    {
        return $this->request('getTxOut', [$transactionId, $vout, $unconfirmed]);
    }

    /**
     * Gets a hex-encoded proof that one or more specified transactions were
     * included in a block.
     *
     * @see https://bitcoin.org/en/developer-reference#gettxoutproof
     * @param $transactionIds An array of transaction ids of the transactions to
     * generate proof for. All transactions must be in the same block.
     * @param $headerHash If specified, looks for txid in the block with this hash.
     * @return string
     */
    public function getTxOutProof(array $transactionIds, string $headerHash = null): string
    {
        $parameters = [$transactionIds];
        if ($headerHash != null) {
            $parameters[] = $headerHash;
        }
        return $this->request('getTxOutProof', $parameters);
    }

    /**
     * Gets statistics about the confirmed unspent transaction output (UTXO) set.
     * Note that this call may take some time and that it only counts outputs
     * from confirmed transactions—it does not count outputs from the memory pool.
     *
     * @see https://bitcoin.org/en/developer-reference#gettxoutsetinfo
     * @return object|array
     */
    public function getTxOutSetInfo()
    {
        return $this->request('getTxOutSetInfo');
    }

    /**
     * The preciousblock RPC treats a block as if it were received before others
     * with the same work. A later preciousblock call can override the effect of
     * an earlier one. The effects of preciousblock are not retained across restarts.
     *
     * @see https://bitcoin.org/en/developer-reference#preciousblock
     * @param $headerHash The hash of the block to mark as precious.
     * @return void
     */
    public function preciousBlock(string $headerHash): void
    {
        $this->request('preciousBlock', [$headerHash]);
    }

    /**
     * Prunes the blockchain up to a specified height or timestamp. The -prune
     * option needs to be enabled (disabled by default).
     *
     * @see https://bitcoin.org/en/developer-reference#pruneblockchain
     * @param $height The block height to prune up to. May be set to a particular
     * height, or a unix timestamp to prune blocks whose block time is at least
     * 2 hours older than the provided timestamp.
     * @return int
     */
    public function pruneBlockChain(int $height): int
    {
        return $this->request('pruneBlockChain', [$height]);
    }

    /**
     * Verifies each entry in the local block chain database.
     *
     * @see https://bitcoin.org/en/developer-reference#verifychain
     * @param $checkLevel How thoroughly to check each block, from 0 to 4.
     * Default is the level set with the -checklevel command line argument;
     * if that isn’t set, the default is 3. Each higher level includes the
     * tests from the lower levels.
     *
     * Levels are:
     * 0. Read from disk to ensure the files are accessible
     * 1. Ensure each block is valid
     * 2. Make sure undo files can be read from disk and are in a valid format
     * 3. Test each block undo to ensure it results in correct state
     * 4. After undoing blocks, reconnect them to ensure they reconnect correctly
     * @param $blockCount The number of blocks to verify. Set to 0 to check all
     * blocks. Defaults to the value of the -checkblocks command-line argument;
     * if that isn’t set, the default is 288.
     * @return bool
     */
    public function verifyChain(int $checkLevel = 3, $blockCount = null): bool
    {
        $parameters = [$checkLevel];
        if ($blockCount != null) {
            $parameters[] = $blockCount;
        }
        return $this->request('verifyChain', $parameters);
    }

    /**
     * Verifies that a proof points to one or more transactions in a block,
     * returning the transactions the proof commits to and throwing an RPC error
     * if the block is not in our best block chain.
     *
     * @see https://bitcoin.org/en/developer-reference#verifytxoutproof
     * @param $proof A hex-encoded proof.
     * @return array
     */
    public function verifyTxOutProof(string $proof): array
    {
        return $this->request('verifyTxOutProof', [$proof]);
    }
}
