<?php
namespace Src\Helpers\Validator;

use Psr\Http\Message\RequestInterface;
use Respect\Validation\Validor as Respect;
use Respect\Validation\Exceptions\NestedValidationException;

class Validator
{
    /** @var array */
    protected $errors = [];

    /**
     * @param RequestInterface $request
     * @param array $rules
     *
     * @return $this
     */
    public function validate(RequestInterface $request, array $rules)
    {
        foreach ( $rules as $field => $rule ) {
            try {
                $rule->setName(ucfirst($field))->assert($request->getParam($field));
            } catch (NestedValidationException $e) {
                $this->errors[] = $e->getMessages();
            }
        }

        $_SESSION['errors'] = $this->errors;

        return $this;
    }

    /**
     * @return bool
     */
    public function isValid()
    {
        return empty($this->errors);
    }
}