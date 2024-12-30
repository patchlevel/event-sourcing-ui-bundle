<?php

declare(strict_types=1);

namespace Patchlevel\EventSourcingAdminBundle\Twig;

use Symfony\Component\VarDumper\Cloner\ClonerInterface;
use Symfony\Component\VarDumper\Cloner\VarCloner;
use Symfony\Component\VarDumper\Dumper\HtmlDumper;
use Twig\Environment;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

final class DumpExtension extends AbstractExtension
{
    private ClonerInterface $cloner;
    private HtmlDumper $dumper;

    public function __construct()
    {
        $this->cloner = new VarCloner();
        $this->dumper = new HtmlDumper();
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
                ],
            ),
        ];
    }

    public function dump(Environment $env, mixed $var): string
    {
        $this->dumper->setCharset($env->getCharset());

        return $this->dumper->dump($this->cloner->cloneVar($var), true);
    }
}
