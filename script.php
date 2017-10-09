<?php

/**
 * Класс вычисляет тип прогрессии
 * Class CheckProgression
 */
class CheckProgression
{
    /**
     * @param array $checkArray
     * @return bool
     */
    protected function isGeometricProgression (array $checkArray)
    {
        $checkResult = true;

        $prevItem = $checkArray[0];

        $diff = $checkArray[1] / $checkArray[0];

        foreach ($checkArray as $index => $item) {
            if ($index !== 0) { //
                if (($item / $prevItem) !== $diff) {
                    $checkResult = false;
                    break;
                } else {
                    $prevItem = $item;
                }
            }
        }

        return $checkResult;
    }

    /**
     * @param array $checkArray
     * @return bool
     */
    protected function isArithmeticProgression (array $checkArray)
    {
        $checkResult = true;

        $prevItem = $checkArray[0];

        $diff = $checkArray[1] - $checkArray[0];

        foreach ($checkArray as $index => $item) {
            if ($index !== 0) { //
                if (($item - $prevItem) !== $diff) {
                    $checkResult = false;
                    break;
                } else {
                    $prevItem = $item;
                }
            }
        }

        return $checkResult;
    }

    /**
     * @param $string
     * @return bool|int
     */
    protected function isValidString ($string)
    {
        if(!$string || strlen($string) == 0) {
            return false;
        }
        return preg_match('/^([-+]?[0-9]*[.]?[0-9]+,)*[-+]?[0-9]*[.]?[0-9]+$/', $string);
    }

    /**
     * @param $arguments
     * @return bool
     */
    protected function isValidScriptArgs ($arguments)
    {
        return (count($arguments) == 2);
    }

    /**
     * @param $arguments
     */
    public function __construct ($arguments)
    {
        if ($this->isValidScriptArgs($arguments)) {
            if ($this->isValidString($arguments[1])) {
                $checkArray = explode(',', $arguments[1]);
                if (count($checkArray) < 2) {
                    echo 'Error: quantity of numbers in string must be more then one' . PHP_EOL;
                    $this->help();
                    return false;
                }
                if ($this->isArithmeticProgression($checkArray)) {
                    echo 'Ok. Its a Arithmetic progression! Congratulation!' . PHP_EOL;
                } elseif ($this->isGeometricProgression($checkArray)) {
                    echo 'Ok. Its a Geometric progression! Congratulation!' . PHP_EOL;
                } else {
                    echo 'Sorry. Its not a  progression'  . PHP_EOL;
                }
            } else {
                echo 'Error: Invalid string format' . PHP_EOL;
                $this->help();
            }
        } else {
            echo 'Error: Incorrect quantity of arguments' . PHP_EOL;
            $this->help();
        }
    }

    /**
     *
     */
    public function help ()
    {
        echo PHP_EOL . 'This script calulcate type of progression, Arithmetic or Geometric' . PHP_EOL;
        echo 'example of usage  "php script.php 1,2,4,8 ' . PHP_EOL;
    }
}


$obj = new CheckProgression($argv);

?>