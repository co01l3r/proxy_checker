<?php

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
        $tempFile = $this->tempName();
        return $this->semaphoreFactory->create($tempFile)->synchronized(function () use ($tempFile) {
            if (!file_exists($tempFile)) {
                copy($this->file, $tempFile);
            }
            $this->file = $tempFile;

            $lastLine = $this->lastLine();
            $this->deleteLastLine($lastLine);

            return $lastLine;
        });
    }

    private function lastLine(): string
    {
        $lines = file($this->file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        return $lines[count($lines) - 1] ?? '';
    }

    private function deleteLastLine($lastLine): void {
        $file = fopen($this->file, 'a+');
        ftruncate($file, max(0, filesize($this->file) - strlen($lastLine) - strlen("\n")));
        fclose($file);
    }

    private function tempName(): string {
       return sprintf('%s/%s_%d', sys_get_temp_dir(), md5(realpath($this->file)), filemtime($this->file));
    }
}

