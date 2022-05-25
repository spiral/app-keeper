<?php

declare(strict_types=1);

namespace App\Job;

use Spiral\Queue\JobHandler;
use Symfony\Contracts\HttpClient\HttpClientInterface;

/**
 * (QueueInterface)->push(PingJob::class, ["value"=>"my value"]);
 */
class Ping extends JobHandler
{
    public function invoke(HttpClientInterface $client, string $url): void
    {
        // do something
        $status = $client->request('GET', $url)->getStatusCode() === 200;
        echo $status ? 'PONG' : 'ERROR';
    }
}
