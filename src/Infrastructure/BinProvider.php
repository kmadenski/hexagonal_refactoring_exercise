<?php
namespace App\Infrastructure;

use App\Domain\Bin;
use App\Application\Port\Driven\BinProviderInterface;
use App\Domain\Alpha2;
use App\Domain\BinRef;

class BinProvider implements BinProviderInterface
{
    public function findOneBy(BinRef $binRef): Bin
    {
        $binData = file_get_contents('https://lookup.binlist.net/' .$binRef->value());
        if (!$binData){
            throw new \Exception("Binlist cannot retrieve data for {$binRef->value()}");
        }

        $binObject = json_decode($binData);

        return BinFactory::create($binObject);
    }

}
