<div class="top d-flex justify-content-between align-items-center">
    <ion-icon name="menu-outline" class="sidebar-toggle"></ion-icon>
    <img src="<?= asset(\System\Auth\Auth::user()->profile['thumbnail']) ?>" alt="<?= e(\System\Auth\Auth::user()->name) ?>">
</div>
