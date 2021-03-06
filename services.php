<?php
ini_set('display_errors',1);
require_once "config/database.php";
require_once "lib/nusoap/nusoap.php";
require_once "function.php";

// config server's services
$server = new soap_server;
$server->configureWSDL("hotels", "urn:hotels");

// addNewHotel
$server->register("addNewHotel",
  array("id" => "xsd:string", "name" => "xsd:string", "star" => "xsd:integer",
    "province" => "xsd:string", "country" => "xsd:string", "address" => "xsd:string",
    "website" => "xsd:string", "phone" => "xsd:string",
    "total_rooms" => "xsd:integer", "cost" => "xsd:integer"), // input params
  array("return" => "xsd:integer"), // output
  "urn:hotels", // namespace
  "urn:hotels#addNewHotel",
  "rpc",
  "encoded",
  "Add new hotel"
  );

// isExistedHotel
$server->register("isExistedHotel",
  array("id" => "xsd:string"), // input params
  array("return" => "xsd:integer"), // output
  "urn:hotels", // namespace
  "urn:hotels#isExistedHotel",
  "rpc",
  "encoded",
  "Check hotel is existed or not"
  );

// findByProvince
$server->register("findByProvince",
  array("province" => "xsd:string"), // input params
  array("return" => "xsd:string"), // output
  "urn:hotels", // namespace
  "urn:hotels#findByProvince",
  "rpc",
  "encoded",
  "Find all hotels in province"
  );

// addNewContact
$server->register("addNewContract",
  array("hotel_id" => "xsd:string", "customer_id_number" => "xsd:string", "company_name" => "xsd:string",
    "company_address" => "xsd:string", "company_phone" => "xsd:string", "bookings_rooms" => "xsd:integer",
    "check_in_date" => "xsd:string", "check_out_date" => "xsd:string", "payment_method" => "xsd:string"), // input params
  array("return" => "xsd:integer"), // output
  "urn:hotels", // namespace
  "urn:hotels#addNewContract",
  "rpc",
  "encoded",
  "Add new contract"
  );

// checkRoomAvailable
$server->register("checkRoomAvailable",
  array("hotel_id" => "xsd:string"), // input params
  array("return" => "xsd:integer"), // output
  "urn:hotels", // namespace
  "urn:hotels#checkRoomAvailable",
  "rpc",
  "encoded",
  "Check room available"
  );

// getAllHotels
$server->register("getAllHotels",
  array(), // input params
  array("return" => "xsd:string"), // output
  "urn:hotels", // namespace
  "urn:hotels#getAllHotels",
  "rpc",
  "encoded",
  "Get all hotels"
  );
// deploy services
$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : "";
$server->service($HTTP_RAW_POST_DATA);
?>
