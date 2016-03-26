<?php
/*
 * The MIT License (MIT)
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */
namespace Balwan\RockPaperScissor\DataProvider\Provider;

use Balwan\RockPaperScissor\DataProvider\DataProviderInterface;
use Balwan\RockPaperScissor\Exceptions\MissingDataException;
use Balwan\RockPaperScissor\Players\Player;
use Requests;

/**
 * Class GooglePlus
 * @package Balwan\RockPaperScissor\DataProvider\Provider
 */
class GooglePlus implements DataProviderInterface {
    /**
     * The URL of the API that will be called to obtain data.
     * @var string
     */
    const URL = "https://www.googleapis.com/plus/v1/activities";

    /**
     * @var string
     */
    private $apiKey;

    /**
     * The maximum number of results to be returned by the API call.
     * @var int
     */
    private $maxResults;

    /**
     * GooglePlus constructor.
     * @param string $apiKey
     * @param int $maxResults
     */
    public function __construct(string $apiKey, int $maxResults = 20)
    {
        $this->apiKey = $apiKey;
        $this->maxResults = $maxResults;
    }

    /**
     * Query the data provider for data and return all the players that will be participating and what play they did.
     * @param string $query The query to search for. This should be a #hashtag ideally.
     * @return array The list of players from this provider and what their play was
     */
    public function get(string $query) : array
    {
        $query = trim(mb_strtolower($query));
        if(mb_strlen($query) == 0) {
            throw new MissingDataException("You must specify a query to be made to the API.");
        }

        $players = [];
        $play = ucfirst($query);

        $parameters = [
            "key" => $this->apiKey,
            "query" => "#".$query,
            "maxResults" => $this->maxResults
        ];

        $headers = [
            "Accept" => "application/json",
            "Accept-Encoding" => "gzip"
        ];

        $q = http_build_query($parameters);

        $response = Requests::get(GooglePlus::URL."?".$q, $headers);
        $data = json_decode($response->body);

        foreach($data->items as $d) {
            $players[] = new Player($d->actor->displayName, $play);
        }

        return count($players) % 2 == 0 ? $players : array_slice($players, 0, count($players) - 1);
    }
}
