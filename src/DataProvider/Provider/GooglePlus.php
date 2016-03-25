<?php
/**
 *
 */
namespace Balwan\RockPaperScissor\DataProvider\Provider;

use Balwan\RockPaperScissor\Players\Player;
use Requests;
use Balwan\RockPaperScissor\DataProvider\DataProviderInterface;
use Balwan\RockPaperScissor\Players\Players;

/**
 * Class Twitter
 * @package Balwan\RockPaperScissor\DataProvider
 */
class GooglePlus implements DataProviderInterface {
    public function __construct(string $apiKey)
    {
    }

    /**
     * Query the data provider for data and return all the players that will be participating and what play they did.
     * @param string $query The query to search for. This should be a #hashtag ideally.
     * @return array The list of players from this provider and what their play was
     */
    public function get(string $query) : array
    {
        $players = [];

        $parameters = [
            "key" => "xxxxxx",
            "query" => "#".$query,
            "maxResults" => 20
        ];

        $headers = array('Accept' => 'application/json', "Accept-Encoding" => "gzip");

        $url = "https://www.googleapis.com/plus/v1/activities";
        $q = http_build_query($parameters);

        $response = Requests::get($url."?".$q, $headers);

        $data = json_decode($response->body);

        foreach($data->items as $d) {
            $players[] = new Player($d->actor->displayName, $query);
        }

        return $players;
    }
}
