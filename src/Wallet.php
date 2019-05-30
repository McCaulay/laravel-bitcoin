<?php
namespace McCaulay\Bitcoin;

use McCaulay\Bitcoin\Api\WalletApi;

class Wallet
{
    /**
     * Initialise a bitcoin wallet.
     *
     * @param $name The bitcoin wallet name.
     */
    public function __constructor(string $name = null)
    {
        $this->walletApi = new WalletApi($name);
    }
}
