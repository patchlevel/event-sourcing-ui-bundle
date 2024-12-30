<?php

declare(strict_types=1);

namespace Patchlevel\EventSourcingAdminBundle;

use Patchlevel\EventSourcingAdminBundle\DependencyInjection\CustomMessageHeaderCompilerPass;
use Patchlevel\EventSourcingAdminBundle\DependencyInjection\PatchlevelEventSourcingAdminExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

final class PatchlevelEventSourcingAdminBundle extends AbstractBundle
{
    public function build(ContainerBuilder $container): void
    {
        parent::build($container);

        $container->addCompilerPass(new CustomMessageHeaderCompilerPass());
    }

    public function getContainerExtension(): PatchlevelEventSourcingAdminExtension
    {
        return new PatchlevelEventSourcingAdminExtension();
    }
}
