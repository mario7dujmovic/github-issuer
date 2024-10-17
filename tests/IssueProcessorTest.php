<?php
namespace Mario7dujmovic\Tests;


use Mario7dujmovic\GithubIssuer\IssueProcessor;
use PHPUnit\Framework\TestCase;

class IssueProcessorTest extends TestCase
{
    public function testIssueProcessor()
    {
        $issueProcessor = new IssueProcessor("token", "user", "repo");
        $issueProcessor->addIssue("This thing doesn't work 1", "Segment1 doesn't work the way it's supposed to", ['bug']);
        $issueProcessor->addIssue("This thing doesn't work 2", "Segment2 doesn't work the way it's supposed to", ['bug']);
        $issueProcessor->addIssue("This thing doesn't work 3", "Segment3 doesn't work the way it's supposed to", ['bug']);
        $issueProcessor->addIssue("This thing doesn't work 4", "Segment4 doesn't work the way it's supposed to", ['bug']);
        $issueProcessor->addIssue("This thing doesn't work 5", "Segment5 doesn't work the way it's supposed to", ['bug']);
        $issueProcessor->addIssue("This thing doesn't work 6", "Segment6 doesn't work the way it's supposed to", ['bug', 'production']);

        $this->assertCount(6, $issueProcessor->getIssues());
        $this->assertEquals('token', $issueProcessor->getToken());
        $this->assertEquals('repo', $issueProcessor->getRepo());
        $this->assertEquals('user', $issueProcessor->getUser());
    }
}