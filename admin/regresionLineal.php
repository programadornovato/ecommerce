<?php
class IAphp
{
    function regresionLineal($x, $y)
    {
        $n = count($x);
        if (count($y) != $n) {
            die("Los elementos en x no coinciden con los elementos en y");
        }
        $sumaX = array_sum($x);
        $sumaY = array_sum($y);

        $sumaXporX = 0;
        $sumaXporY = 0;

        for ($i = 0; $i < $n; $i++) {
            $sumaXporX = $sumaXporX + ($x[$i] * $x[$i]);
            $sumaXporY = $sumaXporY + ($x[$i] * $y[$i]);
        }
        $w = (($n * $sumaXporY) - ($sumaX * $sumaY)) / (($n * $sumaXporX) - ($sumaX * $sumaX));
        $b = ($sumaY - ($w * $sumaX)) / $n;
        //echo "w=$w <br>b=$b";
        return array("w"=>$w,"b"=>$b);
    }
}
