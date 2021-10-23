<?php

class Route
{


    public function goaway($refer)
        {
    
        if(isset($_SESSION["user"]))
            {
                if(intval($_SESSION["user"]["uye_yetki"]) == 0)
                {
                    header("location:/abstract_index".$refer);
                    exit();
                }
                else if(intval($_SESSION["user"]["uye_yetki"]) == 1)
                {
                    header("location:/editor_index".$refer);
                    exit();
                }
                else if(intval($_SESSION["user"]["uye_yetki"]) == 2)
                {
                    header("location:/referee_index".$refer);
                    exit();
                }

                else if(intval($_SESSION["user"]["uye_yetki"]) == 3)
                {
                    header("location:/admin_index".$refer);
                    exit();
                }
                else
                {
                    header("location:/login");
                    exit();
                }
            }
        else
        {
            header("location:/login");
            exit();
        }


    }


    public static function parse_url()
    {
        $dirname = dirname($_SERVER['SCRIPT_NAME']);
        $dirname = $dirname != '/' ? $dirname : null;
        $basename = basename($_SERVER['SCRIPT_NAME']);
        $uri = $_SERVER['REQUEST_URI'];
        $uri = explode("?",$uri);
        $request_uri = str_replace([$dirname, $basename], null,$uri[0] );
        return $request_uri;
    }

    public static function run($url, $callback, $method = 'get')
    {

        

        $method = explode('|', strtoupper($method));

        if (in_array($_SERVER['REQUEST_METHOD'], $method)) {

            $patterns = [
                '{url}' => '([0-9a-zA-Z]+)',
                '{id}' => '([0-9]+)'
            ];

            $url = str_replace(array_keys($patterns), array_values($patterns), $url);
            $request_uri = self::parse_url();
            if (preg_match('@^' . $url . '$@', $request_uri, $parameters)) {
                unset($parameters[0]);

                if (is_callable($callback)) {
                    call_user_func_array($callback, $parameters);//class çağrısı
                } else {

                    $controller = explode('@', $callback);
                    $className = explode('/', $controller[0]);
                    $className = end($className);
                    $controllerFile = __DIR__ . '/controller/' . strtolower($controller[0]) . '.php';//kontroller dosya dizini

                    if (file_exists($controllerFile)) {
                        require $controllerFile;
                        call_user_func_array([new $className, $controller[1]], $parameters);//class çağrısı
                    }
                    
                }

            }

        }
      

    }

}
