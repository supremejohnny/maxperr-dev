// Add simple interactivity or component scripts here
document.addEventListener('DOMContentLoaded', () => {
  // Tablet header positioning
  const siteHeader = document.querySelector('.site-header');
  
  function checkTabletSize() {
    if (siteHeader) {
      const width = window.innerWidth;
      if (width >= 768 && width <= 1023) {
        siteHeader.classList.add('tablet-corner');
        console.log('Tablet mode: Header moved to corner');
      } else {
        siteHeader.classList.remove('tablet-corner');
        console.log('Non-tablet mode: Header in normal position');
      }
    }
  }
  
  // Check on load and resize
  checkTabletSize();
  window.addEventListener('resize', checkTabletSize);

  // Mobile menu toggle
  const mobileMenuButton = document.getElementById('mobile-menu-button');
  const mobileMenu = document.getElementById('mobile-menu');
  
  if (mobileMenuButton && mobileMenu) {
    mobileMenuButton.addEventListener('click', (e) => {
      e.preventDefault();
      e.stopPropagation();
      
      const isExpanded = mobileMenuButton.getAttribute('aria-expanded') === 'true';
      mobileMenuButton.setAttribute('aria-expanded', !isExpanded);
      mobileMenu.classList.toggle('show');
      
      console.log('Mobile menu toggled:', !isExpanded); // Debug log
    });
    
    // Close mobile menu when clicking on a link
    mobileMenu.querySelectorAll('.nav-link').forEach(link => {
      link.addEventListener('click', () => {
        mobileMenuButton.setAttribute('aria-expanded', 'false');
        mobileMenu.classList.remove('show');
      });
    });
    
    // Close mobile menu when clicking outside
    document.addEventListener('click', (e) => {
      if (!mobileMenuButton.contains(e.target) && !mobileMenu.contains(e.target)) {
        mobileMenuButton.setAttribute('aria-expanded', 'false');
        mobileMenu.classList.remove('show');
      }
    });
  }

  // Example: smooth scroll for anchor links
  document.querySelectorAll('a[href^="#"]').forEach(a => {
    a.addEventListener('click', e => {
      const id = a.getAttribute('href');
      const el = document.querySelector(id);
      if (el) {
        e.preventDefault();
        el.scrollIntoView({ behavior: 'smooth' });
      }
    });
  });
});

// ========== Hero slider (robust & multi-instance) ==========
try {
  const heroSections = document.querySelectorAll('.hero-section');
  heroSections.forEach((hero) => {
    if (!(hero instanceof Element)) return;

    // 读取 data-hero-images
    let images = [];
    try {
      images = JSON.parse(hero.getAttribute('data-hero-images') || '[]');
    } catch { images = []; }
    if (!Array.isArray(images) || images.length === 0) return;

    const pagination = hero.querySelector('.hero-pagination');
    const prevBtn   = hero.querySelector('.hero-nav--prev');
    const nextBtn   = hero.querySelector('.hero-nav--next');
    const layerA    = hero.querySelector('.hero-bg-layer[data-layer="a"]');
    const layerB    = hero.querySelector('.hero-bg-layer[data-layer="b"]');

    let index = 0;
    let useA = true;

    const setBg = (i, instant = false) => {
      const url = images[i];
      if (!url) return;
      const show = useA ? layerA : layerB;
      const hide = useA ? layerB : layerA;
      if (hide) hide.classList.remove('is-active');
      if (show) {
        show.style.backgroundImage = `url('${url}')`;
        instant
          ? show.classList.add('is-active')
          : requestAnimationFrame(() => show.classList.add('is-active'));
      }
      useA = !useA;
      if (pagination) {
        pagination.querySelectorAll('.hero-dot').forEach((dot, idx) => {
          dot.classList.toggle('hero-dot--active', idx === i);
        });
      }
    };

    const go = (i) => {
      index = (i + images.length) % images.length;
      setBg(index);
    };

    // 构建 dots
    if (pagination) {
      pagination.innerHTML = '';
      images.forEach((_, i) => {
        const d = document.createElement('button');
        d.className = 'hero-dot' + (i === 0 ? ' hero-dot--active' : '');
        d.type = 'button';
        d.setAttribute('aria-label', `Go to slide ${i + 1}`);
        d.addEventListener('click', () => go(i));
        pagination.appendChild(d);
      });
    }

    // 初始化第一张
    setBg(0, true);

    // 控件绑定
    if (prevBtn instanceof Element) prevBtn.addEventListener('click', () => go(index - 1));
    if (nextBtn instanceof Element) nextBtn.addEventListener('click', () => go(index + 1));

    // 自动播放 & 悬停暂停
    const safeOn = (el, type, fn) => el && typeof el.addEventListener === 'function' && el.addEventListener(type, fn);
    let timer = setInterval(() => go(index + 1), 6000);
    const pause  = () => { if (timer) { clearInterval(timer); timer = null; } };
    const resume = () => { if (!timer) timer = setInterval(() => go(index + 1), 6000); };
    safeOn(hero, 'mouseenter', pause);
    safeOn(hero, 'mouseleave', resume);
    safeOn(document, 'visibilitychange', () => (document.hidden ? pause() : resume()));
  });
} catch (err) {
  console.error('[hero] init failed:', err);
}

