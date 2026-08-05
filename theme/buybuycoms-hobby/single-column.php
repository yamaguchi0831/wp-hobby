<?php
/**
 * Static first-stage template generated from pages/single-column.html.
 *
 * @package BuyBuyComs_Hobby
 */
?>
<?php
get_header();

while ( have_posts() ) :
  the_post();

  $column_genres       = get_the_terms( get_the_ID(), 'genre' );
  $column_genres       = ( ! is_wp_error( $column_genres ) && $column_genres ) ? $column_genres : array();
  $column_genre_names  = wp_list_pluck( $column_genres, 'name' );
  $column_primary_genre = $column_genres ? $column_genres[0] : null;
  $column_related_query = null;

  if ( $column_genres ) {
    $column_related_query = new WP_Query(
      array(
        'post_type'           => 'column',
        'post_status'         => 'publish',
        'posts_per_page'      => 3,
        'post__not_in'        => array( get_the_ID() ),
        'ignore_sticky_posts' => true,
        'no_found_rows'       => true,
        'orderby'             => 'rand',
        'tax_query'           => array(
          array(
            'taxonomy' => 'genre',
            'field'    => 'term_id',
            'terms'    => wp_list_pluck( $column_genres, 'term_id' ),
          ),
        ),
      )
    );
  }
