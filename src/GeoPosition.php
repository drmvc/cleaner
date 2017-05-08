<?php namespace DrMVC\Helpers;

/**
 * Simple GeoPosition class based on below answer
 * @link http://stackoverflow.com/a/17286519/7977798
 * @package DrMVC\Helpers
 */
class GeoPosition
{

    /**
     * Generate array of random coordinates for tests
     *
     * @param int $count - Count of results
     * @param int $radius - In kilometers
     * @return array
     */
    public static function randomCoordinates($count = 1, $radius = 100)
    {
        $result = array();
        // If count is set
        for ($i = 0; $i < $count; $i++) {
            // Random angle (from 0 bad idea)
            $angle = deg2rad(mt_rand(1, 359));
            // Random radius (from 0 bad idea)
            $pointRadius = mt_rand(1, $radius);
            // Result array
            $result[] = array(
                // Latitude
                sin($angle) * $pointRadius,
                // Longitude
                cos($angle) * $pointRadius
            );
        }

        return $result;
    }

    /**
     * The length of an arc of a unit circle is numerically equal to
     * the measurement in radians of the angle that it subtends.
     *
     * @link https://en.wikipedia.org/wiki/Radian
     * @param string $degree - The number needed to calculate radians
     * @return float|int
     */
    public static function radians($degree)
    {
        return $degree * M_PI / 180;
    }

    /**
     * Return array of coordinates within some radius
     *
     * @param array $coordinates - Multidimensional array of coordinates [[latitude,longitude],[latitude,longitude],[latitude,longitude]]
     * @param array $center - Simple array with coordinates [latitude,longitude]
     * @param string $radius - In kilometers or meters (1 - km, .1 - 100 meters)
     * @return array - Simple array with LAT,LON coordinates which are within the radius
     */
    public static function getCoordinatesWithinRadius($coordinates, $center, $radius)
    {
        $resultArray = array();
        $lat1 = $center[0];
        $long1 = $center[1];
        foreach ($coordinates as $coordinate) {
            $lat2 = $coordinate[0];
            $long2 = $coordinate[1];
            $distance = 3959 * acos(cos(self::radians($lat1)) * cos(self::radians($lat2)) * cos(self::radians($long2) - self::radians($long1)) + sin(self::radians($lat1)) * sin(self::radians($lat2)));
            if ($distance < $radius) $resultArray[] = $coordinate;
        }
        return $resultArray;
    }

}
