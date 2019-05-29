<?php
namespace McCaulay\Bitcoin\Api;

class WalletApi extends Api
{
    /**
     * Marks an in-wallet transaction and all its in-wallet descendants as abandoned.
     * This allows their inputs to be respent.
     *
     * @see https://bitcoin.org/en/developer-reference#abandontransaction
     * @param string $transactionId The transaction id of the transaction that
     * you want to abandon. The transaction id must be encoded as hex in RPC
     * byte order.
     * @return void
     */
    public function abandonTransaction(string $transactionId): void
    {
        $this->request('abandonTransaction', [$transactionId]);
    }

    /**
     * Adds a P2SH multisig address to the wallet.
     *
     * @see https://bitcoin.org/en/developer-reference#addmultisigaddress
     * @param int $required The minimum (m) number of signatures required to
     * spend this m-of-n multisig script.
     * @param array|string $addresses An array of strings with each string being
     * a public key or address.
     * @param string $account The account name in which the address should be
     * stored. Default is the default account, “” (an empty string).
     * @return string
     */
    public function addMultiSigAddress(int $required, $addresses, string $account = null): string
    {
        $parameters = [$required, $addresses];
        if ($account != null) {
            $parameters[] = $account;
        }
        return $this->request('addMultiSigAddress', $parameters);
    }

    /**
     * Safely copies wallet.dat to the specified file, which can be a directory
     * or a path with filename.
     *
     * @see https://bitcoin.org/en/developer-reference#backupwallet
     * @param string $destination A filename or directory name. If a filename,
     * it will be created or overwritten. If a directory name, the file wallet.dat
     * will be created or overwritten within that directory.
     * @return void
     */
    public function backupWallet(string $destination): void
    {
        $this->request('backupWallet', [$destination]);
    }

    /**
     * Gets the wallet-import-format (WIF) private key corresponding to an address.
     * (But does not remove it from the wallet.)
     *
     * @see https://bitcoin.org/en/developer-reference#dumpprivkey
     * @param string $address The P2PKH address corresponding to the private key
     * you want returned. Must be the address corresponding to a private key in
     * this wallet.
     * @return string
     */
    public function dumpPrivKey(string $address): string
    {
        return $this->request('dumpPrivKey', [$address]);
    }

    /**
     * Creates or overwrites a file with all wallet keys in a human-readable format.
     *
     * @see https://bitcoin.org/en/developer-reference#dumpwallet
     * @param string $address The file in which the wallet dump will be placed.
     * May be prefaced by an absolute file path. An existing file with that name
     * will be overwritten.
     * @return void
     */
    public function dumpWallet(string $filename): void
    {
        $this->request('dumpWallet', [$filename]);
    }

    /**
     * Encrypts the wallet with a passphrase. This is only to enable encryption
     * for the first time. After encryption is enabled, you will need to enter
     * the passphrase to use private keys.
     *
     * If using this RPC on the command line, remember that your shell probably
     * saves your command lines (including the value of the passphrase parameter).
     * In addition, there is no RPC to completely disable encryption. If you want
     * to return to an unencrypted wallet, you must create a new wallet and
     * restore your data from a backup made with the dumpwallet RPC.
     *
     * @see https://bitcoin.org/en/developer-reference#encryptwallet
     * @param string $passphrase The passphrase to use for the encrypted wallet.
     * Must be at least one character.
     * @return string
     */
    public function encryptWallet(string $passphrase): string
    {
        return $this->request('encryptWallet', [$passphrase]);
    }

    /**
     * Gets the name of the account associated with the given address.
     *
     * @see https://bitcoin.org/en/developer-reference#getaccount
     * @param string $address A P2PKH or P2SH Bitcoin address belonging either
     * to a specific account or the default account (“”).
     * @return string
     */
    public function getAccount(string $address): string
    {
        return $this->request('getAccount', [$address]);
    }

    /**
     * Gets a list of every address assigned to a particular account.
     *
     * @see https://bitcoin.org/en/developer-reference#getaddressesbyaccount
     * @param string $account The name of the account containing the addresses
     * to get. To get addresses from the default account, pass an empty string (“”).
     * @return array
     */
    public function getAddressesByAccount(string $account = ""): array
    {
        return $this->request('getAddressesByAccount', [$account]);
    }

