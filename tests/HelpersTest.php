<?php
namespace Dompdf\Tests;

use Dompdf\Helpers;
use Dompdf\Tests\TestCase;

class HelpersTest extends TestCase
{
    public function testParseDataUriBase64Image()
    {
        $imageParts = [
            'mime' => 'data:image/png;base64,',
            'data' => 'iVBORw0KGgoAAAANSUhEUgAAAAUA
AAAFCAYAAACNbyblAAAAHElEQVQI12P4//8/w38GIAXDIBKE0DHxgljNBAAO
9TXL0Y4OHwAAAABJRU5ErkJggg=='
        ];
        $result = Helpers::parse_data_uri(implode('', $imageParts));
        $this->assertEquals(
            $result['data'],
            base64_decode($imageParts['data'])
        );
    }

    public function dec2RomanProvider(): array
    {
        return [
            [-5, "-5"],
            [0, "0"],
            [1, "i"],
            [5, "v"],
            [3999, "mmmcmxcix"],
            [4000, "4000"],
            [50000, "50000"],
        ];
    }

    /**
     * @dataProvider dec2RomanProvider
     */
    public function testDec2Roman($number, $expected)
    {
        $roman = Helpers::dec2roman($number);
        $this->assertSame($expected, $roman);
    }
}
