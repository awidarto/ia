<?php

class Menugen {

    public static $json_menu;

    public function __construct()
    {

    }

    public static function make($menuname,$json = null){

        return new self;
    }

    public static function render()
    {
        return
    }

    public static function buildMenu($menu_array, $is_sub = false)
    {
        /*
         * If the supplied array is part of a sub-menu, add the
         * sub-menu class instead of the menu ID for CSS styling
         */
        $attr = ($is_sub) ? ' class="submenu"':' class="nav"';
        if($is_sub){

        }else{
            $menu = '<ul '.$attr.' >'."\n"; // Open the menu container
        }

        /*
         * Loop through the array to extract element values
         */
        foreach($menu_array as $id => $properties) {

            /*
             * Because each page element is another array, we
             * need to loop again. This time, we save individual
             * array elements as variables, using the array key
             * as the variable name.
             */
            foreach($properties as $key => $val) {

                /*
                 * If the array element contains another array,
                 * call the buildMenu() function recursively to
                 * build the sub-menu and store it in $sub
                 */
                if(is_array($val))
                {
                    $sub = self::buildMenu($val, TRUE);
                }

                /*
                 * Otherwise, set $sub to NULL and store the
                 * element's value in a variable
                 */
                else
                {
                    $sub = NULL;
                    $$key = $val;
                }
            }

            /*
             * If no array element had the key 'url', set the
             * $url variable equal to the containing element's ID
             */
            if(!isset($url)) {
                $url = $id;
            }

            /*
             * Use the created variables to output HTML
             */
            $menu .= '<li><a href="'.$url.'">'.$display.'</a>'.$sub.'</li>'."\n";

            /*
             * Destroy the variables to ensure they're reset
             * on each iteration
             */
            unset($url, $display, $sub);

        }

        /*
         * Close the menu container and return the markup for output
         */
        return $menu . '</ul>'."\n";
    }

}
