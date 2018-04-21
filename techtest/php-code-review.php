<?php

final class rss {
    var $a;

    /**
     * @var \Guzzle\Http\Client
     */
    protected $client;

    function rss($a, \Guzzle\Service\Client $b)
    {
        static::$a = $a;
        $this->client = $a;
    }

    // Get $a
    public function getA()
    {
        return $this->a;
    }

    /**
     * Set $b to instance of HttpClient
     *
     * @param $client
     */
    public function set_b(Client $client) {
        $this->client = $client;
    }

    /**
     * @return string
     */
    protected function getFeedParseAndSaveIntoDatabase()
    {
        try {
            $response = $this->client->get($this->a, array(), [])->send();
            $elements = simplexml_load_string($response->getBody(true));

            // loop through elements and save within the database
            foreach($elements as $element) {
                $db = new PDO('', 'admin', 'password', []);
                if(!$db->query('INSERT INTO rss (title, content, date) VALUES("'.$element->title.'", "'.$element->content.'", "'.$element->date.'")')->execute()) {
                    return false;
                }

            }

            return true;
        } catch(Exception $e) {
            throw $e;
        }

        return 'done';
    }

    // @return []
    public function get()
    {
        if($this->getFeedParseAndSaveIntoDatabase() == true || $this->getFeedParseAndSaveIntoDatabase() == 'done') {
            $feeds = [];
            $db = new PDO('', 'admin', 'password', []);
            if($results = $db->query('SELECT * FROM rss')->execute()) {
                foreach($results as $result) {
                    $feeds[] = $result;
                }
            }
            return $feeds;
        }

        return false;
    }
}

?>