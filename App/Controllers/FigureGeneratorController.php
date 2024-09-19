<?php

namespace App\Controllers;

class FigureGeneratorController
{
    public function generateRandomShapes() : array
    {
        $shapes = [];
        $shapeTypes = ['квадрат', 'круг', 'прямоугольник', 'треугольник'];

        for ($i = 0; $i < 10; $i++) {
            $shapeType = $shapeTypes[array_rand($shapeTypes)];

            switch ($shapeType) {
                case 'квадрат':
                    $size = rand(1, 20);
                    $shapes[] = [
                        'shape' => 'квадрат',
                        'height' => $size,
                        'width' => $size,
                    ];
                    break;

                case 'круг':
                    $radius = rand(1, 10);
                    $shapes[] = [
                        'shape' => 'круг',
                        'radius' => $radius,
                    ];
                    break;

                case 'прямоугольник':
                    $height = rand(1, 20);
                    $width = rand(1, 20);
                    $shapes[] = [
                        'shape' => 'прямоугольник',
                        'height' => $height,
                        'width' => $width,
                    ];
                    break;

                case 'треугольник':
                    $base = rand(1, 20);
                    $height = rand(1, 20);
                    $shapes[] = [
                        'shape' => 'треугольник',
                        'base' => $base,
                        'height' => $height,
                    ];
                    break;
            }
        }

        return $shapes;
    }

    public function calculateAreas($figures) : array
    {
        $areas = [];

        foreach ($figures as $figure) {
            switch ($figure['shape']) {
                case 'квадрат':
                    $area = $figure['height'] * $figure['width'];
                    break;
                case 'треугольник':
                    $area = 0.5 * $figure['base'] * $figure['height'];
                    break;
                case 'круг':
                    $area = pi() * pow($figure['radius'], 2);
                    break;
                case 'прямоугольник':
                    $area = $figure['height'] * $figure['width'];
                    break;
            }
            $areas[] = [
                'shape' => $figure['shape'],
                'area' => round($area, 3),
            ];
        }

        return $areas;
    }


    public function sortAreas($areas)
    {
        usort($areas, function ($a, $b) : string {
            return $a['area'] <=> $b['area'];
        });
        return $areas;
    }

    public function getFormatedOutput($sortedAreas) : string
    {
        $output = '';
        foreach ($sortedAreas as $item) {
            $output .= $item['shape'] . ', ' . $item['area'] . ' <br>';
        }
        return $output;
    }

    public function getFiguresList() : string
    {
        $figures = $this->generateRandomShapes();
        $areas = $this->calculateAreas($figures);
        $sortedAreas = $this->sortAreas($areas);

        return $this->getFormatedOutput($sortedAreas);
    }
}
