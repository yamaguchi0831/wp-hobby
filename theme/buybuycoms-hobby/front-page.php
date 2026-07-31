<?php
/**
 * Static first-stage template generated from pages/front.html.
 *
 * @package BuyBuyComs_Hobby
 */
?>
<!-- ============================== HEADER ============================== -->
        <?php get_header(); ?>

        <main id="main-content">
            <!-- ============================== HERO ============================== -->
            <section class="hb-front__p-hero" data-screen-label="02 Hero">
                <div class="hb-front__p-hero__bg" aria-hidden="true"></div>
                <div class="hb__l-container hb-front__p-hero__inner">
                    <div class="hb-front__p-hero__copy">
                        <div class="hb-front__p-hero__ribbon">
                            <span
                                >プラモデル・フィギュア・超合金・鉄道模型など</span
                            >
                            <strong>ホビー全般 お任せください！</strong>
                        </div>
                        <h1 class="hb-front__p-hero__title">
                            <span>大切なホビーを、</span>
                            <span class="hb-front__p-hero__title-accent"
                                >まとめて高く</span
                            >
                            <span>買取ります！</span>
                        </h1>
                        <div class="hb-front__p-hero__badge">
                            大量の<br />コレクションも<br />大歓迎！
                        </div>
                        <p class="hb-front__p-hero__lead">
                            専門スタッフが一点ずつ丁寧に査定します
                        </p>
                    </div>

                    <div class="hb-front__p-hero__visual">
                        <img
                            class="hb-front__p-hero__visual-img"
                            src="<?php echo esc_url( get_theme_file_uri( '/images/mv01.webp' ) ); ?>"
                            alt="ホビー商品の集合イメージ"
                            width="980"
                            height="720"
                        />
                    </div>

                    <div class="hb-front__p-hero__action">
                        <div class="hb-front__p-hero__ctas">
                            <a
                                href="#cta"
                                class="hb-front__p-hero__cta hb-front__p-hero__cta--primary"
                            >
                                <img
                                    src="<?php echo esc_url( get_theme_file_uri( '/images/icon/icon-cta_satei.svg' ) ); ?>"
                                    alt=""
                                    width="40"
                                    height="40"
                                />
                                <span>無料査定を申し込む</span>
                                <span
                                    class="hb-front__p-hero__cta-arrow"
                                    aria-hidden="true"
                                    >›</span
                                >
                            </a>
                            <a
                                href="#cta"
                                class="hb-front__p-hero__cta hb-front__p-hero__cta--line"
                            >
                                <img
                                    src="<?php echo esc_url( get_theme_file_uri( '/images/icon/icon-cta_line.svg' ) ); ?>"
                                    alt=""
                                    width="40"
                                    height="40"
                                />
                                <span>LINEで写真査定する</span>
                                <span
                                    class="hb-front__p-hero__cta-arrow"
                                    aria-hidden="true"
                                    >›</span
                                >
                            </a>
                            <img
                                class="hb-front__p-hero-image-box"
                                src="<?php echo esc_url( get_theme_file_uri( '/images/background/bg03.webp' ) ); ?>"
                                alt=""
                            />
                            <img
                                class="hb-front__p-hero-image-doll"
                                src="<?php echo esc_url( get_theme_file_uri( '/images/background/bg04.webp' ) ); ?>"
                                alt=""
                            />
                        </div>
                    </div>

                    <ul class="hb-front__p-hero__benefits" role="list">
                        <li class="hb-front__p-hero__benefit">
                            <img
                                src="<?php echo esc_url( get_theme_file_uri( '/images/icon/icon_souryou.svg' ) ); ?>"
                                alt=""
                                width="54"
                                height="54"
                            />
                            <span
                                ><strong>送料無料・手数料無料</strong
                                >すべて当社負担！</span
                            >
                        </li>
                        <li class="hb-front__p-hero__benefit">
                            <img
                                src="<?php echo esc_url( get_theme_file_uri( '/images/icon/icon-sokujitusatei.svg' ) ); ?>"
                                alt=""
                                width="54"
                                height="54"
                            />
                            <span
                                ><strong>即日査定・スピード対応</strong
                                >最短当日入金も可能！</span
                            >
                        </li>
                        <li class="hb-front__p-hero__benefit">
                            <img
                                src="<?php echo esc_url( get_theme_file_uri( '/images/icon/icon-takuhai_kit.svg' ) ); ?>"
                                alt=""
                                width="54"
                                height="54"
                            />
                            <span
                                ><strong>箱に詰めて送るだけ</strong
                                >宅配キット無料！</span
                            >
                        </li>
                        <li class="hb-front__p-hero__benefit">
                            <img
                                src="<?php echo esc_url( get_theme_file_uri( '/images/icon/icon-senmonsutahu.svg' ) ); ?>"
                                alt=""
                                width="54"
                                height="54"
                            />
                            <span
                                ><strong>専門スタッフが丁寧に査定</strong
                                >価値をしっかり評価！</span
                            >
                        </li>
                    </ul>
                </div>
            </section>

            <!-- ============================== 03. CATEGORIES ============================== -->
            <section
                class="hb__l-section hb-front__l-section--soft"
                id="categories"
                data-screen-label="03 買取品目"
            >
                <div class="hb__l-container">
                    <header
                        class="hb-front__c-section-head hb-front__c-section-head--center"
                    >
                        <span class="hb-front__c-section-head__kicker"
                            >Categories</span
                        >
                        <h2 class="hb-front__c-section-head__title">
                            幅広い <span class="hb-front__c-hl">買取品目</span>
                        </h2>
                        <p class="hb-front__c-section-head__lead">
                            ホビー・コレクター品なら、ジャンルを問わず査定可能です。
                        </p>
                    </header>

                    <?php get_template_part( 'template-parts/common/genre-table' ); ?>
                </div>
            </section>

            <!-- ============================== 04. CASES ============================== -->
            <section
                class="hb__l-section"
                id="cases"
                data-screen-label="04 買取実績"
            >
                <div class="hb__l-container">
                    <header
                        class="hb-front__c-section-head hb-front__c-section-head--center"
                    >
                        <span class="hb-front__c-section-head__kicker"
                            >Cases</span
                        >
                        <h2 class="hb-front__c-section-head__title">
                            最近の <span class="hb-front__c-hl">買取実績</span>
                        </h2>
                        <p class="hb-front__c-section-head__lead">
                            どんなコレクションが、どんな金額になったのか。実例をご紹介します。
                        </p>
                    </header>

                    <?php get_template_part( 'template-parts/common/purchase-records' ); ?>
                </div>
            </section>
            <!-- ============================== 05. RECOMMENDED FOR ============================== -->
            <section
                class="hb__l-section hb-front__l-section--soft"
                id="recommend"
                data-screen-label="05 こんな人におすすめ"
            >
                <div class="hb__l-container">
                    <header class="hb-front__c-section-head">
                        <span class="hb-front__c-section-head__kicker"
                            >For Collectors</span
                        >
                        <h2 class="hb-front__c-section-head__title">
                            こんな人に
                            <span class="hb-front__c-hl">おすすめ</span>
                        </h2>
                        <p class="hb-front__c-section-head__lead">
                            コレクションが部屋を占領していませんか？
                            引退・引っ越し・遺品整理・在庫整理まで、<br />
                            ホビーに関わる「手放したい」をまとめて引き受けます。
                        </p>
                    </header>

                    <div class="hb-front__p-checklist">
                        <ul class="hb-front__p-checklist__list" role="list">
                            <li class="hb-front__p-checklist__item">
                                <span
                                    class="hb-front__p-checklist__check"
                                    aria-hidden="true"
                                ></span
                                ><span
                                    >積みプラ・未組立プラモデルが増えすぎた人</span
                                >
                            </li>
                            <li class="hb-front__p-checklist__item">
                                <span
                                    class="hb-front__p-checklist__check"
                                    aria-hidden="true"
                                ></span
                                ><span
                                    >コレクション引退・趣味じまいをお考えの方へ</span
                                >
                            </li>
                            <li class="hb-front__p-checklist__item">
                                <span
                                    class="hb-front__p-checklist__check"
                                    aria-hidden="true"
                                ></span
                                ><span>引っ越し・片付け前の大量整理に</span>
                            </li>
                            <li class="hb-front__p-checklist__item">
                                <span
                                    class="hb-front__p-checklist__check"
                                    aria-hidden="true"
                                ></span
                                ><span>部屋・押し入れ・倉庫を片付けたい人</span>
                            </li>
                            <li class="hb-front__p-checklist__item">
                                <span
                                    class="hb-front__p-checklist__check"
                                    aria-hidden="true"
                                ></span
                                ><span
                                    >遺品整理・家族のコレクション整理をしたい人</span
                                >
                            </li>
                            <li class="hb-front__p-checklist__item">
                                <span
                                    class="hb-front__p-checklist__check"
                                    aria-hidden="true"
                                ></span
                                ><span>生前整理をしたい人</span>
                            </li>
                            <li class="hb-front__p-checklist__item">
                                <span
                                    class="hb-front__p-checklist__check"
                                    aria-hidden="true"
                                ></span
                                ><span
                                    >フリマアプリ・オークションが面倒な人</span
                                >
                            </li>
                            <li class="hb-front__p-checklist__item">
                                <span
                                    class="hb-front__p-checklist__check"
                                    aria-hidden="true"
                                ></span
                                ><span
                                    >会社・店舗・倉庫の在庫を整理したい人</span
                                >
                            </li>
                        </ul>
                    </div>
                </div>
            </section>

            <!-- ============================== 06. METHODS ============================== -->
            <section
                class="hb__l-section hb-front__l-section--soft"
                id="methods"
                data-screen-label="06 買取方法"
            >
                <div class="hb__l-container">
                    <header
                        class="hb-front__c-section-head hb-front__c-section-head--center"
                    >
                        <span class="hb-front__c-section-head__kicker"
                            >Methods</span
                        >
                        <h2 class="hb-front__c-section-head__title">
                            あなたに合わせて選べる、<br /><span
                                class="hb-front__c-hl"
                                >3つの買取方法</span
                            >
                        </h2>
                    </header>

                    <?php get_template_part( 'template-parts/common/purchase-methods' ); ?>
                </div>
            </section>
            <!-- ============================== 07. FLOW ============================== -->
            <section
                class="hb__l-section"
                id="flow"
                data-screen-label="07 買取の流れ"
            >
                <div class="hb__l-container hb__p-flow">
                    <header
                        class="hb-front__c-section-head hb-front__c-section-head--center"
                    >
                        <span class="hb-front__c-section-head__kicker"
                            >How it works</span
                        >
                        <h2 class="hb-front__c-section-head__title">
                            買取の <span class="hb-front__c-hl">流れ</span>
                        </h2>
                        <p class="hb-front__c-section-head__lead">
                            量・距離・進め方に合わせて選べる3つの方法を、タブで確認できます。
                        </p>
                    </header>

                    <?php get_template_part( 'template-parts/common/flow-tab' ); ?>
                </div>
            </section>

            <!-- ============================== 08. PRICE TABLE ============================== -->
            <section
                class="hb__l-section hb-front__l-section--soft"
                id="prices"
                data-screen-label="08 買取価格の目安"
            >
                <div class="hb__l-container">
                    <header
                        class="hb-front__c-section-head hb-front__c-section-head--center"
                    >
                        <span class="hb-front__c-section-head__kicker"
                            >Top prices</span
                        >
                        <h2 class="hb-front__c-section-head__title">
                            買取価格の <span class="hb-front__c-hl">目安</span>
                        </h2>
                        <p class="hb-front__c-section-head__lead">
                            代表的な高価買取アイテムの相場をご紹介します。
                        </p>
                    </header>

                    <?php get_template_part( 'template-parts/common/purchase-price-table' ); ?>
                </div>
            </section>
            <!-- ============================== 09. REASONS ============================== -->
            <section
                class="hb__l-section"
                id="reasons"
                data-screen-label="09 選ばれる理由"
            >
                <div class="hb__l-container">
                    <header
                        class="hb-front__c-section-head hb-front__c-section-head--center"
                    >
                        <span class="hb-front__c-section-head__kicker"
                            >Why Us</span
                        >
                        <h2 class="hb-front__c-section-head__title">
                            バイバイコムズが
                            <span class="hb-front__c-hl">選ばれる理由</span>
                        </h2>
                        <p class="hb-front__c-section-head__lead">
                            創業40年・古物商として培ったホビーの目利きと、手数料ゼロのシンプルな仕組み。
                        </p>
                    </header>

                    <div class="hb-front__p-reasons">
                        <article class="hb-front__p-reason">
                            <figure class="hb-front__p-reason__image">
                                <img
                                    src="<?php echo esc_url( get_theme_file_uri( '/images/front-reason01.webp' ) ); ?>"
                                    alt=""
                                    width="1000"
                                    height="750"
                                />
                            </figure>
                            <h3 class="hb-front__p-reason__title">
                                専門査定士による目利き
                            </h3>
                            <p class="hb-front__p-reason__text">
                                フィギュア・プラモデル・レトロ玩具・鉄道模型など、各ジャンル専任の査定士が在籍。相場・希少性・状態を踏まえて、1点ずつ価値を見極めます。
                            </p>
                        </article>

                        <article class="hb-front__p-reason">
                            <figure class="hb-front__p-reason__image">
                                <img
                                    src="<?php echo esc_url( get_theme_file_uri( '/images/front-reason02.webp' ) ); ?>"
                                    alt=""
                                    width="1000"
                                    height="750"
                                />
                            </figure>
                            <h3 class="hb-front__p-reason__title">
                                査定料・出張費・手数料はゼロ
                            </h3>
                            <p class="hb-front__p-reason__text">
                                査定にかかる費用は一切かかりません。「査定だけ」でも気軽に試せます。
                            </p>
                        </article>

                        <article class="hb-front__p-reason">
                            <figure class="hb-front__p-reason__image">
                                <img
                                    src="<?php echo esc_url( get_theme_file_uri( '/images/front-reason03.webp' ) ); ?>"
                                    alt=""
                                    width="1000"
                                    height="750"
                                />
                            </figure>
                            <h3 class="hb-front__p-reason__title">
                                個人情報保護の徹底
                            </h3>
                            <p class="hb-front__p-reason__text">
                                SSL通信・古物営業法に基づく管理を徹底。お客様情報を第三者に開示することはありませんので安心してご利用いただけます。
                            </p>
                        </article>

                        <article class="hb-front__p-reason">
                            <figure class="hb-front__p-reason__image">
                                <img
                                    src="<?php echo esc_url( get_theme_file_uri( '/images/front-reason04.webp' ) ); ?>"
                                    alt=""
                                    width="1000"
                                    height="750"
                                />
                            </figure>
                            <h3 class="hb-front__p-reason__title">
                                1点から、大量まで買取可能
                            </h3>
                            <p class="hb-front__p-reason__text">
                                「思い入れの1点だけ」も「段ボール100箱」も大歓迎。1点ごとに丁寧に査定をしますので納得して手放せます。
                            </p>
                        </article>
                    </div>
                </div>
            </section>

            <!-- ============================== 10. REVIEWS ============================== -->
            <section
                class="hb__l-section"
                id="reviews"
                data-screen-label="10 お客様の声"
            >
                <div class="hb__l-container">
                    <header
                        class="hb-front__c-section-head hb-front__c-section-head--center"
                    >
                        <span class="hb-front__c-section-head__kicker"
                            >Reviews</span
                        >
                        <h2 class="hb-front__c-section-head__title">
                            お客様の <span class="hb-front__c-hl">声</span>
                        </h2>
                        <p class="hb-front__c-section-head__lead">
                            実際にご利用いただいたお客様からのレビューです。
                        </p>
                    </header>

                    <?php get_template_part( 'template-parts/common/customer-reviews' ); ?>
                </div>
            </section>

            <!-- ============================== 11. FAQ ============================== -->
            <section
                class="hb__l-section hb-front__l-section--soft"
                id="faq"
                data-screen-label="11 FAQ"
            >
                <div class="hb__l-container hb__l-container--sm">
                    <header
                        class="hb-front__c-section-head hb-front__c-section-head--center"
                    >
                        <span class="hb-front__c-section-head__kicker"
                            >FAQ</span
                        >
                        <h2 class="hb-front__c-section-head__title">
                            よくある <span class="hb-front__c-hl">質問</span>
                        </h2>
                    </header>

                    <div class="hb-faq__p-faq-list">
                        <article class="hb-faq__p-faq-item">
                            <button
                                class="hb-faq__p-faq-question"
                                type="button"
                                aria-expanded="false"
                            >
                                <span
                                    class="hb-faq__p-faq-icon hb-faq__p-faq-icon--q"
                                    >Q</span
                                >
                                <span
                                    >送料・査定料・返送料は本当に無料ですか？</span
                                >
                                <span class="hb-faq__p-faq-toggle">＋</span>
                            </button>
                            <div class="hb-faq__p-faq-answer">
                                <span
                                    class="hb-faq__p-faq-icon hb-faq__p-faq-icon--a"
                                    >A</span
                                >
                                <div class="hb-faq__p-faq-answer-body">
                                    <p class="hb-faq__p-faq-text">
                                        はい、すべて無料です。査定金額にご納得いただけず返送される場合も、返送料は当社負担です。
                                        「とりあえず査定だけ」というご相談も大歓迎ですので、お気軽にお申込みください。
                                    </p>
                                </div>
                                <?php get_template_part( 'template-parts/common/parts-cta' ); ?>
                            </div>
                        </article>

                        <article class="hb-faq__p-faq-item">
                            <button
                                class="hb-faq__p-faq-question"
                                type="button"
                                aria-expanded="false"
                            >
                                <span
                                    class="hb-faq__p-faq-icon hb-faq__p-faq-icon--q"
                                    >Q</span
                                >
                                <span
                                    >箱なし・付属品なしでも買取してもらえますか？</span
                                >
                                <span class="hb-faq__p-faq-toggle">＋</span>
                            </button>
                            <div class="hb-faq__p-faq-answer">
                                <span
                                    class="hb-faq__p-faq-icon hb-faq__p-faq-icon--a"
                                    >A</span
                                >
                                <div class="hb-faq__p-faq-answer-body">
                                    <p class="hb-faq__p-faq-text">
                                        買取可能です。ただし、箱・説明書・付属品が揃っているほうが査定金額は高くなる傾向にあります。
                                        状態に不安がある場合も、ひとまず査定にお出しください。1点ずつ丁寧に査定いたします。
                                    </p>
                                </div>
                                <?php get_template_part( 'template-parts/common/parts-cta' ); ?>
                            </div>
                        </article>

                        <article class="hb-faq__p-faq-item">
                            <button
                                class="hb-faq__p-faq-question"
                                type="button"
                                aria-expanded="false"
                            >
                                <span
                                    class="hb-faq__p-faq-icon hb-faq__p-faq-icon--q"
                                    >Q</span
                                >
                                <span>何点から買取してもらえますか？</span>
                                <span class="hb-faq__p-faq-toggle">＋</span>
                            </button>
                            <div class="hb-faq__p-faq-answer">
                                <span
                                    class="hb-faq__p-faq-icon hb-faq__p-faq-icon--a"
                                    >A</span
                                >
                                <div class="hb-faq__p-faq-answer-body">
                                    <p class="hb-faq__p-faq-text">
                                        1点からお預かりいたします。逆に、段ボール30箱以上の大量買取にも対応可能ですので、
                                        量を気にせずまとめてお送りください。
                                    </p>
                                </div>
                                <?php get_template_part( 'template-parts/common/parts-cta' ); ?>
                            </div>
                        </article>

                        <article class="hb-faq__p-faq-item">
                            <button
                                class="hb-faq__p-faq-question"
                                type="button"
                                aria-expanded="false"
                            >
                                <span
                                    class="hb-faq__p-faq-icon hb-faq__p-faq-icon--q"
                                    >Q</span
                                >
                                <span>入金までどのくらいかかりますか？</span>
                                <span class="hb-faq__p-faq-toggle">＋</span>
                            </button>
                            <div class="hb-faq__p-faq-answer">
                                <span
                                    class="hb-faq__p-faq-icon hb-faq__p-faq-icon--a"
                                    >A</span
                                >
                                <div class="hb-faq__p-faq-answer-body">
                                    <p class="hb-faq__p-faq-text">
                                        商品到着から最短当日に査定、ご承諾いただいたあと最短1営業日でお振込みします。
                                        点数が多い場合は2〜3営業日いただくことがあります。
                                    </p>
                                </div>
                                <?php get_template_part( 'template-parts/common/parts-cta' ); ?>
                            </div>
                        </article>

                        <article class="hb-faq__p-faq-item">
                            <button
                                class="hb-faq__p-faq-question"
                                type="button"
                                aria-expanded="false"
                            >
                                <span
                                    class="hb-faq__p-faq-icon hb-faq__p-faq-icon--q"
                                    >Q</span
                                >
                                <span
                                    >査定金額に納得できない場合はどうなりますか？</span
                                >
                                <span class="hb-faq__p-faq-toggle">＋</span>
                            </button>
                            <div class="hb-faq__p-faq-answer">
                                <span
                                    class="hb-faq__p-faq-icon hb-faq__p-faq-icon--a"
                                    >A</span
                                >
                                <div class="hb-faq__p-faq-answer-body">
                                    <p class="hb-faq__p-faq-text">
                                        キャンセル可能です。当社負担で全品を元の状態でご返送いたします。
                                        キャンセル料・返送料はかかりません。
                                    </p>
                                </div>
                                <?php get_template_part( 'template-parts/common/parts-cta' ); ?>
                            </div>
                        </article>

                        <article class="hb-faq__p-faq-item">
                            <button
                                class="hb-faq__p-faq-question"
                                type="button"
                                aria-expanded="false"
                            >
                                <span
                                    class="hb-faq__p-faq-icon hb-faq__p-faq-icon--q"
                                    >Q</span
                                >
                                <span
                                    >個人情報はどのように管理されていますか？</span
                                >
                                <span class="hb-faq__p-faq-toggle">＋</span>
                            </button>
                            <div class="hb-faq__p-faq-answer">
                                <span
                                    class="hb-faq__p-faq-icon hb-faq__p-faq-icon--a"
                                    >A</span
                                >
                                <div class="hb-faq__p-faq-answer-body">
                                    <p class="hb-faq__p-faq-text">
                                        SSL通信による暗号化、および古物営業法に基づく管理を徹底しています。
                                        お客様情報を第三者に開示・販売することは一切ありません。
                                    </p>
                                </div>
                                <?php get_template_part( 'template-parts/common/parts-cta' ); ?>
                            </div>
                        </article>
                    </div>
                </div>
            </section>

            <!-- ============================== 12. NEWS ============================== -->
            <section
                class="hb__l-section"
                id="news"
                data-screen-label="12 お知らせ"
            >
                <div class="hb__l-container hb__l-container--sm">
                    <header class="hb-front__c-section-head">
                        <span class="hb-front__c-section-head__kicker"
                            >News</span
                        >
                        <h2 class="hb-front__c-section-head__title">
                            新着・お知らせ
                        </h2>
                    </header>

                    <?php
                    $news_query = new WP_Query(
                        array(
                            'post_type'           => 'post',
                            'post_status'         => 'publish',
                            'posts_per_page'      => 5,
                            'orderby'             => 'date',
                            'order'               => 'DESC',
                            'ignore_sticky_posts' => true,
                            'no_found_rows'       => true,
                        )
                    );
                    ?>
                    <ul class="hb-front__p-news" role="list">
                        <?php if ( $news_query->have_posts() ) : ?>
                            <?php
                            while ( $news_query->have_posts() ) :
                                $news_query->the_post();
                                $news_categories = get_the_category();
                                $news_category   = $news_categories
                                    ? $news_categories[0]->name
                                    : __( 'お知らせ', 'buybuycoms-hobby' );
                                ?>
                                <li class="hb-front__p-news__item">
                                    <time
                                        class="hb-front__p-news__date"
                                        datetime="<?php echo esc_attr( get_the_date( 'Y-m-d' ) ); ?>"
                                    >
                                        <?php echo esc_html( get_the_date( 'Y.m.d' ) ); ?>
                                    </time>
                                    <span class="hb-front__p-news__cat">
                                        <?php echo esc_html( $news_category ); ?>
                                    </span>
                                    <a
                                        class="hb-front__p-news__link"
                                        href="<?php echo esc_url( get_permalink() ); ?>"
                                    >
                                        <?php echo esc_html( get_the_title() ); ?>
                                    </a>
                                </li>
                            <?php endwhile; ?>
                        <?php else : ?>
                            <li class="hb-front__p-news__item">
                                <span class="hb-front__p-news__empty">
                                    <?php esc_html_e( 'まだお知らせはありません', 'buybuycoms-hobby' ); ?>
                                </span>
                            </li>
                        <?php endif; ?>
                    </ul>
                    <?php wp_reset_postdata(); ?>

                    <div
                        class="hb-front__c-section-more hb-front__c-section-more--left"
                    >
                        <?php
                        $posts_page_id   = (int) get_option( 'page_for_posts' );
                        $news_archive_url = $posts_page_id
                            ? get_permalink( $posts_page_id )
                            : home_url( '/info/' );
                        ?>
                        <a href="<?php echo esc_url( $news_archive_url ); ?>" class="hb-front__c-link"
                            >お知らせをもっと見る →</a
                        >
                    </div>
                </div>
            </section>

            <!-- ============================== 13. CTA ============================== -->
            <?php get_template_part( 'template-parts/common/footer-cta' ); ?>
        </main>

        <!-- ============================== 14. FOOTER ============================== -->
        <?php get_footer(); ?>
