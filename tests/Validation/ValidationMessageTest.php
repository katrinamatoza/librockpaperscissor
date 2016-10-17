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
 * Class MessageTest
 * @package Welhott\RockPaperScissor\Rule\Validation
 */
class ValidationMessageTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test the creation of a message with only the mandatory parameters set.
     * The message type should be INFO
     */
    public function testValidationMessage()
    {
        $message = new ValidationMessage("Test Message");
        $this->assertEquals("Test Message", $message->getMessage(), "The message returned by getMessage is incorrect!");
        $this->assertEquals(ValidationMessage::INFO, $message->getType(), "Message should be of type INFO");
    }

    /**
     * Test the creation of a message with all parameters.
     * The message type should be OK.
     */
    public function testMessageType()
    {
        $message = new ValidationMessage("Test Message", ValidationMessage::OK);
        $this->assertEquals(ValidationMessage::OK, $message->getType(), "Message should be of type OK");
    }
}
