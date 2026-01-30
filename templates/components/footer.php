<footer class="footer">
    <div class="container pt-4 pb-4" style="max-width: 100vw;">
        <div class="row g-2">

            <div class="col-lg-100 col-md-6 pl-4">
                <?php if (SHOP_DATA->footer_text): ?>
                    <p class="footer-text">
                        <?= SHOP_DATA->footer_text ?>
                    </p>
                <?php endif; ?>
            </div>

            <!-- Contacto -->
            <div class="col-100 pl-4">
                <?php if (SHOP_DATA->contact_email): ?>
                    <div class="footer-item">
                        <i class="fas fa-envelope"></i>
                        <a href="mailto:<?= SHOP_DATA->contact_email ?>">
                            <?= SHOP_DATA->contact_email ?>
                        </a>
                    </div>
                <?php endif; ?>

                <?php if (SHOP_DATA->contact_phone): ?>
                    <div class="footer-item">
                        <i class="fas fa-phone"></i>
                        <a href="tel:<?= SHOP_DATA->contact_phone ?>">
                            <?= SHOP_DATA->contact_phone ?>
                        </a>
                    </div>
                <?php endif; ?>

                <?php if (SHOP_DATA->whatsapp): ?>
                    <div class="footer-item">
                        <i class="fab fa-whatsapp"></i>
                        <a href="https://api.whatsapp.com/send?phone=<?= str_replace(' ', '', SHOP_DATA->whatsapp) ?>" target="_blank">
                            <?= SHOP_DATA->whatsapp ?>
                        </a>
                    </div>
                <?php endif; ?>

                <?php if (SHOP_DATA->address || SHOP_DATA->city || SHOP_DATA->postal_code): ?>
                    <div class="footer-item align-start">
                        <i class="fas fa-map-marker-alt"></i>
                        <p class="text-white p-0 m-0" style="max-width: 30vw;">
                            <?= SHOP_DATA->address ?? '' ?> <?= trim((SHOP_DATA->postal_code ?? '') . ' ' . (SHOP_DATA->city ?? '')) ?> <?= SHOP_DATA->country ?? '' ?>
                        </p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Social + copyright -->
            <div class="col-lg-100 justify-content-center d-flex flex-column">

                <div class="footer-social justify-content-center d-flex flex-row ">
                    <?php if (SHOP_DATA->facebook_url): ?>
                        <a href="<?= SHOP_DATA->facebook_url ?>" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    <?php endif; ?>
                    <?php if (SHOP_DATA->instagram_url): ?>
                        <a href="<?= SHOP_DATA->instagram_url ?>" target="_blank"><i class="fab fa-instagram"></i></a>
                    <?php endif; ?>
                    <?php if (SHOP_DATA->twitter_url): ?>
                        <a href="<?= SHOP_DATA->twitter_url ?>" target="_blank"><i class="fab fa-twitter"></i></a>
                    <?php endif; ?>
                    <?php if (SHOP_DATA->tiktok_url): ?>
                        <a href="<?= SHOP_DATA->tiktok_url ?>" target="_blank"><i class="fab fa-tiktok"></i></a>
                    <?php endif; ?>
                    <?php if (SHOP_DATA->youtube_url): ?>
                        <a href="<?= SHOP_DATA->youtube_url ?>" target="_blank"><i class="fab fa-youtube"></i></a>
                    <?php endif; ?>
                </div>

                <?php if (SHOP_DATA->copyright_text): ?>
                    <div class="footer-bottom pl-2">
                        <small><?= SHOP_DATA->copyright_text ?></small><br>
                        <small>
                            Desarrollado por
                            <a href="https://aruger.dev">Aruger.dev</a>
                        </small>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </div>

    <style>
        .footer {
            font-size: 0.9rem;
            background-color: var(--secondary);
            color: var(--text-color);
        }

        .footer-title {
            font-size: 0.95rem;
            text-transform: uppercase;
            margin-bottom: 0.75rem;
            letter-spacing: .04em;
        }

        .footer-block {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .footer-item {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            line-height: 1.3;
        }

        .footer-item.align-start {
            align-items: flex-start;
        }

        .footer-item i {
            color: var(--bg-color);
            font-size: 0.9rem;
            margin-top: 2px;
        }

        .footer a {
            color: #fff;
            text-decoration: none;
        }

        .footer-text {
            font-size: 0.85rem;
            line-height: 1.5;
        }

        .footer-social {
            display: flex;
            gap: 0.75rem;
            margin-bottom: 1rem;
        }

        .footer-social a {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all .2s ease;
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, .15);
            padding-top: 0.75rem;
            font-size: 0.75rem;
            color: var(--text-color);
        }

        @media (max-width: 768px) {
            .footer {
                text-align: center;
            }

            .footer-item {
                justify-content: center;
            }

            .footer-social {
                justify-content: center;
            }
        }
    </style>
</footer>