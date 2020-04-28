<?php

namespace theRealCooller\ProxyChecker;

interface UserAgent {
    public function choose(): string;
}
