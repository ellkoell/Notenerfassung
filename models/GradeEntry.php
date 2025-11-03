<?php

namespace models;

class GradeEntry
{
    private $name;
    private $email;
    private $examDate;
    private $subject;
    private $grade = '';
    private $errors = [];

    public function __construct()
    {

    }

    public function getAll()
    {
        $grades = [];

        if (isset($_SESSION['grades'])) {
            foreach ($_SESSION['grades'] as $g) {
                $grades[] = unserialize($g);
            }
        }
        return $grades;
    }

    public function deleteAll()
    {
        if (isset($_SESSION['grades'])) {
            unset($_SESSION['grades']);
        }
    }

    public function save()
    {
        if ($this->validate()) {

            $s = serialize($this);
            $_SESSION['grades'] = $s;
            return true;
        }
        return false;
    }

    function validate()
    {
        return $this->validateName($this->name) & $this->validateEmail($this->email) & $this->validateexamDate($this->examDate) & $this->validateexamGrade($this->grade)
            & $this->validateSubject($this->subject);
    }

    private function validateName()
    {

        if ($this->strlen(name) == 0) {
            $errors['name'] = "Name darf nicht leer sein";
        } else if (strlen($this->name) > 20) {
            $errors[] = "Name zu lang";
            return false;
        } else {
            return true;
        }
    }

    private function validateexamDate()
    {
        try {
            if ($this->examDate == "") {
                $errors['examDate'] = "Prüfungsdatum darf nicht leer sein";
                return false;
            } else if (new DateTime(examDate) > new DateTime()) {
                $errors['examDate'] = "Prüfungsdatum darf nicht in der Zukunft liegen";
                return false;
            } else {
                return true;
            }
        } catch (Exception $e) {
            $errors['examDate'] = "Prüfungsdatum ungültig";
            return false;
        }


    }

    private function validateSubject()
    {
        if ($this->subject != 'm' && $this->subject != 'e' && $this->subject != 'd') {
            $errors['subject'] = "Fach ungültig";
            return false;
        } else {
            return true;
        }
    }

    private function validateexamGrade()
    {
        if (!is_numeric($this->grade) || $this->grade > 5) {
            $this->errors['grade'] = "Note ungültig";
            return false;
        } else {
            return true;
        }
    }

    private function validateEmail()
    {
        if ($this->email != "" && !filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = "Email ungültig";
            return false;
        } else {
            return true;
        }
    }

    public function getExamDateFormatted()
    {
        return date_format(date_create($this->examDate), "d.m.Y");
    }

    public function getSubjectFormatted()
    {
        switch ($this->subject) {
            case 'm':
                return "Mathematik";
            case 'd':
                return "Deutsch";
            case 'e':
                return "Englisch";
            default:
                return null;

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

    public function hasErrors($field)
    {
        return isset($this->errors[$field]);
    }

}