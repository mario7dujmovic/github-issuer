<?php

namespace Mario7dujmovic\GithubIssuer;


use Mario7dujmovic\GithubIssuer\Services\GitHubApiClientService;

class IssueProcessor
{
    private string $token;
    private string $repo;
    private string $user;
    private array $issues;
    private GitHubApiClientService $gitHubApiClientService;
    private array $results;

    /**
     * @param string $token
     * @param string $repo
     * @param string $user
     */
    public function __construct(string $token, string $user, string $repo)
    {
        $this->token = $token;
        $this->repo = $repo;
        $this->user = $user;
    }

    /**
     * @param string $title
     * @param string $message
     * @param array $labels
     * @return void
     */
    public function addIssue(string $title, string $message, array $labels): void
    {
        $this->issues[] = new Issue($title, $message, $labels);
    }

    /**
     * @return array
     */
    public function processIssues(): array
    {
        foreach ($this->issues as $issue) {
            $this->results[] = $this->getGitHubApiClientService()->sendIt($issue);
        }
        return $this->results;
    }

    /**
     * @return array|null
     */
    public function getIssues(): ?array
    {
        return $this->issues;
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
     * @return GitHubApiClientService
     */
    public function getGitHubApiClientService(): GitHubApiClientService
    {
        if (empty($this->gitHubApiClientService)) {
            $this->gitHubApiClientService = new GitHubApiClientService($this->getToken(), $this->getRepo(),
                $this->getUser());
        }
        return $this->gitHubApiClientService;
    }

    /**
     * @param GitHubApiClientService $gitHubApiClientService
     */
    public function setGitHubApiClientService(GitHubApiClientService $gitHubApiClientService): void
    {
        $this->gitHubApiClientService = $gitHubApiClientService;
    }

    /**
     * @return array
     */
    public function getResults(): array
    {
        return $this->results;
    }

    /**
     * @param array $results
     */
    public function setResults(array $results): void
    {
        $this->results = $results;
    }
}