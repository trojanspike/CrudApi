<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * Short description for class
 *
 * Long description for class (if any)...
 *
 * @copyright  31/03/15 , 21:05 lee
 * @license
 * @version
 * @link
 * @since
 */
class Hooks {

   /**
    * Does something interesting
    * 31/03/15 , 21:07
    * @param  string    $where  Where something interesting takes place
    * @param  integer  $repeat How many times something interesting should happen
    * @throws Exception If something interesting cannot happen
    * @return Status
    */
   public static function on( string $where = false , int $repeat = 0 )
   {

   }

    /**
     * Does something interesting
     * 31/03/15 , 21:07
     * @param  string    $where  Where something interesting takes place
     * @param  integer  $repeat How many times something interesting should happen
     * @throws Exception If something interesting cannot happen
     * @return Status
     */
    public static function fire( string $where = false , int $repeat = 0 )
    {

    }

}
/*
Hooks::on('some:event' , function(..args){}); // push in events array
Hooks::fire('some:event', [..args]);
 */