    /**
     * Gets the balance in decimal bitcoins across all accounts or for a
     * particular account.
     *
     * @see https://bitcoin.org/en/developer-reference#getbalance
     * @param string $accountName The name of an account to get the balance for.
     * An empty string (“”) is the default account. The string * will get the
     * balance for all accounts (this is the default behavior)
     * @return double
     */
    public function getBalance(string $accountName = null): double
    {
        return $this->request('getBalance', $accountName == null ? [] : [$accountName]);
    }

    /**
     * Gets a new Bitcoin address for receiving payments. If an account is
     * specified, payments received with the address will be credited to that
     * account.
     *
     * @see https://bitcoin.org/en/developer-reference#getnewaddress
     * @param string $accountName The name of the account to put the address in.
     * The default is the default account, an empty string (“”)
     * @param string $addressType The address type to use. Options are ‘legacy’,
     * ‘p2sh-segwit’, and ‘bech32’. Default is set by -addresstype.
     * @return string
     */
    public function getNewAddress(string $accountName = null, string $addressType = null): string
    {
        $parameters = [];
        if ($accountName != null) {
            $parameters[] = $accountName;
        }
        if ($addressType != null) {
            $parameters[] = $addressType;
        }
        return $this->request('getNewAddress', $parameters);
    }

    /**
     * Gets a new Bitcoin address for receiving change. This is for use with raw
     * transactions, not normal use.
     *
     * @see https://bitcoin.org/en/developer-reference#getrawchangeaddress
     * @return string
     */
    public function getRawChangeAddress(): string
    {
        return $this->request('getRawChangeAddress');
    }

    /**
     * Gets  the total amount received by the specified address in transactions
     * with the specified number of confirmations. It does not count coinbase
     * transactions.
     *
     * @see https://bitcoin.org/en/developer-reference#getreceivedbyaddress
     * @param $address The address whose transactions should be tallied.
     * @return double
     */
    public function getReceivedByAddress(string $address): double
    {
        return $this->request('getReceivedByAddress', [$address]);
    }

    /**
     * Gets detailed information about the wallet transaction.
     *
     * @see https://bitcoin.org/en/developer-reference#gettransaction
     * @param string $transactionId The transaction id of the transaction to get
     * details about. The transaction id must be encoded as hex in RPC byte order.
     * @return object|array
     */
    public function getTransaction(string $transactionId)
    {
        return $this->request('getTransaction', [$transactionId]);
    }

    /**
     * Gets the wallet’s total unconfirmed balance.
     *
     * @see https://bitcoin.org/en/developer-reference#getunconfirmedbalance
     * @return double
     */
    public function getUnconfirmedBalance(): double
    {
        return $this->request('getUnconfirmedBalance');
    }

    /**
     * Gets the wallet’s total unconfirmed balance.
     *
     * @see https://bitcoin.org/en/developer-reference#getwalletinfo
     * @return object|array
     */
    public function getWalletInfo()
    {
        return $this->request('getWalletInfo');
    }

    /**
     * Adds an address or pubkey script to the wallet without the associated
     * private key, allowing you to watch for transactions affecting that address
     * or pubkey script without being able to spend any of its outputs.
     *
     * @see https://bitcoin.org/en/developer-reference#importaddress
     * @param $address Either a P2PKH or P2SH address encoded in
     * base58check, or a pubkey script encoded as hex.
     * @param $account An account name into which the address should be placed.
     * Default is the default account, an empty string(“”).
     * @param $rescan Set to true (the default) to rescan the entire local block
     * database for transactions affecting any address or pubkey script in the
     * wallet (including transaction affecting the newly-added address or pubkey
     * script). Set to false to not rescan the block database (rescanning can be
     * performed at any time by restarting Bitcoin Core with the -rescan
     * command-line argument). Rescanning may take several minutes.
     * @return void
     */
    public function importAddress(string $address, string $account = null, bool $rescan = null): void
    {
        $parameters = [$address];
        if ($account != null) {
            $parameters[] = $account;
        }
        if ($rescan != null) {
            $parameters[] = $rescan;
        }
        $this->request('importAddress', $parameters);
    }

    /**
     * Imports addresses or scripts (with private keys, public keys, or P2SH
     * redeem scripts) and optionally performs the minimum necessary rescan for
     * all imports.
     *
     * @see https://bitcoin.org/en/developer-reference#importmulti
     * @param $imports An array of JSON objects, each one being an address or
     * script to be imported.
     * @param $options
     * @return object|array
     */
    public function importMulti(array $imports, array $options = null)
    {
        $parameters = [$imports];
        if ($options != null) {
            $parameters[] = $options;
        }
        $this->request('importMulti', $parameters);
    }

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
