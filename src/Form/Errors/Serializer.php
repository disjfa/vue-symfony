<?php

namespace App\Form\Errors;

use Symfony\Component\Form\Form;

class Serializer
{
    /**
     * @param Form $form
     *
     * @return array
     */
    public static function serialize(Form $form)
    {
        $errors = [];
        // Global
        foreach ($form->getErrors() as $error) {
            $errors[$form->getName()][] = $error->getMessage();
        }
        foreach ($form->getIterator() as $key => $child) {
            foreach ($child->getErrors() as $error) {
                $errors[$key][] = $error->getMessage();
            }
            if (($child instanceof Form) && (count($child->getIterator()) > 0)) {
                if (!empty(self::serialize($child))) {
                    $errors[$key] = self::serialize($child);
                }
            }
        }

        return $errors;
    }
}
