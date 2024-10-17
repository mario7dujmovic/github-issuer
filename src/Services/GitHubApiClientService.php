<?php
namespace Mario7dujmovic\GithubIssuer\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Mario7dujmovic\GithubIssuer\Issue;

class GitHubApiClientService
{
    private Client $client;
    private string $token;
    private string $repo;
    private string $user;

    /**
     * @param $token
     * @param $repo
     * @param $user
     */
    public function __construct($token, $repo, $user)
    {
        $this->token = $token;
        $this->repo = $repo;
        $this->user = $user;
        $this->client = new Client([
            'headers' => [
                'Authorization' => "Bearer: {$this->getToken()}",
                'Content-Type' => "application/json",
                'X-GitHub-Api-Version' => "2022-11-28", // the most recent version as of 2024-10-17
                'Accept' => 'application/vnd.github+json'
            ]
        ]);
    }

    /**
     * @param Issue $issue
     * @return array
     */
    public function sendIt(Issue $issue): array
    {
        $request = new Request('POST', "https://api.github.com/repos/{$this->getUser()}/{$this->getRepo()}/issues",
            $this->getHeaders(), json_encode([
                "title" => $issue->getTitle(),
                "body" => $issue->getMessage(),
                "labels" => $issue->getLabels()
            ]));
        $res = $this->client->sendAsync($request)->wait();

        return ['status' => $res->getStatusCode(), 'body' => $res->getBody()];
    }

    /**
     * @return Client
     */
    public function getClient(): Client
    {
        return $this->client;
    }

    /**
     * @param Client $client
     */
    public function setClient(Client $client): void
    {
        $this->client = $client;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param string $token
     */
    public function setToken(string $token): void
    {
        $this->token = $token;
    }

    /**
     * @return string
     */
    public function getRepo(): string
    {
        return $this->repo;
    }

    /**
     * @param string $repo
     */
    public function setRepo(string $repo): void
    {
        $this->repo = $repo;
    }

    /**
     * @return string
     */
    public function getUser(): string
    {
        return $this->user;
    }

    /**
     * @param string $user
     */
    public function setUser(string $user): void
    {
        $this->user = $user;
    }

    /**
     * @return string[]
     */
    private function getHeaders(): array
    {
        return [
            'X-GitHub-Api-Version' => '2022-11-28',
            'Content-Type' => 'application/json',
            'Authorization' => "Bearer {$this->getToken()}"
        ];
    }
}