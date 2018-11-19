<?
	/* http://keith-wood.name/countdown.html */
	/*   
		Theme Name: 
		Author:
		Version: 1.0
	*/
	
	/* screenshot.png */
	
	/*	
		Autoptimize
		Advanced Code Editor
		Advanced Custom Fields Pro
		TinyMCE Advanced
		Category Order and Taxonomy Terms Order
		Post Types Order
		Contact Form 7
		Cyr to Lat enhanced
		EWWW Image Optimizer
		WP Smush
		Compress JPEG & PNG images
		iThemes Security Pro
		Yoast SEO Premium
		Toolset Types
		
		Easy WP SMTP
		qTranslate X
		ACF qTranslate
	*/
?>
<?
	/*
		jQuery(document).ready(function($) {
				
				
		});
	*/
?>
<? //functions.php ?>
<?//wp-pass: lHHyyOD4bLBFixMgZqwH/vladkukshkin@rambler.ru D#9*e9zd&k@9 ?>
<? get_header(); ?>
<? get_footer(); ?>
<? wp_head(); ?>
<? wp_footer(); ?>
<?php bloginfo('template_url') ?>/
<?php bloginfo('stylesheet_url') ?>
<?php bloginfo('name'); wp_title(); ?>
<?php echo get_home_url(); ?>
<? is_front_page() ?>
<? is_singular('') ?>
<? is_tax('') ?>
<? is_page() ?>
<? echo get_term_link() ?>
<? echo get_page_link() ?>
<? echo get_category_link() ?>
<?php echo do_shortcode(''); ?>
<? $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
<? /*taxonomy-goods-cat-aktsii.php*/ ?>
<?php /* Template Name: */ ?>

<? $query = new WP_Query(array('post_type' => 'slider','p' => '80')); ?>
<? $query = new WP_Query(array('post_type' => 'kaminy','items' => 'katalog','posts_per_page' => 8)); ?>
<? $query = new WP_Query(array('page_id' => )); ?>
<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>

<?php endwhile; ?>
<!-- post navigation -->
<?php else: ?>
<!-- no posts found -->
<?php endif; ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<?php endwhile; ?>
<!-- post navigation -->
<?php else: ?>
<!-- no posts found -->
<?php endif; ?>

<? $field = get_field(''); ?> 
<? if(!empty($field)): ?>
	
<? endif; ?>

<? $field = get_sub_field(''); ?> 
<? if(!empty($field)): ?>
	
<? endif; ?>

<? $img = get_field(''); ?> 
<? if(!empty($img['url'])): ?>
	
<? endif; ?>

<? $img = get_sub_field(''); ?> 
<? if(!empty($img['url'])): ?>
	
<? endif; ?>

<? if(get_field('')): ?>
	<? while(has_sub_field('')): ?>
	<? endwhile; ?>
<? endif; ?>

<? $url = get_sub_field(''); if(!empty($url)){ echo $url; } ?>
<? $url = get_field(''); if(!empty($url)){ echo $url; } ?>


<? $i = 1; ?>
<? if(($i%3) == 0): ?>
	<div class="clearfix visible-lg visible-md"></div>
<? endif; ?>
<? if(($i%2) == 0): ?>
	<div class="clearfix visible-sm"></div>
<? endif; ?>
<? $i++; ?>

<? $gallery = get_field('main_slider'); ?>
<? foreach($gallery as $img): ?>
	<? if(!empty($img['url'])): ?>
	<? endif; ?>
<? endforeach; ?>

<? $check = get_field('block_one_off'); ?>
<? if(empty($check[0])): ?>
<? endif; ?>

<?php echo do_shortcode(''); ?>

<?
	add_theme_support('post-thumbnails');

	register_nav_menus( array(
		'menu' => 'Menu',
	) );
	
	function menu_mass($name){
	
		$menu_name = $name; 

		if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
			$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );

			$menu_items = wp_get_nav_menu_items($menu->term_id);
			
			$menu = array();
			$count = 0;
			$count_sub = 0;
			foreach($menu_items as $item):
				if($item->menu_item_parent == 0):
					$menu[$count]['title'] =  $item->title;
					$menu[$count]['url'] = $item->url;
				endif;
				foreach($menu_items as $item_sub):
					if($item_sub->menu_item_parent == $item->db_id):
					$menu[$count]['sub'][$count_sub]['title'] = $item_sub->title;
						$menu[$count]['sub'][$count_sub]['url'] = $item_sub->url;
						$count_sub++;
					endif;
				endforeach;
				$count++;
			endforeach;
		}
		return $menu;
	}
	
	function wp_corenavi(){
		global $wp_query, $wp_rewrite;
		$pages = '';
		$max = $wp_query->max_num_pages;
		if (!$current = get_query_var('paged')) $current = 1;
		$a['base'] = str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999)));
		$a['total'] = $max;
		$a['current'] = $current;

		$total = 0; //1 - выводить текст "—траница N из N", 0 - не выводить
		$a['mid_size'] = 2; //сколько ссылок показывать слева и справа от текущей
		$a['end_size'] = 1; //сколько ссылок показывать в начале и в конце
		$a['prev_text'] = '&laquo;'; //текст ссылки "ѕредыдуща¤ страница"
		$a['next_text'] = '&raquo;'; //текст ссылки "—ледующа¤ страница"

		if ($max > 1) echo '<div class="pager">';
		if ($total == 1 && $max > 1) $pages = '<span class="pages">—траница ' . $current . ' из ' . $max . '</span>'."\r\n";
		echo $pages . paginate_links($a);
		if ($max > 1) echo '</div>';
	}
	
