<?php

namespace App\Services\Google\VideoIntelligence\Contracts;

use Google\Cloud\VideoIntelligence\V1\Client\VideoIntelligenceServiceClient;

interface ClientContract
{
    public function __construct(VideoIntelligenceServiceClient $client);

    public function getClient(): VideoIntelligenceServiceClient;

    public function setClient(VideoIntelligenceServiceClient $client): void;
}