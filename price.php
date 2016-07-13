<?php
/*
Template Name: price
*/
include_once ("Class/WebPayAPI.php");
$api = new  WebPayAPI(0);
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

                   <?

/// Реализовать проверку пароля и доступ к безопасности

                    if (isset ($_POST ['form_id']) and isset ($_POST ['price_ooo']) and isset ($_POST ['price_chup'])) {
                        $price_ooo = $_POST ['price_ooo'];
                        $price_chup = $_POST ['price_chup'];
                        $api->setPrice($price_ooo, $price_chup);

                    }



                    ?>
            <div id="form_container">


                <form id="form_1074064" class="appnitro" method="post" action="http://prav.by/price/">

                    <ul>

                        <li id="li_1">
                            <label class="description" for="price_ooo">Цена за Регистрацию ООО </label>

                            <div>
                                <input id="element_1" name="price_ooo" required class="element text medium" type="text"
                                       maxlength="255" value="<? echo $api->price_ooo; ?>"/ >
                            </div>
                        </li>
                        <li id="li_2">
                            <label class="description" for="price_chup">Цена за Регистрацию ЧУП </label>

                            <div>
                                <input id="element_2" name="price_chup" required class="element text medium" type="text"
                                       maxlength="255" value="<? echo $api->price_chup; ?>"/>
                            </div>
                        </li>
                        <li class="buttons">
                            <input type="hidden" name="form_id" value="id544"/>
                            <input id="saveForm" class="button_text" type="submit" name="submit"
                                   value="Установить цены"/>
                        </li>
                    </ul>
                </form>
            </div>

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