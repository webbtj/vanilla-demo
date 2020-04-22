<?php

trait SetterTrait {

  public function __set($prop, $value) {
    $reflectionProperty = new ReflectionProperty($this, $prop);
    if ($reflectionProperty->isProtected()) {
      throw new Exception(sprintf('Cannot set proptected property %s', $prop));
    } else {
      $method = 'set' . ucfirst($prop);

      if (method_exists($this, $method)) {
        $this->$method($value);
      } else {
        $this->$prop = $value;
      }
    }
  }
}