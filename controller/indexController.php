<?php

class indexController Extends BaseController {

    public function index() {
        session_start();
        $this->_template = $this->registry->template;

        $url = 'http://www.amazon.com/dp/';

        $email = $this->getArgument('email');
        if ($email) {
            print 'bot';
            exit();
        }
        $asin = $this->getArgument('asin');
        $userPrice = (float) $this->getArgument('price');
        if ($asin && $userPrice) {
            try {
                $key = md5($asin.$this->_salt);
                if (isset($_SESSION[$key])) {
                    $foundPrice = $_SESSION[$key];
                } else {
                    $parser = new Parser($url.$asin);
                    $foundPrice = $parser->findPrice();
                    $_SESSION[$key] = $foundPrice;
                }

                if ($this->_calculateResult($userPrice, $foundPrice)) {
                    print 'ok';
                    exit();
                } else {
                    print 'mistake';
                    exit();
                }
            } catch (ParserException $e) {
                print 'parser error';
                exit();
            }
        }

        // load the index template
        $this->_template->show('index');
    }

    /**
     * @param $userPrice
     * @param $foundPrice
     * @param int $accuracy
     * @return bool
     */
    private function _calculateResult($userPrice, $foundPrice, $accuracy = 20) {

        $min = $foundPrice * (100 - $accuracy) / 100;
        $max = $foundPrice * (100 + $accuracy) / 100;

        if ($userPrice >= $min && $userPrice <= $max) {
            return true;
        }
        return false;

    }

    /**
     * @var null
     */
    private $_template = null;

    private $_salt = 'price';

}

?>
