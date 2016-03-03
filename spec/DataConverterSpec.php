<?php

namespace spec\App;

use App\DataSource\ArrayDataSource;
use App\DataSource\WrongDataSource;
use App\DataSource\XmlDataSource;
use App\Helper\StringHelper;
use App\Output\ArrayToXml;
use App\Output\XmlToArray;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DataConverterSpec extends ObjectBehavior
{
    function Let()
    {
        $this->beConstructedWith(new ArrayDataSource);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('App\DataConverter');
        $this->shouldHaveType('App\Contract\DataConverterInterface');
    }
    function it_should_throw_exception_if_invalid_data_source()
    {
        $this->beConstructedWith(new WrongDataSource);
        $this->shouldThrow('App\Helper\InvalidDataSourceException')->duringConvertTo(new ArrayToXml);
    }

    function it_should_convert_array_to_xml()
    {
        $this->convertTo(new ArrayToXml)
            ->getNormalized()
            ->shouldBeLike(
                StringHelper::normalizeXML((new \App\DataSource\XmlDataSource)->getData()->asXML())
            );
    }

    function it_should_convert_xml_to_array()
    {
        $this->beConstructedWith(new XmlDataSource);
        $this->convertTo(new XmlToArray)
            ->getConverted()
            ->shouldBeLike(
                (new \App\DataSource\ArrayDataSource)->getData()
            );
    }
}
