<?php
declare(strict_types = 1);

namespace theRealCooller\ProxyChecker;

interface Response {
    public function isOk(string $proxy): bool;
}
