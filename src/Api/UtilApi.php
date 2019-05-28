<?php
namespace McCaulay\Bitcoin\Api;

class UtilApi extends Api
{
    /**
     * Creates a P2SH multi-signature address.
     *
     * @see https://bitcoin.org/en/developer-reference#createmultisig
     * @param $required The minimum (m) number of signatures required to spend
     * this m-of-n multisig script.
     * @param $addresses An array of addresses or public keys against which
     * signatures will be checked. If wallet support is enabled, this may be a
     * P2PKH address belonging to the wallet—the corresponding public key will
     * be substituted. There must be at least as many keys as specified by the
     * Required parameter, and there may be more keys.
     * @return object|array
     */
    public function createMultiSig(int $required, array $addresses)
    {
        return $this->request('createMultiSig', [$required, $addresses]);
    }

    /**
     * Estimates the transaction fee per kilobyte that needs to be paid for a
     * transaction to be included within a certain number of blocks.
     *
     * @see https://bitcoin.org/en/developer-reference#estimatefee
     * @param $blocks The maximum number of blocks a transaction should have to
     * wait before it is predicted to be included in a block. Has to be between
     * 2 and 25 blocks.
     * @return string
     */
    public function estimateFee(int $blocks): string
    {
        return $this->request('estimateFee', [$blocks]);
    }

    /**
     * Signs a message with a given private key.
     *
     * @see https://bitcoin.org/en/developer-reference#signmessagewithprivkey
     * @param $privateKey The private key to sign the message with encoded in
     * base58check using wallet import format (WIF).
     * @param $message The message to sign.
     * @return string
     */
    public function signMessageWithPrivKey(string $privateKey, string $message): string
    {
        return $this->request('signMessageWithPrivKey', [$privateKey, $message]);
    }

    /**
     * Gets information about the given Bitcoin address.
     *
     * @see https://bitcoin.org/en/developer-reference#validateaddress
     * @param $address The P2PKH or P2SH address to validate encoded in
     * base58check format.
     * @return object|array
     */
    public function validateAddress(string $address)
    {
        return $this->request('validateAddress', [$address]);
    }

    /**
     * Verifies a signed message.
     *
     * @see https://bitcoin.org/en/developer-reference#verifymessage
     * @param $address The P2PKH address corresponding to the private key which
     * made the signature. A P2PKH address is a hash of the public key
     * corresponding to the private key which made the signature.
     * @param $signature The signature created by the signer encoded as base-64.
     * @param $message The message exactly as it was signed (e.g. no extra whitespace).
     * @return bool
     */
    public function verifyMessage(string $address, string $signature, string $message): bool
    {
        return $this->request('verifyMessage', [$address, $signature, $message]);
    }
}
