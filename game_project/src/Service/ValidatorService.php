<?php

namespace App\Service;

use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Validation;

class ValidatorService
{
    private $validator;
    private $violations;
    public function __construct()
    {
        $this->validator = Validation::createValidator();
    }
   public function validate($value) : bool {
        $violationArray = array();
        $violationsVal = $this->validator->validate($value, [
           new NotBlank(),
        ]);
        if (0 !== count($violationsVal)) {
           foreach ($violationsVal as $violation) {
               $violationArray[] = $violation->getMessage().'<br>';
           }
           $this->violations = $violationArray;
           return false;
        }
        return true;
   }
   public function getViolationsMessage() {
        return $this->violations;
   }
}