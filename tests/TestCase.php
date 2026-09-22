<?php

/*
 * This file is part of the Geotools library.
 *
 * (c) Antoine Corcy <contact@sbin.dk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace League\Geotools\Tests;

use Geocoder\Model\Address;
use League\Geotools\Coordinate\CoordinateInterface;
use League\Geotools\Coordinate\Ellipsoid;
use PHPUnit\Framework\TestCase as PHPUnitTestCase;

/**
 * @author Antoine Corcy <contact@sbin.dk>
 */
abstract class TestCase extends PHPUnitTestCase
{
    /**
     * @param float|null $lat
     * @param float|null $lng
     * @return CoordinateInterface
     */
    protected function getStubCoordinate($lat = null, $lng = null)
    {
        $stub = $this->createMock('\League\Geotools\Coordinate\CoordinateInterface');

        if (null !== $lat) {
            $stub->method('getLatitude')->willReturn($lat);
        }
        if (null !== $lng) {
            $stub->method('getLongitude')->willReturn($lng);
        }

        return $stub;
    }

    /**
     * @param array $coordinate
     * @param ?Ellipsoid $ellipsoid
     *
     * @return CoordinateInterface
     */
    protected function getMockCoordinateReturns(array $coordinate, ?Ellipsoid $ellipsoid = null)
    {
        $mock = $this->createMock('\League\Geotools\Coordinate\CoordinateInterface');
        $mock
            ->method('getLatitude')
            ->will($this->returnValue($coordinate[0]));
        $mock
            ->method('getLongitude')
            ->will($this->returnValue($coordinate[1]));

        if ($ellipsoid) {
            $mock
                ->expects($this->atLeastOnce())
                ->method('getEllipsoid')
                ->will($this->returnValue($ellipsoid));
        }

        return $mock;
    }

	/**
     * Create an empty address object
     *
     * @return array
     */
    protected function createEmptyAddress()
    {
        return [0, 0];
    }
}
