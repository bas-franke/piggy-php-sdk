<?php

namespace Piggy\Api\Resources\Register;

use Piggy\Api\Exceptions\BadResponseException;
use Piggy\Api\Exceptions\RequestException;
use Piggy\Api\Mappers\MemberMapper;
use Piggy\Api\Mappers\Loyalty\MemberAndCreditBalanceResponseMapper;
use Piggy\Api\Models\Member;
use Piggy\Api\Models\MemberResponse;
use Piggy\Api\Resources\BaseResource;

/**
 * Class MembersResource
 * @package Piggy\Api\Resources\Register
 */
class MembersResource extends BaseResource
{
    /**
     * @var string
     */
    protected $resourceUri = "/api/v1/register/members";

    /**
     * @param string $email
     * @return Member
     * @throws RequestException
     * @throws BadResponseException
     */
    public function create(string $email): Member
    {
        $body = [
            "email" => $email,
        ];

        $response = $this->client->post($this->resourceUri, $body);

        $mapper = new MemberMapper();

        return $mapper->map($response->getData());
    }

    /**
     * @param string $email
     * @return MemberResponse
     * @throws BadResponseException
     * @throws RequestException
     */
    public function findOneBy(string $email): MemberResponse
    {
        $body = [
            "email" => $email,
        ];

        $response = $this->client->get("{$this->resourceUri}/find-one-by", $body);

        $mapper = new MemberAndCreditBalanceResponseMapper();

        return $mapper->map($response->getData());
    }

    /**
     * @param int $id
     * @return MemberResponse
     * @throws BadResponseException
     * @throws RequestException
     */
    public function get(int $id): MemberResponse
    {
        $response = $this->client->get("{$this->resourceUri}/{$id}");

        $mapper = new MemberAndCreditBalanceResponseMapper();

        return $mapper->map($response->getData());
    }

//    /**
//     * @param int $id
//     * @param array $fields
//     * @return Member
//     * @throws RequestException
//     */
//    public function update(int $id, array $fields = []): MemberResponse
//    {
//        $response = $this->client->request('PUT', $this->resourceUri . "/" . $id, $fields);
//
//        $mapper = new MemberAndCreditBalanceResponseMapper();
//
//        return $mapper->map($response->getData());
//    }
}
