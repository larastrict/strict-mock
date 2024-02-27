<?php

declare(strict_types=1);

namespace LaraStrict\StrictMock\Testing\Entities;

class FileSetupEntity
{
    public function __construct(
        public readonly string $dir,
        public readonly string $namespace,
    ) {
    }
}
