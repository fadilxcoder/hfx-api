<?php

namespace App\Core;

use \Twig\Environment;
use App\Core\Twig as TwigEnv;

class Controller
{
    private $twig, $twigEnv;

    public function __construct(
        Environment $twig, 
        TwigEnv $twigEnv
    ) {
        $this->twig = $twig;
        $this->twigEnv = $twigEnv;
    }

    public function jsonResponse($response)
    {
        $this->headers();
        
        if (isset($response['status_code_header'])) {
            header($response['status_code_header']);
        }

        echo json_encode($response['body']);
    }

    private function headers()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    }

    # Convert to private to prevent usage !
    private function render(string $view, array $parameters = [])
    {
        $parameters['app'] = [
            'uri' => $this->twigEnv->appUri(),
            'name' => $this->twigEnv->appName(),
        ];

        $this->twig->addExtension(new \Twig\Extension\DebugExtension());
        echo $this->twig->render($view, $parameters);
    }

    # Convert to private to prevent usage !
    private function redirectTo(String $url)
    {
        header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        header('Pragma: no-cache');
        header('Location: ' . $this->twigEnv->appUri() . $url);
        return;
    }
}