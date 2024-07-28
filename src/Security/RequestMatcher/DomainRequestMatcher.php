<?php

declare(strict_types=1);

namespace App\Security\RequestMatcher;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestMatcherInterface;

class DomainRequestMatcher implements RequestMatcherInterface
{
    private array $trustedHosts;

    public function __construct(string $trustedHosts)
    {
        $this->trustedHosts = array_map('trim', explode(',', $trustedHosts));
    }

    public function matches(Request $request): bool
    {
        return in_array($request->headers->get('origin'), $this->trustedHosts, true);
    }
}
