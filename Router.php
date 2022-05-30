<?php
/*  */
require './Controllers/ProductController.php';
require './Controllers/ProductSizeController.php';

require './Controllers/HomeController.php';
require './Controllers/TrademarkController.php';
require './Controllers/SizeController.php';
require './Controllers/UserController.php';
require './Controllers/CustomerController.php';

require './Controllers/OrderController.php';
require './Controllers/OrderDetailController.php';
/* */

/* */
$routes = [];
$id = "";
if (isset($_REQUEST['id'])) {
  $id = $_GET['id'];
}

/* */

/* */
function route(string $path, callable $callback)
{
  global $routes;
  $routes[$path] = $callback;
}
/* */

/* ================= HOME ================= */
route('home', function () {
  echo "Home Page";
});
/* ================= HOME ================= */

/* ================= TRADEMARK ================= */
route('trademark/index', function () {
  $controller = new TrademarkController();
  $controller->index();
});
route('trademark/create', function () {
  $controller = new TrademarkController();
  $controller->create();
});
route('trademark/update/?id=' . $id, function () {
  $controller = new TrademarkController();
  $controller->update($_REQUEST['id']);
});
route('trademark/delete/?id=' . $id, function () {
  $controller = new TrademarkController();
  $controller->delete($_REQUEST['id']);
});
route('trademark/search', function () {
  $controller = new TrademarkController();
  $controller->search();
});
/* ================= TRADEMARK ================= */

/* ================= PRODUCT SIZE ================= */
route('product-size/index', function () {
  $controller = new ProductSizeController();
  $controller->index();
});
route('product-size/create', function () {
  $controller = new ProductSizeController();
  $controller->create();
});
route('product-size/?id=' . $id, function () {
  $controller = new ProductSizeController();
  $controller->getProductID($_REQUEST['id']);
});
route('product-size/delete/?id=' . $id, function () {
  $controller = new ProductSizeController();
  $controller->delete($_REQUEST['id']);
});
/* ================= PRODUCT SIZE ================= */

/* ================= PRODUCT ================= */
route('product/index', function () {
  $controller = new ProductController();
  $controller->index();
});
route('product/create', function () {
  $controller = new ProductController();
  $controller->create();
});
route('product/saveimg', function () {
  $controller = new ProductController();
  $controller->saveimg();
});
route('product/update/?id=' . $id, function () {
  $controller = new ProductController();
  $controller->update($_REQUEST['id']);
});
route('product/delete/?id=' . $id, function () {
  $controller = new ProductController();
  $controller->delete($_REQUEST['id']);
});
route('product/product-new', function () {
  $controller = new ProductController();
  $controller->productNew();
});
route('product/product-detail/?id=' . $id, function () {
  $controller = new ProductController();
  $controller->productDetail($_REQUEST['id']);
});
route('product/product-category/?id=' . $id, function () {
  $controller = new ProductController();
  $controller->productCategory($_REQUEST['id']);
});
route('product/all-product-category/?id=' . $id, function () {
  $controller = new ProductController();
  $controller->allProductCategory($_REQUEST['id']);
});
route('product/product-price/?id=' . $id, function () {
  $controller = new ProductController();
  $controller->getPrices($_REQUEST['id']);
});
route('product/search', function () {
  $controller = new ProductController();
  $controller->search();
});
/* ================= PRODUCT ================= */

/* ================= SIZE ================= */
route('size/index', function () {
  $controller = new SizeController();
  $controller->index();
});
route('size/all', function () {
  $controller = new SizeController();
  $controller->getAll();
});
route('size/create', function () {
  $controller = new SizeController();
  $controller->create();
});
route('size/delete/?id=' . $id, function () {
  $controller = new SizeController();
  $controller->delete($_REQUEST['id']);
});
route('size/search', function () {
  $controller = new SizeController();
  $controller->search();
});
/* ================= SIZE ================= */

/* ================= USER ================= */
route('user/index', function () {
  $controller = new UserController();
  $controller->index();
});
route('user/create', function () {
  $controller = new UserController();
  $controller->create();
});
route('user/update/?id=' . $id, function () {
  $controller = new UserController();
  $controller->update($_REQUEST['id']);
});
route('user/delete/?id=' . $id, function () {
  $controller = new UserController();
  $controller->delete($_REQUEST['id']);
});
route('user/?id=' . $id, function () {
  $controller = new UserController();
  $controller->getId($_REQUEST['id']);
});
route('user/login', function () {
  $controller = new UserController();
  $controller->login();
});
route('user/search', function () {
  $controller = new UserController();
  $controller->search();
});
/* ================= USER ================= */

/* ================= CUSTOMER ================= */

route('customer/index', function () {
  $controller = new CustomerController();
  $controller->index();
});
route('customer/create', function () {
  $controller = new CustomerController();
  $controller->create();
});
route('customer/?id=' . $id, function () {
  $controller = new CustomerController();
  $controller->getById($_REQUEST['id']);
});

/* ================= CUSTOMER ================= */

/* ================= ORDER ================= */
route('order/index', function () {
  $controller = new OrderController();
  $controller->index();
});
route('order/create', function () {
  $controller = new OrderController();
  $controller->create();
});
route('order/update/?id=' . $id, function () {
  $controller = new OrderController();
  $controller->update($_REQUEST['id']);
});
route('order/?id=' . $id, function () {
  $controller = new OrderController();
  $controller->getID($_REQUEST['id']);
});
route('order/status/?id=' . $id, function () {
  $controller = new OrderController();
  $controller->getStatus($_REQUEST['id']);
});
route('order/date/?id=' . $id, function () {
  $controller = new OrderController();
  $controller->getByDates($_REQUEST['id']);
});
route('order/statistics', function () {
  $controller = new OrderController();
  $controller->getByStatistics();
});
/* ================= ORDER ================= */

/* ================= ORDER DETAIL ================= */
route('order-detail/index', function () {
  $controller = new OrderDetailController();
  $controller->index();
});
route('order-detail/create', function () {
  $controller = new OrderDetailController();
  $controller->create();
});
route('order-detail/?id=' . $id, function () {
  $controller = new OrderDetailController();
  $controller->getOrderDetail($_REQUEST['id']);
});
/* ================= ORDER DETAIL ================= */

/* ================= 404 ================= */
route('404', function () {
  $controller = new HomeController();
  $controller->page_404();
});
/* ================= 404 ================= */
/* */

/* */
global $routes;
$page404 = false;
$url = $_SERVER['REQUEST_URI'];/* lay url : /shoe/backend/login*/
$url = ltrim($url, '/');/* ltrim xóa ki tu bên trái*/
$url = explode('/', $url); /*  explode('',$string) chuyen chuoi thanh mang */
$ids = end($url); /* Hàm này trả về phần tử cuối cùng của mảng.*/
$url = array_slice($url, 2, 5); //cắt bỏ phần tử của mảng, giữ lại những phần tử được chọn
//$controller = ucfirst($url[0]).'Controller()';
//$method=$url[1].'()';

$urlstr = implode('/', $url);
foreach ($routes as $path => $callback) {
  try {
    if (strcasecmp($path, $urlstr) == 0) {
      $page404 = true;
      $callback();
    }
  } catch (Exception $e) {
    $notFoundCallback = $routes['404'];
    $notFoundCallback();
  }
}
if (!$page404) {
  $notFoundCallback = $routes['404'];
  $notFoundCallback();
}
/* */