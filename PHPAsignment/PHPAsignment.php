<?PHP

$products_file = file_get_contents('products.json');
$articles_file = file_get_contents('products.json');
$products_data = json_decode($products_file, TRUE);
$articles_data = json_decode($products_file, TRUE);

$contain_articles = array();
$products = array();
$price = 0;


for ($i = 0; $i < count($products_data['products']); $i++) {
    $name = $products_data['products'][$i]['name'];
    $contain_articles = $products_data['products'][$i]['contain_articles'];
    $products = new product($name, $contain_article, $price);
}

class product {

    private $name;
    private $contain_articles = array();
    private $price;

    function __construct($name, $contain_article, $price) {
        $this->name = $name;
        $this->contain_articles = $contain_article;
        $this->price = $price;
    }

    function set_name($name) {
        $this->name = $name;
    }

    function set_contain_articles($contain_articles) {
        $this->contain_articles = $contain_articles;
    }

    function set_price($price) {
        $this->price = $price;
    }

    function get_name() {
        return $this->name;
    }

    function get_contain_articles() {
        return $this->contain_articles;
    }

    function get_price() {
        return $this->price;
    }

}

class articles {

    private $art_id;
    private $name;
    private $stock;

    function __construct($id, $Name, $Stock) {
        $this->name = $Name;
        $this->art_id = $id;
        $this->stock = $Stock;
    }

    function set_id($ID) {
        $this->art_id = $ID;
    }

    function set_name($n) {
        $this->name = $n;
    }

    function set_availabllty($Stock) {
        $this->stock = $Stock;
    }

    function get_id() {
        return $this->art_id;
    }

    function get_name() {
        return $this->name;
    }

    function get_availabllty() {
        return $this->stock;
    }

}
