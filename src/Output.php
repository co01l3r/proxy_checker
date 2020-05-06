<?php
declare(strict_types=1);

namespace theRealCooller\ProxyChecker;

interface Output
{
    public function write(string $proxy): void;
}
