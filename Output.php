<?php

class Output
{
    private string $newFile;

    public function __construct(string $newFile) {
        $this->newFile = $newFile;
    }

    public function write(string $proxy): void {
        $file = fopen($this->newFile, 'a+');
        fwrite($file, $proxy .PHP_EOL);
        fclose($file);
    }
}
