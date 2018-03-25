<?php

namespace Is;

/**
 *
 */
class Is
{
    const JPEG = 'jpeg';

    const JPG = 'jpeg';

    const GIF = 'gif';

    const BMP = 'x-ms-bmp';

    const PNG = 'png';

    private function __construct()
    {
        /**
         *
         */
    }

    private function __clone()
    {
        /**
         *
         */
    }

    /**
     * @param $path
     * @return bool
     */
    public static function is_path($path)
    {
        return is_file($path);
    }

    /**
     * @param string $url
     * @return bool
     */
    public static function is_url(string $url)
    {
        return filter_var($url, FILTER_VALIDATE_URL) !== false;
    }

    /**
     * @param string $image
     * @param null $format
     * @return bool
     */
    public static function is_image(string $image, $format = null)
    {
        if (!static::is_url($image) && !static::is_path($image)) {
            return false;
        };

        $image = getimagesize($image);
        $bool = $image !== false;

        if (is_null($format)) {

            return $bool;
        }

        if ($bool) {
            $type = $image['mime'];

            return $type === "image/$format";
        }

        return false;
    }
}
