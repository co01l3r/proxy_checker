<?php

namespace theRealCooller\ProxyChecker;

interface Response {
    public function isOk(string $proxy): bool;
}
