<?php
<<<<<<< HEAD
class Http
{
	private $requestMethod;
	private $requestPath;
	public function __construct()
	{
		$this->requestMethod = $_SERVER['REQUEST_METHOD'];
=======

class Http
{
	private $requestMethod;

	private $requestPath;


	public function __construct()
	{
		$this->requestMethod = $_SERVER['REQUEST_METHOD'];

>>>>>>> 553850bf4f671f306465215fff33bd5854213939
		if(isset($_SERVER['PATH_INFO']) == false || $_SERVER['PATH_INFO'] == '/')
		{
			$this->requestPath = null;
		}
		else
		{
			$this->requestPath = strtolower($_SERVER['PATH_INFO']);
		}
	}
<<<<<<< HEAD
=======

>>>>>>> 553850bf4f671f306465215fff33bd5854213939
	public function getRacineDirectory()
	{
		if($this->requestPath == null)
		{
			return '';
		}
<<<<<<< HEAD
        $pathSegments = explode('/', $this->requestPath);
        return $pathSegments[1];
	}
=======

        $pathSegments = explode('/', $this->requestPath);

        return $pathSegments[1];
	}

>>>>>>> 553850bf4f671f306465215fff33bd5854213939
	public function getRequestFile()
	{
		if($this->requestPath == null)
		{
			return 'Home';
		}
<<<<<<< HEAD
        $pathSegments = explode('/', $this->requestPath);
=======

        $pathSegments = explode('/', $this->requestPath);

>>>>>>> 553850bf4f671f306465215fff33bd5854213939
        if(($pathSegment = array_pop($pathSegments)) == null)
        {
            // A trailing slash was added to the URL, remove it.
            $pathSegment = array_pop($pathSegments);
        }
<<<<<<< HEAD
        return ucfirst($pathSegment);
	}
=======

        return ucfirst($pathSegment);
	}

>>>>>>> 553850bf4f671f306465215fff33bd5854213939
	public function getRequestMethod()
	{
		return $this->requestMethod;
	}
<<<<<<< HEAD
=======

>>>>>>> 553850bf4f671f306465215fff33bd5854213939
	public function getRequestPath()
	{
		return $this->requestPath;
	}
<<<<<<< HEAD
=======

>>>>>>> 553850bf4f671f306465215fff33bd5854213939
    public function getUploadedFile($name)
    {
        if(array_key_exists($name, $_FILES) == true)
        {
            if($_FILES[$name]['error'] == UPLOAD_ERR_OK)
            {
                return $_FILES[$name];
            }
        }
<<<<<<< HEAD
        return false;
    }
=======

        return false;
    }

>>>>>>> 553850bf4f671f306465215fff33bd5854213939
    public function hasUploadedFile($name)
    {
        if(array_key_exists($name, $_FILES) == true)
        {
            if($_FILES[$name]['error'] == UPLOAD_ERR_OK)
            {
                return true;
            }
        }
<<<<<<< HEAD
        return false;
    }
=======

        return false;
    }

>>>>>>> 553850bf4f671f306465215fff33bd5854213939
    public function moveUploadedFile($name, $path = null)
    {
        if($this->hasUploadedFile($name) == false)
        {
            return false;
        }
<<<<<<< HEAD
        // Build the absolute path to the destination file.
        $filename = WWW_PATH."$path/".$_FILES[$name]['name'];
        move_uploaded_file($_FILES[$name]['tmp_name'], $filename);
        return pathinfo($filename, PATHINFO_BASENAME);
    }
=======

        // Build the absolute path to the destination file.
        $filename = WWW_PATH."$path/".$_FILES[$name]['name'];

        move_uploaded_file($_FILES[$name]['tmp_name'], $filename);

        return pathinfo($filename, PATHINFO_BASENAME);
    }

>>>>>>> 553850bf4f671f306465215fff33bd5854213939
	public function redirectTo($url)
	{
		if(substr($url, 0, 1) !== '/')
		{
			$url = "/$url";
		}
<<<<<<< HEAD
		header('Location: http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].$_SERVER['SCRIPT_NAME'].$url);
		exit();
	}
=======

		header('Location: http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].$_SERVER['SCRIPT_NAME'].$url);
		exit();
	}

>>>>>>> 553850bf4f671f306465215fff33bd5854213939
	public function sendJsonResponse($data)
	{
        echo json_encode($data);
		exit();
	}
}