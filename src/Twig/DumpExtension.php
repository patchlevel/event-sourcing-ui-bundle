<?php

declare(strict_types=1);

namespace Patchlevel\EventSourcingAdminBundle\Twig;

use Symfony\Component\VarDumper\Cloner\ClonerInterface;
use Symfony\Component\VarDumper\Dumper\HtmlDumper;
use Twig\Environment;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

final class DumpExtension extends AbstractExtension
{
    public function __construct(
        private ClonerInterface $cloner,
        private ?HtmlDumper $dumper = null,
    ) {
    }

    /** @return list<TwigFunction> */
    public function getFunctions(): array
    {
        return [
            new TwigFunction(
                'eventsourcing_dump',
                $this->dump(...),
                [
                    'is_safe' => ['html'],
                    'needs_environment' => true,
                ]
            ),
        ];
    }

    public function dump(Environment $env, mixed $var): string
    {
        $dump = fopen('php://memory', 'r+');
        $this->dumper ??= new HtmlDumper();
        $this->dumper->setCharset($env->getCharset());

        $this->dumper->dump($this->cloner->cloneVar($var), $dump);

        return stream_get_contents($dump, -1, 0);
    }
}
