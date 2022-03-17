<?php

/*
 * This file is part of the Laudis Neo4j package.
 *
 * (c) Laudis technologies <http://laudis.tech>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Laudis\Neo4j\Formatter\Specialised;

use Laudis\Neo4j\Contracts\ConnectionInterface;
use Laudis\Neo4j\Http\HttpHelper;
use Laudis\Neo4j\Types\CypherList;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use stdClass;

final class JoltFormatter
{
    /**
     * @psalm-mutation-free
     */
    public function formatHttpResult(ResponseInterface $response, stdClass $body, ConnectionInterface $connection, float $resultsAvailableAfter, float $resultsConsumedAfter, iterable $statements): CypherList
    {
        $body = HttpHelper::interpretResponse($response);

        return new CypherList([]);
    }

    public function decorateRequest(RequestInterface $request): RequestInterface
    {
        return $request->withHeader('Accept', 'application/vnd.neo4j.jolt+json-seq;strict=true;charset=UTF-8');
    }

    public function statementConfigOverride(): array
    {
        return [];
    }
}
