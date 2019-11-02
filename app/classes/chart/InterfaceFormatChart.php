<?php

namespace App\classes\chart;

/**
 * Interface InterfaceFormatChart
 * @package App\classes\chart
 * this interface includes functions to wrapping and groupping data that can consume in charts
 */

interface InterfaceFormatChart
{

    /**
     * @param array $data
     * @return array
     */
     function groupedData(array $data):array;
}