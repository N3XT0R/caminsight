<?php

namespace App\Services\Google\VideoIntelligence;

use Google\ApiCore\ApiException;
use Google\ApiCore\OperationResponse;
use Google\Cloud\VideoIntelligence\V1\AnnotateVideoRequest;
use Google\Cloud\VideoIntelligence\V1\AnnotateVideoResponse;
use Google\Cloud\VideoIntelligence\V1\Client\VideoIntelligenceServiceClient;
use Google\Rpc\Status;

class Client
{
    protected VideoIntelligenceServiceClient $client;

    public function __construct(VideoIntelligenceServiceClient $client)
    {
        $this->setClient($client);
    }

    public function getClient(): VideoIntelligenceServiceClient
    {
        return $this->client;
    }

    public function setClient(VideoIntelligenceServiceClient $client): void
    {
        $this->client = $client;
    }


}