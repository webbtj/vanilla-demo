<?php

require_once(dirname(__FILE__) . '/../traits/Getter.php');
require_once(dirname(__FILE__) . '/../traits/Setter.php');
require_once(dirname(__FILE__) . '/../utilities/utilities.php');

class User implements JsonSerializable {
  use GetterTrait;
  use SetterTrait;

  private $firstName;
  private $lastName;
  private $title;
  private $gender;
  private $streetNumber;
  private $streetName;
  private $city;
  private $state;
  private $country;
  private $postalCode;
  private $email;
  private $username;
  private $dob;
  private $age;
  private $pictureLarge;
  private $pictureMedium;
  private $pictureThumb;
  private $isMature; // arbitrary boolean property
  private $height; // arbitrary null property

  private static $ageOfMajority = 19;
  private static $apiEndpoint = 'https://randomuser.me/api/';
  // where each property is located in the api source response
  // left: this object properties
  // right: nested location in api response (dot notation for readability)
  private static $propertyLocations = [
    'firstName'      => 'name.first',
    'lastName'       => 'name.last',
    'title'          => 'name.title',
    'gender'         => 'gender',
    'streetNumber'   => 'location.street.number',
    'streetName'     => 'location.street.name',
    'city'           => 'location.city',
    'state'          => 'location.state',
    'country'        => 'location.country',
    'postalCode'     => 'location.postcode',
    'email'          => 'email',
    'username'       => 'login.username',
    'dob'            => 'dob.date',
    'age'            => 'dob.age',
    'pictureLarge'   => 'picture.large',
    'pictureMedium'  => 'picture.medium',
    'pictureThumb'   => 'picture.thumbnail'
  ];

  public function setIsMature() {
    $this->isMature = $this->age >= $this::$ageOfMajority;
  }

  public function populate(String $payload) {
    $sourceDate = json_decode($payload, true);
    if(
      isset($sourceDate['results']) &&
      isset($sourceDate['results'][0]) &&
      is_array($sourceDate['results'][0])
    ) {
      $apiObject = $sourceDate['results'][0];
      foreach($this::$propertyLocations as $property => $location){
        $this->$property = getNestedProperty($apiObject, $location);
      }
      $this->setIsMature();
    }
  }

  public function fetchRandomUser() {
    $ch = curl_init($this::$apiEndpoint);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $apiResult = curl_exec($ch);
    curl_close($ch);

    $this->populate($apiResult);
  }

  public function jsonSerialize() {
    return [
      'firstName' => $this->firstName,
      'lastName' => $this->lastName,
      'title' => $this->title,
      'gender' => $this->gender,
      'streetNumber' => $this->streetNumber,
      'streetName' => $this->streetName,
      'city' => $this->city,
      'state' => $this->state,
      'country' => $this->country,
      'postalCode' => $this->postalCode,
      'email' => $this->email,
      'username' => $this->username,
      'dob' => $this->dob,
      'age' => $this->age,
      'pictureLarge' => $this->pictureLarge,
      'pictureMedium' => $this->pictureMedium,
      'pictureThumb' => $this->pictureThumb,
      'isMature' => $this->isMature,
      'height' => $this->height
    ];
  }
}