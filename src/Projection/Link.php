<?php

declare(strict_types=1);

namespace Patchlevel\EventSourcingAdminBundle\Projection;

use JsonSerializable;

use function sha1;

final class Link implements JsonSerializable
{
    public readonly string $id;

    public function __construct(
        public readonly string $fromId,
        public readonly string $toId,
    ) {
        $this->id = sha1($fromId . '->' . $toId);
    }

    public function __toString(): string
    {
        return $this->fromId . ' -> ' . $this->toId;
    }

    public function jsonSerialize(): array
    {
        return [
            'fromId' => $this->fromId,
            'toId' => $this->toId,
        ];
    }
}
