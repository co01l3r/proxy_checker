<?php


class MassOutput implements Output
{
    private array $outputs;

    public function __construct(Output ...$outputs)
    {
        $this->outputs = $outputs;
    }

    public function write(string $proxy): void
    {
        foreach ($this->outputs as $output) {
            $output->write($proxy);
        }
    }
}