// ========== Testimony slider ==========
// ========== Testimony slider ==========
document.addEventListener('DOMContentLoaded', () => {
  try {
    const stack = document.querySelector('[data-testimony]');
    if (!stack) return;

    let front = stack.querySelector('[data-role="front"]');
    let back  = stack.querySelector('[data-role="back"]');
    const nextBtn = stack.querySelector('[data-next], .testimony-next') || document.querySelector('[data-next], .testimony-next');

    const dataNode = stack.querySelector('[data-testimony-source]');
    let slides = [];

    if (dataNode) {
      try {
        const parsed = JSON.parse(dataNode.textContent || '[]');
        if (Array.isArray(parsed)) {
          slides = parsed
            .map(item => ({
              heading: typeof item?.title === 'string' ? item.title : '',
              body: typeof item?.body === 'string' ? item.body : '',
              author: typeof item?.author === 'string' ? item.author : '',
            }))
            .filter(item => item.heading || item.body || item.author);
        }
      } catch (err) {
        console.error('[testimony] failed to parse data:', err);
      }

      if (typeof dataNode.remove === 'function') {
        dataNode.remove();
      }
    }

    if (!slides.length) {
      return;
    }
    let i = 0;                    // 当前 front 的索引
    let busy = false;             // 动画防抖

    const formatAuthor = (value) => {
      if (!value) return '';
      const parts = String(value).split('/');
      const name = (parts.shift() || '').trim();
      const org = parts.join('/').trim();
      if (!org) {
        return name;
      }
      return `${name} <span style="color:#94A3B8;font-weight:700;">/ ${org}</span>`;
    };

    const render = (card, data) => {
      const heading = card.querySelector('.testimony-heading');
      const body = card.querySelector('.testimony-body');
      const author = card.querySelector('.testimony-author');

      if (heading) heading.textContent = data.heading || '';
      if (body) body.textContent = data.body || '';
      if (author) author.innerHTML = formatAuthor(data.author); // eslint-disable-line no-param-reassign
    };

    // 关键：后卡预渲染“下一条”
    render(front, slides[i]);
    render(back,  slides[(i + 1) % slides.length]);

    // 保证 next 按钮始终在前卡上
    if (nextBtn && front !== nextBtn.parentElement) front.prepend(nextBtn);

    const goNext = () => {
      if (busy) return;
      busy = true;
      stack.classList.add('is-animating');

      // 让“后卡”（已是下一条内容）前移；“前卡”退后
      back.classList.remove('is-back');
      back.classList.add('is-front');
      front.classList.remove('is-front');
      front.classList.add('is-back');

      // 等“后卡”完成 transform 过渡再换内容与引用
      const onDone = (ev) => {
        if (ev && ev.propertyName !== 'transform') return; // 只认 transform 的结束
        back.removeEventListener('transitionend', onDone);

        // 交换前后引用
        const tmp = front; front = back; back = tmp;

        // 当前索引前进一位
        i = (i + 1) % slides.length;

        // 维持不变式：后卡 = 下一条
        render(back, slides[(i + 1) % slides.length]);

        // 把按钮插回新的前卡
        if (nextBtn && front !== nextBtn.parentElement) front.prepend(nextBtn);

        busy = false;
        stack.classList.remove('is-animating');
      };
      back.addEventListener('transitionend', onDone);
    };

    const allowAdvance = slides.length > 1;

    if (nextBtn && typeof nextBtn.addEventListener === 'function') {
      if (!allowAdvance) {
        nextBtn.setAttribute('disabled', 'true');
      } else {
        nextBtn.addEventListener('click', goNext);
      }
    }
    // 支持点整个卡片上的 “下一页” 热区（可选）
    if (allowAdvance) {
      stack.addEventListener('click', (ev) => {
        const hit = ev.target && typeof ev.target.closest === 'function'
          ? ev.target.closest('[data-next], .testimony-next')
          : null;
        if (hit) goNext();
      });
    }
  } catch (err) {
    console.error('[testimony] init failed:', err);
  }
});

