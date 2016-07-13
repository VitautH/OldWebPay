<?php
/*
Template Name: oplata
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

               <? if (($_POST['form_id']== 'id344')&& isset ($_POST['name1']) && isset ($_POST ['lastname1']) && isset ($_POST ['surname']) && ($_POST ['index']) && ($_POST ['city']) && ($_POST['street']) && ($_POST['home']) && ($_POST ['app']) && ($_POST ['email']) && ($_POST ['phone']) && ($_POST ['oferta']))
                {
                    $api = new  WebPayAPI ();

                    $name = $_POST['name1'];
                    $lastname = $_POST ['lastname1'];
                    $surname = $_POST ['surname'];

                $address = 'Индекс: '.$_POST ['index'].', город: '.$_POST ['city'].', улица: '.$_POST['street'].', дом: '.$_POST['home'].', кв.: '.$_POST ['app'];
                   $email = $_POST ['email'];
                  $phone = $_POST ['phone'];
                   $invoice_item_name = $_POST ['invoice_item_name'];
                    switch ($invoice_item_name) {
                        case 'ooo':
                            $total = $api->price_ooo;
                            break;
                        case 'chup':
                            $total = $api->price_chup;
                            break;

                    }



                    $api->wsb_invoice_item_name = $invoice_item_name;
                    $api->wsb_total= $total;

                    $api->lastname = $lastname;
                    $api->surname= $surname;
                    $api->address= $address;
                    $api->email = $email;
               $api->phone = $phone;

                  $api->name= $lastname.' '.$name.' '.$surname;
                //    print_r($api);
$api->saveUser($api->name, $address, $phone,$email, $api->wsb_total, $api->wsb_invoice_item_name);
//}
                ?>
                    <table class="table table-condensed">
                        <thead>
                        <tr> <th>#</th> <th>Счёт</th> </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row">ФИО:</th> <td><b><? echo $api->name; ?></b></td>
                        </tr>
                        <tr>
                            <th scope="row">Адрес доставки:</th> <td><b><? echo $address; ?></b></td>
                        </tr>
                        <tr>
                            <th scope="row">Телефон:</th> <td><b><? echo $phone; ?></b></td>
                        </tr>
                        <tr>
                            <th scope="row">E-mail:</th> <td><b><? echo $email; ?></b></td>
                        </tr>
                        <tr>
                            <th scope="row">Услуга:</th> <td><b>Пакет документов для регистрации  <?
                                    switch ($api->wsb_invoice_item_name) {
                                        case 'ooo':
                                           echo "ООО";
                                            break;
                                        case 'chup':

                                            echo "ЧУП";
                                            break;

                                    }
                                    ?></b></td>
                        </tr>
                        <tr>
                            <th scope="row">Стоимость:</th> <td><b> <? echo $api->wsb_total; ?> BYR</b></td>
                        </tr>
                        <tr> <th scope="row"><form action="https://securesandbox.webpay.by/" method="post">
                                    <input type="hidden" name="*scart">
                                    <input type="hidden" name="wsb_version" value="2">
                                    <input type="hidden" name="wsb_language_id" value="russian">
                                    <input type="hidden" name="wsb_storeid" value="<? echo $api->wsb_storeid; ?>" >
                                    <input type="hidden" name="wsb_order_num" value="<? echo $api->wsb_order_num; ?>" >
                                    <input type="hidden" name="wsb_test" value="1" >
                                    <input type="hidden" name="wsb_currency_id" value="BYR" >
                                    <input type="hidden" name="wsb_seed" value="<? echo $api->wsb_seed; ?>">
                                    <input type="hidden" name="wsb_customer_name" value="<? echo $lastname.' '.$name.' '.$surname; ?>">
                                    <input type="hidden" name="wsb_customer_address" value="<? echo $api->address; ?>">
                                    <input type="hidden" name="wsb_return_url" value="http://prav.by/success">
                                    <input type="hidden" name="wsb_cancel_return_url" value="http://prav.by/cancel">
                                    <input type="hidden" name="wsb_notify_url" value="http://prav.by/notify.php">
                                    <input type="hidden" name="wsb_email" value="<? echo $email; ?>" >
                                    <input type="hidden" name="wsb_phone" value="<? echo $phone; ?>" >
                                    <input type="hidden" name="wsb_invoice_item_name[]" value="Пакет документов для регистрации  <?
                                    switch ($api->wsb_invoice_item_name) {
                                        case 'ooo':
                                            echo "ООО";
                                            break;
                                        case 'chup':

                                            echo "ЧУП";
                                            break;

                                    }
                                    ?>">
                                    <input type="hidden" name="wsb_invoice_item_quantity[]" value="1">
                                    <input type="hidden" name="wsb_invoice_item_price[]" value="<? echo $api->wsb_total; ?>">
                                    <input type="hidden" name="wsb_total" value="<? echo $api->wsb_total; ?>" >
                                    <input type="hidden" name="wsb_signature" value="<? echo $api->key(); //echo $api->wsb_signature;?>" >
                                    <input type="submit" value="Оплатить">
                                </form></th> 
                            <td>
                               <a href="http://prav.by">Назад</a>
                            </td>
                        </tr>
                        </tbody>
                    </table>


                    <?

                }
                else {
                echo "Ошибка модификатора доступа! Или Вы ввели не все данные формы.";
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