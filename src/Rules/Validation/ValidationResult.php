<?php
/**
 * Created by PhpStorm.
 * User: rvelhote
 * Date: 3/14/16
 * Time: 8:37 PM
 */

namespace Balwan\RockPaperScissor\Rules\Validation;


use Balwan\RockPaperScissor\Rules\Validation\Message;

class ValidationResult
{
    /**
     * @var int
     */
    public $totalWeapons = 0;

    /**
     * @var array
     */
    public $weapons = [];

    /**
     * @var array
     */
    public $messages = [];

    /**
     * @param Message $message
     */
    public function addMessage(Message $message) {
        $this->messages[] = $message;
    }

}