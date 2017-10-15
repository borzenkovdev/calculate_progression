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
        $epsilon = 0.001;

        if ($checkArray[1] == 0 || $checkArray[0] == 0) {
            return false;
        }

        $diff = $checkArray[1] / $checkArray[0];

        foreach ($checkArray as $index => $item) {
            if ($item == 0) {
                $checkResult = false;
                break;
            }

            if ($index !== 0) { //

                $newDiff = $item / $prevItem;
                if (abs($newDiff - $diff) < $epsilon ) {
                    $prevItem = $item;
                } else {
                    $checkResult = false;
                    break;
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
        $epsilon = 0.001;
        $diff = $checkArray[1] - $checkArray[0];

        foreach ($checkArray as $index => $item) {
            if ($index !== 0) {
                $newDiff = $item - $prevItem;
                if (abs($newDiff - $diff) < $epsilon ) {
                    $prevItem = $item;
                } else {
                    $checkResult = false;
                    break;
                }
            }
        }

        return $checkResult;
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
     * @return bool
     */
    protected function validateNumbers ($arrayNumbers)
    {
        $checkResult = true;

        if (count($arrayNumbers) < 3) {
            echo 'Error: Minimal quantity of numbers  must be 3' . PHP_EOL;
            $this->help();
            return false;
        }

        foreach ($arrayNumbers as $index => $item) {
            if (! is_numeric($item)) {
                echo 'Error: Incorrect numbers in string' . PHP_EOL;
                $checkResult = false;
                break;
            }
        }

        return $checkResult;
    }


    /**
     * @param $arguments
     */
    public function __construct ($arguments)
    {
        if ($this->isValidScriptArgs($arguments)) {
            $checkArray = explode(',', $arguments[1]);
            if ($this->validateNumbers($checkArray)) {
                if ($this->isArithmeticProgression($checkArray)) {
                    echo 'Ok. Its a Arithmetic progression! Congratulation!' . PHP_EOL;
                } elseif ($this->isGeometricProgression($checkArray)) {
                    echo 'Ok. Its a Geometric progression! Congratulation!' . PHP_EOL;
                } else {
                    echo 'Sorry. Its not a  progression'  . PHP_EOL;
                }
            }
        } else {
            echo 'Error: Incorrect quantity of arguments' . PHP_EOL;
            $this->help();
            return false;
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