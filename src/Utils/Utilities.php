<?php

namespace App\Utils;

class Utilities
{
    private $baseXp = 100;
    private $exponent = 1;

    /**
     * Returns the level of an exp
     */
    public function getLvl(int $experience): int
    {
        return floor(bcpow(($experience/$this->baseXp), $this->exponent,10));
    }

    /**
     * Returns the next level of an exp
     */
    public function getNextLvl(int $experience): int
    {
        return ceil(bcpow(($experience/$this->baseXp), $this->exponent,10));
    }

    /**
     * Return the exp to a lvl
     */
    public function expLvl(int $lvl): int
    {
        return floor($this->baseXp * bcpow($lvl, $this->exponent,10));
    }
}