<?php
/**
 * Rewindable Entity Iterator
 *
 * @author You
 */

namespace org\mizer;

class RewindableEntityIterator extends EntityIterator
{

    /**
     * Result set array
     */
    protected $rsArray = array();

    /**
     * Get next element
     *
     * @return Object
     */
    public function next() {
        $this->index++;
        if($this->index >= count($this->rsArray)){
            $this->next = parent::next();
            $this->rsArray[] = $this->next;
        } else{
            $this->next = current($this->rsArray);
            next($this->rsArray);
        }
        return $this->next;
    }

    /**
     * Rewind iterator
     */
    public function rewind() {
        reset($this->rsArray);
        $this->index = -1;
        $this->next();
        return;
    }
}