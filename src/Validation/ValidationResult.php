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
namespace Welhott\RockPaperScissor\Validation;

/**
 * Class ValidationResult
 * @package Welhott\RockPaperScissor\Rule\Validation
 */
class ValidationResult
{
    /**
     * The list of messages that will be available after the validation if ran.
     * @var array
     */
    private $messages = [];

    /**
     * Adds a new validation message to the list
     * @param ValidationMessage $message A validation message to add to the list
     */
    public function addMessage(ValidationMessage $message) {
        $this->messages[] = $message;
    }

    /**
     * Adds multiples messages to the list of messages
     * @param array $messages The set of messages to add to the list
     * @see ValidationMessage
     */
    public function addMessages(array $messages)
    {
        $this->messages = array_merge($this->messages, $messages);
    }

    /**
     * Obtain the list of messages currently in this object
     * @return array A list of messages
     */
    public function getMessages() : array
    {
        return $this->messages;
    }

    /**
     * Checks if there are not FAIL messages in this list of messages.
     * @return bool true|false depending if there are/aren't messages with ValidationMessage::FAIL status.
     * @todo Why am I using array_reduce? Looks cool maybe...
     */
    public function isValid() : bool
    {
        $function = function(int $carry, ValidationMessage $message) {
            if($message->getType() === ValidationMessage::FAIL) {
                return $carry + 1;
            }

            return $carry;
        };
        return array_reduce($this->messages, $function, 0) === 0;
    }
}