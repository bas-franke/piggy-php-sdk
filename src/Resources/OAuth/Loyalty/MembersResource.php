<?php

namespace Piggy\Api\Resources\OAuth\Loyalty;

use GuzzleHttp\Exception\GuzzleException;
use Piggy\Api\Exceptions\PiggyRequestException;
use Piggy\Api\Mappers\Loyalty\MemberAndCreditBalanceResponseMapper;
use Piggy\Api\Mappers\Loyalty\MemberMapper;
use Piggy\Api\Models\Loyalty\Member;
use Piggy\Api\Models\Loyalty\MemberResponse;
use Piggy\Api\Resources\BaseResource;

/**
 * Class MembersResource
 * @package Piggy\Api\Resources\OAuth\Loyalty
 */
class MembersResource extends BaseResource
{
    /**
     * @var string
     */
    protected $resourceUri = "/api/v2/oauth/clients/members";

    /**
     * @param int $shopId
     * @param string $email
     *
     * @return Member
     * @throws GuzzleException
     * @throws PiggyRequestException
     */
    public function create(int $shopId, string $email): Member
    {
        $response = $this->client->post($this->resourceUri, [
            "shop_id" => $shopId,
            "email" => $email,
        ]);

        $mapper = new MemberMapper();

        return $mapper->map($response->getData());
    }

    /**
     * @param int $shopId
     * @param string $email
     *
     * @return MemberResponse
     * @throws GuzzleException
     * @throws PiggyRequestException
     */
    public function findOneBy(int $shopId, string $email): MemberResponse
    {
        $response = $this->client->get("{$this->resourceUri}/find-one-by", [
            "shop_id" => $shopId,
            "email" => $email,
        ]);

        $mapper = new MemberAndCreditBalanceResponseMapper();

        return $mapper->map($response->getData());
    }

    /**
     * @param int $shopId
     * @param int $loyaltyProgramId
     * @param string $email
     * @return MemberResponse
     * @throws GuzzleException
     * @throws PiggyRequestException
     */
    public function findOrCreate(int $loyaltyProgramId, int $shopId, string $email): MemberResponse
    {
        $response = $this->client->get("{$this->resourceUri}/$loyaltyProgramId/find-or-create", [
            "shop_id" => $shopId,
            "email" => $email,
        ]);

        $mapper = new MemberAndCreditBalanceResponseMapper();

        return $mapper->map($response->getData());
    }

    /**
     * @param int $shopId
     * @param int $memberId
     *
     * @return MemberResponse
     * @throws GuzzleException
     * @throws PiggyRequestException
     */
    public function get(int $shopId, int $memberId): MemberResponse
    {
        $response = $this->client->get("{$this->resourceUri}/$memberId", [
            "shop_id" => $shopId,
        ]);

        $mapper = new MemberAndCreditBalanceResponseMapper();

        return $mapper->map($response->getData());
    }
}
