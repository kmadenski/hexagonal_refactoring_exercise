<?php

namespace App\Application\Port\Driven;

use App\Domain\Bin;
use App\Domain\BinRef;

interface BinProviderInterface
{
    public function findOneBy(BinRef $bin): Bin;
}
