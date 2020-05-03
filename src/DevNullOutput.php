<?php
declare(strict_types = 1);

namespace theRealCooller\ProxyChecker;


class DevNullOutput implements Output
{
    public function write(string $proxy): void {
    }
}
