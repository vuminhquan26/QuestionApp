<?php

namespace App\Services\Interfaces\Auth;

interface SocialProviderInterface
{
    public function getProviderName(): string;

    public function handle(): array;
}
