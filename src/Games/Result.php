<?php
/**
 * Created by PhpStorm.
 * User: rvelhote
 * Date: 3/13/16
 * Time: 8:33 PM
 */

namespace Balwan\RockPaperScissor\Games;


use Balwan\RockPaperScissor\Rules\Rule;

class Result
{
    /**
     * @var string
     */
    private $outcome = "";

    /**
     * Result constructor.
     * @param string $outcome
     */
    public function __construct(Rule $rule)
    {
        $this->outcome = $rule;
    }
}