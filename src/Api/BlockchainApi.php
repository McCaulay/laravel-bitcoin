<?php
namespace McCaulay\Bitcoin\Api;

class BlockchainApi extends Api
{
    /**
     * Gets the header hash of the most recent block on the best block chain.
     *
     * @return string
     */
    public function getBestBlockHash(): string
    {
        return $this->request('getBestBlockHash');
    }

    /**
     * Gets a block with a particular header hash from the local block database.
     *
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
     * @return object|array
     */
    public function getBlockChainInfo()
    {
        return $this->request('getBlockChainInfo');
    }

    // getblockcount
    // getblockhash height
    // getblockheader "hash" ( verbose )
    // getchaintips
    // getchaintxstats ( nblocks blockhash )
    // getdifficulty
    // getmempoolancestors txid (verbose)
    // getmempooldescendants txid (verbose)
    // getmempoolentry txid
    // getmempoolinfo
    // getrawmempool ( verbose )
    // gettxout "txid" n ( include_mempool )
    // gettxoutproof ["txid",...] ( blockhash )
    // gettxoutsetinfo
    // preciousblock "blockhash"
    // pruneblockchain
    // savemempool
    // verifychain ( checklevel nblocks )
    // verifytxoutproof "proof"
}
