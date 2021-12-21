<?php

namespace mywishlist\views;

class ListView
{
    /**
     * Generates HTML code to diplay lists
     * @param $lists
     * @return string
     */
    public function generateLists($lists): string
    {
        // Base HTML code
        $html = <<<HTML
<!doctype html>
<html lang="fr">
<head>
<meta charset="UTF-8">
             <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
                         <meta http-equiv="X-UA-Compatible" content="ie=edge">
             <title>Document</title>
</head>
<body>
HTML;
        // Add every lists to the HTML code
        foreach ($lists as $list) {
            $html .= $list->description;
        }

        // Close tags
        $html .= "</body></html>";

        // Return the HTML code to the controller
        return $html;
    }
}