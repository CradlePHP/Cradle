<?php //-->
/**
 * This file is part of the Cradle PHP Library.
 * (c) 2016-2018 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE.txt
 * distributed with this package.
 */

namespace Cradle\Module\Utility;

use Aws\S3\S3Client;
use Aws\S3\PostObjectV4;

/**
 * Typical model create action steps
 *
 * @vendor   Cradle
 * @package  Framework
 * @author   John Doe <john@acme.com>
 * @standard PSR-2
 */
class File
{
    /**
     * @var array $extensions static list of mime to extensions
     */
    public static $extensions = [];

    /**
     * Uploads base64 based data
     * and sends it to S3
     *
     * @param *string $data
     * @param *string $config
     * @param *string $destination
     *
     * @return string
     */
    public static function base64ToS3($data, $config, $destination = 'upload/')
    {
        //if there's no service
        if (!$config) {
            //we cannot continue
            return $data;
        }

        //if it's not configured
        if ($config['token'] === '<AWS TOKEN>'
            || $config['secret'] === '<AWS SECRET>'
            || $config['bucket'] === '<S3 BUCKET>'
            || $config['region'] === '<AWS REGION>'
        ) {
            return $data;
        }

        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $data[$key] = self::base64ToS3($data, $config, $destination);
            }

            return $data;
        }

        //if not base 64
        if (strpos($data, ';base64,') === false) {
            //we don't need to convert
            return $data;
        }

        //fix destination
        if (strpos($destination, '/') === 0) {
            $destination = substr($destination, 1);
        }

        if (substr($destination, -1) !== '/') {
            $destination .= '/';
        }

        // load s3
        $s3 = S3Client::factory([
            'version' => 'latest',
            'region'  => $config['region'], //example ap-southeast-1
            'credentials' => array(
                'key'    => $config['token'],
                'secret' => $config['secret'],
            )
        ]);

        $mime = self::getMimeFromData($data);
        $extension = self::getExtensionFromData($data);
        $file = md5(uniqid()) . '.' . $extension;
        $base64 = substr($data, strpos($data, ',') + 1);
        $body = fopen('data://' . $mime . ';base64,' . $base64, 'r');

        $s3->putObject([
            'Bucket'         => $config['bucket'],
            'ACL'            => 'public-read',
            'ContentType'    => $mime,
            'Key'            => $destination . $file,
            'Body'           => $body,
            'CacheControl'   => 'max-age=43200'
        ]);

        fclose($body);

        return $config['host'] . '/' . $config['bucket'] . '/' . $destination . $file;
    }

    /**
     * Uploads base64 based data and
     * saves it to the upload folder
     *
     * @param *string $data
     * @param *string $destination
     * @param string|null $host
     *
     * @return string
     */
    public static function base64ToUpload($data, $destination, $host = null)
    {
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $data[$key] = self::base64ToUpload($value, $destination, $host);
            }

            return $data;
        }

        //if not base 64
        if (strpos($data, ';base64,') === false) {
            //we don't need to convert
            return $data;
        }

        //if not
        if (!is_dir($destination)) {
            //make one
            mkdir($destination);
        }

        if (!$host) {
            $protocol = 'http';
            if ($_SERVER['SERVER_PORT'] === 443) {
                $protocol = 'https';
            }

            $host = $protocol . '://' .$_SERVER['HTTP_HOST'];
        }

        $extension = self::getExtensionFromData($data);

        $file = '/' . md5(uniqid()) . '.' . $extension;

        $path = $destination . $file;

        //data:mime;base64,data
        $base64 = substr($data, strpos($data, ',') + 1);
        file_put_contents($path, base64_decode($base64));

        return $host . '/upload' . $file;
    }

    /**
     * Determine the Extension from data
     *
     * @param string
     * @return string
     */
    public static function getExtensionFromData($data)
    {
        $extension = 'unknown';

        $mime = self::getMimeFromData($data);
        if (isset(self::$extensions[$mime])) {
            $extension = self::$extensions[$mime];
        }

        return $extension;
    }

    /**
     * Determine the Extension from a link
     *
     * @param string
     * @return string
     */
    public static function getExtensionFromLink($link)
    {
        $extension = 'unknown';

        $path = explode('/', $link);
        $file = array_pop($path);

        if (strpos($file, '.') !== false) {
            $file = explode('.', $file);
            $extension = array_pop($file);
        }

        return $extension;
    }

    /**
     * Determine the Mime from data
     *
     * @param string
     * @return string
     */
    public static function getMimeFromData($data)
    {
        $mime  = 'application/octet-stream';

        $data = urldecode($data);
        //data:mime;base64,data
        $data = substr($data, 5);

        $chunks = explode(';base64,', $data);
        return array_shift($chunks);
    }

    /**
     * Determine the Extension from a link
     *
     * @param string
     * @return string
     */
    public static function getMimeFromLink($link)
    {
        $mime  = 'application/octet-stream';
        $extension = self::getExtensionFromLink($link);

        //find out the extension
        foreach (self::$extensions as $key => $value) {
            if ($extension === $value) {
                $mime = $key;
                break;
            }
        }

        return $mime;
    }

    /**
     * Returns a client side S3 configuration
     *
     * @param *string $config
     * @param *string $destination
     *
     * @return string
     */
    public static function getS3Client($config, $destination = 'upload/')
    {
        //if there's no service
        if (!$config) {
            //we cannot continue
            return false;
        }

        //if it's not configured
        if ($config['token'] === '<AWS TOKEN>'
            || $config['secret'] === '<AWS SECRET>'
            || $config['bucket'] === '<S3 BUCKET>'
            || $config['region'] === '<AWS REGION>'
        ) {
            return false;
        }

        //fix destination
        if (strpos($destination, '/') === 0) {
            $destination = substr($destination, 1);
        }

        if (substr($destination, -1) !== '/') {
            $destination .= '/';
        }

        // load s3
        $s3 = S3Client::factory([
            'version' => 'latest',
            'region'  => $config['region'], //example ap-southeast-1
            'credentials' => array(
                'key'    => $config['token'],
                'secret' => $config['secret'],
            )
        ]);

        $postObject = new PostObjectV4(
            $s3,
            $config['bucket'],
            [
                'acl' => 'public-read',
                'key' => $destination . md5(uniqid())
            ],
            [
                ['acl' => 'public-read'],
                ['bucket' => $config['bucket']],
                ['starts-with', '$key', $destination]
            ],
            '+2 hours'
        );

        return [
            // Get attributes to set on an HTML form, e.g., action, method, enctype
            'form' => $postObject->getFormAttributes(),
            // Get form input fields. This will include anything set as a form input in
            // the constructor, the provided JSON policy, your AWS Access Key ID, and an
            // auth signature.
            'inputs' => $postObject->getFormInputs()
        ];
    }
}
