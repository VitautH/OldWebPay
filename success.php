<?php
/*
Template Name: success
*/
include_once ("Class/WebPayAPI.php");
?>
<?php get_header(); ?>
    <link href="<?php echo get_template_directory_uri(); ?>/css/view.css" rel="stylesheet">
    <script src="<?php echo get_template_directory_uri(); ?>/js/view.js"></script>
    <div class="row background_row ">
        <?php get_sidebar(); ?>
        <div class="col-md-4 col-xs-4 content">
            <?php if(have_posts()) : ?>
            <?php while(have_posts()) : the_post(); ?>
            <h1 class="zagolovok"><?php the_title(); ?></h1>
        <?php the_content(); ?>
<? //print_r($_GET ['wsb_tid']); ?>
                 <?   $postdata = '*API=&API_XML_REQUEST='.urlencode('
                    <?xml version="1.0" encoding="ISO-8859-1" ?>
                    <wsb_api_request>
                        <command>get_transaction</command>
                        <authorization>
                            <username>prav</username>
                            <password>'.md5("mn:z'GPo?.]").'</password>
                        </authorization>
                        <fields>
                            <transaction_id>'.$_GET ['wsb_tid'].'
                            </transaction_id>
                        </fields>
                    </wsb_api_request>
                    ');
                    $curl = curl_init ("https://sandbox.webpay.by"); curl_setopt ($curl, CURLOPT_HEADER, 0); curl_setopt ($curl, CURLOPT_POST, 1);
                    curl_setopt ($curl, CURLOPT_POSTFIELDS, $postdata); curl_setopt ($curl, CURLOPT_SSL_VERIFYPEER, 0); curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1); curl_setopt ($curl, CURLOPT_SSL_VERIFYHOST, 0);
                    $response = curl_exec ($curl); curl_close ($curl);
                    $xml = simplexml_load_string($response);
//print_r($xml );
                  $order_id= $xml->fields->order_id;
                     $site_order_id= $xml->fields->order_num;
                    $transaction_id= $xml->fields->transaction_id;
                  $status= $xml->fields->payment_type;
                     $price= $xml->fields->amount;


//                    sqlite_query($db, "CREATE TABLE file ("
//                        . "id integer PRIMARY KEY   NOT NULL, "
//                        . "name text, "
//                        . "address text, "
//                        . "email text, "
//                        . "phone text, "
//                        . "type integer,"
//                        . "order_id integer,"
//                        . "site_order_id integer,"
//                        . "transaction_id integer,"
//                        . "status integer,"
//                        . "price integer,"
//                        . "time DATETIME);");
//                    return $db;


if ($status==1 or $status==4){
    $api = new  WebPayAPI(0);
   $api->oplata_save_Db ($order_id,$site_order_id,$transaction_id,$status,$price);


    echo "<a href='http://prav.by/download.php?&file=".$transaction_id."' target='_blank'>Скачать документы</a>";
}
                        ?>
                <?php endwhile; ?>
            <?php endif; ?>

        </div>
        <div class="col-md-4 col-xs-4 rightmenu">
            <?php $other_page2 = 4066; ?>
            <?php while (has_sub_field('action_left', $other_page2)): ?>
                <?php $bigakcia = get_sub_field('action_image', $other_page);
                $akciaimage = wp_get_attachment_image_src($bigakcia, 'akcia-photo');
                $h1_action = get_sub_field('h1_action', $other_page);
                $text_action = get_sub_field('text_action', $other_page); ?>
                <img src="<?php echo $akciaimage[0]; ?>" class="image_akcia" />
                <div class="akcia_text">
                    <h1><?php echo $h1_action ?><h1>
                            <?php echo $text_action ?>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

<?php get_footer(); ?>