(function () {
	'use strict';

	var reduceMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

	/* ---------------------------------------------------------
	   Dark / light mode toggle
	   (initial theme is already set pre-paint by the inline
	   script in header.php — this only handles the click)
	--------------------------------------------------------- */
	var themeToggle = document.querySelector('.kt-theme-toggle');
	if (themeToggle) {
		var isLight = document.documentElement.getAttribute('data-theme') === 'light';
		themeToggle.setAttribute('aria-pressed', String(isLight));

		themeToggle.addEventListener('click', function () {
			var nowLight = document.documentElement.getAttribute('data-theme') !== 'light';
			if (nowLight) {
				document.documentElement.setAttribute('data-theme', 'light');
			} else {
				document.documentElement.removeAttribute('data-theme');
			}
			themeToggle.setAttribute('aria-pressed', String(nowLight));
			try { localStorage.setItem('kt-theme', nowLight ? 'light' : 'dark'); } catch (e) {}
			window.dispatchEvent(new Event('kt-theme-changed'));
		});
	}

	/* ---------------------------------------------------------
	   Header scroll state
	--------------------------------------------------------- */
	var header = document.querySelector('[data-scroll-header]');
	function onScroll() {
		if (!header) return;
		if (window.scrollY > 40) header.classList.add('is-scrolled');
		else header.classList.remove('is-scrolled');

		var backTop = document.querySelector('[data-back-to-top]');
		if (backTop) {
			if (window.scrollY > 500) backTop.classList.add('is-visible');
			else backTop.classList.remove('is-visible');
		}
	}
	document.addEventListener('scroll', onScroll, { passive: true });
	onScroll();

	var backToTop = document.querySelector('[data-back-to-top]');
	if (backToTop) {
		backToTop.addEventListener('click', function () {
			window.scrollTo({ top: 0, behavior: reduceMotion ? 'auto' : 'smooth' });
		});
	}

	/* ---------------------------------------------------------
	   Mobile menu toggle
	--------------------------------------------------------- */
	var toggle = document.querySelector('.kt-menu-toggle');
	var nav = document.getElementById('site-navigation');
	if (toggle && nav) {
		toggle.addEventListener('click', function () {
			var expanded = toggle.getAttribute('aria-expanded') === 'true';
			toggle.setAttribute('aria-expanded', String(!expanded));
			nav.classList.toggle('is-open');
			document.body.style.overflow = !expanded ? 'hidden' : '';
		});
		nav.addEventListener('click', function (e) {
			if (e.target.tagName === 'A') {
				toggle.setAttribute('aria-expanded', 'false');
				nav.classList.remove('is-open');
				document.body.style.overflow = '';
			}
		});
	}

	/* ---------------------------------------------------------
	   Scroll reveal (IntersectionObserver)
	--------------------------------------------------------- */
	var revealEls = document.querySelectorAll('.reveal-up');
	if ('IntersectionObserver' in window && revealEls.length) {
		var io = new IntersectionObserver(function (entries) {
			entries.forEach(function (entry) {
				if (entry.isIntersecting) {
					entry.target.classList.add('is-visible');
					io.unobserve(entry.target);
				}
			});
		}, { threshold: 0.12, rootMargin: '0px 0px -60px 0px' });
		revealEls.forEach(function (el) { io.observe(el); });
	} else {
		revealEls.forEach(function (el) { el.classList.add('is-visible'); });
	}

	/* ---------------------------------------------------------
	   FAQ Accordion
	--------------------------------------------------------- */
	document.querySelectorAll('.kt-accordion-trigger').forEach(function (btn) {
		btn.addEventListener('click', function () {
			var expanded = btn.getAttribute('aria-expanded') === 'true';
			var panel = btn.nextElementSibling;
			var item = btn.closest('.kt-accordion-item');
			var group = item ? item.parentElement : null;

			if (group) {
				group.querySelectorAll('.kt-accordion-trigger').forEach(function (other) {
					if (other !== btn) {
						other.setAttribute('aria-expanded', 'false');
						var otherPanel = other.nextElementSibling;
						if (otherPanel) otherPanel.hidden = true;
					}
				});
			}

			btn.setAttribute('aria-expanded', String(!expanded));
			if (panel) panel.hidden = expanded;
		});
	});

	/* ---------------------------------------------------------
	   File input validation (size + type), used by any input
	   with a data-max-size attribute (bytes).
	--------------------------------------------------------- */
	function wireFileValidation(form) {
		form.querySelectorAll('input[type="file"][data-max-size]').forEach(function (input) {
			input.addEventListener('change', function () {
				var field = input.closest('.kt-form-field');
				var errorEl = field ? field.querySelector('.kt-file-error') : null;
				var maxSize = parseInt(input.getAttribute('data-max-size'), 10) || 524288;
				var file = input.files && input.files[0];

				if (field) field.classList.remove('has-error');
				if (errorEl) { errorEl.hidden = true; errorEl.textContent = ''; }

				if (!file) return;

				var isPdf = file.type === 'application/pdf' || /\.pdf$/i.test(file.name);
				var tooBig = file.size > maxSize;

				if (!isPdf || tooBig) {
					var msg = !isPdf ? 'Only PDF files are accepted.' : 'File must be under ' + Math.round(maxSize / 1024) + 'KB (yours is ' + Math.round(file.size / 1024) + 'KB).';
					if (field) field.classList.add('has-error');
					if (errorEl) { errorEl.hidden = false; errorEl.textContent = msg; }
					input.value = '';
				}
			});
		});
	}

	/* ---------------------------------------------------------
	   Generalized AJAX form submit — used by the contact form
	   and every job-application form (data-ajax-action + kt-ajax-form)
	--------------------------------------------------------- */
	function wireAjaxForm(form) {
		wireFileValidation(form);

		if (typeof window.ktData === 'undefined') return;

		form.addEventListener('submit', function (e) {
			e.preventDefault();

			var action = form.getAttribute('data-ajax-action');
			if (!action) return;

			var statusEl = form.querySelector('.kt-form-status');
			var submitBtn = form.querySelector('.kt-form-submit');
			var btnText = submitBtn ? submitBtn.querySelector('.kt-btn-text') : null;
			var spinner = submitBtn ? submitBtn.querySelector('.kt-btn-spinner') : null;
			var defaultLabel = btnText ? btnText.textContent : '';

			if (statusEl) { statusEl.textContent = ''; statusEl.className = 'kt-form-status'; }
			if (submitBtn) submitBtn.disabled = true;
			if (btnText) btnText.textContent = 'Sending…';
			if (spinner) spinner.hidden = false;

			var formData = new FormData(form);
			formData.append('action', action);
			formData.append('nonce', window.ktData.nonce);

			fetch(window.ktData.ajaxUrl, { method: 'POST', body: formData, credentials: 'same-origin' })
				.then(function (res) { return res.json(); })
				.then(function (data) {
					if (data && data.success) {
						if (statusEl) { statusEl.textContent = data.data.message || 'Thanks! Your submission has been received.'; statusEl.classList.add('is-success'); }
						form.reset();
					} else {
						if (statusEl) { statusEl.textContent = (data && data.data && data.data.message) || 'Something went wrong. Please try again.'; statusEl.classList.add('is-error'); }
					}
				})
				.catch(function () {
					if (statusEl) { statusEl.textContent = 'Network error — please check your connection and try again.'; statusEl.classList.add('is-error'); }
				})
				.finally(function () {
					if (submitBtn) submitBtn.disabled = false;
					if (btnText) btnText.textContent = defaultLabel || 'Submit';
					if (spinner) spinner.hidden = true;
				});
		});
	}

	document.querySelectorAll('.kt-ajax-form').forEach(wireAjaxForm);

	/* ---------------------------------------------------------
	   Careers: toggle inline "Apply Now" forms
	--------------------------------------------------------- */
	document.querySelectorAll('.kt-apply-toggle').forEach(function (btn) {
		btn.addEventListener('click', function () {
			var targetId = btn.getAttribute('data-target');
			var target = targetId ? document.getElementById(targetId) : null;
			if (!target) return;

			var isHidden = target.hasAttribute('hidden');
			if (isHidden) {
				target.removeAttribute('hidden');
				btn.setAttribute('aria-expanded', 'true');
				btn.textContent = 'Hide Application';
				target.scrollIntoView({ behavior: reduceMotion ? 'auto' : 'smooth', block: 'nearest' });
			} else {
				target.setAttribute('hidden', '');
				btn.setAttribute('aria-expanded', 'false');
				btn.textContent = 'Apply Now';
			}
		});
	});

	/* ---------------------------------------------------------
	   Hero network canvas — signature element
	   A circuit-node network echoing the KutkiTech logo motif
	   (nodes + branch lines). Ambient drift, gentle mouse parallax.
	--------------------------------------------------------- */
	var canvas = document.getElementById('kt-network-canvas');
	if (canvas && canvas.getContext) {
		var ctx = canvas.getContext('2d');
		var width, height, dpr = Math.min(window.devicePixelRatio || 1, 2);
		var nodes = [];
		var mouse = { x: 0, y: 0, active: false };
		var NODE_COUNT;

		function resize() {
			var rect = canvas.parentElement.getBoundingClientRect();
			width = rect.width;
			height = rect.height;
			canvas.width = width * dpr;
			canvas.height = height * dpr;
			canvas.style.width = width + 'px';
			canvas.style.height = height + 'px';
			ctx.setTransform(dpr, 0, 0, dpr, 0, 0);

			NODE_COUNT = Math.max(18, Math.min(46, Math.round((width * height) / 26000)));
			buildNodes();
		}

		function buildNodes() {
			nodes = [];
			for (var i = 0; i < NODE_COUNT; i++) {
				nodes.push({
					x: Math.random() * width,
					y: Math.random() * height,
					vx: (Math.random() - 0.5) * 0.18,
					vy: (Math.random() - 0.5) * 0.18,
					r: Math.random() * 1.6 + 1.1
				});
			}
		}

		var linkDist = 150;

		function isLightTheme() {
			return document.documentElement.getAttribute('data-theme') === 'light';
		}

		function draw() {
			ctx.clearRect(0, 0, width, height);
			var light = isLightTheme();
			var lineColor = light ? '18,60,150,' : '107,150,255,';
			var glowColor = light ? '20,140,110,' : '120,220,190,';
			var nodeColor = light ? 'rgba(15,30,60,0.55)' : 'rgba(220,235,255,0.85)';

			for (var i = 0; i < nodes.length; i++) {
				var n = nodes[i];

				if (!reduceMotion) {
					n.x += n.vx;
					n.y += n.vy;
					if (n.x < 0 || n.x > width) n.vx *= -1;
					if (n.y < 0 || n.y > height) n.vy *= -1;
				}

				for (var j = i + 1; j < nodes.length; j++) {
					var m = nodes[j];
					var dx = n.x - m.x, dy = n.y - m.y;
					var dist = Math.sqrt(dx * dx + dy * dy);
					if (dist < linkDist) {
						var alpha = (1 - dist / linkDist) * (light ? 0.16 : 0.22);
						ctx.strokeStyle = 'rgba(' + lineColor + alpha + ')';
						ctx.lineWidth = 1;
						ctx.beginPath();
						ctx.moveTo(n.x, n.y);
						ctx.lineTo(m.x, m.y);
						ctx.stroke();
					}
				}
			}

			for (var k = 0; k < nodes.length; k++) {
				var node = nodes[k];
				var glow = ctx.createRadialGradient(node.x, node.y, 0, node.x, node.y, node.r * 5);
				glow.addColorStop(0, 'rgba(' + glowColor + (light ? '0.35' : '0.55') + ')');
				glow.addColorStop(1, 'rgba(' + glowColor + '0)');
				ctx.fillStyle = glow;
				ctx.beginPath();
				ctx.arc(node.x, node.y, node.r * 5, 0, Math.PI * 2);
				ctx.fill();

				ctx.fillStyle = nodeColor;
				ctx.beginPath();
				ctx.arc(node.x, node.y, node.r, 0, Math.PI * 2);
				ctx.fill();
			}

			if (!reduceMotion) requestAnimationFrame(draw);
		}

		resize();
		draw();

		var resizeTimer;
		window.addEventListener('resize', function () {
			clearTimeout(resizeTimer);
			resizeTimer = setTimeout(resize, 200);
		});

		if (reduceMotion) {
			// Redraw once on resize since the animation loop isn't running continuously
			window.addEventListener('resize', function () { setTimeout(draw, 250); });
			window.addEventListener('kt-theme-changed', draw);
		}
	}

})();
