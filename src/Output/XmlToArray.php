<?php

namespace App\Output;

use App\Contract\OutputInterface;
use App\Helper\InvalidDataSourceException;

class XmlToArray extends AbstractOutput implements OutputInterface
{

    /**
     * @return $this App\Output\XmlToArray
     */
    public function convert()
    {
        $data = $this->ds->getData();
        $iterator = new \SimpleXmlIterator($data->asXML());
        $this->convertedObj = $this->sxiToArray($iterator);
        return $this;
    }

    /**
     * @param \SimpleXmlIterator $sxi
     * @return array
     */
    function sxiToArray (\SimpleXmlIterator $sxi)
    {
        $out['name'] = $sxi->getName();
        $out['attr'] = $this->getAttributes($sxi);
        $out['children'] = [];
        if (! $sxi->count()) {
            $out['children'][] = strval($sxi);
        }
        for( $sxi->rewind(); $sxi->valid(); $sxi->next() ) {
            $out['children'][] = $this->sxiToArray($sxi->current());
        }
        return $out;
    }

    /**
     * @param $sxi
     * @return array
     */
    private function getAttributes(\SimpleXmlIterator $sxi)
    {
        $attrs = (array)$sxi->attributes();
        if (isset($attrs['@attributes'])) {
            return $attrs['@attributes'];
        }
        return [];
    }

    /**
     * @return bool
     * @throws InvalidDataSourceException
     */
    public function validateDataSource()
    {
        if (! $this->ds->getData() instanceof \SimpleXMLElement) {
            throw new InvalidDataSourceException;
        }
        return true;
    }

}