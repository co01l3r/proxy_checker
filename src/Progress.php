<?php
declare(strict_types = 1);

namespace theRealCooller\ProxyChecker;

interface Progress {
    public function write(): void;
}
