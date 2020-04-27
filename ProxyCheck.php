<?php


class ProxyCheck
{
    private string $resourceFile;
    private Output $output;
    private UrlResponse $urlResponse;

    public function __construct(string $resourceFile, Output $output, UrlResponse $urlResponse)
    {
        $this->resourceFile = $resourceFile;
        $this->output = $output;
        $this->urlResponse = $urlResponse;
    }

    public function check(): void {
        $proxyList = new ProxyList($this->resourceFile, new \Klapuch\Lock\SemaphoreFactory());

        while (($proxy = $proxyList->use()) !== '') {
            if ($this->urlResponse->isOk($proxy))
                $this->output->write($proxy);
            else {
                echo "not OK" . PHP_EOL;
            }
        }
    }
}
