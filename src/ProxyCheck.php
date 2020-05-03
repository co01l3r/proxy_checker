<?php
declare(strict_types = 1);

namespace theRealCooller\ProxyChecker;

class ProxyCheck
{
    private string $resourceFile;
    private Output $successOutput;
    private Output $failedOutput;
    private UrlResponse $urlResponse;

    public function __construct(string $resourceFile, Output $successOutput, Output $failedOutput, UrlResponse $urlResponse)
    {
        $this->resourceFile = $resourceFile;
        $this->successOutput = $successOutput;
        $this->failedOutput = $failedOutput;
        $this->urlResponse = $urlResponse;
    }

    public function check(): void {
        $proxyList = new ProxyList($this->resourceFile, new \Klapuch\Lock\SemaphoreFactory());

        while (($proxy = $proxyList->use()) !== '') {
            if ($this->urlResponse->isOk($proxy)) {
                $this->successOutput->write($proxy);
            } else {
                $this->failedOutput->write($proxy);
            }
        }
    }
}
