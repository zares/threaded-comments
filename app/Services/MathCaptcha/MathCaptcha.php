<?php

namespace App\Services\MathCaptcha;

use Illuminate\Session\SessionManager;

class MathCaptcha
{
    /**
     * @var SessionManager
     */
    private $session;

    /**
     * Constructor.
     * @param SessionManager|null $session
     */
    public function __construct(SessionManager $session = null)
    {
        $this->session = $session;
    }

    /**
     * Returns the math question as string.
     * @return string
     */
    public function label()
    {
        return sprintf("%d %s %d",
            $this->secondOperator(),
            $this->mathOperand(),
            $this->firstOperator()
        );
    }

    /**
     * Input field validation.
     * @param  string|integer $value
     * @return boolean
     */
    public function verify($value)
    {
        return $value == $this->getMathResult();
    }

    /**
     * Operand to be used ('*','-','+').
     * @return character
     */
    protected function mathOperand()
    {
        if (! $this->session->get('captcha.operand')) {
            $this->session->put(
                'captcha.operand', config(
                    'math-captcha.operands.'. array_rand(
                        config('math-captcha.operands')
                    )
                )
            );
        }

        return $this->session->get('captcha.operand');
    }

    /**
     * The first math operand.
     * @return integer
     */
    protected function firstOperator()
    {
        if (! $this->session->get('captcha.first')) {
            $this->session->put(
                'captcha.first',
                rand(config('math-captcha.rand-min'),
                    config('math-captcha.rand-max')
                )
            );
        }

        return $this->session->get('captcha.first');
    }

    /**
     * The second math operand.
     * @return integer
     */
    protected function secondOperator()
    {
        if (! $this->session->get('captcha.second')) {
            $this->session->put(
                'captcha.second',
                $this->firstOperator() + rand(
                    config('math-captcha.rand-min'),
                    config('math-captcha.rand-max')
                )
            );
        }

        return $this->session->get('captcha.second');
    }

    /**
     * The math result to be validated.
     * @return integer
     */
    protected function getMathResult()
    {
        switch ($this->mathOperand()) {
            case '+':
                return $this->firstOperator() + $this->secondOperator();
            case '*':
                return $this->firstOperator() * $this->secondOperator();
            case '-':
                return abs($this->firstOperator() - $this->secondOperator());
            default:
                throw new \Exception('Unknown operand...');
        }
    }

    /**
     * Reset the math operators.
     * @return void
     */
    public function reset()
    {
        $this->session->forget('captcha.first');
        $this->session->forget('captcha.second');
        $this->session->forget('captcha.operand');
    }

}
