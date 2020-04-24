<?php


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

    private function lastLine(): string {
/*        $fp = fopen($this->file, "r");
        fseek($fp, -2, SEEK_END);
        $pos = ftell($fp);
        $lastLine = "";

        while((($c = var_dump(fgetc($fp))) != "\n") && ($pos > 0)) {
            $lastLine = $c.$lastLine;
            fseek($fp, $pos--);
        }
        return $lastLine;*/

        $file = $this->file;
        $data = file($file);
        $line = $data[count($data)-1];
    }

    private function deleteLastLine($lastLine): void {
        $file = fopen($this->file, 'a+');
        ftruncate($file, filesize($this->file) - strlen($lastLine));
        fclose($file);
    }

    private function tempName(): string {
       return sprintf('%s/%s', sys_get_temp_dir(), md5(realpath($this->file)));
    }

}

