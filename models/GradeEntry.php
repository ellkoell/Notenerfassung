<?php

namespace models;

use DateTime;
use Exception;

class GradeEntry
{
    private $name = '';
    private $email = '';
    private $examDate = '';
    private $subject = '';
    private $grade = '';
    private $errors = [];

    public static function getAll()
    {
        $grades = [];
        if (isset($_SESSION['grades'])) {
            foreach ($_SESSION['grades'] as $g) {
                $grades[] = unserialize($g);
            }
        }
        return $grades;
    }

    public static function deleteAll()
    {
        if (isset($_SESSION['grades'])) {
            unset($_SESSION['grades']);
        }
    }

    public function save()
    {
        if ($this->validate()) {
            $entry = serialize($this);
            if (!isset($_SESSION['grades']) || !is_array($_SESSION['grades'])) {
                $_SESSION['grades'] = [];
            }
            $_SESSION['grades'][] = $entry;
            return true;
        }
        return false;
    }

    public function validate()
    {
        // Fehler-Array zurücksetzen!
        $this->errors = [];
        $valid =
            $this->validateName() &&
            $this->validateEmail() &&
            $this->validateExamDate() &&
            $this->validateGrade() &&
            $this->validateSubject();
        return $valid;
    }

    private function validateName()
    {
        if (strlen($this->name) === 0) {
            $this->errors['name'] = "Name darf nicht leer sein";
            return false;
        } elseif (strlen($this->name) > 20) {
            $this->errors['name'] = "Name zu lang";
            return false;
        }
        return true;
    }

    private function validateEmail()
    {
        // Email optional, aber falls ausgefüllt, muss sie valide sein!
        if ($this->email !== '' && !filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = "Email ungültig";
            return false;
        }
        return true;
    }

    private function validateExamDate()
    {
        try {
            if ($this->examDate === '') {
                $this->errors['examDate'] = "Prüfungsdatum darf nicht leer sein";
                return false;
            } elseif (new DateTime($this->examDate) > new DateTime()) {
                $this->errors['examDate'] = "Prüfungsdatum darf nicht in der Zukunft liegen";
                return false;
            }
        } catch (Exception $ex) {
            $this->errors['examDate'] = "Prüfungsdatum ungültig";
            return false;
        }
        return true;
    }

    private function validateSubject()
    {
        if (!in_array($this->subject, ['m', 'd', 'e'])) {
            $this->errors['subject'] = "Fach ungültig";
            return false;
        }
        return true;
    }

    private function validateGrade()
    {
        if (!is_numeric($this->grade) || $this->grade < 1 || $this->grade > 5) {
            $this->errors['grade'] = "Note ungültig";
            return false;
        }
        return true;
    }

    public function getExamDateFormatted()
    {
        if ($this->examDate !== '') {
            try {
                return date_format(date_create($this->examDate), "d.m.Y");
            } catch (Exception $ex) {
                return '';
            }
        }
        return '';
    }

    public function getSubjectFormatted()
    {
        switch ($this->subject) {
            case 'm':
                return 'Mathematik';
            case 'd':
                return 'Deutsch';
            case 'e':
                return 'Englisch';
            default:
                return null;
        }
    }

    public function getName()
    {
        return $this->name;
    }
    public function setName($name)
    {
        $this->name = $name;
    }

    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getExamDate()
    {
        return $this->examDate;
    }
    public function setExamDate($examDate)
    {
        $this->examDate = $examDate;
    }

    public function getSubject()
    {
        return $this->subject;
    }
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    public function getGrade()
    {
        return $this->grade;
    }
    public function setGrade($grade)
    {
        $this->grade = $grade;
    }

    public function getErrors()
    {
        return $this->errors;
    }
    public function hasErrors($field)
    {
        return isset($this->errors[$field]);
    }
}
