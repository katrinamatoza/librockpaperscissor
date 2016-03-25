<?php

namespace Balwan\RockPaperScissor\DataProvider;

use Balwan\RockPaperScissor\Players\Players;

interface DataProviderInterface
{
    /**
     * Query the data provider for data and return all the players that will be participating and what play they did.
     * @param string $query The query to search for. This should be a #hashtag ideally.
     * @return array The list of players from this provider and what their play was
     */
    public function get(string $query) : array;
}