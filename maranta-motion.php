<?php
/**
 * Plugin Name: Maranta Motion
 * Description: Animaciones tipo estudio creativo para Gutenberg (Swiper + GSAP/ScrollTrigger) aplicadas por clases CSS. Mejora progresiva, sin page builder.
 * Version: 1.0.0
 * Author: Maranta
 * License: GPL-2.0-or-later
 * Text Domain: maranta-motion
 */

if (!defined('ABSPATH')) {
	exit;
}

add_action(
	'wp_enqueue_scripts',
	function (): void {
		$version = '1.0.0';

		// Swiper (MIT) bundle with all modules.
		wp_enqueue_style(
			'maranta-motion-swiper',
			'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css',
			array(),
			'11'
		);

		wp_enqueue_script(
			'maranta-motion-swiper',
			'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js',
			array(),
			'11',
			true
		);

		// GSAP + ScrollTrigger.
		wp_enqueue_script(
			'maranta-motion-gsap',
			'https://cdn.jsdelivr.net/npm/gsap@3.12.7/dist/gsap.min.js',
			array(),
			'3.12.7',
			true
		);

		wp_enqueue_script(
			'maranta-motion-scrolltrigger',
			'https://cdn.jsdelivr.net/npm/gsap@3.12.7/dist/ScrollTrigger.min.js',
			array('maranta-motion-gsap'),
			'3.12.7',
			true
		);

		wp_enqueue_style(
			'maranta-motion',
			plugins_url('assets/css/maranta-motion.css', __FILE__),
			array('maranta-motion-swiper'),
			$version
		);

		wp_enqueue_script(
			'maranta-motion',
			plugins_url('assets/js/maranta-motion.js', __FILE__),
			array('maranta-motion-swiper', 'maranta-motion-gsap', 'maranta-motion-scrolltrigger'),
			$version,
			true
		);
	}
);

add_action(
	'init',
	function (): void {
		if (!function_exists('register_block_pattern')) {
			return;
		}

		register_block_pattern_category(
			'maranta-motion',
			array('label' => __('Maranta Motion', 'maranta-motion'))
		);

		register_block_pattern(
			'maranta-motion/home-studio',
			array(
				'title' => __('Maranta Studio - Inicio', 'maranta-motion'),
				'categories' => array('maranta-motion'),
				'content' => <<<'HTML'
<!-- wp:group {"className":"mrt-home","layout":{"type":"constrained"}} -->
<div class="wp-block-group mrt-home"><!-- wp:group {"className":"mrt-hero mrt-up","layout":{"type":"constrained"}} -->
<div class="wp-block-group mrt-hero"><!-- wp:paragraph {"className":"mrt-kicker"} -->
<p class="mrt-kicker">Estudio creativo digital</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":1} -->
<h1 class="wp-block-heading">Maranta Studio</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"mrt-lead"} -->
<p class="mrt-lead">Diseñamos presencia digital clara, elegante y viva para marcas que quieren sentirse memorables desde el primer vistazo.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"className":"mrt-btn mrt-btn-arrow"} -->
<div class="wp-block-button mrt-btn mrt-btn-arrow"><a class="wp-block-button__link wp-element-button">Empezar proyecto</a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-outline mrt-btn-ghost mrt-btn-arrow"} -->
<div class="wp-block-button is-style-outline mrt-btn-ghost mrt-btn-arrow"><a class="wp-block-button__link wp-element-button">Ver servicios</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"mrt-section mrt-stagger","layout":{"type":"constrained"}} -->
<div class="wp-block-group mrt-section mrt-stagger"><!-- wp:heading -->
<h2 class="wp-block-heading">Lo que hacemos</h2>
<!-- /wp:heading -->

<!-- wp:columns {"className":"mrt-cards"} -->
<div class="wp-block-columns mrt-cards"><!-- wp:column {"className":"mrt-card"} -->
<div class="wp-block-column mrt-card"><!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Websites</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Páginas limpias, responsive y fáciles de gestionar en WordPress.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"className":"mrt-card"} -->
<div class="wp-block-column mrt-card"><!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Identidad</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Sistemas visuales con dirección, tono y consistencia para crecer.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"className":"mrt-card"} -->
<div class="wp-block-column mrt-card"><!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Movimiento</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Animaciones sutiles que dan ritmo sin sacrificar claridad.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"mrt-section mrt-feature mrt-scale","layout":{"type":"constrained"}} -->
<div class="wp-block-group mrt-section mrt-feature"><!-- wp:heading -->
<h2 class="wp-block-heading">Una web que se siente hecha para tu marca</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Partimos de una estructura clara: mensaje, experiencia, secciones y llamados a la acción. Luego sumamos detalle visual y movimiento para que cada bloque tenga intención.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"mrt-section mrt-cta mrt-fade","layout":{"type":"constrained"}} -->
<div class="wp-block-group mrt-section mrt-cta"><!-- wp:heading -->
<h2 class="wp-block-heading">Construyamos la primera versión</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Este bloque puede convertirse en el cierre de la home, una invitación a contacto o el inicio de una propuesta comercial.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"className":"mrt-btn mrt-btn-arrow"} -->
<div class="wp-block-button mrt-btn mrt-btn-arrow"><a class="wp-block-button__link wp-element-button">Contactar</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
HTML,
			)
		);
	}
);

add_shortcode(
	'maranta_home',
	function (): string {
		return <<<'HTML'
<section class="mrt-home">
	<div class="mrt-hero mrt-up">
		<p class="mrt-kicker">Estudio creativo digital</p>
		<h1>Maranta Studio</h1>
		<p class="mrt-lead">Disenamos presencia digital clara, elegante y viva para marcas que quieren sentirse memorables desde el primer vistazo.</p>
		<div class="wp-block-buttons">
			<div class="wp-block-button mrt-btn mrt-btn-arrow"><a class="wp-block-button__link wp-element-button" href="#contacto">Empezar proyecto</a></div>
			<div class="wp-block-button mrt-btn-ghost mrt-btn-arrow"><a class="wp-block-button__link wp-element-button" href="#servicios">Ver servicios</a></div>
		</div>
	</div>

	<div id="servicios" class="mrt-section mrt-stagger">
		<h2>Lo que hacemos</h2>
		<div class="mrt-shortcode-cards">
			<article class="mrt-card">
				<h3>Websites</h3>
				<p>Paginas limpias, responsive y faciles de gestionar en WordPress.</p>
			</article>
			<article class="mrt-card">
				<h3>Identidad</h3>
				<p>Sistemas visuales con direccion, tono y consistencia para crecer.</p>
			</article>
			<article class="mrt-card">
				<h3>Movimiento</h3>
				<p>Animaciones sutiles que dan ritmo sin sacrificar claridad.</p>
			</article>
		</div>
	</div>

	<div class="mrt-section mrt-feature mrt-reveal">
		<h2>Una web que se siente hecha para tu marca</h2>
		<p>Partimos de una estructura clara: mensaje, experiencia, secciones y llamados a la accion. Luego sumamos detalle visual y movimiento para que cada bloque tenga intencion.</p>
	</div>

	<div id="contacto" class="mrt-section mrt-cta mrt-fade">
		<h2>Construyamos la primera version</h2>
		<p>Este bloque puede convertirse en el cierre de la home, una invitacion a contacto o el inicio de una propuesta comercial.</p>
		<div class="wp-block-buttons">
			<div class="wp-block-button mrt-btn mrt-btn-arrow"><a class="wp-block-button__link wp-element-button" href="mailto:hola@example.com">Contactar</a></div>
		</div>
	</div>
</section>
HTML;
	}
);
