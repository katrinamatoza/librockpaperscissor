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
namespace Balwan\RockPaperScissor\Validation;

/**
 * Class ValidationResult
 * @package Balwan\RockPaperScissor\Rule\Validation
 */
class ValidationResult
{
    /**
     * @var array
     */
    private $messages = [];

    /**
     * @param ValidationMessage $message
     */
    public function addMessage(ValidationMessage $message) {
        $this->messages[] = $message;
    }

    /**
     * @param array $messages
     */
    public function addMessages(array $messages)
    {
        $this->messages = array_merge($this->messages, $messages);
    }

    /**
     * @return array
     */
    public function getMessages() : array
    {
        return $this->messages;
    }

    /**
     *
     * @return bool
     */
    public function isValid() : bool
    {
        $fn = function(int $carry, ValidationMessage $m) {
            if($m->getType() === ValidationMessage::FAIL) {
                return $carry + 1;
            }

            return $carry;
        };

        return array_reduce($this->messages, $fn, 0) === 0;
    }
}