<?php

include_once PATH."Model/BaseModel.php";

class BaseController {

    public static $defaultPath = ALIAS;
    /**
     * Construtor da BaseController 
     */
    public function __construct() { 

    }

    Public function gen_redirect_and_form($page, $data, $host = "") {
        $ret = '<html><body onLoad="javascript:submitform();">';
        $ret .= '<script type="text/javascript">
                        function submitform()
                        {
                            document.formReq.submit();
                        }
                    </script>';
        $ret .= '  <form name = "formReq" method="POST" action="' . $page . '">';
        $i = 0;
        foreach ($data as $k => $dados) {
            $ret .= '    <input type="hidden" name="' . $k . '" value="' . $dados . '"/>';
            $i++;
        }
        $ret .= '  </form>';
        $ret .= '</body></html>';

        return $ret;
    }

    /**
     * Retorna a url Base
     * @return String
     */
    Public Static function getPath() {
        return 'http://' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . self::$defaultPath;
    }

    /**
     * Retorna o nome da view a ser chamada
     * @param String $class
     * @return String
     */
    Public Static Function ReturnView($path, $class, $pathView=null) {
        $pv = empty($pathView)?str_replace("Controller", "", $class):$pathView;
        return $path . "Mobile/View/" . $pv . "/" . str_replace("Controller", "View", $class) . ".php";
    }

    Public Function js2PhpTime($jsdate) {
        if (preg_match('@(\d+)/(\d+)/(\d+)\s+(\d+):(\d+)@', $jsdate, $matches) == 1) {
            $ret = mktime($matches[4], $matches[5], 0, $matches[1], $matches[2], $matches[3]);
            //echo $matches[4] ."-". $matches[5] ."-". 0  ."-". $matches[1] ."-". $matches[2] ."-". $matches[3];
        } else if (preg_match('@(\d+)/(\d+)/(\d+)@', $jsdate, $matches) == 1) {
            $ret = mktime(0, 0, 0, $matches[1], $matches[2], $matches[3]);
            //echo 0 ."-". 0 ."-". 0 ."-". $matches[1] ."-". $matches[2] ."-". $matches[3];
        }
        return $ret;
    }

    Public function php2JsTime($phpDate) {
        //echo $phpDate;
        //return "/Date(" . $phpDate*1000 . ")/";
        return date("m/d/Y H:i", $phpDate);
    }

    Public function php2MySqlTime($phpDate) {
        return date("Y-m-d H:i:s", $phpDate);
    }

    Public function mySql2PhpTime($sqlDate) {
        $arr = date_parse($sqlDate);
        return mktime($arr["hour"], $arr["minute"], $arr["second"], $arr["month"], $arr["day"], $arr["year"]);
    }

}
?>
