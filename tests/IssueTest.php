<?php
namespace Mario7dujmovic\Tests;

use Mario7dujmovic\GithubIssuer\Issue;
use PHPUnit\Framework\TestCase;

class IssueTest extends TestCase
{
    public function testIssue()
    {
        $issue = new Issue("This thing doesn't work 0", "Segment0 doesn't work the way it's supposed to", ['bug', 'production']);

        $this->assertIsArray($issue->getLabels());
        $this->assertCount(2, $issue->getLabels());
        $this->assertEquals("This thing doesn't work 0", $issue->getTitle());
        $this->assertEquals("Segment0 doesn't work the way it's supposed to", $issue->getMessage());
    }
}