?>

    <main id="main-content" class="hb-single-column__p-page">
      <div class="hb-single-column__p-breadcrumb-wrap">
        <?php buybuycoms_hobby_breadcrumb( 'hb__l-container', 'hb-single-column__p-breadcrumb', '', 'hb-single-column__p-breadcrumb-link', 'hb-single-column__p-breadcrumb-current', '' ); ?>
      </div>

      <section class="hb__l-section" aria-label="コラム詳細">
        <div class="hb__l-container hb-single-column__p-layout">
          <article class="hb-single-column__p-article">
            <div class="hb-single-column__p-article-inner">
              <div class="hb-single-column__p-article-meta">
                <?php if ( $column_genre_names ) : ?>
                <span class="hb-single-column__p-category-label">
                  <?php echo esc_html( implode( ' / ', $column_genre_names ) ); ?>
                </span>
                <?php endif; ?>
                <p class="hb-single-column__p-updated">
                  更新日:<time datetime="<?php echo esc_attr( get_the_modified_date( 'c' ) ); ?>"><?php echo esc_html( get_the_modified_date( 'Y.m.d' ) ); ?></time>
                </p>
              </div>

              <?php if ( has_post_thumbnail() ) : ?>
              <figure class="hb-single-column__p-hero">
                <?php
                the_post_thumbnail(
                  'full',
                  array(
                    'class' => 'hb-single-column__p-hero-image',
                  )
                );
                ?>
              </figure>
              <?php endif; ?>

              <h1 class="hb-single-column__p-title">
                <?php the_title(); ?>
              </h1>

              <div class="hb-single-column__p-content">
                <?php the_content(); ?>
                <?php
                wp_link_pages(
                  array(
                    'before' => '<nav class="hb-single-column__p-page-links" aria-label="' . esc_attr__( '記事内ページ送り', 'buybuycoms-hobby' ) . '">',
                    'after'  => '</nav>',
                  )
                );
                ?>
                <?php
                if ( $column_primary_genre ) {
                  get_template_part(
                    'template-parts/content/blog-card',
                    null,
                    array(
                      'genre_term' => $column_primary_genre,
                    )
                  );
                }
                ?>
              </div>

              <?php if ( $column_related_query && $column_related_query->have_posts() ) : ?>
                <section
                  class="hb-single-column__p-related"
                  aria-labelledby="related-column-title"
                >
                  <h2
                    class="hb-single-column__p-related-title"
                    id="related-column-title"
                  >
                    関連記事
                  </h2>
                  <ul class="hb-single-column__p-related-list" role="list">
                    <?php while ( $column_related_query->have_posts() ) : ?>
                      <?php $column_related_query->the_post(); ?>
                      <li>
                        <a class="hb-single-column__p-related-link" href="<?php the_permalink(); ?>">
                          <span class="hb-single-column__p-related-thumb">
                            <?php if ( has_post_thumbnail() ) : ?>
                              <?php
                              the_post_thumbnail(
                                'medium',
                                array(
                                  'loading' => 'lazy',
                                )
                              );
                              ?>
                            <?php else : ?>
                              <img
                                class="hb-single-column__p-no-image"
                                src="<?php echo esc_url( get_theme_file_uri( '/images/no-image-column.png' ) ); ?>"
                                alt=""
                                width="800"
                                height="600"
                                loading="lazy"
                              />
                            <?php endif; ?>
                          </span>
                          <span class="hb-single-column__p-related-card-title">
                            <?php the_title(); ?>
                          </span>
                        </a>
                      </li>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                  </ul>
                </section>
              <?php endif; ?>
            </div>
          </article>

          <?php
          get_template_part(
            'template-parts/column/sidebar',
            null,
            array(
              'class_prefix' => 'hb-single-column',
            )
          );
          ?>

          <?php if ( false ) : ?>
          <aside class="hb-single-column__p-sidebar" aria-label="サイドバー">
            <section class="hb-single-column__p-widget">
              <div class="hb-single-column__p-widget-inner">
                <h2 class="hb-single-column__p-widget-title">新着記事</h2>
                <ul class="hb-single-column__p-post-list" role="list">
                  <li>
                    <a class="hb-single-column__p-post-link" href="<?php echo esc_url( home_url( '/column/' ) ); ?>">
                      <span class="hb-single-column__p-post-thumb">
                        <img
                          src="https://placehold.co/176x132/eef3ee/33423a?text=New"
                          alt=""
                          width="176"
                          height="132"
                        />
                      </span>
                      <span class="hb-single-column__p-post-body">
                        <span class="hb-single-column__p-post-title">
                          積みプラ整理で見落としやすい査定ポイント
                        </span>
                        <span class="hb-single-column__p-post-date"
                          >2026年6月18日</span
                        >
                      </span>
                    </a>
                  </li>
                  <li>
                    <a class="hb-single-column__p-post-link" href="<?php echo esc_url( home_url( '/column/' ) ); ?>">
                      <span class="hb-single-column__p-post-thumb">
                        <img
                          src="https://placehold.co/176x132/eef3ee/33423a?text=New"
                          alt=""
                          width="176"
                          height="132"
                        />
                      </span>
                      <span class="hb-single-column__p-post-body">
                        <span class="hb-single-column__p-post-title">
                          未開封フィギュアを売る前に確認したいこと
                        </span>
                        <span class="hb-single-column__p-post-date"
                          >2026年6月12日</span
                        >
                      </span>
                    </a>
                  </li>
                  <li>
                    <a class="hb-single-column__p-post-link" href="<?php echo esc_url( home_url( '/column/' ) ); ?>">
                      <span class="hb-single-column__p-post-thumb">
                        <img
                          src="https://placehold.co/176x132/eef3ee/33423a?text=New"
                          alt=""
                          width="176"
                          height="132"
                        />
                      </span>
                      <span class="hb-single-column__p-post-body">
                        <span class="hb-single-column__p-post-title">
                          レトロゲームの箱付き・説明書付きは評価される？
                        </span>
                        <span class="hb-single-column__p-post-date"
                          >2026年6月5日</span
                        >
                      </span>
                    </a>
                  </li>
                </ul>
              </div>
            </section>

            <section class="hb-single-column__p-widget">
              <div class="hb-single-column__p-widget-inner">
                <h2 class="hb-single-column__p-widget-title">人気記事</h2>
                <ul class="hb-single-column__p-post-list" role="list">
                  <li>
                    <a class="hb-single-column__p-post-link" href="<?php echo esc_url( home_url( '/column/' ) ); ?>">
                      <span class="hb-single-column__p-post-thumb">
                        <img
                          src="https://placehold.co/176x132/eef3ee/33423a?text=Popular"
                          alt=""
                          width="176"
                          height="132"
                        />
                      </span>
                      <span class="hb-single-column__p-post-body">
                        <span class="hb-single-column__p-post-title">
                          ガンプラ買取で高くなりやすいシリーズ
                        </span>
                      </span>
                    </a>
                  </li>
                  <li>
                    <a class="hb-single-column__p-post-link" href="<?php echo esc_url( home_url( '/column/' ) ); ?>">
                      <span class="hb-single-column__p-post-thumb">
                        <img
                          src="https://placehold.co/176x132/eef3ee/33423a?text=Popular"
                          alt=""
                          width="176"
                          height="132"
                        />
                      </span>
                      <span class="hb-single-column__p-post-body">
                        <span class="hb-single-column__p-post-title">
                          超合金・メタルビルドを売るタイミング
                        </span>
                      </span>
                    </a>
                  </li>
                  <li>
                    <a class="hb-single-column__p-post-link" href="<?php echo esc_url( home_url( '/column/' ) ); ?>">
                      <span class="hb-single-column__p-post-thumb">
                        <img
                          src="https://placehold.co/176x132/eef3ee/33423a?text=Popular"
                          alt=""
                          width="176"
                          height="132"
                        />
                      </span>
                      <span class="hb-single-column__p-post-body">
                        <span class="hb-single-column__p-post-title">
                          大量買取をスムーズに進める梱包のコツ
                        </span>
                      </span>
                    </a>
                  </li>
                </ul>
              </div>
            </section>

            <section class="hb-single-column__p-widget">
              <div class="hb-single-column__p-widget-inner">
                <h2 class="hb-single-column__p-widget-title">カテゴリ</h2>
                <ul class="hb-single-column__p-link-list" role="list">
                  <li><a href="<?php echo esc_url( home_url( '/column/' ) ); ?>">機動戦士ガンダム(ガンプラ) 買取</a></li>
                  <li><a href="<?php echo esc_url( home_url( '/column/' ) ); ?>">超合金/メタルビルド 買取</a></li>
                  <li><a href="<?php echo esc_url( home_url( '/column/' ) ); ?>">LEGO 買取</a></li>
                  <li><a href="<?php echo esc_url( home_url( '/column/' ) ); ?>">プラモデル 買取</a></li>
                  <li><a href="<?php echo esc_url( home_url( '/column/' ) ); ?>">鉄道模型 買取</a></li>
                  <li><a href="<?php echo esc_url( home_url( '/column/' ) ); ?>">ソフビ 買取</a></li>
                  <li><a href="<?php echo esc_url( home_url( '/column/' ) ); ?>">レトロ玩具/昭和玩具 買取</a></li>
                  <li><a href="<?php echo esc_url( home_url( '/column/' ) ); ?>">特撮グッズ 買取</a></li>
                  <li><a href="<?php echo esc_url( home_url( '/column/' ) ); ?>">レトロゲーム 買取</a></li>
                  <li><a href="<?php echo esc_url( home_url( '/column/' ) ); ?>">ミニカー 買取</a></li>
                  <li><a href="<?php echo esc_url( home_url( '/column/' ) ); ?>">フィギュア 買取</a></li>
                  <li><a href="<?php echo esc_url( home_url( '/column/' ) ); ?>">無線機 買取</a></li>
                  <li><a href="<?php echo esc_url( home_url( '/column/' ) ); ?>">デアゴスティーニ 買取</a></li>
                  <li><a href="<?php echo esc_url( home_url( '/column/' ) ); ?>">アシェット 買取</a></li>
                </ul>
              </div>
            </section>

            <section class="hb-single-column__p-widget">
              <div class="hb-single-column__p-widget-inner">
                <h2 class="hb-single-column__p-widget-title">タグ</h2>
                <ul class="hb-single-column__p-tag-list" role="list">
                  <li>
                    <a class="hb-single-column__p-tag-link" href="<?php echo esc_url( home_url( '/column/' ) ); ?>"
                      >積みプラ</a
                    >
                  </li>
                  <li>
                    <a class="hb-single-column__p-tag-link" href="<?php echo esc_url( home_url( '/column/' ) ); ?>"
                      >コレクション整理</a
                    >
                  </li>
                  <li>
                    <a class="hb-single-column__p-tag-link" href="<?php echo esc_url( home_url( '/column/' ) ); ?>">引退</a>
                  </li>
                  <li>
                    <a class="hb-single-column__p-tag-link" href="<?php echo esc_url( home_url( '/column/' ) ); ?>"
                      >遺品整理/生前整理</a
                    >
                  </li>
                  <li>
                    <a class="hb-single-column__p-tag-link" href="<?php echo esc_url( home_url( '/column/' ) ); ?>">限定品</a>
                  </li>
                  <li>
                    <a class="hb-single-column__p-tag-link" href="<?php echo esc_url( home_url( '/column/' ) ); ?>">未開封</a>
                  </li>
                  <li>
                    <a class="hb-single-column__p-tag-link" href="<?php echo esc_url( home_url( '/column/' ) ); ?>"
                      >ガンプラ</a
                    >
                  </li>
                  <li>
                    <a class="hb-single-column__p-tag-link" href="<?php echo esc_url( home_url( '/column/' ) ); ?>"
                      >フィギュア</a
                    >
                  </li>
                  <li>
                    <a class="hb-single-column__p-tag-link" href="<?php echo esc_url( home_url( '/column/' ) ); ?>">超合金</a>
                  </li>
                  <li>
                    <a class="hb-single-column__p-tag-link" href="<?php echo esc_url( home_url( '/column/' ) ); ?>"
                      >レトロゲーム</a
                    >
                  </li>
                  <li>
                    <a class="hb-single-column__p-tag-link" href="<?php echo esc_url( home_url( '/column/' ) ); ?>"
                      >ジャンク</a
                    >
                  </li>
                  <li>
                    <a class="hb-single-column__p-tag-link" href="<?php echo esc_url( home_url( '/column/' ) ); ?>"
                      >大量買取</a
                    >
                  </li>
                  <li>
                    <a class="hb-single-column__p-tag-link" href="<?php echo esc_url( home_url( '/column/' ) ); ?>"
                      >宅配買取</a
                    >
                  </li>
                </ul>
              </div>
            </section>
          </aside>
          <?php endif; ?>
        </div>
      </section>
    </main>

    <?php endwhile; ?>
    <?php get_template_part( 'template-parts/common/footer-cta' ); ?>
    <?php get_footer(); ?>
