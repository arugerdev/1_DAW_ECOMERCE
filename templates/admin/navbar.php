<?php


?>

<!-- Navbar -->
<nav class="navbar">
    <ul class="navbar-items flexbox-col">
        <li class="navbar-item flexbox">
            <a class="navbar-item-inner flexbox">
                <img src="/assets/img/logo.png" width="48" alt="EviMerce">
            </a>
        </li>
        <li class="navbar-item flexbox">
            <a class="navbar-item-inner flexbox">
                <svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm7.753 18.305c-.261-.586-.789-.991-1.871-1.241-2.293-.529-4.428-.993-3.393-2.945 3.145-5.942.833-9.119-2.489-9.119-3.388 0-5.644 3.299-2.489 9.119 1.066 1.964-1.148 2.427-3.393 2.945-1.084.25-1.608.658-1.867 1.246-1.405-1.723-2.251-3.919-2.251-6.31 0-5.514 4.486-10 10-10s10 4.486 10 10c0 2.389-.845 4.583-2.247 6.305z" />
                </svg>
            </a>
        </li>
    </ul>
</nav>

<style>
    .navbar {
        display: flex;
        flex-direction: row;
        background-color: rgb(175, 203, 255);
        padding: 12px;
        margin: 0;
    }

    .navbar-items {
        display: flex;
        flex-direction: row;
        width: 100%;
        height: 100%;
        padding: 0;
        margin: 0;
        justify-content: space-between;
    }

    .navbar-items {
        display: flex;
        list-style: none;
    }

    .navbar-item,
    .navbar-item-inner,
    .navbar-item-inner>img {
        width: 48px;
        height: 48px;
    }
    .navbar-item-inner>svg{
        width: 32px;
        height: 32px;
        background-color: #eee;
        border-radius: 100%;
    }

    .navbar-item-inner {
        display: flex;
        place-items: center;
        justify-content: center;
        color: #333;
        cursor: pointer;
    }
</style>