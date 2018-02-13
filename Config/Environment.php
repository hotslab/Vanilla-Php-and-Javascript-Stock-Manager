<?php
namespace Config;

class Environment
{
    public function getEnv()
    {
        define(__ROOT__, dirname(__FILE__), true);
        $myFile = file_get_contents(__ROOT__."/.env.txt");
        if ($myFile) {
            $envArray = explode(";", $myFile);
            if (sizeof($envArray) > 0) {
                $environment = new \stdClass;
                foreach ($envArray as $key => $text) {
                    $newText = explode("=", $text);
                    if (sizeof($newText) === 2) {
                        switch (trim((string)$newText[0])) {
                            case "host":
                                $environment->host = $newText[1];
                                break;
                            case "username":
                                $environment->username = $newText[1];
                                break;
                            case "password":
                                $environment->password = $newText[1];
                                break;
                            case "database":
                                $environment->database = $newText[1];
                                break;
                            case "port":
                                $environment->port = $newText[1];
                                break;
                            default:
                        }
                    }
                }
                return $environment;
            } else {
                return "error: settings are written incorrectly";
            }
        } else {
            return "error: unable to open settings";
        }
    }
}
