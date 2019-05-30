<?php
namespace McCaulay\Bitcoin;

use McCaulay\Bitcoin\Wallet;

class Bitcoin
{
    /**
     * Gets a bitcoin wallet.
     *
     * @param $wallet The bitcoin wallet name. A null wallet uses the default
     * bitcoin wallet.
     * @return \McCaulay\Bitcoin\Wallet
     */
    public static function getWallet(string $wallet = null)
    {
        return new Wallet($wallet);
    }
}
