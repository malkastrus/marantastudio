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
