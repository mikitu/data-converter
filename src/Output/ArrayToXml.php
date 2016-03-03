<?php

namespace App\Output;

use App\Contract\DataSourceInterface;
use App\Contract\OutputInterface;
use App\Helper\InvalidDataSourceException;
use App\Helper\StringHelper;

class ArrayToXml extends AbstractOutput implements OutputInterface
{
    /**
     * @return $this
     */
    public function convert()
    {
        $data = $this->ds->getData();
        $this->convertedObj = $this->buildNode($data);
        return $this;
    }

    /**
     * test data source against type array
     * @return bool
     * @throws InvalidDataSourceException
     */
    public function validateDataSource()
    {
        if (! is_array($this->ds->getData())) {
            throw new InvalidDataSourceException;
        }
        return true;
    }

    /**
     * @param \SimpleXMLElement $xml
     * @param array $attr
     * @return \SimpleXMLElement
     */
    private function addAttributes(\SimpleXMLElement $xml, array $attr)
    {
        foreach ($attr as $name => $value) {
            $xml->addAttribute($name, $value);
        }
        return $xml;
    }

    /**
     * @param $data
     * @return \SimpleXMLElement
     */
    protected function buildNode($data, $xml = null)
    {
        $newNode = null;
        if (isset($data['name'])) {
            $xml = $this->createNode($data, $xml);
        }
        if (isset($data['attr'])) {
            $this->addAttributes($xml, $data['attr']);
        }
        if (isset($data['children']) && is_array($data['children'])) {
            foreach ($data['children'] as $child) {
                $this->buildNode($child, $xml);
            }
        }
        return $xml;
    }

    /**
     * @param $data
     * @return bool
     */
    private function isTextNode($data)
    {
        if (! array_key_exists('children', $data)) {
            return false;
        }
        return $this->firstChildIsTextNode($data['children']);
    }

    /**
     * @param $data
     * @return bool
     */
    private function firstChildIsTextNode($data)
    {
        if (isset($data['name'])) {
            return false;
        }
        if (isset($data[0]) && is_array($data[0])) {
            return false;
        }
        return true;
    }
    /**
     * @param $data
     * @return string node text
     */
    private function getTextNode($data)
    {
        return array_key_exists(0, $data) ? $data[0] : '';
    }

    /**
     * @param $data
     * @param $xml
     * @return \SimpleXMLElement
     */
    protected function addChild($data, &$xml)
    {
        if ($this->isTextNode($data)) {
            return $xml->addChild($data['name'], $this->getTextNode($data['children']));
        }
        return $node = $xml->addChild($data['name']);
    }

    /**
     * @return string
     */
    public function getNormalized()
    {
        return StringHelper::normalizeXML($this->convertedObj->asXML());
    }

    /**
     * @param $data
     * @param $xml
     * @return \SimpleXMLElement
     */
    protected function createNode($data, $xml)
    {
        if (is_null($xml)) {
            return new \SimpleXMLElement("<$data[name]/>");
        }
        return $this->addChild($data, $xml);
    }
}