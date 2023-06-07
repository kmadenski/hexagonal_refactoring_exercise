<?php

namespace App\Domain;

use App\Domain\Service\EUAlpha2Classifier;

class Bin
{
    private Alpha2 $alpha2;

    /**
     * @param Alpha2 $alpha2
     */
    public function __construct(Alpha2 $alpha2)
    {
        $this->alpha2 = $alpha2;
    }


    /**
     * @return Alpha2
     */
    public function getAlpha2(): Alpha2
    {
        return $this->alpha2;
    }

    public function isEu(): bool{
        return EUAlpha2Classifier::isEu($this->getAlpha2());
    }

}
