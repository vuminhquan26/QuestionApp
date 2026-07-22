<?php

namespace App\Services\Implementations\Auth;

use App\Services\Interfaces\Auth\SocialProviderInterface;
use App\Models\User;
use App\Models\SocialAccount;
use Illuminate\Support\Str;

class SocialAuthService
{
    protected $providers = [];

    public function __construct(iterable $providers)
    {
        foreach ($providers as $provider) {
            $this->providers[$provider->getProviderName()] = $provider;
        }
    }

    public function handle(string $providerName): string
    {
        if (!isset($this->providers[$providerName])) {
            throw new \Exception('Provider not supported');
        }

        $provider = $this->providers[$providerName];

        $data = $provider->handle();

        // logic chung
        $account = SocialAccount::where([
            'provider' => $providerName,
            'provider_user_id' => $data['id']
        ])->first();

        if ($account) {
            $user = $account->user;
        } else {
            $user = User::where('email', $data['email'])->first();

            if (!$user) {
                $user = User::create([
                    'id' => (string) Str::uuid(),
                    'name' => $data['name'],
                    'email' => $data['email'] ?? $providerName.'_'.$data['id'].'@dummy.com',
                    'password' => bcrypt(Str::random(16)),
                    'avatar' => $data['avatar'],
                    'is_first_login' => true
                ]);
            }

            SocialAccount::create([
                'user_id' => $user->id,
                'provider' => $providerName,
                'provider_user_id' => $data['id']
            ]);
        }

        return auth('api')->login($user);
    }
}
