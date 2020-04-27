<?php

interface Response {
    public function isOk(string $proxy): bool;
}
