<?php

trait GetterTrait {

  public function __get($prop) {
    $reflectionProperty = new ReflectionProperty($this, $prop);
    if ($reflectionProperty->isProtected()) {
      throw new Exception(sprintf('Cannot get proptected property %s', $prop));
    } else {
      $method = 'get' . ucfirst($prop);

      if (method_exists($this, $method)) {
        return $this->$method();
      } else {
        return $this->$prop;
      }
    }
  }
}