<?php 

	//Custom Post Type: Proyectos
	add_action( 'init', 'proyectos' );
	function proyectos() {
		register_post_type( 'proyectos',
			array(
				'labels' => array(
					'name' => __( 'Proyectos' ),
					'singular_name' => __( 'Proyecto' )
				),
			'public' => true,
			'has_archive' => false,
			'supports' => array('title'),
			'taxonomies' => array()
			)
		);
	}
