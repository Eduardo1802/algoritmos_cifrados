<?php
class Vigenere{
    public $alfabeto = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','W','X','Y','Z');
    public $matriz;
    public $clave;

    public function Vigenere($c){
        $this->clave = $c;
        $app1 = array();
        $app2 = array();
        for($i=0; $i<26; $i++){
            $k = 0;
            $app1 = array_slice($this->alfabeto,0,$i);
            $app2 = array_slice($this->alfabeto,$i);
            $this->matriz[$i] = array_merge($app2,$app1);
        }
        // echo "La clave es:".$this->clave;
    }

}
?>