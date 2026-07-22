<?php

namespace App\Services\Implementations;

use App\Services\Interfaces\SocialProviderInterface;
use Illuminate\Http\Request;

class GoogleProvider implements SocialProviderInterface{
    public function getProviderName(): string
    {
        return 'google';
    }

    public function handle(): array
    {
        $socialUser = Socialite::driver('google')->stateless()->user();

        return [
            'id' => $socialUser->getId(),
            'name' => $socialUser->getName(),
            'email' => $socialUser->getEmail(),
            'avatar' => $socialUser->getAvatar()
        ];
    }
}