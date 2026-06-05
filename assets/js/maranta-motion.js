(function () {
	'use strict';

	// Marca que el JS cargó: los estados iniciales ocultos solo aplican con esta clase,
	// así si el JS falla, todo se ve igual (sin contenido invisible).
	document.documentElement.classList.add('mrt-on');

	function ready(fn) {
		if (document.readyState !== 'loading') {
			fn();
		} else {
			document.addEventListener('DOMContentLoaded', fn);
		}
	}

	ready(function () {
		var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

		/* ---------------- Sliders (Swiper) ----------------
		   Convierte cualquier contenedor .mrt-slider en un slider:
		   sus bloques hijos directos se vuelven slides.
		   Clases opcionales: mrt-per-2 / mrt-per-3 / mrt-per-4 (slides visibles en desktop),
		   mrt-autoplay, mrt-loop, mrt-fraction (paginación 1/4), mrt-marquee (cinta continua para logos).
		*/
		document.querySelectorAll('.mrt-slider').forEach(function (el) {
			if (el.dataset.mrtReady) {
				return;
			}
			el.dataset.mrtReady = '1';

			// Host real de las slides: si el bloque envuelve todo en un único contenedor
			// interno (algunos temas lo hacen), bajamos a ese contenedor.
			var host = el;
			if (host.children.length === 1 && host.children[0].children.length > 1) {
				host = host.children[0];
			}

			var children = Array.prototype.slice.call(host.children);
			if (children.length < 2) {
				return;
			}

			var wrapper = document.createElement('div');
			wrapper.className = 'swiper-wrapper';
			children.forEach(function (child) {
				var slide = document.createElement('div');
				slide.className = 'swiper-slide';
				slide.appendChild(child);
				wrapper.appendChild(slide);
			});
			host.appendChild(wrapper);
			host.classList.add('swiper');

			var marquee = el.classList.contains('mrt-marquee');

			var pag = null;
			if (!marquee) {
				pag = document.createElement('div');
				pag.className = 'swiper-pagination';
				host.appendChild(pag);
			}

			var per = 1;
			if (el.classList.contains('mrt-per-2')) {
				per = 2;
			}
			if (el.classList.contains('mrt-per-3')) {
				per = 3;
			}
			if (el.classList.contains('mrt-per-4')) {
				per = 4;
			}

			if (!window.Swiper) {
				return;
			}

			new window.Swiper(host, {
				allowTouchMove: !marquee,
				autoplay: marquee || el.classList.contains('mrt-autoplay')
					? { delay: marquee ? 0 : 4500, disableOnInteraction: false }
					: false,
				breakpoints: marquee ? {} : { 768: { slidesPerView: per } },
				freeMode: marquee ? { enabled: true, momentum: false } : false,
				grabCursor: !marquee,
				loop: marquee || el.classList.contains('mrt-loop'),
				pagination: pag
					? { el: pag, clickable: true, type: el.classList.contains('mrt-fraction') ? 'fraction' : 'bullets' }
					: false,
				slidesPerView: marquee ? 'auto' : 1,
				spaceBetween: marquee ? 40 : 24,
				speed: marquee ? 4000 : 600
			});
		});

		// Si el usuario pidió menos movimiento o no hay GSAP, dejamos todo visible.
		if (reduce || !window.gsap || !window.ScrollTrigger) {
			return;
		}
		window.gsap.registerPlugin(window.ScrollTrigger);

		/* ---------------- Reveal individual ----------------
		   Añade a un bloque: mrt-up (sube), mrt-fade (aparece) o mrt-scale (crece).
		*/
		document.querySelectorAll('.mrt-up, .mrt-fade, .mrt-scale').forEach(function (el) {
			var vars = {
				duration: 0.8,
				ease: 'power3.out',
				opacity: 1,
				scrollTrigger: { trigger: el, start: 'top 85%', once: true }
			};
			if (el.classList.contains('mrt-up')) {
				vars.y = 0;
			}
			if (el.classList.contains('mrt-scale')) {
				vars.scale = 1;
			}
			window.gsap.to(el, vars);
		});

		/* ---------------- Reveal en cascada ----------------
		   Añade mrt-stagger al contenedor (Grupo/Columnas): sus hijos aparecen en secuencia.
		*/
		document.querySelectorAll('.mrt-stagger').forEach(function (group) {
			window.gsap.to(group.children, {
				duration: 0.7,
				ease: 'power3.out',
				opacity: 1,
				scrollTrigger: { trigger: group, start: 'top 80%', once: true },
				stagger: 0.12,
				y: 0
			});
		});
	});
})();
