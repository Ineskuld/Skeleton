<?php
use Symfony\Contracts\HttpClient\HttpClientInterface;

class SymfonyDocs
{
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function auth()
    {
        $auth = $this->client->request('POST', 'https://test.campagnes-m-call.fr/api/login_check', [
            'auth_basic' => 'the-username', 'the-password'
        ]);

        $statusCode = $response->getStatusCode();
        
        $contentType = $response->getHeaders()['content-type'][0];
        
        $token = $response->getContent();

        return $token;
    }

    public function fetchContacts(): array
    {
        $response = $this->client->request(
            'GET',
            'https://test.campagnes-m-call.fr/api/listContacts/'.$this->auth(),
        );

        $statusCode = $response->getStatusCode();
        
        $contentType = $response->getHeaders()['content-type'][0];
        $content = $response->getContent();
        $content = $response->toArray();

        return $content;
    }
}