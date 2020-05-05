<?php
declare(strict_types = 1);

namespace theRealCooller\ProxyChecker;

class ProxyList
{
    private string $file;
    private \Klapuch\Lock\SemaphoreFactory $semaphoreFactory;

    public function __construct(string $file, \Klapuch\Lock\SemaphoreFactory $semaphoreFactory)
    {
        $this->file = $file;
        $this->semaphoreFactory = $semaphoreFactory;
    }

    public function use(): string
    {
            $tempFile = $this->tempName($this->file);
            return $this->semaphoreFactory->create($tempFile)->synchronized(function () use ($tempFile) {
                if (!file_exists($tempFile)) {
                    if ($this->isPosixFile($this->file)) {
                        copy($this->file, $tempFile);
                    } else {
                        throw new \RuntimeException(sprintf('%s is not a valid file', $this->file));
                    }
                }
                $lastLine = $this->lastLine($tempFile);

                $this->deleteLastLine($lastLine, $tempFile);

                return $lastLine;
            });
    }

    private function lastLine(string $file): string
    {
        $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        return $lines[count($lines) -1] ?? '';
    }

    private function deleteLastLine($lastLine, string $resource): void
    {
            $file = fopen($resource, 'a+');
            $fp = fstat($file);
            if ($file === false) {
                throw new \RuntimeException(sprintf('%s is not a valid file', $resource));
            }
            ftruncate($file, max(0, $fp['size'] - strlen($lastLine) - strlen("\n")));
            fclose($file);

    }

    private function tempName(string $file): string {
       return sprintf('%s/%s_%d', sys_get_temp_dir(), md5(realpath($file)), filemtime($file));
    }

    private function isPosixFile(string $file): bool
    {
        return $this->lastLineChar($file) === "\n";
    }

    private function lastLineChar(string $file): string {
        try {
            $handler = fopen($file, "r");
            if ($handler === false) {
                throw new \RuntimeException(sprintf('%s is not a valid file', $file));
            }
            fseek($handler, -1, SEEK_END);
            return fgets($handler);
        } finally {
            fclose($handler);
        }
    }
}

