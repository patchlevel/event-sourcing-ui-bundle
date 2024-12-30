<?php

declare(strict_types=1);

namespace Patchlevel\EventSourcingAdminBundle\Message\Header;

/** @psalm-immutable */
final class RequestIdHeader
{
    public function __construct(
        public readonly string $requestId,
    ) {
    }
}
