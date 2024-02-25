<?php declare(strict_types=1);

namespace LaraStrict\StrictMock\Testing\Transformers;

use LaraStrict\StrictMock\Testing\Entities\FileSetupEntity;
use LaraStrict\StrictMock\Testing\Entities\ProjectSetupEntity;
use ReflectionClass;

final class ReflectionClassToFileSetupEntity
{
    public function __construct(private readonly ProjectSetupEntity $projectSetup)
    {
    }


    public function transform(ReflectionClass $class, ?FileSetupEntity $exportSetup = null): FileSetupEntity
    {
        $exportSetup ??= $this->projectSetup->exportRoot;
        $projectRoot = $this->projectSetup->projectRoot;
        $namespace = $class->getNamespaceName();
        if (str_starts_with($namespace, $projectRoot->namespace)) {
            $exportNamespace = str_replace($projectRoot->namespace, $exportSetup->namespace, $namespace);
            $exportFile = str_replace($projectRoot->folder, $exportSetup->folder, dirname($class->getFileName()));
        } else {
            throw new \RuntimeException('not implemented');
        }

        return new FileSetupEntity($exportFile, $exportNamespace);
    }
}