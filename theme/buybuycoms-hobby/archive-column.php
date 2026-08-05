<?php
/**
 * Static first-stage template generated from pages/archive-column.html.
 *
 * @package BuyBuyComs_Hobby
 */
?>
<?php
get_header();
?>

        <main id="main-content" class="hb-archive-column__p-page">
            <section class="hb__p-subpage-title" aria-label="コラム一覧">
                <div class="hb__l-container hb__p-subpage-title__inner">
                    <h1 class="hb__p-subpage-title__heading">コラム一覧</h1>
                </div>
            </section>
            <div class="hb__l-container">
      <?php buybuycoms_hobby_breadcrumb(); ?>
            </div>

            <section class="hb__l-section" aria-label="コラム一覧">
                <div class="hb__l-container">
                    <div class="hb-archive-column__p-intro">
                        <p class="hb-archive-column__p-intro-text">
                            ホビー・コレクション整理・積みプラ・フィギュア・超合金・鉄道模型・レトロおもちゃなどの買取情報を掲載しています。<br />
                            査定ポイントや高く売るコツ、コレクション整理の方法、人気シリーズの解説などを買取のプロが分かりやすく解説します。
                        </p>
                    </div>
                </div>
                <div class="hb__l-container hb-archive-column__p-layout">
                    <div class="hb-archive-column__p-archive">
                        <ul
                            class="hb-archive-column__p-column-list"
                            role="list"
                        >
                            <?php if ( have_posts() ) : ?>
                                <?php while ( have_posts() ) : ?>
                                    <?php
                                    the_post();
                                    $column_genres = get_the_terms( get_the_ID(), 'genre' );
                                    $column_label  = ( ! is_wp_error( $column_genres ) && ! empty( $column_genres ) )
                                        ? $column_genres[0]->name
                                        : '';
                                    $column_excerpt = get_post_field( 'post_excerpt', get_the_ID() );
                                    ?>
                                    <li class="hb-archive-column__p-column-card">
                                        <a
                                            class="hb-archive-column__p-column-link"
                                            href="<?php the_permalink(); ?>"
                                        >
                                            <span class="hb-archive-column__p-column-thumb">
                                                <?php if ( has_post_thumbnail() ) : ?>
                                                    <?php the_post_thumbnail( 'medium_large' ); ?>
                                                <?php else : ?>
                                                    <img
                                                        class="hb-archive-column__p-no-image"
                                                        src="<?php echo esc_url( get_theme_file_uri( '/images/no-image-column.png' ) ); ?>"
                                                        alt=""
                                                        width="800"
                                                        height="600"
                                                        loading="lazy"
                                                    />
                                                <?php endif; ?>
                                            </span>
                                            <span class="hb-archive-column__p-column-body">
                                                <?php if ( $column_label ) : ?>
                                                    <span class="hb-archive-column__p-column-label">
                                                        <?php echo esc_html( $column_label ); ?>
                                                    </span>
                                                <?php endif; ?>
                                                <span class="hb-archive-column__p-column-title">
                                                    <?php the_title(); ?>
                                                </span>
                                                <?php if ( $column_excerpt ) : ?>
                                                    <span class="hb-archive-column__p-column-excerpt">
                                                        <?php echo esc_html( wp_trim_words( wp_strip_all_tags( $column_excerpt ), 80, '…' ) ); ?>
                                                    </span>
                                                <?php endif; ?>
                                                <time
                                                    class="hb-archive-column__p-column-date"
                                                    datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"
                                                >
                                                    <?php echo esc_html( get_the_date( 'Y年n月j日' ) ); ?>
                                                </time>
                                            </span>
                                        </a>
                                    </li>
                                <?php endwhile; ?>
                            <?php else : ?>
                                <li class="hb-archive-column__p-empty">
                                    <?php esc_html_e( '現在、コラム記事はありません。', 'buybuycoms-hobby' ); ?>
                                </li>
                            <?php endif; ?>

                            <?php if ( false ) : ?>
                            <li class="hb-archive-column__p-column-card">
                                <a
                                    class="hb-archive-column__p-column-link"
                                    href="<?php echo esc_url( home_url( '/column/' ) ); ?>"
                                >
                                    <span
                                        class="hb-archive-column__p-column-thumb"
                                    >
                                        <img
                                            src="https://placehold.co/520x390/eef3ee/33423a?text=Gunpla"
                                            alt=""
                                            width="520"
                                            height="390"
                                        />
                                    </span>
                                    <span
                                        class="hb-archive-column__p-column-body"
                                    >
                                        <span
                                            class="hb-archive-column__p-column-label"
                                        >
                                            機動戦士ガンダム(ガンプラ) 買取
                                        </span>
                                        <span
                                            class="hb-archive-column__p-column-title"
                                        >
                                            ガンプラを高く売るための保管と整理のコツ
                                        </span>
                                        <span
                                            class="hb-archive-column__p-column-excerpt"
                                        >
                                            積みプラや限定品、未開封キットを査定に出す前に確認したいポイントをまとめました。箱や付属品の扱い方も分かりやすく解説します。
                                        </span>
                                        <span
                                            class="hb-archive-column__p-column-date"
                                        >
                                            2026年6月18日
                                        </span>
                                    </span>
                                </a>
                            </li>
                            <li class="hb-archive-column__p-column-card">
                                <a
                                    class="hb-archive-column__p-column-link"
                                    href="<?php echo esc_url( home_url( '/column/' ) ); ?>"
                                >
                                    <span
                                        class="hb-archive-column__p-column-thumb"
                                    >
                                        <img
                                            src="https://placehold.co/520x390/eef3ee/33423a?text=Figure"
                                            alt=""
                                            width="520"
                                            height="390"
                                        />
                                    </span>
                                    <span
                                        class="hb-archive-column__p-column-body"
                                    >
                                        <span
                                            class="hb-archive-column__p-column-label"
                                        >
                                            フィギュア 買取
                                        </span>
                                        <span
                                            class="hb-archive-column__p-column-title"
                                        >
                                            未開封フィギュアを売る前に確認したい査定ポイント
                                        </span>
                                        <span
                                            class="hb-archive-column__p-column-excerpt"
                                        >
                                            外箱の状態、シリーズ、メーカー、限定流通品など、フィギュア買取で評価されやすい条件を整理して紹介します。
                                        </span>
                                        <span
                                            class="hb-archive-column__p-column-date"
                                        >
                                            2026年6月12日
                                        </span>
                                    </span>
                                </a>
                            </li>
                            <li class="hb-archive-column__p-column-card">
                                <a
                                    class="hb-archive-column__p-column-link"
                                    href="<?php echo esc_url( home_url( '/column/' ) ); ?>"
                                >
                                    <span
                                        class="hb-archive-column__p-column-thumb"
                                    >
                                        <img
                                            src="https://placehold.co/520x390/eef3ee/33423a?text=Metal+Build"
                                            alt=""
                                            width="520"
                                            height="390"
                                        />
                                    </span>
                                    <span
                                        class="hb-archive-column__p-column-body"
                                    >
                                        <span
                                            class="hb-archive-column__p-column-label"
                                        >
                                            超合金/メタルビルド 買取
                                        </span>
                                        <span
                                            class="hb-archive-column__p-column-title"
                                        >
                                            超合金・メタルビルドを売るタイミングと相場の見方
                                        </span>
                                        <span
                                            class="hb-archive-column__p-column-excerpt"
                                        >
                                            人気シリーズの需要や再販状況、付属品の有無など、高く売りたいときに押さえておきたい見方を解説します。
                                        </span>
                                        <span
                                            class="hb-archive-column__p-column-date"
                                        >
                                            2026年6月5日
                                        </span>
                                    </span>
                                </a>
                            </li>
                            <li class="hb-archive-column__p-column-card">
                                <a
                                    class="hb-archive-column__p-column-link"
                                    href="<?php echo esc_url( home_url( '/column/' ) ); ?>"
                                >
                                    <span
                                        class="hb-archive-column__p-column-thumb"
                                    >
                                        <img
                                            src="https://placehold.co/520x390/eef3ee/33423a?text=Retro+Game"
                                            alt=""
                                            width="520"
                                            height="390"
                                        />
                                    </span>
                                    <span
                                        class="hb-archive-column__p-column-body"
                                    >
                                        <span
                                            class="hb-archive-column__p-column-label"
                                        >
                                            レトロゲーム 買取
                                        </span>
                                        <span
                                            class="hb-archive-column__p-column-title"
                                        >
                                            レトロゲームの箱付き・説明書付きはどこまで評価される？
                                        </span>
                                        <span
                                            class="hb-archive-column__p-column-excerpt"
                                        >
                                            ソフトや本体の状態、箱・説明書・ハガキなどの付属品が査定額にどう影響するのかを紹介します。
                                        </span>
                                        <span
                                            class="hb-archive-column__p-column-date"
                                        >
                                            2026年5月29日
                                        </span>
                                    </span>
                                </a>
                            </li>
                            <li class="hb-archive-column__p-column-card">
                                <a
                                    class="hb-archive-column__p-column-link"
                                    href="<?php echo esc_url( home_url( '/column/' ) ); ?>"
                                >
                                    <span
                                        class="hb-archive-column__p-column-thumb"
                                    >
                                        <img
                                            src="https://placehold.co/520x390/eef3ee/33423a?text=Railway"
                                            alt=""
                                            width="520"
                                            height="390"
                                        />
                                    </span>
                                    <span
                                        class="hb-archive-column__p-column-body"
                                    >
                                        <span
                                            class="hb-archive-column__p-column-label"
                                        >
                                            鉄道模型 買取
                                        </span>
                                        <span
                                            class="hb-archive-column__p-column-title"
                                        >
                                            鉄道模型の大量買取で事前に整理しておきたいこと
                                        </span>
                                        <span
                                            class="hb-archive-column__p-column-excerpt"
                                        >
                                            NゲージやHOゲージ、車両セット、線路、コントローラーなどをまとめて売る際の確認ポイントをまとめました。
                                        </span>
                                        <span
                                            class="hb-archive-column__p-column-date"
                                        >
                                            2026年5月22日
                                        </span>
                                    </span>
                                </a>
                            </li>
                            <?php endif; ?>
                        </ul>

                        <?php
                        $column_pagination = paginate_links(
                            array(
                                'current'   => max( 1, get_query_var( 'paged' ) ),
                                'total'     => $GLOBALS['wp_query']->max_num_pages,
                                'type'      => 'array',
                                'prev_text' => '<span aria-hidden="true">‹</span><span class="screen-reader-text">' . esc_html__( '前のページ', 'buybuycoms-hobby' ) . '</span>',
                                'next_text' => '<span aria-hidden="true">›</span><span class="screen-reader-text">' . esc_html__( '次のページ', 'buybuycoms-hobby' ) . '</span>',
                            )
                        );
                        ?>
                        <?php if ( $column_pagination ) : ?>
                            <nav aria-label="コラムページ送り">
                                <ol class="hb-archive-column__p-pagination">
                                    <?php foreach ( $column_pagination as $column_pagination_link ) : ?>
                                        <li><?php echo wp_kses_post( $column_pagination_link ); ?></li>
                                    <?php endforeach; ?>
                                </ol>
                            </nav>
                        <?php endif; ?>
                    </div>

                    <?php
                    get_template_part(
                        'template-parts/column/sidebar',
                        null,
                        array(
                            'class_prefix' => 'hb-archive-column',
                        )
                    );
                    ?>

                    <?php if ( false ) : ?>
                    <aside
                        class="hb-archive-column__p-sidebar"
                        aria-label="サイドバー"
                    >
                        <section class="hb-archive-column__p-widget">
                            <div class="hb-archive-column__p-widget-inner">
                                <h2 class="hb-archive-column__p-widget-title">
                                    新着記事
                                </h2>
                                <ul
                                    class="hb-archive-column__p-post-list"
                                    role="list"
                                >
                                    <?php
                                    $latest_columns = new WP_Query(
                                        array(
                                            'post_type'           => 'column',
                                            'post_status'         => 'publish',
                                            'posts_per_page'      => 3,
                                            'ignore_sticky_posts' => true,
                                            'no_found_rows'       => true,
                                        )
                                    );
                                    ?>
                                    <?php while ( $latest_columns->have_posts() ) : ?>
                                        <?php $latest_columns->the_post(); ?>
                                        <li>
                                            <a
                                                class="hb-archive-column__p-post-link"
                                                href="<?php the_permalink(); ?>"
                                            >
                                                <span class="hb-archive-column__p-post-thumb">
                                                    <?php if ( has_post_thumbnail() ) : ?>
                                                        <?php the_post_thumbnail( 'thumbnail' ); ?>
                                                    <?php else : ?>
                                                        <img
                                                            class="hb-archive-column__p-no-image"
                                                            src="<?php echo esc_url( get_theme_file_uri( '/images/no-image-column.png' ) ); ?>"
                                                            alt=""
                                                            width="800"
                                                            height="600"
                                                            loading="lazy"
                                                        />
                                                    <?php endif; ?>
                                                </span>
                                                <span class="hb-archive-column__p-post-body">
                                                    <span class="hb-archive-column__p-post-title">
                                                        <?php the_title(); ?>
                                                    </span>
                                                    <time
                                                        class="hb-archive-column__p-post-date"
                                                        datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"
                                                    >
                                                        <?php echo esc_html( get_the_date( 'Y年n月j日' ) ); ?>
                                                    </time>
                                                </span>
                                            </a>
                                        </li>
                                    <?php endwhile; ?>
                                    <?php wp_reset_postdata(); ?>

                                    <?php if ( false ) : ?>
                                    <li>
                                        <a
                                            class="hb-archive-column__p-post-link"
                                            href="<?php echo esc_url( home_url( '/column/' ) ); ?>"
                                        >
                                            <span
                                                class="hb-archive-column__p-post-thumb"
                                            >
                                                <img
                                                    src="https://placehold.co/176x132/eef3ee/33423a?text=New"
                                                    alt=""
                                                    width="176"
                                                    height="132"
                                                />
                                            </span>
                                            <span
                                                class="hb-archive-column__p-post-body"
                                            >
                                                <span
                                                    class="hb-archive-column__p-post-title"
                                                >
                                                    積みプラ整理で見落としやすい査定ポイント
                                                </span>
                                                <span
                                                    class="hb-archive-column__p-post-date"
                                                    >2026年6月18日</span
                                                >
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a
                                            class="hb-archive-column__p-post-link"
                                            href="<?php echo esc_url( home_url( '/column/' ) ); ?>"
                                        >
                                            <span
                                                class="hb-archive-column__p-post-thumb"
                                            >
                                                <img
                                                    src="https://placehold.co/176x132/eef3ee/33423a?text=New"
                                                    alt=""
                                                    width="176"
                                                    height="132"
                                                />
                                            </span>
                                            <span
                                                class="hb-archive-column__p-post-body"
                                            >
                                                <span
                                                    class="hb-archive-column__p-post-title"
                                                >
                                                    未開封フィギュアを売る前に確認したいこと
                                                </span>
                                                <span
                                                    class="hb-archive-column__p-post-date"
                                                    >2026年6月12日</span
                                                >
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a
                                            class="hb-archive-column__p-post-link"
                                            href="<?php echo esc_url( home_url( '/column/' ) ); ?>"
                                        >
                                            <span
                                                class="hb-archive-column__p-post-thumb"
                                            >
                                                <img
                                                    src="https://placehold.co/176x132/eef3ee/33423a?text=New"
                                                    alt=""
                                                    width="176"
                                                    height="132"
                                                />
                                            </span>
                                            <span
                                                class="hb-archive-column__p-post-body"
                                            >
                                                <span
                                                    class="hb-archive-column__p-post-title"
                                                >
                                                    レトロゲームの箱付き・説明書付きは評価される？
                                                </span>
                                                <span
                                                    class="hb-archive-column__p-post-date"
                                                    >2026年6月5日</span
                                                >
                                            </span>
                                        </a>
                                    </li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </section>

                        <?php if ( $column_popular_query->have_posts() ) : ?>
                        <section class="hb-archive-column__p-widget">
                            <div class="hb-archive-column__p-widget-inner">
                                <h2 class="hb-archive-column__p-widget-title">
                                    人気記事
                                </h2>
                                <ul
                                    class="hb-archive-column__p-post-list"
                                    role="list"
                                >
                                    <?php while ( $column_popular_query->have_posts() ) : ?>
                                        <?php $column_popular_query->the_post(); ?>
                                        <li>
                                            <a
                                                class="hb-archive-column__p-post-link"
                                                href="<?php the_permalink(); ?>"
                                            >
                                                <span class="hb-archive-column__p-post-thumb">
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
                                                            src="<?php echo esc_url( get_theme_file_uri( '/images/no-image-column.png' ) ); ?>"
                                                            alt=""
                                                            width="800"
                                                            height="600"
                                                            loading="lazy"
                                                        />
                                                    <?php endif; ?>
                                                </span>
                                                <span class="hb-archive-column__p-post-body">
                                                    <span class="hb-archive-column__p-post-title">
                                                        <?php the_title(); ?>
                                                    </span>
                                                </span>
                                            </a>
                                        </li>
                                    <?php endwhile; ?>
                                    <?php wp_reset_postdata(); ?>
                                </ul>
                            </div>
                        </section>
                        <?php endif; ?>

                        <?php if ( $column_genre_terms ) : ?>
                        <section class="hb-archive-column__p-widget">
                            <div class="hb-archive-column__p-widget-inner">
                                <h2 class="hb-archive-column__p-widget-title">
                                    カテゴリ
                                </h2>
                                <ul
                                    class="hb-archive-column__p-link-list"
                                    role="list"
                                >
                                    <?php foreach ( $column_genre_terms as $column_genre_term ) : ?>
                                        <?php $column_genre_link = get_term_link( $column_genre_term ); ?>
                                        <?php if ( ! is_wp_error( $column_genre_link ) ) : ?>
                                            <li>
                                                <a href="<?php echo esc_url( $column_genre_link ); ?>">
                                                    <?php echo esc_html( $column_genre_term->name ); ?>
                                                </a>
                                            </li>
                                        <?php endif; ?>
                                    <?php endforeach; ?>

                                    <?php if ( false ) : ?>
                                    <li>
                                        <a href="<?php echo esc_url( home_url( '/column/' ) ); ?>"
                                            >機動戦士ガンダム(ガンプラ) 買取</a
                                        >
                                    </li>
                                    <li>
                                        <a href="<?php echo esc_url( home_url( '/column/' ) ); ?>">超合金/メタルビルド 買取</a>
                                    </li>
                                    <li><a href="<?php echo esc_url( home_url( '/column/' ) ); ?>">LEGO 買取</a></li>
                                    <li><a href="<?php echo esc_url( home_url( '/column/' ) ); ?>">プラモデル 買取</a></li>
                                    <li><a href="<?php echo esc_url( home_url( '/column/' ) ); ?>">鉄道模型 買取</a></li>
                                    <li><a href="<?php echo esc_url( home_url( '/column/' ) ); ?>">ソフビ 買取</a></li>
                                    <li>
                                        <a href="<?php echo esc_url( home_url( '/column/' ) ); ?>">レトロ玩具/昭和玩具 買取</a>
                                    </li>
                                    <li><a href="<?php echo esc_url( home_url( '/column/' ) ); ?>">特撮グッズ 買取</a></li>
                                    <li><a href="<?php echo esc_url( home_url( '/column/' ) ); ?>">レトロゲーム 買取</a></li>
                                    <li><a href="<?php echo esc_url( home_url( '/column/' ) ); ?>">ミニカー 買取</a></li>
                                    <li><a href="<?php echo esc_url( home_url( '/column/' ) ); ?>">フィギュア 買取</a></li>
                                    <li><a href="<?php echo esc_url( home_url( '/column/' ) ); ?>">無線機 買取</a></li>
                                    <li>
                                        <a href="<?php echo esc_url( home_url( '/column/' ) ); ?>">デアゴスティーニ 買取</a>
                                    </li>
                                    <li><a href="<?php echo esc_url( home_url( '/column/' ) ); ?>">アシェット 買取</a></li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </section>
                        <?php endif; ?>

                        <?php if ( $column_tag_terms ) : ?>
                        <section class="hb-archive-column__p-widget">
                            <div class="hb-archive-column__p-widget-inner">
                                <h2 class="hb-archive-column__p-widget-title">
                                    タグ
                                </h2>
                                <ul
                                    class="hb-archive-column__p-tag-list"
                                    role="list"
                                >
                                    <?php foreach ( $column_tag_terms as $column_tag_term ) : ?>
                                        <?php $column_tag_link = get_term_link( $column_tag_term ); ?>
                                        <?php if ( ! is_wp_error( $column_tag_link ) ) : ?>
                                            <li>
                                                <a
                                                    class="hb-archive-column__p-tag-link"
                                                    href="<?php echo esc_url( $column_tag_link ); ?>"
                                                >
                                                    <?php echo esc_html( $column_tag_term->name ); ?>
                                                </a>
                                            </li>
                                        <?php endif; ?>
                                    <?php endforeach; ?>

                                    <?php if ( false ) : ?>
                                    <li>
                                        <a
                                            class="hb-archive-column__p-tag-link"
                                            href="<?php echo esc_url( home_url( '/column/' ) ); ?>"
                                            >積みプラ</a
                                        >
                                    </li>
                                    <li>
                                        <a
                                            class="hb-archive-column__p-tag-link"
                                            href="<?php echo esc_url( home_url( '/column/' ) ); ?>"
                                            >コレクション整理</a
                                        >
                                    </li>
                                    <li>
                                        <a
                                            class="hb-archive-column__p-tag-link"
                                            href="<?php echo esc_url( home_url( '/column/' ) ); ?>"
                                            >引退</a
                                        >
                                    </li>
                                    <li>
                                        <a
                                            class="hb-archive-column__p-tag-link"
                                            href="<?php echo esc_url( home_url( '/column/' ) ); ?>"
                                            >遺品整理/生前整理</a
                                        >
                                    </li>
                                    <li>
                                        <a
                                            class="hb-archive-column__p-tag-link"
                                            href="<?php echo esc_url( home_url( '/column/' ) ); ?>"
                                            >限定品</a
                                        >
                                    </li>
                                    <li>
                                        <a
                                            class="hb-archive-column__p-tag-link"
                                            href="<?php echo esc_url( home_url( '/column/' ) ); ?>"
                                            >未開封</a
                                        >
                                    </li>
                                    <li>
                                        <a
                                            class="hb-archive-column__p-tag-link"
                                            href="<?php echo esc_url( home_url( '/column/' ) ); ?>"
                                            >ガンプラ</a
                                        >
                                    </li>
                                    <li>
                                        <a
                                            class="hb-archive-column__p-tag-link"
                                            href="<?php echo esc_url( home_url( '/column/' ) ); ?>"
                                            >フィギュア</a
                                        >
                                    </li>
                                    <li>
                                        <a
                                            class="hb-archive-column__p-tag-link"
                                            href="<?php echo esc_url( home_url( '/column/' ) ); ?>"
                                            >超合金</a
                                        >
                                    </li>
                                    <li>
                                        <a
                                            class="hb-archive-column__p-tag-link"
                                            href="<?php echo esc_url( home_url( '/column/' ) ); ?>"
                                            >レトロゲーム</a
                                        >
                                    </li>
                                    <li>
                                        <a
                                            class="hb-archive-column__p-tag-link"
                                            href="<?php echo esc_url( home_url( '/column/' ) ); ?>"
                                            >ジャンク</a
                                        >
                                    </li>
                                    <li>
                                        <a
                                            class="hb-archive-column__p-tag-link"
                                            href="<?php echo esc_url( home_url( '/column/' ) ); ?>"
                                            >大量買取</a
                                        >
                                    </li>
                                    <li>
                                        <a
                                            class="hb-archive-column__p-tag-link"
                                            href="<?php echo esc_url( home_url( '/column/' ) ); ?>"
                                            >宅配買取</a
                                        >
                                    </li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </section>
                        <?php endif; ?>
                    </aside>
                    <?php endif; ?>
                </div>
            </section>
        </main>

        <?php get_template_part( 'template-parts/common/footer-cta' ); ?>
        <?php get_footer(); ?>
