<?php

namespace App\Dto;

use App\Constants\SerializationGroups;
use App\Entity\SocialNetwork;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Uid\Uuid;

#[Groups(SerializationGroups::SOCIAL_NETWORK_READ_COLLECTION)]
final class SocialNetworkDto
{
    public readonly Uuid $uuid;

    public readonly string $name;

    public readonly string $url;

    public readonly bool $show;

    public function  __construct(SocialNetwork $socialNetwork)
    {
        $this->uuid = $socialNetwork->getUuid();
        $this->name = $socialNetwork->getName();
        $this->url = $socialNetwork->getUrl();
        $this->show = $socialNetwork->isShow();
    }

}
