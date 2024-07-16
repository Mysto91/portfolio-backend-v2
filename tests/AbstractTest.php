<?php

declare(strict_types=1);

namespace App\Tests;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use ApiPlatform\Symfony\Bundle\Test\Client;
use App\Entity\User;
use Symfony\Contracts\HttpClient\ResponseInterface;

abstract class AbstractApiTest extends ApiTestCase
{
    private ?string $token = null;

    //use ResetDatabase;

    public function setUp(): void
    {
        self::bootKernel();
    }

    protected function createClientWithCredentials($token = null): Client
    {
        $token = $token ?: $this->getToken();

        return static::createClient([], ['headers' => ['authorization' => 'Bearer ' . $token]]);
    }

    /**
     * Use other credentials if needed.
     */
    protected function getToken($body = []): string
    {
        if ($this->token) {
            return $this->token;
        }

        $response = static::createClient()->request('POST', '/api/auth', ['json' => $body ?: [
            'username' => 'admin@example.com',
            'password' => '$3cr3t',
        ]]);

        $this->assertResponseIsSuccessful();
        $data = $response->toArray();
        $this->token = $data['token'];

        return $data['token'];
    }

    protected function createUser($overrides = []): User
    {
        $container = self::getContainer();

        $user = (new User())
            ->setUsername($overrides['username'] ?? 'test')
            ->setEmail($overrides['email'] ?? 'test@example.com')
            ->setRoles($overrides['roles'] ?? []);

        $user->setPassword(
            $container->get('security.user_password_hasher')->hashPassword($user, $overrides['password'] ?? 'test')
        );

        $manager = $container->get('doctrine')->getManager();
        $manager->persist($user);
        $manager->flush();

        return $user;
    }

    protected function post(string $url, array $json = [], array $headers = []): ResponseInterface
    {
        $client = self::createClient();

        return $client->request('POST', $url, [
            'headers' => array_merge(['Content-Type' => 'application/json'], $headers),
            'json' => $json,
        ]);
    }

    protected function get(string $url, array $query = [], array $headers = []): ResponseInterface
    {
        $client = self::createClient();

        return $client->request('GET', $url, [
            'headers' => array_merge(['Content-Type' => 'application/json'], $headers),
            'query' => $query,
        ]);
    }

}
