<?php

$conn = new PDO("mysql:host=localhost; dbname=opencart_dt; charset=utf8", 'root', '');

function move_option_to_opencart($conn){
    #oc_option
    #wzor
    $conn->query("INSERT INTO opencart_dt.`oc_option`(`option_id`, `type`, `sort_order`) VALUES (14, 'radio', 0) ");
    #kolor
    $conn->query("INSERT INTO opencart_dt.`oc_option`(`option_id`, `type`, `sort_order`) VALUES (15, 'radio', 0) ");
    #rozmiar
    $conn->query("INSERT INTO opencart_dt.`oc_option`(`option_id`, `type`, `sort_order`) VALUES (16, 'radio', 0) ");
    #material
    $conn->query("INSERT INTO opencart_dt.`oc_option`(`option_id`, `type`, `sort_order`) VALUES (17, 'radio', 0) ");
    #kolorpileczek
    $conn->query("INSERT INTO opencart_dt.`oc_option`(`option_id`, `type`, `sort_order`) VALUES (18, 'radio', 0)
    ");


    #oc_option_desctription
    $sorted_variants = $conn->query("SELECT * FROM disc.`warianty` ");

    $option_value_id_iteration = 55;
    while(false !== ($one_sorted_var = $sorted_variants->fetch())){
        switch($one_sorted_var['key0']){
            case $one_sorted_var['key0'] == 'wzór':
                insert_option_values($conn, 14, $one_sorted_var, $option_value_id_iteration);
            break;
            case $one_sorted_var['key0'] == 'kolor' :
                insert_option_values($conn, 15, $one_sorted_var, $option_value_id_iteration);
            break;
            case $one_sorted_var['key0'] == 'rozmiar kołderki':
                insert_option_values($conn, 16, $one_sorted_var, $option_value_id_iteration);
            break;
            case $one_sorted_var['key0'] == 'materiał':
                insert_option_values($conn, 17, $one_sorted_var, $option_value_id_iteration);
            break;
            case $one_sorted_var['key0'] == 'kolor piłeczek':
                insert_option_values($conn, 18, $one_sorted_var, $option_value_id_iteration);
            break;
            default:
                echo "<br />Bład w dodaniu opisu opcji (opis wariantu)<br />";  
        }
        $option_value_id_iteration++; 
    }
}


function insert_option_values($conn, $option_id, $sorted_value, $iteration_value){
    /*
    $conn->query("INSERT INTO opencart_dt.`oc_option_description`(`option_id`, `language_id`, `name`) 
    VALUES (".$option_id.", ".$sorted_value['lang'].", '".$sorted_value['key']."' ) ");
    */
    $conn->query("INSERT INTO opencart_dt.`oc_option_value`(`option_value_id`, `option_id`, `image`, `sort_order`) 
    VALUES (".$iteration_value.", ".$option_id.", '', 0) ");
    #oc_option_value_description
    $conn->query("INSERT INTO opencart_dt.`oc_option_value_description`(`option_value_id`, `language_id`, `option_id`, `name`) 
    VALUES (".$iteration_value.", 0, ".$option_id.", '".$sorted_value['value0']."') ");
    $conn->query("INSERT INTO opencart_dt.`oc_option_value_description`(`option_value_id`, `language_id`, `option_id`, `name`) 
    VALUES (".$iteration_value.", 1, ".$option_id.", '".$sorted_value['value1']."') ");
    $conn->query("INSERT INTO opencart_dt.`oc_option_value_description`(`option_value_id`, `language_id`, `option_id`, `name`) 
    VALUES (".$iteration_value.", 2, ".$option_id.", '".$sorted_value['value2']."') ");
    $conn->query("INSERT INTO opencart_dt.`oc_option_value_description`(`option_value_id`, `language_id`, `option_id`, `name`) 
    VALUES (".$iteration_value.", 3, ".$option_id.", '".$sorted_value['value3']."') ");
    $conn->query("INSERT INTO opencart_dt.`oc_option_value_description`(`option_value_id`, `language_id`, `option_id`, `name`) 
    VALUES (".$iteration_value.", 4, ".$option_id.", '".$sorted_value['value4']."') ");
    $conn->query("INSERT INTO opencart_dt.`oc_option_value_description`(`option_value_id`, `language_id`, `option_id`, `name`) 
    VALUES (".$iteration_value.", 5, ".$option_id.", '".$sorted_value['value5']."') ");
}


function lang_to_int($conn, $lang){
    switch($lang){
        case $lang =='pl':
            return 0;
        break;
        case $lang =='en':
            return 1;
        break;
        case $lang =='de':
            return 2;
        break;
        case $lang =='es':
            return 3;
        break;
        case $lang =='it':
            return 4;
        break;
        case $lang =='fr':
            return 5;
        break;
        default:
            echo "<br />Brak podanego jezyka <br />";
    }
}

function select_category($set_id){
    $zamki_zjezdzalnie_dzieci = array(24225, 24226, 24270, 24271, 24272, 24273, 27510);
    $pufy_kanapy_dzieci = array(29524, 29450, 29460,24200, 24201, 24202,24203,24250,
                                24251,24252,24300,24301,24350,24351,24352);

    $suche_baseny = array(24050,24141,24142,24143,24144,24146,24147,24148,24149,24150,
                          24151,24152,24153,24154,24156,24157,24158,24159,24160,24161,
                          24162,24163,24170,24171,24172,24173,24174,24180,24181,24182,
                          24183,24191,2419,24193,24194,24196,24197,24198,24199);

    #INSERT INTO 
    switch($set_id){
        #tablice kids
        case ($set_id == 21850 && $set_id == 21851):
            echo "namioty i maty do zabawy 1";
            return 71;
            break;
        case in_array($set_id, $zamki_zjezdzalnie_dzieci):
            echo "zamki i zjezdzalnie dla dzieci";
            return 68;
            break;
        case in_array($set_id, $pufy_kanapy_dzieci):
            echo "pufy kanapy dzieci";
            return 74;
            break;
        case in_array($set_id, $suche_baseny):
            echo "suche baseny";
            return 69;
            break;
        #adults
        case ($set_id  >= 42000 &&  $set_id <= 42099):
            echo "poduszki ciazowe";
            return 64;
            break;
        case ($set_id  >= 42102 &&  $set_id <= 42299):
            echo "poduszki ciazowe 2";
            return 64;
            break;
        case ($set_id >= 42400 &&  $set_id <= 42499):
            echo "poduszki ciazowe 3";
            return 64;
            break;    
        case ($set_id >= 42600 && $set_id <= 42699):
            echo "poduszki dekoracyjne";
            return 65;
            break;
        case ($set_id  >= 42500 &&  $set_id <= 42599):
            echo "kołdry";
            return 67;
            break; 
        case ($set_id  >= 29500 &&  $set_id <= 29649):
            echo "sofy, pufy, beanbagi 1";
            return 66;
            break; 
        case ($set_id  >= 29800 &&  $set_id <= 29849):
            echo "sofy, pufy, beanbagi 2";
            return 66;
            break;
        case ($set_id  >= 29450 &&  $set_id <= 29499):
            echo "sofy, pufy, beanbagi 3";
            return 66;
            break;  
        case ($set_id >= 24100 &&  $set_id <= 24399):
            echo "sofy, pufy, beanbagi 4";
            return 66;
            break;   
        #kids
        case ($set_id >= 42700 &&  $set_id <= 42799):
            echo "namioty i maty do zabawy 2";
            return 71;
            break;    
        case ($set_id >= 25000 &&  $set_id <= 25499):
            echo "misie";
            return 73;
            break;
        case ($set_id  >= 27500 &&  $set_id <= 27599):
            echo "lozka i materace 1";
            return 70;
            break;
        case ($set_id  >= 24500 &&  $set_id <= 24999):
            echo "lozka i materace 2";
            return 70;
            break; 
        case ($set_id >= 27600 && $set_id <= 27699):
            echo "lozka i materace 3";
            return 70;
            break;
        case ($set_id >= 42300 && $set_id <= 42399):
            echo "kokony";
            return 75;
            break;
        case ($set_id >= 20500 && $set_id <= 23999):
            echo "posciele komplety dzieci";
            return 72;
            break;
        default:
            echo "<br /> set id nie pasuje do zadnego z przedziałów<br />";
    }
}


function set_variant($conn, $set_id){
    $set_variant = $conn->query("SELECT DISTINCT set_id, t1.key key0, t1.value value0, 
    t2.key key1, t2.value value1, t3.key key2, t3.value value2, t4.key key3, t4.value value3, 
    t5.key key4, t5.value value4, t6.key key5, t6.value value5 
    FROM disc.set_variant_lang t1 
    left join (SELECT * FROM disc.set_variant_lang where lang = 1) t2 using (set_id, variant) 
    left join (SELECT * FROM disc.set_variant_lang where lang = 2) t3 using (set_id, variant) 
    left join (SELECT * FROM disc.set_variant_lang where lang = 3) t4 using (set_id, variant) 
    left join (SELECT * FROM disc.set_variant_lang where lang = 4) t5 using (set_id, variant) 
    left join (SELECT * FROM disc.set_variant_lang where lang = 5) t6 using (set_id, variant) 
    left join disc.set_variants_withdraw using (set_id, variant) 
    where t1.lang = 0 and t1.set_id not in (SELECT set_id FROM disc.set_variant_lang group by set_id, variant, lang having count(*)>1) 
    and disc.set_variants_withdraw.set_id is null
    and `set_id` = $set_id ");

    var_dump($set_variant->fetch()['key0']);

    switch($set_variant->fetch()['key0']){
            case $set_variant->fetch()['key0'] == 'wzór':
                add_product_option_value($conn, $set_id, $set_variant, 14);
            break;
            case $set_variant->fetch()['key0'] == 'kolor' :
                add_product_option_value($conn, $set_id, $set_variant, 15);    
            break;
            case $set_variant->fetch()['key0'] == 'rozmiar kołderki':
                add_product_option_value($conn, $set_id, $set_variant, 16);
            break;
            case $set_variant->fetch()['key0'] == 'materiał':
                add_product_option_value($conn, $set_id, $set_variant, 17);
            break;
            case $set_variant->fetch()['key0'] == 'kolor piłeczek':
                add_product_option_value($conn, $set_id, $set_variant, 18);
            break;
    }  
}

#$conn, $set_id, 14, ``, 1
function add_product_option_value($conn, $set_id, $set_variant, $option_id){
    $a = $conn->query("INSERT INTO opencart_dt.`oc_product_option`(`product_option_id`, `product_id`, `option_id`, `value`, `required`) 
    VALUES (product_option_id, $set_id, $option_id, `value`, 1)" );

    $product_option_id = $conn->lastInsertId();

    while(false !== ($row_set_var = $set_variant->fetch()))
    {
        $option_value_id = $conn->query("SELECT * FROM `oc_option_value_description` where `name`='".$row_set_var['value0']."' and  option_id=$option_id  ");
        $option_value_id = $option_value_id->fetch()['option_value_id'];
        $conn->query("INSERT INTO opencart_dt.`oc_product_option_value`(`product_option_value_id`, `product_option_id`, `product_id`, `option_id`, 
        `option_value_id`, `quantity`, `subtract`, `price`, `price_prefix`, `points`, `points_prefix`, `weight`, `weight_prefix`) 
        VALUES (product_option_value_id, $product_option_id, $set_id, $option_id,
        $option_value_id, 100, 1, 0, '+', 0, '+', 0, '+') ");
    }
}

function insert_one_product($conn, $set_id){
    #oc_prod
    $conn->query("INSERT INTO opencart_dt.`oc_product`(`product_id`, `model`, `sku`, `upc`, `ean`, `jan`, `isbn`, `mpn`, `location`, `quantity`, 
                        `stock_status_id`, `image`, `manufacturer_id`, `shipping`, `price`, `points`, `tax_class_id`, `date_available`, 
                        `weight`, `weight_class_id`, `length`, `width`, `height`, `length_class_id`, `subtract`, `minimum`, 
                        `sort_order`, `status`, `viewed`, `date_added`, `date_modified`) 
                        VALUES ($set_id, `model`, '".'sku_'.$set_id."', `upc`, `ean`, `jan`, `isbn`, `mpn`, `location`, 1, 
                        6, `image`, 0, 1, 100, 0, 0, now(), 
                        0.00000000, 0, 0.00000000, 0.00000000, 0.00000000, 0, 1, 1, 
                        1, 1, 0, now(), now())");
    
    #$conn->query("INSERT INTO tmp.`tmp_tab`(`id`, `key_`, `lang`, `num`, `value`) 
    #VALUES (".$row['set_id'].", key_, lang, num, `value` )"); #oc_prod

    $title_select = $conn->query("SELECT set_id, lang, `value` FROM disc.`translations` WHERE `key`='desc_title' AND set_id=$set_id AND lang='en' ");#select title 
    #oc_prod_desc
    $conn->query("INSERT INTO opencart_dt.`oc_product_description`(`product_id`, `language_id`, `name`, `description`, `tag`, `meta_title`, `meta_description`, `meta_keyword`) 
    VALUES ($set_id,  1, '".$title_select->fetch()['value']."', 'dupa', `tag`, `meta_title`, `meta_description`, `meta_keyword`) ");
    #$conn->query("INSERT INTO tmp.`tamp2` (`prod_id`, `lang_id`, `name`, `dsca`, `meta_title`) VALUES (".$row['set_id'].",  '".$row['lang']."', '".$title_select->fetch()['value']."', '".$row['dsc']."', meta_title) ");

    #oc_prod_to_cat
    $conn->query("INSERT INTO opencart_dt.`oc_product_to_category`(`product_id`, `category_id`) 
    VALUES ($set_id, ".select_category($set_id).") "); 
    
    #oc_prod_to_lay
    $conn->query("INSERT INTO opencart_dt.`oc_product_to_layout`(`product_id`, `store_id`, `layout_id`) 
    VALUES ($set_id, 0, 0) ");
    
    #oc_proc_to_story
    $conn->query("INSERT INTO opencart_dt.`oc_product_to_store`(`product_id`, `store_id`) 
    VALUES ($set_id, 0) ");

    #oc_prod_option & oc_product_opt_value
    set_variant($conn, $set_id);
}

#insert_one_product($conn, 42000);


#wszystkie set_id
$all_set_id = $conn->query("SELECT translations.set_id, lang, GROUP_CONCAT(value order by ord SEPARATOR '\n') dsc, 
IF(t.set_id IS NULL, 0, 1) is_variant FROM disc.`translations` 
LEFT JOIN (SELECT DISTINCT set_id FROM disc.`set_variant_lang`) t USING (set_id)
WHERE `key` = 'desc_description' group by translations.`set_id`, lang");

while (false !== ($row = $all_set_id->fetch())) {
    #oc_prod
    $conn->query("INSERT INTO opencart_dt.`oc_product`(`product_id`, `model`, `sku`, `upc`, `ean`, `jan`, `isbn`, `mpn`, `location`, `quantity`, 
                            `stock_status_id`, `image`, `manufacturer_id`, `shipping`, `price`, `points`, `tax_class_id`, `date_available`, 
                            `weight`, `weight_class_id`, `length`, `width`, `height`, `length_class_id`, `subtract`, `minimum`, 
                            `sort_order`, `status`, `viewed`, `date_added`, `date_modified`) 
                            VALUES (".$row['set_id'].", `model`, '".'sku_'.$row['set_id']."', `upc`, `ean`, `jan`, `isbn`, `mpn`, `location`, 1, 
                            6, `image`, 0, 1, 100, 0, 0, now(), 
                            0.00000000, 0, 0.00000000, 0.00000000, 0.00000000, 0, 1, 1, 
                            1, 1, 0, now(), now())");


    $title_select = $conn->query("SELECT set_id, lang, `value` FROM disc.`translations` WHERE `key`='desc_title' AND set_id=".$row['set_id']." AND lang='".$row['lang']."' ");#select title 
    
    #oc_prod_desc
    $conn->query("INSERT INTO opencart_dt.`oc_product_description`(`product_id`, `language_id`, `name`, `description`, `tag`, `meta_title`, `meta_description`, `meta_keyword`) 
    VALUES (".$row['set_id'].",  ".lang_to_int($conn, $row['lang']).", '".$title_select->fetch()['value']."', '".$row['dsc']."', `tag`, `meta_title`, `meta_description`, `meta_keyword`) ");

    #oc_prod_to_cat
    $conn->query("INSERT INTO opencart_dt.`oc_product_to_category`(`product_id`, `category_id`) 
    VALUES (".$row['set_id'].", ".select_category($row['set_id']).") "); 
    
    #oc_prod_to_lay
    $conn->query("INSERT INTO opencart_dt.`oc_product_to_layout`(`product_id`, `store_id`, `layout_id`) 
    VALUES (".$row['set_id'].", 0, 0) ");
    
    #oc_proc_to_story
    $conn->query("INSERT INTO opencart_dt.`oc_product_to_store`(`product_id`, `store_id`) 
    VALUES (".$row['set_id'].", 0) ");  
}
/*
#od razu dodaje wszystkie option_value_id i wszystkie opcie do wyboru koloru itp.
#jest poza glownym while zeby nie dodawalo kilka razy(tyle ile znajdie danego set_id) opcji wyboru czy koloru 
$b= $conn->query("SELECT DISTINCT `set_id` FROM disc.`translations` ");
while (false !== ($row = $b->fetch())) {
#oc_prod_option & oc_product_opt_value
    set_variant($conn, $row['set_id']);
}
*/

?>