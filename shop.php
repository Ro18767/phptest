<form action="<?= $uri_path_only ?>" method="get" enctype="application/x-www-form-urlencoded">
    <?php if ($group !== false): ?>
        <input type="hidden" name="grp" value="<?= $group ?>">
    <?php endif ?>

    <div class="row">
        <div class="col s2">
            <h4>Групи товарів</h4>
            <div class="collection">
                <a href="?grp=all" class="collection-item">Усі</a>
                <?php foreach ($product_groups as &$product_group): ?>
                    <a href="?grp=<?= $product_group['id'] ?>" class="collection-item">
                        <?= $product_group['title'] ?>
                    </a>
                <?php endforeach ?>
            </div>
            <h4>За ціною</h4>
            <span>від</span> <input type="number" value="<?= $products_min_price ?? 0 ?>" name="min-price" />
            <span>до</span> <input type="number" value="<?= $products_max_price ?? 0 ?>" name="max-price" />
            <div class="row right-align">
                <button id="price-filter-button" type="submit" title="Показати з встановленним обмеженням"
                    class="waves-effect waves-light btn orange"><i class="material-icons">savings</i></button>
            </div>
        </div>

        <div class="col s10">
            <div class="row">
                <?php foreach ($products as $product): ?>
                    <div class="col" style='width: 200px; height: 340px;'>
                        <div class="card">
                            <div class="card-image">
                                <img src="/img/<?= $product['avatar'] ?>" style="height:150px">
                            </div>
                            <div class="card-content">
                                <span class="card-title" title="<?= $product['title'] ?>"
                                    style="font-size:1.2vw;height: 32px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;">
                                    <?= $product['title'] ?>
                                </span>
                                <p>
                                    <?= $product['description'] ?>
                                </p>
                                <p><b>Price:
                                        <?= $product['price'] ?>
                                    </b></p>
                            </div>
                            <div class="card-action right-align">
                                <i class="material-icons">visibility</i>
                                <i style='display:inline-block;vertical-align:top;margin-right:20px'>123</i>
                                <a href="#"><i class="material-icons">shopping_cart</i></a>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>

            </div>
            <ul class="pagination">
                <li class="<?= $current_page === 0 ? 'disabled' : 'waves-effect' ?>">
                    <label>
                        <a><i class="material-icons">chevron_left</i></a>
                        <input type="submit" name="page" value="<?= max($current_page - 1, 0) + 1 ?>"
                            style="display: none;"></input>
                    </label>
                </li>
                <?php for ($i = 0; $i <= $last_pages; $i++): ?>

                    <li class="<?= $current_page === $i ? 'active' : 'waves-effect' ?>">
                        <label>
                            <a>
                                <?= $i + 1 ?>
                            </a>
                            <input type="submit" name="page" value="<?= $i + 1 ?>" style="display: none;"></input>
                        </label>
                    </li>

                <?php endfor ?>
                <li class="<?= $current_page >= $last_pages ? 'disabled' : 'waves-effect' ?>">
                    <label>
                        <a><i class="material-icons">chevron_right</i></a>
                        <input type="submit" name="page" value="<?= min($current_page, $last_pages) + 1 ?>"
                            style="display: none;"></input>
                    </label>
                </li>
            </ul>
        </div>
    </div>
</form>