<?php
/**
 * Utility class used for working with URLs
 *
 * Standard: PSR-2
 * @link http://www.php-fig.org/psr/psr-2
 *
 * @package SnapLib
 * @copyright (c) 2017, Snapcreek LLC
 * @license	https://opensource.org/licenses/GPL-3.0 GNU Public License
 *
 */
defined('ABSPATH') || defined('DUPXABSPATH') || exit;

if (!class_exists('DupProSnapLibURLU', false)) {

    class DupProSnapLibURLU
    {

        protected static $DEF_ARRAY_PARSE_URL = array(
            'scheme'   => false,
            'host'     => false,
            'port'     => false,
            'user'     => false,
            'pass'     => false,
            'path'     => '',
            'scheme'   => false,
            'query'    => false,
            'fragment' => false
        );

        /**
         * Append a new query value to the end of a URL
         *
         * @param string $url   The URL to append the new value to
         * @param string $key   The new key name
         * @param string $value The new key name value
         *
         * @return string Returns the new URL with with the query string name and value
         */
        public static function appendQueryValue($url, $key, $value)
        {
            $separator    = (parse_url($url, PHP_URL_QUERY) == NULL) ? '?' : '&';
            $modified_url = $url."$separator$key=$value";

            return $modified_url;
        }

        /**
         * Fetches current URL via php
         *
         * @param bool $queryString If true the query string will also be returned.
         *
         * @returns The current page url
         */
        public static function getCurrentUrl($queryString = true)
        {
            $protocol = 'http';
            if ($_SERVER['SERVER_PORT'] == 443 || (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on')) {
                $protocol     .= 's';
                $protocolPort = $_SERVER['SERVER_PORT'];
            } else {
                $protocolPort = 80;
            }
            $host    = $_SERVER['HTTP_HOST'];
            $port    = $_SERVER['SERVER_PORT'];
            $request = $_SERVER['PHP_SELF'];

            $query = ($queryString === TRUE) ? $_SERVER['QUERY_STRING'] : "";
            $url   = $protocol.'://'.$host.($port == $protocolPort ? '' : ':'.$port).$request.(empty($query) ? '' : '?'.$query);
            return $url;
        }

        /**
         * this function is a native PHP parse_url wrapper
         * this function returns an associative array with all the keys present and the values = false if they do not exist.
         * 
         * @param string $url <p>The URL to parse. Invalid characters are replaced by <i>_</i>.</p>
         * @param int $component
         * @return mixed <p>On seriously malformed URLs, <b>parse_url()</b> may return <b><code>FALSE</code></b>.</p><p>If the <code>component</code> parameter is omitted, an associative <code>array</code> is returned. At least one element will be present within the array. Potential keys within this array are:</p><ul> <li>  scheme - e.g. http  </li> <li>  host  </li> <li>  port  </li> <li>  user  </li> <li>  pass  </li> <li>  path  </li> <li>  query - after the question mark <i>&#63;</i>  </li> <li>  fragment - after the hashmark <i>#</i>  </li> </ul><p>If the <code>component</code> parameter is specified, <b>parse_url()</b> returns a <code>string</code> (or an <code>integer</code>, in the case of <b><code>PHP_URL_PORT</code></b>) instead of an <code>array</code>. If the requested component doesn't exist within the given URL, <b><code>NULL</code></b> will be returned.</p>
         */
        public static function parseUrl($url, $component = -1)
        {
            $result = parse_url($url, $component);
            if (is_array($result)) {
                $result = array_merge(self::$DEF_ARRAY_PARSE_URL, $result);
            }

            return $result;
        }

        /**
         * this function build a url from array result of parse url.
         * if work with both parse_url native function result and snap parseUrl result
         * 
         * @param array $parts
         * @return bool|string return false if param isn't array
         */
        public static function buildUrl($parts)
        {
            if (!is_array($parts)) {
                return false;
            }

            $result = '';
            $result .= (isset($parts['scheme']) && $parts['scheme'] !== false) ? $parts['scheme'].':' : '';
            $result .= (
                (isset($parts['user']) && $parts['user'] !== false) ||
                (isset($parts['host']) && $parts['host'] !== false)) ? '//' : '';

            $result .= (isset($parts['user']) && $parts['user'] !== false) ? $parts['user'] : '';
            $result .= (isset($parts['pass']) && $parts['pass'] !== false) ? ':'.$parts['pass'] : '';
            $result .= (isset($parts['user']) && $parts['user'] !== false) ? '@' : '';

            $result .= (isset($parts['host']) && $parts['host'] !== false) ? $parts['host'] : '';
            $result .= (isset($parts['port']) && $parts['port'] !== false) ? ':'.$parts['port'] : '';

            $result .= (isset($parts['path']) && $parts['path'] !== false) ? $parts['path'] : '';
            $result .= (isset($parts['query']) && $parts['query'] !== false) ? '?'.$parts['query'] : '';
            $result .= (isset($parts['fragment']) && $parts['fragment'] !== false) ? '#'.$parts['fragment'] : '';

            return $result;
        }
    }
}