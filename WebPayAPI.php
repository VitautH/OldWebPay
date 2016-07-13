<?
class WebPayAPI {
private $db;

    private $name;
    private  $address;
    private  $email;
    private $phone;
    private  $wsb_storeid;
    private  $wsb_seed;
    private  $wsb_secret_key;
    private $wsb_order_num;
    private  $wsb_test;
    private  $wsb_currency_id;
    private $wsb_total;
    private $wsb_invoice_item_name;
    private $wsb_signature;
    private $price_ooo;
    private $price_chup;
    private $password;
private  $type;
    private $email_send;
private $service;
    public function __construct()
    {
        $this->db = sqlite_open("webpay.db") or
        die("failed to open/create the database");
     //  sqlite_query($this->db, "ALTER TABLE tbl_info ADD COLUMN weight INTEGER; ");
       // return $this->db;
        $this->service;
        $this->email_send = 'zab-gor@mail.ru';
       $this->wsb_storeid= '819962499';
        $this->wsb_seed  = time();
$this->password = 'f42a7c6c4d1d608f6c0bc7b5f28400a9';
       $this->wsb_secret_key ='3456709876556789';
        //$q = sqlite_query($this->db, "DELETE FROM webpay_users WHERE status = '';");
        ////
$q = sqlite_query($this->db, "SELECT site_order_id FROM webpay_users ORDER BY id DESC LIMIT 1;");
        while ($row = sqlite_fetch_array($q)){

            $site_order_id = $row ['site_order_id'];


        }
        $site_order_id = preg_replace("/[^0-9]/", '', $site_order_id);
        $site_order_id_tmp= ++$site_order_id;
        $this->wsb_order_num='ORDER-'.$site_order_id_tmp;
        /////
        $this->wsb_test= '1';
        $this->wsb_currency_id = 'BYR';
        $this->wsb_total = 0;
        $this->wsb_invoice_item_name = '';
        $this->name = '';
        $this->address='';
       $this->email='';
        $this->phone='';
        $this->wsb_signature='';
    $this->wsb_total='';
        $this->type;
        $q = sqlite_query($this->db, "SELECT * from price_webpay WHERE id=='1' ");

        while ($row = sqlite_fetch_array($q)){

            $this->price_ooo = $row ['price_ooo'];

            $this->price_chup = $row ['price_chup'];
        }


    }
    private function __set($index, $value)
    {
        if(isset($this->$index)) {

             $this->$index = $value;


            }
        }
    private function __get($index)
    {
        return $this->$index;
    }
private  function password ($password) {
$hash_password = md5(md5($password));
    if ($this->password ==$hash_password ) {
        echo '1c5e'; // request code
    }
}
    private  function setPrice (){
$this->price_ooo;
        $this->price_chup;
        sqlite_query($this->db, "UPDATE price_webpay SET price_ooo=$this->price_ooo,price_chup=$this->price_chup WHERE id=='1' ");
        $q = sqlite_query($this->db, "SELECT * from price_webpay WHERE id=='1' ");

        while ($row = sqlite_fetch_array($q)){

            $this->price_ooo = $row ['price_ooo'];

            $this->price_chup = $row ['price_chup'];
        }
        echo "Цены успешно изменены!";

    }
    private  function dataPDF ($transaction_id){

        $q = sqlite_query($this->db, "SELECT * from webpay_users WHERE transaction_id==$transaction_id");

        while ($row = sqlite_fetch_array($q)){


        }
        return $transaction_id;
    }
    private function viewUserDb (){
        $q = sqlite_query($this->db, "SELECT * from webpay_users WHERE status==1 or status==4 ");

        while ($row = sqlite_fetch_array($q)){


 ?>
  <tr class="tr_<?  echo $row ['id']; ?>">
    <td class="tg-yw4l"> <?  echo $row ['id']; ?></td>
    <td class="tg-yw4l"> <?  echo $row ['name']; ?></td>
    <td class="tg-yw4l"> <?  echo $row ['address']; ?></td>
    <td class="tg-yw4l"> <?  echo $row ['email']; ?></td>
    <td class="tg-yw4l"> <?  echo $row ['phone']; ?></td>
    <td class="tg-yw4l"> <?  echo $row ['service']; ?></td>
    <td class="tg-yw4l"> <?  echo $row ['price']; ?></td>
      <td class="tg-yw4l"> <a href="#" id="<?  echo $row ['id']; ?>" class="delete">x</a></td>
  </tr>


<?
        }
    }
private function saveUser (){
    $this->name;
    $this->address;
    $this->email;
    $this->phone;
    $this->price;
    $this->wsb_order_num;
    $this->wsb_invoice_item_name;
    sqlite_query($this->db, "INSERT INTO webpay_users "
        . "(id,name, address,email,phone,site_order_id,status, price, service)"
        . " VALUES (NULL, '$this->name', '$this->address','$this->email','$this->phone','$this->wsb_order_num','0', '$this->price', ' $this->wsb_invoice_item_name')");

}
    private function key (){

     $this->wsb_total;

     echo   $this->wsb_signature = sha1($this->wsb_seed.$this->wsb_storeid.$this->wsb_order_num.$this->wsb_test.$this->wsb_currency_id.$this->wsb_total.
            $this->wsb_secret_key);

    }
    private function oplata_save_Db (  $order_id, $transaction_id,
$site_order_id,   $status,   $price){
        $order_id;
        $site_order_id;
        $transaction_id;
        $status;
        $price;
    //    sqlite_query($this->db, "UPDATE webpay_users SET status='$this->status',transaction_id='$this->transaction_id',order_id= '$this->order_id', price = '$this->price'  WHERE site_order_id=='$this->site_order_id'");
       // $q = sqlite_query($this->db, "SELECT service from webpay_users WHERE site_order_id=='$this->site_order_id' ");
///
        sqlite_query($this->db, "UPDATE webpay_users SET status='$status',transaction_id='$transaction_id',order_id= '$order_id', price = '$price' WHERE site_order_id == '$site_order_id' ");
        $q = sqlite_query($this->db, "SELECT service from webpay_users WHERE site_order_id == '$site_order_id' ");
        while ($row = sqlite_fetch_array($q)){

       $this->type = $row['service'];
        }

    }

