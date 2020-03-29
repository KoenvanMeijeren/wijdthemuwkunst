<?php

declare(strict_types=1);

if (!function_exists('dd')) {
    /**
     * Var dump the variable and die the script.
     *
     * @param mixed ...$expression The expression to debug.
     */
    function dd(...$expression)
    {
        foreach ($expression as $item) {
            echo '<pre>';
            var_dump($item);
        }

        die;
    }
}

if (!function_exists('arrayReplaceKeys')) {
    /**
     * This function replaces the keys of an associate array by those supplied in the keys array.
     *
     * @param array $array target associative array in which the keys are intended to be replaced
     * @param array $keys associate array where search key => replace by key, for replacing respective keys
     *
     * @return array with replaced keys
     */
    function arrayReplaceKeys(array $array, array $keys)
    {
        foreach ($keys as $search => $replace) {
            if (array_key_exists($search, $array)) {
                $array[$replace] = $array[$search];
                unset($array[$search]);
            }
        }

        return $array;
    }
}

if (!function_exists('parseHtmlEntities')) {
    /**
     * Parse the data into HTML entities.
     *
     * @param string $data the data to be parsed
     *
     * @return string
     */
    function parseHtmlEntities(string $data)
    {
        return html_entity_decode(htmlspecialchars_decode($data));
    }
}

if (!function_exists('replaceString')) {
    /**
     * Replace all found strings in a string.
     *
     * @param string $toRemove the string to be replaced
     * @param string $toReplace the new value of the string
     *                          which is going to be replaced
     * @param string $string the string to search in
     * @param int $limit limit the number of matches
     *
     * @return string
     */
    function replaceString(
        string $toRemove,
        string $toReplace,
        string $string,
        int $limit = -1
    ) {
        return (string)preg_replace(
            '/\b(' . $toRemove . ')\b/',
            $toReplace,
            $string,
            $limit
        );
    }
}

if (!function_exists('replaceDot')) {
    /**
     * Replace all found strings in a string.
     *
     * @param string $toReplace the new value of the string
     *                          which is going to be replaced
     * @param string $string the string to search in
     * @param int $limit limit the number of matches
     *
     * @return string
     */
    function replaceDot(
        string $toReplace,
        string $string,
        int $limit = -1
    ) {
        return (string)preg_replace(
            '/\./',
            $toReplace,
            $string,
            $limit
        );
    }
}

if (!function_exists('replaceAllExceptFirstString')) {
    /**
     * Replace all found strings in a string.
     *
     * @param string $toRemove the string to be replaced
     * @param string $toReplace the new value of the string
     *                          which is going to be replaced
     * @param string $string the string to search in
     *
     * @return string
     */
    function replaceAllExceptFirstString(
        string $toRemove,
        string $toReplace,
        string $string
    ) {
        return replaceString(
            $toReplace,
            $toRemove,
            replaceString(
                $toRemove,
                $toReplace,
                $string
            ),
            1
        );
    }
}

if (!function_exists('isJson')) {
    /**
     * Determine if the given data is of the type of json.
     *
     * @param string $data the data to be checked.
     *
     * @return bool
     */
    function isJson(string $data)
    {
        if ($data === '') {
            return false;
        }

        try {
            json_decode(
                $data,
                true,
                512,
                JSON_THROW_ON_ERROR
            );
        } catch (Exception $exception) {
            return false;
        }

        return true;
    }
}

if (!function_exists('randomString')) {
    /**
     * Generate a random string, using a cryptographically secure
     * pseudorandom number generator (random_int)
     *
     * This function uses type hints now (PHP 7+ only), but it was originally
     * written for PHP 5 as well.
     *
     * For PHP 7, random_int is a PHP core function
     * For PHP 5.x, depends on https://github.com/paragonie/random_compat
     *
     * @param int $length How many characters do we want?
     * @param string $keyspace A string of all possible characters
     *                              to select from
     *
     * @return string
     * @throws Exception
     */
    function randomString(
        int $length = 64,
        string $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
    ): string {
        if ($length < 1) {
            throw new RangeException('Length must be a positive integer');
        }

        $pieces = [];
        $max = mb_strlen($keyspace, '8bit') - 1;
        for ($i = 0; $i < $length; ++$i) {
            $pieces [] = $keyspace[random_int(0, $max)];
        }

        return implode('', $pieces);
    }
}

if (!function_exists('stripWhitespace')) {
    /**
     * Remove al the whitespaces from the string.
     *
     * @param string $string
     * @return string
     */
    function stripWhitespace(string $string)
    {
        return trim($string);
    }
}

if (!function_exists('encodeUrl')) {
    /**
     * Encode a string into a url-save string.
     *
     * Test string: Mess'd up --text-- just (to) stress /test/ ?our! `little` \\clean\\ url fun.ction!?-->
     *
     * @param string $string
     * @param array $replace
     * @param string $delimiter
     *
     * @return string
     */
    function encodeUrl(string $string, array $replace = [], string $delimiter = '-')
    {
        if (count($replace) > 1) {
            $string = str_replace($replace, ' ', $string);
        }

        $charset = (string) iconv(
            'UTF-8',
            'ASCII//TRANSLIT',
            $string
        );
        $clean = (string) preg_replace(
            "/[^a-zA-Z0-9\/_|+ -]/",
            '',
            $charset
        );
        $trimmedString = strtolower(trim($clean, '-'));
        $clean = (string) preg_replace(
            "/[\/_|0-9+ -]+/",
            $delimiter,
            $trimmedString
        );

        return $clean;
    }
}

if (!function_exists('validateDate')) {
    /**
     * Check if the given date is a correct type.
     *
     * @param string $date The date to be checked.
     * @param string $format The format of the date.
     *
     * @return bool
     */
    function validateDate($date, $format = 'Y-m-d')
    {
        $d = DateTime::createFromFormat($format, $date);

        return $d && $d->format($format) === $date;
    }
}
