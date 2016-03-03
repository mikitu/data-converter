<?php

namespace App\DataSource;

use App\Contract\DataSourceInterface;

class XmlDataSource implements DataSourceInterface
{
    /**
     * @return \SimpleXMLElement
     */
    public function getData()
    {
        $xmlStr = <<<XML
<account id="123456">
    <name>BBC</name>
    <monitors>
        <monitor id="5235632">
            <url>http://www.bbc.co.uk/</url>
        </monitor>
        <monitor id="5235633">
            <url>http://www.bbc.co.uk/news</url>
        </monitor>
    </monitors>
</account>
XML;
        return new \SimpleXMLElement($xmlStr);

    }
}