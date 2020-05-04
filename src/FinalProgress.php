<?php


namespace theRealCooller\ProxyChecker;


class FinalProgress implements Progress
{
    private string $negativeResultsFile;
    private string $positiveResultsFile;
    private string $resourceFile;

    public function __construct(string $negativeResultsFile, string $positiveResultsFile, string $resourceFile)
    {
        $this->negativeResultsFile = $negativeResultsFile;
        $this->positiveResultsFile = $positiveResultsFile;
        $this->resourceFile = $resourceFile;
    }

    public function write(): void
    {
        echo sprintf(
            'OPERATION RESULTS: %d positive and %d negative from %d total',
            is_file($this->negativeResultsFile) ? count(file($this->negativeResultsFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES)): 0,
            is_file($this->positiveResultsFile) ? count(file($this->positiveResultsFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES)): 0,
            count(file($this->resourceFile)),
        );
    }
}
