/**
 *  функции для темы (WP)
 */


function isoftpedia_setup()
{

    add_theme_support('title-tag');
/**
 *  это пишется в шаблоне
 */
<title><?php bloginfo('name'); ?> |
        <?php is_home() ? bloginfo('description') : wp_title(''); ?></title> 

    /**
     *  логотип сайта и указание размера
     */

    add_theme_support('custom-logo', array(
        'height' => 270,
        'width' => 270,
        'flex-height' => true
    ));
}




/**
 *   функция подключение стилей и скриптов (стили / скрипты) везде кроме страници с id13
 */
function название_темы()
{
    if (!is_page(13)) {
        //подключаем стиль
        wp_enqueue_style('название стиля', get_template_directory_uri() . '/libs/min.css', array(), '1.0');
        //подключаем скрипт
        wp_enqueue_script('название скрипта.js', get_template_directory_uri() . '/js/main.js', array(), '1.0', true);
    }
}

add_action('wp_enqueue_scripts', 'название_темы_the_theme_scripts');

/**
 *   функция подключение стилей и скриптов (стили / скрипты) к определенной странице с шаблоном в данном случае id13
 */
function название_темы()
{
    if (is_page(13)) {
        //подключаем стиль
        wp_enqueue_style('название стиля', get_template_directory_uri() . '/libs/min.css', array(), '1.0');
        //подключаем внешние стили без https://
        wp_enqueue_style('название стилей', '//site.com/styles/built.css');
        //подключаем скрипт
        wp_enqueue_script('название скрипта.js', get_template_directory_uri() . '/js/main.js', array(), '1.0', true);
        //подключаем внешние скрипты без https://
        wp_enqueue_script('название скрипта', '//site.com/styles/built.js' );
    }
}

add_action('wp_enqueue_scripts', 'название_темы');

/**
 *   функция подключение стилей и скриптов (стили / скрипты) на все страницы
 */
function название_темы()
{
        //подключаем стиль
        wp_enqueue_style('название стиля', get_template_directory_uri() . '/libs/min.css', array(), '1.0');
        //подключаем скрипт
        wp_enqueue_script('название скрипта.js', get_template_directory_uri() . '/js/main.js', array(), '1.0', true);
}

add_action('wp_print_styles', 'название_темы');



/**
 *   убираем контейнер меню
 */
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args');
function my_wp_nav_menu_args($args = '')
{
    $args['container'] = false;
    return $args;
}


/**
 *   функция тега more... превью записи на главной
 */

add_filter('excerpt_more', function ($more) {
    return '';

});






/**
 ** перевод ярлыков с кирилицы на латиницу транслитом - для урлов
 ** так же экспорт файли тоже переводит (медиа или записи)
 **/

function ctl_sanitize_title($title)
{
    global $wpdb;

    $iso9_table = array(
        'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Ѓ' => 'G',
        'Ґ' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'YO', 'Є' => 'YE',
        'Ж' => 'ZH', 'З' => 'Z', 'Ѕ' => 'Z', 'И' => 'I', 'Й' => 'J',
        'Ј' => 'J', 'І' => 'I', 'Ї' => 'YI', 'К' => 'K', 'Ќ' => 'K',
        'Л' => 'L', 'Љ' => 'L', 'М' => 'M', 'Н' => 'N', 'Њ' => 'N',
        'О' => 'O', 'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T',
        'У' => 'U', 'Ў' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'TS',
        'Ч' => 'CH', 'Џ' => 'DH', 'Ш' => 'SH', 'Щ' => 'SHH', 'Ъ' => '',
        'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'YU', 'Я' => 'YA',
        'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'ѓ' => 'g',
        'ґ' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'є' => 'ye',
        'ж' => 'zh', 'з' => 'z', 'ѕ' => 'z', 'и' => 'i', 'й' => 'j',
        'ј' => 'j', 'і' => 'i', 'ї' => 'yi', 'к' => 'k', 'ќ' => 'k',
        'л' => 'l', 'љ' => 'l', 'м' => 'm', 'н' => 'n', 'њ' => 'n',
        'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't',
        'у' => 'u', 'ў' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'ts',
        'ч' => 'ch', 'џ' => 'dh', 'ш' => 'sh', 'щ' => 'shh', 'ъ' => '',
        'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu', 'я' => 'ya'
    );

    $locale = get_locale();
    switch ($locale) {
        case 'bg_BG':
            $iso9_table['Щ'] = 'SHT';
            $iso9_table['щ'] = 'sht';
            $iso9_table['Ъ'] = 'A';
            $iso9_table['ъ'] = 'a';
            break;
        case 'uk':
            $iso9_table['И'] = 'Y';
            $iso9_table['и'] = 'y';
            break;
    }

    $is_term = false;
    $backtrace = debug_backtrace();
    foreach ($backtrace as $backtrace_entry) {
        if ($backtrace_entry['function'] == 'wp_insert_term') {
            $is_term = true;
            break;
        }
    }

    $term = $is_term ? $wpdb->get_var("SELECT slug FROM {$wpdb->terms} WHERE name = '$title'") : '';

    if (empty($term)) {
        $title = strtr($title, apply_filters('ctl_table', $iso9_table));
        $title = preg_replace("/[^A-Za-z0-9`'_\-\.]/", '-', $title);
    } else {
        $title = $term;
    }

    return strtolower($title);
}

add_filter('sanitize_title', 'ctl_sanitize_title', 9);
add_filter('sanitize_file_name', 'ctl_sanitize_title');

/**
 **** функции которые относятся к выводу постов на главной и странице рубрик
 **/

// вывод превью текста поста - его размеры - текст поста на главной
function new_excerpt_length($length)
{
    return 25; // количество слов для вывода в превью
}

