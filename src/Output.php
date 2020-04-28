<?php

namespace theRealCooller\ProxyChecker;

interface Output {
    public function write(string $proxy): void;
}
