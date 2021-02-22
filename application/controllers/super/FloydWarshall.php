<?php
defined('BASEPATH') OR exit('No direct script access allowed');
define('INFINITE', pow(2, (20 * 8 - 2)-1));
class FloydWarshall extends CI_Controller {
    
    /**
     * Jarak array
     * @var array
     */
    private $dist = array(array());
    /**
     * Predecessor array
     * @var array
     */
    private $pred = array(array());
    /**
     * Panjang array
     * @var array
     */
    private $weights;
    /**
     * Jumlah node
     * @var integer
     */
    private $nodes;
    /**
     * Nama node
     * @var array
     */
    private $nodenames;
    /**
     * tabel sementara
     * @var array
     */
    private $tmp = array();
    
    /**
     * Constructor
     * @param array $graph Graph matrice.
     * @param array $nodenames Node names as an array.
     */
    public function __construct($graph, $nodenames='') {
        
        $this->weights = $graph;
        $this->nodes   = count($this->weights);
        if ( ! empty($nodenames) && $this->nodes == count($nodenames) ) {
            $this->nodenames = $nodenames;
        }
        $this->__floydwarshall();
        
    }
    
    /*
     * implementasi floyd warshall */
    private function __floydwarshall () {
        
        for ( $i = 0; $i < $this->nodes; $i++ ) {
            for ( $j = 0; $j < $this->nodes; $j++ ) {
                if ( $i == $j ) {
                    $this->dist[$i][$j] = 0;
                } else if ( $this->weights[$i][$j] > 0 ) {
                    $this->dist[$i][$j] = $this->weights[$i][$j];
                } else {
                    $this->dist[$i][$j] = INFINITE;
                }
                $this->pred[$i][$j] = $i;
            }
        }
        
        for ( $k = 0; $k < $this->nodes; $k++ ) {
            for ( $i = 0; $i < $this->nodes; $i++ ) {
                for ( $j = 0; $j < $this->nodes; $j++ ) {
                    if ($this->dist[$i][$j] > ($this->dist[$i][$k] + $this->dist[$k][$j])) {
                        $this->dist[$i][$j] = $this->dist[$i][$k] + $this->dist[$k][$j];
                        $this->pred[$i][$j] = $this->pred[$k][$j];
                    }
                }
            }
        }
        
    }
    

    private function __get_path($i, $j) {
        
        if ( $i != $j ) {
            $this->__get_path($i, $this->pred[$i][$j]);
        }
        array_push($this->tmp, $j);
    }
    

    public function get_path($i, $j) {
        $this->tmp = array();
        $this->__get_path($i, $j);
        return $this->tmp;
    }
    

    public function print_path($i, $j) {
        
        if ( $i != $j ) {
            $this->print_path($i, $this->pred[$i][$j]);
        }
        
        if (! empty($this->nodenames) ) {
            print($this->nodenames[$j]) . ' ';
        } else {
            print($j) . ' ';
        }
        
    }

    public function get_distance($i, $j) {
        return $this->dist[$i][$j];
    }

}
