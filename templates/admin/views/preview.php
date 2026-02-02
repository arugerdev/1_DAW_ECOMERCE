<?php
$_SERVER['REQUEST_URI'] = '/';

$is_manteining = function () {
    return false;
};

function process_links($buffer)
{
    $dom = new DOMDocument();

    libxml_use_internal_errors(true);

    $dom->loadHTML($buffer);
    libxml_clear_errors();

    $links = $dom->getElementsByTagName('a');

    foreach ($links as $link) {
        $href = $link->getAttribute('href');

        if (
            !empty($href) &&
            strpos($href, 'http') !== 0 &&
            strpos($href, '#') !== 0 &&
            strpos($href, 'mailto:') !== 0 &&
            strpos($href, 'tel:') !== 0 &&
            strpos($href, '/admin/preview') !== 0 &&
            strpos($href, 'javascript:') !== 0
        ) {

            // Mantener los parámetros de consulta si existen
            $parsed_url = parse_url($href);
            $path = $parsed_url['path'] ?? $href;
            $query = isset($parsed_url['query']) ? '&' . $parsed_url['query'] : '';

            // Construir el nuevo enlace
            $new_href = '/admin/preview?url=' . urlencode($path) . $query;

            // Preservar cualquier fragmento (#anchor)
            if (isset($parsed_url['fragment'])) {
                $new_href .= '#' . $parsed_url['fragment'];
            }

            $link->setAttribute('href', $new_href);
        }
    }

    return $dom->saveHTML();
}

?>

<style>
    :root {
        --primary-color: <?php echo SHOP_DATA->primary_color ?>;
        --accent-color: <?php echo SHOP_DATA->accent_color ?>;
        --secondary-color: <?php echo SHOP_DATA->secondary_color ?>;
        --bg-color: <?php echo SHOP_DATA->background_color ?>;
        --text-color: <?php echo SHOP_DATA->text_color ?>;

        /* Colores base */
        --bs-primary: <?php echo SHOP_DATA->primary_color ?>;
        --bs-secondary: <?php echo SHOP_DATA->secondary_color ?>;
        --bs-success: <?php echo SHOP_DATA->accent_color ?>;
        --bs-body-bg: <?php echo SHOP_DATA->background_color ?>;
        --bs-body-color: <?php echo SHOP_DATA->text_color ?>;

        /* RGB (OBLIGATORIO para botones, outlines, hovers, etc) */
        --bs-primary-rgb: <?php echo implode(',', sscanf(SHOP_DATA->primary_color, "#%02x%02x%02x")); ?>;
        --bs-secondary-rgb: <?php echo implode(',', sscanf(SHOP_DATA->secondary_color, "#%02x%02x%02x")); ?>;
        --bs-success-rgb: <?php echo implode(',', sscanf(SHOP_DATA->accent_color, "#%02x%02x%02x")); ?>;
    }

    .bg {
        background-color: var(--bg-color);
    }

    .text-bg {
        color: var(--bg-color);
    }

    p,
    a,
    button,
    li,
    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    .text,
    .nav-link {
        color: var(--text-color);
    }

    .nav-link,
    a {
        color: var(--text-color);
    }

    .nav-link:hover,
    .nav-link:focus,
    a:hover {
        color: var(--accent-color);
    }

    .dropdown-item:active {
        background-color: var(--primary-color);

    }

    .btn,
    .btn-outline-dark,
    button {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
        color: var(--bg-color);
    }

    .btn:hover,
    .btn-outline-dark:hover,
    button:hover {
        background-color: var(--accent-color);
        border-color: var(--accent-color);
        color: var(--bg-color);

    }

    .navbar-toggler:hover {
        background-color: transparent;
        border-color: transparent;
    }

    .nav-tabs .nav-item.show .nav-link,
    .nav-tabs .nav-link.active,
    .nav-tabs>li>.active {
        background-color: var(--secondary-color);
        border-color: var(--primary-color);
        border-radius: 4px;
    }

    .nav-tabs {
        background-color: transparent;
        border-color: var(--primary-color);
        border-radius: 4px;

    }

    .nav-tabs>li,
    .nav-tabs>li>button {
        background-color: var(--primary-color);
        color: var(--bg-color);

    }

    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
    }


    .text-danger {
        color: #dc3545;
    }

    .btn-danger:hover {
        background-color: #e7707c;
        border-color: #e7707c;
    }

    .dropdown-menu,
    .card {
        background-color: var(--secondary-color);
        color: var(--text-color);
    }

    .form-control,
    input {
        background-color: var(--bg-color);
        color: var(--text-color);
    }

    .form-check-input:checked {
        background-color: var(--accent-color);
        border-color: var(--accent-color);
    }
</style>

<body class="sidebar-mini sidebar-collapse layout-fixed bg">
    <main>
        <?php
        ob_start();

        $url = $_REQUEST['url'] ?? '/';

        switch ($url) {
            case "/":
                include "./templates/index.php";
                break;
            case "/terms":
                include "./templates/views/terms.php";
                break;
            case "/privacy":
                include "./templates/views/privacy.php";
                break;

            case "/products":
                include "./templates/views/products.php";
                break;
            case "/products/category":
                include "./templates/views/products_category.php";
                break;
            case "/product":
                include "./templates/views/product.php";
                break;
            case "/cart":
                include "./templates/views/cart.php";
                break;
            case "/orders":
                include "./templates/views/orders.php";
                break;
            case "/login":
                include "./templates/views/login.php";
                break;
            case "/register":
                include "./templates/views/register.php";
                break;
            case "/checkout":
                include "./templates/views/checkout.php";
                break;
            case "/checkout/confirm":
                include "./templates/views/checkout_confirm.php";
                break;
            case "/checkout/success":
                include "./templates/views/checkout_success.php";
                break;
            default:
                http_response_code(404);
                include "./templates/views/404.php";
                break;
        }
        $output = ob_get_contents();
        ob_end_clean();
        $output = process_links($output);
        echo $output;
        ?>

    </main>
    </section>

</body>