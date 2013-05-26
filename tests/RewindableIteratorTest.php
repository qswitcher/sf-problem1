<?php

namespace org\mizer;

require __DIR__ . '/../src/ClassLoader.class.php';
spl_autoload_register(array(new \org\mizer\ClassLoader(), 'load')); 

class RewindableIteratorTest extends \PHPUnit_Framework_TestCase 
{

    public function testFullIteration() {
        
        $dao = new Dao();

        $itr = new RewindableEntityIterator(
                $dao->queryWidgets(), 
                new WidgetDataMapper());
        
        $results = array();

        foreach($itr as $widget) {
            $results[] = $widget;
        }        

        $this->assertEquals(3, count($results));
    }
    
    public function testFullIterationWithInterupt() {
        
        $dao = new Dao();

        $itr = new RewindableEntityIterator(
                $dao->queryWidgets(), 
                new WidgetDataMapper());
        
        $results = array();
        
        $i = 0;
        foreach($itr as $widget) {
            if(++$i > 1) break;
            $results[] = $widget;
        }        

        $this->assertEquals(1, count($results));
    }
    
    public function testTwoFullIterations() {
        
        $dao = new Dao();

        $itr = new RewindableEntityIterator(
                $dao->queryWidgets(), 
                new WidgetDataMapper());
        
        $results = array();

        foreach($itr as $widget) {
            $results[] = $widget;
        }        

        $this->assertEquals(3, count($results));

        $results = array();

        /* Prints this time */
        foreach($itr as $widget) {
            $results[] = $widget;
        }        

        $this->assertEquals(3, count($results));
    }
    
    public function testTwoFullIterationsWithInterupt() {
        
        $dao = new Dao();

        $itr = new RewindableEntityIterator(
                $dao->queryWidgets(), 
                new WidgetDataMapper());
        
        $results = array();
        $i = 0;
        foreach($itr as $widget) {
            if(++$i > 1) break;
            $results[] = $widget;
        }        

        $this->assertEquals(1, count($results));

        $results = array();

        /* Prints this time */
        foreach($itr as $widget) {
            $results[] = $widget;
        }        

        $this->assertEquals(3, count($results));
    }
    
}