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
namespace Balwan\RockPaperScissor\DataProvider;

use Balwan\RockPaperScissor\Move\MoveCollection;

/**
 * Interface DataProviderInterface
 * @package Balwan\RockPaperScissor\DataProvider
 */
interface DataProviderInterface
{
    /**
     * Query the data provider for data and return all the players that will be participating in the series of matches
     * and the play that they performed.
     *
     * Ideally, the size of the collection should be an even number so you can pair
     * the players 1vs1 but the implementation is yours.
     *
     * This interface only specified the data source and does and should not handle the games themselves.
     *
     * @param string $query The query to search for. This should be a #hashtag ideally.
     * @return MoveCollection The list of players from this provider and what their play was
     * @see MoveCollection
     */
    public function get(string $query) : MoveCollection;
}