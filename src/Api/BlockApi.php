<?php
namespace Mccaulay\Bitcoin\Api;

class BlockApi extends Api
{
    /**
     * Gets the header hash of the most recent block on the best block chain.
     *
     * @return string
     */
    public function getBestBlockHash()
    {
        return $this->request('getBestBlockHash');
    }
}
