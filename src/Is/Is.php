<?php

namespace Is;

use SplFileInfo;

class Is
{
    const JPEG = 'jpeg';

    const JPG = 'jpeg';

    const GIF = 'gif';

    const BMP = 'x-ms-bmp';

    const PNG = 'png';

    private function __construct()
    {
        /*
         *
         */
    }

    private function __clone()
    {
        /*
         *
         */
    }

    /**
     * @param  string $path
     *
     * @return bool
     */
    public static function is_file(string $path)
    {
        return @is_file($path) === true;
    }

    /**
     * @param  string $url
     *
     * @return bool
     */
    public static function is_url(string $url)
    {
        return filter_var($url, FILTER_VALIDATE_URL) !== false;
    }

    /**
     * @param $splFile
     *
     * @return bool
     *
     * @link http://php.net/manual/en/class.splfileinfo.php
     */
    public static function is_splFileInfo($splFile)
    {
        return $splFile instanceof SplFileInfo;
    }

    /**
     * @param  mixed             $image
     * @param  array|string|null $format
     *
     * @return bool
     */
    public static function is_image($image, $format = null)
    {
        // url file content
        if (is_string($image)) {
            if (!static::is_url($image) && !static::is_file($image)) {
                /**
                 * 既不是 url 也不是 file.
                 */
                $image = @getimagesizefromstring($image);
            } else {
                $image = @getimagesize($image);
            }
        } elseif (self::is_splFileInfo($image)) {
            /*
             * SplFileInfo -> file
             */
            $image = @getimagesize($image->getRealPath());
        } elseif (is_resource($image)) {
            $image = @getimagesizefromstring(stream_get_contents($image));
        } else {
            $image = false;
        }

        $bool = $image !== false;

        if (is_null($format)) {
            return $bool;
        }

        if ($bool) {
            if (is_array($format)) {
                return in_array(static::getImageFormat($image), $format);
            }

            return static::getImageFormat($image) === $format;
        }

        return false;
    }

    /**
     * @param array $image
     *
     * @return string
     */
    private static function getImageFormat(array $image)
    {
        $array = explode('/', $image['mime']);

        return $array[1];
    }

    /**
     * @return string
     */
    private static function getTemp()
    {
        if (PHP_OS === 'WINNT') {
            return getenv('Temp').DIRECTORY_SEPARATOR.session_create_id();
        }

        return '/tmp/'.session_create_id();
    }

    /**
     * @param string $string
     *
     * @return string
     */
    public static function str2file(string $string)
    {
        $file = static::getTemp();
        file_put_contents($file, $string);

        return $file;
    }
}
