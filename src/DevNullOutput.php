<?php


namespace theRealCooller\ProxyChecker;


class DevNullOutput implements Output
{
    public function write(string $proxy): void {
    }
}
