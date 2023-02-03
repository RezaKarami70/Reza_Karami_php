<?PHP

$products_file = file_get_contents('products.json');
$articles_file = file_get_contents('inventory.json');
$products_data = json_decode($products_file, TRUE);
$articles_data = json_decode($articles_file, TRUE);

$articles = array();
$products = array();



for ($i = 0; $i < count($products_data['products']); $i++) {
    $name = $products_data['products'][$i]['name'];
    $price = $products_data['products'][$i]['price'];
    $contain_article = $products_data['products'][$i]['contain_articles'];
    array_push($products, new product($name, $price, $contain_article));
}

for ($i = 0; $i < count($articles_data['inventory']); $i++) {
    $art_id = $articles_data['inventory'][$i]['art_id'];
    $art_name = $articles_data['inventory'][$i]['name'];
    $art_stock = $articles_data['inventory'][$i]['stock'];
    array_push($articles, new article($art_id, $art_name, $art_stock));
}


// echo '<pre>';
//  var_dump($products);
//  echo '</pre>';




$sale_item = array_filter($products, function($product) {
    return $product->get_name() === "Dining Chair";
});


print_r("Saling item is " . $sale_item[0]->get_name());
echo '<br>';
print_r("the price is " . $sale_item[0]->get_price());
echo '<br>';
print_r("the articles are; ");
echo '<br>';
echo '<br>';

$items = $sale_item[0]->get_contain_articles();
for ($i = 0; $i < count($items); $i++) {
    print_r("article id is: " . $items[$i]['art_id']);
    echo '<br>';
    print_r("article name is: " . $articles[$items[$i]['art_id'] - 1]->get_name());
    echo '<br>';
    $amount = (int) $items[$i]['amount_of'];
    $befor = (int) $articles[$items[$i]['art_id'] - 1]->get_availabllty();
    $after = $befor - $amount;
    if ($after >= 0) {
        print_r("amount of needed article is: " . $amount);
        echo '<br>';
        print_r("amount of article befor sale is: " . $befor);
        echo '<br>';
        $articles[$items[$i]['art_id'] - 1]->set_availabllty($after);
        print_r("amount of article after sale is: " . $befor . "-" . $amount . "=" . $after);
        echo '<br>';
        echo '<br>';
    }
        if ($after < 0) {
        print_r("Product is not avelibel");
        echo '<br>';
    }
    
}



class product {

    private $name;
    private $price;
    private $contain_articles = array();

    function __construct($name, $price, $contain_article) {
        $this->name = $name;
        $this->price = $price;
        $this->contain_articles = $contain_article;
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

    function to_stirng() {
        
    }

}

class article {

    private $art_id;
    private $art_name;
    private $art_stock;

    function __construct($id, $Name, $Stock) {
        $this->art_id = $id;
        $this->art_name = $Name;
        $this->art_stock = $Stock;
    }

    function set_id($ID) {
        $this->art_id = $ID;
    }

    function set_name($n) {
        $this->art_name = $n;
    }

    function set_availabllty($Stock) {
        $this->art_stock = $Stock;
    }

    function get_id() {
        return $this->art_id;
    }

    function get_name() {
        return $this->art_name;
    }

    function get_availabllty() {
        return $this->art_stock;
    }

    function to_string() {
        
    }

}
