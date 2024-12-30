<?php

declare(strict_types=1);

namespace Patchlevel\EventSourcingAdminBundle\DependencyInjection;

use Patchlevel\EventSourcing\Metadata\Message\MessageHeaderRegistry;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/** @interal */
final class CustomMessageHeaderCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container): void
    {
        $headerRegistry = $container->getDefinition(MessageHeaderRegistry::class);
        $headerRegistry->replaceArgument(
            0,
            [
                ...$headerRegistry->getArgument(0),
                __DIR__ . '/../Message/Header'
            ]
        );
    }
}
