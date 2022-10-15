<?php declare(strict_types=1);

namespace App\Service;

use ParagonIE\ConstantTime\Hex;
use ParagonIE\Halite\Asymmetric\Crypto;
use ParagonIE\Halite\Asymmetric\SignaturePublicKey;
use ParagonIE\Halite\Halite;
use ParagonIE\Halite\KeyFactory;
use ParagonIE\HiddenString\HiddenString;

/**
 * This service verifies the digital signature sent in a discord interaction
 * request headers
 * See: https://discord.com/developers/docs/interactions/receiving-and-responding#security-and-authorization
 */
class InteractionAuthorizer
{
    private SignaturePublicKey $signPublicKey;

    public function __construct(string $publicKey)
    {
        $binKey = hex2bin($publicKey);
        $keyData = Halite::HALITE_VERSION_KEYS . $binKey .
            \sodium_crypto_generichash(
                Halite::HALITE_VERSION_KEYS . $binKey,
                '',
                \SODIUM_CRYPTO_GENERICHASH_BYTES_MAX
            );
        $this->signPublicKey = KeyFactory::importSignaturePublicKey(
            new HiddenString(Hex::encode($keyData))
        );
    }

    public function verify(string $signature, string $timestamp, string $body): bool
    {
        return Crypto::verify($timestamp . $body, $this->signPublicKey, $signature, false);
    }
}