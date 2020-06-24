<?php

namespace Application\Utility;

use Application\Utility\Exception\InvalidSlackSignatureException;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class VerifySlackSignatureFromRequest
 * @package Application\Utilities
 */
class VerifySlackSignatureFromRequest
{
    private string $slackSigningSecret;

    /**
     * VerifySlackSignatureFromRequest constructor.
     *
     * @param string $slackSigningSecret
     */
    public function __construct(string $slackSigningSecret)
    {
        $this->slackSigningSecret = $slackSigningSecret;
    }

    /**
     * @param ServerRequestInterface $request
     * @throws InvalidSlackSignatureException
     */
    public function execute(ServerRequestInterface $request)
    {
        $slackTimeStamp = $request->getHeader('X-Slack-Request-Timestamp')[0] ?? null;
        $slackSignature = $request->getHeader('X-Slack-Signature')[0] ?? null;

        if (is_null($slackTimeStamp)) {
            $m = 'Missing X-Slack-Request-Timestamp header';
            throw new InvalidSlackSignatureException($m);
        }

        if (is_null($slackSignature)) {
            $m ='Missing X-Slack-Signature header.';
            throw new InvalidSlackSignatureException($m);
        }

        $baseString = "v0:{$slackTimeStamp}:{$request->getBody()}";

        $signature = 'v0=' . hash_hmac(
            'sha256',
            $baseString,
            $this->slackSigningSecret
        );

        if (!hash_equals($signature, $slackSignature)) {
            $m = 'Can not verify slack signature.';
            throw new InvalidSlackSignatureException($m);
        }
    }
}