?>

<? $menu = menu_mass('menu'); ?>
<? foreach($menu as $item): ?>
	<li><a href="<? echo $item['url'] ?>"><? echo $item['title'] ?></a></li>
<? endforeach; ?>

<? $menu = menu_mass('menu'); ?>
<? foreach($menu as $item): ?>
	<li><a href="<? echo $item['url'] ?>" <? if(!empty($item['sub'])){ echo "class='down'"; } ?>><? echo $item['title'] ?></a>
		<? if(!empty($item['sub'])): ?>
			<ul class="sub-menu">
				<? foreach($item['sub'] as $item): ?>
					<li><a href="<? echo $item['url'] ?>"><? echo $item['title'] ?></a></li>
				<? endforeach; ?>
			</ul>
		<? endif; ?>
	</li>
<? endforeach; ?>


<?
	function go_filter(){
			
		 $args = array(); 
		 $args['meta_query'] = array('relation' => 'AND'); 
		 global $wp_query; 
		 if(!empty($_GET['size'])): 
		 
			$args['meta_query'][] = array( 
				'key' => 'tovarsize', 
				'value' => $_GET['size'], 
				'compare' => 'LIKE'
			);
									
		 endif; 
		 if(!empty($_GET['material'])): 
			
				$args['meta_query'][] = array( 
					'key' => 'tovarmaterial', 
					'value' => $_GET['material'], 
					'compare' => 'LIKE'
				);
				
		 endif; 
	  	 if(!empty($_GET['cat'])): 
			
				$args['meta_query'][] = array( 
					'key' => 'tovarcat', 
					'value' => $_GET['cat'], 
					'compare' => 'LIKE'
				);
				
		 endif;
		 if(!empty($_GET['country'])): 
			
				$args['meta_query'][] = array( 
					'key' => 'tovarcountry', 
					'value' => $_GET['country'], 
				  	'compare' => 'LIKE'
				);								
			
		 endif; 
		 if(!empty($_GET['season'])): 
			
				$args['meta_query'][] = array( 
					'key' => 'tovarseason', 
					'value' => $_GET['season'],
				  	'compare' => 'LIKE'
				);								
			
		 endif; 
		 if(!empty($_GET['price_s']) && !empty($_GET['price_s'])): 
			
				if(empty($_GET['price_s'])){$_GET['price_s'] = 0;}
				if(empty($_GET['price_f'])){$_GET['price_f'] = 9999999;}
				$args['meta_query'][] = array( 
					'key' => 'tovarprice', 
					'value' => array( (int)$_GET['price_s'], (int)$_GET['price_f'] ),
					'type' => 'numeric', 
					'compare' => 'BETWEEN' 
				);								
			
		 endif; 
		  
		query_posts(array_merge($args,$wp_query->query));
	}
?>
<? go_filter(); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

/*
{"settings":{"toolbar_1":"formatselect,bold,italic,blockquote,bullist,numlist,alignleft,aligncenter,alignright,link,unlink,undo,redo","toolbar_2":"fontselect,fontsizeselect,outdent,indent,pastetext,removeformat,visualchars,charmap,wp_more,forecolor,table,wp_help","toolbar_3":"underline,strikethrough,copy,paste,hr,print,searchreplace,anchor,visualblocks,fullscreen,nonbreaking,rtl,ltr,emoticons,wp_page,tadv_mark","toolbar_4":"alignjustify,styleselect,cut,superscript,subscript,image,wp_code,media,code,insertdatetime,backcolor","options":"menubar,advlist","plugins":"anchor,visualchars,visualblocks,nonbreaking,emoticons,insertdatetime,table,print,searchreplace,code,advlist"},"admin_settings":{"options":"no_autop","disabled_editors":""}}
*/
