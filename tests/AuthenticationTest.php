<?php

declare(strict_types=1);

namespace App\Tests;

use Zenstruck\Foundry\Test\ResetDatabase;

class AuthenticationTest extends AbstractApiTest
{
    use ResetDatabase;

    private $url = '/api/auth';

    public function testLogin(): void
    {
        $user = $this->createUser();

        $response = $this->post($this->url,
            json: [
                'username' => $user->getUsername(),
                'password' => $user->getPassword(),
            ]
        );

        $json = $response->toArray();

        $this->assertResponseIsSuccessful();
        //$this->assertArrayHasKey('token', $json);

        // test not authorized
        $this->get('/greetings');
        $this->assertResponseStatusCodeSame(401);

        // test authorized
        $this->get('/greetings', headers: ['auth_bearer' => $json['token']]);
        $this->assertResponseIsSuccessful();
    }
}
