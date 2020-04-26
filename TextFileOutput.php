<?php
require ('Output.php');

class TextFileOutput implements Output
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

    public function echoWrite(string $proxy): string {
        while ($proxy !== 'Not Ok') {
            echo $proxy .PHP_EOL;
        }
    }
}
