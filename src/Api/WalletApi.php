<?php
namespace McCaulay\Bitcoin\Api;

class WalletApi extends Api
{
    /**
     * Initialise a bitcoin wallet.
     *
     * @param $name The bitcoin wallet name.
     */
    public function __constructor(string $name = null)
    {
        if ($name != null) {
            $this->setPath('/wallet/' . $name);
        }
    }

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
     * @return string
     */
    public function getBalance(string $accountName = null): string
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
     * @return string
     */
    public function getReceivedByAddress(string $address): string
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
     * @return string
     */
    public function getUnconfirmedBalance(): string
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
        return $this->request('importMulti', $parameters);
    }

    /**
     * Adds a private key to your wallet. The key should be formatted in the
     * wallet import format created by the dumpprivkey RPC.
     *
     * @see https://bitcoin.org/en/developer-reference#importprivkey
     * @param $privateKey The private key to import into the wallet encoded in
     * base58check using wallet import format (WIF).
     * @param $account The name of an account to which transactions involving
     * the key should be assigned. The default is the default account, an empty
     * string (“”).
     * @param $rescan Set to true (the default) to rescan the entire local block
     * database for transactions affecting any address or pubkey script in the
     * wallet (including transaction affecting the newly-added address for this
     * private key). Set to false to not rescan the block database (rescanning
     * can be performed at any time by restarting Bitcoin Core with the -rescan
     * command-line argument). Rescanning may take several minutes. Notes: if the
     * address for this key is already in the wallet, the block database will not
     * be rescanned even if this parameter is set.
     * @return void
     */
    public function importPrivKey(string $privateKey, string $account = null, bool $rescan = null): void
    {
        $parameters = [$privateKey];
        if ($account != null) {
            $parameters[] = $account;
        }
        if ($rescan != null) {
            $parameters[] = $rescan;
        }
        $this->request('importPrivKey', $parameters);
    }

    /**
     * Imports funds without the need of a rescan. Meant for use with pruned
     * wallets. Corresponding address or script must previously be included in
     * wallet. The end-user is responsible to import additional transactions that
     * subsequently spend the imported outputs or rescan after the point in the
     * blockchain the transaction is included.
     *
     * @see https://bitcoin.org/en/developer-reference#importprunedfunds
     * @param $privateKey A raw transaction in hex funding an already-existing
     * address in wallet.
     * @param $account The hex output from gettxoutproof that contains the transaction.
     * @return void
     */
    public function importPrunedFunds(string $rawTransaction, string $txOutProof): void
    {
        $this->request('importPrunedFunds', [$rawTransaction, $txOutProof]);
    }

    /**
     * Imports private keys from a file in wallet dump file format (see the
     * dumpwallet RPC). These keys will be added to the keys currently in the wallet.
     * This call may need to rescan all or parts of the block chain for transactions
     * affecting the newly-added keys, which may take several minutes.
     *
     * @see https://bitcoin.org/en/developer-reference#importwallet
     * @param $file The file to import. The path is relative to Bitcoin Core’s
     * working directory
     * @return void
     */
    public function importWallet(string $file): void
    {
        $this->request('importWallet', [$file]);
    }

    /**
     * Fills the cache of unused pre-generated keys (the keypool).
     *
     * @see https://bitcoin.org/en/developer-reference#keypoolrefill
     * @param $size The new size of the keypool; if the number of keys in the
     * keypool is less than this number, new keys will be generated. Default is
     * 100. The value 0 also equals the default. The value specified is for this
     * call only—the default keypool size is not changed.
     * @return void
     */
    public function keyPoolRefill(int $size = null): void
    {
        $this->request('keyPoolRefill', $size == null ? [] : [$size]);
    }

    /**
     * Lists groups of addresses that may have had their common ownership made
     * public by common use as inputs in the same transaction or from being used
     * as change from a previous transaction.
     *
     * @see https://bitcoin.org/en/developer-reference#listaddressgroupings
     * @return array
     */
    public function listAddressGroupings(): array
    {
        return $this->request('listAddressGroupings');
    }

    /**
     * Gets a list of temporarily unspendable (locked) outputs.
     *
     * @see https://bitcoin.org/en/developer-reference#listlockunspent
     * @return array
     */
    public function listLockUnspent(): array
    {
        return $this->request('listLockUnspent');
    }

    /**
     * Lists the total number of bitcoins received by each address.
     *
     * @see https://bitcoin.org/en/developer-reference#listreceivedbyaddress
     * @param $confirmations The minimum number of confirmations an
     * externally-generated transaction must have before it is counted towards
     * the balance. Transactions generated by this node are counted immediately.
     * Typically, externally-generated transactions are payments to this wallet
     * and transactions generated by this node are payments to other wallets.
     * Use 0 to count unconfirmed transactions. Default is 1
     * @param $includeEmpty Set to true to display accounts which have never
     * received a payment. Set to false (the default) to only include accounts
     * which have received a payment. Any account which has received a payment
     * will be displayed even if its current balance is 0.
     * @param $watchOnly If set to true, include watch-only addresses in details
     * and calculations as if they were regular addresses belonging to the wallet.
     * If set to false (the default), treat watch-only addresses as if they didn’t
     * belong to this wallet.
     * @return array
     */
    public function listReceivedByAddress(int $confirmations = null, bool $includeEmpty = null, bool $watchOnly = null): array
    {
        $parameters = [];
        if ($confirmations != null) {
            $parameters[] = $confirmations;
        }
        if ($includeEmpty != null) {
            $parameters[] = $includeEmpty;
        }
        if ($watchOnly != null) {
            $parameters[] = $watchOnly;
        }
        return $this->request('listReceivedByAddress', $parameters);
    }

    /**
     * Gets all transactions affecting the wallet which have occurred since a
     * particular block, plus the header hash of a block at a particular depth.
     *
     * @see https://bitcoin.org/en/developer-reference#listsinceblock
     * @param $hash The hash of a block header encoded as hex in RPC byte order.
     * All transactions affecting the wallet which are not in that block or any
     * earlier block will be returned, including unconfirmed transactions. Default
     * is the hash of the genesis block, so all transactions affecting the wallet
     * are returned by default.
     * @param $targetConfirmations Sets the lastblock field of the results to the
     * header hash of a block with this many confirmations. This does not affect
     * which transactions are returned. Default is 1, so the hash of the most
     * recent block on the local best block chain is returned.
     * @param $watchOnly If set to true, include watch-only addresses in details
     * and calculations as if they were regular addresses belonging to the wallet.
     * If set to false (the default), treat watch-only addresses as if they
     * didn’t belong to this wallet.
     * @return object|array
     */
    public function listSinceBlock(string $hash = null, int $targetConfirmations = null, bool $watchOnly = null)
    {
        $parameters = [];
        if ($hash != null) {
            $parameters[] = $hash;
        }
        if ($targetConfirmations != null) {
            $parameters[] = $targetConfirmations;
        }
        if ($watchOnly != null) {
            $parameters[] = $watchOnly;
        }
        return $this->request('listSinceBlock', $parameters);
    }

    /**
     * Gets the most recent transactions that affect the wallet.
     *
     * @see https://bitcoin.org/en/developer-reference#listtransactions
     * @param $account The name of an account to get transactinos from. Use an
     * empty string (“”) to get transactions for the default account. Default is
     * * to get transactions for all accounts.
     * @param $count The number of the most recent transactions to list. Default
     * is 10.
     * @param $skip The number of the most recent transactions which should not
     * be returned. Allows for pagination of results. Default is 0.
     * @param $watchOnly If set to true, include watch-only addresses in details
     * and calculations as if they were regular addresses belonging to the wallet.
     * If set to false (the default), treat watch-only addresses as if they didn’t
     * belong to this wallet.
     * @return array
     */
    public function listTransactions(string $account = null, int $count = null, int $skip = null, bool $watchOnly = null): array
    {
        $parameters = [];
        if ($account != null) {
            $parameters[] = $account;
        }
        if ($count != null) {
            $parameters[] = $count;
        }
        if ($skip != null) {
            $parameters[] = $skip;
        }
        if ($watchOnly != null) {
            $parameters[] = $watchOnly;
        }
        return $this->request('listTransactions', $parameters);
    }

    /**
     * Gets  an array of unspent transaction outputs belonging to this wallet.
     * Note: as of Bitcoin Core 0.10.0, outputs affecting watch-only addresses
     * will be returned; see the spendable field in the results described below.
     *
     * @see https://bitcoin.org/en/developer-reference#listunspent
     * @param $minConfirmations The minimum number of confirmations the
     * transaction containing an output must have in order to be returned. Use 0
     * to return outputs from unconfirmed transactions. Default is 1.
     * @param $maxConfirmations The maximum number of confirmations the
     * transaction containing an output may have in order to be returned. Default
     * is 9999999 (~10 million).
     * @param $addresses If present, only outputs which pay an address in this
     * array will be returned.
     * @return array
     */
    public function listUnspent(int $minConfirmations = null, int $maxConfirmations = null, array $addresses = null): array
    {
        $parameters = [];
        if ($minConfirmations != null) {
            $parameters[] = $minConfirmations;
        }
        if ($maxConfirmations != null) {
            $parameters[] = $maxConfirmations;
        }
        if ($addresses != null) {
            $parameters[] = $addresses;
        }
        return $this->request('listUnspent', $parameters);
    }

    /**
     * Temporarily locks or unlocks specified transaction outputs. A locked
     * transaction output will not be chosen by automatic coin selection when
     * spending bitcoins. Locks are stored in memory only, so nodes start with
     * zero locked outputs and the locked output list is always cleared when a
     * node stops or fails.
     *
     * @see https://bitcoin.org/en/developer-reference#lockunspent
     * @param $unlock Set to false to lock the outputs specified in the following
     * parameter. Set to true to unlock the outputs specified. If this is the only
     * argument specified and it is set to true, all outputs will be unlocked;
     * if it is the only argument and is set to false, there will be no change.
     * @param $outputs An array of outputs to lock or unlock.
     * @return bool
     */
    public function lockUnspent(bool $unlock, array $outputs = null): bool
    {
        $parameters = [$unlock];
        if ($outputs != null) {
            $parameters[] = $outputs;
        }
        return $this->request('lockUnspent', $parameters);
    }

    /**
     * Deletes the specified transaction from the wallet. Meant for use with
     * pruned wallets and as a companion to importprunedfunds. This will effect
     * wallet balances.
     *
     * @see https://bitcoin.org/en/developer-reference#removeprunedfunds
     * @param $transactionId The hex-encoded id of the transaction you are removing.
     * @return void
     */
    public function removePrunedFunds(string $transactionId): void
    {
        $this->request('removePrunedFunds', [$transactionId]);
    }

    /**
     * Creates and broadcasts a transaction which sends outputs to multiple
     * addresses.
     *
     * @see https://bitcoin.org/en/developer-reference#sendmany
     * @param $fromAccount The name of the account from which the bitcoins should
     * be spent. Use an empty string (“”) for the default account. Bitcoin Core
     * will ensure the account has sufficient bitcoins to pay the total amount
     * in the outputs field described below (but the transaction fee paid is not
     * included in the calculation, so an account can spend a total of its balance
     * plus the transaction fee).
     * @param $outputs An object containing key/value pairs corresponding to the
     * addresses and amounts to pay.
     * @param $confirmations The minimum number of confirmations an incoming
     * transaction must have for its outputs to be credited to this account’s
     * balance. Outgoing transactions are always counted, as are move transactions
     * made with the move RPC. If an account doesn’t have a balance high enough
     * to pay for this transaction, the payment will be rejected. Use 0 to spend
     * unconfirmed incoming payments. Default is 1.
     * @param $comment A locally-stored (not broadcast) comment assigned to this
     * transaction. Default is no comment.
     * @param $address An array of addresses. The fee will be equally divided by
     * as many addresses as are entries in this array and subtracted from each
     * address. If this array is empty or not provided, the fee will be paid by
     * the sender.
     * @return string
     */
    public function sendMany(string $fromAccount, array $outputs, int $confirmations = null, string $comment = null, array $addresses = null): string
    {
        $parameters = [$fromAccount, $outputs];
        if ($confirmations != null) {
            $parameters[] = $confirmations;
        }
        if ($comment != null) {
            $parameters[] = $comment;
        }
        if ($addresses != null) {
            $parameters[] = $addresses;
        }
        return $this->request('sendMany', $parameters);
    }

    /**
     * Spends an amount to a given address.
     *
     * @see https://bitcoin.org/en/developer-reference#sendtoaddress
     * @param $address A P2PKH or P2SH address to which the bitcoins should be sent.
     * @param $amount The amount to spent in bitcoins.
     * @param $comment A locally-stored (not broadcast) comment assigned to this
     * transaction. Default is no comment.
     * @param $commentTo A locally-stored (not broadcast) comment assigned to
     * this transaction. Meant to be used for describing who the payment was
     * sent to. Default is no comment.
     * @param $feeSubtraction The fee will be deducted from the amount being sent.
     * The recipient will receive less bitcoins than you enter in the amount
     * field. Default is false.
     * @return string
     */
    public function sendToAddress(string $address, string $amount, string $comment = null, string $commentTo = null, bool $feeSubtraction = null): string
    {
        $parameters = [$address, $amount];
        if ($comment != null) {
            $parameters[] = $comment;
        }
        if ($commentTo != null) {
            $parameters[] = $commentTo;
        }
        if ($feeSubtraction != null) {
            $parameters[] = $feeSubtraction;
        }
        return $this->request('sendToAddress', $parameters);
    }

    /**
     * Sets the transaction fee per kilobyte paid by transactions created by
     * this wallet.
     *
     * @see https://bitcoin.org/en/developer-reference#settxfee
     * @param $fee The transaction fee to pay, in bitcoins, for each kilobyte of
     * transaction data. Be careful setting the fee too low—your transactions
     * may not be relayed or included in blocks
     * @return bool
     */
    public function setTxFee(string $fee): bool
    {
        return $this->request('setTxFee', [$fee]);
    }

    /**
     * Signs a message with the private key of an address.
     *
     * @see https://bitcoin.org/en/developer-reference#signmessage
     * @param $address A P2PKH address whose private key belongs to this wallet.
     * @param $message The message to sign.
     * @return string
     */
    public function signMessage(string $address, string $message): string
    {
        return $this->request('signMessage', [$address, $message]);
    }
}
