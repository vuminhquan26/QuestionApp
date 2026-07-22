<?php

namespace App\Services\Implementations;

use App\Services\Interfaces\SocialProviderInterface;
use Illuminate\Http\Request;

class FacebookProvider implements SocialProviderInterface{
    public function getProviderName(): string
    {
        return 'facebook';
    }

    public function handle(): array
    {
        $socialUser = Socialite::driver('facebook')->stateless()->user();

        return [
            'id' => $socialUser->getId(),
            'name' => $socialUser->getName(),
            'email' => $socialUser->getEmail(),
            'avatar' => $socialUser->getAvatar()
        ];
    }
}
