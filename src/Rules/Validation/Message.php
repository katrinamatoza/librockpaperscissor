<?php
/**
 * Created by PhpStorm.
 * User: rvelhote
 * Date: 3/14/16
 * Time: 8:58 PM
 */

namespace Balwan\RockPaperScissor\Rules\Validation;

/**
 * Class Message
 * @package RockPaperScissor\Rules\Validation
 */
class Message
{
    /**
     *
     */
    const FAIL = 0;

    /**
     *
     */
    const WARNING = 1;

    /**
     *
     */
    const OK = 2;

    /**
     * @var string
     */
    private $message;

    /**
     * @var int
     */
    private $type;

    /**
     * Message constructor.
     * @param string $message
     * @param int $type
     */
    public function __construct(string $message, int $type)
    {
        $this->message = $message;
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }



}