// Smooth scroll for anchor links
document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('a[href^="#"]').forEach(a => {
    a.addEventListener('click', e => {
      const id = a.getAttribute('href');
      const el = document.querySelector(id);
      if (el) {
        e.preventDefault();
        el.scrollIntoView({ behavior: 'smooth' });
      }
    });
  });
});

// News slider (manual, no autoplay)
document.addEventListener('DOMContentLoaded', () => {
  try {
    const root = document.querySelector('#news[data-news-slider]');
    if (!root) return;

    const viewport = root.querySelector('.news-viewport');
    const track = root.querySelector('.news-track');
    const cards = Array.from(track.querySelectorAll('.news-card'));
    const prevBtn = root.querySelector('.news-prev');
    const nextBtn = root.querySelector('.news-next');

    if (cards.length === 0) {
      if (prevBtn) prevBtn.setAttribute('disabled', 'true');
      if (nextBtn) nextBtn.setAttribute('disabled', 'true');
      return;
    }

    let index = 0;
    let step = 0;
    let maxIndex = 0;

    const num = v => parseFloat(String(v).replace('px','')) || 0;

    const compute = () => {
      const styles = getComputedStyle(viewport);
      const perView = Math.max(1, parseInt(styles.getPropertyValue('--cards-per-view')) || 3);
      const gap = num(styles.getPropertyValue('--gap'));
      const width = viewport.getBoundingClientRect().width;
      const cardW = (width - (perView - 1) * gap) / perView;
      step = cardW + gap;
      maxIndex = Math.max(0, cards.length - perView);
      index = Math.min(index, maxIndex);
      apply();
      setDisabled();
    };

    const apply = () => {
      track.style.setProperty('--news-offset', `${-(index * step)}px`);
    };

    const setDisabled = () => {
      if (prevBtn) {
        if (index <= 0) prevBtn.setAttribute('disabled', 'true');
        else prevBtn.removeAttribute('disabled');
      }
      if (nextBtn) {
        if (index >= maxIndex) nextBtn.setAttribute('disabled', 'true');
        else nextBtn.removeAttribute('disabled');
      }
    };

    const prev = () => { if (index > 0) { index--; apply(); setDisabled(); } };
    const next = () => { if (index < maxIndex) { index++; apply(); setDisabled(); } };

    if (prevBtn) prevBtn.addEventListener('click', prev);
    if (nextBtn) nextBtn.addEventListener('click', next);
    window.addEventListener('resize', compute);
    compute();
  } catch (e) {
    console.error('[news slider] init failed:', e);
  }
});