// вывод трех точек после превью текста поста на главной
add_filter('excerpt_length', 'new_excerpt_length');
add_filter('excerpt_more', function ($more) {
    return '...'; // поле где пишутся точки или то что нужно после текста превью поста на главной
});
//// вывод кнопки - ссылки на читать далее
add_filter('excerpt_more', 'new_excerpt_more');
function new_excerpt_more($more)
{
	global $post;
	return '<a href="' . get_permalink($post->ID) . '" class="permalink"> Читать дальше...</a>';
}


// изминения миниатюры для превью поста на главной
if (function_exists('add_theme_support')) {
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(150, 150); // размер миниатюры поста по умолчанию
}

if (function_exists('add_image_size')) {
    add_image_size('category-thumb', 300, 9999); // 300 в ширину и без ограничения в высоту
    add_image_size('homepage-thumb', 450, 450, true); // Кадрирование изображения
    add_image_size('custom-size', 450, 400, array('center', 'center'));
//	Х_позиция может быть: 'left' 'center' или 'right'.
//	Y_позиция может быть: 'top', 'center' или 'bottom'.
}

// регистрация - объявление своего размера в админке при обрезке на пост
add_filter('image_size_names_choose', 'my_custom_sizes');

function my_custom_sizes($sizes)
{
    return array_merge($sizes, array(
        'custom-size' => 'Размер для поста',
    ));
}

// Exclude pages from WordPress Search
if (!is_admin()) {
    function wpb_search_filter($query)
    {
        if ($query->is_search) {
            $query->set('post_type', 'post');
        }
        return $query;
    }

    add_filter('pre_get_posts', 'wpb_search_filter');
}

// удаляет тег 'span' в плагине Contact Form 7
add_filter('wpcf7_form_elements', function ($content) {
    $content = preg_replace('/<(span).*?class="\s*(?:.*\s)?wpcf7-form-control-wrap(?:\s[^"]+)?\s*"[^\>]*>(.*)<\/\1>/i', '\2', $content);

    return $content;
});

// удаляет тег 'p' в плагине Contact Form 7
 define( 'WPCF7_AUTOP', false );


// ограничение на загрузку файлов - установка размера

add_filter('upload_size_limit', 'PBP_increase_upload');
function PBP_increase_upload($bytes)
{
    return 90048576; // 1 megabyte
}

// колличество дней на запоминание пароля на защищенные посты и страницы
function true_change_pass_exp($exp)
{
    return time() + 1 * DAY_IN_SECONDS; // 5 дней к примеру
}

add_filter('post_password_expires', 'true_change_pass_exp', 10, 1);


// изменение формы ввода пароля на страницах сайта
function true_new_post_pass_form()
{
    /*
     * в принципе тут нужно обратить внимание на три вещи:
     * 1) куда ссылается форма, а также method=post
     * 2) значение атрибута name поля для ввода - post_password
     * 3) атрибуты size и maxlength поля для ввода должны быть меньше или равны 20 (про длину пароля я писал выше)
     * Во всём остальном у вас полная свобода действий!
     */
    return '<form action="' . esc_url(site_url('wp-login.php?action=postpass', 'login_post')) . '" method="post">
    <p>Данная запись защищена паролем, если у вас нет пароля обратитесь к администратору.</p>
    <p>
	<label for="pwbox-374">
	<input class="input_password_post" name="post_password" type="password" size="20" placeholder="Пароль к записи" maxlength="20" />
	</label>
	<input class="button_password_post" type="submit" name="Submit" value="Разблокировать" />
	</p>
	</form>';
}

add_filter('the_password_form', 'true_new_post_pass_form'); // вешаем функцию на фильтр the_password_form


//цытата запароленной записи - вывод
function true_protected_excerpt_text($excerpt)
{
    if (post_password_required())
        $excerpt = '<em>[Запись заблокирована. Перейдите к прочтению записи для ввода пароля или обратитесь к администратору.]</em>';
    return $excerpt; // если запись не защищена, будет выводиться стандартная цитата
}

add_filter('the_excerpt', 'true_protected_excerpt_text');

/*
 * Небольшая модификация для SQL запроса, получающего посты что бы работало скрытие постов описаное ниже
 */
function true_exclude_pass_posts($where)
{
    global $wpdb;
    return $where .= " AND {$wpdb->posts}.post_password = '' ";
}

/*
 * При помощи этого фильтра определим, на каких именно страницах будет скрывать защищенные посты
 * скрытие запароленных постов на страницах и тд.
 */
function true_where_to_exclude($query)
{
    if (is_front_page()) { // например на главной странице
        add_filter('posts_where', 'true_exclude_pass_posts');
    }
}
     
add_action('pre_get_posts', 'true_where_to_exclude');

      
// чистим от br (удаляем тег </br>)
remove_filter('the_content', 'wpautop');// для контента
//remove_filter( 'the_excerpt', 'wpautop' );// для анонсов
//remove_filter( 'comment_text', 'wpautop' );// для комментарий

/**
 **  регистрация сайт бара в шаблоне
 **/
add_action('widgets_init', 'название_темы_widgets_init');
function название_темы_widgets_init()
{
    register_sidebar(array(
        'name' => __('название сайт бара в админке', 'название_темы'),
        'id' => 'sidebar-1',
        'description' => __('Виджеты в этой области будут показаны на
         всех постах и ​​страницах.', 'название_темы'),
        'class' => 'widget__sidebar', //клас присвоенный виджету
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h2 class="widget__title">',
        'after_title' => '</h2>',
    ));
}
// так подключается данный виджет где угодно в шаблоне страницы
<?php dynamic_sidebar( 'sidebar-1' ); ?>










































