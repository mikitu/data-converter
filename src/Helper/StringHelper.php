<?php

namespace App\Helper;

class StringHelper
{
    /**
     * @param string $expectedOutput
     * @return string
     */
    public static function normalizeXML($expectedOutput)
    {
        //remove new lines and tabs
        $expectedOutput = preg_replace('/[\n\t]+/', '', $expectedOutput);
        //remove spaces between tags
        $expectedOutput = preg_replace('/>(\s)+</', '><', $expectedOutput);
        return $expectedOutput;
    }

}