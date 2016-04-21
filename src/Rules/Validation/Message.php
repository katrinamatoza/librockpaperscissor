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
namespace Balwan\RockPaperScissor\Rules\Validation;

/**
 * Class Message
 * @package RockPaperScissor\Rules\Validation
 * @todo Message shouldn't necessarily be in the Validation package as it could be used in other situations.
 */
class Message
{
    /**
     * Message type that represents and error or some sort of serious problem.
     */
    const FAIL = 0;

    /**
     * Message type that represents a warning or a situation that the user should resolve.
     */
    const WARNING = 1;

    /**
     * Message type that says everything is ok.
     */
    const OK = 2;

    /**
     * Message type that represents an information that requires no action.
     */
    const INFO = 3;

    /**
     * The message that will be displayed to the user or the developer of the library.
     * @var string
     */
    private $message;

    /**
     * The type of message. Check out the constants of this class.
     * @var int
     */
    private $type;

    /**
     * Instantiates a new message.
     * @param string $message The text of the message that will be displayed or logged.
     * @param int $type The type of message.
     */
    public function __construct(string $message, int $type = Message::INFO)
    {
        $this->message = $message;
        $this->type = $type;
    }

    /**
     * Obtain the text of the message.
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Obtain the type of message.
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }
}