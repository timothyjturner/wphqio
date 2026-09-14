<?php
/**
 * WPHQ single blog post template.
 * Requires ACF for CTA controls. Gracefully renders without ACF.
 */
get_header();

if (have_posts()) :
    while (have_posts()) : the_post();
        $has_acf = function_exists('get_field');
        $ignore_styling = $has_acf && (bool) get_field('wphq_ignore_blog_styling');

        if ($ignore_styling) {
            the_content();
            continue;
        }

        $sidebar_enabled = $has_acf && (bool) get_field('wphq_enable_sidebar_cta');
        $inline_enabled  = $has_acf && (bool) get_field('wphq_enable_inline_cta');
        $popup_enabled   = $has_acf && (bool) get_field('wphq_enable_popup_cta');
        $cta_id = static function ($value) {
            return $value instanceof WP_Post ? (int) $value->ID : (int) $value;
        };
        $sidebar_id = $sidebar_enabled ? $cta_id(get_field('wphq_sidebar_cta')) : 0;
        $inline_id  = $inline_enabled  ? $cta_id(get_field('wphq_inline_cta'))  : 0;
        $popup_id   = $popup_enabled   ? $cta_id(get_field('wphq_popup_cta'))   : 0;

        $cta_data = static function ($post_id) {
            if (!$post_id || get_post_status($post_id) !== 'publish') return null;
            $image = function_exists('get_field') ? get_field('wphq_cta_image', $post_id) : null;
            $url = function_exists('get_field') ? get_field('wphq_cta_url', $post_id) : '';
            $button = function_exists('get_field') ? get_field('wphq_cta_button_title', $post_id) : '';
            return array(
                'id' => (int) $post_id,
                'title' => get_the_title($post_id),
                'body' => function_exists('get_field') ? (string) get_field('wphq_cta_body', $post_id) : '',
                'url' => $url ? $url : '#',
                'button' => $button ? $button : 'Learn more',
                'image_id' => is_array($image) && isset($image['ID']) ? (int) $image['ID'] : (is_numeric($image) ? (int) $image : 0),
            );
        };
        $sidebar = $cta_data($sidebar_id);
        $inline  = $cta_data($inline_id);
        $popup   = $cta_data($popup_id);

        $render_cta = static function ($cta, $variant) {
            if (!$cta) return;
            $label = sprintf('Learn more about %s', $cta['title']);
            ?>
            <aside class="wphq-cta wphq-cta--<?php echo esc_attr($variant); ?>" aria-label="<?php echo esc_attr($cta['title']); ?>" data-cta-id="<?php echo esc_attr($cta['id']); ?>" data-cta-name="<?php echo esc_attr($cta['title']); ?>" data-cta-placement="<?php echo esc_attr($variant); ?>">
                <?php if ($cta['image_id'] && $variant !== 'inline') : ?>
                    <div class="wphq-cta__media"><?php echo wp_get_attachment_image($cta['image_id'], 'medium_large', false, array('loading' => 'lazy')); ?></div>
                <?php endif; ?>
                <div class="wphq-cta__copy">
                    <span class="wphq-cta__eyebrow">How WPHQ can help</span>
                    <h2><?php echo esc_html($cta['title']); ?></h2>
                    <?php if ($cta['body']) : ?><div class="wphq-cta__body"><?php echo wp_kses_post(wpautop($cta['body'])); ?></div><?php endif; ?>
                    <a class="wphq-cta__button" href="<?php echo esc_url($cta['url']); ?>" aria-label="<?php echo esc_attr($label); ?>"><?php echo esc_html($cta['button']); ?><span aria-hidden="true">→</span></a>
                </div>
            </aside>
            <?php
        };
        ?>

        <main class="wphq-article-shell">
            <header class="wphq-article-hero">
                <div class="wphq-article-hero__inner">
                    <nav class="wphq-breadcrumb" aria-label="Breadcrumb"><a href="<?php echo esc_url(home_url('/')); ?>">Home</a><span aria-hidden="true">/</span><span>Insights</span></nav>
                    <?php $categories = get_the_category(); if ($categories) : ?><a class="wphq-category" href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>"><?php echo esc_html($categories[0]->name); ?></a><?php endif; ?>
                    <h1><?php the_title(); ?></h1>
                    <?php if (has_excerpt()) : ?><p class="wphq-deck"><?php echo esc_html(get_the_excerpt()); ?></p><?php endif; ?>
                    <div class="wphq-byline"><span>By <?php echo esc_html(get_the_author()); ?></span><span><?php echo esc_html(get_the_date()); ?></span><span><?php echo esc_html(max(1, (int) ceil(str_word_count(wp_strip_all_tags(get_the_content())) / 225))); ?> min read</span></div>
                </div>
            </header>

            <?php if (has_post_thumbnail()) : ?>
                <figure class="wphq-featured"><?php the_post_thumbnail('large', array('loading' => 'eager', 'fetchpriority' => 'high')); ?></figure>
            <?php endif; ?>

            <div class="wphq-article-grid<?php echo $sidebar ? '' : ' wphq-article-grid--solo'; ?>">
                <article class="wphq-article" id="wphq-article-content">
                    <?php the_content(); ?>
                    <?php wp_link_pages(); ?>
                </article>
                <?php if ($sidebar) : ?><div class="wphq-sidebar"><?php $render_cta($sidebar, 'sidebar'); ?></div><?php endif; ?>
            </div>
        </main>

        <?php if ($inline) : ?><template id="wphq-inline-template"><?php $render_cta($inline, 'inline'); ?></template><?php endif; ?>
        <?php if ($popup) : ?>
            <div class="wphq-popup" id="wphq-popup" hidden>
                <button class="wphq-popup__close" type="button" aria-label="Close">×</button>
                <button class="wphq-popup__expand" type="button" aria-expanded="false" aria-label="Expand offer"><span>Learn more</span>⌃</button>
                <?php $render_cta($popup, 'popup'); ?>
            </div>
        <?php endif; ?>

        <style>
        :root{--wphq-ink:#102733;--wphq-muted:#5d6c73;--wphq-teal:#3ca2ad;--wphq-teal-dark:#237d88;--wphq-orange:#f47b20;--wphq-cloud:#f4f8f9;--wphq-line:#dce7e9}
        .wphq-article-shell{background:#fff;color:var(--wphq-ink);padding-bottom:80px}.wphq-article-shell *{box-sizing:border-box}.wphq-article-hero{background:linear-gradient(135deg,#f4fbfc 0%,#fff 62%,#fff5ed 100%);border-bottom:1px solid var(--wphq-line)}.wphq-article-hero__inner{max-width:1040px;margin:auto;padding:56px 24px 92px}.wphq-breadcrumb{display:flex;gap:9px;margin-bottom:28px;color:var(--wphq-muted);font-size:14px}.wphq-breadcrumb a{color:var(--wphq-teal-dark);text-decoration:none}.wphq-category{display:inline-block;margin-bottom:16px;color:var(--wphq-teal-dark);font-size:12px;font-weight:800;letter-spacing:.12em;text-decoration:none;text-transform:uppercase}.wphq-article-hero h1{max-width:900px;margin:0;font-size:clamp(38px,5.5vw,68px);font-weight:800;letter-spacing:-.045em;line-height:1.03}.wphq-deck{max-width:760px;margin:22px 0 0;color:var(--wphq-muted);font-size:clamp(18px,2vw,22px);line-height:1.55}.wphq-byline{display:flex;flex-wrap:wrap;gap:12px 24px;margin-top:28px;color:var(--wphq-muted);font-size:14px}.wphq-byline span+span:before{content:'•';margin-right:24px;color:var(--wphq-teal)}
        .wphq-featured{position:relative;z-index:1;width:min(1120px,calc(100% - 48px));height:clamp(260px,42vw,520px);margin:-54px auto 58px;overflow:hidden;border:7px solid #fff;border-radius:22px;box-shadow:0 20px 55px rgba(16,39,51,.16)}.wphq-featured img{width:100%;height:100%;object-fit:cover;display:block}.wphq-article-grid{display:grid;grid-template-columns:minmax(0,740px) 300px;gap:68px;max-width:1120px;margin:auto;padding:0 24px}.wphq-article-grid--solo{display:block;max-width:788px}.wphq-article{font-family:system-ui,-apple-system,BlinkMacSystemFont,"Segoe UI",sans-serif;font-size:18px;line-height:1.82}.wphq-article>p:first-child{font-size:21px;color:#344d58}.wphq-article h2,.wphq-article h3,.wphq-article h4{color:var(--wphq-ink);font-weight:800;letter-spacing:-.025em;line-height:1.2;scroll-margin-top:100px}.wphq-article h2{margin:2.1em 0 .65em;font-size:34px}.wphq-article h3{margin:1.8em 0 .55em;font-size:25px}.wphq-article p,.wphq-article ul,.wphq-article ol{margin:0 0 1.35em}.wphq-article li{margin:.38em 0}.wphq-article a{color:var(--wphq-teal-dark);font-weight:650;text-decoration-thickness:2px;text-underline-offset:3px}.wphq-article img{max-width:100%;height:auto;border-radius:14px}.wphq-article blockquote{margin:2em 0;padding:8px 0 8px 25px;border-left:4px solid var(--wphq-orange);font-size:21px;font-weight:600}.wphq-article pre{overflow:auto;padding:22px;border-radius:12px;background:#102733;color:#f7fbfc}.wphq-article hr{margin:42px 0;border:0;border-top:1px solid var(--wphq-line)}.wphq-sidebar{position:relative}.wphq-sidebar>.wphq-cta{position:sticky;top:24px}
        .wphq-cta{overflow:hidden;border:1px solid var(--wphq-line);border-radius:18px;background:#fff;box-shadow:0 15px 38px rgba(16,39,51,.11)}.wphq-cta__media{aspect-ratio:16/9;overflow:hidden;background:var(--wphq-cloud)}.wphq-cta__media img{width:100%;height:100%;object-fit:cover}.wphq-cta__copy{padding:24px}.wphq-cta__eyebrow{display:block;margin-bottom:8px;color:var(--wphq-teal-dark);font-size:11px;font-weight:800;letter-spacing:.1em;text-transform:uppercase}.wphq-cta h2{margin:0 0 10px;font-size:23px;line-height:1.15}.wphq-cta__body{color:var(--wphq-muted);font-size:15px;line-height:1.55}.wphq-cta__body p{margin:0 0 15px}.wphq-cta__button{display:flex;align-items:center;justify-content:space-between;gap:10px;width:100%;margin-top:18px;padding:13px 16px;border-radius:9px;background:var(--wphq-orange);color:#fff!important;font-size:14px;font-weight:800;text-decoration:none!important;transition:transform .2s,background .2s}.wphq-cta__button:hover{background:#d9610b;transform:translateY(-1px)}.wphq-cta--inline{display:grid;grid-template-columns:1fr auto;align-items:center;margin:48px 0;padding:0;border-left:5px solid var(--wphq-teal);background:var(--wphq-cloud);box-shadow:none}.wphq-cta--inline .wphq-cta__copy{display:grid;grid-template-columns:1fr auto;gap:4px 24px;width:100%;padding:25px 28px}.wphq-cta--inline .wphq-cta__eyebrow,.wphq-cta--inline h2,.wphq-cta--inline .wphq-cta__body{grid-column:1}.wphq-cta--inline h2{font-size:22px}.wphq-cta--inline .wphq-cta__body p{margin:0}.wphq-cta--inline .wphq-cta__button{grid-column:2;grid-row:1/4;align-self:center;width:auto;min-width:145px;margin:0}
        .wphq-popup{position:fixed;z-index:99999;left:24px;bottom:24px;width:360px;transform:translateY(25px);opacity:0;transition:opacity .3s,transform .3s}.wphq-popup.is-visible{transform:none;opacity:1}.wphq-popup__close{position:absolute;z-index:2;top:-10px;right:-10px;width:32px;height:32px;padding:0;border:0;border-radius:50%;background:var(--wphq-ink);color:#fff;font-size:23px;line-height:30px;cursor:pointer;box-shadow:0 4px 12px rgba(0,0,0,.2)}.wphq-popup__expand{display:none}.wphq-cta--popup .wphq-cta__media{aspect-ratio:2/1}.wphq-cta--popup .wphq-cta__copy{padding:20px}.wphq-cta--popup h2{font-size:21px}
        @media(max-width:900px){.wphq-article-grid{display:flex;flex-direction:column;gap:40px;max-width:788px}.wphq-sidebar{order:2}.wphq-sidebar>.wphq-cta{position:static}.wphq-cta--sidebar{display:grid;grid-template-columns:180px 1fr}.wphq-cta--sidebar .wphq-cta__media{height:100%;aspect-ratio:auto}}
        @media(max-width:640px){.wphq-article-shell{padding-bottom:94px}.wphq-article-hero__inner{padding:36px 20px 66px}.wphq-article-hero h1{font-size:38px}.wphq-deck{font-size:18px}.wphq-byline{gap:7px 14px}.wphq-byline span+span:before{margin-right:14px}.wphq-featured{width:calc(100% - 32px);height:240px;margin:-36px auto 38px;border-width:4px;border-radius:15px}.wphq-article-grid{padding:0 20px}.wphq-article{font-size:17px;line-height:1.75}.wphq-article>p:first-child{font-size:19px}.wphq-article h2{font-size:28px}.wphq-article h3{font-size:23px}.wphq-cta--inline .wphq-cta__copy{display:block;padding:22px}.wphq-cta--inline .wphq-cta__button{margin-top:16px}.wphq-cta--sidebar{display:block}.wphq-popup{left:0;right:0;bottom:0;width:auto;transform:translateY(100%)}.wphq-popup.is-visible{transform:none}.wphq-popup__close{top:7px;right:8px;width:28px;height:28px;font-size:20px}.wphq-popup__expand{display:flex;position:absolute;z-index:3;right:42px;top:0;align-items:center;gap:5px;height:44px;padding:0 6px;border:0;background:transparent;color:var(--wphq-teal-dark);font-size:11px;font-weight:800;cursor:pointer}.wphq-cta--popup{border-radius:15px 15px 0 0}.wphq-cta--popup .wphq-cta__media,.wphq-cta--popup .wphq-cta__eyebrow,.wphq-cta--popup .wphq-cta__body,.wphq-cta--popup .wphq-cta__button{display:none}.wphq-cta--popup .wphq-cta__copy{min-height:44px;padding:12px 145px 10px 16px}.wphq-cta--popup h2{overflow:hidden;margin:0;white-space:nowrap;text-overflow:ellipsis;font-size:16px}.wphq-popup.is-expanded .wphq-cta--popup .wphq-cta__media{display:block}.wphq-popup.is-expanded .wphq-cta--popup .wphq-cta__copy{padding:18px 20px}.wphq-popup.is-expanded .wphq-cta--popup .wphq-cta__eyebrow,.wphq-popup.is-expanded .wphq-cta--popup .wphq-cta__body,.wphq-popup.is-expanded .wphq-cta--popup .wphq-cta__button{display:flex}.wphq-popup.is-expanded .wphq-cta--popup .wphq-cta__eyebrow{display:block}.wphq-popup.is-expanded .wphq-cta--popup h2{white-space:normal}.wphq-popup.is-expanded .wphq-popup__expand span{display:none}.wphq-popup.is-expanded .wphq-popup__expand{top:7px;right:43px;font-size:16px;transform:rotate(180deg)}}
        </style>

        <script>
        document.addEventListener('DOMContentLoaded',function(){
          var article=document.getElementById('wphq-article-content'),tpl=document.getElementById('wphq-inline-template');
          if(article&&tpl){var nodes=Array.from(article.children).filter(function(n){return /^(P|H2|H3|UL|OL|BLOCKQUOTE|FIGURE)$/.test(n.tagName)});if(nodes.length){var at=Math.max(1,Math.floor(nodes.length*.42));nodes[Math.min(at,nodes.length-1)].after(tpl.content.cloneNode(true));}}
          var popup=document.getElementById('wphq-popup');if(!popup)return;
          var key='wphqCtaSeen:'+<?php echo wp_json_encode((string) get_the_ID()); ?>;
          if(!sessionStorage.getItem(key)){setTimeout(function(){popup.hidden=false;requestAnimationFrame(function(){popup.classList.add('is-visible')});sessionStorage.setItem(key,'1')},12000)}
          popup.querySelector('.wphq-popup__close').addEventListener('click',function(){popup.classList.remove('is-visible');setTimeout(function(){popup.hidden=true},300)});
          var expand=popup.querySelector('.wphq-popup__expand');expand.addEventListener('click',function(){var open=popup.classList.toggle('is-expanded');expand.setAttribute('aria-expanded',open?'true':'false')});
        });
        document.addEventListener('click',function(event){
          var link=event.target.closest('.wphq-cta__button');
          if(!link)return;
          var cta=link.closest('.wphq-cta');
          if(!cta)return;
          var params={
            cta_id:cta.getAttribute('data-cta-id')||'',
            cta_name:cta.getAttribute('data-cta-name')||'',
            cta_placement:cta.getAttribute('data-cta-placement')||'',
            link_text:(link.textContent||'').replace(/\s+/g,' ').trim(),
            link_url:link.href||'',
            content_id:<?php echo wp_json_encode((string) get_the_ID()); ?>,
            content_title:<?php echo wp_json_encode(wp_strip_all_tags(get_the_title())); ?>
          };
          if(typeof window.gtag==='function'){
            window.gtag('event','cta_click',params);
          }else if(Array.isArray(window.dataLayer)){
            window.dataLayer.push(Object.assign({event:'cta_click'},params));
          }
        });
        </script>
    <?php endwhile;
else : ?>
    <main class="wphq-article-shell"><p><?php esc_html_e('No content found.', 'wphq'); ?></p></main>
<?php endif;

get_footer();
