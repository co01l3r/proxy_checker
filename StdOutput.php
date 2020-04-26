<?php


class StdOutput implements Output
{
    public function write(string $proxy): void {
            echo $proxy .PHP_EOL;
    }
}
