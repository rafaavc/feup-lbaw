<?php

    // Recipe card
    function getRecipeCard() { ?> 
        <div class="container">
            <div class="card shadow p-2">
                <div class="card-img-top recipe-card-img-top"></div>
                <div class="card-body">
                    <h4 class="card-title">Cozido à portuguesa</h4>
                    <p class="text-muted m-0">4.6 ⭐⭐⭐⭐⭐ | 563 reviews</p>
                    <p class="card-text mt-2">by <span class="username">Jamie Oliver</span></p>
                </div>
            </div>
        </div>
    <?php }

    // Group card
    function getGroupCard() { ?>
        <div class="container">
            <div class="card shadow p-2">
                <div class="card-img-top group-card-img-top"></div>
                <div class="card-body">
                    <h4 class="card-title">Restaurante O Prego</h4>
                    <p class="text-muted m-0 card-info"><span class="info-number">237</span> recipes</p>
                    <p class="text-muted m-0 mt-2 card-info"><span class="info-number">57</span>  members</p>
                </div>
            </div>
        </div>
    <?php }

    // Category card
    function getCategoryCard() { ?>
        <div class="container">
            <div class="card shadow p-2">
                <div class="card-img-top category-card-img-top"></div>
                <div class="card-body">
                    <h4 class="card-title mt-3">Vegetarian</h4>
                    <p class="text-muted m-0 card-info"><span class="info-number">237</span> recipes</p>
                </div>
            </div>
        </div>
    <?php }

    // User card
    function getUserCard() { ?>
        <div class="container">
            <div class="card shadow p-2">
                <div class="user-card-img-top">
                    <img class="rounded-circle z-depth-2" src="https://mdbootstrap.com/img/Photos/Avatars/img%20(31).jpg">
                </div>
                <div class="card-body">
                    <h4 class="card-title mt-2">Jamie Oliver</h4>
                    <p class="text-muted m-0 mt-2">4.6 ⭐⭐⭐⭐⭐ | <span class="info-number">13</span> recipes</p>
                </div>
            </div>
        </div>
    <?php }
?>