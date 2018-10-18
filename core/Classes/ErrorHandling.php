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
 * ErrorHandling class.
 *
 * @author Atanas Harapov <atanas.harapov@abv.bg>
 */
class ErrorHandling 
{
    private static $environment = 'production';

    public static function setEnvironment($environment)
    {
        self::$environment = $environment;
    }

    public static function getEnvironment()
    {
        return self::$environment;
    }

    public static function inProduction()
    {
        return (self::getEnvironment() == 'production');
    }

    public static function exceptionHandler($exception)
    {
        if(self::inProduction())
        {
            $error_message = 'An unexpected error has occurred!';
            $error_code = 1;
            if($exception->getCode() === 404)
            {
                $error_message = 'The page was not found!';
                $error_code = 404;
            }
        }
        else
        {
            $error_message = $exception->getMessage();
            $error_message .= "<br>";
            $error_message .= 'Line: ' . $exception->getLine();
            $error_message .= "<br>";
            $error_message .= 'File: ' . $exception->getFile();

            $error_code = $exception->getCode();
        }
        self::showMessages($error_message, $error_code);
    }

    public static function errorHandler($error_code, $error, $file, $line)
    {
        if(self::inProduction())
        {
            $error_message = 'An unexpected error has occurred!';
            $error_code = 1;
            if($error_code === 404)
            {
                $error_message = 'The page was not found!';
                $error_code = 404;
            }
        }
        else
        {
            $error_message = $error;
            $error_message .= "<br>";
            $error_message .= 'Line: ' . $line;
            $error_message .= "<br>";
            $error_message .= 'File: ' . $file;
        }
        self::showMessages($error_message, $error_code);
    }
    
    public static function showMessages($error_message, $error_code = 1)
    {
        $data['error'] = self::processMessages($error_message, $error_code);
        
        $view = new View();
        $view->setData($data);
        $view->setFile('message','view');
        $view->render();
        exit;
    }
    
    public static function processMessages($error_message, $error_code)
    {
        $error_type = array(
            1	=> 'An Error Was Encountered',
            2	=> 'Fatal Error',
            3	=> 'Successfully',

            200	=> 'OK',
            201	=> 'Created',
            202	=> 'Accepted',

            300	=> 'Error 300: Multiple Choices',
            301	=> 'Error 301: Moved Permanently',
            302	=> 'Error 302: Found',
            304	=> 'Error 304: Not Modified',
            305	=> 'Error 305: Use Proxy',
            307	=> 'Error 307: Temporary Redirect',

            400	=> 'Error 400: Bad Request',
            401	=> 'Error 401: Unauthorized',
            403	=> 'Error 403: Forbidden',
            404	=> 'Error 404: Page Not Found',
            405	=> 'Error 405: Method Not Allowed',
            406	=> 'Error 406: Not Acceptable',
        );

        if(is_numeric($error_code))
        {
            return array(
                'title' => (isset($error_type[$error_code]))? $error_type[$error_code]: $error_type[1],
                'message' => str_replace(ROOT, '', $error_message)
            );
        }
        else
        {
            self::processMessages('Error code should be a number.', 400);
        }
    }
}
