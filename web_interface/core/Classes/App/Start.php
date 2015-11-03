<?php namespace App;

/**
 * Short description for class
 *
 * Long description for class (if any)...
 *
 * @copyright  24/04/15 , 14:36 lee
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @version
 * @link
 * @since
 */
use App\Config;
use Api;
use Rest;
class Start {
    private $RequestURI, $defaultPath, $path, $version, $uriRestrict, $debug, $restDir;
    /**
     * Does something interesting
     * 03/11/15 , 9:47
     * @param  type    $name  What it does
     * @throws Exception If something interesting cannot happen
     * @return Info
     */
    public function __construct($requestURI, $conf)
    {
        $this->RequestURI = $requestURI;
        $this->defaultPath = isset($conf['defaultPath'])? $conf['defaultPath'] : "/api";
        $this->debug = isset($conf['debug'])? $conf['debug'] : Config::get('site.debug');
        $this->restDir = isset($conf['restDir'])? $conf['restDir'] : path("base")."/rest/Default";
        $this->uriRestrict = isset($conf["uriRestrict"])?$conf["uriRestrict"]:"/^([\/\-\.a-zA-Z0-9]+)$/";
        if( $requestURI == "/" )
        {
            header("Location:".$this->defaultPath);
        }
        $this->path = preg_replace('/^\//', '', parse_url($this->RequestURI, PHP_URL_PATH));
        $this->version = preg_replace('/(v[0-9]+).*/','$1',$this->path);
        $this->path = preg_replace('/(v[0-9]+)\/(.*)/','$2',$this->path);
        Api::inject('API_V', $this->version);
        $this->_setReporting();
    }

    public static function init($requestURI, $conf)
    {
        return new Start($requestURI, $conf);
    }
    /**
     * Does something interesting
     * 03/11/15 , 9:47
     * @param  type    $name  What it does
     * @throws Exception If something interesting cannot happen
     * @return Info
     */
    public function run()
    {
        if( preg_match($this->uriRestrict, $this->path) && preg_match( "/^v[0-9]+$/", $this->version ) )
        {
            Api::$uri = $this->path;
            Api::$debug = $this->debug;
            Rest::$Dir = $this->restDir."/{$this->version}/";
            Rest::$debug = $this->debug;
            Rest::init(explode("/", $this->path));
        }
    }

    /**
     * Does something interesting
     * 03/11/15 , 9:47
     * @param  type    $name  What it does
     * @throws Exception If something interesting cannot happen
     * @return Info
     */
    private function _setReporting()
    {
        ini_set("display_errors", config::get('site.error:display') );
        error_reporting( config::get('site.error:report') );

        date_default_timezone_set( Config::get("site.timezone") );
        ini_set('date.timezone', Config::get("site.timezone") );
    }

}

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */