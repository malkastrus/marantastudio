(function () {
  // Marca que el JS cargó: los estados iniciales ocultos solo aplican con esta clase,
  // así si el JS falla, nada queda invisible.
  document.documentElement.classList.add('mrt-on');

  function ready(fn) {
    if (document.readyState !== 'loading') { fn(); }
    else { document.addEventListener('DOMContentLoaded', fn); }
  }

  ready(function () {
    var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    /* ---------------- Sliders (Swiper) ----------------
       .mrt-slider convierte sus bloques hijos en slides.
       Opcionales: mrt-per-2/3/4, mrt-autoplay, mrt-loop, mrt-fraction, mrt-marquee. */
    document.querySelectorAll('.mrt-slider').forEach(function (el) {
      if (el.dataset.mrtReady) return;
      el.dataset.mrtReady = '1';

      var host = el;
      if (host.children.length === 1 && host.children[0].children.length > 1) {
        host = host.children[0];
      }

      var children = Array.prototype.slice.call(host.children);
      if (children.length < 2) return;

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
      if (el.classList.contains('mrt-per-2')) per = 2;
      if (el.classList.contains('mrt-per-3')) per = 3;
      if (el.classList.contains('mrt-per-4')) per = 4;

      // eslint-disable-next-line no-undef
      new Swiper(host, {
        slidesPerView: marquee ? 'auto' : 1,
        spaceBetween: marquee ? 40 : 24,
        loop: marquee || el.classList.contains('mrt-loop'),
        speed: marquee ? 4000 : 600,
        grabCursor: !marquee,
        allowTouchMove: !marquee,
        freeMode: marquee ? { enabled: true, momentum: false } : false,
        autoplay: (marquee || el.classList.contains('mrt-autoplay'))
          ? { delay: marquee ? 0 : 4500, disableOnInteraction: false }
          : false,
        pagination: pag
          ? { el: pag, clickable: true, type: el.classList.contains('mrt-fraction') ? 'fraction' : 'bullets' }
          : false,
        breakpoints: marquee ? {} : { 768: { slidesPerView: per } }
      });
    });

    // Sin GSAP o con "menos movimiento": dejamos todo visible.
    if (reduce || !window.gsap) return;
    gsap.registerPlugin(ScrollTrigger);

    /* ---------------- Reveal individual: mrt-up / mrt-fade / mrt-scale ---------------- */
    document.querySelectorAll('.mrt-up, .mrt-fade, .mrt-scale').forEach(function (el) {
      var vars = {
        opacity: 1, duration: 0.8, ease: 'power3.out',
        scrollTrigger: { trigger: el, start: 'top 85%', once: true }
      };
      if (el.classList.contains('mrt-up')) vars.y = 0;
      if (el.classList.contains('mrt-scale')) vars.scale = 1;
      gsap.to(el, vars);
    });

    /* ---------------- Reveal en cascada: mrt-stagger ---------------- */
    document.querySelectorAll('.mrt-stagger').forEach(function (group) {
      gsap.to(group.children, {
        opacity: 1, y: 0, duration: 0.7, ease: 'power3.out', stagger: 0.12,
        scrollTrigger: { trigger: group, start: 'top 80%', once: true }
      });
    });

    /* ---------------- Reveal con máscara: mrt-reveal ---------------- */
    document.querySelectorAll('.mrt-reveal').forEach(function (el) {
      gsap.to(el, {
        clipPath: 'inset(0 0 0% 0)', duration: 1, ease: 'power3.out',
        scrollTrigger: { trigger: el, start: 'top 85%', once: true }
      });
    });

    /* ---------------- Parallax de fotos: mrt-parallax ---------------- */
    document.querySelectorAll('.mrt-parallax').forEach(function (box) {
      var img = box.querySelector('img');
      if (!img) return;
      gsap.set(img, { scale: 1.2, transformOrigin: 'center center' });
      gsap.fromTo(img, { yPercent: -8 }, {
        yPercent: 8, ease: 'none',
        scrollTrigger: { trigger: box, start: 'top bottom', end: 'bottom top', scrub: true }
      });
    });
  });
})();
