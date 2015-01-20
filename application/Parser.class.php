<?php
class Parser {
    public function __construct($url) {
        try {
            $this->_currentUrl = $url;
        } catch (Exception $e) {
            throw new ParserException('Failed to create document by url');
        }
    }

    /**
     * @return null|phpQueryObject|QueryTemplatesParse|QueryTemplatesSource|QueryTemplatesSourceQuery
     * @throws Exception
     */
    public function getDocument() {
        if ($this->_document == null) {
            $content = $this->getHtmlText();
            if (!$content) {
                throw new Exception();
            }
            $this->_document = phpQuery::newDocument($content);
        }
        return $this->_document;
    }

    /**
     * @return mixed|String
     * @throws ParserException
     */
    public function findPrice() {
        try {
            $price = $this->getDocument()->find('#priceblock_ourprice')->text();
            if (!$price) {
                throw new Exception();
            }
            $price = str_replace('$', '', trim($price));
            $price = str_replace(',', '.', $price);

            return $price;
        } catch (Exception $e) {
            throw new ParserException('Failed parse price');
        }
    }

    public function getHtmlText() {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->_currentUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
        curl_setopt($ch, CURLOPT_USERAGENT, 'Accept:text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8');
        $file = curl_exec($ch);
        curl_close($ch);
        return $file;
    }

    private $_currentUrl = '';

    private $_document = null;

}