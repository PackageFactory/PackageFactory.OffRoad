<?php
namespace PackageFactory\OffRoad\Utility;

class PatternUtility {

    /**
     * Converts the simplified OffRoad pattern syntax to a regular expression
     *
     * @param string $pattern
     * @return string
     */
    public static function translatePatternToRegex($pattern) {
        //
        // Split the pattern by '/' and iterate over the result
        //
        $parts = explode('/', $pattern);

        //
        // Check each part for flag characters and convert them
        //
        $regexParts = array();
        $restCounter = 0;

        foreach ($parts as $part) {
            switch (true) {

              //
              // Convert rest syntax
              //
              case $part === '...':
                    $regexParts[] = sprintf('(?P<__rest%d>.+)', $restCounter++);
                break;

              default:
                  $regexParts[] = preg_quote($part, '/');
                  break;
            }
        }

        return sprintf('/%s/', implode('\/', $regexParts));
    }

    /**
     * Converts the simplified OffRoad pattern syntax to a template
     *
     * @param string $pattern
     * @return string
     */
    public static function translatePatternToTemplate($pattern) {
        //
        // Split the pattern by '/' and iterate over the result
        //
        $parts = explode('/', $pattern);

        //
        // Check each part for flag characters and convert them
        //
        $templateParts = array();
        $restCounter = 0;

        foreach ($parts as $part) {
            switch (true) {

              //
              // Convert rest syntax
              //
              case $part === '...':
                    $templateParts[] = sprintf('{__rest%d}', $restCounter++);
                break;

              default:
                  $templateParts[] = $part;
                  break;
            }
        }

        return implode('/', $templateParts);
    }

}
