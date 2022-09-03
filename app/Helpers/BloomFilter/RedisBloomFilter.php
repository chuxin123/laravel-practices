<?php

namespace App\Helpers\BloomFilter;

use JsonSerializable;
use Illuminate\Support\Facades\Redis;
use App\Constants\RedisKey;

/**
 * Represents a bloom filter
 */
class RedisBloomFilter implements JsonSerializable
{
    const HASH_ALGO = 'sha1';

    /**
     * @var BitArray
     */
    private $ba;

    /**
     * @var HasherList
     */
    private $hashers;

    /**
     * @var bfKey
     * Bloom Filter key
     */
    private $bfKey;

    static private $instances = [];

    /**
     * @param array $data
     *
     * @return BloomFilter
     */
    public static function initFromJson(array $data)
    {
        return new static(BitArray::initFromJson($data['bit_array']), HasherList::initFromJson($data['hashers']));
    }

    /**
     * @param int   $approxSize
     * @param float $falsePosProb
     *
     * @return BloomFilter
     */
    public static function init($approxSize = 1024, $falsePosProb = 0.001, string $bfKey = RedisKey::BLOOM_FILTER)
    {
        $baSize = self::optimalBitArraySize($approxSize, $falsePosProb);
        $ba = BitArray::init($baSize);
        $hasherAmt = self::optimalHasherCount($approxSize, $baSize);

        if (!array_key_exists($bfKey, self::$instances) || !self::$instances[$bfKey] instanceof self) {
            $hashers = new HasherList(static::HASH_ALGO, $hasherAmt, $baSize);
            self::$instances[$bfKey] = new static($ba, $hashers, $bfKey);
        }
        return self::$instances[$bfKey];
    }

    /**
     * @param int   $approxSetSize
     * @param float $falsePositiveProbability
     *
     * @return int
     */
    private static function optimalBitArraySize($approxSetSize, $falsePositiveProbability)
    {
        return (int)round((($approxSetSize * log($falsePositiveProbability)) / pow(log(2), 2)) * -1);
    }

    /**
     * @param int $approxSetSize
     * @param int $bitArraySize
     *
     * @return int
     */
    private static function optimalHasherCount($approxSetSize, $bitArraySize)
    {
        return (int)round(($bitArraySize / $approxSetSize) * log(2));
    }

    /**
     * In general, do not use the constructor directly
     *
     * @param BitArray   $ba
     * @param HasherList $hashers
     */
    private function __construct(BitArray $ba, HasherList $hashers, string $bfKey)
    {
        $this->ba = $ba;
        $this->hashers = $hashers;
        $this->bfKey = $bfKey;
    }

    /**
     * @param string $item
     *
     * @return void
     */
    public function add($item)
    {
        $vals = $this->hashers->hash($item);
        $pipe = Redis::multi();
        foreach ($vals as $bitLoc) {
            $pipe->setbit($this->bfKey, $bitLoc, 1);
        }
        return $pipe->exec();
    }

    /**
     * @param string $item
     *
     * @return bool
     */
    public function exists($item)
    {
        $exists = true;
        $vals = $this->hashers->hash($item);
        $pipe = Redis::multi();
        foreach ($vals as $bitLoc) {
            $pipe->getbit($this->bfKey, $bitLoc);
        }
        $payloads = $pipe->exec();
        foreach ($payloads as $bit) {
            if (0 == $bit) {
                return false;
            }
        }
        return $exists;
    }

    /**
     * @return array
     */
    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
        return [
            'bit_array' => $this->ba,
            'hashers' => $this->hashers,
        ];
    }
}