    private function delete ($id){
     $id;
        sqlite_query($this->db, "DELETE FROM webpay_users  WHERE id == '$id' ");

    }
private function download ($transaction_id){
    $q = sqlite_query($this->db, "SELECT * from webpay_users WHERE transaction_id == '$transaction_id' and (status == 4 or status== 1)  ");
    while ($row = sqlite_fetch_array($q)){

        $service = $row['service'];
        $name = $row['name'];
        $address = $row['address'];
        $email = $row['email'];
        $phone = $row['phone'];
    }
    ////
   $this->service=$service;


    $message= 'Произведена оплата. Покупатель:'.$name.'; Услуга:'.$service.'; Адрес:'.$address.' ; E-mail:'.$email.' ;Телефон:'.$phone;
    mail($this->email_send, "the subject", $message,
        "From: admin@prav.by \r\n"
        ."X-Mailer: PHP/" . phpversion());
   // sqlite_query($this->db, "UPDATE webpay_users SET download='10' WHERE transaction_id == '$transaction_id' ");
}
    public function __call($method, $arg)
    {

        if ($method=='setPrice') {
            $this->price_ooo = $arg [0];
            $this->price_chup = $arg [1];
            if (is_numeric( $this->price_ooo) and is_numeric($this->price_chup)) {
            $this->setPrice ($this->price_ooo,$this->price_chup);
            }
            else {
                echo "Ошибка! Не корректно введена цена\n";
            }
        }
        if ($method=='key') {
           // $this->wsb_total = $arg [0];
            $this->key();

        }
        if ($method=='download') {
            $transaction_id	= $arg [0];


          return  $this->download($transaction_id);

        }

        if ($method=='delete') {
            $id	= $arg [0];


            return  $this->delete ($id);

        }
        if ($method=='oplata_save_Db') {
           $order_id= $arg [0];
             $site_order_id=$arg [1];
             $transaction_id=$arg [2];
                $status= $arg [3];
                    $price=$arg [4];

            $this->oplata_save_Db($order_id, $transaction_id,
                $site_order_id,   $status,   $price);

        }
        if ($method=='viewUserDb') {
            $this->viewUserDb();

        }
        if ($method=='saveUser') {

            $this->name= $arg [0];
                $this->address=  $arg [1];
                    $this->email=  $arg [2];
                        $this->phone=  $arg [3];
            $this->price =  $arg [4];
            $this->wsb_invoice_item_name =  $arg [5];
            $this->saveUser($this->name,   $this->address,   $this->email,      $this->phone,  $this->price , $this->wsb_order_num, $this->wsb_invoice_item_name);
        }

        if ($method=='password') {
           $password=$arg [0];
           $this->password ($password);
        }
    }



    public function db_chek ($code)  {
        $this->code=$code;
        $q = sqlite_query($this->db, "SELECT transaction_id from webpay WHERE  ");

        while ($row = sqlite_fetch_array($q)){

            // echo $row ['transaction_id'];
        }
    }
   public  function __destruct() {
      //  $this->db->close();
    }
}