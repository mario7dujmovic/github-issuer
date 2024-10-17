<?php

namespace Mario7dujmovic\GithubIssuer;

class Issue
{
    private string $title;
    private string $message;
    private array $labels;

    /**
     * @param string $title
     * @param string $message
     * @param array $labels
     */
    public function __construct(string $title, string $message, array $labels)
    {
        $this->title = $title;
        $this->message = $message;
        $this->labels = $labels;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    /**
     * @return array
     */
    public function getLabels(): array
    {
        return $this->labels;
    }

    /**
     * @param array $labels
     */
    public function setLabels(array $labels): void
    {
        $this->labels = $labels;
    }
}