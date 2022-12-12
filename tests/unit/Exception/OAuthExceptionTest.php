<?php

namespace LeagueTests;

use League\OAuth2\Server\Exception\OAuthException;
use PHPUnit\Framework\TestCase;

class OAuthExceptionTest extends TestCase
{
    public function testGetHttpHeaders()
    {
        $exception = new OAuthException();

        $exception->httpStatusCode = 400;
        $this->assertSame($exception->getHttpHeaders(), ['HTTP/1.1 400 Bad Request']);

        $exception->httpStatusCode = 401;
        $this->assertSame($exception->getHttpHeaders(), ['HTTP/1.1 401 Unauthorized']);

        $exception->httpStatusCode = 500;
        $this->assertSame($exception->getHttpHeaders(), ['HTTP/1.1 500 Internal Server Error']);

        $exception->httpStatusCode = 501;
        $this->assertSame($exception->getHttpHeaders(), ['HTTP/1.1 501 Not Implemented']);
    }

    public function testShouldRedirect()
    {
        $exception = new OAuthException();
        $exception->redirectUri = 'http://example.com/';
        $exception->errorType = 'Error';
        $this->assertTrue($exception->shouldRedirect());
        $this->assertEquals('http://example.com/?error=Error&message=An+error+occured', $exception->getRedirectUri());
    }
}
