<?php
declare(strict_types=1);

namespace theRealCooller\ProxyChecker;

interface UserAgent
{
    public function choose(): string;
}
