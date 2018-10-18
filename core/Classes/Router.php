<?php
/*
 * This file is part of the Acher framework.
 *
 * (c) Atanas Harapov <atanas.harapov@abv.bg>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Core\Classes;
/**
 * Router class.
 *
 * @author Atanas Harapov <atanas.harapov@abv.bg>
 */
class Router
{
	/**
     * Static
	 * @var string The instance of the class
	 */
    private static $instance = null;
	/**
	 * @var array Collection of routes
	 */
    private $routes = array();

    /**
     * Prevent the class from being instantiated.
     */
    private function __construct(){}
    
    /**
     * Make the class Singleton.
     *
     * @return object The instance of this class
     */
    public static function getInstance()
    {
        if(self::$instance === null)
        {
            self::$instance = new static();
        }
        return self::$instance;
    }
    
    /**
     * Get the REQUEST_URI string.
     *
     * @return string The REQUEST_URI on success
     * @throws Exception on failure
     */
    private function getUri()
    {
        $string = $_SERVER['REQUEST_URI'];
        
        // Check if the URI has a GET request and remove it
        if (strpos($string, '?') > 0)
        {
            $string = str_replace(strstr($string, '?'), '', $string);
        }
        
        // The URI should include only letters, numbers, forward slash(/) or a dash(-)
        // if not throw an Exception
        if(preg_match('/[^a-zA-Z0-9_\/-]/', $string))
        {
            throw new \Exception('The URI string is invalid.', 2);
        }

        return $string;
    }

    /**
     * Set all routes.
     *
     * @return void
     */
    public function setRoutes($routes)
    {
        $this->routes = $routes;
    }
    
    /**
     * Get all routes.
     *
     * @return array
     */
    public function getRoutes()
    {
        return $this->routes;
    }

    /**
     * Gives the request method.
     *
     * @return string The method
     */
    public function getRequestMethod()
    {
        return Input::getInstance()->method();
    }
    
    /**
     * Adds a new route.
     *
     * @param string $method The request method
     * @param string $route The uri of the route
     * @param mixed $target A function() or a string
     * @return void
     */
    public function addRoute($method, $route, $target)
    {
        $this->routes[$method][$route] = $target;
    }

    /**
     * Matching the URI to a Route
     *
     * @param string $uri The REQUEST_URI String.
     * @return mixed Array on success, or boolean false on failure.
     */
    private function matchRoutes($uri)
    {
        $method = $this->getRequestMethod();
        $routes = $this->getRoutes();
        
        // Check if a method exists in the routes array
        if(array_key_exists($method, $routes))
        {
            // Loop all routes with the requested method
            foreach ($routes[$method] as $route => $target)
            {

                // Match the route and URI
                if( ! preg_match("#^$route$#", $uri))
                {
                    continue ;
                }

                // Get arguments from the URI
                // example "target/2/3/4" from this the
                // arguments will be array(2,3,4)
                $route_explode = explode('/', $route);
                $arguments = array_diff(array_replace($route_explode, explode('/', $uri)), $route_explode);

                return array(
                    'target' => $target,
                    'arguments' => $arguments
                );
            }
        }
        return false;
    }

    /**
     * Get a response from the route
     *
     * @return mixed
     * @throws Exception 
     */
    public function response()
    {
        $route = $this->matchRoutes($this->getUri());
        
        // Check if a route is found
        if( ! $route)
        {
            throw new \Exception('The route is not found.',404);
        }

        $target = $route['target'];
        $arguments = $route['arguments'];
        
        // Check if $target is string and includes @
        if(is_string($target) && strpos($target, '@'))
        {
            // Request a class
            $this->requestClass($target, $arguments);
        }
        // If no arguments run a function
        elseif(empty($arguments))
        {
            return $target(); 
        }
        // Call the function with arguments
        else
        {
            call_user_func_array($target, $arguments);
        }

        return $this;
    }

    /**
     * Call a requested class
     *
     * @param string $target The requested class name and 
     * action in a string format(Class@action)
     * @param array $params Array with the arguments
     * @return void
     * @throws Exception
     */
    private function requestClass($target, $arguments)
    {
        list($controller, $action) = explode('@', $target);

        // Check to see if the controller class exists
        if( ! class_exists($controller))
        { 
            throw new \Exception('The class "' . $controller . '" was not found.', 404); 
        }
        
        // Check to see if the action exist
        if( ! method_exists($controller, $action))
        {
            throw new \Exception('Undefined method "' . $controller . '::' . $action . '()".', 2);
        }

        // Call controller->action(arguments)
        call_user_func_array(array(new $controller, $action), $arguments);
    }

}
