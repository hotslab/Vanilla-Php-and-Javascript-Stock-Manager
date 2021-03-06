<?php
namespace Config;

class Environment
{
    public function getEnv()
    {
        $myFile = file_get_contents(ROOT."/.env");
        if ($myFile) {
            $envArray = explode("\n", $myFile);
            if (sizeof($envArray) > 0) {
                $environment = new \stdClass;
                foreach ($envArray as $key => $text) {
                    $newText = explode("=", $text);
                    if (sizeof($newText) === 2) {
                        switch (trim((string)$newText[0])) {
                            case "DB_HOST":
                                $environment->host = $newText[1];
                                break;
                            case "DB_USERNAME":
                                $environment->username = $newText[1];
                                break;
                            case "DB_PASSWORD":
                                $environment->password = $newText[1];
                                break;
                            case "DB_NAME":
                                $environment->database = $newText[1];
                                break;
                            case "DB_PORT":
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
