<?php

namespace models;

class GradeEntry
{
private $name;
private $email;
private $examDate;
private $subject;
private $grade = '';
private $errors= [];

public function __construct(){

}
public function getAll()
{

}

public function deleteAll()
{

}
public function save()
{if ($this -> validate()){
    return true;

}
return false;
}

    function validate()
    {
        return $this->validateName($this->name) & $this->validateEmail($this->email) & $this->validateexamDate($this->examDate) & $this->validateexamGrade($this->grade)
            &$this->validateSubject($this->subject);
    }

    function validateName() {

        if ($this -> strlen(name)==0){
            $errors['name'] = "Name darf nicht leer sein";
        }else if (strlen($this ->name) > 20){
            $errors[] = "Name zu lang";
            return false;
        } else {
            return true;
        }
    }

    function validateexamDate() {
        try {
            if ($this->examDate==""){
                $errors['examDate'] = "Prüfungsdatum darf nicht leer sein";
                return false;
               }else if (new DateTime($examDate) > new DateTime()){
                $errors['examDate'] = "Prüfungsdatum darf nicht in der Zukunft liegen";
                return false;
            } else {
                return true;
            }
        } catch (Exception $e){
            $errors['examDate'] = "Prüfungsdatum ungültig";
            return false;
        }


    }

    function validateSubject() {
        if ($this->subject !='m' && $this->subject!='e' && $this->subject !='d'){
            $errors['subject'] = "Fach ungültig";
            return false;
        }else {
            return true;
        }
    }

    function validateexamGrade() {
        if (!is_numeric($this->grade)|| $this->grade >5){
            $this->errors['grade'] = "Note ungültig";
            return false;
        } else {
            return true;
        }
    }

    function validateEmail() {
        if ($this->email != "" && !filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            $this->errors['email'] = "Email ungültig";
            return false;
        } else {
            return true;
        }
    }
    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getExamDate()
    {
        return $this->examDate;
    }

    /**
     * @param mixed $examDate
     */
    public function setExamDate($examDate)
    {
        $this->examDate = $examDate;
    }

    /**
     * @return mixed
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param mixed $subject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    /**
     * @return string
     */
    public function getGrade()
    {
        return $this->grade;
    }

    /**
     * @param string $grade
     */
    public function setGrade($grade)
    {
        $this->grade = $grade;
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @param array $errors
     */
    public function setErrors($errors)
    {
        $this->errors = $errors;
    }
}