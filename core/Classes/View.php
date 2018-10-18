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
 * View class.
 *
 * @author Atanas Harapov <atanas.harapov@abv.bg>
 */
class View 
{
	/**
	 * @var string The views folder path
	 */
    private static $folder = null;
	/**
	 * @var string The layout file name
	 */
    private static $layout = null;
	/**
	 * @var array The view data
	 */
    private $data = array();

	/**
	 * @var array The loaded files
	 */
    private $file = array(
        'layout' => null,
        'view' => null
    );

    /**
     * Create a new view
     *
     * @return void
     */
    public function forge($view = null, $data = array())
    {
        // Check if layout file is not empty
        if( ! empty($this->getLayout()))
        {
            // Set the layout file
            $this->setFile($this->getLayout(), 'layout');
        }

        // Set the view file
        $this->setFile($view, 'view');

        // Set the view data
        $this->setData($data);

        // Render the view
        $this->render();
    }
    
    /**
     * Static
     * Set the views folder
     *
     * @param string $path The views folder path
     * @return void
     */
    public static function setFolder($path)
    {
        self::$folder = $path;
    }
    
    /**
     * Static
     * Get the current views folder
     *
     * @return string
     */
    public static function getFolder()
    {
        return self::$folder;
    }
    
    /**
     * Set the layout file
     *
     * @param string $file_name The layout file name
     * located in the views folder
     * @return void
     */
    public function setLayout($file_name)
    {
        self::$layout = $file_name;
    }
    
    /**
     * Get the current layout file
     *
     * @return string
     */
    public function getLayout()
    {
        return self::$layout;
    }
    
    /**
     * Set data.
     *
     * @return $this
     */
    public function setData($data = array())
    {
        // Check if the $data is an array
        if(is_array($data))
        {
            // merge the $data and $this->data
            $this->data = array_merge($this->data, $data);
        }
        return $this;
    }

    /**
     * Get data.
     *
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }
    
    /**
     * Set the view or layout file.
     *
     * @param string $name The name of a file
     * @param string $type The type of a file (view or layout) 
     * default is view
     * @return void
     */
    public function setFile($name, $type)
    {
        $this->file[$type] = $name;
    }

    /**
     * Check if the view file exist and return the path.
     *
     * @param string $name The name of a file
     * @return string The file path
     */
    public function loadView($name)
    {
        // Replace every forward slash(/) and backward slash(\) 
        // to DIRECTORY_SEPARATOR
        $name = str_replace('/', DS, str_replace('\\', DS, $name));

        // Set the file path
        $file_path = self::getFolder() . $name . '.php';

        // Check if the file doesn't exist and throw an Exception
        if ( ! file_exists($file_path))
        {
            throw new \Exception('The view file "' . $file_path . '" does not exists.');
        }

        return $file_path;
    }

    /**
     * Get the view or layout file.
     *
     * @param string $type The type of a file (view or layout)
     * @return string
     */
    public function getFile($type)
    {
        return $this->file[$type];
    }
    
    /**
     * Render the view with layout.
     *
     * @return void
     */
    public function render()
    {
        $layout = $this->getFile('layout');
        
        // Check if layout file is not empty and a string.
        if (empty($layout) OR !is_string($layout))
        {
            // if no layout file exists then echo the content 
            // from the view file
            echo $this->process();
        }
        else
        {

            //Import variables from an array to make local variables
            extract($this->getData(), EXTR_REFS);

            // Add the new content to local variables 
            $content = $this->process();
            
            // Require the layout file
            require_once $this->loadView($layout);
        }
    }
    
    /**
     * Catch the output of the required view.
     *
     * @return string The captured output
     * @throws Exception on failure
     */
    private function process()
    {
        // Import variables from an array to make local variables
        extract($this->getData(), EXTR_REFS);
        
        // Capture the view output
        ob_start();

        try
        {
            // Load the view
            require_once $this->loadView($this->getFile('view'));
        }
        catch (\Exception $err)
        {
            // Delete the output buffer
            ob_end_clean();

            // Re-throw the exception
            throw $err;
        }

        // Get the captured output and close the buffer
        return ob_get_clean();
    }
}
